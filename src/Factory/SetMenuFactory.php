<?php

namespace App\Factory;

use App\Entity\SetMenu;
use App\Repository\SetMenuRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<SetMenu>
 *
 * @method        SetMenu|Proxy create(array|callable $attributes = [])
 * @method static SetMenu|Proxy createOne(array $attributes = [])
 * @method static SetMenu|Proxy find(object|array|mixed $criteria)
 * @method static SetMenu|Proxy findOrCreate(array $attributes)
 * @method static SetMenu|Proxy first(string $sortedField = 'id')
 * @method static SetMenu|Proxy last(string $sortedField = 'id')
 * @method static SetMenu|Proxy random(array $attributes = [])
 * @method static SetMenu|Proxy randomOrCreate(array $attributes = [])
 * @method static SetMenuRepository|RepositoryProxy repository()
 * @method static SetMenu[]|Proxy[] all()
 * @method static SetMenu[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static SetMenu[]|Proxy[] createSequence(array|callable $sequence)
 * @method static SetMenu[]|Proxy[] findBy(array $attributes)
 * @method static SetMenu[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static SetMenu[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class SetMenuFactory extends ModelFactory
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
            'description' => self::faker()->sentence(),
            'price' => self::faker()->numberBetween(10,100),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(SetMenu $setMenu): void {})
        ;
    }

    protected static function getClass(): string
    {
        return SetMenu::class;
    }
}
