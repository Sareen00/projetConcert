<?php

namespace App\DataFixtures;

use App\Entity\Seat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeatFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEAT1_SONG_REFERENCE='seat1-song';
    public const SEAT2_SONG_REFERENCE='seat2-song';
    public const SEAT3_SONG_REFERENCE='seat3-song';
    public const SEAT4_SONG_REFERENCE='seat4-song';

    public function load(ObjectManager $manager): void
    {
        $seat1 = new Seat();
        $seat1 ->setSeatRow("A")
               ->setSeatNumber(15)
               ->setRoom($this->getReference(RoomFixtures::ROOM1_ROOM_REFERENCE));
        $manager->persist($seat1);

        $seat2 = new Seat();
        $seat2 ->setSeatRow("B")
            ->setSeatNumber(1)
            ->setRoom($this->getReference(RoomFixtures::ROOM1_ROOM_REFERENCE));
        $manager->persist($seat2);

        $seat3 = new Seat();
        $seat3 ->setSeatRow("A")
            ->setSeatNumber(11)
            ->setRoom($this->getReference(RoomFixtures::ROOM1_ROOM_REFERENCE));
        $manager->persist($seat3);

        $seat4 = new Seat();
        $seat4 ->setSeatRow("C")
            ->setSeatNumber(12)
            ->setRoom($this->getReference(RoomFixtures::ROOM1_ROOM_REFERENCE));
        $manager->persist($seat4);

        $manager->flush();

        $this->addReference(self::SEAT1_SONG_REFERENCE,$seat1);
        $this->addReference(self::SEAT2_SONG_REFERENCE,$seat2);
        $this->addReference(self::SEAT3_SONG_REFERENCE,$seat3);
        $this->addReference(self::SEAT4_SONG_REFERENCE,$seat4);
    }

    public function getDependencies()
    {
        return [
            RoomFixtures::class,

        ];
    }
}
