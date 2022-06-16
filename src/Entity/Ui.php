<?php

namespace App\Entity;

use App\Repository\UiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UiRepository::class)
 */
class Ui
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
    private $uiKey;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $uiValue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUiKey(): ?string
    {
        return $this->uiKey;
    }

    public function setUiKey(string $uiKey): self
    {
        $this->uiKey = $uiKey;

        return $this;
    }

    public function getUiValue(): ?string
    {
        return $this->uiValue;
    }

    public function setUiValue(?string $uiValue): self
    {
        $this->uiValue = $uiValue;

        return $this;
    }
}
