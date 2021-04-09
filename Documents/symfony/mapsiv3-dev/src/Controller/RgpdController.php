<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
use App\Repository\DysfonctionnementRepository;
use App\Repository\AuditRepository;
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

class RgpdController extends AbstractController
{
    /**
     * @Route("/app/rgpd", name="rgpd_list")
     */
    public function indexrgpd(
        ActiviteRepository $repo,
        ProcessusRepository $repoprocessus,
        ObjetMetierRepository $repoom, 
        FluxRepository $repoflux, 
        TypeDcpJuridiqueRepository $repodcpjur, 
        RgpdAccessRepository $repoaccess,
        DysfonctionnementRepository $repodysfonctionnement, 
        ActionRepository $repoaction, 
        ApplicationRepository $repoapplication, 
        RisqueRepository $reporisque, 
        AuditRepository $repoaudit,
        TypeConformiteRepository $repoconformite, 
        TypeTraitementrgpdRepository $repotypetraitement, 
        TypeActeurRepository $repotypeacteur, 
        TypeDcpsensibleRepository $repodcpsensible, 
        ApplicationRepository $repoapp, 
        MetierRepository $repometier
    )
    {

    $confo = 'RGPD';
    $conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'designation' => $confo));
	    
    if ($this->isGranted('ROLE_ADMIN')) {
            $fluxs = $repoflux->findByCustomer($this->getUser()->getCustomer());
	    	$objetmetiers = $repoom->findByCustomer($this->getUser()->getCustomer());
	    	$accesses = $repoaccess->findByCustomer($this->getUser()->getCustomer());
	    	$dysfonctionnements = $repodysfonctionnement->findAllConformite($this->getUser()->getCustomer(),$conformite);
	    	$actions = $repoaction->findAllConformite($this->getUser()->getCustomer(),$conformite);
	    	$audits = $repoaudit->findAllConformite($this->getUser()->getCustomer(),$conformite);
		}
		else
	    {
		    $fluxs = $repoflux->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		    $objetmetiers = $repoom->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		    $accesses = $repoaccess->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		    $dysfonctionnements = $repodysfonctionnement->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
            $actions = $repoaction->findAllCustomerConformite($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
		    $audits = $repoaudit->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
		}	
    	   
	    $allaccesses = $repoaccess->findByCustomer($this->getUser()->getCustomer());
	    $allfluxs = $repoflux->findByCustomer($this->getUser()->getCustomer());
	    $activites = $repo->findByCustomer($this->getUser()->getCustomer());
	    $allobjetmetiers = $repoom->findByCustomer($this->getUser()->getCustomer());
	    $processuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
	    $dcpjuridiques = $repodcpjur->findByCustomer($this->getUser()->getCustomer());
	    $allactions = $repoaction->findByCustomer($this->getUser()->getCustomer());
	    $applications = $repoapplication->findByCustomer($this->getUser()->getCustomer());
		$allrisques = $reporisque->findByCustomer($this->getUser()->getCustomer());
		$risques = $reporisque->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
	    $allaudits = $repoaudit->findByCustomer($this->getUser()->getCustomer());
	    $typeconformites = $repoconformite->findByCustomer($this->getUser()->getCustomer());
	    $typetraitements = $repotypetraitement->findByCustomer($this->getUser()->getCustomer());
	    $typeacteurs = $repotypeacteur->findByCustomer($this->getUser()->getCustomer());
	    $typedcpsensibles = $repodcpsensible->findByCustomer($this->getUser()->getCustomer());
	    $apps = $repoapp->findByCustomer($this->getUser()->getCustomer());
	    $metiers = $repometier->findByCustomer($this->getUser()->getCustomer());
	    
        return $this->render('blog/rgpd_list.html.twig', [
            'controller_name' => 'BlogController',
            'processuses' => $processuses,
            'activites' => $activites,
            'objetmetiers' => $objetmetiers,
            'allobjetmetiers' => $allobjetmetiers,
            'fluxs' => $fluxs,
            'allfluxs' => $allfluxs,
            'dcps' => $dcpjuridiques,
            'accesses' => $accesses,
            'allaccesses' => $allaccesses,
            'dysfonctionnements' => $dysfonctionnements,
            'applications' => $applications,
            'actions' => $actions,
            'allactions' => $allactions,
			'risques' => $risques,
			'allrisques' => $allrisques,
            'audits' => $audits,
            'allaudits' => $allaudits,
            'typeconformites' => $typeconformites,
            'typetraitements' => $typetraitements,
            'typeacteurs' => $typeacteurs,
            'typedcpsensibles' => $typedcpsensibles,
            'apps' => $apps,
            'metiers' => $metiers,
            'conformite' => $confo
			]);
    }

   





}
