<?php

declare(strict_types=1);

namespace PluginTest\Core\Content\PluginTest;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

class PluginTestCollection extends EntityCollection
{
    /**
     *
     * @method void add(PluginTestEntity $entity)
     * @method void set(strign $key, PluginTestEntity $entity)
     * @method PluginTestEntity[] getIterator()
     * @method PluginTestEntity[] getElements()
     * @method PluginTestEntity|null get(string $key)
     * @method PluginTestEntity|null first()
     * @method PluginTestEntity|null last()
     */
    protected function getExpectedClass(): string
    {
        return PluginTestEntity::class;
    }
}
