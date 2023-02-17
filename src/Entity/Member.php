<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ORM\Table(name: '`member`')]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $member_lastname = null;

    #[ORM\ManyToOne(inversedBy: 'members')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $artist = null;

    #[ORM\Column(length: 40)]
    private ?string $member_firstname = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthday = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMemberLastname(): ?string
    {
        return $this->member_lastname;
    }

    public function setMemberLastname(?string $member_lastname): self
    {
        $this->member_lastname = $member_lastname;

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getMemberFirstname(): ?string
    {
        return $this->member_firstname;
    }

    public function setMemberFirstname(string $member_firstname): self
    {
        $this->member_firstname = $member_firstname;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

        public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }
}
