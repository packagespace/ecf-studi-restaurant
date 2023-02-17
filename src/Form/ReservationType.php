<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'input'  => 'datetime_immutable'
            ])
            ->add('save', SubmitType::class);

        $formModifier = function (FormInterface $form, \DateTimeImmutable $reservationDate = null) {
            $possibleTimes = null === $reservationDate ? [] : [
                1,
                234234,
                2
            ];

            $form
                ->add('time', ChoiceType::class, [
                    'choices' => $possibleTimes
                ])
                ->add('numberOfGuests', IntegerType::class)
                ->add('allergies', TextareaType::class);
        };

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) use ($formModifier) {
                    // this would be your entity, i.e. SportMeetup
                    $data = $event->getData();

                    $formModifier($event->getForm(), $data->getDate());
                }
            );


        $builder->get('date')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $reservation = $event->getForm()->getData();

                $formModifier($event->getForm()->getParent(), $reservation);
            }
        );
//        if ($date) {
//            $builder
//                ->add('time', ChoiceType::class)
//                ->add('numberOfGuests', IntegerType::class)
//                ->add('allergies', TextareaType::class);
//        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
                                   'data_class' => Reservation::class,
                               ]);
    }
}
