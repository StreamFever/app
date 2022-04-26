<?php

namespace App\Entity;

use App\Repository\PlayersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayersRepository::class)
 */
class Players
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Teams::class, mappedBy="playerIDTeams")
     */
    private $playerIDTeam;

    /**
     * @ORM\OneToOne(targetEntity=Flags::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $playerIDFlag;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $playerName;

    /**
     * @ORM\Column(type="text")
     */
    private $playerAvatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $playerUplay;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $playerAtTwitter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $playerDiscord;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $playerTwitch;

    /**
     * @ORM\Column(type="boolean")
     */
    private $playerEtudiantSA;

    public function __construct()
    {
        $this->playerIDTeam = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Teams>
     */
    public function getPlayerIDTeam(): Collection
    {
        return $this->playerIDTeam;
    }

    public function addPlayerIDTeam(Teams $playerIDTeam): self
    {
        if (!$this->playerIDTeam->contains($playerIDTeam)) {
            $this->playerIDTeam[] = $playerIDTeam;
            $playerIDTeam->setPlayerIDTeams($this);
        }

        return $this;
    }

    public function removePlayerIDTeam(Teams $playerIDTeam): self
    {
        if ($this->playerIDTeam->removeElement($playerIDTeam)) {
            // set the owning side to null (unless already changed)
            if ($playerIDTeam->getPlayerIDTeams() === $this) {
                $playerIDTeam->setPlayerIDTeams(null);
            }
        }

        return $this;
    }

    public function getPlayerIDFlag(): ?Flags
    {
        return $this->playerIDFlag;
    }

    public function setPlayerIDFlag(Flags $playerIDFlag): self
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

    public function setPlayerAvatar(string $playerAvatar): self
    {
        $this->playerAvatar = $playerAvatar;

        return $this;
    }

    public function getPlayerUplay(): ?string
    {
        return $this->playerUplay;
    }

    public function setPlayerUplay(string $playerUplay): self
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

    public function setPlayerDiscord(string $playerDiscord): self
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

    public function getPlayerEtudiantSA(): ?bool
    {
        return $this->playerEtudiantSA;
    }

    public function setPlayerEtudiantSA(bool $playerEtudiantSA): self
    {
        $this->playerEtudiantSA = $playerEtudiantSA;

        return $this;
    }
}
