<?php

namespace App\Tests\Integration\Validator;

use App\Entity\DayOpeningHours;
use App\Factory\DayOpeningHoursFactory;
use App\Validator\ValidDayOpeningHour;
use App\Validator\ValidDayOpeningHourValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class ValidDayOpeningHourValidatorTest extends ConstraintValidatorTestCase
{

    public function testValidate()
    {
        $this->validator->validate(DayOpeningHoursFactory::createOne([
            'lunchOpeningTime' => null,
            'lunchClosingTime' => 3
                                                                     ])->object(), new ValidDayOpeningHour());

        $this->assertNoViolation();
    }

    protected function createValidator()
    {
        return new ValidDayOpeningHourValidator();
    }
}
