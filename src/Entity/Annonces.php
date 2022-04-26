<?php

namespace App\Entity;

use App\Repository\AnnoncesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnoncesRepository::class)
 */
class Annonces
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
    private $annonceText;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnonceText(): ?string
    {
        return $this->annonceText;
    }

    public function setAnnonceText(?string $annonceText): self
    {
        $this->annonceText = $annonceText;

        return $this;
    }
}
