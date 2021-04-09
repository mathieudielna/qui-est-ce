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


class BlogController extends AbstractController
{     
  
  /**
  * @route("/app/pdf/{id}", name="pdf")
  */   
  public function makepdf(Controle $controle)
    {
        $options = new Options();
		$options->set('defaultFont', 'Courier');
		$dompdf = new Dompdf($options);
		
        $html = $this->renderView('pdf/mypdf.html.twig', [
            'controle' => $controle
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }
    
  /**
  * @route("/app/rgpd/pdf/{id}", name="traitementrgpdpdf")
  */   
  public function maketraitementpdf(Flux $flux)
    {
        		$dompdf = new Dompdf();
		
        $html = $this->renderView('pdf/fiche_traitement_rgpd.html.twig', ['flux' => $flux]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("fiche_traitement_rgpd.pdf", [
            "Attachment" => true
        ]);
	}
	
	/**
  * @route("/error", name="error")
  */

  public function errortest()
  {	    
	  return $this->render('blog/systeme_list.html.twig', []);
  }

  
  /**
  * @route("/app", name="start")
  */
    public function start ()
    {
		return $this->redirectToRoute('switch');       
	}
    
     
     
    
 
    
    // /**
    //  * @Route("/app/metier", name="metier_list")
    //  */
    // public function indexmetier(MetierRepository $repo)
    // {	    
	//    $metiers = $repo->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
	//    $allmetiers = $repo->findByCustomer($this->getUser()->getCustomer());
    //     return $this->render('blog/metier_list.html.twig', [
    //         'controller_name' => 'BlogController',
    //         'metiers' => $metiers
    //     ]);
    // }
    
 
    
    //   /**
    //  * @Route("/app/site", name="site_list")
    //  */
    // public function indexsite(SiteRepository $repo)
    // {	    
	//     $sites = $repo->findByCustomer($this->getUser()->getCustomer());
    //     return $this->render('blog/site_list.html.twig', [
    //         'controller_name' => 'BlogController',
    //         'sites' => $sites
    //     ]);
    // }
    

    
    //  /**
    //  * @Route("/app/systeme", name="systeme_list")
    //  */
    // public function indexsys(SystemeRepository $reposysteme, ApplicationRepository $repoapplication, TypeSystemeRepository $repotypesysteme)
    // {	    
	//     $systemes = $reposysteme->findByCustomer($this->getUser()->getCustomer());
	//     $applications = $repoapplication->findByCustomer($this->getUser()->getCustomer());
	//     $typesystemes = $repotypesysteme->findByCustomer($this->getUser()->getCustomer());

    //     return $this->render('blog/systeme_list.html.twig', [
    //         'controller_name' => 'BlogController',
    //         'applications' => $applications,
    //         'systemes' => $systemes,
    //         'typesystemes' => $typesystemes
    //     ]);
    // }
    
    

    
    // /**
    //  * @Route("/app/people", name="people_list")
    //  */
    // public function indexpeople(PeopleRepository $repopeople)
    // {	    
	//     $peoples = $repopeople->findByCustomer($this->getUser()->getCustomer());
    //     return $this->render('blog/people_list.html.twig', [
    //         'controller_name' => 'BlogController',
    //         'peoples' => $peoples
    //     ]);
    // }
    
    //  /**
    //  * @Route("/app/tier", name="tier_list")
    //  */
    // public function indextier(TierRepository $repotier)
    // {	    
	//     $tiers = $repotier->findByCustomer($this->getUser()->getCustomer());
    //     return $this->render('blog/tier_list.html.twig', [
    //         'controller_name' => 'BlogController',
    //         'tiers' => $tiers
    //     ]);
    // }
    
    //  /**
    //  * @Route("/app/ressource", name="ressource_list")
    //  */
    // public function indexressource(RessourceRepository $reporessource)
    // {	    
	//     $ressources = $reporessource->findByCustomer($this->getUser()->getCustomer());
    //     return $this->render('blog/ressource_list.html.twig', [
    //         'controller_name' => 'BlogController',
    //         'ressources' => $ressources
    //     ]);
    // }
    
    
    //  /**
    //  * @Route("/app/risque", name="risque_list")
    //  */
	// public function indexrisque(RisqueRepository $reporisque, 
	// 							TypeStatutRisqueRepository $repostatutrisque, 
	// 							ProcessusRepository $repoprocessus,
	// 							TypeRisqueRepository $repotyperisque,
	// 							TypeConformiteRepository $repotypeconformite)
    // {	    
	// 	$statutrisques= $repostatutrisque->findByCustomer($this->getUser()->getCustomer());
	// 	$allprocessuses= $repoprocessus->findByCustomer($this->getUser()->getCustomer());
	// 	$allrisques = $reporisque->findByCustomer($this->getUser()->getCustomer());
	// 	$typerisques = $repotyperisque->findByCustomer($this->getUser()->getCustomer());
	// 	$typeconformites = $repotypeconformite->findByCustomer($this->getUser()->getCustomer());
	// 	$risques = $reporisque->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
    //     return $this->render('blog/risque_list.html.twig', [
    //         'controller_name' => 'BlogController',
	// 		'risques' => $risques,
	// 		'allrisques' => $allrisques,
	// 		'statutrisques' => $statutrisques,
	// 		'allprocessuses' => $allprocessuses,
	// 		'typerisques' => $typerisques,
	// 		'typeconformites' => $typeconformites
    //     ]);
    // }
    
    
    /**
     * @Route("/app/axe", name="axe_list")
     */
    public function indexaxe(AxeRepository $repoaxe)
    {	    
	    $axes = $repoaxe->findByCustomer($this->getUser()->getCustomer());
        return $this->render('blog/axe_list.html.twig', [
            'controller_name' => 'BlogController',
            'axes' => $axes
        ]);
    }
    
    
      
      /**
	  * @route("/app/rgpd/access/new", name="access_create")
	  * @route("/app/rgpd/access/edit/{id}", name="access_edit")
	  */
    public function formrgpdaccess(RgpdAccess $rgpdaccess = null, Log $log = null, Request $request, ObjectManager $manager){
	    
	  	if(!$log) { $log = new Log(); } 
	    if(!$rgpdaccess) {
		$rgpdaccess = new RgpdAccess();
		$rgpdaccess->setResponsable($this->getUser()->getpeople());
		}
		$form = $this->createForm(RgpdAccessType::class, $rgpdaccess, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		'userPeople' => $this->getUser()->getPeople(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $rgpdaccess->setPublishedAt(new \DateTime());
		    $rgpdaccess->setPublisher($this->getUser()->getpeople());
		    $manager = $this->getDoctrine()->getManager();
		    $rgpdaccess->setCustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié la violation VI-'.$rgpdaccess->getId().' '.$rgpdaccess->getDesignation());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setType('DMD ACCES RGPD');
        	$log->setEntry($rgpdaccess->getId());
        	$manager->persist($rgpdaccess);
        	$manager->flush();
        	 $this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	
        	return $this->redirectToRoute('rgpd_list', ['id' => $rgpdaccess->getId()]);
    	}
	
        return $this->render('blog/rgpdaccess_create.html.twig',[ 
        'formRgpdAccess' => $form->createView(),
        'editMode' => $rgpdaccess->getId() !== null,
        'rgpdaccess' => $rgpdaccess
        ]);
    }
    
       /**
	  * @route("/app/rgpd/violation/new", name="violation_create")
	  * @route("/app/rgpd/violation/edit/{id}", name="violation_edit")
	  */
    public function formrgpdviolation(RgpdViolation $rgpdviolation = null, Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    $create='no';
	    if(!$rgpdviolation) {$create='yes'; $rgpdviolation = new RgpdViolation();}
		$form = $this->createForm(RgpdViolationType::class, $rgpdviolation, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		'userPeople' => $this->getUser()->getPeople(),
		'create' => $create		   			   		
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $rgpdviolation->setPublishedAt(new \DateTime());
		    $manager = $this->getDoctrine()->getManager();
		    $rgpdviolation->setCustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié la violation VI-'.$rgpdviolation->getId().' '.$rgpdviolation->getDesignation());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setType('VIOLATION RGPD');
        	$log->setEntry($rgpdviolation->getId());
        	$manager->persist($rgpdviolation);
        	$manager->flush();
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	return $this->redirectToRoute('rgpd_list', ['id' => $rgpdviolation->getId()]);
    	}
	
        return $this->render('blog/rgpdviolation_create.html.twig',[ 
        'formRgpdViolation' => $form->createView(),
        'editMode' => $rgpdviolation->getId() !== null,
        'rgpdviolation' => $rgpdviolation
        ]);
    }
    
      /**
	  * @route("/app/rgpd/audit/new", name="rgpdaudit_create")
	  * @route("/app/rgpd/audit/edit/{id}", name="rgpdaudit_edit")
	  */
    public function formrgpdaudit(RgpdAudit $rgpdaudit = null, Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$rgpdaudit) {
		    $rgpdaudit = new RgpdAudit();
		    $rgpdaudit->setCreatedAt(new \DateTime());
		    }
	    $form = $this->createForm(RgpdAuditType::class, $rgpdaudit, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $rgpdaudit->setPublishedAt(new \DateTime());
		    $manager = $this->getDoctrine()->getManager();
		    $rgpdaudit->setCustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié l\'audit AUD-'.$rgpdaudit->getId().' '.$rgpdaudit->getDesignation());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setType('AUDIT RGPD');
        	$log->setEntry($rgpdaudit->getId());
        	$manager->persist($rgpdaudit);
        	$manager->flush();
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	return $this->redirectToRoute('rgpd_list', ['id' => $rgpdaudit->getId()]);
    	}
	
        return $this->render('blog/rgpdaudit_create.html.twig',[ 
        'formRgpdAudit' => $form->createView(),
        'editMode' => $rgpdaudit->getId() !== null,
        'rgpdaudit' => $rgpdaudit
        ]);
    }
    
    
    
           /**
	  * @route("/app/pca/evenement/new", name="evenement_create")
	  * @route("/app/pca/evenement/edit/{id}", name="evenement_edit")
	  */
    public function formpcaevenement(PcaEvenement $pcaevenement = null, SystemeRepository $reposysteme, Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$pcaevenement) {
		    $pcaevenement = new PcaEvenement();
		    $pcaevenement->setCreatedAt(new \DateTime());
		    }
	    $form = $this->createForm(PcaevenementType::class, $pcaevenement, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $pcaevenement->setPublishedAt(new \DateTime());
		    $manager = $this->getDoctrine()->getManager();
		    $pcaevenement->setCustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié l\'événement PCA-'.$pcaevenement->getId().' '.$pcaevenement->getDesignation());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setType('PCA');
        	$log->setEntry($pcaevenement->getId());
        	$manager->persist($pcaevenement);
        	$manager->flush();
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	return $this->redirectToRoute('pca_list', ['id' => $pcaevenement->getId()]);
    	}
    	$systemes = $reposysteme->findByCustomer($this->getUser()->getCustomer());
        return $this->render('blog/pcaevenement_create.html.twig',[ 
        'formPcaevenement' => $form->createView(),
        'editMode' => $pcaevenement->getId() !== null,
        'evenement' => $pcaevenement,
        'systemes' => $systemes
        ]);
    }

    
    
