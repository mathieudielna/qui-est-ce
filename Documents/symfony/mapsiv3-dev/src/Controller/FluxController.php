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



class FluxController extends AbstractController
{
    /**
     * @Route("/app/{domid}/flux", name="flux")
     */
    public function indexflux(Request $request, WorkflowInterface $fluxStateMachine, FluxRepository $repoflux, $domid)
    {   
        if ($request->isXmlHttpRequest()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $fluxes = $repoflux->findByCustomer($this->getUser()->getCustomer());
            }
            else
            {
                $fluxes = $repoflux->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
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
                'title'=> 'Relation',
                'data'=> 'relation',
                'className'=> 'relation-col export'
                ], [
                    'title'=> 'Comply',
                    'data'=> 'comply'
                    ]
                ]
            );
            $data = array();
            foreach($fluxes as $flux) {
                $relationactivite ='';$relationactivite1 = '';$relationactivite2 = ''; if (count($flux->getFluxConnectActivites()) >= 1) {
                $relationactivite1 = '';
                $relationactivite ='
                <span class="dropdown tablerelation">
                        <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-bezier tablerelation icon"></i> <strong class="tablerelation">'.count($flux->getFluxConnectActivites()).'</strong>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <h4 class="tablerelation"><i class="bi bi-bezier icon"></i>  Activités</h4>';
                            foreach($flux->getFluxConnectActivites() as $act ) 
                            {$relationactivite1 .='<a class="dropdown-item small" onclick="crossEntity('.$act->getActivite()->getId().',\'activite\')">'.$act->getActivite()->getDesignation().'</a>';}
                $relationactivite2 = '</div></span>';
                }

                $relationaction ='';$relationaction1 = '';$relationaction2 = ''; if (count($flux->getActions()) >= 1) {
                $relationaction1 = '';
                $relationaction ='
                <span class="dropdown tablerelation">
                        <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-kanban tablerelation icon"></i> <strong class="tablerelation">'.count($flux->getActions()).'</strong>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <h4 class="tablerelation"><i class="bi bi-kanban icon"></i> Actions</h4>';
                            foreach($flux->getActions() as $action ) 
                            {$relationaction1 .='<a class="dropdown-item small" onclick="crossEntity('.$action->getId().',\'action\')">'.$action->getDesignation().'</a>';}
                $relationaction2 = '</div></span>';
                }

                $relationom ='';$relationom1 = '';$relationom2 = ''; if (count($flux->getObjetmetiers()) >= 1) {
                    $relationom1 = '';
                    $relationom ='
                    <span class="dropdown tablerelation">
                            <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-file-post tablerelation icon"></i> <strong class="tablerelation">'.count($flux->getObjetmetiers()).'</strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h4 class="tablerelation"><i class="bi bi-file-post icon"></i> Objets métiers</h4>';
                                foreach($flux->getObjetmetiers() as $om ) 
                                {$relationom1 .='<a class="dropdown-item small" onclick="crossEntity('.$om->getId().',\'objet_metier\')">'.$om->getDesignation().'</a>';}
                    $relationom2 = '</div></span>';
                    }

                $relationrisque ='';$relationrisque1 = '';$relationrisque2 = ''; if (count($flux->getRisques()) >= 1) {
                    $relationrisque1 = '';
                    $relationrisque ='
                    <span class="dropdown tablerelation">
                            <button class="btn btn-alert btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-exclamation-circle tablerelation icon"></i> <strong class="tablerelation">'.count($flux->getRisques()).'</strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h4 class="tablerelation"><i class="bi bi-exclamation-circle icon"></i> Risques</h4>';
                                foreach($flux->getRisques() as $ri ) 
                                {$relationrisque1 .='<a class="dropdown-item small" onclick="crossEntity('.$ri->getId().',\'risque\')">'.substr($ri->getDesignation(), 0, 25).'...</a>';}
                    $relationrisque2 = '</div></span>';
                    }


                if ($flux->getResponsable()) {$responsable=$flux->getResponsable()->getFirstname().' '.$responsable=$flux->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($flux->getSuppleant()) {$suppleant=$flux->getSuppleant()->getFirstname().' '.$suppleant=$flux->getSuppleant()->getLastname();}
                else {$suppleant="";}
                $statut = '<span class="badge badge-outlined badge-'.$fluxStateMachine->getMetadataStore()->getMetadata('ambiance', $flux->getStatut()).'">'.$fluxStateMachine->getMetadataStore()->getMetadata('title', $flux->getStatut())?? 'To do'.'</span>';
                
                $comply ='';
                foreach($flux->getObjetmetiers() as $om ) {
                    if ($om->getDcp() && $om->getDcp()->getCode()==1){
                        $comply ='<span class="badge badge-secondary mr-1">RGPD</span>';
                    }
                }

                $data[] = array(
                    'select' => '',
                    'statut' => $statut,
                    'designation' => '<a onclick="crossEntity('.$flux->getId().',\'flux\')">'.$flux->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'relation' => $relationactivite.' '. $relationactivite1.' '. $relationactivite2.' '.
                                    $relationaction.' '. $relationaction1.' '. $relationaction2.' '.
                                    $relationom.' '. $relationom1.' '. $relationom2.' '.
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
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'flux', 'domaine'=>'', 'trans'=>'', 'tdb'=>'']); 
        }
    }


    /** 
    * @route("/app/flux/ajaxcreate/{domid}", name="flux_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/flux/ajaxedit/{id}/{domid}", name="flux_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxflux(Flux $flux = null, Activite $activite = null, Log $log = null, Request $request, ObjectManager $manager, $domid){
        if(!$flux) {
            $flux = new Flux();
            $flux->setCreatedAt(new \DateTime());
            $flux->addPeople($this->getUser()->getpeople()); 
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(FluxType::class, $flux, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $flux->setPublishedAt(new \DateTime());
                $flux->setCustomer($this->getUser()->getCustomer());
                $flux->setUpdatedAt(new \DateTime());
                $flux->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Flux');
                $log->setEntry($flux->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le flux P-'.$flux->getId().' '.$flux->getDesignation());

                $manager->persist($flux);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/flux_createv2.html.twig',
                        array(
                            'entity' => 'flux',
                            'formFlux' => $form->createView(),
                            'editMode' => $flux->getId() !== null,
                            'flux' => $flux
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
                    'output' => $this->renderView('process/flux_createv2.html.twig',
                    array(
                        'entity' => 'flux',
                        'formFlux' => $form->createView(),
                        'editMode' => $flux->getId() !== null,
                        'flux' => $flux
                    ))), 200);              
            }
        }
        return $response;
    }
}

