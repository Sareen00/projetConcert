<?php

namespace App\DataFixtures;

use App\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SongFixtures extends Fixture
{
    public const SONG1_SONG_REFERENCE='song1-song';
    public const SONG2_SONG_REFERENCE='song2-song';
    public const SONG3_SONG_REFERENCE='song3-song';
    public const SONG4_SONG_REFERENCE='song4-song';
    public const SONG5_SONG_REFERENCE='song5-song';
    public const SONG6_SONG_REFERENCE='song6-song';

    public function load(ObjectManager $manager): void
    {
        $s1 = new Song();
        $s1 ->setSongName("Mockingbird");
        $manager->persist($s1);

        $s2 = new Song();
        $s2 ->setSongName("Soldier");
        $manager->persist($s2);

        $s3 = new Song();
        $s3 ->setSongName("My name is");
        $manager->persist($s3);

        $s4 = new Song();
        $s4 ->setSongName("The real Slim Shady");
        $manager->persist($s4);

        $s5 = new Song();
        $s5 ->setSongName("Kings never die");
        $manager->persist($s5);

        $s6 = new Song();
        $s6 ->setSongName("Identity");
        $manager->persist($s6);

        $manager->flush();

        $this->addReference(self::SONG1_SONG_REFERENCE,$s1);
        $this->addReference(self::SONG2_SONG_REFERENCE,$s2);
        $this->addReference(self::SONG3_SONG_REFERENCE,$s3);
        $this->addReference(self::SONG4_SONG_REFERENCE,$s4);
        $this->addReference(self::SONG5_SONG_REFERENCE,$s5);
        $this->addReference(self::SONG6_SONG_REFERENCE,$s6);

    }
}
