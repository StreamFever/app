<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"game:read"}},
 *     denormalizationContext={"groups"={"game:write"}}
 * )
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"game:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"game:read"})
     */
    private $gameIdTeamAlpha;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="gamesBeta")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"game:read"})
     */
    private $gameIdTeamBeta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $gameStartDate;

    /**
     * @ORM\ManyToOne(targetEntity=Format::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gameFormat;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"game:read"})
     */
    private $gameStatus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"game:read"})
     */
    private $gameScoreTeamAlpha;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"game:read"})
     */
    private $gameScoreTeamBeta;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity=Overlay::class, inversedBy="games")
     */
    private $overlayId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"game:read"})
     */
    private $gameName;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="currentGame")
     */
    private $currentEvent;

    /**
     * @ORM\ManyToMany(targetEntity=Map::class)
     * @Groups({"game:read"})
     */
    private $gameIdMaps;

    /**
     * @ORM\ManyToOne(targetEntity=Map::class)
     * @Groups({"game:read"})
     */
    private $currentMap;

    public function __construct()
    {
        $this->currentEvent = new ArrayCollection();
        $this->gameIdMaps = new ArrayCollection();
    }

    public function __toString()
    {
        if (is_null($this->gameName)) {
            return 'NULL';
        }
        return $this->gameName;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameIdTeamAlpha(): ?Team
    {
        return $this->gameIdTeamAlpha;
    }

    public function setGameIdTeamAlpha(?Team $gameIdTeamAlpha): self
    {
        $this->gameIdTeamAlpha = $gameIdTeamAlpha;

        return $this;
    }

    public function getGameIdTeamBeta(): ?Team
    {
        return $this->gameIdTeamBeta;
    }

    public function setGameIdTeamBeta(?Team $gameIdTeamBeta): self
    {
        $this->gameIdTeamBeta = $gameIdTeamBeta;

        return $this;
    }

    public function getGameStartDate(): ?\DateTimeInterface
    {
        return $this->gameStartDate;
    }

    public function setGameStartDate(?\DateTimeInterface $gameStartDate): self
    {
        $this->gameStartDate = $gameStartDate;

        return $this;
    }

    public function getGameFormat(): ?Format
    {
        return $this->gameFormat;
    }

    public function setGameFormat(?Format $gameFormat): self
    {
        $this->gameFormat = $gameFormat;

        return $this;
    }

    public function getGameStatus(): ?Status
    {
        return $this->gameStatus;
    }

    public function setGameStatus(?Status $gameStatus): self
    {
        $this->gameStatus = $gameStatus;

        return $this;
    }

    public function getGameScoreTeamAlpha(): ?int
    {
        return $this->gameScoreTeamAlpha;
    }

    public function setGameScoreTeamAlpha(?int $gameScoreTeamAlpha): self
    {
        $this->gameScoreTeamAlpha = $gameScoreTeamAlpha;

        return $this;
    }

    public function getGameScoreTeamBeta(): ?int
    {
        return $this->gameScoreTeamBeta;
    }

    public function setGameScoreTeamBeta(?int $gameScoreTeamBeta): self
    {
        $this->gameScoreTeamBeta = $gameScoreTeamBeta;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getOverlayId(): ?Overlay
    {
        return $this->overlayId;
    }

    public function setOverlayId(?Overlay $overlayId): self
    {
        $this->overlayId = $overlayId;

        return $this;
    }

    public function getGameName(): ?string
    {
        return $this->gameName;
    }

    public function setGameName(?string $gameName): self
    {
        $this->gameName = $gameName;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getCurrentEvent(): Collection
    {
        return $this->currentEvent;
    }

    public function addCurrentEvent(Event $currentEvent): self
    {
        if (!$this->currentEvent->contains($currentEvent)) {
            $this->currentEvent[] = $currentEvent;
            $currentEvent->setCurrentGame($this);
        }

        return $this;
    }

    public function removeCurrentEvent(Event $currentEvent): self
    {
        if ($this->currentEvent->removeElement($currentEvent)) {
            // set the owning side to null (unless already changed)
            if ($currentEvent->getCurrentGame() === $this) {
                $currentEvent->setCurrentGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Map>
     */
    public function getGameIdMaps(): Collection
    {
        return $this->gameIdMaps;
    }

    public function addGameIdMap(Map $gameIdMap): self
    {
        if (!$this->gameIdMaps->contains($gameIdMap)) {
            $this->gameIdMaps[] = $gameIdMap;
        }

        return $this;
    }

    public function removeGameIdMap(Map $gameIdMap): self
    {
        $this->gameIdMaps->removeElement($gameIdMap);

        return $this;
    }

    public function getCurrentMap(): ?Map
    {
        return $this->currentMap;
    }

    public function setCurrentMap(?Map $currentMap): self
    {
        $this->currentMap = $currentMap;

        return $this;
    }
}
