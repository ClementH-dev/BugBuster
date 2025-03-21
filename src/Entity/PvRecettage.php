<?php

namespace App\Entity;

use App\Repository\PvRecettageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PvRecettageRepository::class)]
class PvRecettage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pdf_url = null;

    #[ORM\Column]
    private ?int $version = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $generatedAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $technicalEnvironment = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $criticalPoints = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $consequences = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $actionPlan = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $conlusion = null;
    
    /**
     * @var Collection<int, Tests>
     */
    #[ORM\ManyToMany(targetEntity: Tests::class, inversedBy: 'pvRecettages')]
    private Collection $tests;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'pvRecettages')]
    private ?self $PreviousVersion = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'PreviousVersion')]
    private Collection $pvRecettages;


    public function __construct()
    {
        $this->tests = new ArrayCollection();
        $this->pvRecettages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPdfUrl(): ?string
    {
        return $this->pdf_url;
    }

    public function setPdfUrl(string $pdf_url): static
    {
        $this->pdf_url = $pdf_url;

        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(int $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getGeneratedAt(): ?\DateTimeImmutable
    {
        return $this->generatedAt;
    }

    public function setGeneratedAt(\DateTimeImmutable $generatedAt): static
    {
        $this->generatedAt = $generatedAt;

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
        }

        return $this;
    }

    public function removeTest(Tests $test): static
    {
        $this->tests->removeElement($test);

        return $this;
    }

    public function getTechnicalEnvironment(): ?string
    {
        return $this->technicalEnvironment;
    }

    public function setTechnicalEnvironment(?string $technicalEnvironment): static
    {
        $this->technicalEnvironment = $technicalEnvironment;

        return $this;
    }

    public function getCriticalPoints(): ?string
    {
        return $this->criticalPoints;
    }

    public function setCriticalPoints(?string $criticalPoints): static
    {
        $this->criticalPoints = $criticalPoints;

        return $this;
    }

    public function getConsequences(): ?string
    {
        return $this->consequences;
    }

    public function setConsequences(?string $consequences): static
    {
        $this->consequences = $consequences;

        return $this;
    }

    public function getActionPlan(): ?string
    {
        return $this->actionPlan;
    }

    public function setActionPlan(?string $actionPlan): static
    {
        $this->actionPlan = $actionPlan;

        return $this;
    }

    public function getConlusion(): ?string
    {
        return $this->conlusion;
    }

    public function setConlusion(?string $conlusion): static
    {
        $this->conlusion = $conlusion;

        return $this;
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

    public function getPreviousVersion(): ?self
    {
        return $this->PreviousVersion;
    }

    public function setPreviousVersion(?self $PreviousVersion): static
    {
        $this->PreviousVersion = $PreviousVersion;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getPvRecettages(): Collection
    {
        return $this->pvRecettages;
    }

    public function addPvRecettage(self $pvRecettage): static
    {
        if (!$this->pvRecettages->contains($pvRecettage)) {
            $this->pvRecettages->add($pvRecettage);
            $pvRecettage->setPreviousVersion($this);
        }

        return $this;
    }

    public function removePvRecettage(self $pvRecettage): static
    {
        if ($this->pvRecettages->removeElement($pvRecettage)) {
            // set the owning side to null (unless already changed)
            if ($pvRecettage->getPreviousVersion() === $this) {
                $pvRecettage->setPreviousVersion(null);
            }
        }

        return $this;
    }
}
