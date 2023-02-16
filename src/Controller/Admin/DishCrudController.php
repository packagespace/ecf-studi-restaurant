<?php

namespace App\Controller\Admin;

use App\Entity\Dish;
use App\Entity\DishCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DishCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dish::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            IntegerField::new('price'),
            AssociationField::new('category')
                ->setFormTypeOption('choice_label', 'name')
                ->formatValue(fn($value, Dish $entity) => $entity->getCategory()?->getName())
        ];
    }

}
