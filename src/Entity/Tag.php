<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $tag_name = null;

    #[ORM\ManyToMany(targetEntity: Preferences::class, inversedBy: 'tags')]
    private Collection $preferences;

    #[ORM\ManyToMany(targetEntity: Song::class, mappedBy: 'tags')]
    private Collection $songs;

    #[ORM\ManyToMany(targetEntity: Artist::class, inversedBy: 'tags')]
    private Collection $artists;

    public function __construct()
    {
        $this->preferences = new ArrayCollection();
        $this->songs = new ArrayCollection();
        $this->artists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTagName(): ?string
    {
        return $this->tag_name;
    }

    public function setTagName(string $tag_name): self
    {
        $this->tag_name = $tag_name;

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
     * @return Collection<int, Song>
     */
    public function getSongs(): Collection
    {
        return $this->songs;
    }

    public function addSong(Song $song): self
    {
        if (!$this->songs->contains($song)) {
            $this->songs->add($song);
            $song->addTag($this);
        }

        return $this;
    }

    public function removeSong(Song $song): self
    {
        if ($this->songs->removeElement($song)) {
            $song->removeTag($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        $this->artists->removeElement($artist);

        return $this;
    }
}
