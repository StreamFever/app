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
     * @ORM\ManyToOne(targetEntity=Flag::class, inversedBy="teams")
     */
    private $teamIdFlag;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $teamName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $teamLogo;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="gameIdTeamAlpha")
     */
    private $games;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="gameIdTeamBeta")
     */
    private $gamesBeta;

    /**
     * @ORM\ManyToMany(targetEntity=Player::class, inversedBy="teams")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity=Map::class, mappedBy="mapPickBy")
     */
    private $mapsPicked;

    /**
     * @ORM\OneToMany(targetEntity=Map::class, mappedBy="mapBanBy")
     */
    private $mapsBanned;

    /**
     * @ORM\OneToMany(targetEntity=Map::class, mappedBy="mapWinner")
     */
    private $mapsWinned;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->gamesBeta = new ArrayCollection();
        $this->players = new ArrayCollection();
        $this->mapsPicked = new ArrayCollection();
        $this->mapsBanned = new ArrayCollection();
        $this->mapsWinned = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->teamName;
    }

    public function getTeamIdFlag(): ?Flag
    {
        return $this->teamIdFlag;
    }

    public function setTeamIdFlag(?Flag $teamIdFlag): self
    {
        $this->teamIdFlag = $teamIdFlag;

        return $this;
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

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setGameIdTeamAlpha($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getGameIdTeamAlpha() === $this) {
                $game->setGameIdTeamAlpha(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGamesBeta(): Collection
    {
        return $this->gamesBeta;
    }

    public function addGamesBetum(Game $gamesBetum): self
    {
        if (!$this->gamesBeta->contains($gamesBetum)) {
            $this->gamesBeta[] = $gamesBetum;
            $gamesBetum->setGameIdTeamBeta($this);
        }

        return $this;
    }

    public function removeGamesBetum(Game $gamesBetum): self
    {
        if ($this->gamesBeta->removeElement($gamesBetum)) {
            // set the owning side to null (unless already changed)
            if ($gamesBetum->getGameIdTeamBeta() === $this) {
                $gamesBetum->setGameIdTeamBeta(null);
            }
        }

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
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        $this->players->removeElement($player);

        return $this;
    }

    /**
     * @return Collection<int, Map>
     */
    public function getMapsPicked(): Collection
    {
        return $this->mapsPicked;
    }

    public function addMapsPicked(Map $mapsPicked): self
    {
        if (!$this->mapsPicked->contains($mapsPicked)) {
            $this->mapsPicked[] = $mapsPicked;
            $mapsPicked->setMapPickBy($this);
        }

        return $this;
    }

    public function removeMapsPicked(Map $mapsPicked): self
    {
        if ($this->mapsPicked->removeElement($mapsPicked)) {
            // set the owning side to null (unless already changed)
            if ($mapsPicked->getMapPickBy() === $this) {
                $mapsPicked->setMapPickBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Map>
     */
    public function getMapsBanned(): Collection
    {
        return $this->mapsBanned;
    }

    public function addMapsBanned(Map $mapsBanned): self
    {
        if (!$this->mapsBanned->contains($mapsBanned)) {
            $this->mapsBanned[] = $mapsBanned;
            $mapsBanned->setMapBanBy($this);
        }

        return $this;
    }

    public function removeMapsBanned(Map $mapsBanned): self
    {
        if ($this->mapsBanned->removeElement($mapsBanned)) {
            // set the owning side to null (unless already changed)
            if ($mapsBanned->getMapBanBy() === $this) {
                $mapsBanned->setMapBanBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Map>
     */
    public function getMapsWinned(): Collection
    {
        return $this->mapsWinned;
    }

    public function addMapsWinned(Map $mapsWinned): self
    {
        if (!$this->mapsWinned->contains($mapsWinned)) {
            $this->mapsWinned[] = $mapsWinned;
            $mapsWinned->setMapWinner($this);
        }

        return $this;
    }

    public function removeMapsWinned(Map $mapsWinned): self
    {
        if ($this->mapsWinned->removeElement($mapsWinned)) {
            // set the owning side to null (unless already changed)
            if ($mapsWinned->getMapWinner() === $this) {
                $mapsWinned->setMapWinner(null);
            }
        }

        return $this;
    }
}
