<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\BlogCategory;

use BlogPlugin\Core\Content\BlogPlugin\Blog\BlogDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogMapping\BlogMappingDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogCategoryDefinition extends EntityDefinition
{
    const ENTITY_NAME = 'blog_plugin_blog_categories';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'int', true, true))->addFlags(new PrimaryKey()),
            new StringField('name', 'name'),
            new ManyToManyAssociationField(
                'blogs',
                BlogDefinition::class,
                BlogMappingDefinition::class,
                'blog_plugin_blog_category_id',
                'blog_plugin_blog_id'
            )
        ]);
    }
}
