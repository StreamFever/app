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
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userFirstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userLastName;

    /**
     * @ORM\OneToMany(targetEntity=Overlay::class, mappedBy="widgetOwner")
     */
    private $overlayOwned;

    /**
     * @ORM\ManyToMany(targetEntity=Overlay::class, mappedBy="WidgetPermission")
     */
    private $overlaysAllowed;

    /**
     * @ORM\ManyToMany(targetEntity=Logs::class, mappedBy="LogsUser")
     */
    private $logs;

    public function __construct()
    {
        $this->overlayOwned = new ArrayCollection();
        $this->overlaysAllowed = new ArrayCollection();
        $this->logs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
        return (string) $this->email;
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

    public function getUserFirstName(): ?string
    {
        return $this->userFirstName;
    }

    public function setUserFirstName(?string $userFirstName): self
    {
        $this->userFirstName = $userFirstName;

        return $this;
    }

    public function getUserLastName(): ?string
    {
        return $this->userLastName;
    }

    public function setUserLastName(?string $userLastName): self
    {
        $this->userLastName = $userLastName;

        return $this;
    }

    /**
     * @return Collection<int, Overlay>
     */
    public function getOverlayOwned(): Collection
    {
        return $this->overlayOwned;
    }

    public function addOverlayOwned(Overlay $overlayOwned): self
    {
        if (!$this->overlayOwned->contains($overlayOwned)) {
            $this->overlayOwned[] = $overlayOwned;
            $overlayOwned->setWidgetOwner($this);
        }

        return $this;
    }

    public function removeOverlayOwned(Overlay $overlayOwned): self
    {
        if ($this->overlayOwned->removeElement($overlayOwned)) {
            // set the owning side to null (unless already changed)
            if ($overlayOwned->getWidgetOwner() === $this) {
                $overlayOwned->setWidgetOwner(null);
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
            $overlaysAllowed->addWidgetPermission($this);
        }

        return $this;
    }

    public function removeOverlaysAllowed(Overlay $overlaysAllowed): self
    {
        if ($this->overlaysAllowed->removeElement($overlaysAllowed)) {
            $overlaysAllowed->removeWidgetPermission($this);
        }

        return $this;
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
            $log->addLogsUser($this);
        }

        return $this;
    }

    public function removeLog(Logs $log): self
    {
        if ($this->logs->removeElement($log)) {
            $log->removeLogsUser($this);
        }

        return $this;
    }
}
