<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Circuit;

class LoadCircuitData extends Fixture
{
	public function load(ObjectManager $manager)
	{		
		$jsonData = file_get_contents(__DIR__ . "/CircuitData.json");
		$rawData = json_decode($jsonData);
		foreach ($rawData as $circuitData){
			$this->loadCircuit($circuitData, $manager);
		}
		$manager->flush();
	}

	function loadCircuit($circuitData, ObjectManager $manager){
		$circuit = new Circuit();
		$circuit->setDescription($circuitData->description);
		$circuit->setPaysDepart($circuitData->paysDepart);
		$circuit->setVilleDepart($circuitData->villeDepart);
		$circuit->setVilleArrivee($circuitData->villeArrivee);
		$circuit->setDureeCircuit($circuitData->dureeCircuit);
		$circuit->setadressePhoto($circuitData->adressePhoto);
		$manager->persist($circuit);
		$this->addReference($circuitData->name, $circuit);
	}
}