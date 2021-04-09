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
use App\Repository\RgpdViolationRepository;
use App\Repository\AuditRepository;
use App\Repository\DataRepository;
use App\Repository\TypePreventionRepository;
use App\Repository\TypeTraitementrgpdRepository;
use App\Repository\PcaEvenementRepository;
use App\Repository\TypePcaEvenementRepository;
use App\Repository\TypeActeurRepository;
use App\Repository\AnomalieRepository;
use App\Repository\ControleRepository;
use App\Repository\DysfonctionnementRepository;
use App\Repository\PcaEvenementAppTrackRepository;
use App\Repository\PcaEvenementServTrackRepository;
use App\Repository\TypeScoreRepository;
use App\Repository\TypeStatutRisqueRepository;
use App\Repository\TypeRisqueRepository;
use App\Repository\ObjectifRepository;

class ControleInterneController extends AbstractController
{
    /**
     * @Route("/app/controleinterne", name="ctrlint_list")
     */
    public function indexctrlint(
        AnomalieRepository $repoanomalie, 
        ProcessusRepository $repoprocessus, 
        TypeConformiteRepository $repoconformite, 
        ControleRepository $repocontrole,
        DysfonctionnementRepository $repodysfonctionnement, 
        ActionRepository $repoaction,
        AuditRepository $repoaudit
        )
    {	    
        $confo = 'Contrôle Interne';
        $conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'designation' => $confo));
        

        if ($this->isGranted('ROLE_ADMIN')) 
			{
                $audits = $repoaudit->findAllConformite($this->getUser()->getCustomer(),$conformite);
                $dysfonctionnements = $repodysfonctionnement->findAllConformite($this->getUser()->getCustomer(),$conformite);
                $actions = $repoaction->findAllConformite($this->getUser()->getCustomer(),$conformite);
                $processuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
			}
		else
			{
                $audits = $repoaudit->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
                $dysfonctionnements = $repodysfonctionnement->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
                $actions = $repoaction->findAllCustomerConformite($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
                $processuses = $repoprocessus->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
			}	

        $controles = $repocontrole->findByCustomer($this->getUser()->getCustomer());
        

        return $this->render('blog/controlint_list.html.twig', [
            'controller_name' => 'BlogController',
            'processuses' => $processuses,
            'controles' => $controles,
            'actions' => $actions,
            'dysfonctionnements' => $dysfonctionnements,
            'audits' => $audits,
            'conformite' => $confo
        ]);
    }
}
