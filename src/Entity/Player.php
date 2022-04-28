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
     * @ORM\ManyToMany(targetEntity=Team::class, inversedBy="players")
     */
    private $playerIDTeam;

    /**
     * @ORM\ManyToOne(targetEntity=Flag::class, inversedBy="players")
     */
    private $playerIDFlag;

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
     * @ORM\Column(type="boolean")
     */
    private $playerStudentSA;

    public function __construct()
    {
        $this->playerIDTeam = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getPlayerIDTeam(): Collection
    {
        return $this->playerIDTeam;
    }

    public function addPlayerIDTeam(Team $playerIDTeam): self
    {
        if (!$this->playerIDTeam->contains($playerIDTeam)) {
            $this->playerIDTeam[] = $playerIDTeam;
        }

        return $this;
    }

    public function removePlayerIDTeam(Team $playerIDTeam): self
    {
        $this->playerIDTeam->removeElement($playerIDTeam);

        return $this;
    }

    public function getPlayerIDFlag(): ?Flag
    {
        return $this->playerIDFlag;
    }

    public function setPlayerIDFlag(?Flag $playerIDFlag): self
    {
        $this->playerIDFlag = $playerIDFlag;

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

    public function getPlayerStudentSA(): ?bool
    {
        return $this->playerStudentSA;
    }

    public function setPlayerStudentSA(bool $playerStudentSA): self
    {
        $this->playerStudentSA = $playerStudentSA;

        return $this;
    }
}
