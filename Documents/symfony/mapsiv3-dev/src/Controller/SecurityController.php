<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\User;
use App\Entity\MapsiCustomer;
use App\Entity\PasswordUpdate;
use App\Entity\UserAccount;
use App\Entity\Log;
use App\Entity\ResetPasswordRequest;

use App\Repository\MapsiCustomerRepository;
use App\Repository\UserRepository;
use App\Repository\LogRepository;

use App\Form\RegistrationType;
use App\Form\MapsiCustomerType;
use App\Form\UserType;
use App\Form\PasswordUpdateType;
use App\Form\UserRoleUpdateType;
use App\Form\MapsiCustomerSelectType;
use Symfony\Component\HttpFoundation\JsonResponse;

class SecurityController extends AbstractController
{	
	/**
	* @route("/", name="index")
	*/
    public function home (User $user = null, Request $request, AuthorizationCheckerInterface $authChecker, ObjectManager $manager)
    {   

			$landing='start';
		if ($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY') == true) {
			$landing=$this->getUser()->getLanding();
		}
		elseif ($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY') == false)  
	    {
			$landing='start';			
		}

		return $this->redirectToRoute($landing);
	      
    }

	// /**
	// * @Route("/app/admin/inscription", name="security_registration")
	// */
	// public function registration(User $user = null, Request $request, ObjectManager $manager, UserpasswordEncoderInterface $encoder){
	// $this->denyAccessUnlessGranted('ROLE_ADMIN');
	// if(!$user) {$user = new User();}
	
	// $form = $this->createForm(RegistrationType::class, $user);
	// $user->setCustomer($this->getUser()->getCustomer());
	// $form->handleRequest($request);
	
	// if($form->isSubmitted() && $form->isValid()){
	// 	$hash = $encoder->encodePassword($user, $user->getPassword());
	// 	$user->setPassword($hash);
		
	// 	$manager->persist($user);
	// 	$manager->flush();	
	// 	 $this->addFlash(
    //         'success',
    //         'Le compte utilisateur est créé'
    //     );
		
	// 	return $this->redirectToRoute('security_list');
	// }
	
	// return $this->render('security/registration.html.twig',[
	// 	'formUser' => $form->createView(),
	// 	'editMode' => $user->getId() !== null,
	// 	'user' => $user
    //     ]);
	// }
	
	// /**
	// * @route("/app/mapsi_customer/user/{id}/ajaxcreate", name="user_edit")
	// * @return Response
	// */
	// public function profile(User $user = null, Request $request, ObjectManager $manager){
	// $form = $this->createForm(UserAccountType::class, $user, array(
	// 	'userCustomer' => $this->getUser()->getcustomer(),
	// 	));
	// $form->handleRequest($request);
	
	// if($form->isSubmitted() && $form->isValid()){
	// 	$user->setCustomer($this->getUser()->getCustomer());
	// 	$manager->persist($user);
	// 	$manager->flush();	
	// 	 $this->addFlash(
    //         'success',
    //         'Vos modifications sont enregistrées'
    //     );
		
	// 	return $this->redirectToRoute('security_list');
	// }
	
	// return $this->render('security/profile.html.twig',[
	// 	'formUserAccount' => $form->createView(),
	// 	'editMode' => $user->getId() !== null,
	// 	'user' => $user,
    //     ]);

	// }


	/** 
    * @route("/app/user/ajaxcreate/{domid}", name="user_ajaxcreate", methods={"POST", "GET"}) 
    * @route("/app/user/ajaxedit/{id}/{domid}", name="user_ajaxedit", methods={"POST", "GET"})
    */ 
    public function profile(User $user = null, Request $request, ObjectManager $manager, UserpasswordEncoderInterface $encoder){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
		if(!$user) {$user = new User();}
        $form = $this->createForm(UserType::class, $user, array(
			'userCustomer' => $this->getUser()->getcustomer(),
			));
		$form->handleRequest($request);
        if ($request->isXmlHttpRequest()) {
            if($form->isSubmitted() && $form->isValid()) {
                $user->setCustomer($this->getUser()->getCustomer());
				$hash = $encoder->encodePassword($user, $user->getPassword());
				$user->setPassword($hash);
				$manager = $this->getDoctrine()->getManager();

                $manager->persist($user);
                $manager->flush();
                $response = new JsonResponse(
                    array(
                        'message' => 'Success',
                        'output' => $this->renderView('security/profile.html.twig',
                        array(
                            'entity' => 'user',
                            'formUser' => $form->createView(),
                            'editMode' => $user->getId() !== null,
                            'user' => $user
                        ))), 200); 
            }
            else
            {
            $response = new JsonResponse(
                array(
                    'message' => 'Success',
                    'output' => $this->renderView('security/profile.html.twig',
                    array(
                        'entity' => 'user',
                        'formUser' => $form->createView(),
                        'editMode' => $user->getId() !== null,
                        'user' => $user,
                    ))), 200);              
            }
        }
        return $response;
    }
	
	/**
	* @route("/app/password/ajaxedit/{id}/{domid}", name="security_editpassword")
	* @return Response
	*/
	public function editpassword(User $user = null,  Request $request, ObjectManager $manager, UserpasswordEncoderInterface $encoder){
	$passwordUpdate = new PasswordUpdate();
	$form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);
		
	$form->handleRequest($request);
	if($form->isSubmitted() && $form->isValid()){
		if(!password_verify($passwordUpdate->getOldPassword(), $user->getPassword()))
		{
			$this->addFlash(
				'warning',
				'Votre mot de passe actuel est incorrect, veuillez le saisir de nouveau'
				);
		}
		else
		{
			$newPassword = $passwordUpdate->getNewPassword();
			$hash = $encoder->encodePassword($user, $newPassword);
			$user->setPassword($hash);
			
			$manager->persist($user);
			$manager->flush();
			
			$this->addFlash(
            'success',
            'Votre mot de passe est changé'
			);
			
			$response = new JsonResponse(
				array(
					'message' => 'Success',
					'output' => $this->renderView('security/password.html.twig',
					array(
						'entity' => 'user',
						'formpassword' => $form->createView(),
						'editMode' => $user->getId() !== null,
						'user' => $user,
					))), 200); 
		}
	}
	else
	{
	$response = new JsonResponse(
		array(
			'message' => 'Success',
			'output' => $this->renderView('security/password.html.twig',
			array(
				'entity' => 'user',
				'formpassword' => $form->createView(),
				'editMode' => $user->getId() !== null,
				'user' => $user,
			))), 200);              
	}

	return $response;

	
	}
		
