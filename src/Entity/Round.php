<?php

namespace App\Entity;

use App\Repository\RouletteCellRepository;
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
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Spin::class, mappedBy="round")
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $spin->setRound($this);
        }

        return $this;
    }

    public function removeSpin(Spin $spin): self
    {
        if ($this->spins->contains($spin)) {
            $this->spins->removeElement($spin);
            // set the owning side to null (unless already changed)
            if ($spin->getRound() === $this) {
                $spin->setRound(null);
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
}
