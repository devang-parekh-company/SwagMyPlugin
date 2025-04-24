<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\Blog\Aggregate;

use BlogPlugin\Core\Content\BlogPlugin\Blog\BlogDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogTranslationDefinition extends  EntityTranslationDefinition
{
    const ENTITY_NAME = 'blog_plugin_blog_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getParentDefinitionClass(): string
    {
        return BlogDefinition::class;
    }

    public function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey()),
            (new StringField('name', 'name')),
            (new StringField('description', 'description')),
        ]);
    }
    // public function getEntityClass(): string
    // {
    //     return BlogTranslationEntity::class;
    // }
}
