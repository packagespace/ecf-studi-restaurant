<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use App\TimeSlotFormatter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ReservationCrudController extends AbstractCrudController
{


    public function __construct(private readonly TimeSlotFormatter $timeSlotFormatter)
    {
    }

    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('date'),
            IntegerField::new('numberOfGuests'),
            TextareaField::new('allergies'),
            IntegerField::new('time')->formatValue(fn($time) => $this->timeSlotFormatter->getHumanReadableTimeSlot($time))
        ];
    }

}
