<?php

namespace App\Entity;

use App\Repository\TeamsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToMany(targetEntity=Players::class, mappedBy="playerTeamID")
     */
    private $players;

    /**
     * @ORM\OneToOne(targetEntity=Matchs::class, mappedBy="matchIDTeamAlpha", cascade={"persist", "remove"})
     */
    private $matchs;

    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Players>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Players $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->addPlayerTeamID($this);
        }

        return $this;
    }

    public function removePlayer(Players $player): self
    {
        if ($this->players->removeElement($player)) {
            $player->removePlayerTeamID($this);
        }

        return $this;
    }

    public function getMatchs(): ?Matchs
    {
        return $this->matchs;
    }

    public function setMatchs(Matchs $matchs): self
    {
        // set the owning side of the relation if necessary
        if ($matchs->getMatchIDTeamAlpha() !== $this) {
            $matchs->setMatchIDTeamAlpha($this);
        }

        $this->matchs = $matchs;

        return $this;
    }
}
