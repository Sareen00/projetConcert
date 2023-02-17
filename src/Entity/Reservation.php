<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Concert $concert = null;


    #[ORM\OneToOne(mappedBy: 'reservation', cascade: ['persist', 'remove'])]
    private ?Review $review = null;



    public function __construct()
    {
        $this->seats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getConcert(): ?Concert
    {
        return $this->concert;
    }

    public function setConcert(?Concert $concert): self
    {
        $this->concert = $concert;

        return $this;
    }

    /**
     * @return Collection<int, seat>
     */
    public function getSeats(): Collection
    {
        return $this->seats;
    }

    public function addSeat(seat $seat): self
    {
        if (!$this->seats->contains($seat)) {
            $this->seats->add($seat);
        }

        return $this;
    }

    public function removeSeat(seat $seat): self
    {
        $this->seats->removeElement($seat);

        return $this;
    }

    public function getReview(): ?Review
    {
        return $this->review;
    }

    public function setReview(Review $review): self
    {
        // set the owning side of the relation if necessary
        if ($review->getReservation() !== $this) {
            $review->setReservation($this);
        }

        $this->review = $review;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
