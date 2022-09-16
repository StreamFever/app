<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"status:read"}},
 *     denormalizationContext={"groups"={"status:write"}}
 * )
 */
class Status
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"status:read", "game:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"status:read", "game:read"})
     */
    private $statusName;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="gameStatus")
     */
    private $games;

    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->statusName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusName(): ?string
    {
        return $this->statusName;
    }

    public function setStatusName(string $statusName): self
    {
        $this->statusName = $statusName;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setGameStatus($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getGameStatus() === $this) {
                $game->setGameStatus(null);
            }
        }

        return $this;
    }
}
