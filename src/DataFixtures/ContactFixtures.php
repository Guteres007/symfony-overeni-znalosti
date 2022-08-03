<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker =  Factory::create();

        for ($i = 0; $i < 500; $i++) {
            $contact = new Contact();
            $contact->setFirstName($faker->firstName());
            $contact->setLastName($faker->lastName());
            $contact->setEmail($faker->email());
            $contact->setNote($faker->text());
            $contact->setPhone($faker->phoneNumber());
            $manager->persist($contact);
        }


        $manager->flush();
    }
}
