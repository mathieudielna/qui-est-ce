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
use Symfony\Component\Workflow\StateMachine;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Component\Workflow\Registry;

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

class SiController extends AbstractController
{
 	/**
     * @var Registry
    */
    private $workflows;
    public function __construct(Registry $workflows)
    {
        $this->state_machines = $workflows;
    }

    /**
     * @Route("/app/si", name="si_list")
     */
    public function indexapp(ApplicationRepository $repo,
    						 ProcessusRepository $repoprocessus, 
    						 TypeAppliRepository $repotypeappli, 
    						 SystemeRepository $reposysteme, 
    						 CriticiteRepository $repocriticite, 
                             TypeSystemeRepository $repotypesysteme,
                             ActiviteRepository $repoactivite)
    {	    
        $confo = 'SI';

	    $typeapplis = $repotypeappli->findByCustomer($this->getUser()->getCustomer());
	    $criticite = $repocriticite->findByCustomer($this->getUser()->getCustomer());
		$typesystemes = $repotypesysteme->findByCustomer($this->getUser()->getCustomer());

		$allapplications = $repo->findByCustomer($this->getUser()->getCustomer());
		$allprocessuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
        $allsystemes = $reposysteme->findByCustomer($this->getUser()->getCustomer());
        $allactivites = $repoactivite->findByCustomer($this->getUser()->getCustomer());
		
		if ($this->isGranted('ROLE_ADMIN')) {
			$applications = $repo->findByCustomer($this->getUser()->getCustomer());
			$processuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
			$systemes = $reposysteme->findByCustomer($this->getUser()->getCustomer());
		}
		else
	    {
			$applications = $repo->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());	
			$systemes = $reposysteme->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
			$processuses = $repoprocessus->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		}


