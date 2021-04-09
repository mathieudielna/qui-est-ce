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
use App\Repository\ProjetRepository;
use App\Repository\RisqueRepository;
use App\Repository\AxeRepository;
use App\Repository\ControleRepository;



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



class AxeController extends AbstractController
{


     /**
     * @Route("/app/axe", name="axe")
     * @internal param Registry $workflows
     * @param Axe $axe
     */
    public function indexaxe(Request $request, axeRepository $repoaxe)
    {   
        
        if ($this->isGranted('ROLE_ADMIN')) {
            $axes = $repoaxe->findByCustomer($this->getUser()->getCustomer());
        }
        else
        {
            $axes = $repoaxe->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getAxe());
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
              'data'=> 'designation'
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
        foreach($axes as $axe) {
            if ($axe->getResponsable()) {$responsable=$axe->getResponsable()->getFirstname().' '.$responsable=$axe->getResponsable()->getLastname();}
            else {$responsable="";}
            if ($axe->getSuppleant()) {$suppleant=$axe->getSuppleant()->getFirstname().' '.$suppleant=$axe->getSuppleant()->getLastname();}
            else {$suppleant="";}
            $data[] = array(
                'select' => '',
                'statut' => '',
                'designation' => '<a onclick="crossEntity('.$axe->getId().',\'axe\')">'.$axe->getDesignation().'</a>',
                'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                'relation' => '',
                'comply' => ''
            );
        } 

        $temp["data"]=$data;

        $json = array_merge($coljson, $temp);
        return new JsonResponse($json);
    }

    
}

