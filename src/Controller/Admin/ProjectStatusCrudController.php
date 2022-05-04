<?php

namespace App\Controller\Admin;

use App\Entity\ProjectStatus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectStatusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectStatus::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
