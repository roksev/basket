<?php

namespace Rok\BasketBundle\Controller;

use Rok\BasketBundle\Entity\User,
	Rok\BasketBundle\Entity\Termin,
	Rok\BasketBundle\Entity\ObiskTermina;
use Symfony\Bundle\FrameworkBundle\Controller\Controller,
	Symfony\Component\HttpFoundation\Response,
	Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
	Symfony\Component\HttpFoundation\Request;
use Rok\BasketBundle\Entity\Pridem;


class ObiskController extends Controller
{
	private static function personSort( $a, $b ) {
		return $a->getUser()->getImePriim() == $b->getUser()->getImePriim() ? 0 : ( $a->getUser()->getImePriim() > $b->getUser()->getImePriim() ) ? 1 : -1;
	}
	/**
	 * @Template
	 */
	public function indexAction($id)
	{

		$userRep = $this->getDoctrine()->getManager()->getRepository('RokBasketBundle:User');
		$terminRep = $this->getDoctrine()->getManager()->getRepository('RokBasketBundle:Termin');
		$obskTerminRep = $this->getDoctrine()->getManager()->getRepository('RokBasketBundle:ObiskTermina');
		
		
		$query = $terminRep->findAllTermins();
		$pridejo = $obskTerminRep->getPeopleOnTerminId($id);
		usort( $pridejo, array($this,'personSort'));
		
		$em = $this->getDoctrine()->getManager();//TODO: preveri, ce spreminjamo pravi termin
		$obisk = $obskTerminRep->getUserOnTermin($this->getUser()->getId(),$id);

		$termin = new Pridem();
		if (!$obisk){
			$termin->setPridem(false);
		}
		else $termin->setPridem(false);
		$termin->setTermin($id);
		
		
		$form = $this->createFormBuilder($termin)
		->setAction($this->generateUrl('pridem'))
		->add('termin', 'hidden')
		->add('pridem', 'hidden')
		//->add('Nepridem', 'submit')
		->getForm();
		
		return	array('termini' => $query, 'pridejo' => $pridejo, 'form' => $form->createView() );	
	}
	
	/**
	 * @Template
	 */
	public function pridemAction(Request $request)
	{
		$user = $this->getUser();
		
		$pridem = new Pridem();
		$form = $this->createFormBuilder($pridem)
		->add('termin', 'hidden')
		->add('Pridem', 'submit')
		->add('Nepridem', 'submit')
		->getForm();
	
		$form->handleRequest($request);
		
		$em = $this->getDoctrine()->getManager();//TODO: preveri, ce spreminjamo pravi termin
		$obisk = $em->getRepository('RokBasketBundle:ObiskTermina')
			->getUserOnTermin($user->getId(),$pridem->getTermin());
		
		if (!$obisk){
	        throw $this->createNotFoundException(
	            'Termin za osebo'.$user->getImePriim().'ne obstaja'
	        );
	    }
		
	    if($form->get('Pridem')->isClicked())
	    	$obisk->setStatus('pride');
	    else $obisk->setStatus('nepride');
	    $em->flush();	    
	    
		return $this->forward('RokBasketBundle:Obisk:index',array('id' => $pridem->getTermin()));
	
		
	}
	
	
}