        return $this->render('blog/si_list.html.twig', [
            'controller_name' => 'BlogController',
            'processuses' => $processuses,
			'applications' => $applications,
			'allprocessuses' => $allprocessuses,
            'allapplications' => $allapplications,
            'allactivites' => $allapplications,
            'typeapplis' => $typeapplis,
			'systemes' => $systemes,
			'allsystemes' => $allsystemes,
            'criticites' => $criticite,
            'typesystemes' => $typesystemes,
			'conformite' => $confo
        ]);
    }

    /**
	 * @route("/app/si/application/new", name="appli_create")
	* @route("/app/si/application/edit/{id}", name="appli_edit")
	*/
    public function form(Application $application = null,ApplicationRepository $repoappli , Log $log = null, Request $request, ObjectManager $manager){
		$r=$_GET["r"];$rr=$_GET["rr"];
		if(!$log) { $log = new Log(); }
	    if(!$application) { 
            $application = new Application();
            $application->addPeople($this->getUser()->getpeople()); }

	    
	    $form = $this->createForm(ApplicationType::class, $application, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $manager = $this->getDoctrine()->getManager();
        	$application->setPublishedAt(new \DateTime());
            $application->setCustomer($this->getUser()->getCustomer());
            $application->setPublisher($this->getUser()->getpeople());
        	$log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié l\'application APP-'.$application->getId().' '.$application->getDesignation());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setType('Application');
        	$log->setEntry($application->getId());
        	$manager->persist($log);
        	 
        	$manager->persist($application);
			
        	$manager->flush();
        	
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
			);
        	
        	return $this->redirectToRoute('appli_edit',[ 
				'r' => $r,
				'rr' => $rr,
				'id' => $application->getId()
				]);
        }
        
        if($this->isGranted('ROLE_ADMIN') OR !$application->getId() OR $repoappli->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$application->getId()))
		{
			return $this->render('blog/appli_create.html.twig',[ 
				'formApplication' => $form->createView(),
				'editMode' => $application->getId() !== null,
				'r' => $r,
				'rr' => $rr,
				'application' => $application
				]);
		}
		else
		{
			$this->addFlash(
				'warning',
				'Vous n\'avez pas accès à cette application'
				);
                return $this->redirectToRoute('si_list');
		}
    }

    /**
     * @route("/app/si/application/remove/{id}", name="appli_remove")
    */
    public function deleteapplication(Application $application, ApplicationRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
    {
		
        if(!$log) { $log = new Log(); }
    $log->setUser($this->getUser());
    $log->setDate(new \DateTime());
    $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé l\'application APP-'.$application->getId().' '.$application->getDesignation());
    $log->setCustomer($this->getUser()->getCustomer());
    $log->setEntry($application->getId());
    $log->setType('Application');
    $manager->persist($log);
    
        $manager->remove($application);
        $manager->flush();

    $this->addFlash(
        'success',
        'L\'application est supprimée'
    );
    
        $applications = $repo->findAll();
        return $this->redirectToRoute('si_list');
	}
	
	 /**
    * @route("/app/si/application/{id}/{statut}", name="application_workflow")
    * @param $statut
    * @param Application $application
    * @internal param Registry $workflows
    */
    public function wkapp(Application $application, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    {
        $r=$_GET["r"];$rr=$_GET["rr"];
        $workflow = $this->state_machines->get($application);
        if($workflow->can($application, $statut)) {
            $manager = $this->getDoctrine()->getManager();
            $workflow->apply($application, $statut);
            $application->setValidatedAt(new \DateTime());
            $application->setValidator($this->getUser()->getpeople());
            
            $manager->persist($application);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre demande est transmise, merci"
                );
            
            return $this->redirectToRoute('appli_edit',[ 
                'r' => $r,
                'rr' => $rr,
                'id' => $application->getId()
                ]);
        }
    }

    /**
	  * @route("/app/systeme/new", name="systeme_create")
	  * @route("/app/systeme/edit/{id}", name="systeme_edit")
	  */
      public function formsysteme(Systeme $systeme = null,SystemeRepository $reposysteme, Log $log = null, Request $request, ObjectManager $manager){
	    $r=$_GET["r"];$rr=$_GET["rr"];
		if(!$log) { $log = new Log(); }
	    if(!$systeme) {
            $systeme = new Systeme();
            $systeme->addPeople($this->getUser()->getpeople());
	    }
	    
	    $form = $this->createForm(SystemeType::class, $systeme, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
            $systeme->setPublishedAt(new \DateTime());
            $systeme->setPublisher($this->getUser()->getpeople());
		    $systeme->setCustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setType('Système');
        	$log->setEntry($systeme->getId());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le système SYS-'.$systeme->getId().' '.$systeme->getDesignation());
        	$manager->persist($systeme);
        	$manager->flush();
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	
			return $this->redirectToRoute('systeme_edit',[ 
				'r' => $r,
				'rr' => $rr,
				'id' => $systeme->getId()
				]);
    	}
        
        if($this->isGranted('ROLE_ADMIN') OR !$systeme->getId() OR $reposysteme->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$systeme->getId()))
		{
			return $this->render('blog/systeme_create.html.twig',[ 
				'formSysteme' => $form->createView(),
				'editMode' => $systeme->getId() !== null,
				'r' => $r,
				'rr' => $rr,
				'systeme' => $systeme
				]);
		}
		else
		{
			$this->addFlash(
				'warning',
				'Vous n\'avez pas accès à ce système'
				);
                return $this->redirectToRoute('si_list');
		}
 
    }

    /**
	  * @route("/app/systeme/remove/{id}", name="systeme_remove")
	  */
      public function deletesysteme(Systeme $systeme, SystemeRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
      {
         if(!$log) { $log = new Log(); }
      $log->setUser($this->getUser());
      $log->setDate(new \DateTime());
      $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé le système SYS-'.$systeme->getId().' '.$systeme->getDesignation());
      $log->setCustomer($this->getUser()->getCustomer());
      $log->setEntry($systeme->getId());
      $log->setType('Système');
      $manager->persist($log);
         $manager->remove($systeme);
         $manager->flush();
     
      $this->addFlash(
          'success',
          'Le système est supprimé'
          );
     
         $systemes = $repo->findAll();
         return $this->redirectToRoute('si_list');
  }

  /**
    * @route("/app/si/systeme/{id}/{statut}", name="systeme_workflow")
    * @param $statut
    * @param Systeme $systeme
    * @internal param Registry $workflows
    */
    public function wksys(Systeme $systeme, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    {
        $r=$_GET["r"];$rr=$_GET["rr"];
        $workflow = $this->state_machines->get($systeme);
        if($workflow->can($systeme, $statut)) {
            $manager = $this->getDoctrine()->getManager();
            $workflow->apply($systeme, $statut);
            $systeme->setValidatedAt(new \DateTime());
            $systeme->setValidator($this->getUser()->getpeople());
            
            $manager->persist($systeme);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre demande est transmise, merci"
                );
            
            return $this->redirectToRoute('systeme_edit',[ 
                'r' => $r,
                'rr' => $rr,
                'id' => $systeme->getId()
                ]);
        }
    }

}
