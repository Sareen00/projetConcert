<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoomFixtures extends Fixture
{
    public const ROOM1_ROOM_REFERENCE='room1-room';
    public const ROOM2_ROOM_REFERENCE='room2-room';

    public function load(ObjectManager $manager): void
    {
        $r1 = new Room();
        $r1 ->setFloor(1)
            ->setRoomNumber(3);
        $manager->persist($r1);


        $r2 = new Room();
        $r2 ->setFloor(0)
            ->setRoomNumber(1);

        $manager->persist($r2);

        $manager->flush();

        $this->addReference(self::ROOM1_ROOM_REFERENCE,$r1);
        $this->addReference(self::ROOM2_ROOM_REFERENCE,$r2);
    }


}
