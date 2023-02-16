<?php

namespace App\Controller\Admin;

use App\Entity\SetMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SetMenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SetMenu::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('description'),
            IntegerField::new('price'),
            AssociationField::new('menu')
                ->setFormTypeOption('choice_label', 'name')
                ->formatValue(fn($value, SetMenu $entity) => $entity->getMenu()?->getName())
        ];
    }

}
