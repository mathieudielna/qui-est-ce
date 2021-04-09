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
use App\Form\ProgramType;
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
use App\Service\EmailService;
use App\Service\WorkflowService;
use Symfony\Component\Templating\EngineInterface;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;



class ProgramController extends AbstractController
{


     /**
     * @Route("/app/{domid}/program", name="program")
     * @internal param Registry $workflows
     * @param Program $program
     */
    public function indexrisque(Request $request, programRepository $repoprogram, $domid)
    {   
        if ($request->isXmlHttpRequest()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $programs = $repoprogram->findByCustomer($this->getUser()->getCustomer());
            }
            else
            {
                $programs = $repoprogram->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getProgram());
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
                'title'=> 'Relation',
                'data'=> 'relation'
                ], [
                    'title'=> 'Comply',
                    'data'=> 'comply'
                    ]
                ]
            );
            
            
            $data = array();
            foreach($programs as $program) {
                if ($program->getResponsable()) {$responsable=$program->getResponsable()->getFirstname().' '.$responsable=$program->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($program->getSuppleant()) {$suppleant=$program->getSuppleant()->getFirstname().' '.$suppleant=$program->getSuppleant()->getLastname();}
                else {$suppleant="";}
                $programavg = $repoprogram->findProgressionProgram($this->getUser()->getCustomer(),$program->getId());
                $programavg = round($programavg, 0);
                $data[] = array(
                    'select' => '',
                    'statut' => '',
                    'designation' => '<a onclick="crossEntity('.$program->getId().',\'program\')">'.$program->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'progression' => '<div class="progress"><div class="progress-bar" role="progressbar" style="width: '.$programavg.'%;" aria-valuenow="'.$programavg.'" aria-valuemin="0" aria-valuemax="100">'.$programavg.'%</div></div>',
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
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'program', 'domaine'=>'', 'trans'=>'', 'tdb'=>'']);
        } 
    }

    /** 
    * @route("/app/program/ajaxcreate", name="program_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/program/ajaxedit/{id}/{entite}", name="program_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxprogram(Program $program = null, Activite $activite = null, Log $log = null, Request $request, ObjectManager $manager){
        if(!$program) {
            $program = new Program();
            $program->setCreatedAt(new \DateTime());
            $program->addPeople($this->getUser()->getpeople()); 
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(ProgramType::class, $program, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $program->setPublishedAt(new \DateTime());
                $program->setCustomer($this->getUser()->getCustomer());
                $program->setUpdatedAt(new \DateTime());
                $program->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Program');
                $log->setEntry($program->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le program P-'.$program->getId().' '.$program->getDesignation());

                $manager->persist($program);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/program_createv2.html.twig',
                        array(
                            'entity' => 'program',
                            'formProgram' => $form->createView(),
                            'editMode' => $program->getId() !== null,
                            'program' => $program
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
                    'output' => $this->renderView('process/program_createv2.html.twig',
                    array(
                        'entity' => 'program',
                        'formProgram' => $form->createView(),
                        'editMode' => $program->getId() !== null,
                        'program' => $program
                    ))), 200);              
            }
        }
        return $response;
    }

    
}

