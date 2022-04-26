<?php

namespace App\Entity;

use App\Repository\StreamersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StreamersRepository::class)
 */
class Streamers
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
    private $streamerPseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $streamerTwitch;

    /**
     * @ORM\OneToMany(targetEntity=Widgets::class, mappedBy="widgetIDStreamer")
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

    public function getStreamerPseudo(): ?string
    {
        return $this->streamerPseudo;
    }

    public function setStreamerPseudo(string $streamerPseudo): self
    {
        $this->streamerPseudo = $streamerPseudo;

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
     * @return Collection<int, Widgets>
     */
    public function getWidgets(): Collection
    {
        return $this->widgets;
    }

    public function addWidget(Widgets $widget): self
    {
        if (!$this->widgets->contains($widget)) {
            $this->widgets[] = $widget;
            $widget->setWidgetIDStreamer($this);
        }

        return $this;
    }

    public function removeWidget(Widgets $widget): self
    {
        if ($this->widgets->removeElement($widget)) {
            // set the owning side to null (unless already changed)
            if ($widget->getWidgetIDStreamer() === $this) {
                $widget->setWidgetIDStreamer(null);
            }
        }

        return $this;
    }
}
