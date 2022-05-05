<?php

namespace App\Entity;

use App\Repository\TalentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TalentRepository::class)]
class Talent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'integer')]
    private $phoneNumber;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $webLink;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $facebookLink;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $twitterLink;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $youtubeLink;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $linkedinLink;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $instagramLink;

    #[ORM\Column(type: 'boolean')]
    private $ourTalent;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'talents')]
    private $talentCategory;

    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'projectTalent')]
    private $projects;

    #[ORM\ManyToMany(targetEntity: Agency::class, mappedBy: 'agencyAssociate')]
    private $agencies;

    public function __construct()
    {
        $this->talentCategory = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->agencies = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->firstName . " " . $this->lastName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

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
    public function getWebLink(): ?string
    {
        return $this->webLink;
    }

    public function setWebLink(string $webLink): self
    {
        $this->webLink = $webLink;

        return $this;
    }

    public function getFacebookLink(): ?string
    {
        return $this->facebookLink;
    }

    public function setFacebookLink(?string $facebookLink): self
    {
        $this->facebookLink = $facebookLink;

        return $this;
    }

    public function getTwitterLink(): ?string
    {
        return $this->twitterLink;
    }

    public function setTwitterLink(?string $twitterLink): self
    {
        $this->twitterLink = $twitterLink;

        return $this;
    }

    public function getYoutubeLink(): ?string
    {
        return $this->youtubeLink;
    }

    public function setYoutubeLink(?string $youtubeLink): self
    {
        $this->youtubeLink = $youtubeLink;

        return $this;
    }

    public function getLinkedinLink(): ?string
    {
        return $this->linkedinLink;
    }

    public function setLinkedinLink(?string $linkedinLink): self
    {
        $this->linkedinLink = $linkedinLink;

        return $this;
    }

    public function getInstagramLink(): ?string
    {
        return $this->instagramLink;
    }

    public function setInstagramLink(?string $instagramLink): self
    {
        $this->instagramLink = $instagramLink;

        return $this;
    }

    public function getOurTalent(): ?bool
    {
        return $this->ourTalent;
    }

    public function setOurTalent(bool $ourTalent): self
    {
        $this->ourTalent = $ourTalent;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getTalentCategory(): Collection
    {
        return $this->talentCategory;
    }

    public function addTalentCategory(Category $talentCategory): self
    {
        if (!$this->talentCategory->contains($talentCategory)) {
            $this->talentCategory[] = $talentCategory;
        }

        return $this;
    }

    public function removeTalentCategory(Category $talentCategory): self
    {
        $this->talentCategory->removeElement($talentCategory);

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addProjectTalent($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            $project->removeProjectTalent($this);
        }

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
            $agency->addAgencyAssociate($this);
        }

        return $this;
    }

    public function removeAgency(Agency $agency): self
    {
        if ($this->agencies->removeElement($agency)) {
            $agency->removeAgencyAssociate($this);
        }

        return $this;
    }
}
