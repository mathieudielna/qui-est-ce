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
use Symfony\Component\Workflow\WorkflowInterface;


use App\Entity\Audit;
use App\Entity\Log;
use App\Entity\TypeConformite;

use App\Repository\AuditRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\TypeNonConformiteRepository;
use App\Repository\NonConformiteRepository;

use App\Form\AuditType;
use App\Form\NonConformiteType;
use Symfony\Component\HttpFoundation\JsonResponse;



class AuditController extends AbstractController
{



    /**
     * @Route("/app/{domid}/audit", name="audit")
     */
    public function indexrisque(Request $request, WorkflowInterface $auditStateMachine,
     auditRepository $repoaudit, TypeConformiteRepository $repoconformite, $domid)
    {   
        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));
        
        if ($request->isXmlHttpRequest()) {

            if ($this->isGranted('ROLE_ADMIN')) {
                $audits = $repoaudit->findAllConformite($this->getUser()->getCustomer(),$conformite);
            }
            else
            {
                $audits = $repoaudit->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);
            }
            
            $coljson = array(
                'columns'=> [
                [
                'title'=> '',
                'data'=> 'select',
                'className'=> 'select-checkbox tableselect',
                'orderable'=> 'false', 
                ],[
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
                'title'=> 'Date d\'audit',
                'data'=> 'dateaudit'
                ], [
                'title'=> 'Type d\'audit',
                'data'=> 'typeaudit'
                ], [
                'title'=> 'Comply',
                'data'=> 'comply'
                ]
                ]
            );
            
            
            $data = array();
            foreach($audits as $audit) {
                if ($audit->getResponsable()) {$responsable=$audit->getResponsable()->getFirstname().' '.$responsable=$audit->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($audit->getSuppleant()) {$suppleant=$audit->getSuppleant()->getFirstname().' '.$suppleant=$audit->getSuppleant()->getLastname();}
                else {$suppleant="";}
                $comply = '';
                foreach($audit->getTypeconformite() as $tc ) {$comply .= '<span class="badge badge-secondary mr-1">'.$tc->getDesignation().'</span>';}

                $statut = '<span class="badge badge-outlined badge-'.$auditStateMachine->getMetadataStore()->getMetadata('ambiance', $audit->getStatut()).'">'.$auditStateMachine->getMetadataStore()->getMetadata('title', $audit->getStatut())?? 'To do'.'</span>';

                $data[] = array(
                    'select' => '',
                    'statut' => $statut,
                    'designation' => '<a onclick="crossEntity('.$audit->getId().',\'audit\')">'.$audit->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'dateaudit' => '<i class="bi bi-calendar-week"></i> '.$audit->getStartedAt()->format('d M Y'),
                    'typeaudit' => $audit->getTypeaudit()->getDesignation(),
                    'comply' => $comply
                );
            } 

            $temp["data"]=$data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json);
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'audit', 'domaine'=>'', 'trans'=>'oui', 'tdb'=>'']);
        } 
    }

    /** 
    * @route("/app/audit/ajaxcreate/{domid}", name="audit_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/audit/ajaxedit/{id}/{domid}", name="audit_ajaxedit", methods={"POST", "GET"})
    */ 
    public function ajaxaudit(Audit $audit = null, Log $log = null, Request $request, TypeConformiteRepository $repoconformite, ObjectManager $manager, $domid){
        $confo = $domid;
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $confo));
        if(!$audit) {
            $audit = new Audit();
            $audit->setCreatedAt(new \DateTime());
            $audit->addPeople($this->getUser()->getpeople()); 
            $audit->addTypeconformite($conformite);
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(AuditType::class, $audit, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            //return new JsonResponse('isXmlHttpRequest');
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $audit->setPublishedAt(new \DateTime());
                $audit->setCustomer($this->getUser()->getCustomer());
                $audit->setUpdatedAt(new \DateTime());
                $audit->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Audit');
                $log->setEntry($audit->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le audit P-'.$audit->getId().' '.$audit->getDesignation());

                $manager->persist($audit);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/audit_createv2.html.twig',
                        array(
                            'entity' => 'audit',
                            'formAudit' => $form->createView(),
                            'editMode' => $audit->getId() !== null,
                            'audit' => $audit
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
                    'output' => $this->renderView('process/audit_createv2.html.twig',
                    array(
                        'entity' => 'audit',
                        'formAudit' => $form->createView(),
                        'editMode' => $audit->getId() !== null,
                        'audit' => $audit
                    ))), 200);              
            }
        }
        return $response;
    }
    
    // /**
	//   * @route("/app/audit/new", name="audit_create")
	//   * @route("/app/audit/edit/{id}", name="audit_edit")
	//   */
    // public function formaudit(Audit $audit = null, TypeConformiteRepository $repoconform, AuditRepository $repoaudit, Log $log = null, Request $request, ObjectManager $manager){
	// 	$r=$_GET["r"];$rr=$_GET["rr"];
	// 	if(!$log) { $log = new Log(); }
	//     if(!$audit) {
	// 		$audit = new Audit();
	// 		$audit->addPeople($this->getUser()->getpeople());
	// 		$conformite = $repoconform->findOneBy(array('customer' => $this->getUser()->getCustomer(),'designation' => $rr));
    //         $audit->addTypeconformite($conformite);
    //         $audit->setCreatedAt(new \DateTime());
	// 	    }

	//     $form = $this->createForm(auditType::class, $audit, array(
	// 	'userCustomer' => $this->getUser()->getcustomer(),
	// 	));
	    
	//     $form->handleRequest($request);
	    
	//     if($form->isSubmitted() && $form->isValid()){

    //         $audit->setPublishedAt(new \DateTime());
    //         $audit->setPublisher($this->getUser()->getpeople());
    //         $audit->setCustomer($this->getUser()->getCustomer());
    //         foreach ($audit->getNonconformites() as $formChild)
    //             {
    //                 $formChild->setCustomer($this->getUser()->getCustomer());
    //             };
	// 	    $log->setUser($this->getUser());
    //     	$log->setDate(new \DateTime());
    //     	$log->setType('Audit');
    //     	$log->setEntry($audit->getId());
    //     	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié l\'audit AU-'.$audit->getId().' '.$audit->getDesignation());
    //     	$log->setCustomer($this->getUser()->getCustomer());
	// 	    $manager = $this->getDoctrine()->getManager();
	// 	    $manager->persist($log);
    //     	$manager->persist($audit);
    //     	$manager->flush();
    //     	 $this->addFlash(
    //         'success',
    //         'Vos modifications sont enregistrées'
    //     );
        	
	// 		return $this->redirectToRoute('audit_edit',[ 
	// 			'r' => $r,
	// 			'rr' => $rr,
	// 			'id' => $audit->getId()
	// 			]);
    //     }
		
    //     if($this->isGranted('ROLE_ADMIN') OR !$audit->getId() OR $repoaudit->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$audit->getId()))
	// 	{
    //         return $this->render('blog/audit_create.html.twig',[ 
    //             'formAudit' => $form->createView(),
    //             'editMode' => $audit->getId() !== null,
    //             'audit' => $audit,
    //             'r' => $r,
    //             'rr' => $rr
    //             ]);
	// 	}
	// 	else
	// 	{
	// 		$this->addFlash(
	// 			'warning',
	// 			'Vous n\'avez pas accès à cet audit'
	// 			);
	// 		return $this->redirectToRoute($r);
	// 	}  	

	
    // }

    // /**
	//   * @route("/app/audit/remove/{id}", name="audit_remove")
	// */
    //   public function deleteaudit(Audit $audit, AuditRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
    //   { $r=$_GET["r"];$rr=$_GET["rr"];
    //      $manager->remove($audit);
    //      $manager->flush();

    //   $this->addFlash(
    //       'success',
    //       'L\'audit est supprimée'
    //   );
    //      $audits = $repo->findAll();
    //      return $this->redirectToRoute($r);
	// }
	
	// /**
    // * @route("/app/audit/audit/{id}/{statut}", name="audit_workflow")
    // * @param $statut
    // * @param Audit $audit
    // * @internal param Registry $workflows
    // */
    // public function wkaudit(Audit $audit, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    // {
    //     $workflow = $this->state_machines->get($audit);
    //     if($workflow->can($audit, $statut)) {
    //         $manager = $this->getDoctrine()->getManager();
    //         $workflow->apply($audit, $statut);
    //         $audit->setValidatedAt(new \DateTime());
    //         $audit->setValidator($this->getUser()->getpeople());
    //         $audit->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
    //         $audit->setReportedAt(new \DateTime());
            
    //         $manager->persist($audit);
    //         $manager->flush();

    //         $this->addFlash(
    //             'success',
    //             "Votre demande est transmise, merci"
    //             );
    //         $r=$_GET["r"];$rr=$_GET["rr"];
    //         return $this->redirectToRoute('audit_edit',[ 
    //             'r' => $r,
    //             'rr' => $rr,
    //             'id' => $audit->getId()
    //             ]);
    //     }
    // }
}
