<?php

namespace Carnet\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CarnetUserBundle:Default:index.html.twig');
    }
}
