<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class LoadUserData extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
	{		
		$jsonData = file_get_contents(__DIR__ . "/UserData.json");
		$rawData = json_decode($jsonData);
		foreach ($rawData as $userData){
			$this->loadUser($userData, $manager);
		}
		$manager->flush();
	}
    

    public function loadUser($userData, ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername($userData->username);
        $user->addRole($userData->role);
        $user->setEnabled(true);
        $user->setFirstName($userData->firstName);
        $user->setLastName($userData->lastName);     
        $user->setEmail($userData->email);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $userData->password
        ));
        $manager->persist($user);
		$this->addReference($userData->username, $user);
    }
}

    