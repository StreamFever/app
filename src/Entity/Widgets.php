<?php

namespace App\Entity;

use App\Repository\WidgetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity=LibWidgets::class, inversedBy="widgets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $WidgetId;

    /**
     * @ORM\ManyToOne(targetEntity=Overlay::class, inversedBy="widgets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $overlay;

    /**
     * @ORM\OneToMany(targetEntity=Meta::class, mappedBy="Widgets")
     */
    private $metas;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isTwoWidgets;

    public function __construct()
    {
        $this->metas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->WidgetName;
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

    public function getOverlay(): ?Overlay
    {
        return $this->overlay;
    }

    public function setOverlay(?Overlay $overlay): self
    {
        $this->overlay = $overlay;

        return $this;
    }

    /**
     * @return Collection<int, Meta>
     */
    public function getMetas(): Collection
    {
        return $this->metas;
    }

    public function addMeta(Meta $meta): self
    {
        if (!$this->metas->contains($meta)) {
            $this->metas[] = $meta;
            $meta->setWidgets($this);
        }

        return $this;
    }

    public function removeMeta(Meta $meta): self
    {
        if ($this->metas->removeElement($meta)) {
            // set the owning side to null (unless already changed)
            if ($meta->getWidgets() === $this) {
                $meta->setWidgets(null);
            }
        }

        return $this;
    }

    public function getIsTwoWidgets(): ?bool
    {
        return $this->isTwoWidgets;
    }

    public function setIsTwoWidgets(bool $isTwoWidgets): self
    {
        $this->isTwoWidgets = $isTwoWidgets;

        return $this;
    }
}
