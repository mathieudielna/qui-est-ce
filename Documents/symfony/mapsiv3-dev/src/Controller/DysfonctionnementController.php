<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


use App\Entity\Dysfonctionnement;
use App\Entity\Log;
use App\Entity\Nonconformite;

use App\Repository\DysfonctionnementRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\TypeNonConformiteRepository;
use App\Repository\NonConformiteRepository;
use Symfony\Component\Workflow\WorkflowInterface;


use App\Form\DysfonctionnementType;
use App\Form\NonConformiteType;

class DysfonctionnementController extends AbstractController
{

    /**
     * @Route("/app/{domid}/dysfonctionnement", name="dysfonctionnement")
     * @param Dysfonctionnement $dysfonctionnement
     */
    public function indexdysfonctionnement(Request $request, WorkflowInterface $dysfonctionnementStateMachine, dysfonctionnementRepository $repodysfonctionnement, TypeConformiteRepository $repoconformite, $domid)
    {   
        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));

        if ($request->isXmlHttpRequest()) {

        if ($this->isGranted('ROLE_ADMIN')) {
            $dysfonctionnements = $repodysfonctionnement->findAllConformite($this->getUser()->getCustomer(),$conformite);
        }
        else
        {
            $dysfonctionnements = $repodysfonctionnement->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
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
                'title'=> 'Date de création',
                'data'=> 'datecreation'
                ], [
                  'title'=> 'Comply',
                  'data'=> 'comply'
                  ]
              ]
          );

          $data = array();
          foreach($dysfonctionnements as $dysfonctionnement) {
              if ($dysfonctionnement->getResponsable()) {$responsable=$dysfonctionnement->getResponsable()->getFirstname().' '.$responsable=$dysfonctionnement->getResponsable()->getLastname();}
              else {$responsable="";}
              if ($dysfonctionnement->getSuppleant()) {$suppleant=$dysfonctionnement->getSuppleant()->getFirstname().' '.$suppleant=$dysfonctionnement->getSuppleant()->getLastname();}
              else {$suppleant="";}
              $comply = '';
              foreach($dysfonctionnement->getTypeconformite() as $tc ) {$comply .= '<span class="badge badge-secondary mr-1">'.$tc->getDesignation().'</span>';}
              $statut = '<span class="badge badge-outlined badge-'.$dysfonctionnementStateMachine->getMetadataStore()->getMetadata('ambiance', $dysfonctionnement->getStatut()).'">'.$dysfonctionnementStateMachine->getMetadataStore()->getMetadata('title', $dysfonctionnement->getStatut())?? 'To do'.'</span>';

              $data[] = array(
                  'select' => '',
                  'statut' => $statut,
                  'designation' => '<a onclick="crossEntity('.$dysfonctionnement->getId().',\'dysfonctionnement\')">'.$dysfonctionnement->getDesignation().'</a>',
                  'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                  'datecreation' => '<i class="bi bi-calendar-week"></i> '.$dysfonctionnement->getCreatedAt()->format('d M Y'),
                  'comply' => $comply
              );
          } 
  
          $temp["data"]=$data;
  
          $json = array_merge($coljson, $temp);
          return new JsonResponse($json);
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'dysfonctionnement', 'domaine'=>'', 'trans'=>'oui', 'tdb'=>'']);
        } 
      }

      /** 
    * @route("/app/dysfonctionnement/ajaxcreate/{domid}", name="dysfonctionnement_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/dysfonctionnement/ajaxedit/{id}/{domid}", name="dysfonctionnement_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxdysfonctionnement(Dysfonctionnement $dysfonctionnement = null, Log $log = null, Request $request, TypeConformiteRepository $repoconformite, ObjectManager $manager, $domid){
        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));
        if(!$dysfonctionnement) {
            $dysfonctionnement = new Dysfonctionnement();
            $dysfonctionnement->setCreatedAt(new \DateTime());
            $dysfonctionnement->addPeople($this->getUser()->getpeople()); 
            $dysfonctionnement->addTypeconformite($conformite);
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(DysfonctionnementType::class, $dysfonctionnement, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $dysfonctionnement->setPublishedAt(new \DateTime());
                $dysfonctionnement->setCustomer($this->getUser()->getCustomer());
                $dysfonctionnement->setUpdatedAt(new \DateTime());
                $dysfonctionnement->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Dysfonctionnement');
                $log->setEntry($dysfonctionnement->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le dysfonctionnement P-'.$dysfonctionnement->getId().' '.$dysfonctionnement->getDesignation());

                $manager->persist($dysfonctionnement);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/dysfonctionnement_createv2.html.twig',
                        array(
                            'entity' => 'dysfonctionnement',
                            'formDysfonctionnement' => $form->createView(),
                            'editMode' => $dysfonctionnement->getId() !== null,
                            'dysfonctionnement' => $dysfonctionnement
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
                    'output' => $this->renderView('process/dysfonctionnement_createv2.html.twig',
                    array(
                        'entity' => 'dysfonctionnement',
                        'formDysfonctionnement' => $form->createView(),
                        'editMode' => $dysfonctionnement->getId() !== null,
                        'dysfonctionnement' => $dysfonctionnement
                    ))), 200);              
            }
        }
        return $response;
    }

//      /**
// 	  * @route("/app/dysfonctionnement/new", name="dysfonctionnement_create")
// 	  * @route("/app/dysfonctionnement/edit/{id}", name="dysfonctionnement_edit")
// 	  */
//       public function formdysfonctionnement(Dysfonctionnement $dysfonctionnement = null, DysfonctionnementRepository $repodysfonctionnement, TypeConformiteRepository $repoconform, Log $log = null, Request $request, ObjectManager $manager){
//         $r=$_GET["r"];$rr=$_GET["rr"];
// 	    if(!$log) { $log = new Log(); }
// 	    if(!$dysfonctionnement) {
// 		    $dysfonctionnement = new Dysfonctionnement();
//             $dysfonctionnement->setCreatedAt(new \DateTime());
//             $dysfonctionnement->addPeople($this->getUser()->getpeople());
// 			$conformite = $repoconform->findOneBy(array('customer' => $this->getUser()->getCustomer(),'designation' => $rr));
//             $dysfonctionnement->addTypeconformite($conformite);
// 		    }
// 	    $form = $this->createForm(DysfonctionnementType::class, $dysfonctionnement, array(
// 		'userCustomer' => $this->getUser()->getcustomer(),
// 		));
	    
