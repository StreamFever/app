<?php

namespace App\Entity;

use App\Repository\PopupRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PopupRepository::class)
 */
class Popup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $popupText;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPopupText(): ?string
    {
        return $this->popupText;
    }

    public function setPopupText(?string $popupText): self
    {
        $this->popupText = $popupText;

        return $this;
    }
}
