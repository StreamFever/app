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
     * @ORM\ManyToMany(targetEntity=Teams::class, inversedBy="players")
     */
    private $playerTeamID;

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
    private $playerIsStudentSA;

    public function __construct()
    {
        $this->playerTeamID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Teams>
     */
    public function getPlayerTeamID(): Collection
    {
        return $this->playerTeamID;
    }

    public function addPlayerTeamID(Teams $playerTeamID): self
    {
        if (!$this->playerTeamID->contains($playerTeamID)) {
            $this->playerTeamID[] = $playerTeamID;
        }

        return $this;
    }

    public function removePlayerTeamID(Teams $playerTeamID): self
    {
        $this->playerTeamID->removeElement($playerTeamID);

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

    public function getPlayerIsStudentSA(): ?bool
    {
        return $this->playerIsStudentSA;
    }

    public function setPlayerIsStudentSA(bool $playerIsStudentSA): self
    {
        $this->playerIsStudentSA = $playerIsStudentSA;

        return $this;
    }
}
