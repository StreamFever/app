<?php

namespace App\Entity;

use App\Repository\TeamsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamsRepository::class)
 */
class Teams
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $teamName;

    /**
     * @ORM\OneToOne(targetEntity=Flags::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $teamIDFlag;

    /**
     * @ORM\ManyToOne(targetEntity=Players::class, inversedBy="playerIDTeam")
     */
    private $playerIDTeams;

    /**
     * @ORM\OneToOne(targetEntity=Matchs::class, mappedBy="teamIDAlpha", cascade={"persist", "remove"})
     */
    private $teamIDAlpha;

    /**
     * @ORM\OneToOne(targetEntity=Matchs::class, mappedBy="teamIDBeta", cascade={"persist", "remove"})
     */
    private $teamIDBeta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamName(): ?string
    {
        return $this->teamName;
    }

    public function setTeamName(string $teamName): self
    {
        $this->teamName = $teamName;

        return $this;
    }

    public function getTeamIDFlag(): ?Flags
    {
        return $this->teamIDFlag;
    }

    public function setTeamIDFlag(Flags $teamIDFlag): self
    {
        $this->teamIDFlag = $teamIDFlag;

        return $this;
    }

    public function getPlayerIDTeams(): ?Players
    {
        return $this->playerIDTeams;
    }

    public function setPlayerIDTeams(?Players $playerIDTeams): self
    {
        $this->playerIDTeams = $playerIDTeams;

        return $this;
    }

    public function getTeamIDAlpha(): ?Matchs
    {
        return $this->teamIDAlpha;
    }

    public function setTeamIDAlpha(Matchs $teamIDAlpha): self
    {
        // set the owning side of the relation if necessary
        if ($teamIDAlpha->getTeamIDAlpha() !== $this) {
            $teamIDAlpha->setTeamIDAlpha($this);
        }

        $this->teamIDAlpha = $teamIDAlpha;

        return $this;
    }

    public function getTeamIDBeta(): ?Matchs
    {
        return $this->teamIDBeta;
    }

    public function setTeamIDBeta(Matchs $teamIDBeta): self
    {
        // set the owning side of the relation if necessary
        if ($teamIDBeta->getTeamIDBeta() !== $this) {
            $teamIDBeta->setTeamIDBeta($this);
        }

        $this->teamIDBeta = $teamIDBeta;

        return $this;
    }
}
