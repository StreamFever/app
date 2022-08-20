<?php

namespace App\Entity;

use App\Repository\MapRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MapRepository::class)
 */
class Map
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
    private $mapName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mapImg;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, mappedBy="gameIdMaps")
     */
    private $games;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="currentMap")
     */
    private $gameCurrent;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->gameCurrent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->mapName;
    }

    public function getMapName(): ?string
    {
        return $this->mapName;
    }

    public function setMapName(string $mapName): self
    {
        $this->mapName = $mapName;

        return $this;
    }

    public function getMapImg(): ?string
    {
        return $this->mapImg;
    }

    public function setMapImg(?string $mapImg): self
    {
        $this->mapImg = $mapImg;

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
            $game->addGameIdMap($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            $game->removeGameIdMap($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGameCurrent(): Collection
    {
        return $this->gameCurrent;
    }

    public function addGameCurrent(Game $gameCurrent): self
    {
        if (!$this->gameCurrent->contains($gameCurrent)) {
            $this->gameCurrent[] = $gameCurrent;
            $gameCurrent->setCurrentMap($this);
        }

        return $this;
    }

    public function removeGameCurrent(Game $gameCurrent): self
    {
        if ($this->gameCurrent->removeElement($gameCurrent)) {
            // set the owning side to null (unless already changed)
            if ($gameCurrent->getCurrentMap() === $this) {
                $gameCurrent->setCurrentMap(null);
            }
        }

        return $this;
    }
}
