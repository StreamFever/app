<?php

namespace App\Entity;

use App\Repository\LibMapsRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LibMapsRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"libMaps:read"}},
 *     denormalizationContext={"groups"={"libMaps:write"}}
 * )
 */
class LibMaps
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"libMaps:read", "map:read", "game:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"libMaps:read", "map:read", "game:read"})
     */
    private $mapName;

    /**
     * @ORM\Column(type="text")
     * @Groups({"libMaps:read", "map:read", "game:read"})
     */
    private $mapImg;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->mapName;
    }

    public function getMapName(): ?string
    {
        return $this->mapName;
    }

    public function setMapName(string $mapName): self
    {
        $this->mapName = $mapName;

        return $this;
    }

    public function getMapImg(): ?string
    {
        return $this->mapImg;
    }

    public function setMapImg(string $mapImg): self
    {
        $this->mapImg = $mapImg;

        return $this;
    }
}
