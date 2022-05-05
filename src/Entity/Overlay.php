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
    private $widgetName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $widgetVisible;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="overlayOwned")
     */
    private $widgetOwner;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="overlaysAllowed")
     */
    private $WidgetPermission;

    public function __construct()
    {
        $this->WidgetPermission = new ArrayCollection();
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
}
