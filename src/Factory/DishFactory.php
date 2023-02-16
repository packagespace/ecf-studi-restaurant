<?php

namespace App\Factory;

use App\Entity\Dish;
use App\Repository\DishRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Dish>
 *
 * @method        Dish|Proxy create(array|callable $attributes = [])
 * @method static Dish|Proxy createOne(array $attributes = [])
 * @method static Dish|Proxy find(object|array|mixed $criteria)
 * @method static Dish|Proxy findOrCreate(array $attributes)
 * @method static Dish|Proxy first(string $sortedField = 'id')
 * @method static Dish|Proxy last(string $sortedField = 'id')
 * @method static Dish|Proxy random(array $attributes = [])
 * @method static Dish|Proxy randomOrCreate(array $attributes = [])
 * @method static DishRepository|RepositoryProxy repository()
 * @method static Dish[]|Proxy[] all()
 * @method static Dish[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Dish[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Dish[]|Proxy[] findBy(array $attributes)
 * @method static Dish[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Dish[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class DishFactory extends ModelFactory
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
            'category' => DishCategoryFactory::new(),
            'name' => self::faker()->sentence(3),
            'price' => self::faker()->numberBetween(1, 50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Dish $dish): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Dish::class;
    }
}
