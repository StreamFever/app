<?php

namespace App\Entity;

use App\Repository\MapsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MapsRepository::class)
 */
class Maps
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
}
