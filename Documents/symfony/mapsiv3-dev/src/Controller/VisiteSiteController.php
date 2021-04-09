<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Psr\Log\LoggerInterface;
use Twig\Extensions\IntlExtension;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Workflow\WorkflowInterface;


use App\Entity\VisiteSite;
use App\Entity\Log;
use App\Entity\Nonconformite;

use App\Repository\VisiteSiteRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\TypeNonConformiteRepository;
use App\Repository\NonConformiteRepository;

use App\Form\VisiteSiteType;
use App\Form\NonConformiteType;

class VisiteSiteController extends AbstractController
{

    /**
     * @Route("/app/{domid}/visite_site", name="visite")
     */
    public function indextest(Request $request, VisiteSiteRepository $repovisite, WorkflowInterface $visitesiteStateMachine, TypeConformiteRepository $repoconformite, $domid)
    {   
        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));

        if ($request->isXmlHttpRequest()) {

            if ($this->isGranted('ROLE_ADMIN')) {
                $visites = $repovisite->findAllConformite($this->getUser()->getCustomer(),$conformite);
            }
            else
            {
                $visites = $repovisite->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
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
                'data'=> 'relation'
                ], [
                'title'=> 'Date de visite',
                'data'=> 'datevisite'
                ], [
                'title'=> 'Comply',
                'data'=> 'comply'
                ]
                ]
            );
            
            
            $data = array();
            foreach($visites as $visite) {
                if ($visite->getResponsable()) {$responsable=$visite->getResponsable()->getFirstname().' '.$responsable=$visite->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($visite->getSuppleant()) {$suppleant=$visite->getSuppleant()->getFirstname().' '.$suppleant=$visite->getSuppleant()->getLastname();}
                else {$suppleant="";}
                $relationsite ='';$relationsite1 = '';$relationsite2 = ''; if (count($visite->getSites()) >= 1) {
                $relationsite ='
                <span class="dropdown tablerelation">
                        <button class="btn btn-outline-primary dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-building tablerelation icon"></i> <strong class="tablerelation">'.count($visite->getSites()).'</strong>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <h4 class="tablerelation"> Activités</h4>';
                            foreach($visite->getSites() as $site ) 
                            {$relationsite1 .='<a class="dropdown-item" onclick="crossEntity('.$site->getId().',\'site\')">'.$site->getDesignation().'</a>';}
                $relationsite2 = '</div></span>';
                }
                $relationres ='';$relationres1 = '';$relationres1 = ''; if (count($visite->getRessources()) >= 1) {
                $relationres ='
                <span class="dropdown tablerelation">
                        <button class="btn btn-outline-primary dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-box tablerelation icon"></i> <strong class="tablerelation">'.count($visite->getRessources()).'</strong>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <h4 class="tablerelation"> Activités</h4>';
                            foreach($visite->getRessources() as $ressource ) 
                            {$relationres1 .='<a class="dropdown-item" onclick="crossEntity('.$ressource->getId().',\'ressource\')">'.$ressource->getDesignation().'</a>';}
                $relationres2 = '</div></span>';
                }
                $relationdys ='';$relationdys1 = '';$relationdys1 = ''; if (count($visite->getDysfonctionnements()) >= 1) {
                $relationdys ='
                <span class="dropdown tablerelation">
                        <button class="btn btn-outline-warning dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-exclamation-triangle tablerelation icon"></i> <strong class="tablerelation">'.count($visite->getDysfonctionnements()).'</strong>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <h4 class="tablerelation"> Activités</h4>';
                            foreach($visite->getDysfonctionnements() as $dys ) 
                            {$relationdys1 .='<a class="dropdown-item" onclick="crossEntity('.$dys->getId().',\'dysfonctionnement\')">'.$dys->getDesignation().'</a>';}
                $relationdys2 = '</div></span>';
                }
                $comply = '';

                foreach($visite->getTypeconformite() as $tc ) {$comply .= '<span class="badge badge-secondary mr-1">'.$tc->getDesignation().'</span>';}

                $statut = '<span class="badge badge-outlined badge-'.$visitesiteStateMachine->getMetadataStore()->getMetadata('ambiance', $visite->getStatut()).'">'.$visitesiteStateMachine->getMetadataStore()->getMetadata('title', $visite->getStatut())?? 'To do'.'</span>';

                $data[] = array(
                    'select' => '',
                    'statut' => $statut,
                    'designation' => '<a onclick="crossEntity('.$visite->getId().',\'visite_site\')">'.$visite->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'relation' => $relationsite.' '. $relationsite1.' '. $relationsite2.' '.
                        $relationdys.' '. $relationdys1.' '. $relationdys2.' '.
                        $relationres.' '. $relationres1.' '. $relationres2,
                    'datevisite' => '<i class="bi bi-calendar-week"></i> '.$visite->getVisitedAt()->format('d M Y'),                    
                    'comply' => $comply
                );
            } 

            $temp["data"]=$data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json);
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'visite_site', 'domaine'=>'', 'trans'=>'oui', 'tdb'=>'']);
        } 
    }


    /** 
    * @route("/app/visite_site/ajaxcreate/{domid}", name="visitesite_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/visite_site/ajaxedit/{id}/{domid}", name="visitesite_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxvisitesite(VisiteSite $visitesite = null, Log $log = null, Request $request, TypeConformiteRepository $repoconformite, ObjectManager $manager, $domid){
        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));
        if(!$visitesite) {
            $visitesite = new VisiteSite();
            $visitesite->setCreatedAt(new \DateTime());
            $visitesite->addPeople($this->getUser()->getpeople()); 
            $visitesite->addTypeconformite($conformite);
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(VisiteSiteType::class, $visitesite, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $visitesite->setPublishedAt(new \DateTime());
                $visitesite->setCustomer($this->getUser()->getCustomer());
                $visitesite->setUpdatedAt(new \DateTime());
                $visitesite->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('VisiteSite');
                $log->setEntry($visitesite->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le visitesite P-'.$visitesite->getId().' '.$visitesite->getDesignation());

                $manager->persist($visitesite);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/visitesite_createv2.html.twig',
                        array(
                            'entity' => 'visitesite',
                            'formVisiteSite' => $form->createView(),
                            'editMode' => $visitesite->getId() !== null,
                            'visitesite' => $visitesite
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
                    'output' => $this->renderView('process/visitesite_createv2.html.twig',
                    array(
                        'entity' => 'visitesite',
                        'formVisiteSite' => $form->createView(),
                        'editMode' => $visitesite->getId() !== null,
                        'visitesite' => $visitesite
                    ))), 200);              
            }
        }
        return $response;
    }

//     /**
// 	* @route("/app/visite/new", name="visite_create")
//     * @route("/app/visite/edit/{id}", name="visite_edit")
// 	*/
//       public function formvisite(VisiteSite $visite = null, TypeConformiteRepository $repoconform, VisiteSiteRepository $repovisite, Log $log = null, Request $request, ObjectManager $manager){
// 		$r=$_GET["r"];$rr=$_GET["rr"];
// 		if(!$log) { $log = new Log(); }
// 	    if(!$visite) {
// 			$visite = new VisiteSite();
// 			$visite->addPeople($this->getUser()->getpeople());
// 			$conformite = $repoconform->findOneBy(array('customer' => $this->getUser()->getCustomer(),'designation' => $rr));
//             $visite->addTypeconformite($conformite);
//             $visite->setCreatedAt(new \DateTime());
// 		    }

