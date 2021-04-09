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
use App\Entity\JalonConnectAction;
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
use App\Repository\JalonConnectActionRepository;
use App\Repository\ProgramRepository;
use App\Repository\ProjetRepository;
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
use App\Form\JalonConnectActionType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Workflow\Registry;
use App\Service\EmailService;
use App\Service\WorkflowService;
use Symfony\Component\Templating\EngineInterface;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;



class JalonconnectactionController extends AbstractController
{


     /**
     * @Route("/app/{domid}/jalon_connect_action", name="jalon_connect_action")
     */
    public function indexrisque(Request $request, jalonconnectactionRepository $repojalon, $domid)
    {   
        if ($request->isXmlHttpRequest()) {
        
            if ($this->isGranted('ROLE_ADMIN')) {
                $jalonconnectactions = $repojalon->findByMcustomer($this->getUser()->getCustomer());
            }
            else
            {
                $jalonconnectactions = $repojalon->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
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
                'data'=> 'statut'
                ], [
                'title'=> 'Désignation',
                'data'=> 'designation',
                'className'=> 'table-title'
                ], [
                'title'=> 'Manager',
                'data'=> 'responsable'
                ], [
                'title'=> 'Progression',
                'data'=> 'progression'
                ], [
                'title'=> 'Action',
                'data'=> 'action'
                ],[
                'title'=> 'Relation',
                'data'=> 'relation'
                ], [
                    'title'=> 'Comply',
                    'data'=> 'comply'
                    ]
                ]
            );
            
            
            $data = array();
            foreach($jalonconnectactions as $jalonconnectaction) {
                if ($jalonconnectaction->getResponsable()) {$responsable=$jalonconnectaction->getResponsable()->getFirstname().' '.$responsable=$jalonconnectaction->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($jalonconnectaction->getSuppleant()) {$suppleant=$jalonconnectaction->getSuppleant()->getFirstname().' '.$suppleant=$jalonconnectaction->getSuppleant()->getLastname();}
                else {$suppleant="";}
                if ($jalonconnectaction->getAction()) {$action=$jalonconnectaction->getAction()->getDesignation();}
                $progression = $jalonconnectaction->getProgression();
                $data[] = array(
                    'select' => '',
                    'statut' => '',
                    'designation' => '<a onclick="crossEntity('.$jalonconnectaction->getId().',\'jalon_connect_action\')">'.$jalonconnectaction->getJalon().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'progression' => '<div class="progress"><div class="progress-bar" role="progressbar" style="width: '.$progression.'%;" aria-valuenow="'.$progression.'" aria-valuemin="0" aria-valuemax="100">'.$progression.'%</div></div>',
                    'action' => $action,
                    'relation' => '',
                    'comply' => ''
                );
            } 

            $temp["data"]=$data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json);
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'jalon_connect_action', 'domaine'=>'', 'trans'=>'', 'tdb'=>'']);
        } 
    }

    /** 
    * @route("/app/jalon_connect_action/ajaxcreate", name="jalon_connect_action_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/jalon_connect_action/ajaxedit/{id}/{entite}", name="jalon_connect_action_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxjalonconnectaction(JalonConnectAction $jalonconnectaction = null, Log $log = null, Request $request, ObjectManager $manager){
        if(!$jalonconnectaction) {
            $jalonconnectaction = new JalonConnectAction();
            $jalonconnectaction->setCreatedAt(new \DateTime());
            $jalonconnectaction->addPeople($this->getUser()->getpeople()); 
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(JalonConnectActionType::class, $jalonconnectaction, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $jalonconnectaction->setPublishedAt(new \DateTime());
                $jalonconnectaction->setMcustomer($this->getUser()->getCustomer());
                $jalonconnectaction->setUpdatedAt(new \DateTime());
                $jalonconnectaction->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('JalonConnectAction');
                $log->setEntry($jalonconnectaction->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le jalonconnectaction P-'.$jalonconnectaction->getId().' '.$jalonconnectaction->getJalon());

                $manager->persist($jalonconnectaction);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/jalonconnectaction_createv2.html.twig',
                        array(
                            'entity' => 'jalonconnectaction',
                            'formJalonConnectAction' => $form->createView(),
                            'editMode' => $jalonconnectaction->getId() !== null,
                            'jalonconnectaction' => $jalonconnectaction
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
                    'output' => $this->renderView('process/jalonconnectaction_createv2.html.twig',
                    array(
                        'entity' => 'jalonconnectaction',
                        'formJalonConnectAction' => $form->createView(),
                        'editMode' => $jalonconnectaction->getId() !== null,
                        'jalonconnectaction' => $jalonconnectaction
                    ))), 200);              
            }
        }
        return $response;
    }

    
}

