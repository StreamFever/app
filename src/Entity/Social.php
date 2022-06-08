<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SocialRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SocialRepository::class)
 */
class Social
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
    private $socialName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $socialTag;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $socialLogo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocialName(): ?string
    {
        return $this->socialName;
    }

    public function setSocialName(string $socialName): self
    {
        $this->socialName = $socialName;

        return $this;
    }

    public function getSocialTag(): ?string
    {
        return $this->socialTag;
    }

    public function setSocialTag(string $socialTag): self
    {
        $this->socialTag = $socialTag;

        return $this;
    }

    public function getSocialLogo(): ?string
    {
        return $this->socialLogo;
    }

    public function setSocialLogo(?string $socialLogo): self
    {
        $this->socialLogo = $socialLogo;

        return $this;
    }
}
