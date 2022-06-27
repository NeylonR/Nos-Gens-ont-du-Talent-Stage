<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
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

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bannerImage;

    /** 
     * @Vich\UploadableField(mapping= "project_banner", fileNameProperty="bannerImage")
     */
    private $bannerFile; 

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectTextContent::class, orphanRemoval: true)]
    private $projectText;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $videoLink;

    // #[ORM\Column(type: 'string', length: 255, nullable: true)]
    // private $projectImage;

    public function __construct()
    {
        $this->projectCompany = new ArrayCollection();
        $this->projectTalent = new ArrayCollection();
        $this->projectText = new ArrayCollection();
        $this->projectImage = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getBannerImage(): ?string
    {
        return $this->bannerImage;
    }

    public function setBannerImage(?string $bannerImage): self
    {
        $this->bannerImage = $bannerImage;

        return $this;
    }

    public function getBannerFile(): ?File
    {
        return $this->bannerFile;
    }

    public function setBannerFile(?File $bannerFile = null): void
    {
        $this->bannerFile = $bannerFile;
 
        if($bannerFile !== null){
            $this->updatedAt = new \DateTime();
        }

        return;
    }

    /**
     * old: @ return Collection<int, projectTextContent> + no ? before Collection
     * @return Collection<int|null, projectTextContent>
     */
    public function getProjectText(): ?Collection
    {
        return $this->projectText;
    }

    public function addProjectText(projectTextContent $projectText): self
    {
        if (!$this->projectText->contains($projectText)) {
            $this->projectText[] = $projectText;
            $projectText->setProject($this);
        }

        return $this;
    }

    public function removeProjectText(projectTextContent $projectText): self
    {
        if ($this->projectText->removeElement($projectText)) {
            // set the owning side to null (unless already changed)
            if ($projectText->getProject() === $this) {
                $projectText->setProject(null);
            }
        }

        return $this;
    }

    /**
     * old : @ return Collection<int, projectImage> + no ? before Collection
     * @return Collection<int|projectImage[]|null
     */
    public function getProjectImage(): ?Collection
    {
        return $this->projectImage;
    }

    public function addProjectImage(projectImage $projectImage): self
    {
        if (!$this->projectImage->contains($projectImage)) {
            $this->projectImage[] = $projectImage;
            $projectImage->setProject($this);
        }

        return $this;
    }

    public function removeProjectImage(projectImage $projectImage): self
    {
        if ($this->projectImage->removeElement($projectImage)) {
            // set the owning side to null (unless already changed)
            if ($projectImage->getProject() === $this) {
                $projectImage->setProject(null);
            }
        }

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    public function setVideoLink(?string $videoLink): self
    {
        $this->videoLink = $videoLink;

        return $this;
    }
}
