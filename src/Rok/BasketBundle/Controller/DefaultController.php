<?php

namespace Rok\BasketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rok\BasketBundle\Entity;

class DefaultController extends Controller
{
    public function indexAction()
    {

    	$terminRep = $this->getDoctrine()->getManager()->getRepository('RokBasketBundle:Termin');
    	
    	if($this->getUser() != null)    	
        	return $this->redirect($this->generateUrl('obiski', $terminRep->getCurrentTermin()));//array('id' => $terminRep->getCurrentTermin())));
    	else 
    		return $this->redirect($this->generateUrl('_login'));
    }
}
