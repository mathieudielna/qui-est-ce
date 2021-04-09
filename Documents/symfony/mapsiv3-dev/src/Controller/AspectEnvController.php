<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\WorkflowInterface;

use App\Entity\AspectEnv;
use App\Entity\Log;
use App\Entity\Nonconformite;

use App\Repository\AspectEnvRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\TypeNonConformiteRepository;
use App\Repository\NonConformiteRepository;

use App\Form\AspectEnvType;
use App\Form\ImpactType;
use App\Form\NonConformiteType;

class AspectEnvController extends AbstractController
{
     /**
     * @Route("/app/{domid}/aspect_env", name="aspectenv")
     */
    public function indextest(Request $request,WorkflowInterface $aspectenvStateMachine, aspectenvRepository $repoaspectenv, $domid)
    {   
        if ($request->isXmlHttpRequest()) {

            if ($this->isGranted('ROLE_ADMIN')) {
                $aspectenvs = $repoaspectenv->findByCustomer($this->getUser()->getCustomer());
            }
            else
            {
                $aspectenvs = $repoaspectenv->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople());
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
                'title'=> 'Scoring',
                'data'=> 'scoring'
                ], [
                'title'=> 'Type',
                'data'=> 'type'
                ]
                ]
            );
            
            
            $data = array();
            foreach($aspectenvs as $aspectenv) {
                if ($aspectenv->getResponsable()) {$responsable=$aspectenv->getResponsable()->getFirstname().' '.$responsable=$aspectenv->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($aspectenv->getSuppleant()) {$suppleant=$aspectenv->getSuppleant()->getFirstname().' '.$suppleant=$aspectenv->getSuppleant()->getLastname();}
                else {$suppleant="";}

                $statut = '<span class="badge badge-outlined badge-'.$aspectenvStateMachine->getMetadataStore()->getMetadata('ambiance', $aspectenv->getStatut()).'">'.$aspectenvStateMachine->getMetadataStore()->getMetadata('title', $aspectenv->getStatut())?? 'To do'.'</span>';
                    
                if(count($aspectenv->getPeoples())>0){$peoples='<strong>'.$responsable.'</strong><span class="badge badge-secondary text-middle float-right">+'.count($aspectenv->getPeoples()).'</span><br>'.$suppleant;}
                else{$peoples='<strong>'.$responsable.'</strong><br>'.$suppleant;}

                $data[] = array(
                    'select' => '',
                    'statut' => $statut,
                    
                    'designation' => '<a onclick="crossEntity('.$aspectenv->getId().',\'aspect_env\')">'.$aspectenv->getDesignation().'</a>',
                    'responsable' => $peoples,
                    'scoring' => '<div style="width: 100%;text-align: center"><span class="badge badge-primary">'.$aspectenv->getCriticite().'</span></div>',
                    'type' => $aspectenv->getTypeaspectenv()->getDesignation()
                );
            } 

            $temp["data"]=$data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json);
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'aspect_env', 'domaine'=>'', 'trans'=>'', 'tdb'=>'']);
        } 
    }

    /** 
    * @route("/app/aspect_env/ajaxcreate/{domid}", name="aspectenv_ajaxcreate") 
    * @route("/app/aspect_env/ajaxedit/{id}/{entite}", name="aspectenv_ajaxedit")
    */ 
    public function ajaxaspectenv(AspectEnv $aspectenv = null, Log $log = null, Request $request, ObjectManager $manager){
        if(!$aspectenv) {
            $aspectenv = new AspectEnv();
            $aspectenv->setCreatedAt(new \DateTime());
            $aspectenv->addPeople($this->getUser()->getpeople()); 
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(AspectEnvType::class, $aspectenv, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople()
            ));
        
        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            if($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $aspectenv->setPublishedAt(new \DateTime());
                $aspectenv->setCustomer($this->getUser()->getCustomer());
                $aspectenv->setUpdatedAt(new \DateTime());
                $aspectenv->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('AspectEnv');
                $log->setEntry($aspectenv->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le aspectenv AES-'.$aspectenv->getId().' '.$aspectenv->getDesignation());

                $manager->persist($aspectenv);
                $manager->flush();
                
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/aspectenv_createv2.html.twig',
                        array(
                            'entity' => 'Aspectenv',
                            'formAspectenv' => $form->createView(),
                            'editMode' => $aspectenv->getId() !== null,
                            'aspectenv' => $aspectenv
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
                    'output' => $this->renderView('process/aspectenv_createv2.html.twig',
                    array(
                        'entity' => 'Aspectenv',
                        'formAspectenv' => $form->createView(),
                        'editMode' => $aspectenv->getId() !== null,
                        'aspectenv' => $aspectenv, 
                    ))), 200);   
                              
            }
        }
        
        return $response;
    }
    
    // /**
	//   * @route("/app/aspectenv/new", name="aspectenv_create")
	//   * @route("/app/aspectenv/edit/{id}", name="aspectenv_edit")
	//   */
    // public function formaspectenv(Aspectenv $aspectenv = null, TypeConformiteRepository $repoconform, AspectenvRepository $repoaspectenv, Log $log = null, Request $request, ObjectManager $manager){
	// 	$r=$_GET["r"];$rr=$_GET["rr"];
	// 	if(!$log) { $log = new Log(); }
	//     if(!$aspectenv) {
	// 		$aspectenv = new Aspectenv();
	// 		$aspectenv->addPeople($this->getUser()->getpeople());
    //         $aspectenv->setCreatedAt(new \DateTime());
	// 	    }

	//     $form = $this->createForm(aspectenvType::class, $aspectenv, array(
	// 	'userCustomer' => $this->getUser()->getcustomer(),
	// 	));
	    
	//     $form->handleRequest($request);
	    
	//     if($form->isSubmitted() && $form->isValid()){

    //         $aspectenv->setPublishedAt(new \DateTime());
    //         $aspectenv->setPublisher($this->getUser()->getpeople());
    //         $aspectenv->setCustomer($this->getUser()->getCustomer());
    //         foreach ($aspectenv->getImpacts() as $formChild)
    //             {
    //                 $formChild->setCustomer($this->getUser()->getCustomer());
                    
    //             };
	// 	    $log->setUser($this->getUser());
    //     	$log->setDate(new \DateTime());
    //     	$log->setType('Aspectenv');
    //     	$log->setEntry($aspectenv->getId());
    //     	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié l\'aspect environnemental AES-'.$aspectenv->getId().' '.$aspectenv->getDesignation());
    //     	$log->setCustomer($this->getUser()->getCustomer());
	// 	    $manager = $this->getDoctrine()->getManager();
	// 	    $manager->persist($log);
    //     	$manager->persist($aspectenv);
    //     	$manager->flush();
    //     	 $this->addFlash(
    //         'success',
    //         'Vos modifications sont enregistrées'
    //     );
        	
	// 		return $this->redirectToRoute('aspectenv_edit',[ 
	// 			'r' => $r,
	// 			'rr' => $rr,
	// 			'id' => $aspectenv->getId()
	// 			]);
    //     }
		
    //     if($this->isGranted('ROLE_ADMIN') OR !$aspectenv->getId() OR $repoaspectenv->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$aspectenv->getId()))
	// 	{
    //         return $this->render('blog/aspectenv_create.html.twig',[ 
    //             'formAspectenv' => $form->createView(),
    //             'editMode' => $aspectenv->getId() !== null,
    //             'aspectenv' => $aspectenv,
    //             'r' => $r,
    //             'rr' => $rr
    //             ]);
	// 	}
	// 	else
	// 	{
	// 		$this->addFlash(
	// 			'warning',
	// 			'Vous n\'avez pas accès à cet AES'
	// 			);
	// 		return $this->redirectToRoute($r);
	// 	}  	

	
    // }

    // /**
	//   * @route("/app/aspectenv/remove/{id}", name="aspectenv_remove")
	// */
    //   public function deleteaspectenv(Aspectenv $aspectenv, AspectenvRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
    //   { $r=$_GET["r"];$rr=$_GET["rr"];
    //      $manager->remove($aspectenv);
    //      $manager->flush();

    //   $this->addFlash(
    //       'success',
    //       'L\'AES est supprimée'
    //   );
    //      $aspectenvs = $repo->findAll();
    //      return $this->redirectToRoute($r);
	// }
	
	// /**
    // * @route("/app/aspectenv/aspectenv/{id}/{statut}", name="aspectenv_workflow")
    // * @param $statut
    // * @param Aspectenv $aspectenv
    // * @internal param Registry $workflows
    // */
    // public function wkaspectenv(Aspectenv $aspectenv, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    // {
    //     $workflow = $this->state_machines->get($aspectenv);
    //     if($workflow->can($aspectenv, $statut)) {
    //         $manager = $this->getDoctrine()->getManager();
    //         $workflow->apply($aspectenv, $statut);
    //         $aspectenv->setValidatedAt(new \DateTime());
    //         $aspectenv->setValidator($this->getUser()->getpeople());
    //         $aspectenv->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
    //         $aspectenv->setReportedAt(new \DateTime());
            
    //         $manager->persist($aspectenv);
    //         $manager->flush();

    //         $this->addFlash(
    //             'success',
    //             "Votre demande est transmise, merci"
    //             );
    //         $r=$_GET["r"];$rr=$_GET["rr"];
    //         return $this->redirectToRoute('aspectenv_edit',[ 
    //             'r' => $r,
    //             'rr' => $rr,
    //             'id' => $aspectenv->getId()
    //             ]);
    //     }
    // }
}
