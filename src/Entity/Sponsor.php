<?php

namespace App\Entity;

use App\Repository\SponsorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SponsorRepository::class)
 */
class Sponsor
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
    private $sponsorName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sponsorLogo;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, mappedBy="eventIdSponsor")
     */
    private $events;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sponsorBanner;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSponsorName(): ?string
    {
        return $this->sponsorName;
    }

    public function setSponsorName(string $sponsorName): self
    {
        $this->sponsorName = $sponsorName;

        return $this;
    }

    public function getSponsorLogo(): ?string
    {
        return $this->sponsorLogo;
    }

    public function setSponsorLogo(?string $sponsorLogo): self
    {
        $this->sponsorLogo = $sponsorLogo;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addEventIdSponsor($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            $event->removeEventIdSponsor($this);
        }

        return $this;
    }

    public function getSponsorBanner(): ?string
    {
        return $this->sponsorBanner;
    }

    public function setSponsorBanner(?string $sponsorBanner): self
    {
        $this->sponsorBanner = $sponsorBanner;

        return $this;
    }
}
