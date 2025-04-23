<?php declare(strict_types=1);

namespace PluginTest\Core\Content\PluginTest;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @package core
 * @method void                add(PluginTestEntity $entity)
 * @method void                set(string $key, PluginTestEntity $entity)
 * @method PluginTestEntity[]    getIterator()
 * @method PluginTestEntity[]    getElements()
 * @method PluginTestEntity|null get(string $key)
 * @method PluginTestEntity|null first()
 * @method PluginTestEntity|null last()
 */
class PluginTestCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return PluginTestEntity::class;
    }
}