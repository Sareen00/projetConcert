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
        $manager->persist($r1);


        $r2 = new Room();
        $manager->persist($r2);

        $manager->flush();

        $this->addReference(self::ROOM1_ROOM_REFERENCE,$r1);
        $this->addReference(self::ROOM2_ROOM_REFERENCE,$r2);
    }


}
