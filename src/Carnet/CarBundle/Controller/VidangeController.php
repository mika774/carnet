<?php 

namespace Carnet\CarBundle\Controller;

use Carnet\CarBundle\Entity\Car;
use Carnet\CarBundle\Entity\Vidange;

use Carnet\CarBundle\Form\VidangeType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VidangeController extends Controller
{

	public function viewAction($id)
	{
		$em = $this->getDoctrine()->getManager();

    	$vidange = $em->getRepository('CarnetCarBundle:Vidange')->find($id);

    	if (null === $vidange) {
    		throw new NotFoundHttpException("La vidange d'id ".$id." n'existe pas");
    	}

    	$reparations = $vidange->getReparations();

    	return $this->render('CarnetCarBundle:Vidange:view.html.twig', array(
            'vidange' => $vidange,
            'reparations' => $reparations
    	));
	}

	public function addAction($id_car, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$vidange = new Vidange();

		$form = $this->createForm(VidangeType::class, $vidange);

		$car = $em->getRepository('CarnetCarBundle:Car')->find($id_car);

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$vidange->setCar($car);
			$em->persist($vidange);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Vidange bien enregistrée');

			return $this->redirectToRoute('carnet_car_view', array('id' => $car->getId()));
		}

		return $this->render('CarnetCarBundle:Vidange:add.html.twig', array(
			'form' => $form->createView()
		));
	}

	public function deleteAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();

		$vidange = $em->getRepository('CarnetCarBundle:Vidange')->find($id);
		$car = $vidange->getCar();

		if (null === $vidange) {
			throw new NotFoundHttpException("La vidange d'id ".$id." n'existe pas");
		}

		$form = $this->get('form.factory')->create();

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em->remove($vidange);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Vidange bien supprimée');

			return $this->redirectToRoute('carnet_car_view', array('id' => $car->getId()));
		}

		return $this->render('CarnetCarBundle:Vidange:delete.html.twig', array(
			'vidange' => $vidange,
			'form' => $form->createView()
		));
	}
}