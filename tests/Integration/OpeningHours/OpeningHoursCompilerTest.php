<?php

namespace App\Tests\Unit\OpeningHours\Integration\OpeningHours;

use App\Factory\OpeningHourRangeFactory;
use App\OpeningHours\{DayOpeningHours, OpeningHoursCompiler};
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use function PHPUnit\Framework\assertEquals;

class OpeningHoursCompilerTest extends KernelTestCase
{
    public function testReturnsOneLinePerDayInTheDatabase()
    {
        self::bootKernel();
        $container = self::getContainer();
        $compiler = $container->get(OpeningHoursCompiler::class);

        OpeningHourRangeFactory::truncate();
        $openingHours = $compiler->getOpeningHours();

        self::assertContainsOnlyInstancesOf(DayOpeningHours::class, $openingHours);
    }
}
