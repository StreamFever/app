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
     * @ORM\ManyToMany(targetEntity=Sponsor::class, inversedBy="events")
     */
    private $eventIDSponsor;

    public function __construct()
    {
        $this->eventIDSponsor = new ArrayCollection();
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
     * @return Collection<int, Sponsor>
     */
    public function getEventIDSponsor(): Collection
    {
        return $this->eventIDSponsor;
    }

    public function addEventIDSponsor(Sponsor $eventIDSponsor): self
    {
        if (!$this->eventIDSponsor->contains($eventIDSponsor)) {
            $this->eventIDSponsor[] = $eventIDSponsor;
        }

        return $this;
    }

    public function removeEventIDSponsor(Sponsor $eventIDSponsor): self
    {
        $this->eventIDSponsor->removeElement($eventIDSponsor);

        return $this;
    }
}