// 	    $form = $this->createForm(VisiteSiteType::class, $visite, array(
// 		'userCustomer' => $this->getUser()->getcustomer(),
// 		));
	    
// 	    $form->handleRequest($request);
	    
// 	    if($form->isSubmitted() && $form->isValid()){

//             $visite->setPublishedAt(new \DateTime());
//             $visite->setPublisher($this->getUser()->getpeople());
//             $visite->setCustomer($this->getUser()->getCustomer());

// 		    $log->setUser($this->getUser());
//         	$log->setDate(new \DateTime());
//         	$log->setType('Visite');
//         	$log->setEntry($visite->getId());
//         	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié la visite VISITE-'.$visite->getId().' '.$visite->getDesignation());
//         	$log->setCustomer($this->getUser()->getCustomer());
// 		    $manager = $this->getDoctrine()->getManager();
// 		    $manager->persist($log);
//         	$manager->persist($visite);
//         	$manager->flush();
//         	 $this->addFlash(
//             'success',
//             'Vos modifications sont enregistrées'
//         );
        	
// 			return $this->redirectToRoute('visite_edit',[ 
// 				'r' => $r,
// 				'rr' => $rr,
// 				'id' => $visite->getId()
// 				]);
//         }
		
//         if($this->isGranted('ROLE_ADMIN') OR !$visite->getId() OR $repovisite->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$visite->getId()))
// 		{
//             return $this->render('blog/visitesite_create.html.twig',[ 
//                 'formVisite' => $form->createView(),
//                 'editMode' => $visite->getId() !== null,
//                 'visite' => $visite,
//                 'r' => $r,
//                 'rr' => $rr
//                 ]);
// 		}
// 		else
// 		{
// 			$this->addFlash(
// 				'warning',
// 				'Vous n\'avez pas accès à cette visite'
// 				);
// 			return $this->redirectToRoute($r);
// 		}  	
//     }

//     /**
// 	  * @route("/app/visite/remove/{id}", name="visite_remove")
// 	*/
//     public function deletevisite(VisiteSite $visite, VisiteSiteRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
//     { $r=$_GET["r"];$rr=$_GET["rr"];
//        $manager->remove($visite);
//        $manager->flush();

//     $this->addFlash(
//         'success',
//         'La visite est supprimée'
//     );
//        $visite = $repo->findAll();
//        return $this->redirectToRoute($r);
//     }

//     /**
//   * @route("/app/visite/{id}/{statut}", name="visite_workflow")
//   * @param $statut
//   * @param Visite $visite
//   * @internal param Registry $workflows
//   */
//   public function wkvisite(VisiteSite $visite, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
//   {
//       $workflow = $this->state_machines->get($visite);
//       if($workflow->can($visite, $statut)) {
//           $manager = $this->getDoctrine()->getManager();
//           $workflow->apply($visite, $statut);
//           $visite->setValidatedAt(new \DateTime());
//           $visite->setValidator($this->getUser()->getpeople());
//           $visite->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
//           $visite->setReportedAt(new \DateTime());
          
//           $manager->persist($visite);
//           $manager->flush();

//           $this->addFlash(
//               'success',
//               "Votre demande est transmise, merci"
//               );
//           $r=$_GET["r"];$rr=$_GET["rr"];
//           return $this->redirectToRoute('visite_edit',[ 
//               'r' => $r,
//               'rr' => $rr,
//               'id' => $visite->getId()
//               ]);
//       }
//   }


}
