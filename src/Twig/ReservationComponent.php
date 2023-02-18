<?php

namespace App\Twig;

use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('reservation_form')]
class ReservationComponent extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;

//    #[LiveProp(fieldName: 'data')]
//    public ?Reservation $reservation = null;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(ReservationType::class/*, $this->reservation*/);
    }
}