<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
             IdField::new('id')->hideOnForm(),
             TextField::new('category'),
             ImageField::new('picture')
               ->setBasePath('uploads/')
               ->setUploadDir('public/uploads/')
               ->setUploadedFileNamePattern('foo/[randomhash].[extension]'),

            //  AssociationField::new('category'),
            
        ];
    }
    
}
