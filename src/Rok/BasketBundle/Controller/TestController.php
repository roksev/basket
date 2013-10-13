<?php

namespace Rok\BasketBundle\Controller;

use Rok\BasketBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{

	public function indexAction($id)
	{

		$repository = $this->getDoctrine()->getManager();
    		$rep = $repository->getRepository('RokBasketBundle:User');

		$query = $rep->findAllOrderedByName();


	return $this->render('RokBasketBundle:Test:index.html.twig',
		array('imena' => $query)
	);	
	#return new Response('<html><body>'.$query->getImePriim().'</body></html>');
	}
}
