<?php

namespace App\Controller;
use App\Entity\Objectif;


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


use App\Entity\Audit;
use App\Entity\Log;
use App\Entity\Nonconformite;
use App\Entity\TypeConformite;

use App\Repository\ObjectifRepository;
use App\Repository\TypeConformiteRepository;
use App\Repository\TypeNonConformiteRepository;

use App\Form\ObjectifType;

class ObjectifController extends AbstractController
{
    /**
     * @var Registry
    */
    private $workflows;
    public function __construct(Registry $workflows)
    {
        $this->state_machines = $workflows;
    }

    /**
     * @Route("/app/{domid}/objectif", name="objectif")
     * @internal param Registry $workflows
     * @param Objectif $objectif
     */
    public function indextest(Request $request, objectifRepository $repoobjectif, WorkflowInterface $objectifStateMachine, TypeConformiteRepository $repoconformite, $domid)
    {   
		$conformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => 'environnement'));

        if ($request->isXmlHttpRequest()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                if ($domid == 'process') {$objectifs = $repoobjectif->findByCustomer($this->getUser()->getCustomer());}
                else {$objectifs = $repoobjectif->findAllConformite($this->getUser()->getCustomer(),$conformite);}
            }
            else
            {   
                if ($domid == 'process') {$objectifs = $repoobjectif->findAllCustomerUs($this->getUser()->getCustomer(),$this->getUser()->getPeople());}
                else {$objectifs = $repoobjectif->findAllCustomerUser($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$conformite);}
            }
            
            $coljson = array(
                'columns'=> [
                [
                    'title'=> '',
                    'data'=> 'select',
                    'className'=> 'select-checkbox tableselect',
                    ], [
                'title'=> 'Statut',
                'data'=> 'statut',
                'className'=> 'statut'
                ], [
                'title'=> 'Désignation',
                'data'=> 'designation',
                'className'=> 'table-title export'
                ], [
                'title'=> 'Manager',
                'data'=> 'responsable'
                ],[
                'title'=> 'Processus',
                'data'=> 'processus'
                ], [
                'title'=> 'Cible',
                'data'=> 'cible'
                ], [
                'title'=> 'Indicateurs',
                'data'=> 'indicateur'
                ], [
                'title'=> 'Comply',
                'data'=> 'comply'
                ]
                ]
            );
            
            
            $data = array();
            foreach($objectifs as $objectif) {
                if ($objectif->getResponsable()) {$responsable=$objectif->getResponsable()->getFirstname().' '.$responsable=$objectif->getResponsable()->getLastname();}
                else {$responsable="";}
                if ($objectif->getSuppleant()) {$suppleant=$objectif->getSuppleant()->getFirstname().' '.$suppleant=$objectif->getSuppleant()->getLastname();}
                else {$suppleant="";}
                if ($objectif->getProcessus()) {$processus=$objectif->getProcessus()->getCode();}
                else {$processus="";}
                $kpit = '';
                foreach($objectif->getIndicateurs() as $kpi ) {$kpit .=$kpi->getValeur().',';}
                $comply = '';
                foreach($objectif->getTypeconformites() as $tc ) {$comply .= '<span class="badge badge-secondary mr-1">'.$tc->getDesignation().'</span>';}
                $statut = '<span class="badge badge-outlined badge-'.$objectifStateMachine->getMetadataStore()->getMetadata('ambiance', $objectif->getStatut()).'">'.$objectifStateMachine->getMetadataStore()->getMetadata('title', $objectif->getStatut())?? 'To do'.'</span>';

                $data[] = array(
                    'select' => '',
                    'statut' => $statut,
                    'designation' => '<a onclick="crossEntity('.$objectif->getId().',\'objectif\')">'.$objectif->getDesignation().'</a>',
                    'responsable' => '<strong>'.$responsable.'</strong><br>'.$suppleant,
                    'processus' => '<div style="width: 100%;text-align: center"><strong>'.$processus.'</strong></div>',
                    'cible' => '<span class="badge badge-primary">'.$objectif->getValeurcible().' '.$objectif->getType().'</span>',
                    'indicateur' => '<span class="sparklines" sparkType="bar" sparkBarColor="green">'.$kpit.'</span>',
                    'comply' => $comply,
                );
            } 

            $temp["data"]=$data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json);
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'objectif', 'domaine'=>'', 'trans'=>'oui', 'tdb'=>'']);
        } 
    }

    /** 
    * @route("/app/objectif/ajaxcreate/{domid}", name="objectif_ajaxcreate") 
    * @route("/app/objectif/ajaxedit/{id}/{domid}", name="objectif_ajaxedit")
    */ 
    public function ajaxobjectif(Objectif $objectif = null, Log $log = null, Request $request, TypeConformiteRepository $repoconformite,  ObjectManager $manager, $domid){
        if(!$objectif) 
        {
            $objectif = new Objectif();
            $objectif->setCreatedAt(new \DateTime());
            $objectif->addPeople($this->getUser()->getpeople()); 
            $typeconformite = $repoconformite->findOneBy(array('customer' => $this->getUser()->getCustomer(),'slug' => $domid));
            $objectif->addTypeconformite($typeconformite);
        }
        if(!$log) { $log = new Log(); }
        $form = $this->createForm(ObjectifType::class, $objectif, array(
            'userCustomer' => $this->getUser()->getcustomer(),
            'userPeople' => $this->getUser()->getpeople(),
        ));

        $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            if($form->isSubmitted() && $form->isValid()) {
                
                $objectif->setPublishedAt(new \DateTime());
                $objectif->setCustomer($this->getUser()->getCustomer());
                $objectif->setUpdatedAt(new \DateTime());
                $objectif->setPublisher($this->getUser()->getpeople());
                $log->setUser($this->getUser());
                $log->setDate(new \DateTime());
                $log->setType('Objectif');
                $log->setEntry($objectif->getId());
                $log->setCustomer($this->getUser()->getCustomer());
                $log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié le objectif P-'.$objectif->getId().' '.$objectif->getDesignation());
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($objectif);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('process/objectif_createv2.html.twig',
                        array(
                            'entity' => 'objectif',
                            'formObjectif' => $form->createView(),
                            'editMode' => $objectif->getId() !== null,
                            'objectif' => $objectif,
                            'debug' => dump($form),
                            'debugc' => dump($objectif->getTypeconformites()),
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
                    'output' => $this->renderView('process/objectif_createv2.html.twig',
                    array(
                        'entity' => 'objectif',
                        'formObjectif' => $form->createView(),
                        'editMode' => $objectif->getId() !== null,
                        'objectif' => $objectif,
                        'debug' => dump($form),
                        'debugc' => dump($objectif->getTypeconformites()),
                    ))), 200);              
            }
        }
        return $response;
    }

    
    // /**
	//   * @route("/app/qualite/objectif/new", name="objectif_create")
	//   * @route("/app/qualite/objectif/edit/{id}", name="objectif_edit")
	//   */
    // public function formobjectif(Objectif $objectif = null, TypeConformiteRepository $repoconform, ObjectifRepository $repoobjectif, Log $log = null, Request $request, ObjectManager $manager){
	// 	$r=$_GET["r"];$rr=$_GET["rr"];
	// 	if(!$log) { $log = new Log(); }
	//     if(!$objectif) {
	// 		$objectif = new Objectif();
	// 		$objectif->addPeople($this->getUser()->getpeople());
	// 		$conformite = $repoconform->findOneBy(array('customer' => $this->getUser()->getCustomer(),'designation' => $rr));
    //         $objectif->addTypeconformite($conformite);
    //         $objectif->setCreatedAt(new \DateTime());
	// 	    }

	//     $form = $this->createForm(objectifType::class, $objectif, array(
	// 	'userCustomer' => $this->getUser()->getcustomer(),
	// 	));
	    
	//     $form->handleRequest($request);
	    
	//     if($form->isSubmitted() && $form->isValid()){

    //         $objectif->setPublishedAt(new \DateTime());
    //         $objectif->setPublisher($this->getUser()->getpeople());
    //         $objectif->setCustomer($this->getUser()->getCustomer());
	// 	    $log->setUser($this->getUser());
    //     	$log->setDate(new \DateTime());
    //     	$log->setType('Objectif');
    //     	$log->setEntry($objectif->getId());
    //     	$log->setAction($this->getUser()->getPrenom().' '.$this->getUser()->getNom().' a modifié l\'objectif AU-'.$objectif->getId().' '.$objectif->getDesignation());
    //     	$log->setCustomer($this->getUser()->getCustomer());
	// 	    $manager = $this->getDoctrine()->getManager();
	// 	    $manager->persist($log);
    //     	$manager->persist($objectif);
    //     	$manager->flush();
    //     	 $this->addFlash(
    //         'success',
    //         'Vos modifications sont enregistrées'
    //     );
        	
	// 		return $this->redirectToRoute('objectif_edit',[ 
	// 			'r' => $r,
	// 			'rr' => $rr,
	// 			'id' => $objectif->getId()
	// 			]);
    //     }
		
    //     if($this->isGranted('ROLE_ADMIN') OR !$objectif->getId() OR $repoobjectif->finduniq($this->getUser()->getCustomer(),$this->getUser()->getPeople(),$objectif->getId()))
	// 	{
    //         return $this->render('blog/objectif_create.html.twig',[ 
    //             'formObjectif' => $form->createView(),
    //             'editMode' => $objectif->getId() !== null,
    //             'objectif' => $objectif,
    //             'r' => $r,
    //             'rr' => $rr
    //             ]);
	// 	}
	// 	else
	// 	{
	// 		$this->addFlash(
	// 			'warning',
	// 			'Vous n\'avez pas accès à cet objectif'
	// 			);
	// 		return $this->redirectToRoute($r);
	// 	}  	

	
    // }

    // /**
	//   * @route("/app/objectif/remove/{id}", name="objectif_remove")
	// */
    //   public function deleteobjectif(Objectif $objectif, objectifRepository $repo, Log $log = null, Request $request, ObjectManager $manager)
    //   { $r=$_GET["r"];$rr=$_GET["rr"];
    //      $manager->remove($objectif);
    //      $manager->flush();

    //   $this->addFlash(
    //       'success',
    //       'L\'objectif est supprimée'
    //   );
    //      $objectifs = $repo->findAll();
    //      return $this->redirectToRoute($r);
	// }
	
	// /**
    // * @route("/app/objectif/objectif/{id}/{statut}", name="objectif_workflow")
    // * @param $statut
    // * @param Objectif $objectif
    // * @internal param Registry $workflows
    // */
    // public function wkobjectif(Objectif $objectif, $statut, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    // {
    //     $workflow = $this->state_machines->get($objectif);
    //     if($workflow->can($objectif, $statut)) {
    //         $manager = $this->getDoctrine()->getManager();
    //         $workflow->apply($objectif, $statut);
    //         $objectif->setValidatedAt(new \DateTime());
    //         $objectif->setValidator($this->getUser()->getpeople());
    //         $objectif->setValidationstatut($workflow->getMetadataStore()->getMetadata('title'));
    //         $objectif->setReportedAt(new \DateTime());
            
    //         $manager->persist($objectif);
    //         $manager->flush();

    //         $this->addFlash(
    //             'success',
    //             "Votre demande est transmise, merci"
    //             );
    //         $r=$_GET["r"];$rr=$_GET["rr"];
    //         return $this->redirectToRoute('objectif_edit',[ 
    //             'r' => $r,
    //             'rr' => $rr,
    //             'id' => $objectif->getId()
    //             ]);
    //     }
    // }
}
