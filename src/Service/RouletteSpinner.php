<?php

namespace App\Service;

use App\Entity\RouletteCell;
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
    /**
     * @var RandomDistribution
     */
    private $randomDistribution;

    /**
     * RouletteSpinner constructor.
     *
     * @param EntityManagerInterface $em
     * @param RandomDistribution $randomDistribution
     */
    public function __construct(EntityManagerInterface $em, RandomDistribution $randomDistribution){
        $this->em = $em;
        $this->spin = new Spin;
        $this->randomDistribution = $randomDistribution;
    }

    /**
     * Makes a roulette spin
     *
     * @return Round|null
     *
     * @throws UserNotSetException
     */
    public function spin(): ?Round
    {
        if (null === $this->user) {
           throw new UserNotSetException();
        }

        $this->startRound();

        if ($this->getAvailableCells()) {
            $this->spin->setDroppedCell($this->generateDroppedCell());
        } else {
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
     *
     * @return object|null
     */
    protected function generateDroppedCell(): ?RouletteCell
    {
        $availableCells = $this->getAvailableCells();
        $weights = $this->em->getRepository(RouletteCell::class)->getWeightsMap();
        $cellId = $this->randomDistribution->getRandomElementOfArray(array_column($availableCells, "id"), $weights);

        return $this->em->getRepository(RouletteCell::class)->find($cellId);
    }

    /**
     * @return array
     */
    protected function getAvailableCells()
    {
        return $this->em->getRepository(RouletteCell::class)->getAvailableForRound($this->round);
    }

    /**
     * Persist spin data to DB
     */
    protected function persist(): void
    {
        $this->em->persist($this->spin);

        $this->round->addSpin($this->spin);

        $this->em->persist($this->round);

        $this->em->flush();
    }
}