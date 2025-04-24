<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\BlogCategory;

use BlogPlugin\Core\Content\BlogPlugin\Blog\BlogDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogCategory\Aggregate\BlogCategoryTranslationDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogMapping\BlogMappingDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
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
            (new IdField('id', 'id'))->addFlags(new PrimaryKey()),
            new TranslatedField('name', 'name'),
            (new TranslationsAssociationField(BlogCategoryTranslationDefinition::class, 'blog_plugin_blog_id')),

            
            new ManyToManyAssociationField(
                'blog_plugin_blogs',
                BlogDefinition::class,
                BlogMappingDefinition::class,
                'blog_plugin_blog_category_id',
                'blog_plugin_blog_id'
            ),
//            new OneToManyAssociationField('blogPluginBlogMappingCategories', BlogMappingDefinition::class, 'blog_plugin_blog_category_id'),
//            new OneToManyAssociationField('blogPluginBlogMappingProducts', BlogMappingDefinition::class, 'blog_plugin_blog_category_id'),
        ]);
    }
}
