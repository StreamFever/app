<?php

namespace App\Entity;

use App\Repository\LibSocialsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LibSocialsRepository::class)
 */
class LibSocials
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
    private $libSocialName;

    /**
     * @ORM\Column(type="text")
     */
    private $libSocialLogo;

    public function __toString()
    {
        return $this->libSocialName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibSocialName(): ?string
    {
        return $this->libSocialName;
    }

    public function setLibSocialName(string $libSocialName): self
    {
        $this->libSocialName = $libSocialName;

        return $this;
    }

    public function getLibSocialLogo(): ?string
    {
        return $this->libSocialLogo;
    }

    public function setLibSocialLogo(string $libSocialLogo): self
    {
        $this->libSocialLogo = $libSocialLogo;

        return $this;
    }
}
