<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Flag::class, inversedBy="players")
     */
    private $playerIdFlag;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $playerName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $playerAvatar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $playerUplay;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $playerAtTwitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $playerDiscord;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $playerTwitch;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $playerStudentSa;

    /**
     * @ORM\ManyToMany(targetEntity=Team::class, mappedBy="players")
     */
    private $teams;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerIdFlag(): ?Flag
    {
        return $this->playerIdFlag;
    }

    public function setPlayerIdFlag(?Flag $playerIdFlag): self
    {
        $this->playerIdFlag = $playerIdFlag;

        return $this;
    }

    public function getPlayerName(): ?string
    {
        return $this->playerName;
    }

    public function setPlayerName(string $playerName): self
    {
        $this->playerName = $playerName;

        return $this;
    }

    public function getPlayerAvatar(): ?string
    {
        return $this->playerAvatar;
    }

    public function setPlayerAvatar(?string $playerAvatar): self
    {
        $this->playerAvatar = $playerAvatar;

        return $this;
    }

    public function getPlayerUplay(): ?string
    {
        return $this->playerUplay;
    }

    public function setPlayerUplay(?string $playerUplay): self
    {
        $this->playerUplay = $playerUplay;

        return $this;
    }

    public function getPlayerAtTwitter(): ?string
    {
        return $this->playerAtTwitter;
    }

    public function setPlayerAtTwitter(?string $playerAtTwitter): self
    {
        $this->playerAtTwitter = $playerAtTwitter;

        return $this;
    }

    public function getPlayerDiscord(): ?string
    {
        return $this->playerDiscord;
    }

    public function setPlayerDiscord(?string $playerDiscord): self
    {
        $this->playerDiscord = $playerDiscord;

        return $this;
    }

    public function getPlayerTwitch(): ?string
    {
        return $this->playerTwitch;
    }

    public function setPlayerTwitch(?string $playerTwitch): self
    {
        $this->playerTwitch = $playerTwitch;

        return $this;
    }

    public function getPlayerStudentSa(): ?bool
    {
        return $this->playerStudentSa;
    }

    public function setPlayerStudentSa(?bool $playerStudentSa): self
    {
        $this->playerStudentSa = $playerStudentSa;

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
            $team->addPlayer($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->removeElement($team)) {
            $team->removePlayer($this);
        }

        return $this;
    }
}
