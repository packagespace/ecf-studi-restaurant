<?php

namespace App\Controller\Admin;

use App\Entity\MaximumNumberOfGuests;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class MaximumNumberOfGuestsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MaximumNumberOfGuests::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW, Action::DELETE);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('maximumNumberOfGuests')
        ];
    }
}
