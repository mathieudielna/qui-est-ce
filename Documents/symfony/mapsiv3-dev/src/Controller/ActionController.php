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



use App\Form\ApplicationType;
use App\Form\SystemeType;
use App\Form\PeopleType;
use App\Form\ActiviteType;
use App\Form\ProcessusType;
use App\Form\ProgramType;
use App\Form\MetierType;
use App\Form\SiteType;
use App\Form\ObjetMetierType;
use App\Form\TierType;
use App\Form\RessourceType;
use App\Form\MapsiCustomerType;
use App\Form\RegistrationType;
use App\Form\FluxType;
use App\Form\ActionType;
use App\Repository\JalonConnectActionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Component\Workflow\Registry;
use App\Service\EmailService;
use App\Service\WorkflowService;
use Symfony\Component\Templating\EngineInterface;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;



class ActionController extends AbstractController
{


     /**
     * @Route("/app/{domid}/action", name="action")
     */
    public function indexrisque(Request $request, actionRepository $repoaction, WorkflowInterface $actionStateMachine, JalonConnectActionRepository $repojalon, TypeConformiteRepository $repoconformite, $domid)
    {   
        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));
        

        if ($request->isXmlHttpRequest()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                if ($confo=='portfolio')
                {
                    $actions = $repoaction->findByCustomer($this->getUser()->getCustomer());
                }
                else
                {
                    $actions = $repoaction->findAllConformite($this->getUser()->getCustomer(),$conformite); 
                }
            }
            else
            {
                if ($confo=='portfolio')
                {
                    $actions = $repoaction->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
                }
                else
                {
                    $actions = $repoaction->findAllCustomerConformites($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
                }
            }
            
            $coljson = array(
                'columns'=> [
                [
                'title'=> '',
                'data'=> 'select',
                'className'=> 'select-checkbox tableselect',
                'orderable'=> 'false', 
                ], [
                'title'=> 'Statut',
                'className'=> '',
                'data'=> 'statut',
                'className'=> 'statut export'
                ], [
                'title'=> 'Désignation',
                'data'=> 'designation',
                'className'=> 'table-title export'
                ], [
                'title'=> 'Equipe',
                'data'=> 'responsable',
                'className'=> 'export equipe'
                ], [
                'title'=> 'Progression',
                'data'=> 'progression'
                ],
                [
                'title'=> 'Relation',
                'data'=> 'relation'
                ], [
                    'title'=> 'Comply',
                    'data'=> 'comply'
                    ]
                ]
            );
            
            
            $data = array();
            foreach($actions as $action) {
                if ($action->getResponsable()) {$responsable=$action->getResponsable()->getFirstname().' '.$responsable=$action->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($action->getSuppleant()) {$suppleant=$action->getSuppleant()->getFirstname().' '.$suppleant=$action->getSuppleant()->getLastname();}
                else {$suppleant="";}
                $actionavg = $repoaction->findProgressionAction($this->getUser()->getCustomer(),$action->getId());
                $actionavg = round($actionavg, 0);
                $comply = '';
                foreach($action->getTypeconformite() as $tc ) {$comply .= '<span class="badge badge-secondary mr-1">'.$tc->getDesignation().'</span>';}

                $relationprocess ='';$relationprocess1 = '';$relationprocess2 = ''; if (count($action->getProcessuses()) >= 1) {
                $relationprocess ='
                <span class="dropdown tablerelation">
                        <button class="btn btn-outline-primary dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-arrow-repeat tablerelation icon"></i> <strong class="tablerelation">'.count($action->getProcessuses()).'</strong>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <h4 class="tablerelation"> Traitements</h4>';
                            foreach($action->getProcessuses() as $p ) 
                            {$relationprocess1 .='<a class="dropdown-item" onclick="crossEntity('.$p->getId().',\'flux\')">'.$p->getDesignation().'</a>';}
                $relationprocess2 = '</div></span>';
                }

                $relationflux ='';$relationflux1 = '';$relationflux2 = ''; if (count($action->getFluxes()) >= 1) {
                $relationflux ='
                <span class="dropdown tablerelation">
                        <button class="btn btn-outline-primary dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-arrow-left-right tablerelation icon"></i> <strong class="tablerelation">'.count($action->getFluxes()).'</strong>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <h4 class="tablerelation"> Processus</h4>';
                            foreach($action->getFluxes() as $f ) 
                            {$relationflux1 .='<a class="dropdown-item" onclick="crossEntity('.$f->getId().',\'flux\')">'.$f->getDesignation().'</a>';}
                $relationflux2 = '</div></span>';
                }
                $relationrisque ='';$relationrisque1 = '';$relationrisque2 = ''; if (count($action->getRisques()) >= 1) {
                $relationrisque1 = '';
                $relationrisque ='
                <span class="dropdown tablerelation">
                        <button class="btn btn-outline-danger dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-exclamation-circle tablerelation icon"></i> <strong class="tablerelation">'.count($action->getRisques()).'</strong>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <h4 class="tablerelation"> Risques</h4>';
                            foreach($action->getRisques() as $ri ) 
                            {$relationrisque1 .='<a class="dropdown-item">'.substr($ri->getDesignation(), 0, 25).'...</a>';}
                $relationrisque2 = '</div></span>';
                }

                $statut = '<span class="badge badge-outlined badge-'.$actionStateMachine->getMetadataStore()->getMetadata('ambiance', $action->getStatut()).'">'.$actionStateMachine->getMetadataStore()->getMetadata('title', $action->getStatut())?? 'To do'.'</span>';


                $data[] = array(
                    'select' => '',
                    'statut' => $statut,
                    'designation' => '<a onclick="crossEntity('.$action->getId().',\'action\')">'.$action->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'progression' => '<div class="progress"><div class="progress-bar" role="progressbar" style="width: '.$actionavg.'%;" aria-valuenow="'.$actionavg.'" aria-valuemin="0" aria-valuemax="100">'.$actionavg.'%</div></div>',
                    'relation' => $relationflux.' '. $relationflux1.' '. $relationflux2.' '.
                                $relationprocess.' '. $relationprocess1.' '. $relationprocess2.' '.
                                $relationrisque.' '. $relationrisque1.' '. $relationrisque2,
                    'comply' => $comply
                );
            } 

            $temp["data"]=$data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json);
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'action', 'domaine'=>'', 'trans'=>'', 'tdb'=>'']);
        } 
    }

    /** 
    * @route("/app/action/ajaxcreate/{domid}", name="action_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/action/ajaxedit/{id}/{domid}", name="action_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxaction(Action $action = null, Log $log = null, Request $request, ObjectManager $manager, TypeConformiteRepository $repoconformite, $domid){

        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));


        if(!$action) {
            $action = new Action();
            $action->setCreatedAt(new \DateTime());
            $action->addPerson($this->getUser()->getpeople()); 
            $action->addTypeconformite($conformite);
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(ActionType::class, $action, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $action->setPublishedAt(new \DateTime());
                $action->setCustomer($this->getUser()->getCustomer());
                $action->setUpdatedAt(new \DateTime());
                $action->setPublisher($this->getUser()->getpeople());
                foreach ($action->getjalonConnectActions() as $tache){$tache->setMcustomer($this->getUser()->getCustomer());}
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Action');
                $log->setEntry($action->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le action AC-'.$action->getId().' '.$action->getDesignation());
                $manager->persist($action);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/action_createv2.html.twig',
                        array(
                            'entity' => 'action',
                            'formAction' => $form->createView(),
                            'editMode' => $action->getId() !== null,
                            'action' => $action
                        ))), 200); 
                $this->addFlash(
                    'success',
                    'Vos modifications sont enregistrées'
                    ); 
            }
            else
            {
            $response = new JsonResponse(
                array(
                    'message' => 'Success',
                    'output' => $this->renderView('process/action_createv2.html.twig',
                    array(
                        'entity' => 'action',
                        'formAction' => $form->createView(),
                        'editMode' => $action->getId() !== null,
                        'action' => $action
                    ))), 200);              
            }
        }
        return $response;
    }

    
}

