<?php 

namespace Carnet\CarBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Carnet\CarBundle\Entity\Reparation;

class LoadReparationData implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$names = array(
			'Huile moteur',
			'Liquide de frein',
			'Liquide de refroidissement'
		);

		foreach ($names as $name) {
			$reparation = new Reparation();
			$reparation->setName($name);

			$manager->persist($reparation);
		}

		$manager->flush();
	}
}