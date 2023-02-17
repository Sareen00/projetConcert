<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture implements DependentFixtureInterface
{
    public const TAG1_TAG_REFERENCE='tag1-tag';
    public const TAG2_TAG_REFERENCE='tag2-tag';
    public const TAG3_TAG_REFERENCE='tag3-tag';


    public function load(ObjectManager $manager): void
    {
        $tag1 = new Tag();
        $tag1 ->setTagName("Metal")
              ->addSong($this->getReference(SongFixtures::SONG5_SONG_REFERENCE))
              ->addSong($this->getReference(SongFixtures::SONG1_SONG_REFERENCE))
              ->addSong($this->getReference(SongFixtures::SONG3_SONG_REFERENCE))
              ->addArtist($this->getReference(ArtistFixtures::SOAD_ARTIST_REFERENCE));
        $manager->persist($tag1);

        $tag2 = new Tag();
        $tag2 ->setTagName("Pop")
              ->addSong($this->getReference(SongFixtures::SONG1_SONG_REFERENCE))
              ->addSong($this->getReference(SongFixtures::SONG6_SONG_REFERENCE))
              ->addArtist($this->getReference(ArtistFixtures::PNL_ARTIST_REFERENCE));
        $manager->persist($tag2);

        $tag3 = new Tag();
        $tag3 ->setTagName("Rap")
              ->addSong($this->getReference(SongFixtures::SONG4_SONG_REFERENCE))
              ->addArtist($this->getReference(ArtistFixtures::EMINEM_ARTIST_REFERENCE))
              ->addArtist($this->getReference(ArtistFixtures::TUPAC_ARTIST_REFERENCE))
              ->addArtist($this->getReference(ArtistFixtures::PNL_ARTIST_REFERENCE));

        $manager->persist($tag3);

        $manager->flush();

        $this->addReference(self::TAG1_TAG_REFERENCE,$tag1);
        $this->addReference(self::TAG2_TAG_REFERENCE,$tag2);
        $this->addReference(self::TAG3_TAG_REFERENCE,$tag3);
    }

    public function getDependencies()
    {
        return [
            ArtistFixtures::class,
            SongFixtures::class,
        ];
    }
}
