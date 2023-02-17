<?php

namespace App\Controller\Admin;

use App\Entity\OpeningHourRange;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class OpeningHourRangeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningHourRange::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('day')
                ->setChoices([
                                 'Lundi'    => 'monday',
                                 'Mardi'    => 'tuesday',
                                 'Mercredi' => 'wednesday',
                                 'Jeudi'    => 'thursday',
                                 'Vendredi' => 'friday',
                                 'Samedi'   => 'saturday',
                                 'Dimanche' => 'sunday'
                             ])
                ->renderExpanded(),
            IntegerField::new('openingTime'),
            IntegerField::new('closingTime'),
        ];
    }

}
