<?php

namespace App\Entity;

use App\Repository\OverlayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=OverlayRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"read:overlay"}}
 * )
 */
class Overlay
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:overlay"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:overlay"})
     */
    private $widgetName;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read:overlay"})
     */
    private $widgetVisible;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="overlayOwned")
     * @Groups({"read:overlay"})
     */
    private $widgetOwner;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="overlaysAllowed")
     * @Groups({"read:overlay"})
     */
    private $WidgetPermission;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:overlay"})
     */
    private $WidgetIdAlpha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:overlay"})
     */
    private $WidgetIdBeta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $widgetVersionAlpha;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $widgetVersionBeta;

    /**
     * @ORM\ManyToMany(targetEntity=MetaOverlays::class, mappedBy="overlayId")
     */
    private $metaOverlays;

    public function __construct()
    {
        $this->WidgetPermission = new ArrayCollection();
        $this->metaOverlays = new ArrayCollection();
    }

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

    public function getWidgetOwner(): ?User
    {
        return $this->widgetOwner;
    }

    public function setWidgetOwner(?User $widgetOwner): self
    {
        $this->widgetOwner = $widgetOwner;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getWidgetPermission(): Collection
    {
        return $this->WidgetPermission;
    }

    public function addWidgetPermission(User $widgetPermission): self
    {
        if (!$this->WidgetPermission->contains($widgetPermission)) {
            $this->WidgetPermission[] = $widgetPermission;
        }

        return $this;
    }

    public function removeWidgetPermission(User $widgetPermission): self
    {
        $this->WidgetPermission->removeElement($widgetPermission);

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
        return $this->widgetVersionAlpha;
    }

    public function setWidgetVersionAlpha(?string $widgetVersionAlpha): self
    {
        $this->widgetVersionAlpha = $widgetVersionAlpha;

        return $this;
    }

    public function getWidgetVersionBeta(): ?string
    {
        return $this->widgetVersionBeta;
    }

    public function setWidgetVersionBeta(?string $widgetVersionBeta): self
    {
        $this->widgetVersionBeta = $widgetVersionBeta;

        return $this;
    }

    /**
     * @return Collection<int, MetaOverlays>
     */
    public function getMetaOverlays(): Collection
    {
        return $this->metaOverlays;
    }

    public function addMetaOverlay(MetaOverlays $metaOverlay): self
    {
        if (!$this->metaOverlays->contains($metaOverlay)) {
            $this->metaOverlays[] = $metaOverlay;
            $metaOverlay->addOverlayId($this);
        }

        return $this;
    }

    public function removeMetaOverlay(MetaOverlays $metaOverlay): self
    {
        if ($this->metaOverlays->removeElement($metaOverlay)) {
            $metaOverlay->removeOverlayId($this);
        }

        return $this;
    }
}
