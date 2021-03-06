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
	private static function terminSort ( Termin $a, Termin $b ) {
		return $a->getDatum() < $b->getDatum();
	}
	/**
	 * @Template
	 */
	public function indexAction($id)
	{

		$userRep = $this->getDoctrine()->getManager()->getRepository('RokBasketBundle:User');
		$terminRep = $this->getDoctrine()->getManager()->getRepository('RokBasketBundle:Termin');
		$obskTerminRep = $this->getDoctrine()->getManager()->getRepository('RokBasketBundle:ObiskTermina');
		

		$statusTerminUser = $obskTerminRep->findBy(array('user' => $this->getUser()->getId()));
		$query = $terminRep->findAllTermins();
		for ($i=0;$i<count($query) & $i<count($statusTerminUser);$i++){
			$query[$i]->status = $statusTerminUser[$i]->getStatus();
		}
		//usort($query, array($this,'terminSort'));
		$pridejo = $obskTerminRep->getPeopleOnTerminId($id);
		usort( $pridejo, array($this,'personSort'));
		
		$izbranTermin = $terminRep->find($id);
		
		$em = $this->getDoctrine()->getManager();//TODO: preveri, ce spreminjamo pravi termin
		$obisk = $obskTerminRep->getUserOnTermin($this->getUser()->getId(),$id);

		$termin = new Pridem();
		if ($obisk){
			$status = true;
		}
		else $status = false;
		
		$termin->setTermin($id);		
		
		
		$form = $this->createFormBuilder($termin)
		->setAction($this->generateUrl('pridem'))
		->add('termin', 'hidden')
		//->add('Pridem', 'submit')
		->getForm();
		
		return	array('termini' => $query, 'pridejo' => $pridejo, 'form' => $form->createView() ,
				 'status' => $status , 'izbranTermin' => $izbranTermin);	
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
		->getUserOnTermin($user->getId(),$pridem->getTermin())[0];
		
		if (!$obisk){
			throw $this->createNotFoundException(
					'Termin za osebo'.$user->getImePriim().'ne obstaja'
			);
		}
		
		if($form->get('Pridem')->isClicked())
			$obisk->setStatus('pride');
		else $obisk->setStatus('nepride');
		$em->flush();
	    
		return $this->redirect($this->generateUrl('obiski',array('id' => $pridem->getTermin())));
	
		
	}
	
	
}
