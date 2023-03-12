<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USER1_USER_REFERENCE='user1-user';
    public const USER2_USER_REFERENCE='user2-user';
    public const USER3_USER_REFERENCE='user3-user';


    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }



    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1  ->setEmail("email@gmail.com")
                ->setLastname("Milhau")
                ->setFirstname("Julien")
                ->setPassword('azerty')
                ->setPassword($this->passwordHasher->hashPassword(
                        $user1,
                       'azerty'
                ))        
                ->setProfilepicture("utilisateur1.jpg")
                ->setRoles(['ROLE_USER']);       
        $manager->persist($user1);

        $user2 = new User();
        $user2  ->setEmail("utilisateur@gmail.com")
                ->setLastname("Donnadieu")
                ->setFirstname("Jade")
                ->setPassword($this->passwordHasher->hashPassword(
                        $user2,
                       'qsdfgh'
                ))    
                ->setProfilepicture("utilisateur2.jpg")
                ->setRoles(['ROLE_USER']);
        $manager->persist($user2);

        $user3 = new User();
        $user3  ->setEmail("adresse@gmail.com")
                ->setLastname("Leonart")
                ->setFirstname("Annie")
                ->setPassword($this->passwordHasher->hashPassword(
                        $user3,
                       'wxcvbn'
                ))    
                ->setProfilepicture("utilisateur3.jpg")
                ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user3);

        $manager->flush();

        $this->addReference(self::USER1_USER_REFERENCE,$user1);
        $this->addReference(self::USER2_USER_REFERENCE,$user2);
        $this->addReference(self::USER3_USER_REFERENCE,$user3);
    }
}
