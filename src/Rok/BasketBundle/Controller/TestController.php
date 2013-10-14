<?php

namespace Rok\BasketBundle\Controller;

use Rok\BasketBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller,
	Symfony\Component\HttpFoundation\Response,
	Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TestController extends Controller
{
	/**
	 * @Template
	 */
	public function indexAction($id)
	{

		$repository = $this->getDoctrine()->getManager();
    		$rep = $repository->getRepository('RokBasketBundle:User');

		$query = $rep->findAllOrderedByName();


	#return $this->render('RokBasketBundle:Test:index.html.twig',
	return	array('imena' => $query#)
	);	
	}
}
