<?php

namespace Rok\BasketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rok\BasketBundle\Entity;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	if($this->getUser() != null)    	
        	return $this->redirect($this->generateUrl('obiski'));
    	else 
    		return $this->redirect($this->generateUrl('_login'));
    }
}
