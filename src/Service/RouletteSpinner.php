<?php

namespace App\Service;

use App\Entity\Round;
use App\Entity\Spin;
use App\Entity\User;
use App\Exception\UserNotSetException;
use Doctrine\ORM\EntityManagerInterface;

class RouletteSpinner
{
    /**
     * @var User|null
     */
    protected $user = null;

    /**
     * @var Round|null
     */
    protected $round = null;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var Spin
     */
    protected $spin;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
        $this->spin = new Spin;
    }

    /**
     * Makes a roulette spin
     *
     * @return Round|null
     *
     * @throws UserNotSetException
     */
    public function spin()
    {
        if (null === $this->user) {
           throw new UserNotSetException();
        }

        $this->startRound();

        // Generating random cell to drop
        if ($this->round->hasAvailableCells()) {
            $this->spin->setDroppedCell($this->generateDroppedCell());
        } else {
            // It's a jackpot!
            $this->spin->setIsJackpot(true);
        }

        $this->persist();

        return $this->round;
    }

    /**
     * If User has an active round, starts it.
     * Otherwise, start new one
     */
    protected function startRound(): void
    {
        $this->round = $this->user->getActiveRound();

        // if user have no active rounds, create new one
        if (null === $this->round) {
            $this->startNewRound();
        }
    }
    /**
     * Starts new Round
     */
    protected function startNewRound(): void
    {
        $this->round = new Round;
        $this->round->setUser($this->user);
    }

    /**
     * @param User|null $user
     *
     * @return RouletteSpinner
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return int
     */
    protected function generateDroppedCell(): int
    {
        $availableCells = $this->round->getAvailableCells();
        return $availableCells[array_rand($availableCells)];
    }

    protected function persist(): void
    {
        // persist data
        $this->em->persist($this->spin);

        $this->round->addSpin($this->spin);

        $this->em->persist($this->round);

        $this->em->flush();
    }
}