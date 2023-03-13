<?php

namespace App\Controller\Admin;

use App\Entity\Music;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class MusicCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Music::class;
    }


    public function configureFields(string $pageName): iterable
    {

        yield TextField::new('genre');
        yield TextField::new('artist');
        yield TextField::new('title');
        yield TextField::new('song')->hideOnForm();
        yield TextField::new('songFile')
        ->setFormType(VichFileType::class)
        ->hideOnIndex();
        //       ->setBasePath('uploads/')
        //       ->setUploadDir('public/uploads/music');
        // //    ->setSortable(false);
        yield imageField::new('cover')
        ->setBasePath('uploads/')
        ->setUploadDir('public/uploads');

        yield AssociationField::new('category');
        // yield SlugField::new('slug')->setTargetFieldName('genre'); 
        
    }
}
