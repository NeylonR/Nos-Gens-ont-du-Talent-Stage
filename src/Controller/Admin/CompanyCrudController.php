<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    public function createEntity(string $entityFqcn) {
        $entity = new Company();
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
            TextField::new('name', 'Nom de la société'),
            TextField::new('email', 'Adresse Email'),
            TextField::new('adress', 'Adresse de la société'),
            NumberField::new('phoneNumber','Numéro de télephone'),
            TextEditorField::new('description', 'Description'),
            ImageField::new('image')
            ->setBasePath('images/company_image')
            ->setUploadDir('public/images/company_image'),
            ImageField::new('bannerImage')
            ->setBasePath('images/company_banner')
            ->setUploadDir('public/images/company_banner'),
            AssociationField::new('companyCategory', 'Categories lié à la société'),
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
        ];
    }
    
}
