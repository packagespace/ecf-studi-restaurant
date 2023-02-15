<?php

namespace App\Controller\Admin;

use App\Entity\DishPhoto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DishPhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DishPhoto::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            ImageField::new('image')->setUploadDir('public/images/dishes')->setBasePath('images/dishes')
        ];
    }

}