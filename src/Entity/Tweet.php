<?php

namespace App\Entity;

use App\Repository\TweetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TweetRepository::class)
 */
class Tweet
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
    private $tweetPseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tweetAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tweetAvatar;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tweetMediaType;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tweetMediaUrl;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tweetContent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTweetPseudo(): ?string
    {
        return $this->tweetPseudo;
    }

    public function setTweetPseudo(string $tweetPseudo): self
    {
        $this->tweetPseudo = $tweetPseudo;

        return $this;
    }

    public function getTweetAt(): ?string
    {
        return $this->tweetAt;
    }

    public function setTweetAt(string $tweetAt): self
    {
        $this->tweetAt = $tweetAt;

        return $this;
    }

    public function getTweetAvatar(): ?string
    {
        return $this->tweetAvatar;
    }

    public function setTweetAvatar(?string $tweetAvatar): self
    {
        $this->tweetAvatar = $tweetAvatar;

        return $this;
    }

    public function getTweetMediaType(): ?string
    {
        return $this->tweetMediaType;
    }

    public function setTweetMediaType(?string $tweetMediaType): self
    {
        $this->tweetMediaType = $tweetMediaType;

        return $this;
    }

    public function getTweetMediaUrl(): ?string
    {
        return $this->tweetMediaUrl;
    }

    public function setTweetMediaUrl(?string $tweetMediaUrl): self
    {
        $this->tweetMediaUrl = $tweetMediaUrl;

        return $this;
    }

    public function getTweetContent(): ?string
    {
        return $this->tweetContent;
    }

    public function setTweetContent(?string $tweetContent): self
    {
        $this->tweetContent = $tweetContent;

        return $this;
    }
}
