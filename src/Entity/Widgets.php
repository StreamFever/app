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
    private $WidgetName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $WidgetVisible;

    /**
     * @ORM\ManyToOne(targetEntity=LibWidgets::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $WidgetId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWidgetName(): ?string
    {
        return $this->WidgetName;
    }

    public function setWidgetName(string $WidgetName): self
    {
        $this->WidgetName = $WidgetName;

        return $this;
    }

    public function getWidgetVisible(): ?bool
    {
        return $this->WidgetVisible;
    }

    public function setWidgetVisible(bool $WidgetVisible): self
    {
        $this->WidgetVisible = $WidgetVisible;

        return $this;
    }

    public function getWidgetId(): ?LibWidgets
    {
        return $this->WidgetId;
    }

    public function setWidgetId(?LibWidgets $WidgetId): self
    {
        $this->WidgetId = $WidgetId;

        return $this;
    }
}
