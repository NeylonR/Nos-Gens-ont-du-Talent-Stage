<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $link;

    #[ORM\ManyToOne(targetEntity: ProjectStatus::class, inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    private $status;

    #[ORM\ManyToMany(targetEntity: Company::class, inversedBy: 'projects')]
    private $projectCompany;

    #[ORM\ManyToMany(targetEntity: Talent::class, inversedBy: 'projects')]
    private $projectTalent;

    public function __construct()
    {
        $this->projectCompany = new ArrayCollection();
        $this->projectTalent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getStatus(): ?ProjectStatus
    {
        return $this->status;
    }

    public function setStatus(?ProjectStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Company>
     */
    public function getProjectCompany(): Collection
    {
        return $this->projectCompany;
    }

    public function addProjectCompany(Company $projectCompany): self
    {
        if (!$this->projectCompany->contains($projectCompany)) {
            $this->projectCompany[] = $projectCompany;
        }

        return $this;
    }

    public function removeProjectCompany(Company $projectCompany): self
    {
        $this->projectCompany->removeElement($projectCompany);

        return $this;
    }

    /**
     * @return Collection<int, Talent>
     */
    public function getProjectTalent(): Collection
    {
        return $this->projectTalent;
    }

    public function addProjectTalent(Talent $projectTalent): self
    {
        if (!$this->projectTalent->contains($projectTalent)) {
            $this->projectTalent[] = $projectTalent;
        }

        return $this;
    }

    public function removeProjectTalent(Talent $projectTalent): self
    {
        $this->projectTalent->removeElement($projectTalent);

        return $this;
    }
}
