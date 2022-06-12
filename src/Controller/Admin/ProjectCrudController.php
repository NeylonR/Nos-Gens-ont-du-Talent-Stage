<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Form\ProjectTextType;
use App\Form\ProjectImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\FormTypeInterface;

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
            ImageField::new('bannerImage')
            ->setBasePath('images/project_banner')
            ->setUploadDir('public/images/project_banner'),
            CollectionField::new('projectText')
            ->setEntryType(ProjectTextType::class)
            ->onlyOnForms(),
            CollectionField::new('projectImage')
            ->setEntryType(ProjectImageType::class)
            ->setFormTypeOption('by_reference', false)
            ->onlyOnForms(),
            TextField::new('videoLink','Url de la vidéo'),
            TextField::new('link','Url du projet'),
            AssociationField::new('status', 'Status actuel du projet'),
            AssociationField::new('projectCompany', 'Société lié projet'),
            AssociationField::new('projectTalent', 'Talent lié projet'),
        ];
    }
    
}
