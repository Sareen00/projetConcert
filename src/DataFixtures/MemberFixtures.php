<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Member;

class MemberFixtures extends Fixture implements DependentFixtureInterface
{
    public const EMINEM_MEMBER_REFERENCE='member1-member';
    public const TUPAC_MEMBER_REFERENCE='member2-member';
    public const TARIK_MEMBER_REFERENCE='member3-member';
    public const NABIL_MEMBER_REFERENCE='member4-member';

    public const DARON_MEMBER_REFERENCE='member5-member';
    public const SERJ_MEMBER_REFERENCE='member6-member';
    public const SHAVO_MEMBER_REFERENCE='member7-member';
    public const JOHN_MEMBER_REFERENCE='member8-member';

    public function load(ObjectManager $manager): void
    {
        $m1 = new Member();
        $m1 ->setMemberLastname('Marshall')
            ->setMemberFirstname('Mathers')
            ->setBirthday(\DateTime::createFromFormat("d/m/Y",'17/10/1972'))
            ->setPicture("eminem.jpg")
            ->setArtist($this->getReference(ArtistFixtures::EMINEM_ARTIST_REFERENCE));
        $manager->persist($m1);

        $m2 = new Member();
        $m2 ->setMemberLastname('Tupac')
            ->setMemberFirstname('Shakur')
            ->setBirthday(\DateTime::createFromFormat("d/m/Y",'16/06/1971'))
            ->setPicture("tupac.jpg")
            ->setArtist($this->getReference(ArtistFixtures::TUPAC_ARTIST_REFERENCE));
        $manager->persist($m2);

        $m3 = new Member();
        $m3->setMemberLastname('Andrieu')
            ->setMemberFirstname('Tarik')
            ->setBirthday(\DateTime::createFromFormat("d/m/Y",'26/12/1986'))
            ->setPicture("tarik.jpg")
            ->setArtist($this->getReference(ArtistFixtures::PNL_ARTIST_REFERENCE));
        $manager->persist($m3);

        $m4 = new Member();
        $m4->setMemberLastname('Andrieu')
            ->setMemberFirstname('Nabil')
            ->setBirthday(\DateTime::createFromFormat("d/m/Y",'25/04/1989'))
            ->setPicture("nabil.jpg")
            ->setArtist($this->getReference(ArtistFixtures::PNL_ARTIST_REFERENCE));
        $manager->persist($m4);


        $m5 = new Member();
        $m5->setMemberLastname('Malakian')
            ->setMemberFirstname('Daron')
            ->setBirthday(\DateTime::createFromFormat("d/m/Y",'18/07/1975'))
            ->setPicture("daron.jpg")
            ->setArtist($this->getReference(ArtistFixtures::SOAD_ARTIST_REFERENCE));
        $manager->persist($m5);

        $m6 = new Member();
        $m6->setMemberLastname('Tankian')
            ->setMemberFirstname('Serj')
            ->setBirthday(\DateTime::createFromFormat("d/m/Y",'21/08/1967'))
            ->setPicture("serj.jpg")
            ->setArtist($this->getReference(ArtistFixtures::SOAD_ARTIST_REFERENCE));
        $manager->persist($m6);

        $m7 = new Member();
        $m7->setMemberLastname('Odadjian')
            ->setMemberFirstname('Shavo')
            ->setBirthday(\DateTime::createFromFormat("d/m/Y",'22/04/1974'))
            ->setPicture("shavo.jpg")
            ->setArtist($this->getReference(ArtistFixtures::SOAD_ARTIST_REFERENCE));
        $manager->persist($m7);

        $m8 = new Member();
        $m8->setMemberLastname('Dolmayan')
            ->setMemberFirstname('John')
            ->setBirthday(\DateTime::createFromFormat("d/m/Y",'15/07/1973'))
            ->setPicture("john.jpg")
            ->setArtist($this->getReference(ArtistFixtures::SOAD_ARTIST_REFERENCE));
        $manager->persist($m8);





        $manager->flush();

        $this->addReference(self::EMINEM_MEMBER_REFERENCE,$m1);
        $this->addReference(self::TUPAC_MEMBER_REFERENCE,$m2);
        $this->addReference(self::TARIK_MEMBER_REFERENCE,$m3);
        $this->addReference(self::NABIL_MEMBER_REFERENCE,$m4);

        $this->addReference(self::DARON_MEMBER_REFERENCE,$m5);
        $this->addReference(self::SERJ_MEMBER_REFERENCE,$m6);
        $this->addReference(self::SHAVO_MEMBER_REFERENCE,$m7);
        $this->addReference(self::JOHN_MEMBER_REFERENCE,$m8);

    }


    public function getDependencies()
    {
        return [
            ArtistFixtures::class,
        ];
    }
}
