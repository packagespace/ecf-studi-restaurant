<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ValidDayOpeningHour extends Constraint
{
    public string $lunchNeedsBothClosingAndOpeningTimeOrNeitherMessage = 'Lunch needs both closing and opening time';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}