<?php

namespace Rok\BasketBundle\Controller;

use Rok\BasketBundle\Entity\User,
	Rok\BasketBundle\Entity\Termin,
	Rok\BasketBundle\Entity\ObiskTermina;
use Symfony\Bundle\FrameworkBundle\Controller\Controller,
	Symfony\Component\HttpFoundation\Response,
	Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ObiskController extends Controller
{
	private static function personSort( $a, $b ) {
		return $a->getUser()->getImePriim() == $b->getUser()->getImePriim() ? 0 : ( $a->getUser()->getImePriim() > $b->getUser()->getImePriim() ) ? 1 : -1;
	}
	/**
	 * @Template
	 */
	public function indexAction($id = 1)
	{

		$userRep = $this->getDoctrine()->getManager()->getRepository('RokBasketBundle:User');
		$terminRep = $this->getDoctrine()->getManager()->getRepository('RokBasketBundle:Termin');
		$obskTerminRep = $this->getDoctrine()->getManager()->getRepository('RokBasketBundle:ObiskTermina');
		
		
		$query = $terminRep->findAllTermins();
		$pridejo = $obskTerminRep->getPeopleOnTerminId($id);
		
		
		usort( $pridejo, array($this,'personSort'));
		
		//$pridejo = get_class($pridejo[0]->getUser());
		
		
		return	array('termini' => $query, 'pridejo' => $pridejo );	
	}
	
	/**
	 * @Template
	 */
	public function terminiAction()
	{
		
	}
	
	
}
