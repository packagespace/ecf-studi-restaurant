<?php

namespace App\Factory;

use App\Entity\DishCategory;
use App\Repository\DishCategoryRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<DishCategory>
 *
 * @method        DishCategory|Proxy create(array|callable $attributes = [])
 * @method static DishCategory|Proxy createOne(array $attributes = [])
 * @method static DishCategory|Proxy find(object|array|mixed $criteria)
 * @method static DishCategory|Proxy findOrCreate(array $attributes)
 * @method static DishCategory|Proxy first(string $sortedField = 'id')
 * @method static DishCategory|Proxy last(string $sortedField = 'id')
 * @method static DishCategory|Proxy random(array $attributes = [])
 * @method static DishCategory|Proxy randomOrCreate(array $attributes = [])
 * @method static DishCategoryRepository|RepositoryProxy repository()
 * @method static DishCategory[]|Proxy[] all()
 * @method static DishCategory[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static DishCategory[]|Proxy[] createSequence(array|callable $sequence)
 * @method static DishCategory[]|Proxy[] findBy(array $attributes)
 * @method static DishCategory[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static DishCategory[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class DishCategoryFactory extends ModelFactory
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
            'name' => self::faker()->sentence(3),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(DishCategory $dishCategory): void {})
        ;
    }

    protected static function getClass(): string
    {
        return DishCategory::class;
    }
}
