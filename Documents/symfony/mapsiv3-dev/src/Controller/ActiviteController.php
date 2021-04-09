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



class ActiviteController extends AbstractController
{

    /**
     * @Route("/app/{domid}/activite", name="activite")
     */
    public function indextest(Request $request, WorkflowInterface $activiteStateMachine, ActiviteRepository $repoactivite, $domid)
    {   
        if ($request->isXmlHttpRequest()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $activites = $repoactivite->findByCustomer($this->getUser()->getCustomer());
            }
            else 
            {
                $activites = $repoactivite->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
            }
            
            $coljson = array(
                'columns'=> [
                    [
                    'title'=> '',
                    'data'=> 'select',
                    'className'=> 'select-checkbox tableselect',
                    'orderable'=> 'false', 
                    ],  [
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
                    ], [
                    'title'=> 'Comply',
                    'data'=> 'comply'
                    ]
                ]
            );
            
            
            $data = array();
            foreach($activites as $activite) {
                if ($activite->getResponsable()) {$responsable=$activite->getResponsable()->getFirstname().' '.$responsable=$activite->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($activite->getSuppleant()) {$suppleant=$activite->getSuppleant()->getFirstname().' '.$suppleant=$activite->getSuppleant()->getLastname();}
                else {$suppleant="";}
                if ($activite->getProcessus()) {$processus='<a onclick="crossEntity('.$activite->getProcessus()->getId().',\'processus\')">'.$activite->getProcessus()->getCode().'</a> > ';}
                else {$processus="";}
                if ($activite->getPca() && $activite->getPca()->getCode()==1) {$complypca='<span class="badge badge-secondary mr-1">PCA</span>';}
                else {$complypca="";}
                if (count($activite->getFluxConnectActivites())>1) {$complyrgpd='<span class="badge badge-secondary mr-1">RGPD</span>';}
                else {$complyrgpd="";}

                $relationtier ='';$relationtier1 = '';$relationtier2 = '';  if (count($activite->getTiers()) >= 1) {
                    $relationtier1 = '';
                    $relationtier ='
                    <span class="dropdown tablerelation">
                            <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-collection tablerelation icon"></i> <strong class="tablerelation">'.count($activite->getTiers()).'</strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h4 class="tablerelation"> Tiers</h4>';
                                foreach($activite->getTiers() as $i ) 
                                {$relationtier1 .='<a class="dropdown-item" onclick="crossEntity('.$i->getId().',\'tier\')">'.$i->getDesignation().'</a>';}
                    $relationtier2 = '</div></span>';
                    }

                    $relationressource ='';$relationressource1 = '';$relationressource2 = '';  if (count($activite->getRessources()) >= 1) {
                        $relationressource1 = '';
                        $relationressource ='
                        <span class="dropdown tablerelation">
                                <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-box tablerelation icon"></i> <strong class="tablerelation">'.count($activite->getRessources()).'</strong>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <h4 class="tablerelation"> Ressources</h4>';
                                    foreach($activite->getRessources() as $i ) 
                                    {$relationressource1 .='<a class="dropdown-item" onclick="crossEntity('.$i->getId().',\'ressource\')">'.$i->getDesignation().'</a>';}
                        $relationressource2 = '</div></span>';
                        }
                
                    $statut = '<span class="badge badge-outlined badge-'.$activiteStateMachine->getMetadataStore()->getMetadata('ambiance', $activite->getStatut()).'">'.$activiteStateMachine->getMetadataStore()->getMetadata('title', $activite->getStatut())?? 'To do'.'</span>';


                $data[] = array(
                    'select' => '',
                    'statut' => $statut,
                    'designation' => $processus.'<a onclick="crossEntity('.$activite->getId().',\'activite\')">'.$activite->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'relation' => $relationtier.' '. $relationtier1.' '. $relationtier2.' '.
                    $relationressource.' '. $relationressource1.' '. $relationressource2,
                    'comply' => $complypca.''.$complyrgpd,
                );
            } 

            $temp["data"]=$data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json);
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'activite', 'domaine'=>'', 'trans'=>'', 'tdb'=>'']);
 
        }
    }

    /** 
    * @route("/app/activite/ajaxcreate/{domid}", name="activite_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/activite/ajaxedit/{id}/{domid}", name="activite_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxactivite(Activite $activite = null, Log $log = null, Request $request, ObjectManager $manager, $domid)
    {
        if(!$activite) {
            $activite = new Activite();
            $activite->setCreatedAt(new \DateTime());
            $activite->addPeople($this->getUser()->getpeople()); 
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(ActiviteType::class, $activite, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $activite->setPublishedAt(new \DateTime());
                $activite->setCustomer($this->getUser()->getCustomer());
                $activite->setUpdatedAt(new \DateTime());
                $activite->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Activite');
                $log->setEntry($activite->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le activite A-'.$activite->getId().' '.$activite->getDesignation());
                $manager->persist($activite);
                $manager->flush();

                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/activite_createv2.html.twig',
                        array(
                            'entity' => 'activite',
                            'formActivite' => $form->createView(),
                            'editMode' => $activite->getId() !== null,
                            'activite' => $activite,
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
                    'output' => $this->renderView('process/activite_createv2.html.twig',
                    array(
                        'entity' => 'activite',
                        'formActivite' => $form->createView(),
                        'editMode' => $activite->getId() !== null,
                        'activite' => $activite,
                    ))), 200);              
            }
        }
        return $response;
    }

}

