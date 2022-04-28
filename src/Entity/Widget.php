<?php

namespace App\Entity;

use App\Repository\WidgetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WidgetRepository::class)
 */
class Widget
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
    private $widgetName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $widgetVisible;

    /**
     * @ORM\ManyToOne(targetEntity=Streamer::class, inversedBy="widgets")
     */
    private $widetIDStreamer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWidgetName(): ?string
    {
        return $this->widgetName;
    }

    public function setWidgetName(string $widgetName): self
    {
        $this->widgetName = $widgetName;

        return $this;
    }

    public function getWidgetVisible(): ?bool
    {
        return $this->widgetVisible;
    }

    public function setWidgetVisible(bool $widgetVisible): self
    {
        $this->widgetVisible = $widgetVisible;

        return $this;
    }

    public function getWidetIDStreamer(): ?Streamer
    {
        return $this->widetIDStreamer;
    }

    public function setWidetIDStreamer(?Streamer $widetIDStreamer): self
    {
        $this->widetIDStreamer = $widetIDStreamer;

        return $this;
    }
}