// 	    $form->handleRequest($request);
	    
// 	    if($form->isSubmitted() && $form->isValid()){
// 		    $dysfonctionnement->setPublishedAt(new \DateTime());
// 		    $dysfonctionnement->setUpdatedAt(new \DateTime());
// 		    $manager = $this->getDoctrine()->getManager();
// 		    $dysfonctionnement->setCustomer($this->getUser()->getCustomer());
// 		    $log->setUser($this->getUser());
//         	$log->setDate(new \DateTime());
//         	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le dysfonctionnement DYS-'.$dysfonctionnement->getId().' '.$dysfonctionnement->getDesignation());
//         	$log->setCustomer($this->getUser()->getCustomer());
//         	$log->setType('Dysfonctionnement');
//         	$log->setEntry($dysfonctionnement->getId());
//         	$manager->persist($dysfonctionnement);
//         	$manager->flush();
//         	$this->addFlash(
//             'success',
//             'Vos modifications sont enregistrées'
//         );
//             return $this->redirectToRoute('dysfonctionnement_edit',[ 
//             'r' => $r,
//             'rr' => $rr,
//             'id' => $dysfonctionnement->getId()
//             ]);
//         }
        

//         if($this->isGranted('ROLE_ADMIN') OR !$dysfonctionnement->getId() OR $repodysfonctionnement->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$dysfonctionnement->getId()))
// 		{
//             return $this->render('blog/dysfonctionnement_create.html.twig',[ 
//                 'formDysfonctionnement' => $form->createView(),
//                 'editMode' => $dysfonctionnement->getId() !== null,
//                 'dysfonctionnement' => $dysfonctionnement,
//                 'r' => $r,
//                 'rr' => $rr
//                 ]);
// 		}
// 		else
// 		{
// 			$this->addFlash(
// 				'warning',
// 				'Vous n\'avez pas accès à ce dysfonctionnement'
// 				);
// 			return $this->redirectToRoute($r);
// 		}  
//     }

//     /**
// 	  * @route("/app/dysfonctionnement/remove/{id}", name="audit_remove")
// 	*/
//     public function deletedys(Dysfonctionnement $dysfonctionnement, DysfonctionnementRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
//     { $r=$_GET["r"];$rr=$_GET["rr"];
//        $manager->remove($dysfonctionnement);
//        $manager->flush();

//     $this->addFlash(
//         'success',
//         'Le dysfonctionnement est supprimée'
//     );
//        $dysfonctionnements = $repo->findAll();
//        return $this->redirectToRoute($r);
//   }
  
//   /**
//   * @route("/app/dysfonctionnement/{id}/{statut}", name="dysfonctionnement_workflow")
//   * @param $statut
//   * @param Dysfonctionnement $dysfonctionnement
//   * @internal param Registry $workflows
//   */
//   public function wkaudit(Dysfonctionnement $dysfonctionnement, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
//   {
//       $workflow = $this->state_machines->get($dysfonctionnement);
//       if($workflow->can($dysfonctionnement, $statut)) {
//           $manager = $this->getDoctrine()->getManager();
//           $workflow->apply($dysfonctionnement, $statut);
//           $dysfonctionnement->setValidatedAt(new \DateTime());
//           $dysfonctionnement->setValidator($this->getUser()->getpeople());
//           $dysfonctionnement->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
//           $dysfonctionnement->setReportedAt(new \DateTime());
          
//           $manager->persist($dysfonctionnement);
//           $manager->flush();

//           $this->addFlash(
//               'success',
//               "Votre demande est transmise, merci"
//               );
//           $r=$_GET["r"];$rr=$_GET["rr"];
//           return $this->redirectToRoute('dysfonctionnement_edit',[ 
//               'r' => $r,
//               'rr' => $rr,
//               'id' => $dysfonctionnement->getId()
//               ]);
//       }
//   }
}
