<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MapRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MapRepository::class)
 */
class Map
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
    private $mapName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mapImg;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setMapImg(?string $mapImg): self
    {
        $this->mapImg = $mapImg;

        return $this;
    }
}
