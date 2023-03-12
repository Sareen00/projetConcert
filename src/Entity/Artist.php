<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name:"group_name",length: 40, nullable: true)]
    private ?string $groupName = null;

    #[ORM\OneToMany(mappedBy: 'artist', targetEntity: Member::class)]
    private Collection $members;

    #[ORM\OneToMany(mappedBy: 'artist', targetEntity: Concert::class)]
    private Collection $concerts;

    #[ORM\ManyToMany(targetEntity: Preferences::class, inversedBy: 'artists')]
    private Collection $preferences;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'artists')]
    private Collection $tags;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $artistPicture = null;

    public function __construct()
    {
        $this->members = new ArrayCollection();
        $this->concerts = new ArrayCollection();
        $this->preferences = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupName(): ?string
    {
        return $this->groupName;
    }

    public function setGroupName(?string $groupName): self
    {
        $this->groupName = $groupName;

        return $this;
    }

    /**
     * @return Collection<int, Member>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Member $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members->add($member);
            $member->setArtist($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getArtist() === $this) {
                $member->setArtist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Concert>
     */
    public function getConcerts(): Collection
    {
        return $this->concerts;
    }

    public function addConcert(Concert $concert): self
    {
        if (!$this->concerts->contains($concert)) {
            $this->concerts->add($concert);
            $concert->setArtist($this);
        }

        return $this;
    }

    public function removeConcert(Concert $concert): self
    {
        if ($this->concerts->removeElement($concert)) {
            // set the owning side to null (unless already changed)
            if ($concert->getArtist() === $this) {
                $concert->setArtist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Preferences>
     */
    public function getPreferences(): Collection
    {
        return $this->preferences;
    }

    public function addPreference(Preferences $preference): self
    {
        if (!$this->preferences->contains($preference)) {
            $this->preferences->add($preference);
        }

        return $this;
    }

    public function removePreference(Preferences $preference): self
    {
        $this->preferences->removeElement($preference);

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addArtist($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeArtist($this);
        }

        return $this;
    }

    public function toString(){
        return $this->getGroupName();
    }

    public function getArtistPicture(): ?string
    {
        return $this->artistPicture;
    }

    public function setArtistPicture(?string $artistPicture): self
    {
        $this->artistPicture = $artistPicture;

        return $this;
    }
}
