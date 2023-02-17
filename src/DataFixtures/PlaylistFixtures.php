<?php

namespace App\DataFixtures;

use App\Entity\Playlist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlaylistFixtures extends Fixture implements DependentFixtureInterface
{
    public const PLAYLIST1_PLAYLIST_REFERENCE='play1-playlist';
    public const PLAYLIST2_PLAYLIST_REFERENCE='play2-playlist';

    public function load(ObjectManager $manager): void
    {

        $p1 = new Playlist();
        $p1 ->addSong($this->getReference(SongFixtures::SONG1_SONG_REFERENCE))
            ->addSong($this->getReference(SongFixtures::SONG2_SONG_REFERENCE))
            ->addSong($this->getReference(SongFixtures::SONG3_SONG_REFERENCE))
            ->addSong($this->getReference(SongFixtures::SONG4_SONG_REFERENCE));
        $manager->persist($p1);




        $p2 = new Playlist();
        $p2 ->addSong($this->getReference(SongFixtures::SONG1_SONG_REFERENCE))
            ->addSong($this->getReference(SongFixtures::SONG3_SONG_REFERENCE))
            ->addSong($this->getReference(SongFixtures::SONG5_SONG_REFERENCE))
            ->addSong($this->getReference(SongFixtures::SONG6_SONG_REFERENCE));
        $manager->persist($p2);
        $manager->flush();


        $this->addReference(self::PLAYLIST1_PLAYLIST_REFERENCE,$p1);
        $this->addReference(self::PLAYLIST2_PLAYLIST_REFERENCE,$p2);

    }


    public function getDependencies()
    {
        return [
            SongFixtures::class,
        ];
    }

}
