<?php

namespace App\Entity;

use App\Repository\EventsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventsRepository::class)
 */
class Events
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
     * @ORM\Column(type="string", length=255)
     */
    private $eventEdition;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $eventLogo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eventHashtag;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eventCashprize;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $eventCurrentPhase;

    /**
     * @ORM\ManyToMany(targetEntity=Sponsors::class)
     */
    private $eventIdSponsor;

    public function __construct()
    {
        $this->eventIdSponsor = new ArrayCollection();
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

    public function getEventEdition(): ?string
    {
        return $this->eventEdition;
    }

    public function setEventEdition(string $eventEdition): self
    {
        $this->eventEdition = $eventEdition;

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

    public function getEventHashtag(): ?string
    {
        return $this->eventHashtag;
    }

    public function setEventHashtag(?string $eventHashtag): self
    {
        $this->eventHashtag = $eventHashtag;

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

    public function getEventCurrentPhase(): ?string
    {
        return $this->eventCurrentPhase;
    }

    public function setEventCurrentPhase(?string $eventCurrentPhase): self
    {
        $this->eventCurrentPhase = $eventCurrentPhase;

        return $this;
    }

    /**
     * @return Collection<int, Sponsors>
     */
    public function getEventIdSponsor(): Collection
    {
        return $this->eventIdSponsor;
    }

    public function addEventIdSponsor(Sponsors $eventIdSponsor): self
    {
        if (!$this->eventIdSponsor->contains($eventIdSponsor)) {
            $this->eventIdSponsor[] = $eventIdSponsor;
        }

        return $this;
    }

    public function removeEventIdSponsor(Sponsors $eventIdSponsor): self
    {
        $this->eventIdSponsor->removeElement($eventIdSponsor);

        return $this;
    }
}
