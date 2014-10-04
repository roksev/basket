<?php
namespace Rok\BasketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext,
	Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken,
	Symfony\Component\HttpFoundation\Response;
use Symfony\Component\BrowserKit\Request;

class SecurityController extends Controller
{
	public function loginAction()
	{
		$request = $this->getRequest();
		$session = $request->getSession();

		// get the login error if there is one
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(
					SecurityContext::AUTHENTICATION_ERROR
			);
		} else {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}

		return $this->render(
				'RokBasketBundle:Security:login.html.twig',
				array(
						// last username entered by the user
						'last_username' => $session->get(SecurityContext::LAST_USERNAME),
						'error'         => $error,
				)
		);
	}
	
	/**
	 * @ Route("/autologin/{secret}")
	 */
	public function autologinAction($secret) {
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('RokBasketBundle:User');
		$result = $repository->matchLoginKey($secret);
		if (!$result) {
			return $this->render('RokBasketBundle:Default:autologin_incorrect.html.twig');
		}
		//$result = $result[0];
	
		$token = new UsernamePasswordToken($result, $result->getPassword(), 'secured_area', $result->getRoles());
	
		$request = $this->getRequest();
		$session = $request->getSession();
		$session->set('_security_secured_area',  serialize($token));
	
		return $this->redirect($this->generateUrl('homepage'));
	}
	
	public function edituserAction(){
		//return $this->redirect($this->generateUrl('viewuser'));
		$request = $this->getRequest();
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('RokBasketBundle:User')->find($this->getUser()->getId());
		
		
		$form = $this->createFormBuilder($user)
		->add('username', 'text')
		->add('Email', 'email')
		->add('Password', 'password')
		//->setAction($this->generateUrl('edituser'))
		//->add('username', 'text')
		//->add('Email', 'email')
		//->add('Password', 'password')
		->add('Spremeni', 'submit')
		->add('Spremeni geslo', 'submit')
		->getForm();
		
		$form->handleRequest($request);
		
		if($form->get('Spremeni geslo')->isClicked()){
			$encoder = $this->get('security.encoder_factory')->getEncoder($user);
			
			$user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));
		}
		
		$em->flush();
		
		return $this->redirect($this->generateUrl('viewuser'));
	}
	
	public function viewUserAction(){

		$user = $this->getUser();
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('RokBasketBundle:User')->find($this->getUser()->getId());
		
		
		$form = $this->createFormBuilder($user)
		->setAction($this->generateUrl('edituser'))
		->add('username', 'text')
		->add('Email', 'email', array('required' => false))
		->add('Password', 'hidden')
		->add('Potrdi', 'submit')
		->getForm();
		
		$form1 = $this->createFormBuilder($user)
		->setAction($this->generateUrl('edituser'))
		->add('username', 'hidden')
		->add('Email', 'hidden')
		->add('Password', 'hidden')
		->add('Spremeni geslo', 'submit')
		->getForm();
		
		
		return $this->render('RokBasketBundle:Security:viewUser.html.twig', array(
				'form' => $form->createView(), 'form1' => $form1->createView(),
		));
	}
	
	
}