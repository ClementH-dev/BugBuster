<?php

namespace App\Entity;

use App\Repository\PvRecettageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PvRecettageRepository::class)]
class PvRecettage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $pdf_url = null;

    #[ORM\Column]
    private ?int $version = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $generatedAt = null;

    /**
     * @var Collection<int, Tests>
     */
    #[ORM\ManyToMany(targetEntity: Tests::class, inversedBy: 'pvRecettages')]
    private Collection $tests;

    public function __construct()
    {
        $this->tests = new ArrayCollection();
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
}
