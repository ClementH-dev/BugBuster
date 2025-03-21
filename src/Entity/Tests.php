<?php

namespace App\Entity;

use App\Repository\TestsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'updateTest')]
    private ?User $updatedBy = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observations = null;

    /**
     * @var Collection<int, PvRecettage>
     */
    #[ORM\ManyToMany(targetEntity: PvRecettage::class, mappedBy: 'tests')]
    private Collection $pvRecettages;

    public function __construct()
    {
        $this->pvRecettages = new ArrayCollection();
    }


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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): static
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): static
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * @return Collection<int, PvRecettage>
     */
    public function getPvRecettages(): Collection
    {
        return $this->pvRecettages;
    }

    public function addPvRecettage(PvRecettage $pvRecettage): static
    {
        if (!$this->pvRecettages->contains($pvRecettage)) {
            $this->pvRecettages->add($pvRecettage);
            $pvRecettage->addTest($this);
        }

        return $this;
    }

    public function removePvRecettage(PvRecettage $pvRecettage): static
    {
        if ($this->pvRecettages->removeElement($pvRecettage)) {
            $pvRecettage->removeTest($this);
        }

        return $this;
    }
}
