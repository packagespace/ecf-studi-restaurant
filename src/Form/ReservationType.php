<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Repository\DayOpeningHoursRepository;
use App\TimeSlotFormatter;
use App\TimeSlotGetter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{

    private ?int $numberOfGuests;

    public function __construct(
        private readonly TimeSlotGetter            $timeSlotGetter,
        private readonly TimeSlotFormatter         $timeSlotFormatter,
        private readonly DayOpeningHoursRepository $dayOpeningHoursRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numberOfGuests', IntegerType::class);


        $builder->add('date', DateType::class, [
            'input'  => 'datetime_immutable',
            'widget' => 'single_text',
            'html5'  => false,
            'attr'   => [
                'data-controller'               => "flatpickr",
                'data-flatpickr-disable-mobile' => true,
                'data-flatpickr-min-date'       => (new \DateTimeImmutable())->format('Y-m-d'),
                'data-flatpickr-max-date'       => (new \DateTimeImmutable())->add(\DateInterval::createFromDateString('1 year'))->format('Y-m-d')
            ]
        ]);
        $builder->add('allergies', TextareaType::class, [
            'required' => false
        ]);
        $builder->add('confirm', SubmitType::class);

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($builder) {
                $date = $event->getData()?->getDate();
                $this->addTimeSlotPicker($event->getForm(), $date);
            }
        );

        $builder->get('numberOfGuests')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($builder) {
                $this->numberOfGuests = $event->getForm()->getData();
            }
        );

        $builder->get('date')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($builder) {
                $date = $event->getForm()->getData();
                $this->addTimeSlotPicker($event->getForm()->getParent(), $date);
            }
        );
    }

    public function addTimeSlotPicker(FormInterface $form, ?\DateTimeImmutable $date)
    {
        $timeSlots = (null === $date || null === $this->numberOfGuests) ? []
            : $this->timeSlotGetter->getAvailableTimeSlots($this->numberOfGuests, $date);;
        $form->add('time', ChoiceType::class, [
            'choices'     => array_combine($this->timeSlotFormatter->getHumanReadableTimeSlotArray($timeSlots),
                                           $timeSlots),
            'disabled'    => null === $date || null === $this->numberOfGuests || [] === $timeSlots,
            'placeholder' => $date && $this->numberOfGuests && [] === $timeSlots ? 'No available slots' : null
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Reservation::class]);
    }
}