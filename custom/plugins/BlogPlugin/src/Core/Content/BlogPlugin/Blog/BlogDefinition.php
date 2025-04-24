<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\Blog;

use BlogPlugin\Core\Content\BlogPlugin\Blog\Aggregate\BlogTranslationDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogCategory\BlogCategoryDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogMapping\BlogMappingDefinition;
use BlogPlugin\Core\Content\BlogPlugin\ProductMapping\BlogProductMappingDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\DateField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogDefinition extends EntityDefinition
{
    const ENTITY_NAME = 'blog_plugin_blogs';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            new TranslatedField('name', 'name'),
            new TranslatedField('description', 'description'),
            new StringField('author', 'author'),
            new DateField('release_date', 'releaseDate'),
            new BoolField('active', 'active'),
            (new TranslationsAssociationField(BlogTranslationDefinition::class, 'blog_plugin_blog_id')),

            new ManyToManyAssociationField(
                'blogPluginBlogCategories',
                BlogCategoryDefinition::class,
                BlogMappingDefinition::class,
                'blog_plugin_blog_id',
                "blog_plugin_blog_category_id",
            ),
            
            new ManyToManyAssociationField(
                'blogPluginBlogMappingProducts',
                ProductDefinition::class,
                BlogProductMappingDefinition::class,
                'blog_plugin_blog_id',
                "product_id",
            ),
            // new OneToManyAssociationField('blogPluginBlogMappingCategories', BlogMappingDefinition::class, 'blog_plugin_blog_id'),
            // new OneToManyAssociationField('blogPluginBlogMappingProducts', BlogProductMappingDefinition::class, 'blog_plugin_blog_id'),
        ]);
    }
}
