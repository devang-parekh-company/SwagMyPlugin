<?php declare(strict_types=1);

namespace PluginTest\Core\Content\PluginTest\Aggregate;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @package core
 * @method void                add(PluginTestTranslationEntity $entity)
 * @method void                set(string $key, PluginTestTranslationEntity $entity)
 * @method PluginTestTranslationEntity[]    getIterator()
 * @method PluginTestTranslationEntity[]    getElements()
 * @method PluginTestTranslationEntity|null get(string $key)
 * @method PluginTestTranslationEntity|null first()
 * @method PluginTestTranslationEntity|null last()
 */
class PluginTestTranslationCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return PluginTestTranslationEntity::class;
    }
}