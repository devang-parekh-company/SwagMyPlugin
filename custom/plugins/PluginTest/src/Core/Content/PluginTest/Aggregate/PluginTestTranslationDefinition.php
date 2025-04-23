<?php

declare(strict_types=1);

namespace PluginTest\Core\Content\PluginTest\Aggregate;

use PluginTest\Core\Content\PluginTest\PluginTestDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class PluginTestTranslationDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'plugin_test_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getParentDefinitionClass(): string
    {
        return PluginTestDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id','id'))->addFlags(new PrimaryKey()),
            (new FkField('plugin_test_id', 'pluginTestId', PluginTestDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            new StringField('name', 'name'),
            new StringField('city', 'city'),
        ]);
    }

    public function getCollectionClass(): string
    {
        return PluginTestTranslationCollection::class;
    }
    public function getEntityClass(): string
    {
        return PluginTestTranslationEntity::class;
    }
}
