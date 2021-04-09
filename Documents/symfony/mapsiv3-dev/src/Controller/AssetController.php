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

class AssetController extends AbstractController
{

    /**
     * @Route("/app/assets", name="asset_list")
     */
    public function indexactivite(PeopleRepository $repopeople,MetierRepository $repometier, SiteRepository $reposite, TierRepository $repotier, RessourceRepository $reporessource)
    {	
		$confo = 'Process';


		$allpeoples = $repopeople->findByCustomer($this->getUser()->getCustomer());
		$allmetiers = $repometier->findByCustomer($this->getUser()->getCustomer());
		$allsites = $reposite->findByCustomer($this->getUser()->getCustomer());
        $alltiers = $repotier->findByCustomer($this->getUser()->getCustomer());
        $allressources = $reporessource->findByCustomer($this->getUser()->getCustomer());

		if ($this->isGranted('ROLE_ADMIN')) {
			$peoples = $repopeople->findByCustomer($this->getUser()->getCustomer());
            $metiers = $repometier->findByCustomer($this->getUser()->getCustomer());
            $sites = $reposite->findByCustomer($this->getUser()->getCustomer());
            $tiers = $repotier->findByCustomer($this->getUser()->getCustomer());
            $ressources = $reporessource->findByCustomer($this->getUser()->getCustomer());
		}
		else
	    {
            $peoples = $repopeople->findByCustomer($this->getUser()->getCustomer());
            $metiers = $repometier->findByCustomer($this->getUser()->getCustomer());
            $sites = $reposite->findByCustomer($this->getUser()->getCustomer());
            $tiers = $repotier->findByCustomer($this->getUser()->getCustomer());
            $ressources = $reporessource->findByCustomer($this->getUser()->getCustomer());

        }
        return $this->render('blog/asset_list.html.twig', [
            'controller_name' => 'AssetController',
            'allpeoples' => $allpeoples,
			'peoples' => $peoples,
            'allmetiers' => $allmetiers,
			'metiers' => $metiers,
			'allsites' => $allsites,
			'sites' => $sites,
			'alltiers' => $alltiers,
            'tiers' => $tiers,
            'allressources' => $allressources,
			'ressources' => $ressources,
			'conformite' => $confo
        ]);
    }
    
    /**
	  * @route("/app/people/new", name="people_create")
	  * @route("/app/people/edit/{id}", name="people_edit")
	  */
      public function formpeople(People $people = null, ActiviteRepository $repoactivite, FluxRepository $repoflux, PeopleRepository $repopeople, JalonConnectActionRepository $repojalon, Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$people) {
		    $people = new People();
	    }
	    
	    $form = $this->createForm(PeopleType::class, $people, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
            $people->setCustomer($this->getUser()->getCustomer());
            $people->setPublishedAt(new \DateTime());
            $people->setPublisher($this->getUser()->getpeople());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setType('People');
        	$log->setEntry($people->getId());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le collaborateur COLAB-'.$people->getId().' '.$people->getLastname());
        	$manager->persist($people);
        	$manager->flush();
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	
        	return $this->redirectToRoute('asset_list');
		}
		$activites = $repoactivite->findAllCustomerUser($this->getUser()->getCustomer(),$people->getId());
		$fluxes = $repoflux->findAllCustomerUser($this->getUser()->getCustomer(),$people->getId());
		$jalons = $repojalon->findAllCustomerUser($this->getUser()->getCustomer(),$people->getId());
		
