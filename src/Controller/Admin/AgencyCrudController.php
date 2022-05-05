<?php

namespace App\Controller\Admin;

use App\Entity\Agency;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AgencyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Agency::class;
    }

    public function createEntity(string $entityFqcn) {
        $entity = new Agency();
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
            AssociationField::new('agencyCategory', 'Categories lié à l\'agence'),
            AssociationField::new('agencyAssociate', 'Talent lié à l\'agence'),
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
            // AssociationField::new('agencyAssociate', 'Talent lié à l\'agence')->formatValue(function ($value, $entity) {
            //     return $entity->getAgencyAssociate();
            // }),
            
        ];
    }
    
}
