<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReservationFixtures extends Fixture implements DependentFixtureInterface
{
    public const RESERVATION1_RESERVATION_REFERENCE='reservation1-reservation';
    public const RESERVATION2_RESERVATION_REFERENCE='reservation2-reservation';

    public function load(ObjectManager $manager): void
    {
        $reservation1 = new Reservation();
        $reservation1 ->setPrice(130)
                      ->setUser($this->getReference(UserFixtures::USER1_USER_REFERENCE))
                      ->setConcert($this->getReference(ConcertFixtures::CONCERT1_CONCERT_REFERENCE));
        $manager->persist($reservation1);

        $reservation2 = new Reservation();
        $reservation2 ->setPrice(60)
            ->setUser($this->getReference(UserFixtures::USER2_USER_REFERENCE))
            ->setConcert($this->getReference(ConcertFixtures::CONCERT2_CONCERT_REFERENCE));
        $manager->persist($reservation2);

        $manager->flush();

        $this->addReference(self::RESERVATION1_RESERVATION_REFERENCE,$reservation1);
        $this->addReference(self::RESERVATION2_RESERVATION_REFERENCE,$reservation2);
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ConcertFixtures::class,
        ];
    }
}
