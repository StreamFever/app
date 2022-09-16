<?php

namespace App\Entity;

use App\Repository\WebsocketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WebsocketRepository::class)
 */
class Websocket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $websocketId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $overlId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getWebsocketId(): ?string
    {
        return $this->websocketId;
    }

    public function setWebsocketId(string $websocketId): self
    {
        $this->websocketId = $websocketId;

        return $this;
    }

    public function getOverlId(): ?int
    {
        return $this->overlId;
    }

    public function setOverlId(?int $overlId): self
    {
        $this->overlId = $overlId;

        return $this;
    }
}
