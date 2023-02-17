<?php

namespace App\Entity;

use App\Repository\SeatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeatRepository::class)]
class Seat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $seat_row = null;

    #[ORM\Column(nullable: true)]
    private ?int $seat_number = null;

    #[ORM\ManyToOne(inversedBy: 'seats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?room $room = null;



    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeatRow(): ?string
    {
        return $this->seat_row;
    }

    public function setSeatRow(?string $seat_row): self
    {
        $this->seat_row = $seat_row;

        return $this;
    }

    public function getSeatNumber(): ?int
    {
        return $this->seat_number;
    }

    public function setSeatNumber(?int $seat_number): self
    {
        $this->seat_number = $seat_number;

        return $this;
    }

    public function getRoom(): ?room
    {
        return $this->room;
    }

    public function setRoom(?room $room): self
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->addSeat($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            $reservation->removeSeat($this);
        }

        return $this;
    }
}
