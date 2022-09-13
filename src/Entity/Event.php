<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
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
    private $eventName;

    /**
     * @ORM\ManyToOne(targetEntity=Edition::class, inversedBy="events")
     */
    private $eventEdition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eventHashtag;

    /**
     * @ORM\Column(type="text")
     */
    private $eventLogo;

    /**
     * @ORM\Column(type="integer")
     */
    private $eventSlots;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eventCashprize;

    /**
     * @ORM\Column(type="datetime")
     */
    private $eventStartDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $eventEndDate;

    /**
     * @ORM\ManyToMany(targetEntity=Sponsor::class, inversedBy="events")
     */
    private $eventIdSponsor;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity=EventFormat::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eventFormat;

    /**
     * @ORM\ManyToOne(targetEntity=Overlay::class, inversedBy="events")
     */
    private $overlayId;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="eventsAccess")
     */
    private $eventAccess;

    /**
     * @ORM\ManyToMany(targetEntity=Social::class, inversedBy="events")
     */
    private $socials;

    /**
     * @ORM\OneToMany(targetEntity=Overlay::class, mappedBy="currentEvent")
     */
    private $currentOverlay;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="currentEvent")
     */
    private $currentGame;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class)
     */
    private $nextGame;

    public function __construct()
    {
        $this->eventIdSponsor = new ArrayCollection();
        $this->eventAccess = new ArrayCollection();
        $this->socials = new ArrayCollection();
        $this->currentOverlay = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->eventName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(string $eventName): self
    {
        $this->eventName = $eventName;

        return $this;
    }

    public function getEventEdition(): ?Edition
    {
        return $this->eventEdition;
    }

    public function setEventEdition(?Edition $eventEdition): self
    {
        $this->eventEdition = $eventEdition;

        return $this;
    }

    public function getEventHashtag(): ?string
    {
        return $this->eventHashtag;
    }

    public function setEventHashtag(?string $eventHashtag): self
    {
        $this->eventHashtag = $eventHashtag;

        return $this;
    }

    public function getEventLogo(): ?string
    {
        return $this->eventLogo;
    }

    public function setEventLogo(string $eventLogo): self
    {
        $this->eventLogo = $eventLogo;

        return $this;
    }

    public function getEventSlots(): ?int
    {
        return $this->eventSlots;
    }

    public function setEventSlots(int $eventSlots): self
    {
        $this->eventSlots = $eventSlots;

        return $this;
    }

    public function getEventCashprize(): ?string
    {
        return $this->eventCashprize;
    }

    public function setEventCashprize(?string $eventCashprize): self
    {
        $this->eventCashprize = $eventCashprize;

        return $this;
    }

    public function getEventStartDate(): ?\DateTimeInterface
    {
        return $this->eventStartDate;
    }

    public function setEventStartDate(\DateTimeInterface $eventStartDate): self
    {
        $this->eventStartDate = $eventStartDate;

        return $this;
    }

    public function getEventEndDate(): ?\DateTimeInterface
    {
        return $this->eventEndDate;
    }

    public function setEventEndDate(\DateTimeInterface $eventEndDate): self
    {
        $this->eventEndDate = $eventEndDate;

        return $this;
    }

    /**
     * @return Collection<int, Sponsor>
     */
    public function getEventIdSponsor(): Collection
    {
        return $this->eventIdSponsor;
    }

    public function addEventIdSponsor(Sponsor $eventIdSponsor): self
    {
        if (!$this->eventIdSponsor->contains($eventIdSponsor)) {
            $this->eventIdSponsor[] = $eventIdSponsor;
        }

        return $this;
    }

    public function removeEventIdSponsor(Sponsor $eventIdSponsor): self
    {
        $this->eventIdSponsor->removeElement($eventIdSponsor);

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

    public function getEventFormat(): ?EventFormat
    {
        return $this->eventFormat;
    }

    public function setEventFormat(?EventFormat $eventFormat): self
    {
        $this->eventFormat = $eventFormat;

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

    /**
     * @return Collection<int, User>
     */
    public function getEventAccess(): Collection
    {
        return $this->eventAccess;
    }

    public function addEventAccess(User $eventAccess): self
    {
        if (!$this->eventAccess->contains($eventAccess)) {
            $this->eventAccess[] = $eventAccess;
        }

        return $this;
    }

    public function removeEventAccess(User $eventAccess): self
    {
        $this->eventAccess->removeElement($eventAccess);

        return $this;
    }

    /**
     * @return Collection<int, Social>
     */
    public function getSocials(): Collection
    {
        return $this->socials;
    }

    public function addSocial(Social $social): self
    {
        if (!$this->socials->contains($social)) {
            $this->socials[] = $social;
        }

        return $this;
    }

    public function removeSocial(Social $social): self
    {
        $this->socials->removeElement($social);

        return $this;
    }

    /**
     * @return Collection<int, Overlay>
     */
    public function getCurrentOverlay(): Collection
    {
        return $this->currentOverlay;
    }

    public function addCurrentOverlay(Overlay $currentOverlay): self
    {
        if (!$this->currentOverlay->contains($currentOverlay)) {
            $this->currentOverlay[] = $currentOverlay;
            $currentOverlay->setCurrentEvent($this);
        }

        return $this;
    }

    public function removeCurrentOverlay(Overlay $currentOverlay): self
    {
        if ($this->currentOverlay->removeElement($currentOverlay)) {
            // set the owning side to null (unless already changed)
            if ($currentOverlay->getCurrentEvent() === $this) {
                $currentOverlay->setCurrentEvent(null);
            }
        }

        return $this;
    }

    public function getCurrentGame(): ?Game
    {
        return $this->currentGame;
    }

    public function setCurrentGame(?Game $currentGame): self
    {
        $this->currentGame = $currentGame;

        return $this;
    }

    public function getNextGame(): ?Game
    {
        return $this->nextGame;
    }

    public function setNextGame(?Game $nextGame): self
    {
        $this->nextGame = $nextGame;

        return $this;
    }
}
