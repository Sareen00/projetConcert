<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $floor = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $room_number = null;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: Seat::class)]
    private Collection $seats;


    public function __construct()
    {
        $this->seats = new ArrayCollection();
        $this->concerts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(?int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getRoomNumber(): ?int
    {
        return $this->room_number;
    }

    public function setRoomNumber(?int $room_number): self
    {
        $this->room_number = $room_number;

        return $this;
    }

    /**
     * @return Collection<int, Seat>
     */
    public function getSeats(): Collection
    {
        return $this->seats;
    }

    public function addSeat(Seat $seat): self
    {
        if (!$this->seats->contains($seat)) {
            $this->seats->add($seat);
            $seat->setRoom($this);
        }

        return $this;
    }

    public function removeSeat(Seat $seat): self
    {
        if ($this->seats->removeElement($seat)) {
            // set the owning side to null (unless already changed)
            if ($seat->getRoom() === $this) {
                $seat->setRoom(null);
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
            $concert->setRoom($this);
        }

        return $this;
    }

    public function removeConcert(Concert $concert): self
    {
        if ($this->concerts->removeElement($concert)) {
            // set the owning side to null (unless already changed)
            if ($concert->getRoom() === $this) {
                $concert->setRoom(null);
            }
        }

        return $this;
    }
}
