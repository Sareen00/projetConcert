<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const USER1_USER_REFERENCE='user1-user';
    public const USER2_USER_REFERENCE='user2-user';
    public const USER3_USER_REFERENCE='user3-user';

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1  ->setEmail("email1@gmail.com")
                ->setLastname("Milhau")
                ->setFirstname("Julien")
                ->setCity("Montpellier")
                ->setPostalCode(34070)
                ->setStreet("7 rue du Roc de Pézenas")
                ->setPicture("julien.jpg")
                ->setRole("Inscrit");
        $manager->persist($user1);

        $user2 = new User();
        $user2  ->setEmail("email2@gmail.com")
            ->setLastname("Al-Idrissi")
            ->setFirstname("Imane")
            ->setCity("Paris")
            ->setPostalCode(10000)
            ->setStreet("Avenue de Fes")
            ->setPicture("imane.jpg")
            ->setRole("Inscrit");
        $manager->persist($user2);

        $user3 = new User();
        $user3  ->setEmail("email1@gmail.com")
                ->setRole("Anonyme");
        $manager->persist($user3);

        $manager->flush();

        $this->addReference(self::USER1_USER_REFERENCE,$user1);
        $this->addReference(self::USER2_USER_REFERENCE,$user2);
        $this->addReference(self::USER3_USER_REFERENCE,$user3);


    }
}
