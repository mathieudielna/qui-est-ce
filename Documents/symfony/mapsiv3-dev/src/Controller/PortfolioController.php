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
use App\Service\EmailService;
use Elastica\Aggregation\Avg;

class PortfolioController extends AbstractController
{
	/**
     * @var Registry
    */
    private $workflows;
    public function __construct(Registry $workflows)
    {
        $this->state_machines = $workflows;
	}

    
	
    // /**
    //  * @Route("/app/portfolio", name="portfolio_list")
    //  */
    // public function indexaction(ActionRepository $repoaction,
    // 							ProgramRepository $repoprogram, 
    // 							TypePrioriteRepository $repopriorite, 
    // 							TypeStatutRepository $repostatut,
    // 							ProjetRepository $repoprojet,
    // 							MetierRepository $repometier,
    // 							ProcessusRepository $repoprocessus,
    // 							JalonConnectActionRepository $repojalon,
    // 							TypePhaseRepository $repophase)
    // {	    
        
    //     $conformite ='Portfolio';
        
    // 	if ($this->isGranted('ROLE_ADMIN')) {
	//     	$actions = $repoaction->findBy(array('customer' => $this->getUser()->getCustomer(),'archive' => null));
	//     	$projets = $repoprojet->findByCustomer($this->getUser()->getCustomer());
	//     	$programs = $repoprogram->findByCustomer($this->getUser()->getCustomer());
	//     	$jalons = $repojalon->findByMcustomer($this->getUser()->getCustomer());
	// 	}
	// 	else
	//     {
	// 	    $actions = $repoaction->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
	// 	    $projets = $repoprojet->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
	// 	    $programs = $repoprogram->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
	// 	    $jalons = $repojalon->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
	// 	}		
	// 	$alljalons = $repojalon->findByMcustomer($this->getUser()->getCustomer());
	// 	$allactions = $repoaction->findBy(array('customer' => $this->getUser()->getCustomer(),'archive' => null));
	//     $allprojets = $repoprojet->findByCustomer($this->getUser()->getCustomer());
	//     $allprograms = $repoprogram->findByCustomer($this->getUser()->getCustomer());
	//     $priorites = $repopriorite->findByCustomer($this->getUser()->getCustomer());
	//     $metiers = $repometier->findByCustomer($this->getUser()->getCustomer());
	//     $processuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
	//     $statuts = $repostatut->findByCustomer($this->getUser()->getCustomer());
	//     $phases = $repophase->findByCustomer($this->getUser()->getCustomer());
    //     return $this->render('blog/portfolio_list.html.twig', [
    //         'controller_name' => 'BlogController',
    //         'actions' => $actions,
    //         'projets' => $projets,
    //         'programs' => $programs,
    //         'allactions' => $allactions,
    //         'allprojets' => $allprojets,
	// 		'allprograms' => $allprograms,
	// 		'alljalons' => $alljalons,
    //         'priorites' => $priorites,
    //         'metiers' => $metiers,
    //         'processuses' => $processuses,
    //         'statuts' => $statuts,
    //         'jalons' => $jalons,
    //         'phases' => $phases,
    //         'conformite' => $conformite
    //     ]);
    // }

    // /**
	//   * @route("/app/program/new", name="program_create")
	//   * @route("/app/program/edit/{id}", name="program_edit")
	//   */
    //   public function formprogram(Program $program = null, ProgramRepository $repoprogram, Log $log = null, Request $request, ObjectManager $manager){
	// 	$r=$_GET["r"];$rr=$_GET["rr"];
	// 	if(!$log) { $log = new Log(); }
	//     if(!$program) {
	// 		$program = new Program();
			
	// 	    }

	//     $form = $this->createForm(ProgramType::class, $program, array(
	// 	'userCustomer' => $this->getUser()->getCustomer(),
	// 	));
	    
	//     $form->handleRequest($request);
	    
	//     if($form->isSubmitted() && $form->isValid()){
	    
    //         $program->setPublishedAt(new \DateTime());
    //         $program->setPublisher($this->getUser()->getpeople());
	// 	    $program->setCustomer($this->getUser()->getCustomer());
	// 	    $log->setUser($this->getUser());
    //     	$log->setDate(new \DateTime());
    //     	$log->setType('Programme');
    //     	$log->setEntry($program->getId());
    //     	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le programme PROG-'.$program->getId().' '.$program->getDesignation());
    //     	$log->setCustomer($this->getUser()->getCustomer());
	// 	    $manager = $this->getDoctrine()->getManager();
	// 	    $manager->persist($log);
    //     	$manager->persist($program);
    //     	$manager->flush();
    //     	 $this->addFlash(
    //         'success',
    //         'Vos modifications sont enregistrées'
    //     );
        	
