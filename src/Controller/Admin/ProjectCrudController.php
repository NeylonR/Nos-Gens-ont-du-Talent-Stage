<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name','Nom du projet'),
            TextEditorField::new('description','Description'),
            TextField::new('link','Url du projet'),
            AssociationField::new('status', 'Status actuel du projet'),
            AssociationField::new('projectCompany', 'Société lié projet'),
            AssociationField::new('projectTalent', 'Talent lié projet'),
        ];
    }
    
}
