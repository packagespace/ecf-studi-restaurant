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
////                // prevents rendering it as type="date", to avoid HTML5 date pickers
////                'html5' => false,
////
////                // adds a class that can be selected in JavaScript
////                'attr' => ['class' => 'js-datepicker'],
//            ->add('time', ChoiceType::class, [
////                'choices' => $possibleTimes
//            ])
            ->add('numberOfGuests', IntegerType::class, [
            ]);
//            ->add('allergies', TextareaType::class)
//            ->add('save', SubmitType::class);

        $builder->addEventListener(FormEvents::SUBMIT,
            function (FormEvent $event) use ($builder) {
                $form = $event->getForm();
                $numberOfGuests = $form->getData();
//                $form->remove('date');
                $form->add('date', DateType::class, [
                    'widget' => 'single_text',
                    'input'  => 'datetime_immutable',
                ]);
            });

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
                                   'data_class' => Reservation::class,
                               ]);
    }
}
