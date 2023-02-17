<?php

namespace App\Factory;

use App\Entity\OpeningHourRange;
use App\Repository\OpeningHourRangeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<OpeningHourRange>
 *
 * @method        OpeningHourRange|Proxy create(array|callable $attributes = [])
 * @method static OpeningHourRange|Proxy createOne(array $attributes = [])
 * @method static OpeningHourRange|Proxy find(object|array|mixed $criteria)
 * @method static OpeningHourRange|Proxy findOrCreate(array $attributes)
 * @method static OpeningHourRange|Proxy first(string $sortedField = 'id')
 * @method static OpeningHourRange|Proxy last(string $sortedField = 'id')
 * @method static OpeningHourRange|Proxy random(array $attributes = [])
 * @method static OpeningHourRange|Proxy randomOrCreate(array $attributes = [])
 * @method static OpeningHourRangeRepository|RepositoryProxy repository()
 * @method static OpeningHourRange[]|Proxy[] all()
 * @method static OpeningHourRange[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static OpeningHourRange[]|Proxy[] createSequence(array|callable $sequence)
 * @method static OpeningHourRange[]|Proxy[] findBy(array $attributes)
 * @method static OpeningHourRange[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static OpeningHourRange[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class OpeningHourRangeFactory extends ModelFactory
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
        $openingTime = \DateTimeImmutable::createFromFormat('H:i', self::faker()->time('H:i'));
        $closingTime = \DateTimeImmutable::createFromFormat('H:i', self::faker()->time('H:i'));

        if ($openingTime > $closingTime) {
            $tmp = $openingTime;
            $openingTime = $closingTime;
            $closingTime = $tmp;
        }

        return [
            'closingTime' => $closingTime,
            'day' => strtolower(self::faker()->dayOfWeek()),
            'openingTime' => $openingTime,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this// ->afterInstantiate(function(OpeningHourRange $openingHourRange): void {})
            ;
    }

    protected static function getClass(): string
    {
        return OpeningHourRange::class;
    }
}
