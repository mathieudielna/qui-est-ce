<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MapsiCustomerRepository;
use App\Form\MapsiCustomerType;

use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\MapsiCustomer;


class MapsiCustomerController extends AbstractController
{
       /**
	  * @route("/app/mapsi_customer/ajaxedit/{id}/mapsi_customer", name="mapsicustomer_edit")
	  * @return Response
	  */
      public function formmapsicustomer(MapsiCustomer $mapsicustomer = null, Request $request, ObjectManager $manager){
		
	    $form = $this->createForm(MapsiCustomerType::class, $mapsicustomer, array(
			'userCustomer' => $this->getUser()->getcustomer(),
			));
	    $form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            if($form->isSubmitted() && $form->isValid()){
                
                $manager->persist($mapsicustomer);
                $manager->flush();
            }
        }
    $response = new JsonResponse(
        array(
            'message' => 'Success',
            'output' => $this->renderView('process/mapsicustomer_createv2.html.twig',
            array(
                'entity' => 'mapsi_customer',
                'formMapsiCustomer' => $form->createView(),
                'editMode' => $mapsicustomer->getId() !== null,
                'mapsicustomer' => $mapsicustomer
            ))), 200); 
    $this->addFlash(
        'success',
        'Vos modifications sont enregistrées'
        );   
    return $response;
    }
}