	// 	/**
	// * @route("/app/admin/user/{id}/edit/role", name="security_editrole")
	// * @return Response
	// */
	// public function editrole(User $user = null, Request $request, ObjectManager $manager){
	// $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');
	// $form = $this->createForm(UserRoleUpdateType::class, $user, array(
	// 	'userCustomer' => $this->getUser()->getcustomer(),
	// 	));
	
	// $form->handleRequest($request);
	
	// if($form->isSubmitted() && $form->isValid()){
			
	// 		$manager->persist($user);
	// 		$manager->flush();
			
	// 		$this->addFlash(
    //         'success',
    //         'Les rôles sont modifiés'
	// 		);
	// 		return $this->redirectToRoute('security_list');
	// 	}
        
    //     return $this->render('security/role.html.twig',[
	// 	'formrole' => $form->createView(),
	// 	'editMode' => $user->getId() !== null,
	// 	'user' => $user
    //     ]);

	// 	}
	
	
	/**
	* @route("/app/admin/user/{id}/edit/customer", name="customerchange")
	* @return Response
	*/
	public function customerchange(User $user = null, Request $request, ObjectManager $manager){
	$this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');
	$form = $this->createForm(MapsiCustomerSelectType::class, $user);
		
	$form->handleRequest($request);
	
	if($form->isSubmitted() && $form->isValid()){
			
			$manager->persist($user);
			$manager->flush();
			
			$this->addFlash(
            'success',
            'La base est chargée'
			);
			
			return $this->redirectToRoute('start');
		}

        return $this->render('security/customerchange.html.twig',[
		'formcustomerchange' => $form->createView(),
		'editMode' => $user->getId() !== null,
		'user' => $user
        ]);

		}

			
		/**
		* @route("/app/admin/user/{id}/init/password", name="security_initpassword")
		* @return Response
		*/
		public function initpassword(User $user = null, Request $request, UserRepository $repouser, ObjectManager $manager, UserpasswordEncoderInterface $encoder, \Swift_Mailer $mailer){
			$this->denyAccessUnlessGranted('ROLE_ADMIN');	

			if ($request->isXmlHttpRequest()) {
			$newPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'),1, 10);
			$hash = $encoder->encodePassword($user, $newPassword);
			$user->setPassword($hash);
			$manager->persist($user);
			$manager->flush();
			
			$useri = $repouser->findOneById([$user->getId()]);

			$message = (new \Swift_Message('Mapsi > Votre mot de passe est réinitialisé'))
				->setFrom('nice.robot@app-mapsi.fr')
				->setTo($useri->getEmail())
				->setBody(
					$this->renderView(
						'email/mailuser.html.twig',
				['password' => $newPassword, 'user' => $useri ]
					),
					'text/html'
					)
				;
			$mailer->send($message);

			$response = new JsonResponse(
				array('message' => 'Success'), 200);              
			}


			return $response;
		}

