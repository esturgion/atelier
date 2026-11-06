<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'user_email', length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(name: 'user_password', length: 255)]
    private ?string $password = null;

    #[ORM\Column(name: 'user_created_at')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(name: 'user_is_active', options: ['default' => true])]
    private bool $isActive = true;

    #[ORM\Column(name: 'user_is_verified', options: ['default' => false])]
    private bool $isVerified = false;

    #[ORM\Column(name: 'user_deactivated_at', nullable: true)]
    private ?\DateTimeImmutable $deactivatedAt = null;

    /**
     * @var Collection<int, Library>
     */
    #[ORM\OneToMany(targetEntity: Library::class, mappedBy: 'owner', cascade: ['remove'], orphanRemoval: true)]
    private Collection $libraries;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\OneToMany(targetEntity: Project::class, mappedBy: 'owner', cascade: ['remove'], orphanRemoval: true)]
    private Collection $projects;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->libraries = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserEmail(): ?string
    {
        return $this->email;
    }

    public function setUserEmail(string $user_email): static
    {
        $this->email = $user_email;

        return $this;
    }

    public function getUserPassword(): ?string
    {
        return $this->password;
    }

    public function setUserPassword(string $user_password): static
    {
        $this->password = $user_password;

        return $this;
    }

    public function getUserCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setUserCreatedAt(\DateTimeImmutable $user_created_at): static
    {
        $this->createdAt = $user_created_at;

        return $this;
    }

    public function isUserIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setUserIsActive(bool $user_is_active): static
    {
        $this->isActive = $user_is_active;

        return $this;
    }

    public function isUserIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setUserIsVerified(bool $user_is_verified): static
    {
        $this->isVerified = $user_is_verified;

        return $this;
    }

    public function getUserDeactivatedAt(): ?\DateTimeImmutable
    {
        return $this->deactivatedAt;
    }

    public function setUserDeactivatedAt(?\DateTimeImmutable $user_deactivated_at): static
    {
        $this->deactivatedAt = $user_deactivated_at;

        return $this;
    }

    /**
     * @return Collection<int, Library>
     */
    public function getLibraries(): Collection
    {
        return $this->libraries;
    }

    public function addLibrary(Library $library): static
    {
        if (!$this->libraries->contains($library)) {
            $this->libraries->add($library);
            $library->setOwner($this);
        }

        return $this;
    }

    public function removeLibrary(Library $library): static
    {
        $this->libraries->removeElement($library);

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setOwner($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        $this->projects->removeElement($project);

        return $this;
    }
}
