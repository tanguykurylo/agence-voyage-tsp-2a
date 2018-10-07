<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ProgrammationCircuit;

class LoadProgrammationCircuitData extends Fixture implements DependentFixtureInterface
{
	public function load(ObjectManager $manager)
	{		
		$jsonData = file_get_contents(__DIR__ . "/ProgrammationCircuitData.json");
		$rawData = json_decode($jsonData);
		foreach ($rawData as $programmedCircuitData){
			$this->loadProgrammedCircuit($programmedCircuitData, $manager);
		}
		$manager->flush();
	}

	function loadProgrammedCircuit($programmedCircuitData, ObjectManager $manager){
		$circuit=$this->getReference($programmedCircuitData->circuit);
		$programmedCircuit = new ProgrammationCircuit();
		$dateDepart = new \DateTime($programmedCircuitData->dateDepart);
		$programmedCircuit->setDateDepart($dateDepart);
		$programmedCircuit->setnombrePersonnes($programmedCircuitData->nombrePersonnes);
		$programmedCircuit->setPrix($programmedCircuitData->prix);
		$manager->persist($programmedCircuit);
		$circuit->addProgrammation($programmedCircuit);
		$manager->persist($circuit);
	}

	public function getDependencies()
	{
	    return array(
	        LoadCircuitData::class,
	    );
	}
}