<?php

namespace App\Entity;

use App\Repository\RoundRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoundRepository::class)
 */
class Round
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="rounds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\OneToMany(targetEntity=Spin::class, mappedBy="round_id")
     */
    private $spins;

    public function __construct()
    {
        $this->spins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection|Spin[]
     */
    public function getSpins(): Collection
    {
        return $this->spins;
    }

    public function addSpin(Spin $spin): self
    {
        if (!$this->spins->contains($spin)) {
            $this->spins[] = $spin;
            $spin->setRoundId($this);
        }

        return $this;
    }

    public function removeSpin(Spin $spin): self
    {
        if ($this->spins->contains($spin)) {
            $this->spins->removeElement($spin);
            // set the owning side to null (unless already changed)
            if ($spin->getRoundId() === $this) {
                $spin->setRoundId(null);
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isOver(): bool
    {
        /** @var Spin $lastSpin */
        $lastSpin = $this->spins->last();

        return $lastSpin->getIsJackpot();
    }

    public function getAvailableCells()
    {
        $lockedCells = $this->spins->map(function (Spin $spin) {
            return $spin->getDroppedCell();
        })->toArray();

        return array_diff(Spin::CELLS, $lockedCells);
    }
}
