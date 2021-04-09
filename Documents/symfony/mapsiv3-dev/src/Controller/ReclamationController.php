<?php
namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Log;
use App\Entity\MapsiCustomer;

use App\Repository\ReclamationRepository;
use App\Repository\TypeConformiteRepository;

use App\Form\ReclamationType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Workflow\Registry;
use App\Service\EmailService;
use Symfony\Component\Workflow\WorkflowInterface;

use Symfony\Component\HttpFoundation\JsonResponse;



class ReclamationController extends AbstractController
{
     /**
     * @Route("/app/{domid}/reclamation", name="reclamation")
     */
    public function indextest(Request $request, WorkflowInterface $reclamationStateMachine, reclamationRepository $reporeclamation, TypeConformiteRepository $repoconformite, $domid)
    {   

        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));

        if ($request->isXmlHttpRequest()) {
        
            if ($this->isGranted('ROLE_ADMIN')) {
                $reclamations = $reporeclamation->findAllConformite($this->getUser()->getCustomer(),$conformite);
            }
            else
            {
                $reclamations = $reporeclamation->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
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
                'title'=> 'Date de créatiion',
                'data'=> 'datecreation'
                ], [
                'title'=> 'Comply',
                'data'=> 'comply'
                ]
                ]
            );
            
            
            $data = array();
            foreach($reclamations as $reclamation) {
                if ($reclamation->getResponsable()) {$responsable=$reclamation->getResponsable()->getFirstname().' '.$responsable=$reclamation->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($reclamation->getSuppleant()) {$suppleant=$reclamation->getSuppleant()->getFirstname().' '.$suppleant=$reclamation->getSuppleant()->getLastname();}
                else {$suppleant="";}
                $comply = '';
                foreach($reclamation->getTypeconformite() as $tc ) {$comply .= '<span class="badge badge-secondary mr-1">'.$tc->getDesignation().'</span>';}
                $statut = '<span class="badge badge-outlined badge-'.$reclamationStateMachine->getMetadataStore()->getMetadata('ambiance', $reclamation->getStatut()).'">'.$reclamationStateMachine->getMetadataStore()->getMetadata('title', $reclamation->getStatut())?? 'To do'.'</span>';
                $data[] = array(
                    'select' => '',
                    'statut' => $statut,
                    
                    'designation' => '<a onclick="crossEntity('.$reclamation->getId().',\'reclamation\')">'.$reclamation->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'datecreation' => '<i class="bi bi-calendar-week"></i> '.$reclamation->getCreatedAt()->format('d M Y'),
                    'comply' => $comply
                );
            } 

            $temp["data"]=$data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json);
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'reclamation', 'domaine'=>'', 'trans'=>'oui', 'tdb'=>'']);
        } 
    }

    /** 
    * @route("/app/reclamation/ajaxcreate/{domid}", name="reclamation_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/reclamation/ajaxedit/{id}/{domid}", name="reclamation_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxreclamation(Reclamation $reclamation = null, Log $log = null, Request $request, TypeConformiteRepository $repoconformite, ObjectManager $manager, $domid){
        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));
        if(!$reclamation) {
            $reclamation = new Reclamation();
            $reclamation->setCreatedAt(new \DateTime());
            $reclamation->addPeople($this->getUser()->getpeople()); 
            $reclamation->addTypeconformite($conformite);
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(ReclamationType::class, $reclamation, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $reclamation->setPublishedAt(new \DateTime());
                $reclamation->setCustomer($this->getUser()->getCustomer());
                $reclamation->setUpdatedAt(new \DateTime());
                $reclamation->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Reclamation');
                $log->setEntry($reclamation->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le reclamation P-'.$reclamation->getId().' '.$reclamation->getDesignation());

                $manager->persist($reclamation);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/reclamation_createv2.html.twig',
                        array(
                            'entity' => 'reclamation',
                            'formReclamation' => $form->createView(),
                            'editMode' => $reclamation->getId() !== null,
                            'reclamation' => $reclamation
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
                    'output' => $this->renderView('process/reclamation_createv2.html.twig',
                    array(
                        'entity' => 'reclamation',
                        'formReclamation' => $form->createView(),
                        'editMode' => $reclamation->getId() !== null,
                        'reclamation' => $reclamation
                    ))), 200);              
            }
        }
        return $response;
    }


//     /**
// 	* @route("/app/reclamation/new", name="reclamation_create")
// 	* @route("/app/reclamation/edit/{id}", name="reclamation_edit")
// 	*/
//     public function formreclamation(Reclamation $reclamation = null, TypeConformiteRepository $repoconform, ReclamationRepository $reporeclamation, Log $log = null, Request $request, ObjectManager $manager)
//     {
//         $r=$_GET["r"];$rr=$_GET["rr"];

