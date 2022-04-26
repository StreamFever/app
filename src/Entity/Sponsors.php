<?php

namespace App\Entity;

use App\Repository\SponsorsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SponsorsRepository::class)
 */
class Sponsors
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
    private $sponsorName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sponsorLogo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSponsorName(): ?string
    {
        return $this->sponsorName;
    }

    public function setSponsorName(string $sponsorName): self
    {
        $this->sponsorName = $sponsorName;

        return $this;
    }

    public function getSponsorLogo(): ?string
    {
        return $this->sponsorLogo;
    }

    public function setSponsorLogo(?string $sponsorLogo): self
    {
        $this->sponsorLogo = $sponsorLogo;

        return $this;
    }
}
