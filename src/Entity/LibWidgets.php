<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LibWidgetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libWidgetId2;

    /**
     * @ORM\OneToMany(targetEntity=Widgets::class, mappedBy="WidgetId")
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

    public function __toString()
    {
        return $this->libWidgetName;
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

    public function getLibWidgetId2(): ?string
    {
        return $this->libWidgetId2;
    }

    public function setLibWidgetId2(?string $libWidgetId2): self
    {
        $this->libWidgetId2 = $libWidgetId2;

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
            $widget->setWidgetId($this);
        }

        return $this;
    }

    public function removeWidget(Widgets $widget): self
    {
        if ($this->widgets->removeElement($widget)) {
            // set the owning side to null (unless already changed)
            if ($widget->getWidgetId() === $this) {
                $widget->setWidgetId(null);
            }
        }

        return $this;
    }
}
