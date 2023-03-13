<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    
    public function configureFields(string $pageName): iterable
    {
        return [
          IdField::new('id')->hideOnForm(),
          TextField::new('pseudo')->hideOnForm(),
          TexTField::new('email'),
          // TexTField::new('password'),
          CollectionField::new('roles')
        //   EmailField::new('email'),
        //   TextEditorField::new('description'),
        ];
     }
}
