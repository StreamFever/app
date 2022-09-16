<?php

namespace App\Entity;

use App\Repository\LogsRepository;
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="logs")
     * @ORM\JoinColumn(nullable=false)
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
     * @ORM\Column(type="string", length=255)
     */
    private $logsOverlay;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogsUser(): ?User
    {
        return $this->LogsUser;
    }

    public function setLogsUser(?User $LogsUser): self
    {
        $this->LogsUser = $LogsUser;

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
        return $this->logsOverlay;
    }

    public function setLogsOverlay(string $logsOverlay): self
    {
        $this->logsOverlay = $logsOverlay;

        return $this;
    }
}