// 	    if(!$log) { $log = new Log(); }
//         if(!$reclamation) 
//         { 
//             $reclamation = new Reclamation();
//             $reclamation->setCreatedAt(new \DateTime());
//             $reclamation->addPeople($this->getUser()->getPeople()); 
//             $conformite = $repoconform->findOneBy(array('customer' => $this->getUser()->getCustomer(),'designation' => $rr));
//             $reclamation->addTypeconformite($conformite);
//             $reclamation->setCreatedAt(new \DateTime());
//             $workflow = $this->state_machines->get($reclamation);
//             $workflow->getMarking($reclamation);

//         }
// 		$form = $this->createForm(ReclamationType::class, $reclamation, array(
// 		'userCustomer' => $this->getUser()->getcustomer(),
// 		'userPeople' => $this->getUser()->getPeople()
// 		));
		
// 	    $form->handleRequest($request);
	    
// 	    if($form->isSubmitted() && $form->isValid()){
// 			$manager = $this->getDoctrine()->getManager();
// 		    $reclamation->setPublishedAt(new \DateTime());
// 		    $reclamation->setPublisher($this->getUser()->getPeople());
// 		    $reclamation->setCustomer($this->getUser()->getCustomer());
// 		    $log->setUser($this->getUser());
//         	$log->setDate(new \DateTime());
//         	$log->setType('Reclamation Traitement');
//         	$log->setEntry($reclamation->getId());
//         	$log->setCustomer($this->getUser()->getCustomer());
//         	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié la réclamation REC-'.$reclamation->getId().' '.$reclamation->getDesignation());
            
//         	$manager->persist($reclamation);
//         	$manager->flush();
//         	$this->addFlash(
//             'success',
//             'Vos modifications sont enregistrées pour la réclamation : '.$reclamation->getDesignation()
//         );
            
//         return $this->redirectToRoute('reclamation_edit',[ 
//             'r' => $r,
//             'rr' => $rr,
//             'id' => $reclamation->getId()
//             ]);
        	
// 		}
//         if($this->isGranted('ROLE_ADMIN') OR !$reclamation->getId() OR $reporeclamation->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$reclamation->getId()))
//         {
            
//             return $this->render('blog/reclamation_create.html.twig',[ 
//             'formReclamation' => $form->createView(),
//             'editMode' => $reclamation->getId() !== null,
//             'r' => $r,
//             'rr' => $rr,
//             'reclamation' => $reclamation
//             ]);
//         }
//         else
//         {
//             $this->addFlash(
//                 'warning',
//                 "Vous n\'avez pas accès à cette réclamation"
//                 );
//             return $this->redirectToRoute($r);
//         }  
//     }

//     /**
//     * @route("/app/reclamation/{id}/{statut}", name="reclamation_workflow")
//     * @param $statut
//     * @param Reclamation $reclamation
//     * @internal param Registry $workflows
//     */
//     public function toReview(Reclamation $reclamation, $statut, ObjectManager $manager, EmailService $emailservice)
//     {
//         $r=$_GET["r"];$rr=$_GET["rr"];
//            $workflow = $this->state_machines->get($reclamation);
//         if($workflow->can($reclamation, $statut)) {
//             $manager = $this->getDoctrine()->getManager();
//             $workflow->apply($reclamation, $statut);
//             $reclamation->setValidatedAt(new \DateTime());
//             $reclamation->setValidator($this->getUser()->getpeople());
//             $reclamation->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
            
