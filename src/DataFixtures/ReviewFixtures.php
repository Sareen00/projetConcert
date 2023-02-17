<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $review1 = new Review();
        $review1 ->setMark(4)
                 ->setComment("C'était un tres bon concert")
                 ->setReservation($this->getReference(ReservationFixtures::RESERVATION1_RESERVATION_REFERENCE));
        $manager->persist($review1);

        $review2 = new Review();
        $review1 ->setMark(2)
                 ->setComment("Eclate")
                 ->setReservation($this->getReference(ReservationFixtures::RESERVATION2_RESERVATION_REFERENCE));
        $manager->persist($review1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ReservationFixtures::class,
        ];
    }
}
