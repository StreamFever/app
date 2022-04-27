<?php

namespace App\Entity;

use App\Repository\MatchsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToOne(targetEntity=Teams::class, inversedBy="matchs", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $matchIDTeamAlpha;

    /**
     * @ORM\OneToOne(targetEntity=Teams::class, inversedBy="matchs", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $matchIDTeamBeta;

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
     * @ORM\ManyToMany(targetEntity=Maps::class, inversedBy="matchs")
     */
    private $matchIDMaps;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matchFormat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matchStatus;

    public function __construct()
    {
        $this->matchIDMaps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatchIDTeamAlpha(): ?Teams
    {
        return $this->matchIDTeamAlpha;
    }

    public function setMatchIDTeamAlpha(Teams $matchIDTeamAlpha): self
    {
        $this->matchIDTeamAlpha = $matchIDTeamAlpha;

        return $this;
    }

    public function getMatchIDTeamBeta(): ?Teams
    {
        return $this->matchIDTeamBeta;
    }

    public function setMatchIDTeamBeta(Teams $matchIDTeamBeta): self
    {
        $this->matchIDTeamBeta = $matchIDTeamBeta;

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

    /**
     * @return Collection<int, Maps>
     */
    public function getMatchIDMaps(): Collection
    {
        return $this->matchIDMaps;
    }

    public function addMatchIDMap(Maps $matchIDMap): self
    {
        if (!$this->matchIDMaps->contains($matchIDMap)) {
            $this->matchIDMaps[] = $matchIDMap;
        }

        return $this;
    }

    public function removeMatchIDMap(Maps $matchIDMap): self
    {
        $this->matchIDMaps->removeElement($matchIDMap);

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
