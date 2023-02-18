<?php

namespace App\Factory;

use App\Entity\DishPhoto;
use App\Repository\DishPhotoRepository;
use Symfony\Component\HttpFoundation\File\File;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<DishPhoto>
 *
 * @method        DishPhoto|Proxy create(array|callable $attributes = [])
 * @method static DishPhoto|Proxy createOne(array $attributes = [])
 * @method static DishPhoto|Proxy find(object|array|mixed $criteria)
 * @method static DishPhoto|Proxy findOrCreate(array $attributes)
 * @method static DishPhoto|Proxy first(string $sortedField = 'id')
 * @method static DishPhoto|Proxy last(string $sortedField = 'id')
 * @method static DishPhoto|Proxy random(array $attributes = [])
 * @method static DishPhoto|Proxy randomOrCreate(array $attributes = [])
 * @method static DishPhotoRepository|RepositoryProxy repository()
 * @method static DishPhoto[]|Proxy[] all()
 * @method static DishPhoto[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static DishPhoto[]|Proxy[] createSequence(array|callable $sequence)
 * @method static DishPhoto[]|Proxy[] findBy(array $attributes)
 * @method static DishPhoto[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static DishPhoto[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class DishPhotoFactory extends ModelFactory
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
            'image' => '150x150-2-500x500.png',
            'title' => self::faker()->word(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(DishPhoto $dishPhoto): void {})
        ;
    }

    protected static function getClass(): string
    {
        return DishPhoto::class;
    }
}
