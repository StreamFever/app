<?php

namespace App\Entity;

use App\Repository\WidgetsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WidgetsRepository::class)
 */
class Widgets
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
     * @ORM\ManyToOne(targetEntity=Streamers::class, inversedBy="widgets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $widgetIDStreamer;

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

    public function getWidgetIDStreamer(): ?Streamers
    {
        return $this->widgetIDStreamer;
    }

    public function setWidgetIDStreamer(?Streamers $widgetIDStreamer): self
    {
        $this->widgetIDStreamer = $widgetIDStreamer;

        return $this;
    }
}