	// 		return $this->redirectToRoute('program_edit',[ 
	// 			'r' => $r,
	// 			'rr' => $rr,
	// 			'id' => $program->getId()
	// 			]);
    //     }
        
    //     if($this->isGranted('ROLE_ADMIN') OR !$program->getId() OR $repoprogram->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$program->getId()))
	// 	{
	// 		return $this->render('blog/program_create.html.twig',[ 
    //             'formProgram' => $form->createView(),
    //             'editMode' => $program->getId() !== null,
    //             'program' => $program,
    //             'r' => $r,
    //             'rr' => $rr
    //             ]);
	// 	}
	// 	else
	// 	{
	// 		$this->addFlash(
	// 			'warning',
	// 			'Vous n\'avez pas accès à ce programme'
	// 			);
	// 		return $this->redirectToRoute('portfolio_list');
	// 	}  	

    // }

    // /**
	//  * @route("/app/program/remove/{id}", name="program_remove")
	// */
    // public function deleteprogram(Program $program, ProgramRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
   	//  {
	//    	$manager->remove($program);
	//    	$manager->flush();

    //     $this->addFlash(
    //         'success',
    //         'Le programme est supprimé'
    //     );
	//    	$programs = $repo->findAll();
	//    	return $this->redirectToRoute('portfolio_list');
	// }
	
	/**
    * @route("/app/portfolio/programme/{id}/{statut}", name="program_workflow")
    * @param $statut
    * @param Program $program
    * @internal param Registry $workflows
    */
    public function wkprogram(Program $program, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    {
        $workflow = $this->state_machines->get($program);
        if($workflow->can($program, $statut)) {
            $manager = $this->getDoctrine()->getManager();
            $workflow->apply($program, $statut);
            $program->setValidatedAt(new \DateTime());
            $program->setValidator($this->getUser()->getpeople());
            $program->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
            
            $manager->persist($program);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre demande est transmise, merci"
                );
            $r=$_GET["r"];$rr=$_GET["rr"];
            return $this->redirectToRoute('program_edit',[ 
                'r' => $r,
                'rr' => $rr,
                'id' => $program->getId()
                ]);
        }
    }

    // /**
	//   * @route("/app/projet/new", name="projet_create")
	//   * @route("/app/projet/edit/{id}", name="projet_edit")
	// */
    // public function formprojet(Projet $projet = null, ProjetRepository $repoprojet, Log $log = null, Request $request, ObjectManager $manager){
	// 	$r=$_GET["r"];$rr=$_GET["rr"];
	// 	if(!$log) { $log = new Log(); }
	//     if(!$projet) {
	// 		$projet = new Projet();
	// 		$projet->addPeople($this->getUser()->getpeople());
	// 	    }

	//     $form = $this->createForm(ProjetType::class, $projet, array(
	// 	'userCustomer' => $this->getUser()->getCustomer(),
	// 	));
	    
	//     $form->handleRequest($request);
	    
	//     if($form->isSubmitted() && $form->isValid()){
		    
    //         $projet->setPublishedAt(new \DateTime());
    //         $projet->setPublisher($this->getUser()->getpeople());
	// 	    $projet->setCustomer($this->getUser()->getCustomer());
	// 	    $log->setUser($this->getUser());
    //     	$log->setDate(new \DateTime());
    //     	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le projet PROJ-'.$projet->getId().' '.$projet->getDesignation());
    //     	$log->setCustomer($this->getUser()->getCustomer());
    //     	$log->setType('Projet');
    //     	$log->setEntry($projet->getId());
	// 	    $manager = $this->getDoctrine()->getManager();
	// 	    $manager->persist($log);
    //     	$manager->persist($projet);
    //     	$manager->flush();
    //     	 $this->addFlash(
    //         'success',
    //         'Vos modifications sont enregistrées'
    //     );
        	
	// 	return $this->redirectToRoute('projet_edit',[ 
	// 		'r' => $r,
	// 		'rr' => $rr,
	// 		'id' => $projet->getId()
	// 		]);
    //     }
        
