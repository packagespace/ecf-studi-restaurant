<?php

namespace App\Tests\Unit\OpeningHours\Integration\Functional\Integration\Factory;

use App\Factory\OpeningHourRangeFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OpeningHourRangeFactoryTest extends KernelTestCase
{
    public function testNeverGeneratesAnOpeningHourGreaterThanTheClosingHour(): void
    {
        $kernel = self::bootKernel();

        $openingHourRanges = OpeningHourRangeFactory::createMany(100);

        foreach ($openingHourRanges as $openingHourRange) {
            self::assertGreaterThanOrEqual($openingHourRange->getOpeningTime(), $openingHourRange->getClosingTime());
        }
    }
}
