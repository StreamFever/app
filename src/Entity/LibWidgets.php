<?php

namespace App\Entity;

use App\Repository\LibWidgetsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LibWidgetsRepository::class)
 */
class LibWidgets
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
    private $libWidgetName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libWidgetId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibWidgetName(): ?string
    {
        return $this->libWidgetName;
    }

    public function setLibWidgetName(string $libWidgetName): self
    {
        $this->libWidgetName = $libWidgetName;

        return $this;
    }

    public function getLibWidgetId(): ?string
    {
        return $this->libWidgetId;
    }

    public function setLibWidgetId(string $libWidgetId): self
    {
        $this->libWidgetId = $libWidgetId;

        return $this;
    }
}
