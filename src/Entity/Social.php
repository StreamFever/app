<?php

namespace App\Entity;

use App\Repository\SocialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocialRepository::class)
 */
class Social
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
    private $socialName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $socialTag;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $socialLogo;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, mappedBy="eventIdSocial")
     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocialName(): ?string
    {
        return $this->socialName;
    }

    public function setSocialName(string $socialName): self
    {
        $this->socialName = $socialName;

        return $this;
    }

    public function getSocialTag(): ?string
    {
        return $this->socialTag;
    }

    public function setSocialTag(string $socialTag): self
    {
        $this->socialTag = $socialTag;

        return $this;
    }

    public function getSocialLogo(): ?string
    {
        return $this->socialLogo;
    }

    public function setSocialLogo(?string $socialLogo): self
    {
        $this->socialLogo = $socialLogo;

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
            $event->addEventIdSocial($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            $event->removeEventIdSocial($this);
        }

        return $this;
    }
}
