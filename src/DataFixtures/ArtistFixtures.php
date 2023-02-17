<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public const EMINEM_ARTIST_REFERENCE='eminem-artist';
    public const TUPAC_ARTIST_REFERENCE='tupac-artist';
    public const PNL_ARTIST_REFERENCE='pnl-artist';
    public const SOAD_ARTIST_REFERENCE='soad-artist';

    public function load(ObjectManager $manager): void
    {
        $a1 = new Artist();
        $a1 ->setGroupName('Eminem')
            ->setArtistPicture("groupeEminem.jpg");
        $manager->persist($a1);

        $a2 = new Artist();
        $a2 ->setGroupName('Tupac')
            ->setArtistPicture("groupeTupac.jpg");

        $manager->persist($a2);

        $a3 = new Artist();
        $a3 ->setGroupName('PNL')
            ->setArtistPicture("groupePNL.jpg");
        $manager->persist($a3);

        $a4 = new Artist();
        $a4 ->setGroupName('System of a down')
            ->setArtistPicture("groupeSOD.jpg");

        $manager->persist($a4);

        $manager->flush();

        $this->addReference(self::EMINEM_ARTIST_REFERENCE,$a1);
        $this->addReference(self::TUPAC_ARTIST_REFERENCE,$a2);
        $this->addReference(self::PNL_ARTIST_REFERENCE,$a3);
        $this->addReference(self::SOAD_ARTIST_REFERENCE,$a4);


    }
}