//             $manager->persist($reclamation);
//             $manager->flush();
//             $this->addFlash(
//                 'success',
//                 "Le traitement est passé a l\'état ".$reclamation->getStatut()
//                 );

//             if (($reclamation->getStatut() == 'rejected' || $reclamation->getStatut() == 'draft' ) && $reclamation->getRedacteur() && $reclamation->getRedacteur()->getEmail()) {
//                 $this->addFlash('success', 'Une notification est envoyée à '.$reclamation->getRedacteur()->getFirstname().' '.$reclamation->getRedacteur()->getLastname());
//                 $emailservice->sendEmail($reclamation->getRedacteur()->getFirstname(), $reclamation->getDesignation(),$reclamation->getRedacteur()->getEmail(),'mise à jour','reclamation_edit',$reclamation->getSlug(), $reclamation->getId(), $r, $rr, 'Le traitement',$this->getUser()->getCustomer()->getDesignation());
//             }
//             elseif (($reclamation->getStatut() == 'review' && $reclamation->getResponsable() && $reclamation->getResponsable()->getEmail())) {
//                 $this->addFlash('success', 'Une notification est envoyée à '.$reclamation->getResponsable()->getFirstname().' '.$reclamation->getResponsable()->getLastname());
//                 $emailservice->sendEmail($reclamation->getResponsable()->getFirstname(), $reclamation->getDesignation(),$reclamation->getResponsable()->getEmail(),'validation','reclamation_edit',$reclamation->getSlug(), $reclamation->getId(), $r, $rr, 'Le traitement',$this->getUser()->getCustomer()->getDesignation());
//             }
//             elseif (($reclamation->getStatut() == 'validation')) {
//                 $this->addFlash('success', 'Une notification est envoyée à '.$this->getUser()->getCustomer()->getDpo()->getFirstname().' '.$this->getUser()->getCustomer()->getDpo()->getLastname());
//                 $emailservice->sendEmail($this->getUser()->getCustomer()->getDpo()->getFirstname(), $reclamation->getDesignation(),$this->getUser()->getCustomer()->getDpo()->getEmail(),'validation','reclamation_edit',$reclamation->getSlug(), $reclamation->getId(), $r, $rr, 'traitement',$this->getUser()->getCustomer()->getDesignation());
//             }
//             elseif (($reclamation->getStatut() == 'validation_ok' && $reclamation->getResponsable() && $reclamation->getResponsable()->getEmail())) {
//                 $this->addFlash('success', 'Une notification est envoyée à '.$reclamation->getResponsable()->getFirstname().' '.$reclamation->getResponsable()->getLastname());
//             }
//             else
//             {
//                 $this->addFlash('warning', 'L\'état du traitement est modifié, mais la notification est impossible car les rôles ou les emails ne sont pas renseignés');
//             }
          
            
            
//             return $this->redirectToRoute('reclamation_edit',[ 
//                 'r' => $r,
//                 'rr' => $rr,
//                 'id' => $reclamation->getId()
//                 ]);
//         }
//     }

//     /**
// 	* @route("/app/reclamation/remove/{id}", name="reclamation_remove")
// 	*/
//       public function deletereclamation(Reclamation $reclamation, ReclamationRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
//     {
//     if(!$log) { $log = new Log(); }
//       $log->setUser($this->getUser());
//       $log->setDate(new \DateTime());
//       $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a supprimé le reclamation FX-'.$reclamation->getId().' '.$reclamation->getDesignation());
//       $log->setCustomer($this->getUser()->getCustomer());
//       $log->setEntry($reclamation->getId());
//       $log->setType('Reclamation');
//       $manager->persist($log);
//          $manager->remove($reclamation);
//          $manager->flush();
     
//       $this->addFlash(
//               'success',
//               'Le reclamation est supprimé'
//               );
     
//          $reclamations = $repo->findAll();
//          return $this->redirectToRoute('process_list');    
//    }
}
