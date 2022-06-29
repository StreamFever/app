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
    private $userID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $websocketID;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $overlID;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserID(): ?int
    {
        return $this->userID;
    }

    public function setUserID(int $userID): self
    {
        $this->userID = $userID;

        return $this;
    }

    public function getWebsocketID(): ?string
    {
        return $this->websocketID;
    }

    public function setWebsocketID(string $websocketID): self
    {
        $this->websocketID = $websocketID;

        return $this;
    }

    public function getOverlID(): ?int
    {
        return $this->overlID;
    }

    public function setOverlID(int $overlID): self
    {
        $this->overlID = $overlID;

        return $this;
    }
}
