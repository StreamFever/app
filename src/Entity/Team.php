<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $teamLogo;

    /**
     * @ORM\ManyToOne(targetEntity=Flag::class, inversedBy="teams")
     */
    private $teamIDFlag;

    /**
     * @ORM\ManyToMany(targetEntity=Player::class, mappedBy="playerIDTeam")
     */
    private $players;

    /**
     * @ORM\OneToOne(targetEntity=Game::class, mappedBy="gameIDTeamAlpha", cascade={"persist", "remove"})
     */
    private $gameTeamAlpha;

    /**
     * @ORM\OneToOne(targetEntity=Game::class, mappedBy="gameIDTeamBeta", cascade={"persist", "remove"})
     */
    private $gameTeamBeta;


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

    public function getTeamLogo(): ?string
    {
        return $this->teamLogo;
    }

    public function setTeamLogo(?string $teamLogo): self
    {
        $this->teamLogo = $teamLogo;

        return $this;
    }

    public function getTeamIDFlag(): ?Flag
    {
        return $this->teamIDFlag;
    }

    public function setTeamIDFlag(?Flag $teamIDFlag): self
    {
        $this->teamIDFlag = $teamIDFlag;

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
            $player->addPlayerIDTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            $player->removePlayerIDTeam($this);
        }

        return $this;
    }

    public function getGameTeamAlpha(): ?Game
    {
        return $this->gameTeamAlpha;
    }

    public function setGameTeamAlpha(?Game $gameTeamAlpha): self
    {
        // unset the owning side of the relation if necessary
        if ($gameTeamAlpha === null && $this->gameTeamAlpha !== null) {
            $this->gameTeamAlpha->setGameIDTeamAlpha(null);
        }

        // set the owning side of the relation if necessary
        if ($gameTeamAlpha !== null && $gameTeamAlpha->getGameIDTeamAlpha() !== $this) {
            $gameTeamAlpha->setGameIDTeamAlpha($this);
        }

        $this->gameTeamAlpha = $gameTeamAlpha;

        return $this;
    }

    public function getGameTeamBeta(): ?Game
    {
        return $this->gameTeamBeta;
    }

    public function setGameTeamBeta(?Game $gameTeamBeta): self
    {
        // unset the owning side of the relation if necessary
        if ($gameTeamBeta === null && $this->gameTeamBeta !== null) {
            $this->gameTeamBeta->setGameIDTeamBeta(null);
        }

        // set the owning side of the relation if necessary
        if ($gameTeamBeta !== null && $gameTeamBeta->getGameIDTeamBeta() !== $this) {
            $gameTeamBeta->setGameIDTeamBeta($this);
        }

        $this->gameTeamBeta = $gameTeamBeta;

        return $this;
    }

}
