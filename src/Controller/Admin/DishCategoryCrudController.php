<?php

namespace App\Controller\Admin;

use App\Entity\Dish;
use App\Entity\DishCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DishCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DishCategory::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('dishes')
                ->setFormTypeOption('choice_label', 'name')
                ->setFormTypeOption('by_reference', false)
        ];
    }

}
