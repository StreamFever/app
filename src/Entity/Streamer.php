<?php

namespace App\Entity;

use App\Repository\StreamerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StreamerRepository::class)
 */
class Streamer
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
    private $streamPseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $streamerTwitch;

    /**
     * @ORM\OneToMany(targetEntity=Widget::class, mappedBy="widetIDStreamer")
     */
    private $widgets;

    public function __construct()
    {
        $this->widgets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreamPseudo(): ?string
    {
        return $this->streamPseudo;
    }

    public function setStreamPseudo(string $streamPseudo): self
    {
        $this->streamPseudo = $streamPseudo;

        return $this;
    }

    public function getStreamerTwitch(): ?string
    {
        return $this->streamerTwitch;
    }

    public function setStreamerTwitch(string $streamerTwitch): self
    {
        $this->streamerTwitch = $streamerTwitch;

        return $this;
    }

    /**
     * @return Collection<int, Widget>
     */
    public function getWidgets(): Collection
    {
        return $this->widgets;
    }

    public function addWidget(Widget $widget): self
    {
        if (!$this->widgets->contains($widget)) {
            $this->widgets[] = $widget;
            $widget->setWidetIDStreamer($this);
        }

        return $this;
    }

    public function removeWidget(Widget $widget): self
    {
        if ($this->widgets->removeElement($widget)) {
            // set the owning side to null (unless already changed)
            if ($widget->getWidetIDStreamer() === $this) {
                $widget->setWidetIDStreamer(null);
            }
        }

        return $this;
    }
}
