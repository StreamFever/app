<?php

namespace App\Entity;

use App\Repository\FlagsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlagsRepository::class)
 */
class Flags
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
    private $flagCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlagCode(): ?string
    {
        return $this->flagCode;
    }

    public function setFlagCode(string $flagCode): self
    {
        $this->flagCode = $flagCode;

        return $this;
    }
}
