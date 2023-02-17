<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertFixtures extends Fixture implements DependentFixtureInterface
{
    public const CONCERT1_CONCERT_REFERENCE='concert1-concert';
    public const CONCERT2_CONCERT_REFERENCE='concert2-concert';
    public const CONCERT3_CONCERT_REFERENCE='concert3-concert';

    public function load(ObjectManager $manager): void
    {
        $c1 = new Concert();
        $c1 ->setDate(\DateTime::createFromFormat("d/m/Y",'17/02/2023'))
            ->setSartHour(\DateTime::createFromFormat("H:i:s",'10:00:00'))
            ->setEndHour(\DateTime::createFromFormat("H:i:s",'12:00:00'))
            ->setRoom($this->getReference(RoomFixtures::ROOM2_ROOM_REFERENCE))
            ->setArtist($this->getReference(ArtistFixtures::EMINEM_ARTIST_REFERENCE))
            ->setPlaylist($this->getReference(PlaylistFixtures::PLAYLIST2_PLAYLIST_REFERENCE));

        $manager->persist($c1);

        $c2 = new Concert();
        $c2 ->setDate(\DateTime::createFromFormat("d/m/Y",'20/04/2023'))
            ->setSartHour(\DateTime::createFromFormat("H:i:s",'13:30:00'))
            ->setEndHour(\DateTime::createFromFormat("H:i:s",'16:30:00'))
            ->setRoom($this->getReference(RoomFixtures::ROOM2_ROOM_REFERENCE))
            ->setArtist($this->getReference(ArtistFixtures::TUPAC_ARTIST_REFERENCE))
            ->setPlaylist($this->getReference(PlaylistFixtures::PLAYLIST1_PLAYLIST_REFERENCE));
        $manager->persist($c2);

        $c3 = new Concert();
        $c3 ->setDate(\DateTime::createFromFormat("d/m/Y",'04/05/2023'))
            ->setSartHour(\DateTime::createFromFormat("H:i:s",'10:00:00'))
            ->setEndHour(\DateTime::createFromFormat("H:i:s",'12:00:00'))
            ->setRoom($this->getReference(RoomFixtures::ROOM2_ROOM_REFERENCE))
            ->setArtist($this->getReference(ArtistFixtures::SOAD_ARTIST_REFERENCE))
            ->setPlaylist($this->getReference(PlaylistFixtures::PLAYLIST1_PLAYLIST_REFERENCE));
        $manager->persist($c3);

        $manager->flush();


        $this->addReference(self::CONCERT1_CONCERT_REFERENCE,$c1);
        $this->addReference(self::CONCERT2_CONCERT_REFERENCE,$c2);
        $this->addReference(self::CONCERT3_CONCERT_REFERENCE,$c3);
    }


    public function getDependencies()
    {
        return [
            PlaylistFixtures::class,
            RoomFixtures::class,
            ArtistFixtures::class,
        ];
    }
}
