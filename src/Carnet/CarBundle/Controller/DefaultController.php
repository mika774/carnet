<?php

namespace Carnet\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CarnetCarBundle:Default:index.html.twig');
    }
}
