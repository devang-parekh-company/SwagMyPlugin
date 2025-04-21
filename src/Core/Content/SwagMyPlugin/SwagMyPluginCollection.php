<?php

declare(strict_types=1);

namespace SwagMyPlugin\Core\Content\SwagMyPlugin;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

class SwagMyPluginCollection extends EntityCollection
{
    /**
     *
     * @method void add(SwagMyPluginEntity $entity)
     * @method void set(strign $key, SwagMyPluginEntity $entity)
     * @method SwagMyPluginEntity[] getIterator()
     * @method SwagMyPluginEntity[] getElements()
     * @method SwagMyPluginEntity|null get(string $key)
     * @method SwagMyPluginEntity|null first()
     * @method SwagMyPluginEntity|null last()
     */
    protected function getExpectedClass(): string
    {
        return SwagMyPluginEntity::class;
    }
}