    /**
	  * @route("/app/ctrlint/controle/new", name="controle_create")
	  * @route("/app/ctrl/controle/edit/{id}", name="controle_edit")
	  */
    public function formcontrole(Controle $controle = null, Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$controle) {
		    $controle = new Controle();
		    $controle->setCreatedAt(new \DateTime());
		    }
	    $form = $this->createForm(ControleType::class, $controle, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $controle->setPublishedAt(new \DateTime());
		    $controle->setUpdatedAt(new \DateTime());
		    $manager = $this->getDoctrine()->getManager();
		    $controle->setCustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le controle CTRL-'.$controle->getId().' '.$controle->getDesignation());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setType('AUDIT RGPD');
        	$log->setEntry($controle->getId());
        	$manager->persist($controle);
        	$manager->flush();
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	return $this->redirectToRoute('ctrlint_list', ['id' => $controle->getId()]);
    	}
	
        return $this->render('blog/controle_create.html.twig',[ 
        'formControle' => $form->createView(),
        'editMode' => $controle->getId() !== null,
        'controle' => $controle
        ]);
    }
    
    /**
	  * @route("/app/anomalie/new", name="anomalie_create")
	  * @route("/app/anomalie/edit/{id}", name="anomalie_edit")
	  */
    public function formAnomalie(Anomalie $anomalie = null, Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$anomalie) {
		    $anomalie = new Anomalie();
		    $anomalie->setCreatedAt(new \DateTime());
		    }
	    $form = $this->createForm(AnomalieType::class, $anomalie, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $anomalie->setPublishedAt(new \DateTime());
		    $anomalie->setUpdatedAt(new \DateTime());
		    $manager = $this->getDoctrine()->getManager();
		    $anomalie->setCustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le anomalie CTRL-'.$anomalie->getId().' '.$anomalie->getDesignation());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setType('AUDIT RGPD');
        	$log->setEntry($anomalie->getId());
        	$manager->persist($anomalie);
        	$manager->flush();
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	return $this->redirectToRoute('ctrlint_list', ['id' => $anomalie->getId()]);
    	}
	
        return $this->render('blog/anomalie_create.html.twig',[ 
        'formAnomalie' => $form->createView(),
        'editMode' => $anomalie->getId() !== null,
        'anomalie' => $anomalie
        ]);
    }
    

    
    
     
    
	  
		
	/**
	* @route("/app/flux/json/{id}", name="flux_json")
	*/
	  
	public function jsonflux(Flux $flux)
		{
			
			return $this->json(['pia'=>[
				'dbVersion'=>201910230914,
				'tableName'=>'pia',
				'serverUrl'=>null,
				'status'=>0,
				'is_example'=>0,
				'created_at'=>$flux->getCreatedAt(),
				'id'=>$flux->getid(),
				'objectStore'=>[],
				'name' => $flux->getdesignation(),
				'author_name' => $flux->getresponsable()->getfirstname().' '.$flux->getresponsable()->getlastname(),
				'evaluator_name'=>'',
				'validator_nam'=>'',
				'updated_at' => $flux->getPublishedAt(),
				'progress'=>0 ],
				'answers'=>
					[
						'pia_id'=>$flux->getid(),
						'reference_to'=>111,
						'data'=>
						[
							'text'=>$flux->getdescription(),
							'gauge'=>null,
							'list'=>[]
						],
						'created_at'=>$flux->getCreatedAt(),
						'id'=>222+2
					],
					'measures'=>[],
					'evaluations'=>[],
					'comments'=>[]
			], $status = 200, $headers = [], $context = []);
				
		}
	  
      
    
         /**
	  * @route("/app/risque/new", name="risque_create")
	  * @route("/app/risque/edit/{id}", name="risque_edit")
	  */
    public function formrisque(Risque $risque = null, Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$risque) {
			$risque = new Risque();
			$risque->setCreatedAt(new \DateTime());
		    }

	    $form = $this->createForm(RisqueType::class, $risque, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
			$risque->setPublishedAt(new \DateTime());
			$risque->setPublisher($this->getUser()->getpeople());
		    $manager = $this->getDoctrine()->getManager();
		    $risque->setCustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setType('Risque');
        	$log->setEntry($risque->getId());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le risque RI-'.$risque->getId().' '.$risque->getDesignation());

        	$manager->persist($risque);
        	$manager->flush();
        	 $this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	
        	return $this->redirectToRoute('risque_list', ['id' => $risque->getId()]);
    	}
	
        return $this->render('blog/risque_create.html.twig',[ 
        'formRisque' => $form->createView(),
        'editMode' => $risque->getId() !== null,
        'risque' => $risque
        ]);
    }
    
             /**
	  * @route("/app/axe/new", name="axe_create")
	  * @route("/app/axe/edit/{id}", name="axe_edit")
	  */
    public function formaxe(Axe $axe = null, Log $log = null, Request $request, ObjectManager $manager){
	    if(!$log) { $log = new Log(); }
	    if(!$axe) {
		    $axe = new Axe();
		    }

	    $form = $this->createForm(AxeType::class, $axe, array(
		'userCustomer' => $this->getUser()->getcustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    $axe->setPublishedAt(new \DateTime());
		    $manager = $this->getDoctrine()->getManager();
		    $axe->setCustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setType('Axe');
        	$log->setEntry($axe->getId());
        	$log->setCustomer($this->getUser()->getCustomer());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié l\'axe AX-'.$axe->getId().' '.$axe->getDesignation());

        	$manager->persist($axe);
        	$manager->flush();
        	 $this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	
        	return $this->redirectToRoute('axe_list', ['id' => $axe->getId()]);
    	}
	
        return $this->render('blog/axe_create.html.twig',[ 
        'formAxe' => $form->createView(),
        'editMode' => $axe->getId() !== null,
        'axe' => $axe
        ]);
    }
    

        
    
      /**
	  * @route("/app/mapsicustomer/edit/{id}", name="mapsicustomer_edit")
	  * @return Response
	  */
    public function formmapsicustomer(MapsiCustomer $mapsicustomer = null, Request $request, ObjectManager $manager){

		
	    $form = $this->createForm(MapsiCustomerType::class, $mapsicustomer, array(
			'userCustomer' => $this->getUser()->getcustomer(),
			));
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
		    
        	$manager->persist($mapsicustomer);
        	$manager->flush();
        	$this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	
        	return $this->redirectToRoute('start');    	}
        			
        return $this->render('blog/mapsicustomer_create.html.twig',[ 
        'formMapsiCustomer' => $form->createView(),
        'editMode' => $mapsicustomer->getId() !== null,
		'mapsicustomer' => $mapsicustomer,
        ]);
    }
    
    
   
    /**
	  * @route("/app/activite/remove/{id}", name="activite_remove")
	  */
    public function deleteactivite(Activite $activite, ActiviteRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
   	 {
	   	if(!$log) { $log = new Log(); }
	    $log->setUser($this->getUser());
        $log->setDate(new \DateTime());
        $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé l\'activité A-'.$activite->getId().' '.$activite->getDesignation());
        $log->setCustomer($this->getUser()->getCustomer());
        $log->setType('Activité');
        $manager->persist($activite);
	   	$manager->remove($activite);
	   	$manager->flush();
       
        $this->addFlash(
        		'success',
        		'L\'activité est supprimée'
        		);
       
	   	$activites = $repo->findAll();
	   	return $this->redirectToRoute('activite_list');    
	 }
	 
	   /**
	  * @route("/app/flux/remove/{id}", name="flux_remove")
	  */
    public function deleteflux(Flux $flux, FluxRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
   	 {
	   	if(!$log) { $log = new Log(); }
	    $log->setUser($this->getUser());
        $log->setDate(new \DateTime());
        $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé le flux FX-'.$flux->getId().' '.$flux->getDesignation());
        $log->setCustomer($this->getUser()->getCustomer());
        $log->setEntry($flux->getId());
        $log->setType('Flux');
        $manager->persist($log);
	   	$manager->remove($flux);
	   	$manager->flush();
       
        $this->addFlash(
        		'success',
        		'Le flux est supprimé'
        		);
       
	   	$fluxs = $repo->findAll();
	   	return $this->redirectToRoute('activite_list');    
	 }
    
     
    
    
    
     
    
     
    
     
    
    /**
	  * @route("/app/rgpd/access/remove/{id}", name="access_remove")
	  */
    public function deleteaccess( Request $request, RgpdAccess $access, RgpdAccessRepository $repo, Log $log = null, ObjectManager $manager)
   	 {
	   	if(!$log) { $log = new Log(); }
	    $log->setUser($this->getUser());
        $log->setDate(new \DateTime());
        $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé RGPD ACCESS-'.$access->getId().' '.$access->getDesignation());
        $log->setCustomer($this->getUser()->getCustomer());
        $log->setEntry($access->getId());
        $log->setType('RGPD ACCESS'); 
	   	$manager->remove($access);
	   	$manager->flush();
       
        $this->addFlash(
            'success',
            'Demande supprimée'
        );
       
	   $metiers = $repo->findAll();
	   	return $this->redirectToRoute('rgpd_list');
    }
    
     /**
	  * @route("/app/rgpd/violation/remove/{id}", name="violation_remove")
	  */
    public function deleteviolation( Request $request, RgpdViolation $violation, RgpdViolationRepository $repo, Log $log = null, ObjectManager $manager)
   	 {
	   	if(!$log) { $log = new Log(); }
	    $log->setUser($this->getUser());
        $log->setDate(new \DateTime());
        $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé RGPD VIO-'.$violation->getId().' '.$violation->getDesignation());
        $log->setCustomer($this->getUser()->getCustomer());
        $log->setEntry($violation->getId());
        $log->setType('RGPD VIOLATION'); 
	   	$manager->remove($violation);
	   	$manager->flush();
       
        $this->addFlash(
            'success',
            'Violation supprimée'
        );
       
	   	$metiers = $repo->findAll();
	   	return $this->redirectToRoute('rgpd_list');
    }
    
     
    
    
    
   

    
      /**
	  * @route("/app/risque/remove/{id}", name="risque_remove")
	  */
    public function deleterisque(Risque $risque, RisqueRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
   	 {
	   	$manager->remove($risque);
	   	$manager->flush();

        $this->addFlash(
            'success',
            'Le risque est supprimé'
        );
	   	$risques = $repo->findAll();
	   	return $this->redirectToRoute('risque_list');
    }
    
      /**
	  * @route("/app/axe/remove/{id}", name="axe_remove")
	  */
    public function deleteaxe(Axe $axe, AxeRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
   	 {
	   	$manager->remove($axe);
	   	$manager->flush();

        $this->addFlash(
            'success',
            'Axe supprimé'
        );
	   	$axes = $repo->findAll();
	   	return $this->redirectToRoute('axe_list');
    }
    

   
       
}
