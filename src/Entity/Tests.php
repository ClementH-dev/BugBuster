<?php

namespace App\Entity;

use App\Repository\TestsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestsRepository::class)]
class Tests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $steps = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $acceptance_criteria = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $excected_result = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $actual_result = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'tests')]
    private ?User $CreatedBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSteps(): ?string
    {
        return $this->steps;
    }

    public function setSteps(string $steps): static
    {
        $this->steps = $steps;

        return $this;
    }

    public function getAcceptanceCriteria(): ?string
    {
        return $this->acceptance_criteria;
    }

    public function setAcceptanceCriteria(string $acceptance_criteria): static
    {
        $this->acceptance_criteria = $acceptance_criteria;

        return $this;
    }

    public function getExcectedResult(): ?string
    {
        return $this->excected_result;
    }

    public function setExcectedResult(string $excected_result): static
    {
        $this->excected_result = $excected_result;

        return $this;
    }

    public function getActualResult(): ?string
    {
        return $this->actual_result;
    }

    public function setActualResult(string $actual_result): static
    {
        $this->actual_result = $actual_result;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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

    public function getCreatedBy(): ?User
    {
        return $this->CreatedBy;
    }

    public function setCreatedBy(?User $CreatedBy): static
    {
        $this->CreatedBy = $CreatedBy;

        return $this;
    }
}
