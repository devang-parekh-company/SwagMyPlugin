<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\Blog;

use BlogPlugin\Core\Content\BlogPlugin\Blog\Aggregate\BlogTranslationDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogCategory\BlogCategoryDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogMapping\BlogCategoryMappingDefinition;
use BlogPlugin\Core\Content\BlogPlugin\ProductMapping\BlogProductMappingDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\DateField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogDefinition extends EntityDefinition
{
    const ENTITY_NAME = 'blog';

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
            new DateField('release_date', 'releaseDate'),
            new BoolField('active', 'active'),
            new TranslatedField('author', 'author'),

            new ManyToManyAssociationField(
                'products',
                ProductDefinition::class,
                BlogProductMappingDefinition::class,
                'blog_id',
                'product_id'
            ),
            new ManyToManyAssociationField(
                'blogCategories',
                BlogCategoryDefinition::class,
                BlogCategoryMappingDefinition::class,
                'blog_id',
                'blog_category_id'
            ),

            (new TranslationsAssociationField(BlogTranslationDefinition::class, 'blog_id'))
        ]);
    }
}