    //     if($this->isGranted('ROLE_ADMIN') OR !$projet->getId() OR $repoprojet->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$projet->getId()))
	// 	{
	// 		return $this->render('blog/projet_create.html.twig',[ 
    //             'formProjet' => $form->createView(),
    //             'editMode' => $projet->getId() !== null,
    //             'projet' => $projet,
    //             'r' => $r,
    //             'rr' => $rr
    //             ]);
	// 	}
	// 	else
	// 	{
	// 		$this->addFlash(
	// 			'warning',
	// 			'Vous n\'avez pas accès à ce projet'
	// 			);
	// 		return $this->redirectToRoute('portfolio_list');
	// 	}  	
        
    // }

    // /**
	//   * @route("/app/projet/remove/{id}", name="projet_remove")
	// */
    // public function deleteprojet(Projet $projet, ProjetRepository $repo, Request $request, Log $log = null, ObjectManager $manager)
    // {
    //      $manager->remove($projet);
    //      $manager->flush();

    //   $this->addFlash(
    //       'success',
    //       'Projet supprimé'
    //   );
    //      $projet = $repo->findAll();
    //      return $this->redirectToRoute('portfolio_list');
	// } 
	
	// /**
    // * @route("/app/portfolio/projet/{id}/{statut}", name="projet_workflow")
    // * @param $statut
    // * @param Projet $projet
    // * @internal param Registry $workflows
    // */
    // public function wkprojet(Projet $projet, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    // {
    //     $workflow = $this->state_machines->get($projet);
    //     if($workflow->can($projet, $statut)) {
    //         $manager = $this->getDoctrine()->getManager();
    //         $workflow->apply($projet, $statut);
    //         $projet->setValidatedAt(new \DateTime());
    //         $projet->setValidator($this->getUser()->getpeople());
    //         $projet->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
            
    //         $manager->persist($projet);
    //         $manager->flush();

    //         $this->addFlash(
    //             'success',
    //             "Votre demande est transmise, merci"
    //             );
    //         $r=$_GET["r"];$rr=$_GET["rr"];
    //         return $this->redirectToRoute('projet_edit',[ 
    //             'r' => $r,
    //             'rr' => $rr,
    //             'id' => $projet->getId()
    //             ]);
    //     }
    // }

    // /**
	//   * @route("/app/action/new", name="action_create")
	//   * @route("/app/action/edit/{id}", name="action_edit")
	// */
    // public function formaction(Action $action = null, JalonConnectActionRepository $repojalon, TypeConformiteRepository $repoconform, ActionRepository $repoaction, Log $log = null, Request $request, ObjectManager $manager){
	// 	$r=$_GET["r"];$rr=$_GET["rr"];
	// 	if(!$log) { $log = new Log(); }
	//     if(!$action) {
	// 		$action = new Action();
	// 		$action->addPerson($this->getUser()->getpeople());
	// 		$conformite = $repoconform->findOneBy(array('customer' => $this->getUser()->getCustomer(),'designation' => $rr));
	// 		if($conformite){$action->addTypeconformite($conformite);}
	// 	    }

	//     $form = $this->createForm(ActionType::class, $action, array(
	// 	'userCustomer' => $this->getUser()->getcustomer(),
	// 	));
	    
	//     $form->handleRequest($request);
	    
	//     if($form->isSubmitted() && $form->isValid()){

	// 		$code='X';
	// 		$datedebut = array(); foreach ($action->getjalonConnectActions() as $formChild){$datedebut[] = $formChild->getDatedebut(); $code='A';} if ($code=='A') {$mindatedebut=min($datedebut); $action->setdatedebut($mindatedebut);}
	// 		$datefin = array(); foreach ($action->getjalonConnectActions() as $formChild){$datefin[] = $formChild->getDate();$code='A';} if ($code=='B') {$mindatefin=max($datefin); $action->setdatefin($mindatefin);}
	// 		$daterevue = array(); foreach ($action->getjalonConnectActions() as $formChild){$daterevue[] = $formChild->getDaterevue();$code='C';} if ($code=='C') {$mindatefinrevue=max($daterevue); $action->setdatefinrevue($mindatefinrevue);}
    //      $progression = array(); foreach ($action->getjalonConnectActions() as $formChild){$progression[] = $formChild->getProgression();$code='D';} if ($code=='D') {$progsum=array_sum($progression); $progcount=count($progression); $prog=$progsum/$progcount; $action->setprogression($prog);}

//         $action->setPublishedAt(new \DateTime());
//         $action->setPublisher($this->getUser()->getpeople());
	// 	    $action->setCustomer($this->getUser()->getCustomer());
	// 	    $log->setUser($this->getUser());
    //     	$log->setDate(new \DateTime());
    //     	$log->setType('Action');
    //     	$log->setEntry($action->getId());
    //     	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié l\'action ACT-'.$action->getId().' '.$action->getDesignation());
    //     	$log->setCustomer($this->getUser()->getCustomer());
	// 	    $manager = $this->getDoctrine()->getManager();
	// 	    $manager->persist($log);
    //     	$manager->persist($action);
    //     	$manager->flush();
    //     	 $this->addFlash(
    //         'success',
    //         'Vos modifications sont enregistrées'
    //     );
        	
