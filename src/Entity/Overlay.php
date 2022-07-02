<?php

namespace App\Entity;

use App\Repository\OverlayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OverlayRepository::class)
 */
class Overlay
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
    private $OverlayName;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="overlaysOwned")
     * @ORM\JoinColumn(nullable=false)
     */
    private $OverlayOwner;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="overlaysAllowed")
     */
    private $OverlayAccess;

    /**
     * @ORM\OneToMany(targetEntity=Widgets::class, mappedBy="overlay")
     */
    private $widgets;

    public function __construct()
    {
        $this->OverlayAccess = new ArrayCollection();
        $this->widgets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOverlayName(): ?string
    {
        return $this->OverlayName;
    }

    public function setOverlayName(string $OverlayName): self
    {
        $this->OverlayName = $OverlayName;

        return $this;
    }

    public function getOverlayOwner(): ?User
    {
        return $this->OverlayOwner;
    }

    public function setOverlayOwner(?User $OverlayOwner): self
    {
        $this->OverlayOwner = $OverlayOwner;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getOverlayAccess(): Collection
    {
        return $this->OverlayAccess;
    }

    public function addOverlayAccess(User $overlayAccess): self
    {
        if (!$this->OverlayAccess->contains($overlayAccess)) {
            $this->OverlayAccess[] = $overlayAccess;
        }

        return $this;
    }

    public function removeOverlayAccess(User $overlayAccess): self
    {
        $this->OverlayAccess->removeElement($overlayAccess);

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
            $widget->setOverlay($this);
        }

        return $this;
    }

    public function removeWidget(Widgets $widget): self
    {
        if ($this->widgets->removeElement($widget)) {
            // set the owning side to null (unless already changed)
            if ($widget->getOverlay() === $this) {
                $widget->setOverlay(null);
            }
        }

        return $this;
    }
}
