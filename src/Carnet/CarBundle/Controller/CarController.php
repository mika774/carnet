<?php

namespace Carnet\CarBundle\Controller;

use Carnet\CarBundle\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CarController extends Controller
{
    public function indexAction($page)
    {
    	if ($page < 1) {
    		throw new NotFoundHttpException("La page ".$page." n'existe pas.");
    	}

    	$em = $this->getDoctrine()->getManager();

    	$listCars = $em->getRepository('CarnetCarBundle:Car')->findAll();


        return $this->render('CarnetCarBundle:Car:index.html.twig', array(
        	'listCars' => $listCars
        ));
    }

    public function viewAction($id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$car = $em->getRepository('CarnetCarBundle:Car')->find($id);

    	if (null === $car) {
    		throw new NotFoundHttpException("La voiture d'id ".$id." n'existe pas");
    	}

    	return $this->render('CarnetCarBundle:Car:view.html.twig', array(
    		'car' => $car
    	));
    }

    public function addAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

    	if ($request->isMethod('POST')) {
    		$request->getSession()->getFlashBag()->add('notice', 'Voiture bien enregistrée');

    		return $this->redirectToRoute('carnet_car_view', array('id' => $car->getId()));
    	}

    	return $this->render('CarnetCarBundle:Car:add.html.twig');
    }

    public function updateAction($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

    	$car = $em->getRepository('CarnetCarBundle:Car')->find($id);

    	if (null === $car) {
    		throw new NotFoundHttpException("La voiture d'id ".$id." n'existe pas.");
    	}

    	if ($request->isMethod('POST')) {
    		$request->getSession()->getFlashBag()->add('notice', 'Voiture bien modifiée');

    		return $this->redirectToRoute('carnet_car_view', array('id' => $car->getId()));
    	}

    	return $this->render('CarnetCarBundle:Car:update.html.twig');
    }

    public function deleteAction($id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$car = $em->getRepository('CarnetCarBundle:Car')->find($id);

    	if (null === $car) {
    		throw new NotFoundHttpException("La voiture d'id ".$id." n'existe pas.");
    	}

    	return $this->render('CarnetCarBundle:Car:delete.html.twig');
    }
}
