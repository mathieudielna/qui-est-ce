<?php

namespace App\Controller;


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
use App\Entity\Audit;
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
use App\Entity\AspectEnv;
use App\Entity\Controle;
use App\Entity\Pca;
use App\Entity\TypeStatutRisque;
use App\Entity\TypeRisque;
use App\Entity\Objectif;
use App\Entity\Reclamation;
use App\Entity\Dysfonctionnement;
use App\Entity\VisiteSite;




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
use Symfony\Component\Workflow\WorkflowInterface;
use App\Repository\TypeAspectEnvRepository;
use App\Repository\DysfonctionnementRepository;
use App\Repository\AuditRepository;
use App\Repository\AspectEnvRepository;
use App\Repository\VisiteSiteRepository;
use App\Repository\ReclamationRepository;


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

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
use App\Service\EmailService;
use App\Service\WorkflowService;
use Symfony\Component\Templating\EngineInterface;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Omines\DataTablesBundle\Adapter\AbstractAdapter;
use Omines\DataTablesBundle\Adapter\AdapterQuery;
use Omines\DataTablesBundle\Adapter\Doctrine\Event\ORMAdapterQueryEvent;
use Omines\DataTablesBundle\Adapter\Doctrine\ORM\AutomaticQueryBuilder;
use Omines\DataTablesBundle\Adapter\Doctrine\ORM\QueryBuilderProcessorInterface;
use Omines\DataTablesBundle\Adapter\Doctrine\ORM\SearchCriteriaProvider;
use Omines\DataTablesBundle\Column\AbstractColumn;
use Omines\DataTablesBundle\DataTableState;
use Omines\DataTablesBundle\Exception\InvalidConfigurationException;
use Omines\DataTablesBundle\Exception\MissingDependencyException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProcessController extends AbstractController
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
     * @route("/app/external", name="externalswitch")
     */
    public function indexexternal(Request $request, ActiviteRepository $repoactivite,ProcessusRepository $repoprocessus,ObjetMetierRepository $repoom, FluxRepository $repoflux)
    {   
        $domid = $request->query->get('domid');
        $entite = $request->query->get('entite');
        $domaine = $request->query->get('domaine');
        $trans = $request->query->get('trans');
        $tdb = $request->query->get('tdb');
        $id = $request->query->get('id');
        return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => $entite, 'domaine'=>$domaine, 'trans'=>$trans, 'tdb'=>$tdb, 'id'=>$id]);
    }
    

    /**
    * @route("/app/{domid}/tdb/{entite}", name="routerswitch")
    */
    public function wkswitch($domid, $entite, Request $request, ObjectManager $manager, \Swift_Mailer $mailer,
                            DysfonctionnementRepository $repodysfonctionnement, 
                            ObjectifRepository $repoobjectif, 
                            VisiteSiteRepository $repovisite, 
                            AspectEnvRepository $repoaspectenv, 
                            AuditRepository $repoaudit,
                            ReclamationRepository $reporeclamation,
                            TypeAspectEnvRepository $repotypeaspectenv, 
                            SiteRepository $reposite, 
    						MetierRepository $repometier,
    						PeopleRepository $repopeople,
    						ProcessusRepository $repoprocessus,
    						ActiviteRepository $repoactivite,
    						FluxRepository $repoflux,
    						ActionRepository $repoaction,
    						TypeConformiteRepository $repoconformite,
    						MapsiCustomerRepository $repocustomer,
    						ProjetRepository $repoprojet,
    						JalonConnectActionRepository $repojalon,
    						ObjetMetierRepository $repoom,
    						TierRepository $repotier,
    						RessourceRepository $reporessource,
    						SystemeRepository $reposysteme,
    						ApplicationRepository $repoappli,
							ProgramRepository $repoprogram,
							RisqueRepository $reporisque,
							RgpdAccessRepository $reporgpdaccess,
							RgpdViolationRepository $reporgpdviolation,
							AnomalieRepository $repoanomalie,
							TypeStatutRisqueRepository $repostatutrisque,
                            ActiviteRepository $repo,
                            TypeDcpJuridiqueRepository $repodcpjur, 
                            RgpdAccessRepository $repoaccess,
                            ApplicationRepository $repoapplication, 
                            TypeTraitementrgpdRepository $repotypetraitement, 
                            TypeActeurRepository $repotypeacteur, 
                            TypeDcpsensibleRepository $repodcpsensible, 
                            ApplicationRepository $repoapp)
    {   
        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));

        $actions = $repoaction->findAllConformite($this->getUser()->getCustomer(),$conformite);
        $audits = $repoaudit->findAllConformite($this->getUser()->getCustomer(),$conformite);
        $visites = $repovisite->findAllConformite($this->getUser()->getCustomer(),$conformite);
        $dysfonctionnements = $repodysfonctionnement->findAllConformite($this->getUser()->getCustomer(),$conformite);
        $objectifs = $repoobjectif->findAllConformite($this->getUser()->getCustomer(),$conformite);
        $reclamations = $reporeclamation->findAllConformite($this->getUser()->getCustomer(),$conformite);
        $aspectenvs = $repoaspectenv->findAll($this->getUser()->getCustomer());
        $typeaspectenvs = $repotypeaspectenv->findAll($this->getUser()->getCustomer());
        $activites = $repoactivite->findByCustomer($this->getUser()->getCustomer());
        $processuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
        $fluxs = $repoflux->findByCustomer($this->getUser()->getCustomer());
        $objetmetiers = $repoom->findByCustomer($this->getUser()->getCustomer());
        $allobjetmetiers = $repoom->findByCustomer($this->getUser()->getCustomer());
        $allfluxs = $repoflux->findByCustomer($this->getUser()->getCustomer());
        $allprocessuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
        $allactivites = $repoactivite->findByCustomer($this->getUser()->getCustomer());
        $allsites = $reposite->findByCustomer($this->getUser()->getCustomer());
		$sites = $reposite->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
	    $metiers = $repometier->findByCustomer($this->getUser()->getCustomer());
	    $peoples = $repopeople->findByCustomer($this->getUser()->getCustomer());
		$processuses = $repoprocessus->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		$allprocessuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
		$activites = $repoactivite->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		$allactions = $repoaction->findBy(array('customer' => $this->getUser()->getCustomer(),'archive' => null));
		$typeconformites = $repoconformite->findByCustomer($this->getUser()->getCustomer());
		$statutrisques = $repostatutrisque->findByCustomer($this->getUser()->getCustomer());
		$projets = $repoprojet->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
	    $programs = $repoprogram->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		$allprojets = $repoprojet->findByCustomer($this->getUser()->getCustomer());
	    $allprograms = $repoprogram->findByCustomer($this->getUser()->getCustomer());
		$objetmetiers = $repoom->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		$allobjetmetiers = $repoom->findByCustomer($this->getUser()->getCustomer());
		$tiers = $repotier->findByCustomer($this->getUser()->getCustomer());
		$ressources = $reporessource->findByCustomer($this->getUser()->getCustomer());
		$allsystemes = $reposysteme->findByCustomer($this->getUser()->getCustomer());
		$systemes = $reposysteme->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		$allapplications= $repoappli->findByCustomer($this->getUser()->getCustomer());
		$applications= $repoappli->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		$alljalons = $repojalon->findByMcustomer($this->getUser()->getCustomer());
		$jalons = $repojalon->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
		$customer = $repocustomer->findById($this->getUser()->getCustomer());
		$risques = $reporisque->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople(), $conformite);
        
		$allrisques = $reporisque->findAllConformite($this->getUser()->getCustomer(),$conformite);
		$accesses = $reporgpdaccess->findByCustomer($this->getUser()->getCustomer());
		$violations = $reporgpdviolation->findByCustomer($this->getUser()->getCustomer());
		$allfluxes = $repoflux->findByCustomer($this->getUser()->getCustomer());
		$fluxes = $repoflux->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
        $allaccesses = $repoaccess->findByCustomer($this->getUser()->getCustomer());
	    $allfluxs = $repoflux->findByCustomer($this->getUser()->getCustomer());
	    $activites = $repo->findByCustomer($this->getUser()->getCustomer());
	    $allobjetmetiers = $repoom->findByCustomer($this->getUser()->getCustomer());
	    $processuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
	    $dcpjuridiques = $repodcpjur->findByCustomer($this->getUser()->getCustomer());
	    $allactions = $repoaction->findByCustomer($this->getUser()->getCustomer());
	    $applications = $repoapplication->findByCustomer($this->getUser()->getCustomer());
		$allrisques = $reporisque->findByCustomer($this->getUser()->getCustomer());
	    $allaudits = $repoaudit->findByCustomer($this->getUser()->getCustomer());
	    $typeconformites = $repoconformite->findByCustomer($this->getUser()->getCustomer());
	    $typetraitements = $repotypetraitement->findByCustomer($this->getUser()->getCustomer());
	    $typeacteurs = $repotypeacteur->findByCustomer($this->getUser()->getCustomer());
	    $typedcpsensibles = $repodcpsensible->findByCustomer($this->getUser()->getCustomer());
	    $apps = $repoapp->findByCustomer($this->getUser()->getCustomer());
	    $metiers = $repometier->findByCustomer($this->getUser()->getCustomer());
        if ($request->isXmlHttpRequest()) {
            $renderpage = 'tdb/'.$entite.'.html.twig';
            $response = new JsonResponse(
                array(
                    'message' => 'Success',
                    'output' => $this->renderView($renderpage,array(
                        'actions' => $actions,
                        'audits' => $audits,
                        'visites' => $visites,
                        'dysfonctionnements' => $dysfonctionnements,
                        'aspectenvs' => $aspectenvs,
                        'objectifs' => $objectifs,
                        'conformite' => $confo,
                        'typeaspectenvs' => $typeaspectenvs,
                        'reclamations' => $reclamations,
                        'processuses' => $processuses,
                        'allprocessuses' => $allprocessuses,
                        'activites' => $activites,
                        'allactivites' => $allactivites,
                        'objetmetiers' => $objetmetiers,
                        'allobjetmetiers' => $allobjetmetiers,
                        'allfluxs' => $allfluxs,
                        'fluxs' => $fluxs,
                        'sites' => $sites,
                        'allsites' => $allsites,
                        'metiers' => $metiers,
                        'peoples' => $peoples,
                        'processuses' => $processuses,
                        'allprocessuses' => $allprocessuses,
                        'activites' => $activites,
                        'allactivites' => $allactivites,
                        'fluxes' => $fluxes,
                        'actions' => $actions,
                        'allactions' => $allactions,
                        'allprojets' => $allprojets,
                        'allprograms' => $allprograms,
                        'projets' => $projets,
                        'programs' => $programs,
                        'jalons' => $jalons,
                        'alljalons' => $alljalons,
                        'customer' => $customer,
                        'objetmetiers' => $objetmetiers,
                        'allobjetmetiers' => $allobjetmetiers,
                        'tiers' => $tiers,
                        'ressources' => $ressources,
                        'systemes' => $systemes,
                        'allsystemes' => $allsystemes,
                        'applications' => $applications,
                        'allapplications' => $allapplications,
                        'typeconformites' => $typeconformites,
                        'risques' => $risques,
                        'allrisques' => $allrisques,
                        'violations' => $violations,
                        'accesses' => $accesses,
                        'allfluxes' => $allfluxes,
                        'statutrisques' => $statutrisques,
                        'typepage' => 'home',
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
                    )
                    )), 200);              
            return $response;
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => $entite, 'domaine'=>'', 'trans'=>'', 'tdb'=>'oui']);
        }
    

    }

    /**
     * @Route("/app/where", name="switch")
     */
    public function indexprocesslist(Request $request, ActiviteRepository $repoactivite,ProcessusRepository $repoprocessus,ObjetMetierRepository $repoom, FluxRepository $repoflux)
    {   
        $confo = 'Process';

        $allobjetmetiers = $repoom->findByCustomer($this->getUser()->getCustomer());
        $allfluxs = $repoflux->findByCustomer($this->getUser()->getCustomer());
        $allprocessuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
        $allactivites = $repoactivite->findByCustomer($this->getUser()->getCustomer());
        
        if ($this->isGranted('ROLE_ADMIN')) {
            $activites = $repoactivite->findByCustomer($this->getUser()->getCustomer());
            $processuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
            $fluxs = $repoflux->findByCustomer($this->getUser()->getCustomer());
            $objetmetiers = $repoom->findByCustomer($this->getUser()->getCustomer());
        }
        else
        {
            $activites = $repoactivite->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople()); 
            $objetmetiers = $repoom->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
            $processuses = $repoprocessus->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
            $fluxs = $repoflux->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
        }
   

        return $this->render('blog/process_list.html.twig', [
            'controller_name' => 'BlogController',
            'processuses' => $processuses,
            'allprocessuses' => $allprocessuses,
            'activites' => $activites,
            'allactivites' => $allactivites,
            'objetmetiers' => $objetmetiers,
            'allobjetmetiers' => $allobjetmetiers,
            'allfluxs' => $allfluxs,
            'fluxs' => $fluxs,
            'conformite' => $confo
            
        ]);
    }

    

    // /**
    //  * @Route("/app/ap", name="process_alist")
    //  * @internal param Registry $workflows
    //  * @param Processus $processus
    //  */
    // public function indexap(Request $request, ActiviteRepository $repoactivite,ProcessusRepository $repoprocessus,ObjetMetierRepository $repoom, FluxRepository $repoflux)
    // {   
    //     if ($this->isGranted('ROLE_ADMIN')) {
    //         $processuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
    //     }
    //     else
    //     {
    //         $processuses = $repoprocessus->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
    //     }
    //     $processusesjson = array();

    //     foreach($processuses as $processus) {
    //         if ($processus->getResponsable()) {$responsable=$processus->getResponsable()->getFirstname().' '.$responsable=$processus->getResponsable()->getLastname();}
    //         else {$responsable="";}
    //         if ($processus->getSuppleant()) {$suppleant=$processus->getSuppleant()->getFirstname().' '.$suppleant=$processus->getSuppleant()->getLastname();}
    //         else {$suppleant="";}
    //         if ($processus->getTypeprocessus()) {$type=$processus->getTypeprocessus()->getDesignation();}
    //         else {$type="";}

    //         $relationactivite ='';$relationactivite1 = '';$relationactivite2 = ''; if (count($processus->getActivites()) >= 1) {
    //             $relationactivite1 = '';
    //             $relationactivite ='
    //             <span class="dropdown tablerelation">
    //                     <button class="btn btn-outline-primary dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                        <i class="bi bi-bezier tablerelation icon"></i> <strong class="tablerelation">'.count($processus->getActivites()).'</strong>
    //                     </button>
    //                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    //                         <h4 class="tablerelation"> Activités</h4>';
    //                         foreach($processus->getActivites() as $act ) 
    //                         {$relationactivite1 .='<a class="dropdown-item" onclick="crossEntity('.$act->getId().',\'activite\')">'.$act->getDesignation().'</a>';}
    //             $relationactivite2 = '</div></span>';
    //             }
    //         $relationobjectif ='';$relationobjectif1 = '';$relationobjectif2 = '';  if (count($processus->getObjectifs()) >= 1) {
    //             $relationobjectif1 = '';
    //             $relationobjectif ='
    //             <span class="dropdown tablerelation">
    //                     <button class="btn btn-outline-primary dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                     <i class="bi bi-graph-up tablerelation icon"></i> <strong class="tablerelation">'.count($processus->getObjectifs()).'</strong>
    //                     </button>
    //                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    //                         <h4 class="tablerelation"> Activités</h4>';
    //                         foreach($processus->getObjectifs() as $obj ) 
    //                         {$relationobjectif1 .='<a class="dropdown-item">'.$obj->getDesignation().'</a>';}
    //             $relationobjectif2 = '</div></span>';
    //             }
    //             $relationaction ='';$relationaction1 = '';$relationaction2 = ''; if (count($processus->getActions()) >= 1) {
    //             $relationaction1 = '';
    //             $relationaction ='
    //             <span class="dropdown tablerelation">
    //                     <button class="btn btn-outline-primary dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                     <i class="bi bi-kanban tablerelation icon"></i> <strong class="tablerelation">'.count($processus->getActions()).'</strong>
    //                     </button>
    //                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    //                         <h4 class="tablerelation"> Actions</h4>';
    //                         foreach($processus->getActions() as $action ) 
    //                         {$relationaction1 .='<a class="dropdown-item">'.$action->getDesignation().'</a>';}
    //             $relationaction2 = '</div></span>';
    //             }
    //             $relationrisque ='';$relationrisque1 = '';$relationrisque2 = ''; if (count($processus->getRisques()) >= 1) {
    //             $relationrisque1 = '';
    //             $relationrisque ='
    //             <span class="dropdown tablerelation">
    //                     <button class="btn btn-outline-danger dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                     <i class="bi bi-exclamation-circle tablerelation icon"></i> <strong class="tablerelation">'.count($processus->getRisques()).'</strong>
    //                     </button>
    //                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    //                         <h4 class="tablerelation"> Risques</h4>';
    //                         foreach($processus->getRisques() as $ri ) 
    //                         {$relationrisque1 .='<a class="dropdown-item">'.substr($ri->getDesignation(), 0, 25).'...</a>';}
    //             $relationrisque2 = '</div></span>';
    //             }

    //         $processusesjson[] = array(
    //             'select' => '',
    //             'statut' => '<span class="badge"><strong>'.$processus->getStatut().'</strong></span>',
    //             'designation' => '<a onclick="crossEntity('.$processus->getId().',\'processus\')">'.$processus->getDesignation().'</a>',
    //             'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
    //             'type' => $type,
    //             'relation' => 
    //             $relationactivite.' '. $relationactivite1.' '. $relationactivite2.' '.
    //             $relationobjectif.' '. $relationobjectif1.' '. $relationobjectif2.' '.
    //             $relationaction.' '. $relationaction1.' '. $relationaction2.' '.
    //             $relationrisque.' '. $relationrisque1.' '. $relationrisque2,
    //             'comply' => ''
    //         );
    //     }
    //     return new JsonResponse($processusesjson);

    // }

     

    
    

    // /** 
    // * @route("/app/activite/ajaxcreate", name="activite_ajaxcreate", methods={"POST", "GET"}) 
    // * @route("/app/activite/ajaxedit/{id}/{entite}", name="activite_ajaxedit", methods={"POST", "GET"})
    // */ 
    // public function ajaxactivite(Activite $activite = null, Log $log = null, Request $request, ObjectManager $manager){
    //     if(!$activite) {
    //         $activite = new Activite();
    //         $activite->setCreatedAt(new \DateTime());
    //         $activite->addPeople($this->getUser()->getpeople()); 
    //     }
    //     if(!$log) { $log = new Log(); }
    //     $form = $this->createForm(ActiviteType::class, $activite, array(
    //         'userCustomer' => $this->getUser()->getcustomer(),
    //         'userPeople' => $this->getUser()->getpeople()
    //         ));
    //     $form->handleRequest($request);
    //     if ($request->isXmlHttpRequest()) {
    //         //return new JsonResponse('isXmlHttpRequest');
    //         if($form->isSubmitted() && $form->isValid()) {
    //             $manager = $this->getDoctrine()->getManager();
    //             $activite->setPublishedAt(new \DateTime());
    //             $activite->setCustomer($this->getUser()->getCustomer());
    //             $activite->setUpdatedAt(new \DateTime());
    //             $activite->setPublisher($this->getUser()->getpeople());
    //             $log->setUser($this->getUser());
    //             $log->setDate(new \DateTime());
    //             $log->setType('Activite');
    //             $log->setEntry($activite->getId());
    //             $log->setCustomer($this->getUser()->getCustomer());
    //             $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le activite P-'.$activite->getId().' '.$activite->getDesignation());

    //             $manager->persist($activite);
    //             $manager->flush();
    //             $response = new JsonResponse(
    //                 array(
    //                     'message' => 'Success',
    //                     'output' => $this->renderView('process/activite_createv2.html.twig',
    //                     array(
    //                         'entity' => 'activite',
    //                         'formActivite' => $form->createView(),
    //                         'editMode' => $activite->getId() !== null,
    //                         'activite' => $activite
    //                     ))), 200); 
    //             $this->addFlash(
    //                 'success',
    //                 'Vos modifications sont enregistrées'
    //                 ); 
    //         }
    //         else
    //         {
    //         $response = new JsonResponse(
    //             array(
    //                 'message' => 'Success',
    //                 'output' => $this->renderView('process/activite_createv2.html.twig',
    //                 array(
    //                     'entity' => 'activite',
    //                     'formActivite' => $form->createView(),
    //                     'editMode' => $activite->getId() !== null,
    //                     'activite' => $activite
    //                 ))), 200);              
    //         }
    //     }
    //     return $response;
    // }

    
    /**
    * @route("/app/workflow/{domid}/{id}/{statut}/{entite}", name="ajax_workflow")
    * @param $statut
    * @param $entite
    * @internal param Registry $workflows
    */
    public function wkajax($statut, $entite, $domid,$id, Request $request, ObjectManager $manager, EmailService $emailservice, 
                            Processus $processus = null, 
                            Activite $activite = null,
                            Audit $audit = null, 
                            Reclamation $reclamation = null, 
                            Dysfonctionnement $dysfonctionnement = null, 
                            Objectif $objectif = null,
                            AspectEnv $aspectenv = null,
                            VisiteSite $visitesite = null,
                            Action $action = null,
                            Flux $flux = null,
                            ObjetMetier $objetmetier = null
                            )
    {   
        if ($entite =='activite'){$entit = $activite;}
        elseif ($entite =='processus'){$entit = $processus;}
        elseif ($entite =='audit'){$entit = $audit;}
        elseif ($entite =='objectif'){$entit = $objectif;}
        elseif ($entite =='reclamation'){$entit = $reclamation;}
        elseif ($entite =='dysfonctionnement'){$entit = $dysfonctionnement;}
        elseif ($entite =='aspect_env'){$entit = $aspectenv;}
        elseif ($entite =='visite_site'){$entit = $visitesite;}
        elseif ($entite =='action'){$entit = $action;}
        elseif ($entite =='flux'){$entit = $flux;}
        elseif ($entite =='objet_metier'){$entit = $objetmetier;}
        if ($request->isXmlHttpRequest()) {
            $workflow = $this->state_machines->get($entit);
            if($workflow->can($entit, $statut)) {
                $manager = $this->getDoctrine()->getManager();
                $workflow->apply($entit, $statut);
                $entit->setValidatedAt(new \DateTime());
                $entit->setValidator($this->getUser()->getpeople());
                $entit->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
                $manager->persist($entit);
                $manager->flush();

                if (($entit->getStatut() == 'rejected' || $entit->getStatut() == 'draft' ) && $entit->getRedacteur() && $entit->getRedacteur()->getEmail()) {
                    $flashinfo='Une notification est envoyée à '.$entit->getRedacteur()->getFirstname().' '.$entit->getRedacteur()->getLastname();
                    $emailservice->sendEmail($entit->getRedacteur()->getFirstname(), $entit->getDesignation(),$entit->getRedacteur()->getEmail(),'mise à jour',$entit->getSlug(), $entit->getId(), $entite, 'La fiche '.$entite,$this->getUser()->getCustomer()->getDesignation(), $domid);
                }
                elseif (($entit->getStatut() == 'review' && $entit->getResponsable() && $entit->getResponsable()->getEmail())) {
                    $flashinfo='Une notification est envoyée à '.$entit->getResponsable()->getFirstname().' '.$entit->getResponsable()->getLastname();
                    $emailservice->sendEmail($entit->getResponsable()->getFirstname(), $entit->getDesignation(),$entit->getResponsable()->getEmail(),'validation', $entit->getSlug(), $entit->getId(), $entite, 'La fiche '.$entite,$this->getUser()->getCustomer()->getDesignation(), $domid);
                }
                elseif (($entit->getStatut() == 'validation')) {
                    $flashinfo='Une notification est envoyée à '.$this->getUser()->getCustomer()->getDpo()->getFirstname().' '.$this->getUser()->getCustomer()->getDpo()->getLastname();
                    $emailservice->sendEmail($this->getUser()->getCustomer()->getDpo()->getFirstname(), $entit->getDesignation(),$this->getUser()->getCustomer()->getDpo()->getEmail(),'validation', $entit->getSlug(), $entit->getId(), $entite, 'La fiche '.$entite,$this->getUser()->getCustomer()->getDesignation(), $domid);
                }
                elseif (($entit->getStatut() == 'validation_ok' && $entit->getResponsable() && $entit->getResponsable()->getEmail())) {
                    $flashinfo='Une notification est envoyée à '.$entit->getResponsable()->getFirstname().' '.$entit->getResponsable()->getLastname();
                }
                else
                {
                    $flashinfo='L\'état de la fiche '.$entite.' est modifié, mais la notification est impossible car les rôles ou les emails ne sont pas renseignés';
                }    

                
                $response = new JsonResponse(
                    array('message' => 'Success', 'flashinfo' => $flashinfo), 200);  
            }
        }
        
        return new JsonResponse($response);
    }

    /**
    * @route("/app/remove/{id}/{entite}", name="ajax_remove")
    * @param $entite
    */
    public function deleteAjax(
            $entite,
            Log $log = null,
            Processus $processus = null, 
            Activite $activite = null,
            Audit $audit = null, 
            Reclamation $reclamation = null, 
            Dysfonctionnement $dysfonctionnement = null, 
            Objectif $objectif = null,
            AspectEnv $aspectenv = null,
            VisiteSite $visitesite = null,
            Action $action = null, Request $request, ObjectManager $manager)
    {
        if ($entite =='activite'){$entit = $activite;}
        elseif ($entite =='processus'){$entit = $processus;}
        elseif ($entite =='audit'){$entit = $audit;}
        elseif ($entite =='objectif'){$entit = $objectif;}
        elseif ($entite =='reclamation'){$entit = $reclamation;}
        elseif ($entite =='dysfonctionnement'){$entit = $dysfonctionnement;}
        elseif ($entite =='aspect_env'){$entit = $aspectenv;}
        elseif ($entite =='visite_site'){$entit = $visitesite;}
        elseif ($entite =='action'){$entit = $action;}
        if ($request->isXmlHttpRequest()) {
            if(!$log) { $log = new Log(); }
            $log->setUser($this->getUser());
            $log->setDate(new \DateTime());
            $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé'.$entit->getId().' '.$entit->getDesignation());
            $log->setCustomer($this->getUser()->getCustomer());
            $log->setEntry($entit->getId());
            $log->setType($entite);
            $manager->persist($log);
                $manager->remove($entit);
                $manager->flush();
                $response = new JsonResponse(
                    array('message' => 'Success'), 200);  
            }
        return $response;    
   }

    /**
    * @route("/app/process/processus/remove/{id}", name="processus_remove")
    */
    public function deleteprocessus(Processus $processus, ProcessusRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
    {
      if(!$log) { $log = new Log(); }
      $log->setUser($this->getUser());
      $log->setDate(new \DateTime());
      $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé le processus-'.$processus->getId().' '.$processus->getDesignation());
      $log->setCustomer($this->getUser()->getCustomer());
      $log->setEntry($processus->getId());
      $log->setType('Processus'); 
         $manager->remove($processus);
         $manager->flush();
     
     
      $this->addFlash(
          'success',
          'Le processus est supprimé'
      );
     
      $activites = $repo->findAll();
      return $this->redirectToRoute('process_list');    
    }

     /**
    * @route("/app/process/processus/{id}/{statut}", name="processus_workflow")
    * @param $statut
    * @param Processus $processus
    * @internal param Registry $workflows
    */
    public function wkprocessus(Processus $processus, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    {

        $workflow = $this->state_machines->get($processus);
        if($workflow->can($processus, $statut)) {
            $manager = $this->getDoctrine()->getManager();
            $workflow->apply($processus, $statut);
            $processus->setValidatedAt(new \DateTime());
            $processus->setValidator($this->getUser()->getpeople());
            $processus->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
            
            $manager->persist($processus);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre demande est transmise, merci"
                );
            $r=$_GET["r"];$rr=$_GET["rr"];
            return $this->redirectToRoute('processus_edit',[ 
                'r' => $r,
                'rr' => $rr,
                'id' => $processus->getId()
                ]);
        }
    }

    
    /**
    * @route("/app/process/processus/new", name="processus_create")
    * @route("/app/processus/edit/{id}", name="processus_edit")
    */
    public function formprocessus(Processus $processus = null, UserRepository $repouser, processusRepository $repoprocessus, Log $log = null,  MapsiCustomerRepository $repocustomer, Request $request, ObjectManager $manager)
    {
        $r=$_GET["r"];$rr=$_GET["rr"];
        if(!$log) { $log = new Log(); }
        
        if(!$processus) {
            $processus = new Processus();
            $processus->setCreatedAt(new \DateTime());
            $processus->addPeople($this->getUser()->getpeople());           
            }
            
        $form = $this->createForm(ProcessusType::class, $processus, array(
        'userCustomer' => $this->getUser()->getcustomer(),
        'userPeople' => $this->getUser()->getpeople(),
        ));
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $processus->setPublishedAt(new \DateTime());
            $processus->setUpdatedAt(new \DateTime());
            $processus->setPublisher($this->getUser()->getpeople());
            $processus->setCustomer($this->getUser()->getCustomer());
            $log->setUser($this->getUser());
            $log->setDate(new \DateTime());
            $log->setType('Activité');
            $log->setEntry($processus->getId());
            $log->setCustomer($this->getUser()->getCustomer());
            $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le processus AC-'.$processus->getId().' '.$processus->getDesignation());

            $manager->persist($processus);
            $manager->flush();
            
            $this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
            );
            
            return $this->redirectToRoute('processus_edit',[ 
                'r' => $r,
                'rr' => $rr,
                'id' => $processus->getId()
                ]);
        }   

        
        if($this->isGranted('ROLE_ADMIN') OR !$processus->getId() OR $repoprocessus->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$processus->getId()))
        {
            return $this->render('blog/processus_create.html.twig',[  
                'formProcessus' => $form->createView(),
                'editMode' => $processus->getId() !== null,
                'processus' => $processus,
                'r' => $r,
                'rr' => $rr
                ]);
        }
        else
        {
            $this->addFlash(
                'warning',
                'Vous n\'avez pas accès à cette activité'
                );
            return $this->redirectToRoute('process_list');
        }   
            
    }



    /**
    * @route("/app/process/activite/new", name="activite_create")
    * @route("/app/activite/edit/{id}", name="activite_edit")
    */
    public function formactivite(Activite $activite = null, UserRepository $repouser, activiteRepository $repoactivite, Log $log = null,  MapsiCustomerRepository $repocustomer, Request $request, ObjectManager $manager)
    {
        $r=$_GET["r"];$rr=$_GET["rr"];
        if(!$log) { $log = new Log(); }
        
        if(!$activite) {
            $activite = new Activite();
            $activite->setCreatedAt(new \DateTime());
            $activite->addPeople($this->getUser()->getpeople());           
            }
            
        $form = $this->createForm(ActiviteType::class, $activite, array(
        'userCustomer' => $this->getUser()->getcustomer(),
        'userPeople' => $this->getUser()->getpeople(),
        ));
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $activite->setPublishedAt(new \DateTime());
            $activite->setUpdatedAt(new \DateTime());
            $activite->setPublisher($this->getUser()->getpeople());
            $activite->setCustomer($this->getUser()->getCustomer());
            $log->setUser($this->getUser());
            $log->setDate(new \DateTime());
            $log->setType('Activité');
            $log->setEntry($activite->getId());
            $log->setCustomer($this->getUser()->getCustomer());
            $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié l\'activité AC-'.$activite->getId().' '.$activite->getDesignation());

            $manager->persist($activite);
            $manager->flush();
            
            $this->addFlash(
            'success',
            'Vos modifications sont enregistrées'
            );
            
            return $this->redirectToRoute('activite_edit',[ 
                'r' => $r,
                'rr' => $rr,
                'id' => $activite->getId()
                ]);
        }   

        
        if($this->isGranted('ROLE_ADMIN') OR !$activite->getId() OR $repoactivite->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$activite->getId()))
        {
            return $this->render('blog/activite_create.html.twig',[  
                'formActivite' => $form->createView(),
                'editMode' => $activite->getId() !== null,
                'activite' => $activite,
                'r' => $r,
                'rr' => $rr
                ]);
        }
        else
        {
            $this->addFlash(
                'warning',
                'Vous n\'avez pas accès à cette activité'
                );
            return $this->redirectToRoute('process_list');
        }   
            
    }

    /**
      * @route("/app/process/activite/remove/{id}", name="activite_remove")
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
         return $this->redirectToRoute('process_list');    
   }


        
    /**
    * @return string
    */
    private function generateUniqueFileName()
        {
            return md5(uniqid());
        }
    
    /**
    * @route("/app/process/activite/{id}/{statut}", name="activite_workflow")
    * @param $statut
    * @param Activite $activite
    * @internal param Registry $workflows
    */
    public function wkactivite(Activite $activite, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    {   $r=$_GET["r"];$rr=$_GET["rr"];

        $workflow = $this->state_machines->get($activite);
        if($workflow->can($activite, $statut)) {
            $manager = $this->getDoctrine()->getManager();
            $workflow->apply($activite, $statut);
            $activite->setValidatedAt(new \DateTime());
            $activite->setValidator($this->getUser()->getpeople());
            $activite->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
            
            $manager->persist($activite);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre demande est transmise, merci"
                );
            return $this->redirectToRoute('activite_edit',[ 
                'r' => $r,
                'rr' => $rr,
                'id' => $activite->getId()
                ]);
        }
    }
    
    /**
    * @route("/app/process/flux/new", name="flux_create")
    * @route("/app/process/flux/edit/{id}", name="flux_edit")
    */
    public function formflux(Flux $flux = null, FluxRepository $repoflux, Log $log = null, Request $request, ObjectManager $manager)
    {
        $r=$_GET["r"];$rr=$_GET["rr"];

        if(!$log) { $log = new Log(); }
        if(!$flux) 
        { 
            $flux = new Flux();
            $flux->setCreatedAt(new \DateTime());
            $flux->addPeople($this->getUser()->getpeople()); 
            $workflow = $this->state_machines->get($flux);
            $workflow->getMarking($flux);

        }
        $form = $this->createForm(FluxType::class, $flux, array(
        'userCustomer' => $this->getUser()->getcustomer(),
        'userPeople' => $this->getUser()->getpeople()
        ));
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $flux->setPublishedAt(new \DateTime());
            $flux->setPublisher($this->getUser()->getpeople());
            $flux->setCustomer($this->getUser()->getCustomer());
            $log->setUser($this->getUser());
            $log->setDate(new \DateTime());
            $log->setType('Flux Traitement');
            $log->setEntry($flux->getId());
            $log->setCustomer($this->getUser()->getCustomer());
            $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le flux FX-'.$flux->getId().' '.$flux->getDesignation());
            
            $manager->persist($flux);
            $manager->flush();
            $this->addFlash(
            'success',
            'Vos modifications sont enregistrées pour le traitement : '.$flux->getDesignation()
        );
            
        return $this->redirectToRoute('flux_edit',[ 
            'r' => $r,
            'rr' => $rr,
            'id' => $flux->getId()
            ]);
            
        }
        if($this->isGranted('ROLE_ADMIN') OR !$flux->getId() OR $repoflux->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$flux->getId()))
        {
            
            return $this->render('blog/flux_create.html.twig',[ 
            'formFlux' => $form->createView(),
            'editMode' => $flux->getId() !== null,
            'r' => $r,
            'rr' => $rr,
            'flux' => $flux
            ]);
        }
        else
        {
            $this->addFlash(
                'warning',
                "Vous n\'avez pas accès à ce flux"
                );
            return $this->redirectToRoute($r);
        }  
    }

    /**
    * @route("/app/process/flux/{id}/{statut}", name="flux_workflow")
    * @param $statut
    * @param Flux $flux
    * @internal param Registry $workflows
    */
    public function toReview(Flux $flux, $statut, ObjectManager $manager, EmailService $emailservice)
    {
        $r=$_GET["r"];$rr=$_GET["rr"];
           $workflow = $this->state_machines->get($flux);
        if($workflow->can($flux, $statut)) {
            $manager = $this->getDoctrine()->getManager();
            $workflow->apply($flux, $statut);
            $flux->setValidatedAt(new \DateTime());
            $flux->setValidator($this->getUser()->getpeople());
            $flux->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
            
            $manager->persist($flux);
            $manager->flush();
            $this->addFlash(
                'success',
                "Le traitement est passé a l\'état ".$flux->getStatut()
                );

            if (($flux->getStatut() == 'rejected' || $flux->getStatut() == 'draft' ) && $flux->getRedacteur() && $flux->getRedacteur()->getEmail()) {
                $this->addFlash('success', 'Une notification est envoyée à '.$flux->getRedacteur()->getFirstname().' '.$flux->getRedacteur()->getLastname());
                $emailservice->sendEmail($flux->getRedacteur()->getFirstname(), $flux->getDesignation(),$flux->getRedacteur()->getEmail(),'mise à jour','flux_edit',$flux->getSlug(), $flux->getId(), $r, $rr, 'Le traitement',$this->getUser()->getCustomer()->getDesignation());
            }
            elseif (($flux->getStatut() == 'review' && $flux->getResponsable() && $flux->getResponsable()->getEmail())) {
                $this->addFlash('success', 'Une notification est envoyée à '.$flux->getResponsable()->getFirstname().' '.$flux->getResponsable()->getLastname());
                $emailservice->sendEmail($flux->getResponsable()->getFirstname(), $flux->getDesignation(),$flux->getResponsable()->getEmail(),'validation','flux_edit',$flux->getSlug(), $flux->getId(), $r, $rr, 'Le traitement',$this->getUser()->getCustomer()->getDesignation());
            }
            elseif (($flux->getStatut() == 'validation')) {
                $this->addFlash('success', 'Une notification est envoyée à '.$this->getUser()->getCustomer()->getDpo()->getFirstname().' '.$this->getUser()->getCustomer()->getDpo()->getLastname());
                $emailservice->sendEmail($this->getUser()->getCustomer()->getDpo()->getFirstname(), $flux->getDesignation(),$this->getUser()->getCustomer()->getDpo()->getEmail(),'validation','flux_edit',$flux->getSlug(), $flux->getId(), $r, $rr, 'traitement',$this->getUser()->getCustomer()->getDesignation());
            }
            elseif (($flux->getStatut() == 'validation_ok' && $flux->getResponsable() && $flux->getResponsable()->getEmail())) {
                $this->addFlash('success', 'Une notification est envoyée à '.$flux->getResponsable()->getFirstname().' '.$flux->getResponsable()->getLastname());
            }
            else
            {
                $this->addFlash('warning', 'L\'état du traitement est modifié, mais la notification est impossible car les rôles ou les emails ne sont pas renseignés');
            }
          
            
            
            return $this->redirectToRoute('flux_edit',[ 
                'r' => $r,
                'rr' => $rr,
                'id' => $flux->getId()
                ]);
        }
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
         return $this->redirectToRoute('process_list');    
   }

    /**
    * @route("/app/process/objetmetier/new", name="objetmetier_create")
    * @route("/app/process/objetmetier/edit/{id}", name="objetmetier_edit")
    */
    public function formom(ObjetMetier $objetmetier = null, ObjetMetierRepository $repoom, Log $log = null, Request $request, ObjectManager $manager)
    {
        $r=$_GET["r"];$rr=$_GET["rr"];

        if(!$log) { $log = new Log(); }
        if(!$objetmetier) 
        { 
            $objetmetier = new ObjetMetier();
            $objetmetier->setPublishedAt(new \DateTime());
            $objetmetier->addPeople($this->getUser()->getpeople()); 
            $workflow = $this->state_machines->get($objetmetier);
            $workflow->getMarking($objetmetier);

        }
        $form = $this->createForm(ObjetMetierType::class, $objetmetier, array(
        'userCustomer' => $this->getUser()->getcustomer()
        ));
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $objetmetier->setPublishedAt(new \DateTime());
            $objetmetier->setPublisher($this->getUser()->getpeople());
            $objetmetier->setCustomer($this->getUser()->getCustomer());
            $log->setUser($this->getUser());
            $log->setDate(new \DateTime());
            $log->setType('Objet Métier');
            $log->setEntry($objetmetier->getId());
            $log->setCustomer($this->getUser()->getCustomer());
            $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié l\'objet métier -'.$objetmetier->getId().' '.$objetmetier->getDesignation());
            
            $manager->persist($objetmetier);
            $manager->flush();
            $this->addFlash(
            'success',
            'Vos modifications sont enregistrées pour l\'objet métier : '.$objetmetier->getDesignation()
        );
            
        return $this->redirectToRoute('objetmetier_edit',[ 
            'r' => $r,
            'rr' => $rr,
            'id' => $objetmetier->getId()
            ]);
            
        }
        if($this->isGranted('ROLE_ADMIN') OR !$objetmetier->getId() OR $repoom->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$objetmetier->getId()))
        {
            return $this->render('blog/objetmetier_create.html.twig',[ 
            'formObjetMetier' => $form->createView(),
            'editMode' => $objetmetier->getId() !== null,
            'r' => $r,
            'rr' => $rr,
            'objetmetier' => $objetmetier
            ]);
        }
        else
        {
            $this->addFlash(
                'warning',
                "Vous n\'avez pas accès à cet objet métier"
                );
            return $this->redirectToRoute($r);
        }  
    }

    /**
      * @route("/app/process/objetmetier/remove/{id}", name="objetmetier_remove")
      */
    public function deleteobjetmetier(ObjetMetier $objetmetier, ObjetMetierRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
    {
        $manager->remove($objetmetier);
        $manager->flush();

    $this->addFlash(
          'success',
          'Objet métier supprimé'
      );
         $objetmetiers = $repo->findAll();
         return $this->redirectToRoute('process_list');
    }

    /**
    * @route("/app/process/objetmetier/{id}/{statut}", name="objetmetier_workflow")
    * @param $statut
    * @param ObjetMetier $objetmetier
    * @internal param Registry $workflows
    */
    public function wkom(ObjetMetier $objetmetier, $statut, ObjectManager $manager, EmailService $emailservice)
    {
        $r=$_GET["r"];$rr=$_GET["rr"];
           $workflow = $this->state_machines->get($objetmetier);
        if($workflow->can($objetmetier, $statut)) {
            $manager = $this->getDoctrine()->getManager();
            $workflow->apply($objetmetier, $statut);
            $objetmetier->setValidatedAt(new \DateTime());
            $objetmetier->setValidator($this->getUser()->getpeople());
            $objetmetier->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
            
            $manager->persist($objetmetier);
            $manager->flush();
            $this->addFlash(
                'success',
                "Le traitement est passé a l\'état ".$objetmetier->getStatut()
                );

            if (($objetmetier->getStatut() == 'rejected' || $objetmetier->getStatut() == 'draft' ) && $objetmetier->getRedacteur() && $objetmetier->getRedacteur()->getEmail()) {
                $this->addFlash('success', 'Une notification est envoyée à '.$objetmetier->getRedacteur()->getFirstname().' '.$objetmetier->getRedacteur()->getLastname());
                $emailservice->sendEmail($objetmetier->getRedacteur()->getFirstname(), $objetmetier->getDesignation(),$objetmetier->getRedacteur()->getEmail(),'mise à jour','objetmetier_edit',$objetmetier->getSlug(), $objetmetier->getId(), $r, $rr, 'L\'objet métier',$this->getUser()->getCustomer()->getDesignation());
            }
            elseif (($objetmetier->getStatut() == 'review' && $objetmetier->getResponsable() && $objetmetier->getResponsable()->getEmail())) {
                $this->addFlash('success', 'Une notification est envoyée à '.$objetmetier->getResponsable()->getFirstname().' '.$objetmetier->getResponsable()->getLastname());
                $emailservice->sendEmail($objetmetier->getResponsable()->getFirstname(), $objetmetier->getDesignation(),$objetmetier->getResponsable()->getEmail(),'validation','objetmetier_edit',$objetmetier->getSlug(), $objetmetier->getId(), $r, $rr, 'L\'objet métier',$this->getUser()->getCustomer()->getDesignation());
            }
            elseif (($objetmetier->getStatut() == 'validation')) {
                $this->addFlash('success', 'Une notification est envoyée à '.$this->getUser()->getCustomer()->getDpo()->getFirstname().' '.$this->getUser()->getCustomer()->getDpo()->getLastname());
                $emailservice->sendEmail($this->getUser()->getCustomer()->getDpo()->getFirstname(), $objetmetier->getDesignation(),$this->getUser()->getCustomer()->getDpo()->getEmail(),'validation','objetmetier_edit',$objetmetier->getSlug(), $objetmetier->getId(), $r, $rr, 'L\'objet métier',$this->getUser()->getCustomer()->getDesignation());
            }
            elseif (($objetmetier->getStatut() == 'validation_ok' && $objetmetier->getResponsable() && $objetmetier->getResponsable()->getEmail())) {
                $this->addFlash('success', 'Une notification est envoyée à '.$objetmetier->getResponsable()->getFirstname().' '.$objetmetier->getResponsable()->getLastname());
            }
            else
            {
                $this->addFlash('warning', 'L\'état du traitement est modifié, mais la notification est impossible car les rôles ou les emails ne sont pas renseignés');
            }
          
            
            
            return $this->redirectToRoute('objetmetier_edit',[ 
                'r' => $r,
                'rr' => $rr,
                'id' => $objetmetier->getId()
                ]);
        }
    }
    
}