	// 		return $this->redirectToRoute('action_edit',[ 
	// 			'r' => $r,
	// 			'rr' => $rr,
	// 			'id' => $action->getId()
	// 			]);
    //     }
		
    //     if($this->isGranted('ROLE_ADMIN') OR !$action->getId() OR $repoaction->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$action->getId()))
	// 	{
    //         return $this->render('blog/action_create.html.twig',[ 
    //             'formAction' => $form->createView(),
    //             'editMode' => $action->getId() !== null,
    //             'action' => $action,
    //             'r' => $r,
    //             'rr' => $rr
    //             ]);
	// 	}
	// 	else
	// 	{
	// 		$this->addFlash(
	// 			'warning',
	// 			'Vous n\'avez pas accès à cette action'
	// 			);
	// 		return $this->redirectToRoute('portfolio_list');
	// 	}  	

	
    // }

    // /**
	//   * @route("/app/action/remove/{id}", name="action_remove")
	// */
    //   public function deleteaction(Action $action, ActionRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
    //   {
    //      $manager->remove($action);
    //      $manager->flush();

    //   $this->addFlash(
    //       'success',
    //       'L\'action est supprimée'
    //   );
    //      $actions = $repo->findAll();
    //      return $this->redirectToRoute('portfolio_list');
	// }
	

    // /**
    // * @route("/app/portfolio/action/{id}/{statut}", name="action_workflow")
    // * @param $statut
    // * @param Action $action
    // * @internal param Registry $workflows
    // */
    // public function toReview(Action $action, $statut, ObjectManager $manager, EmailService $emailservice)
    // {
    //     $r=$_GET["r"];$rr=$_GET["rr"];
    //        $workflow = $this->state_machines->get($action);
    //     if($workflow->can($action, $statut)) {
    //         $manager = $this->getDoctrine()->getManager();
    //         $workflow->apply($action, $statut);
    //         $action->setValidatedAt(new \DateTime());
    //         $action->setValidator($this->getUser()->getpeople());
    //         $action->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
            
    //         $manager->persist($action);
    //         $manager->flush();
    //         $this->addFlash(
    //             'success',
    //             "L\'action est passée a l\'état ".$action->getStatut()
    //             );

