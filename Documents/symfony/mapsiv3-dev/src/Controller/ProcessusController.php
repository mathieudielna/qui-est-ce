<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Entity\Axe;
use App\Entity\Log;
use App\Entity\Processus;
use App\Form\ProcessusType;
use App\Repository\ProcessusRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\WorkflowInterface;

class ProcessusController extends AbstractController
{

    /**
     * @Route("/app/{domid}/processus", name="processus")
     */
    public function indexprocessus(Request $request, WorkflowInterface $processusStateMachine, processusRepository $repoprocessus, $domid)
    {

        if ($request->isXmlHttpRequest()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $processuses = $repoprocessus->findByCustomer($this->getUser()->getCustomer());
            } else {
                $processuses = $repoprocessus->findAllCustomerUser($this->getUser()->getCustomer(), $this->getUser()->getPeople());
            }

            $coljson = array(
                'columns' => [
                    [
                        'title' => '',
                        'data' => 'select-checkbox',
                        'className' => 'select-checkbox tableselect',
                    ], [
                        'title' => 'Statut',
                        'data' => 'statut',
                        'className' => 'statut export',
                    ], [
                        'title' => 'Désignation',
                        'data' => 'designation',
                        'className' => 'table-title export',
                    ], [
                        'title' => 'Equipe',
                        'data' => 'responsable',
                        'className' => 'export equipe',
                    ], [
                        'title' => 'Type',
                        'data' => 'type',
                        'className' => 'relation-col export',
                    ], [
                        'title' => 'Relation',
                        'data' => 'relation',
                        'className' => 'relation-col export',
                    ], [
                        'title' => 'Comply',
                        'data' => 'comply',
                    ],
                ],
            );

            $data = array();
            foreach ($processuses as $processus) {
                if ($processus->getResponsable()) {$responsable = $processus->getResponsable()->getFirstname() . ' ' . $responsable = $processus->getResponsable()->getLastname();} else { $responsable = "";}
                if ($processus->getSuppleant()) {$suppleant = $processus->getSuppleant()->getFirstname() . ' ' . $suppleant = $processus->getSuppleant()->getLastname();} else { $suppleant = "";}
                if ($processus->getTypeprocessus()) {$type = $processus->getTypeprocessus()->getDesignation();} else { $type = "";}

                $relationactivite = '';
                $relationactivite1 = '';
                $relationactivite2 = '';if (count($processus->getActivites()) >= 1) {
                    $relationactivite1 = '';
                    $relationactivite = '
                    <span class="dropdown tablerelation">
                            <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <i class="bi bi-bezier tablerelation icon"></i> <strong class="tablerelation">' . count($processus->getActivites()) . '</strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h4 class="tablerelation"><i class="bi bi-bezier icon"></i>  Activités</h4>';
                    foreach ($processus->getActivites() as $act) {$relationactivite1 .= '<a class="dropdown-item small" onclick="crossEntity(' . $act->getId() . ',\'activite\')">' . $act->getDesignation() . '</a>';}
                    $relationactivite2 = '</div></span>';
                }

                $relationobjectif = '';
                $relationobjectif1 = '';
                $relationobjectif2 = '';if (count($processus->getObjectifs()) >= 1) {
                    $relationobjectif1 = '';
                    $relationobjectif = '
                    <span class="dropdown tablerelation">
                            <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-graph-up tablerelation icon"></i> <strong class="tablerelation">' . count($processus->getObjectifs()) . '</strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h4 class="tablerelation"><i class="bi bi-graph-up icon"></i> Objectifs</h4>';
                    foreach ($processus->getObjectifs() as $obj) {$relationobjectif1 .= '<a class="dropdown-item small" onclick="crossEntity(' . $obj->getId() . ',\'objectif\')">' . $obj->getDesignation() . '</a>';}
                    $relationobjectif2 = '</div></span>';
                }

                $relationaction = '';
                $relationaction1 = '';
                $relationaction2 = '';if (count($processus->getActions()) >= 1) {
                    $relationaction1 = '';
                    $relationaction = '
                    <span class="dropdown tablerelation">
                            <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-kanban tablerelation icon"></i> <strong class="tablerelation">' . count($processus->getActions()) . '</strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h4 class="tablerelation"><i class="bi bi-kanban icon"></i> Actions</h4>';
                    foreach ($processus->getActions() as $action) {$relationaction1 .= '<a class="dropdown-item small" onclick="crossEntity(' . $action->getId() . ',\'action\')">' . $action->getDesignation() . '</a>';}
                    $relationaction2 = '</div></span>';
                }
                $relationrisque = '';
                $relationrisque1 = '';
                $relationrisque2 = '';if (count($processus->getRisques()) >= 1) {
                    $relationrisque1 = '';
                    $relationrisque = '
                    <span class="dropdown tablerelation">
                            <button class="btn btn-alert btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-exclamation-circle tablerelation icon"></i> <strong class="tablerelation">' . count($processus->getRisques()) . '</strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h4 class="tablerelation"><i class="bi bi-exclamation-circle icon"></i> Risques</h4>';
                    foreach ($processus->getRisques() as $ri) {$relationrisque1 .= '<a class="dropdown-item small" onclick="crossEntity(' . $ri->getId() . ',\'risque\')">' . substr($ri->getDesignation(), 0, 25) . '...</a>';}
                    $relationrisque2 = '</div></span>';
                }

                // $title = $processusStateMachine->getPlace()->getMetadataStore()->getMetadata('title') ?? 'To do';
                $statut = '<span class="badge badge-outlined badge-' . $processusStateMachine->getMetadataStore()->getMetadata('ambiance', $processus->getStatut()) . '">' . $processusStateMachine->getMetadataStore()->getMetadata('title', $processus->getStatut()) ?? 'To do' . '</span>';

                if (count($processus->getPeoples()) > 0) {$peoples = '<strong>' . $responsable . '</strong><br>' . $suppleant . '<span class="badge badge-secondary float-right">+' . count($processus->getPeoples()) . '</span>';} else { $peoples = '<strong>' . $responsable . '</strong><br>' . $suppleant;}

                $data[] = array(
                    'select-checkbox' => '',
                    'statut' => $statut,
                    'designation' => '<a onclick="crossEntity(' . $processus->getId() . ',\'processus\')">' . $processus->getDesignation() . '</a>',
                    'responsable' => $peoples,
                    'type' => '<span class="badge badge-secondary">' . $type . '</span>',
                    'relation' =>
                    $relationactivite . ' ' . $relationactivite1 . ' ' . $relationactivite2 . ' ' .
                    $relationobjectif . ' ' . $relationobjectif1 . ' ' . $relationobjectif2 . ' ' .
                    $relationaction . ' ' . $relationaction1 . ' ' . $relationaction2 . ' ' .
                    $relationrisque . ' ' . $relationrisque1 . ' ' . $relationrisque2,
                    'comply' => '',
                );
            }

            $temp["data"] = $data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json);
        } else {
            return $this->redirectToRoute('switch', ['domid' => $domid, 'entite' => 'processus', 'domaine' => '', 'trans' => '', 'tdb' => '']);
        }
    }

    /**
     * Permet la modification et la création de processus
     *
     * @route("/app/processus/ajaxcreate/{domid}", name="processus_ajaxcreate", methods={"POST", "GET"})
     * @route("/app/processus/ajaxedit/{id}/{domid}", name="processus_ajaxedit", methods={"POST", "GET"})
     */
    public function ajaxprocessus(Processus $processus = null, Activite $activite = null, Log $log = null, Request $request, ObjectManager $manager, $domid)
    {
        if (!$processus) {
            $processus = new Processus();
            $processus->setCreatedAt(new \DateTime());
            $processus->addPeople($this->getUser()->getpeople());
        }
        if (!$log) {
            $log = new Log();
        }
        $form = $this->createForm(ProcessusType::class, $processus, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople(),
        ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $processus->setPublishedAt(new \DateTime());
                $processus->setCustomer($this->getUser()->getCustomer());
                $processus->setUpdatedAt(new \DateTime());
                $processus->setPublisher($this->getUser()->getpeople());
                foreach ($processus->getObjectifs() as $obj) {$obj->setCustomer($this->getUser()->getCustomer());}
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Processus');
                $log->setEntry($processus->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom() . ' a modifié le processus P-' . $processus->getId() . ' ' . $processus->getDesignation());

                $manager->persist($processus);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/processus_createv2.html.twig',
                            array(
                                'entity' => 'processus',
                                'formProcessus' => $form->createView(),
                                'editMode' => $processus->getId() !== null,
                                'processus' => $processus,
                            ))), 200);
                $this->addFlash(
                    'success',
                    'Vos modifications sont enregistrées'
                );
            } else {
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/processus_createv2.html.twig',
                            array(
                                'entity' => 'processus',
                                'formProcessus' => $form->createView(),
                                'editMode' => $processus->getId() !== null,
                                'processus' => $processus,
                            ))), 200);
            }
        }
        return $response;
    }
}
