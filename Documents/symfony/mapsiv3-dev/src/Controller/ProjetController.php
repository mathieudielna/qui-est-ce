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
use App\Repository\ProjetRepository;
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
use App\Form\ProjetType;


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



class ProjetController extends AbstractController
{


     /**
     * @Route("/app/{domid}/projet", name="projet")
     */
    public function indexrisque(Request $request, projetRepository $repoprojet, $domid)
    {   
        if ($request->isXmlHttpRequest()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $projets = $repoprojet->findByCustomer($this->getUser()->getCustomer());
            }
            else
            {
                $projets = $repoprojet->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getProjet());
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
                ],[
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
            foreach($projets as $projet) {
                if ($projet->getResponsable()) {$responsable=$projet->getResponsable()->getFirstname().' '.$responsable=$projet->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($projet->getSuppleant()) {$suppleant=$projet->getSuppleant()->getFirstname().' '.$suppleant=$projet->getSuppleant()->getLastname();}
                else {$suppleant="";}
                $projetavg = $repoprojet->findProgressionProjet($this->getUser()->getCustomer(),$projet->getId());
                $projetavg = round($projetavg, 0);
                $data[] = array(
                    'select' => '',
                    'statut' => '',
                    'designation' => '<a onclick="crossEntity('.$projet->getId().',\'projet\')">'.$projet->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'progression' => '<div class="progress"><div class="progress-bar" role="progressbar" style="width: '.$projetavg.'%;" aria-valuenow="'.$projetavg.'" aria-valuemin="0" aria-valuemax="100">'.$projetavg.'%</div></div>',
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
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'projet', 'domaine'=>'', 'trans'=>'', 'tdb'=>'']);
        } 
    }

    /** 
    * @route("/app/projet/ajaxcreate", name="projet_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/projet/ajaxedit/{id}/{entite}", name="projet_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxprojet(Projet $projet = null, Activite $activite = null, Log $log = null, Request $request, ObjectManager $manager){
        if(!$projet) {
            $projet = new Projet();
            $projet->setCreatedAt(new \DateTime());
            $projet->addPeople($this->getUser()->getpeople()); 
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(ProjetType::class, $projet, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $projet->setPublishedAt(new \DateTime());
                $projet->setCustomer($this->getUser()->getCustomer());
                $projet->setUpdatedAt(new \DateTime());
                $projet->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Projet');
                $log->setEntry($projet->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le projet P-'.$projet->getId().' '.$projet->getDesignation());

                $manager->persist($projet);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/projet_createv2.html.twig',
                        array(
                            'entity' => 'projet',
                            'formProjet' => $form->createView(),
                            'editMode' => $projet->getId() !== null,
                            'projet' => $projet
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
                    'output' => $this->renderView('process/projet_createv2.html.twig',
                    array(
                        'entity' => 'projet',
                        'formProjet' => $form->createView(),
                        'editMode' => $projet->getId() !== null,
                        'projet' => $projet
                    ))), 200);              
            }
        }
        return $response;
    }

    
}

