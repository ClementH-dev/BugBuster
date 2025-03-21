<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->tests = new ArrayCollection();
        $this->updateTest = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $isVerified = false;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Tests>
     */
    #[ORM\OneToMany(targetEntity: Tests::class, mappedBy: 'CreatedBy')]
    private Collection $tests;

    /**
     * @var Collection<int, Tests>
     */
    #[ORM\OneToMany(targetEntity: Tests::class, mappedBy: 'updatedBy')]
    private Collection $updateTest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Tests>
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Tests $test): static
    {
        if (!$this->tests->contains($test)) {
            $this->tests->add($test);
            $test->setCreatedBy($this);
        }

        return $this;
    }

    public function removeTest(Tests $test): static
    {
        if ($this->tests->removeElement($test)) {
            // set the owning side to null (unless already changed)
            if ($test->getCreatedBy() === $this) {
                $test->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tests>
     */
    public function getUpdateTest(): Collection
    {
        return $this->updateTest;
    }

    public function addUpdateTest(Tests $updateTest): static
    {
        if (!$this->updateTest->contains($updateTest)) {
            $this->updateTest->add($updateTest);
            $updateTest->setUpdatedBy($this);
        }

        return $this;
    }

    public function removeUpdateTest(Tests $updateTest): static
    {
        if ($this->updateTest->removeElement($updateTest)) {
            // set the owning side to null (unless already changed)
            if ($updateTest->getUpdatedBy() === $this) {
                $updateTest->setUpdatedBy(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO Changer par un nom prénom
        return $this->getEmail(); // Remplacez par la propriété qui représente le nom de l'utilisateur
    }
}
