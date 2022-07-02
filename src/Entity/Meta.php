<?php

namespace App\Entity;

use App\Repository\MetaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MetaRepository::class)
 */
class Meta
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
    private $MetaKey;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $MetaValue;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="metas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMetaKey(): ?string
    {
        return $this->MetaKey;
    }

    public function setMetaKey(string $MetaKey): self
    {
        $this->MetaKey = $MetaKey;

        return $this;
    }

    public function getMetaValue(): ?string
    {
        return $this->MetaValue;
    }

    public function setMetaValue(?string $MetaValue): self
    {
        $this->MetaValue = $MetaValue;

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
}
