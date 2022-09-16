<?php

namespace App\Entity;

use App\Repository\EventFormatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventFormatRepository::class)
 */
class EventFormat
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
    private $eventFormatName;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="eventFormat")
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

    public function __toString()
    {
        return $this->eventFormatName;
    }

    public function getEventFormatName(): ?string
    {
        return $this->eventFormatName;
    }

    public function setEventFormatName(string $eventFormatName): self
    {
        $this->eventFormatName = $eventFormatName;

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
            $event->setEventFormat($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getEventFormat() === $this) {
                $event->setEventFormat(null);
            }
        }

        return $this;
    }

}