    //         if (($action->getStatut() == 'rejected' || $action->getStatut() == 'draft' ) && $action->getResponsable() && $action->getResponsable()->getEmail()) {
    //             $this->addFlash('success', 'Une notification est envoyée à '.$action->getResponsable()->getFirstname().' '.$action->getResponsable()->getLastname());
    //             $emailservice->sendEmail($action->getResponsable()->getFirstname(), $action->getDesignation(),$action->getResponsable()->getEmail(),'mise à jour','action_edit',$action->getSlug(), $action->getId(), $r, $rr, 'L\'action',$this->getUser()->getCustomer()->getDesignation());
    //         }
    //         elseif (($action->getStatut() == 'pre_running' && $action->getProjet()->getResponsable() && $action->getProjet()->getResponsable()->getEmail())) {
    //             $this->addFlash('success', 'Une notification est envoyée à '.$action->getProjet()->getResponsable()->getFirstname().' '.$action->getProjet()->getResponsable()->getLastname());
    //             $emailservice->sendEmail($action->getProjet()->getResponsable()->getFirstname(), $action->getDesignation(),$action->getProjet()->getResponsable()->getEmail(),'validation','action_edit',$action->getSlug(), $action->getId(), $r, $rr, 'L\'action',$this->getUser()->getCustomer()->getDesignation());
    //         }
    //         elseif (($action->getStatut() == 'running' && $action->getResponsable() && $action->getResponsable()->getEmail())) {
    //             $this->addFlash('success', 'Une notification est envoyée à '.$action->getResponsable()->getFirstname().' '.$action->getResponsable()->getLastname());
    //             $emailservice->sendEmail($action->getResponsable()->getFirstname(), $action->getDesignation(),$action->getResponsable()->getEmail(),'validation pour son démarrage','action_edit',$action->getSlug(), $action->getId(), $r, $rr, 'L\'action',$this->getUser()->getCustomer()->getDesignation());
    //         }
    //         elseif (($action->getStatut() == 'validation')) {
    //             $this->addFlash('success', 'Une notification est envoyée à '.$action->getProjet()->getResponsable()->getFirstname().' '.$action->getProjet()->getResponsable()->getLastname());
    //             $emailservice->sendEmail($action->getProjet()->getResponsable()->getFirstname(), $action->getProjet()->getDesignation(),$action->getProjet()->getResponsable()->getEmail(),'validation pour clôture','action_edit',$action->getSlug(), $action->getId(), $r, $rr, 'L\'action',$this->getUser()->getCustomer()->getDesignation());
    //         }
    //         elseif (($action->getStatut() == 'validation_ok' && $action->getResponsable() && $action->getResponsable()->getEmail())) {
    //             $this->addFlash('success', 'Une notification est envoyée à '.$action->getResponsable()->getFirstname().' '.$action->getResponsable()->getLastname());
    //         }
    //         else
    //         {
    //             $this->addFlash('warning', 'L\'état de l\'action est modifié, mais la notification est impossible car les rôles ou les emails ne sont pas renseignés');
    //         }
          
            
            
    //         return $this->redirectToRoute('action_edit',[ 
    //             'r' => $r,
    //             'rr' => $rr,
    //             'id' => $action->getId()
    //             ]);
    //     }
    // }
  
    /**
    * @route("/app/action/archive/{id}", name="action_archive")
    */
    public function archiveaction(Action $action = null, ActionRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
    {
         $this->denyAccessUnlessGranted('ROLE_ADMIN');
         
         $action->setArchive(1);
         
         $manager->persist($action);
      $manager->flush();

      $this->addFlash(
          'success',
          'L\'action est archivée'
      );
         $actions = $repo->findAll();
         return $this->redirectToRoute('portfolio_list');
    }

    /**
	  * @route("/app/tache/new", name="tache_create")
	  * @route("/app/tache/edit/{id}", name="tache_edit")
	  */
      public function formtache(JalonConnectAction $tache = null, JalonConnectActionRepository $repotache, Log $log = null, ActionRepository $repoaction, Request $request, ObjectManager $manager){
		$r=$_GET["r"];$rr=$_GET["rr"];
		if(!$log) { $log = new Log(); }
	    if(!$tache) {
			$tache = new JalonConnectAction();
			$tache->addPeople($this->getUser()->getpeople());
		    }

	    $form = $this->createForm(JalonConnectActionType::class, $tache, array(
		'userCustomer' => $this->getUser()->getCustomer(),
		));
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){

            $tache->setPublishedAt(new \DateTime());
            $tache->setPublisher($this->getUser()->getpeople());
		    $tache->setMcustomer($this->getUser()->getCustomer());
		    $log->setUser($this->getUser());
        	$log->setDate(new \DateTime());
        	$log->setType('Tache');
        	$log->setEntry($tache->getId());
        	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié la tâche T-'.$tache->getId().' '.$tache->getJalon());
        	$log->setCustomer($this->getUser()->getCustomer());
		    $manager = $this->getDoctrine()->getManager();
		    $manager->persist($log);
        	$manager->persist($tache);
        	$manager->flush();
        	 $this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
        );
        	
			return $this->redirectToRoute('tache_edit',[ 
				'r' => $r,
				'rr' => $rr,
				'id' => $tache->getId()
				]);
    	}
    
