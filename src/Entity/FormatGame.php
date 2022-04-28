<?php

namespace App\Entity;

use App\Repository\FormatGameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormatGameRepository::class)
 */
class FormatGame
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
    private $formatGameName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormatGameName(): ?string
    {
        return $this->formatGameName;
    }

    public function setFormatGameName(string $formatGameName): self
    {
        $this->formatGameName = $formatGameName;

        return $this;
    }
}
