<?php

namespace App\Controller\Admin;

use App\Entity\Talent;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class TalentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Talent::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName', 'Prénom'),
            TextField::new('lastName', 'Nom'),
            TextField::new('email', 'Adresse Email'),
            TextEditorField::new('description', 'Description'),
            NumberField::new('phoneNumber','Numéro de télephone'),
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