	//    /**
    //  * @Route("/app/admin/user", name="security_list")
    //  */
    // public function indexuser(UserRepository $repo, AuthorizationCheckerInterface $authChecker)
    // {	
	//     $this->denyAccessUnlessGranted('ROLE_ADMIN');
	 
	// 	$users = $repo->findByCustomer($this->getUser()->getCustomer());		
		
    //     return $this->render('security/user_list.html.twig', [
    //         'controller_name' => 'SecurityController',
    //         'users' => $users
    //     ]);
    // }
    
	
	/**
	* @Route("/connexion", name="login")
	*/
	public function login(AuthenticationUtils $utils){
		
		$error = $utils->getLastAuthenticationError();
		$username = $utils->getLastUsername();
		return $this->render('security/login.html.twig', [
            'hasError' => $error !==null,
            'username' => $username
        ] );

	}

	/**
	* @Route("/reset-password", name="renew")
	*/
	public function renew(AuthenticationUtils $utils){
		$error = $utils->getLastAuthenticationError();
		$username = $utils->getLastUsername();
		return $this->render('reset_password/request.html.twig', [
			'hasError' => $error !==null,
            'username' => $username
        ] );
	}
	
	/**
	* @Route("/deconnexion", name="logout")
	*/
	public function logout(){
		return $this->redirectToRoute('home');
	}
	
	
	    /**
	  * @route("/admin/user/{id}/remove", name="security_remove")
	  */
    public function deleteuser(User $user, UserRepository $repo, Request $request, ObjectManager $manager)
   	 {
	   	$manager->remove($user);
	   	$manager->flush();
       
       
        $this->addFlash(
            'success',
            'L\'utilisateur est supprimé'
        );
       
	   	$users = $repo->findAll();

        return $this->render('security/user_list.html.twig', [
            'controller_name' => 'SecurityController',
            'users' => $users
        ]);
    }


	/**
     * @Route("/app/{domid}/user", name="users")
     */
    public function indexrisque(Request $request, userRepository $repouser, $domid)
    {   
        if ($request->isXmlHttpRequest()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                $users = $repouser->findByCustomer($this->getUser()->getCustomer());
            }
            
            $coljson = array(
                'columns'=> [
                [
                'title'=> '',
                'data'=> 'select',
                'className'=> 'select-checkbox tableselect',
                'orderable'=> 'false', 
                ], [
                'title'=> 'Désignation',
                'data'=> 'designation',
                'className'=> 'table-title'
                ], [
                'title'=> 'Collaborateur',
                'data'=> 'collaborateur'
                ], [
                'title'=> 'Rôles',
                'data'=> 'role'
                ], [
				'title'=> 'Action',
				'data'=> 'action'
				]
                ]
            );
            
            
            $data = array();
            foreach($users as $user) {

				if ($user->getPeople()) {$people=$user->getPeople()->getFirstname().' '.$people=$user->getPeople()->getLastname();}
                else {$people="";}

					$relationrole ='';$relationrole1 = '';$relationrole2 = '';  if (count($user->getUserRoles()) >= 1) {
                    $relationrole1 = '';
                    $relationrole ='
                    <span class="dropdown tablerelation">
                            <button class="btn btn-primary btn-outline dropdown-toggle btn-sm tablerelation" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-lock tablerelation icon"></i> <strong class="tablerelation">'.count($user->getUserRoles()).'</strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h4 class="tablerelation"><i class="bi bi-lock icon"></i> Rôles</h4>';
                                foreach($user->getUserRoles() as $obj ) 
                                {$relationrole1 .='<a class="dropdown-item small">'.$obj->getDesignation().'</a>';}
                    $relationrole2 = '</div></span>';
                    }
               
				
                $data[] = array(
                    'select' => '',
                    'designation' => '<a onclick="crossEntity('.$user->getId().',\'user\')">'.$user->getEmail().'</a>',
                    'collaborateur' => $people,
                    'role' => $relationrole.' '. $relationrole1.' '. $relationrole2,
                    'action' => '<a class="btn btn-primary btn-outline btn-sm" onclick="resetPassword('.$user->getId().')">Réinitialiser le mot de passe</a>'
                );
            } 

            $temp["data"]=$data;

            $json = array_merge($coljson, $temp);
            return new JsonResponse($json); 
        }
        else
        {
            return $this->redirectToRoute('switch', ['domid' => $domid,'entite' => 'user', 'domaine'=>'', 'trans'=>'', 'tdb'=>'']);
        }
    }
	
	
	

}
