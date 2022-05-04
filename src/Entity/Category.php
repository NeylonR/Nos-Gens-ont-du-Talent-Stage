<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $label;

    #[ORM\ManyToMany(targetEntity: Agency::class, mappedBy: 'agencyCategory')]
    private $agencies;

    #[ORM\ManyToMany(targetEntity: Talent::class, mappedBy: 'talentCategory')]
    private $talents;

    #[ORM\ManyToMany(targetEntity: Company::class, mappedBy: 'companyCategory')]
    private $companies;

    public function __construct()
    {
        $this->agencies = new ArrayCollection();
        $this->talents = new ArrayCollection();
        $this->companies = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->label;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Agency>
     */
    public function getAgencies(): Collection
    {
        return $this->agencies;
    }

    public function addAgency(Agency $agency): self
    {
        if (!$this->agencies->contains($agency)) {
            $this->agencies[] = $agency;
            $agency->addAgencyCategory($this);
        }

        return $this;
    }

    public function removeAgency(Agency $agency): self
    {
        if ($this->agencies->removeElement($agency)) {
            $agency->removeAgencyCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Talent>
     */
    public function getTalents(): Collection
    {
        return $this->talents;
    }

    public function addTalent(Talent $talent): self
    {
        if (!$this->talents->contains($talent)) {
            $this->talents[] = $talent;
            $talent->addTalentCategory($this);
        }

        return $this;
    }

    public function removeTalent(Talent $talent): self
    {
        if ($this->talents->removeElement($talent)) {
            $talent->removeTalentCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Company>
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->companies->contains($company)) {
            $this->companies[] = $company;
            $company->addCompanyCategory($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companies->removeElement($company)) {
            $company->removeCompanyCategory($this);
        }

        return $this;
    }
}
