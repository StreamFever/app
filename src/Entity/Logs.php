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
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="logs")
     */
    private $LogsUser;

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

    public function __construct()
    {
        $this->LogsUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getLogsUser(): Collection
    {
        return $this->LogsUser;
    }

    public function addLogsUser(User $logsUser): self
    {
        if (!$this->LogsUser->contains($logsUser)) {
            $this->LogsUser[] = $logsUser;
        }

        return $this;
    }

    public function removeLogsUser(User $logsUser): self
    {
        $this->LogsUser->removeElement($logsUser);

        return $this;
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

    public function setLogsOverlay(?string $LogsOverlay): self
    {
        $this->LogsOverlay = $LogsOverlay;

        return $this;
    }
}
