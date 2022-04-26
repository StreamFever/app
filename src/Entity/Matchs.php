<?php

namespace App\Entity;

use App\Repository\MatchsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatchsRepository::class)
 */
class Matchs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Teams::class, inversedBy="teamIDAlpha", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $teamIDAlpha;

    /**
     * @ORM\OneToOne(targetEntity=Teams::class, inversedBy="teamIDBeta", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $teamIDBeta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchScoreTeamAlpha;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $matchScoreTeamBeta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matchTimeNext;

    /**
     * @ORM\OneToOne(targetEntity=Maps::class, cascade={"persist", "remove"})
     */
    private $matchIDMap;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matchFormat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matchStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamIDAlpha(): ?Teams
    {
        return $this->teamIDAlpha;
    }

    public function setTeamIDAlpha(Teams $teamIDAlpha): self
    {
        $this->teamIDAlpha = $teamIDAlpha;

        return $this;
    }

    public function getTeamIDBeta(): ?Teams
    {
        return $this->teamIDBeta;
    }

    public function setTeamIDBeta(Teams $teamIDBeta): self
    {
        $this->teamIDBeta = $teamIDBeta;

        return $this;
    }

    public function getMatchScoreTeamAlpha(): ?int
    {
        return $this->matchScoreTeamAlpha;
    }

    public function setMatchScoreTeamAlpha(?int $matchScoreTeamAlpha): self
    {
        $this->matchScoreTeamAlpha = $matchScoreTeamAlpha;

        return $this;
    }

    public function getMatchScoreTeamBeta(): ?int
    {
        return $this->matchScoreTeamBeta;
    }

    public function setMatchScoreTeamBeta(?int $matchScoreTeamBeta): self
    {
        $this->matchScoreTeamBeta = $matchScoreTeamBeta;

        return $this;
    }

    public function getMatchTimeNext(): ?string
    {
        return $this->matchTimeNext;
    }

    public function setMatchTimeNext(?string $matchTimeNext): self
    {
        $this->matchTimeNext = $matchTimeNext;

        return $this;
    }

    public function getMatchIDMap(): ?Maps
    {
        return $this->matchIDMap;
    }

    public function setMatchIDMap(?Maps $matchIDMap): self
    {
        $this->matchIDMap = $matchIDMap;

        return $this;
    }

    public function getMatchFormat(): ?string
    {
        return $this->matchFormat;
    }

    public function setMatchFormat(?string $matchFormat): self
    {
        $this->matchFormat = $matchFormat;

        return $this;
    }

    public function getMatchStatus(): ?string
    {
        return $this->matchStatus;
    }

    public function setMatchStatus(string $matchStatus): self
    {
        $this->matchStatus = $matchStatus;

        return $this;
    }
}