        if($this->isGranted('ROLE_ADMIN') OR !$people->getId() OR $repopeople->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$people->getId(),$this->getUser()->getPeople()->getMetier()))
		{
            return $this->render('blog/people_create.html.twig',[ 
                'formPeople' => $form->createView(),
                'editMode' => $people->getId() !== null,
                'people' => $people,
                'activites' => $activites,
                'fluxes' => $fluxes,
                'jalons' => $jalons,
                ]);
		}
		else
		{
			$this->addFlash(
				'warning',
				'Vous n\'avez pas accès à cette fiche collaborateur'
				);
			return $this->redirectToRoute('asset_list');
        } 
        
    }

    /**
	  * @route("/app/people/remove/{id}", name="people_remove")
	  */
      public function deletepeople(People $people, PeopleRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
      {
         if(!$log) { $log = new Log(); }
      $log->setUser($this->getUser());
      $log->setDate(new \DateTime());
      $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé le collaborateur COLAB-'.$people->getId());
      $log->setCustomer($this->getUser()->getCustomer());
      $log->setEntry($people->getId());
      $log->setType('People');
      $manager->persist($log);
         $manager->remove($people);
         $manager->flush();
     
      $this->addFlash(
          'success',
          'Le collaborateur est supprimé'
      );
     
         $peoples = $repo->findAll();
         return $this->redirectToRoute('asset_list');
         }
    
    
    
    /**
	  * @route("/app/metier/new", name="metier_create")
	  * @route("/app/metier/edit/{id}", name="metier_edit")
	  */
      public function formmetier(Metier $metier = null, MetierRepository $repometier, Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$metier) {
		    $metier = new Metier();
		    }

	    $form = $this->createForm(MetierType::class, $metier, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $manager = $this->getDoctrine()->getManager();
            $metier->setPublishedAt(new \DateTime());
            $metier->setPublisher($this->getUser()->getpeople());
		    $metier->setCustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setType('Métier');
        	$log->setEntry($metier->getId());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le métier MET-'.$metier->getId().' '.$metier->getDesignation());

        	$manager->persist($metier);
        	$manager->flush();
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	
        	return $this->redirectToRoute('asset_list');
    	}
    
        if($this->isGranted('ROLE_ADMIN') OR !$metier->getId() OR $repometier->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$metier->getId()))
		{
			return $this->render('blog/metier_create.html.twig',[ 
                'formMetier' => $form->createView(),
                'editMode' => $metier->getId() !== null,
                'metier' => $metier
                ]);
		}
		else
		{
			$this->addFlash(
				'warning',
				'Vous n\'avez pas accès à ce métier'
				);
			return $this->redirectToRoute('asset_list');
		}         
    }

    /**
	  * @route("/app/metier/remove/{id}", name="metier_remove")
	  */
      public function deletemetier(Metier $metier, MetierRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
      {
         if(!$log) { $log = new Log(); }
      $log->setUser($this->getUser());
      $log->setDate(new \DateTime());
      $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé le métier MET-'.$metier->getId().' '.$metier->getDesignation());
      $log->setCustomer($this->getUser()->getCustomer());
      $log->setEntry($metier->getId());
      $log->setType('Métier');
         $manager->remove($metier);
         $manager->flush();
     
      $this->addFlash(
          'success',
          'Le métier est supprimé'
      );
     
         $metiers = $repo->findAll();
         return $this->redirectToRoute('metier_list');
  }


    /**
	  * @route("/app/site/new", name="site_create")
	  * @route("/app/site/edit/{id}", name="site_edit")
	  */
      public function formsite(Site $site = null, SiteRepository $reposite, Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$site) {
		    $site = new Site();
		    }

	    $form = $this->createForm(SiteType::class, $site, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $manager = $this->getDoctrine()->getManager();
			$site->setCustomer($this->getUser()->getCustomer());
			$site->setPublishedAt(new \DateTime());
            $site->setPublisher($this->getUser()->getpeople());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setType('Site');
        	$log->setEntry($site->getId());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le site SIT-'.$site->getId().' '.$site->getDesignation());
        	$manager->persist($site);
        	$manager->flush();
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	
        	return $this->redirectToRoute('asset_list');
		}

		if($this->isGranted('ROLE_ADMIN') OR !$site->getId() OR $reposite->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$site->getId()))
		{
			return $this->render('blog/site_create.html.twig',[ 
				'formSite' => $form->createView(),
				'editMode' => $site->getId() !== null,
				'site' => $site
				]);
		}
		else
		{
			$this->addFlash(
				'warning',
				'Vous n\'avez pas accès à ce site'
				);
			return $this->redirectToRoute('asset_list');
		}    	      
    }

     /**
	  * @route("/app/site/remove/{id}", name="site_remove")
	  */
      public function deletesite(Site $site, SiteRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
      {
         if(!$log) { $log = new Log(); }
      $log->setUser($this->getUser());
      $log->setDate(new \DateTime());
      $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé le site SIT-'.$site->getId().' '.$site->getDesignation());
      $log->setCustomer($this->getUser()->getCustomer());
      $log->setEntry($site->getId());
      $log->setType('Site');
      $manager->persist($log);
         $manager->remove($site);
         $manager->flush();
     
      $this->addFlash(
          'success',
          'Le site est supprimé'
      );
     
         $sites = $repo->findAll();
         return $this->redirectToRoute('site_list');
     }

     /**
	  * @route("/app/tier/new", name="tier_create")
	  * @route("/app/tier/edit/{id}", name="tier_edit")
	  */
    public function formetier(Tier $tier = null, Log $log = null, TierRepository $repotier, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$tier) {
		    $tier = new Tier();
		    }

	    $form = $this->createForm(TierType::class, $tier, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $manager = $this->getDoctrine()->getManager();
			$tier->setCustomer($this->getUser()->getCustomer());
			$tier->setPublishedAt(new \DateTime());
            $tier->setPublisher($this->getUser()->getpeople());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setType('Tiers');
        	$log->setEntry($tier->getId());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le tier TI-'.$tier->getId().' '.$tier->getDesignation());
        	$manager->persist($tier);
        	$manager->flush();
        	
        	return $this->redirectToRoute('asset_list', ['id' => $tier->getId()]);
    	}
	
		if($this->isGranted('ROLE_ADMIN') OR !$tier->getId() OR $repotier->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$tier->getId()))
		{
			return $this->render('blog/tier_create.html.twig',[ 
				'formTier' => $form->createView(),
				'editMode' => $tier->getId() !== null,
				'tier' => $tier
				]);
		}
		else
		{
			$this->addFlash(
				'warning',
				'Vous n\'avez pas accès à ce métier'
				);
			return $this->redirectToRoute('asset_list');
		}  
	    			
        
    }

  
    /**
        * @route("/app/tier/remove/{id}", name="tier_remove")
        */
    public function deletetier(Tier $tier, TierRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
        {
            $manager->remove($tier);
            $manager->flush();

        $this->addFlash(
            'success',
            'Tier supprimé'
        );
            $tiers = $repo->findAll();
            return $this->redirectToRoute('tier_list');
    }
    
    /**
	  * @route("/app/ressource/new", name="ressource_create")
	  * @route("/app/ressource/edit/{id}", name="ressource_edit")
	  */
    public function formressource(Ressource $ressource = null, RessourceRepository $reporessource,  Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$ressource) {
		    $ressource = new Ressource();
		    }

	    $form = $this->createForm(RessourceType::class, $ressource, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $manager = $this->getDoctrine()->getManager();
			$ressource->setCustomer($this->getUser()->getCustomer());
			$ressource->setPublishedAt(new \DateTime());
            $ressource->setPublisher($this->getUser()->getpeople());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setType('Ressource');
        	$log->setEntry($ressource->getId());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié la ressource RES-'.$ressource->getId().' '.$ressource->getDesignation());
		    
        	$manager->persist($ressource);
        	$manager->flush();
        	
        	return $this->redirectToRoute('ressource_list', ['id' => $ressource->getId()]);
		}
		
		if($this->isGranted('ROLE_ADMIN') OR !$ressource->getId() OR $reporessource->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$ressource->getId()))
		{
			return $this->render('blog/ressource_create.html.twig',[ 
				'formRessource' => $form->createView(),
				'editMode' => $ressource->getId() !== null,
				'ressource' => $ressource
				]);
		}
		else
		{
			$this->addFlash(
				'warning',
				'Vous n\'avez pas accès à cette ressource'
				);
			return $this->redirectToRoute('asset_list');
		}  
    
    }

    /**
	  * @route("/app/ressource/remove/{id}", name="ressource_remove")
	  */
      public function deleteressource(Ressource $ressource, Log $log = null, RessourceRepository $repo, Request $request, ObjectManager $manager)
      {
         $manager->remove($ressource);
         $manager->flush();

      $this->addFlash(
          'success',
          'Ressource supprimée'
      );
         $ressources = $repo->findAll();
         return $this->redirectToRoute('ressource_list');
  }


}
