<?php

namespace App\DataFixtures;

use App\Entity\Preferences;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PreferencesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $preferences1 = new Preferences();
        $preferences1->setUser($this->getReference(UserFixtures::USER1_USER_REFERENCE))
            ->addTag($this->getReference(TagFixtures::TAG1_TAG_REFERENCE))
            ->addTag($this->getReference(TagFixtures::TAG2_TAG_REFERENCE))
            ->addArtist($this->getReference(ArtistFixtures::EMINEM_ARTIST_REFERENCE))
            ->addSong($this->getReference(SongFixtures::SONG5_SONG_REFERENCE));
        $manager->persist($preferences1);

        $preferences2 = new Preferences();
        $preferences2->setUser($this->getReference(UserFixtures::USER3_USER_REFERENCE))
            ->addTag($this->getReference(TagFixtures::TAG1_TAG_REFERENCE))
            ->addTag($this->getReference(TagFixtures::TAG3_TAG_REFERENCE))
            ->addArtist($this->getReference(ArtistFixtures::PNL_ARTIST_REFERENCE))
            ->addSong($this->getReference(SongFixtures::SONG1_SONG_REFERENCE));
        $manager->persist($preferences2);

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            ArtistFixtures::class,
            SongFixtures::class,
            TagFixtures::class,
        ];
    }
}
