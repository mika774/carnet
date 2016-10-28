<?php

namespace Carnet\CarBundle\Controller;

use Carnet\CarBundle\Entity\Car;
use Carnet\CarBundle\Entity\Vidange;

use Carnet\CarBundle\Form\CarType;

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
        
        $vidanges = $car->getVidanges();

    	return $this->render('CarnetCarBundle:Car:view.html.twig', array(
    		'car' => $car,
            'vidanges' => $vidanges
    	));
    }

    public function addAction(Request $request)
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

    		$request->getSession()->getFlashBag()->add('notice', 'Voiture bien enregistrée');

    		return $this->redirectToRoute('carnet_car_view', array('id' => $car->getId()));
    	}

    	return $this->render('CarnetCarBundle:Car:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function updateAction($id, Request $request)
    {
    	$em = $this->getDoctrine()->getManager();

    	$car = $em->getRepository('CarnetCarBundle:Car')->find($id);

    	if (null === $car) {
    		throw new NotFoundHttpException("La voiture d'id ".$id." n'existe pas.");
    	}

        $form = $this->createForm(CarType::class, $car);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
    		$request->getSession()->getFlashBag()->add('notice', 'Voiture bien modifiée');

    		return $this->redirectToRoute('carnet_car_view', array('id' => $car->getId()));
    	}

    	return $this->render('CarnetCarBundle:Car:update.html.twig', array(
            'car'   => $car,
            'form'  => $form->createView()
        ));
    }

    public function deleteAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$car = $em->getRepository('CarnetCarBundle:Car')->find($id);

    	if (null === $car) {
    		throw new NotFoundHttpException("La voiture d'id ".$id." n'existe pas.");
    	}

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($car);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Véhicule bien supprimée');

            return $this->redirectToRoute('carnet_car_home');
        }

    	return $this->render('CarnetCarBundle:Car:delete.html.twig', array(
            'car'   => $car,
            'form'  => $form->createView()
        ));
    }
}