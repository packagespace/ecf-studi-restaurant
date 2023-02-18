<?php

namespace App\Factory;

use App\Entity\DayOpeningHours;
use App\Repository\DayOpeningHoursRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<DayOpeningHours>
 *
 * @method        DayOpeningHours|Proxy create(array|callable $attributes = [])
 * @method static DayOpeningHours|Proxy createOne(array $attributes = [])
 * @method static DayOpeningHours|Proxy find(object|array|mixed $criteria)
 * @method static DayOpeningHours|Proxy findOrCreate(array $attributes)
 * @method static DayOpeningHours|Proxy first(string $sortedField = 'id')
 * @method static DayOpeningHours|Proxy last(string $sortedField = 'id')
 * @method static DayOpeningHours|Proxy random(array $attributes = [])
 * @method static DayOpeningHours|Proxy randomOrCreate(array $attributes = [])
 * @method static DayOpeningHoursRepository|RepositoryProxy repository()
 * @method static DayOpeningHours[]|Proxy[] all()
 * @method static DayOpeningHours[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static DayOpeningHours[]|Proxy[] createSequence(array|callable $sequence)
 * @method static DayOpeningHours[]|Proxy[] findBy(array $attributes)
 * @method static DayOpeningHours[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static DayOpeningHours[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class DayOpeningHoursFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $openForLunch = self::faker()->boolean;
        $openForDinner = self::faker()->boolean;

        return [
            'dayOfWeek'         => self::faker()->text(255),
            'lunchOpeningTime'  => $openForLunch ? self::faker()->numberBetween(0, 23) : null,
            'lunchClosingTime'  => $openForLunch ? self::faker()->numberBetween(0, 23) : null,
            'dinnerOpeningTime' => $openForDinner ? self::faker()->numberBetween(0, 23) : null,
            'dinnerClosingTime' => $openForDinner ? self::faker()->numberBetween(0, 23) : null,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this// ->afterInstantiate(function(DayOpeningHours $dayOpeningHours): void {})
            ;
    }

    protected static function getClass(): string
    {
        return DayOpeningHours::class;
    }
}
