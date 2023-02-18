<?php

namespace App\Validator;

use App\Entity\DayOpeningHours;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ValidDayOpeningHourValidator extends ConstraintValidator
{

    /**
     * @param DayOpeningHours $dayOpeningHours
     */
    public function validate($dayOpeningHours, Constraint $constraint)
    {
        if (!$dayOpeningHours instanceof DayOpeningHours) {
            throw new UnexpectedValueException($dayOpeningHours, DayOpeningHours::class);
        }

        if (!$constraint instanceof ValidDayOpeningHour) {
            throw new UnexpectedTypeException($constraint, ValidDayOpeningHour::class);
        }

        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        if ((!$dayOpeningHours->getLunchOpeningTime() && $dayOpeningHours->getLunchClosingTime())
            || ($dayOpeningHours->getLunchOpeningTime() && !$dayOpeningHours->getLunchClosingTime())) {
            $this->context
                ->buildViolation($constraint->lunchNeedsBothClosingAndOpeningTimeOrNeitherMessage)
                ->atPath('lunchOpeningTime')
                ->atPath('lunchClosingTime')
                ->addViolation();
        }

            if ($dayOpeningHours->getLunchOpeningTime() > $dayOpeningHours->getLunchClosingTime()) {

            }


    }
}