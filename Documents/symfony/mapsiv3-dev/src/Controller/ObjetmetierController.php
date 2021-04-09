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


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\WorkflowInterface;
use App\Service\EmailService;
use App\Service\WorkflowService;
use Symfony\Component\Templating\EngineInterface;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;



class ObjetmetierController extends AbstractController
{

    /**
     * @Route("/app/{domid}/objet_metier", name="objetmetier")
     */
    public function indexaom(Request $request, WorkflowInterface $objetmetierStateMachine,ObjetMetierRepository $repoom, $domid)
    {   
        if ($request->isXmlHttpRequest()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $objetmetiers = $repoom->findByCustomer($this->getUser()->getCustomer());
            }
            else
            {
                $objetmetiers = $repoom->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
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
                'title'=> 'Relation',
                'data'=> 'relation',
                'className'=> 'relation-col export'
                ],[
                'title'=> 'Comply',
                'data'=> 'comply'
                ]
                ]
            );
            
            
            $data = array();
            foreach($objetmetiers as $objetmetier) {
                if ($objetmetier->getResponsable()) {$responsable=$objetmetier->getResponsable()->getFirstname().' '.$responsable=$objetmetier->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($objetmetier->getSuppleant()) {$suppleant=$objetmetier->getSuppleant()->getFirstname().' '.$suppleant=$objetmetier->getSuppleant()->getLastname();}
                else {$suppleant="";}

                $comply ='';
                
                    if ($objetmetier->getDcp() && $objetmetier->getDcp()->getCode()==1){
                        $comply ='<span class="badge badge-secondary mr-1">RGPD</span>';
                    }
                $relationdata ='';$relationdata1 = '';$relationdata2 = ''; if (count($objetmetier->getDatas()) >= 1) {
                    $relationdata1 = '';
                    $relationdata ='
                    <span class="dropdown tablerelation">
                            <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person-lines-fill tablerelation icon"></i> <strong class="tablerelation">'.count($objetmetier->getDatas()).'</strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h4 class="tablerelation"><i class="bi bi-kanban icon"></i> Données</h4>';
                                foreach($objetmetier->getDatas() as $donnee ) 
                                {$relationdata1 .='<a class="dropdown-item small">'.$donnee->getDesignation().'</a>';}
                    $relationdata2 = '</div></span>';
                    }

                $relationapplication ='';$relationapplication1 = '';$relationapplication2 = ''; if (count($objetmetier->getApplications()) >= 1) {
                    $relationapplication1 = '';
                    $relationapplication ='
                    <span class="dropdown tablerelation">
                            <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-window tablerelation icon"></i> <strong class="tablerelation">'.count($objetmetier->getApplications()).'</strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h4 class="tablerelation"><i class="bi bi-kanban icon"></i> Applications</h4>';
                                foreach($objetmetier->getApplications() as $application ) 
                                {$relationapplication1 .='<a class="dropdown-item small" onclick="crossEntity('.$application->getId().',\'application\')">'.$application->getDesignation().'</a>';}
                    $relationapplication2 = '</div></span>';
                    }

                    $relationflux ='';$relationflux1 = '';$relationflux2 = ''; if (count($objetmetier->getFluxes()) >= 1) {
                        $relationflux1 = '';
                        $relationflux ='
                        <span class="dropdown tablerelation">
                                <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-arrows-fullscreen tablerelation icon"></i> <strong class="tablerelation">'.count($objetmetier->getFluxes()).'</strong>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <h4 class="tablerelation"><i class="bi bi-kanban icon"></i> Traitements</h4>';
                                    foreach($objetmetier->getFluxes() as $flux ) 
                                    {$relationflux1 .='<a class="dropdown-item small" onclick="crossEntity('.$flux->getId().',\'flux\')">'.$flux->getDesignation().'</a>';}
                        $relationflux2 = '</div></span>';
                        }

                $statut = '<span class="badge badge-outlined badge-'.$objetmetierStateMachine->getMetadataStore()->getMetadata('ambiance', $objetmetier->getStatut()).'">'.$objetmetierStateMachine->getMetadataStore()->getMetadata('title', $objetmetier->getStatut())?? 'To do'.'</span>';

                $data[] = array(
                    'select' => '',
                    'statut' => $statut,
                    'designation' => '<a onclick="crossEntity('.$objetmetier->getId().',\'objet_metier\')">'.$objetmetier->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'relation' => $relationflux.' '. $relationflux1.' '. $relationflux2.' '.
                                    $relationapplication.' '. $relationapplication1.' '. $relationapplication2.' '.
                                    $relationdata.' '. $relationdata1.' '. $relationdata2,
                    'comply' => $comply
                );
            } 

            $temp["data"]=$data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json);
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'objet_metier', 'domaine'=>'', 'trans'=>'', 'tdb'=>'']);
        }

    }

    /** 
    * @route("/app/objet_metier/ajaxcreate/{domid}", name="objetmetier_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/objet_metier/ajaxedit/{id}/{domid}", name="objetmetier_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxobjetmetier(ObjetMetier $objetmetier = null, Log $log = null, Request $request, ObjectManager $manager, $domid){
        if(!$objetmetier) {
            $objetmetier = new ObjetMetier();
            $objetmetier->setCreatedAt(new \DateTime());
            $objetmetier->addPeople($this->getUser()->getpeople()); 
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(ObjetMetierType::class, $objetmetier, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $objetmetier->setPublishedAt(new \DateTime());
                $objetmetier->setCustomer($this->getUser()->getCustomer());
                $objetmetier->setUpdatedAt(new \DateTime());
                $objetmetier->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('ObjetMetier');
                $log->setEntry($objetmetier->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le objetmetier OM-'.$objetmetier->getId().' '.$objetmetier->getDesignation());

                $manager->persist($objetmetier);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/objetmetier_createv2.html.twig',
                        array(
                            'entity' => 'objetmetier',
                            'formObjetMetier' => $form->createView(),
                            'editMode' => $objetmetier->getId() !== null,
                            'objetmetier' => $objetmetier
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
                    'output' => $this->renderView('process/objetmetier_createv2.html.twig',
                    array(
                        'entity' => 'objetmetier',
                        'formObjetMetier' => $form->createView(),
                        'editMode' => $objetmetier->getId() !== null,
                        'objetmetier' => $objetmetier
                    ))), 200);              
            }
        }
        return $response;
    }



    
}