        if($this->isGranted('ROLE_ADMIN') OR !$tache->getId() OR $repotache->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$tache->getId()))
		{
			return $this->render('blog/tache_create.html.twig',[ 
                'formTache' => $form->createView(),
                'editMode' => $tache->getId() !== null,
                'tache' => $tache,
                'r' => $r,
                'rr' => $rr
                ]);
		}
		else
		{
			$this->addFlash(
				'warning',
				'Vous n\'avez pas accès à cet élément'
				);
			return $this->redirectToRoute('portfolio_list');
		}  

        
	}

	/**
	  * @route("/app/tache/remove/{id}", name="tache_remove")
	*/
	public function deletetache(JalonConnectAction $tache,  JalonConnectActionRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
	{
	   $manager->remove($tache);
	   $manager->flush();

	$this->addFlash(
		'success',
		'La tâche est supprimée'
	);
	   return $this->redirectToRoute('portfolio_list');
  	}


    /**
    * @route("/app/portfolio/tache/{id}/{statut}", name="tache_workflow")
    * @param $statut
    * @param JalonConnectAction $tache
    * @internal param Registry $workflows
    */
    public function wktache(JalonConnectAction $tache, $statut, ObjectManager $manager, EmailService $emailservice)
    {
        $r=$_GET["r"];$rr=$_GET["rr"];
        $workflow = $this->state_machines->get($tache);
        if($workflow->can($tache, $statut)) {
            $manager = $this->getDoctrine()->getManager();
            $workflow->apply($tache, $statut);
            $tache->setValidatedAt(new \DateTime());
            $tache->setValidator($this->getUser()->getpeople());
            $tache->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
            
            $manager->persist($tache);
            $manager->flush();
            $this->addFlash(
                'success',
                "La tâche est passée a l\'état ".$tache->getStatut()
                );

            if (($tache->getStatut() == 'rejected' || $tache->getStatut() == 'draft' ) && $tache->getResponsable() && $tache->getResponsable()->getEmail()) {
                $this->addFlash('success', 'Une notification est envoyée à '.$tache->getResponsable()->getFirstname().' '.$tache->getResponsable()->getLastname());
                $emailservice->sendEmail($tache->getResponsable()->getFirstname(), $tache->getJalon(),$tache->getResponsable()->getEmail(),'mise à jour','tache_edit',$tache->getSlug(), $tache->getId(), $r, $rr, 'La tâche',$this->getUser()->getCustomer()->getDesignation());
            }
            elseif (($tache->getStatut() == 'pre_running' && $tache->getAction()->getResponsable() && $tache->getAction()->getResponsable()->getEmail())) {
                $this->addFlash('success', 'Une notification est envoyée à '.$tache->getAction()->getResponsable()->getFirstname().' '.$tache->getAction()->getResponsable()->getLastname());
                $emailservice->sendEmail($tache->getAction()->getResponsable()->getFirstname(), $tache->getJalon(),$tache->getAction()->getResponsable()->getEmail(),'validation','tache_edit',$tache->getSlug(), $tache->getId(), $r, $rr, 'La tâche',$this->getUser()->getCustomer()->getDesignation());
            }
            elseif (($tache->getStatut() == 'running' && $tache->getResponsable() && $tache->getResponsable()->getEmail())) {
                $this->addFlash('success', 'Une notification est envoyée à '.$tache->getResponsable()->getFirstname().' '.$tache->getResponsable()->getLastname());
                $emailservice->sendEmail($tache->getResponsable()->getFirstname(), $tache->getJalon(),$tache->getResponsable()->getEmail(),'action','tache_edit',$tache->getSlug(), $tache->getId(), $r, $rr, 'La tâche',$this->getUser()->getCustomer()->getDesignation());
            }
            elseif (($tache->getStatut() == 'validation')) {
                $this->addFlash('success', 'Une notification est envoyée à '.$tache->getAction()->getResponsable()->getFirstname().' '.$tache->getAction()->getResponsable()->getLastname());
                $emailservice->sendEmail($tache->getAction()->getResponsable()->getFirstname(), $tache->getAction()->getDesignation(),$tache->getAction()->getResponsable()->getEmail(),'validation pour clôture','tache_edit',$tache->getSlug(), $tache->getId(), $r, $rr, 'La tâche',$this->getUser()->getCustomer()->getDesignation());
            }
            elseif (($tache->getStatut() == 'validation_ok' && $tache->getResponsable() && $tache->getResponsable()->getEmail())) {
                $this->addFlash('success', 'Une notification est envoyée à '.$tache->getResponsable()->getFirstname().' '.$tache->getResponsable()->getLastname());
            }
            else
            {
                $this->addFlash('warning', 'L\'état de la tâche est modifié, mais la notification est impossible car les rôles ou les emails ne sont pas renseignés');
            }
            
            return $this->redirectToRoute('tache_edit',[ 
                'r' => $r,
                'rr' => $rr,
                'id' => $tache->getId()
                ]);
        }
    }
 
}
