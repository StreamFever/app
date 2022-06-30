<?php

namespace App\Entity;

use App\Repository\LogsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogsRepository::class)
 */
class Logs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $LogsTimestamp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LogsLevel;

    /**
     * @ORM\Column(type="text")
     */
    private $LogsText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LogsOverlay;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="logs")
     */
    private $UserId;

    public function __construct()
    {
        $this->UserId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogsTimestamp(): ?\DateTimeInterface
    {
        return $this->LogsTimestamp;
    }

    public function setLogsTimestamp(\DateTimeInterface $LogsTimestamp): self
    {
        $this->LogsTimestamp = $LogsTimestamp;

        return $this;
    }

    public function getLogsLevel(): ?string
    {
        return $this->LogsLevel;
    }

    public function setLogsLevel(string $LogsLevel): self
    {
        $this->LogsLevel = $LogsLevel;

        return $this;
    }

    public function getLogsText(): ?string
    {
        return $this->LogsText;
    }

    public function setLogsText(string $LogsText): self
    {
        $this->LogsText = $LogsText;

        return $this;
    }

    public function getLogsOverlay(): ?string
    {
        return $this->LogsOverlay;
    }

    public function setLogsOverlay(string $LogsOverlay): self
    {
        $this->LogsOverlay = $LogsOverlay;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->UserId;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->UserId->contains($userId)) {
            $this->UserId[] = $userId;
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        $this->UserId->removeElement($userId);

        return $this;
    }
}
