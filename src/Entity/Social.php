<?php

namespace App\Entity;

use App\Repository\SocialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\ManyToOne(targetEntity=LibSocials::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $socialLib;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $socialTag;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="socials")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, inversedBy="socials")
     */
    private $socialAccess;

    public function __construct()
    {
        $this->socialAccess = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->socialTag;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocialLib(): ?LibSocials
    {
        return $this->socialLib;
    }

    public function setSocialLib(?LibSocials $socialLib): self
    {
        $this->socialLib = $socialLib;

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

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getSocialAccess(): Collection
    {
        return $this->socialAccess;
    }

    public function addSocialAccess(Event $socialAccess): self
    {
        if (!$this->socialAccess->contains($socialAccess)) {
            $this->socialAccess[] = $socialAccess;
        }

        return $this;
    }

    public function removeSocialAccess(Event $socialAccess): self
    {
        $this->socialAccess->removeElement($socialAccess);

        return $this;
    }
}
