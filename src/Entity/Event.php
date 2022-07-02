<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(type="text", nullable=true)
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
     * @ORM\ManyToMany(targetEntity=Social::class, inversedBy="events")
     */
    private $eventIdSocial;

    public function __construct()
    {
        $this->eventIdSponsor = new ArrayCollection();
        $this->eventIdSocial = new ArrayCollection();
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

    public function setEventLogo(?string $eventLogo): self
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

    /**
     * @return Collection<int, Social>
     */
    public function getEventIdSocial(): Collection
    {
        return $this->eventIdSocial;
    }

    public function addEventIdSocial(Social $eventIdSocial): self
    {
        if (!$this->eventIdSocial->contains($eventIdSocial)) {
            $this->eventIdSocial[] = $eventIdSocial;
        }

        return $this;
    }

    public function removeEventIdSocial(Social $eventIdSocial): self
    {
        $this->eventIdSocial->removeElement($eventIdSocial);

        return $this;
    }
}
