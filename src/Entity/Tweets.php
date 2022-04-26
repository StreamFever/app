<?php

namespace App\Entity;

use App\Repository\TweetsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TweetsRepository::class)
 */
class Tweets
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
     * @ORM\Column(type="text")
     */
    private $tweetAvatarURL;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tweetMediaType;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tweetMediaURL;

    /**
     * @ORM\Column(type="text")
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

    public function getTweetAvatarURL(): ?string
    {
        return $this->tweetAvatarURL;
    }

    public function setTweetAvatarURL(string $tweetAvatarURL): self
    {
        $this->tweetAvatarURL = $tweetAvatarURL;

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

    public function getTweetMediaURL(): ?string
    {
        return $this->tweetMediaURL;
    }

    public function setTweetMediaURL(?string $tweetMediaURL): self
    {
        $this->tweetMediaURL = $tweetMediaURL;

        return $this;
    }

    public function getTweetContent(): ?string
    {
        return $this->tweetContent;
    }

    public function setTweetContent(string $tweetContent): self
    {
        $this->tweetContent = $tweetContent;

        return $this;
    }
}
