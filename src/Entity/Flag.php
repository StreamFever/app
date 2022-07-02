<?php

namespace App\Entity;

use App\Repository\FlagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlagRepository::class)
 */
class Flag
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
    private $flagCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $flagName;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="playerIdFlag")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="teamIdFlag")
     */
    private $teams;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlagCode(): ?string
    {
        return $this->flagCode;
    }

    public function setFlagCode(string $flagCode): self
    {
        $this->flagCode = $flagCode;

        return $this;
    }

    public function getFlagName(): ?string
    {
        return $this->flagName;
    }

    public function setFlagName(string $flagName): self
    {
        $this->flagName = $flagName;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setPlayerIdFlag($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getPlayerIdFlag() === $this) {
                $player->setPlayerIdFlag(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setTeamIdFlag($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getTeamIdFlag() === $this) {
                $team->setTeamIdFlag(null);
            }
        }

        return $this;
    }
}
