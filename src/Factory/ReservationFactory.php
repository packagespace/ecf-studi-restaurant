<?php

namespace App\Factory;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use App\TimeSlotFactory;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Reservation>
 *
 * @method        Reservation|Proxy create(array|callable $attributes = [])
 * @method static Reservation|Proxy createOne(array $attributes = [])
 * @method static Reservation|Proxy find(object|array|mixed $criteria)
 * @method static Reservation|Proxy findOrCreate(array $attributes)
 * @method static Reservation|Proxy first(string $sortedField = 'id')
 * @method static Reservation|Proxy last(string $sortedField = 'id')
 * @method static Reservation|Proxy random(array $attributes = [])
 * @method static Reservation|Proxy randomOrCreate(array $attributes = [])
 * @method static ReservationRepository|RepositoryProxy repository()
 * @method static Reservation[]|Proxy[] all()
 * @method static Reservation[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Reservation[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Reservation[]|Proxy[] findBy(array $attributes)
 * @method static Reservation[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Reservation[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ReservationFactory extends ModelFactory
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
        return [
            'date' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'numberOfGuests' => self::faker()->randomNumber(),
            'time' => TimeSlotFactory::generateTimeSlot(),
            'allergies' => self::faker()->optional()->text()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Reservation $reservation): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Reservation::class;
    }
}
