<?php

namespace Rok\BasketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RokBasketBundle:Default:index.html.twig', array('name' => $name));
    }
}
