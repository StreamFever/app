<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
     * @ORM\ManyToMany(targetEntity=Flag::class, inversedBy="players")
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
     * @ORM\Column(type="boolean")
     */
    private $playerStudentSa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $playerIdObsNinja;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $playerUplayTag;

    public function __construct()
    {
        $this->playerIdFlag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Flag>
     */
    public function getPlayerIdFlag(): Collection
    {
        return $this->playerIdFlag;
    }

    public function addPlayerIdFlag(Flag $playerIdFlag): self
    {
        if (!$this->playerIdFlag->contains($playerIdFlag)) {
            $this->playerIdFlag[] = $playerIdFlag;
        }

        return $this;
    }

    public function removePlayerIdFlag(Flag $playerIdFlag): self
    {
        $this->playerIdFlag->removeElement($playerIdFlag);

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

    public function setPlayerStudentSa(bool $playerStudentSa): self
    {
        $this->playerStudentSa = $playerStudentSa;

        return $this;
    }

    public function getPlayerIdObsNinja(): ?string
    {
        return $this->playerIdObsNinja;
    }

    public function setPlayerIdObsNinja(?string $playerIdObsNinja): self
    {
        $this->playerIdObsNinja = $playerIdObsNinja;

        return $this;
    }

    public function getPlayerUplayTag(): ?string
    {
        return $this->playerUplayTag;
    }

    public function setPlayerUplayTag(?string $playerUplayTag): self
    {
        $this->playerUplayTag = $playerUplayTag;

        return $this;
    }
}
