<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Ads;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
         
        $user = new User();
        $hash = $this->encoder->encodePassword($user, 'password');

        $user->setEmail($faker->email)
        ->setPassword($hash);

        for ($a = 0; $a < 70; $a++)
        {
            $ads = new Ads();

            $ads->setCity($faker->city())
                ->setTitle($faker->title())
                ->setDescription($faker->text())
                ->setArea(rand(30, 350))
                ->setRooms(rand(2, 6))
                ->setbedRooms(rand(1, 3))
                ->setFloor($faker->randomElement(['rez-de-chaussée', '1', '2', '3', '4']))
                ->setPrice($faker->randomFloat(2, 40000, 9000000))
                ->setType($faker->randomElement(['Maison', 'Appartement']))
                ->setUser($user);
                

            $manager->persist($ads);
        }
        $manager->persist($user);
        $manager->flush();
    }
}
