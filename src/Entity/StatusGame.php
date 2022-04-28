<?php

namespace App\Entity;

use App\Repository\StatusGameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusGameRepository::class)
 */
class StatusGame
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
    private $statusGameName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusGameName(): ?string
    {
        return $this->statusGameName;
    }

    public function setStatusGameName(string $statusGameName): self
    {
        $this->statusGameName = $statusGameName;

        return $this;
    }
}
