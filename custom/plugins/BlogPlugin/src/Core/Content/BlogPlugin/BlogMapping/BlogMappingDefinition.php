<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\BlogMapping;

use BlogPlugin\Core\Content\BlogPlugin\Blog\BlogDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogCategory\BlogCategoryDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogMappingDefinition extends  EntityDefinition
{
    const ENTITY_NAME = 'blog_plugin_blog_mapping_categories';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('blog_plugin_blog_id', 'blogPluginBlogId', BlogDefinition::class))->addFlags(new Required(), new PrimaryKey()),
            (new FkField('blog_plugin_blog_category_id', 'blogPluginBlogCategoryId', BlogCategoryDefinition::class))->addFlags(new Required(), new PrimaryKey()),
            
            new ManyToOneAssociationField('blogPluginBlog', 'blog_plugin_blog_id', BlogDefinition::class),
            new ManyToOneAssociationField('blogPluginBlogCategory', 'blog_plugin_blog_category_id', BlogCategoryDefinition::class),
        ]);
    }
}

