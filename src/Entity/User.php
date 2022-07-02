<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $uuid;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Logs::class, mappedBy="LogsUser")
     */
    private $logs;

    /**
     * @ORM\OneToMany(targetEntity=Overlay::class, mappedBy="OverlayOwner")
     */
    private $overlaysOwned;

    /**
     * @ORM\ManyToMany(targetEntity=Overlay::class, mappedBy="OverlayAccess")
     */
    private $overlaysAllowed;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="userId")
     */
    private $games;

    /**
     * @ORM\OneToMany(targetEntity=Meta::class, mappedBy="userId")
     */
    private $metas;

    /**
     * @ORM\OneToMany(targetEntity=Ui::class, mappedBy="uiUserId")
     */
    private $uiData;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $UserFirstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $UserLastName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $AvatarUrl;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="userId")
     */
    private $events;

    public function __construct()
    {
        $this->logs = new ArrayCollection();
        $this->overlaysOwned = new ArrayCollection();
        $this->overlaysAllowed = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->metas = new ArrayCollection();
        $this->uiData = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->email;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->uuid;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Logs>
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(Logs $log): self
    {
        if (!$this->logs->contains($log)) {
            $this->logs[] = $log;
            $log->setLogsUser($this);
        }

        return $this;
    }

    public function removeLog(Logs $log): self
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getLogsUser() === $this) {
                $log->setLogsUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Overlay>
     */
    public function getOverlays(): Collection
    {
        return $this->overlaysOwned;
    }

    public function addOverlay(Overlay $overlay): self
    {
        if (!$this->overlaysOwned->contains($overlay)) {
            $this->overlaysOwned[] = $overlay;
            $overlay->setOverlayOwner($this);
        }

        return $this;
    }

    public function removeOverlay(Overlay $overlay): self
    {
        if ($this->overlaysOwned->removeElement($overlay)) {
            // set the owning side to null (unless already changed)
            if ($overlay->getOverlayOwner() === $this) {
                $overlay->setOverlayOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Overlay>
     */
    public function getOverlaysAllowed(): Collection
    {
        return $this->overlaysAllowed;
    }

    public function addOverlaysAllowed(Overlay $overlaysAllowed): self
    {
        if (!$this->overlaysAllowed->contains($overlaysAllowed)) {
            $this->overlaysAllowed[] = $overlaysAllowed;
            $overlaysAllowed->addOverlayAccess($this);
        }

        return $this;
    }

    public function removeOverlaysAllowed(Overlay $overlaysAllowed): self
    {
        if ($this->overlaysAllowed->removeElement($overlaysAllowed)) {
            $overlaysAllowed->removeOverlayAccess($this);
        }

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
            $game->setUserId($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getUserId() === $this) {
                $game->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Meta>
     */
    public function getMetas(): Collection
    {
        return $this->metas;
    }

    public function addMeta(Meta $meta): self
    {
        if (!$this->metas->contains($meta)) {
            $this->metas[] = $meta;
            $meta->setUserId($this);
        }

        return $this;
    }

    public function removeMeta(Meta $meta): self
    {
        if ($this->metas->removeElement($meta)) {
            // set the owning side to null (unless already changed)
            if ($meta->getUserId() === $this) {
                $meta->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ui>
     */
    public function getUiData(): Collection
    {
        return $this->uiData;
    }

    public function addUiData(Ui $uiData): self
    {
        if (!$this->uiData->contains($uiData)) {
            $this->uiData[] = $uiData;
            $uiData->setUiUserId($this);
        }

        return $this;
    }

    public function removeUiData(Ui $uiData): self
    {
        if ($this->uiData->removeElement($uiData)) {
            // set the owning side to null (unless already changed)
            if ($uiData->getUiUserId() === $this) {
                $uiData->setUiUserId(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getUserFirstName(): ?string
    {
        return $this->UserFirstName;
    }

    public function setUserFirstName(?string $UserFirstName): self
    {
        $this->UserFirstName = $UserFirstName;

        return $this;
    }

    public function getUserLastName(): ?string
    {
        return $this->UserLastName;
    }

    public function setUserLastName(?string $UserLastName): self
    {
        $this->UserLastName = $UserLastName;

        return $this;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->AvatarUrl;
    }

    public function setAvatarUrl(?string $AvatarUrl): self
    {
        $this->AvatarUrl = $AvatarUrl;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setUserId($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getUserId() === $this) {
                $event->setUserId(null);
            }
        }

        return $this;
    }
}
