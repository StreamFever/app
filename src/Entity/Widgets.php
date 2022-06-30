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
     * @ORM\Column(type="string", length=255)
     */
    private $WidgetIdAlpha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $WidgetIdBeta;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $WidgetVersionAlpha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $WidgetVersionBeta;

    /**
     * @ORM\OneToMany(targetEntity=Meta::class, mappedBy="Widgets")
     */
    private $metas;

    /**
     * @ORM\ManyToOne(targetEntity=Overlay::class, inversedBy="widgets")
     */
    private $overlay;

    public function __construct()
    {
        $this->metas = new ArrayCollection();
    }

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

    public function getWidgetIdAlpha(): ?string
    {
        return $this->WidgetIdAlpha;
    }

    public function setWidgetIdAlpha(string $WidgetIdAlpha): self
    {
        $this->WidgetIdAlpha = $WidgetIdAlpha;

        return $this;
    }

    public function getWidgetIdBeta(): ?string
    {
        return $this->WidgetIdBeta;
    }

    public function setWidgetIdBeta(?string $WidgetIdBeta): self
    {
        $this->WidgetIdBeta = $WidgetIdBeta;

        return $this;
    }

    public function getWidgetVersionAlpha(): ?string
    {
        return $this->WidgetVersionAlpha;
    }

    public function setWidgetVersionAlpha(string $WidgetVersionAlpha): self
    {
        $this->WidgetVersionAlpha = $WidgetVersionAlpha;

        return $this;
    }

    public function getWidgetVersionBeta(): ?string
    {
        return $this->WidgetVersionBeta;
    }

    public function setWidgetVersionBeta(?string $WidgetVersionBeta): self
    {
        $this->WidgetVersionBeta = $WidgetVersionBeta;

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

    public function getOverlay(): ?Overlay
    {
        return $this->overlay;
    }

    public function setOverlay(?Overlay $overlay): self
    {
        $this->overlay = $overlay;

        return $this;
    }
}
