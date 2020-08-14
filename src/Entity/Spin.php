<?php

namespace App\Entity;

use App\Repository\SpinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpinRepository::class)
 */
class Spin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Round::class, inversedBy="spins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $round;

    /**
     * @ORM\ManyToOne(targetEntity=RouletteCell::class, fetch="EAGER")
     * @ORM\JoinColumn(nullable=true)
     */
    private $dropped_cell;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_jackpot = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRound(): ?Round
    {
        return $this->round;
    }

    public function setRound(?Round $round): self
    {
        $this->round = $round;

        return $this;
    }

    public function getDroppedCell(): ?RouletteCell
    {
        return $this->dropped_cell;
    }

    public function setDroppedCell(?RouletteCell $dropped_cell): self
    {
        $this->dropped_cell = $dropped_cell;

        return $this;
    }

    public function getIsJackpot(): ?bool
    {
        return $this->is_jackpot;
    }

    public function setIsJackpot(bool $is_jackpot): self
    {
        $this->is_jackpot = $is_jackpot;

        return $this;
    }
}
