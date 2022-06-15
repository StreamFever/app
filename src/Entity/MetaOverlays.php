<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MetaOverlaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MetaOverlaysRepository::class)
 */
class MetaOverlays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Overlay::class, inversedBy="metaOverlays")
     */
    private $overlayId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metaKey;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $metaValue;

    public function __construct()
    {
        $this->overlayId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Overlay>
     */
    public function getOverlayId(): Collection
    {
        return $this->overlayId;
    }

    public function addOverlayId(Overlay $overlayId): self
    {
        if (!$this->overlayId->contains($overlayId)) {
            $this->overlayId[] = $overlayId;
        }

        return $this;
    }

    public function removeOverlayId(Overlay $overlayId): self
    {
        $this->overlayId->removeElement($overlayId);

        return $this;
    }

    public function getMetaKey(): ?string
    {
        return $this->metaKey;
    }

    public function setMetaKey(string $metaKey): self
    {
        $this->metaKey = $metaKey;

        return $this;
    }

    public function getMetaValue(): ?string
    {
        return $this->metaValue;
    }

    public function setMetaValue(string $metaValue): self
    {
        $this->metaValue = $metaValue;

        return $this;
    }
}
