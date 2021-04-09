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
use App\Service\EmailService;
use App\Service\WorkflowService;
use Symfony\Component\Templating\EngineInterface;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;



class SystemeController extends AbstractController
{
     /**
     * @Route("/app/{domid}/systeme", name="systeme")
     * @param Systeme $systeme
     */
    public function indexrisque(Request $request, systemeRepository $reposysteme, $domid)
    {   
        if ($request->isXmlHttpRequest()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $systemes = $reposysteme->findByCustomer($this->getUser()->getCustomer());
            }
            else
            {
                $systemes = $reposysteme->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
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
                'title'=> 'Relation',
                'data'=> 'relation'
                ], [
                    'title'=> 'Comply',
                    'data'=> 'comply'
                    ]
                ]
            );
            
            
            $data = array();
            foreach($systemes as $systeme) {
                if ($systeme->getResponsable()) {$responsable=$systeme->getResponsable()->getFirstname().' '.$responsable=$systeme->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($systeme->getSuppleant()) {$suppleant=$systeme->getSuppleant()->getFirstname().' '.$suppleant=$systeme->getSuppleant()->getLastname();}
                else {$suppleant="";}
                $data[] = array(
                    'select' => '',
                    'statut' => '',
                    'designation' => '<a onclick="crossEntity('.$systeme->getId().',\'systeme\')">'.$systeme->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
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
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'systeme', 'domaine'=>'', 'trans'=>'', 'tdb'=>'']);
        }
    }

    /** 
    * @route("/app/systeme/ajaxcreate", name="systeme_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/systeme/ajaxedit/{id}/{entite}", name="systeme_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxsysteme(Systeme $systeme = null, Activite $activite = null, Log $log = null, Request $request, ObjectManager $manager){
        if(!$systeme) {
            $systeme = new Systeme();
            $systeme->setCreatedAt(new \DateTime());
            $systeme->addPeople($this->getUser()->getPeople()); 
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(SystemeType::class, $systeme, array(
            'userCustomer' => $this->getUser()->getcustomer()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $systeme->setPublishedAt(new \DateTime());
                $systeme->setCustomer($this->getUser()->getCustomer());
                $systeme->setUpdatedAt(new \DateTime());
                $systeme->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Systeme');
                $log->setEntry($systeme->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le systeme APP-'.$systeme->getId().' '.$systeme->getDesignation());

                $manager->persist($systeme);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/systeme_createv2.html.twig',
                        array(
                            'entity' => 'systeme',
                            'formSysteme' => $form->createView(),
                            'editMode' => $systeme->getId() !== null,
                            'systeme' => $systeme
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
                    'output' => $this->renderView('process/systeme_createv2.html.twig',
                    array(
                        'entity' => 'systeme',
                        'formSysteme' => $form->createView(),
                        'editMode' => $systeme->getId() !== null,
                        'systeme' => $systeme
                    ))), 200);              
            }
        }
        return $response;
    }

    
}

