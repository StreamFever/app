<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->gamesBeta = new ArrayCollection();
    }

    public function __toString()
    {
	return $this->teamName;
    }

    public function getId(): ?int
    {
        return $this->id;
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
}
