<?php

namespace App\Entity;

use App\Entity\Talent;
use App\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AgencyRepository;
use Vich\UploaderBundle\Entity\File;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AgencyRepository::class)]
/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Agency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $adress;

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

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'agencies')]
    private $agencyCategory;

    #[ORM\ManyToMany(targetEntity: Talent::class, inversedBy: 'agencies')]
    private $agencyAssociate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    /** 
     * @Vich\UploadableField(mapping= "agency_image", fileNameProperty="image")
     */
    private $imageFile;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bannerImage;

    /** 
     * @Vich\UploadableField(mapping= "agency_banner", fileNameProperty="bannerImage")
     */
    private $bannerFile;

    public function __construct()
    {
        $this->agencyCategory = new ArrayCollection();
        $this->agencyAssociate = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

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

    /**
     * @return Collection<int, Category>
     */
    public function getAgencyCategory(): Collection
    {
        return $this->agencyCategory;
    }

    public function addAgencyCategory(Category $agencyCategory): self
    {
        if (!$this->agencyCategory->contains($agencyCategory)) {
            $this->agencyCategory[] = $agencyCategory;
        }

        return $this;
    }

    public function removeAgencyCategory(Category $agencyCategory): self
    {
        $this->agencyCategory->removeElement($agencyCategory);

        return $this;
    }

    /**
     * @return Collection<int, Talent>
     */
    public function getAgencyAssociate(): Collection
    {
        return $this->agencyAssociate;
    }

    public function addAgencyAssociate(Talent $agencyAssociate): self
    {
        if (!$this->agencyAssociate->contains($agencyAssociate)) {
            $this->agencyAssociate[] = $agencyAssociate;
        }

        return $this;
    }

    public function removeAgencyAssociate(Talent $agencyAssociate): self
    {
        $this->agencyAssociate->removeElement($agencyAssociate);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
 
        if($imageFile !== null){
            $this->updatedAt = new \DateTime();
        }

        return;
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
}
