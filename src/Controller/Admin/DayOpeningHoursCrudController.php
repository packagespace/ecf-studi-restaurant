<?php

namespace App\Controller\Admin;

use App\Entity\DayOpeningHours;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class DayOpeningHoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DayOpeningHours::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('dayOfWeek')
                ->setChoices([
                                 'Lundi'    => 'monday',
                                 'Mardi'    => 'tuesday',
                                 'Mercredi' => 'wednesday',
                                 'Jeudi'    => 'thursday',
                                 'Vendredi' => 'friday',
                                 'Samedi'   => 'saturday',
                                 'Dimanche' => 'sunday'
                             ]),
            IntegerField::new('lunchOpeningTime'),
            IntegerField::new('lunchClosingTime'),
            IntegerField::new('dinnerOpeningTime'),
            IntegerField::new('dinnerClosingTime'),
        ];
    }

}
