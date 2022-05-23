<?php

namespace App\Controller\Admin;

use App\Entity\Talent;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TalentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Talent::class;
    }

    public function createEntity(string $entityFqcn) {
        $entity = new Talent();
        $entity->setWebLink('http://www.')
        ->setFacebookLink('http://www.')
        ->setTwitterLink('http://www.')
        ->setYoutubeLink('http://www.')
        ->setLinkedinLink('http://www.')
        ->setInstagramLink('http://www.')
        ;
        return $entity;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName', 'Prénom')->setMaxLength(10),
            TextField::new('lastName', 'Nom'),
            TextField::new('email', 'Adresse Email'),
            TextEditorField::new('description', 'Description'),
            ImageField::new('image')
            ->setBasePath('images/talent_image')
            ->setUploadDir('public/images/talent_image'),
            ImageField::new('bannerImage')
            ->setBasePath('images/talent_banner')
            ->setUploadDir('public/images/talent_banner'),
            // Field::new('imageFile')
            // ->setFormType(VichImageType::class)
            // ->hideOnIndex(),
            IntegerField::new('phoneNumber','Numéro de télephone'),
            AssociationField::new('talentCategory', 'Categories lié au talent'),
            TextField::new('webLink', 'Lien du site web'),
            TextField::new('facebookLink', 'Lien profil Facebook')
            ->hideOnIndex(),
            TextField::new('twitterLink', 'Lien profil Twitter')
            ->hideOnIndex(),
            TextField::new('youtubeLink', 'Lien profil Youtube')
            ->hideOnIndex(),
            TextField::new('linkedinLink', 'Lien profil Linkedin')
            ->hideOnIndex(),
            TextField::new('instagramLink', 'Lien profil Instagram')
            ->hideOnIndex(),
            BooleanField::new('ourTalent','Talent de notre équipe'),
        ];
    }
    
}
