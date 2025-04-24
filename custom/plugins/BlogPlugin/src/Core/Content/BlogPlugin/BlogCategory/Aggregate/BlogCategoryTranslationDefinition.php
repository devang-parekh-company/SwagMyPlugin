<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\BlogCategory\Aggregate;

use BlogPlugin\Core\Content\BlogPlugin\Blog\BlogDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogCategory\BlogCategoryDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogCategoryTranslationDefinition extends  EntityTranslationDefinition
{
    const ENTITY_NAME = 'blog_plugin_blog_category_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getParentDefinitionClass(): string
    {
        return BlogCategoryDefinition::class;
    }

    public function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey()),
            (new FkField('blog_plugin_blog__category_id', 'blogPluginBlogCategoryId', BlogCategoryDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            (new StringField('name', 'name')),
        ]);
    }
    // public function getEntityClass(): string
    // {
    //     return BlogTranslationEntity::class;
    // }
}
