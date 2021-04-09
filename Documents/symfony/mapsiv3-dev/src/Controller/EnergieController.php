<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Psr\Log\LoggerInterface;
use Twig\Extensions\IntlExtension;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use Dompdf\Dompdf;
use Dompdf\Options;

use App\Entity\Application;
use App\Entity\TypeAppli;
use App\Entity\TypeSysteme;
use App\Entity\Systeme;
use App\Entity\People;
use App\Entity\Activite;
use App\Entity\Processus;
use App\Entity\Metier;
use App\Entity\Site;
use App\Entity\ObjetMetier;
use App\Entity\Flux;
use App\Entity\Tier;
use App\Entity\Ressource;
use App\Entity\User;
use App\Entity\MapsiCustomer;
use App\Entity\Action;
use App\Entity\Projet;
use App\Entity\Program;
use App\Entity\Risque;
use App\Entity\Axe;
use App\Entity\TypeConformite;
use App\Entity\Document;
use App\Entity\AppConnectActivite;
use App\Entity\Log;
use App\Entity\Criticite;
use App\Entity\TypePhase;
use App\Entity\TypeDcpjuridique;
use App\Entity\TypeDcpsensible;
use App\Entity\RgpdAccess;
use App\Entity\RgpdViolation;
use App\Entity\RgpdAudit;
use App\Entity\Data;
use App\Entity\TypePrevention;
use App\Entity\TypeTraitementrgpd;
use App\Entity\PcaEvenement;
use App\Entity\TypePcaEvenement;
use App\Entity\TypePcaEvenementAppTrack;
use App\Entity\TypePcaEvenementServTrack;
use App\Entity\TypeScore;
use App\Entity\TypeActeur;
use App\Entity\Anomalie;
use App\Entity\Controle;
use App\Entity\Pca;
use App\Entity\TypeStatutRisque;
use App\Entity\TypeRisque;
use App\Entity\Objectif;
use App\Entity\JalonConnectAction;



use App\Repository\ApplicationRepository;
use App\Repository\SystemeRepository;
use App\Repository\PeopleRepository;
use App\Repository\TypeAppliRepository;
use App\Repository\ActiviteRepository;
use App\Repository\ProcessusRepository;
use App\Repository\MetierRepository;
use App\Repository\SiteRepository;
use App\Repository\ObjetMetierRepository;
use App\Repository\TierRepository;
use App\Repository\RessourceRepository;
use App\Repository\MapsiCustomerRepository;
use App\Repository\UserRepository;
use App\Repository\FluxRepository;
use App\Repository\TypeSystemeRepository;
use App\Repository\ActionRepository;
use App\Repository\ProgramRepository;
use App\Repository\RisqueRepository;
use App\Repository\AxeRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\TypePrioriteRepository;
use App\Repository\DocumentRepository;
use App\Repository\ProjetRepository;
use App\Repository\LogRepository;
use App\Repository\CriticiteRepository;
use App\Repository\JalonConnectActionRepository;
use App\Repository\TypeStatutRepository;
use App\Repository\TypePhaseRepository;
use App\Repository\TypeRagRepository;
use App\Repository\AppConnectActiviteRepository;
use App\Repository\TypeDcpjuridiqueRepository;
use App\Repository\TypeDcpsensibleRepository;
use App\Repository\RgpdAccessRepository;
use App\Repository\RgpdViolationRepository;
use App\Repository\RgpdAuditRepository;
use App\Repository\DataRepository;
use App\Repository\TypePreventionRepository;
use App\Repository\TypeTraitementrgpdRepository;
use App\Repository\PcaEvenementRepository;
use App\Repository\TypePcaEvenementRepository;
use App\Repository\TypeActeurRepository;
use App\Repository\AnomalieRepository;
use App\Repository\ControleRepository;
use App\Repository\PcaEvenementAppTrackRepository;
use App\Repository\PcaEvenementServTrackRepository;
use App\Repository\TypeScoreRepository;
use App\Repository\TypeStatutRisqueRepository;
use App\Repository\TypeRisqueRepository;
use App\Repository\ObjectifRepository;


use App\Form\ApplicationType;
use App\Form\SystemeType;
use App\Form\PeopleType;
use App\Form\ActiviteType;
use App\Form\ProcessusType;
use App\Form\MetierType;
use App\Form\SiteType;
use App\Form\ObjetMetierType;
use App\Form\TierType;
use App\Form\RessourceType;
use App\Form\MapsiCustomerType;
use App\Form\RegistrationType;
use App\Form\FluxType;
use App\Form\ActionType;
use App\Form\ProjetType;
use App\Form\ProgramType;
use App\Form\RisqueType;
use App\Form\AxeType;
use App\Form\DocumentType;
use App\Form\JalonConnectActionType;
use App\Form\RgpdAccessType;
use App\Form\RgpdViolationType;
use App\Form\RgpdAuditType;
use App\Form\DataType;
use App\Form\PcaevenementType;
use App\Form\AnomalieType;
use App\Form\ControleType;
use App\Form\PcaEvenementAppTrackType;
use App\Form\PcaEvenementServTrackType;
use App\Form\ObjectifType;

class EnergieController extends AbstractController
{
    /**
     * @Route("/app/energie", name="energie_list")
     */
    public function indexaction(ActionRepository $repoaction,
    							ProgramRepository $repoprogram, 
    							TypePrioriteRepository $repopriorite, 
    							TypeStatutRepository $repostatut,
    							ProjetRepository $repoprojet,
    							MetierRepository $repometier,
    							ProcessusRepository $repoprocessus,
    							JalonConnectActionRepository $repojalon,
    							TypePhaseRepository $repophase)
    {	    
    	if ($this->isGranted('ROLE_ADMIN')) {
	    	$actions = $repoaction->findBy(array('customer' => $this->getUser()->getCustomer(),'archive' => null));
	    	$projets = $repoprojet->findByCustomer($this->getUser()->getCustomer());
	    	$programs = $repoprogram->findByCustomer($this->getUser()->getCustomer());
	    	$jalons = $repojalon->findByMcustomer($this->getUser()->getCustomer());
		}
		else
	    {
		    $actions = $repoaction->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		    $projets = $repoprojet->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		    $programs = $repoprogram->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		    $jalons = $repojalon->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		}		
		$alljalons = $repojalon->findByMcustomer($this->getUser()->getCustomer());
		$allactions = $repoaction->findBy(array('customer' => $this->getUser()->getCustomer(),'archive' => null));
	    $allprojets = $repoprojet->findByCustomer($this->getUser()->getCustomer());
	    $allprograms = $repoprogram->findByCustomer($this->getUser()->getCustomer());
	    $priorites = $repopriorite->findByCustomer($this->getUser()->getCustomer());
	    $metiers = $repometier->findByCustomer($this->getUser()->getCustomer());
	    $processuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
	    $statuts = $repostatut->findByCustomer($this->getUser()->getCustomer());
	    $phases = $repophase->findByCustomer($this->getUser()->getCustomer());
	    $alljalons = $repojalon->findByMcustomer($this->getUser()->getCustomer());
        return $this->render('blog/energie_list.html.twig', [
            'controller_name' => 'BlogController',
            'actions' => $actions,
            'projets' => $projets,
            'programs' => $programs,
            'allactions' => $allactions,
            'allprojets' => $allprojets,
			'allprograms' => $allprograms,
			'alljalons' => $alljalons,
            'priorites' => $priorites,
            'metiers' => $metiers,
            'processuses' => $processuses,
            'statuts' => $statuts,
            'jalons' => $jalons,
            'phases' => $phases
        ]);
    }
}

