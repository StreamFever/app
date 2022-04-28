<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Team::class, inversedBy="gameTeamAlpha", cascade={"persist", "remove"})
     */
    private $gameIDTeamAlpha;

    /**
     * @ORM\OneToOne(targetEntity=Team::class, inversedBy="gameTeamBeta", cascade={"persist", "remove"})
     */
    private $gameIDTeamBeta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gameScoreAlpha;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gameScoreBeta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gameTimeNext;

    /**
     * @ORM\ManyToMany(targetEntity=Map::class, inversedBy="games")
     */
    private $gameIDMaps;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gameFormat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gameStatus;

    public function __construct()
    {
        $this->gameIDMaps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameIDTeamAlpha(): ?Team
    {
        return $this->gameIDTeamAlpha;
    }

    public function setGameIDTeamAlpha(?Team $gameIDTeamAlpha): self
    {
        $this->gameIDTeamAlpha = $gameIDTeamAlpha;

        return $this;
    }

    public function getGameIDTeamBeta(): ?Team
    {
        return $this->gameIDTeamBeta;
    }

    public function setGameIDTeamBeta(?Team $gameIDTeamBeta): self
    {
        $this->gameIDTeamBeta = $gameIDTeamBeta;

        return $this;
    }

    public function getGameScoreAlpha(): ?int
    {
        return $this->gameScoreAlpha;
    }

    public function setGameScoreAlpha(?int $gameScoreAlpha): self
    {
        $this->gameScoreAlpha = $gameScoreAlpha;

        return $this;
    }

    public function getGameScoreBeta(): ?int
    {
        return $this->gameScoreBeta;
    }

    public function setGameScoreBeta(?int $gameScoreBeta): self
    {
        $this->gameScoreBeta = $gameScoreBeta;

        return $this;
    }

    public function getGameTimeNext(): ?string
    {
        return $this->gameTimeNext;
    }

    public function setGameTimeNext(?string $gameTimeNext): self
    {
        $this->gameTimeNext = $gameTimeNext;

        return $this;
    }

    /**
     * @return Collection<int, Map>
     */
    public function getGameIDMaps(): Collection
    {
        return $this->gameIDMaps;
    }

    public function addGameIDMap(Map $gameIDMap): self
    {
        if (!$this->gameIDMaps->contains($gameIDMap)) {
            $this->gameIDMaps[] = $gameIDMap;
        }

        return $this;
    }

    public function removeGameIDMap(Map $gameIDMap): self
    {
        $this->gameIDMaps->removeElement($gameIDMap);

        return $this;
    }

    public function getGameFormat(): ?string
    {
        return $this->gameFormat;
    }

    public function setGameFormat(?string $gameFormat): self
    {
        $this->gameFormat = $gameFormat;

        return $this;
    }

    public function getGameStatus(): ?string
    {
        return $this->gameStatus;
    }

    public function setGameStatus(?string $gameStatus): self
    {
        $this->gameStatus = $gameStatus;

        return $this;
    }
}
