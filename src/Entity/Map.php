<?php

namespace App\Entity;

use App\Repository\MapRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MapRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"map:read"}},
 *     denormalizationContext={"groups"={"map:write"}}
 * )
 */
class Map
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"map:read", "game:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=LibMaps::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"map:read", "game:read"})
     */
    private $mapLib;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"map:read", "game:read"})
     */
    private $mapScore;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @Groups({"map:read", "game:read"})
     */
    private $mapPickedBy;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @Groups({"map:read", "game:read"})
     */
    private $mapBannedBy;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @Groups({"map:read", "game:read"})
     */
    private $mapWinnedBy;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"map:read", "game:read"})
     */
    private $mapNameData;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->mapNameData;
    }

    public function getMapLib(): ?LibMaps
    {
        return $this->mapLib;
    }

    public function setMapLib(?LibMaps $mapLib): self
    {
        $this->mapLib = $mapLib;

        return $this;
    }

    public function getMapScore(): ?string
    {
        return $this->mapScore;
    }

    public function setMapScore(?string $mapScore): self
    {
        $this->mapScore = $mapScore;

        return $this;
    }

    public function getMapPickedBy(): ?Team
    {
        return $this->mapPickedBy;
    }

    public function setMapPickedBy(?Team $mapPickedBy): self
    {
        $this->mapPickedBy = $mapPickedBy;

        return $this;
    }

    public function getMapBannedBy(): ?Team
    {
        return $this->mapBannedBy;
    }

    public function setMapBannedBy(?Team $mapBannedBy): self
    {
        $this->mapBannedBy = $mapBannedBy;

        return $this;
    }

    public function getMapWinnedBy(): ?Team
    {
        return $this->mapWinnedBy;
    }

    public function setMapWinnedBy(?Team $mapWinnedBy): self
    {
        $this->mapWinnedBy = $mapWinnedBy;

        return $this;
    }

    public function getMapNameData(): ?string
    {
        return $this->mapNameData;
    }

    public function setMapNameData(string $mapNameData): self
    {
        $this->mapNameData = $mapNameData;

        return $this;
    }
}
