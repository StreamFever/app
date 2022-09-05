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
     * @ORM\Column(type="string", length=255)
     */
    private $socialName;

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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="socialsOwned")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="socialsAccess")
     */
    private $socialAccess;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, mappedBy="socials")
     */
    private $events;


    public function __construct()
    {
        $this->socialAccess = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->socialName;
    }

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
     * @return Collection<int, User>
     */
    public function getSocialAccess(): Collection
    {
        return $this->socialAccess;
    }

    public function addSocialAccess(User $socialAccess): self
    {
        if (!$this->socialAccess->contains($socialAccess)) {
            $this->socialAccess[] = $socialAccess;
        }

        return $this;
    }

    public function removeSocialAccess(User $socialAccess): self
    {
        $this->socialAccess->removeElement($socialAccess);

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addSocial($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            $event->removeSocial($this);
        }

        return $this;
    }
}
