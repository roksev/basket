<?php
namespace Rok\BasketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext,
	Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken,
	Symfony\Component\HttpFoundation\Response;

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
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('RokBasketBundle:User');
		$result = $repository->matchLoginKey($secret);
		if (!$result) {
			return $this->render('MiedzywodzieClientBundle:Default:autologin_incorrect.html.twig');
		}
		//$result = $result[0];
	
		$token = new UsernamePasswordToken($result, $result->getPassword(), 'secured_area', $result->getRoles());
	
		$request = $this->getRequest();
		$session = $request->getSession();
		$session->set('_security_secured_area',  serialize($token));
	
		$router = $this->get('router');
	
		return $this->redirect($this->generateUrl('homepage'));
	}
}