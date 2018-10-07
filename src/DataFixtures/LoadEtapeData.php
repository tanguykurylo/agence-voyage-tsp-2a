<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Etape;

class LoadEtapeData extends Fixture implements DependentFixtureInterface
{
	public function load(ObjectManager $manager)
	{	
		$jsonData = file_get_contents(__DIR__ . "/EtapeData.json");
		$rawData = json_decode($jsonData);
		foreach ($rawData as $circuitData){
			$this->loadEtapes($circuitData, $manager);
		}
		$manager->flush();
	}

	function loadEtapes($circuitData, ObjectManager $manager){
		$circuit=$this->getReference($circuitData->circuit);
		foreach ($circuitData->etapes as $numeroEtape=>$etapeData){
			$etape = new Etape();
			$etape->setNumeroEtape($numeroEtape);
			$etape->setVilleEtape($etapeData->ville);
			$etape->setNombreJours($etapeData->nombreJours);
			$circuit->addEtape($etape);
			$manager->persist($etape);
		}
		$manager->persist($circuit);
	}

	public function getDependencies()
	{
	    return array(
	        LoadCircuitData::class,
	    );
	}
}