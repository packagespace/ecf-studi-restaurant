<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public const MEAL_BREAKFAST = 'breakfast';
    public const MEAL_SECOND_BREAKFAST = 'second breakfast';
    public const MEAL_ELEVENSES = 'elevenses';
    public const MEAL_LUNCH = 'lunch';
    public const MEAL_DINNER = 'dinner';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numberOfGuests', IntegerType::class);

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {

                /** @var Reservation $data */
                $data = $event->getData();

                $numberOfGuests = $data?->getNumberOfGuests();
                $this->addDatePicker($event->getForm(), $numberOfGuests);
            }
        );

        $builder->get('numberOfGuests')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $numberOfGuests = $event->getForm()->getData();
                $this->addDatePicker($event->getForm()->getParent(), $numberOfGuests);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Reservation::class]);
    }

    private function getAvailableFoodChoices(string $meal): array
    {


        return [1,2,3];
    }

    public function addDatePicker(FormInterface $form, ?string $numberOfGuests)
    {
        $foodChoices = null === $numberOfGuests ? [] : $this->getAvailableFoodChoices($numberOfGuests);

        $form->add('date', DateType::class, [
            'disabled' => null === $numberOfGuests,
        ]);
    }
}