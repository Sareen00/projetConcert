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

    #[ORM\Column(name:'member_lastname',length: 40, nullable: true)]
    private ?string $memberLastname = null;

    #[ORM\ManyToOne(inversedBy: 'members')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $artist = null;

    #[ORM\Column(name:'member_firstname',length: 40)]
    private ?string $memberFirstname = null;

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
        return $this->memberLastname;
    }

    public function setMemberLastname(?string $memberLastname): self
    {
        $this->memberLastname = $memberLastname;

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
        return $this->memberFirstname;
    }

    public function setMemberFirstname(string $memberFirstname): self
    {
        $this->memberFirstname = $memberFirstname;

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
