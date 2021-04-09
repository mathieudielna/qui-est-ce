<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Application;

class Applifixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++){
			$application = new Application();
			$application->setDesignation("Nom de l'application n°$i")
						->setDescription("Description de l'application")
						->setCreatedAt(new \DateTime())
						->setResponsable("Jean John");
						
			$manager->persist($application);
 			}
        $manager->flush();
    }
}
