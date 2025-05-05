<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\BlogCategory;

use BlogPlugin\Core\Content\BlogPlugin\Blog\BlogDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogCategory\Aggregate\BlogCategoryTranslationDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogMapping\BlogCategoryMappingDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogCategoryDefinition extends EntityDefinition
{
    const ENTITY_NAME = 'blog_category';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return BlogCategoryEntity::class;
    }

    public function getCollectionClass(): string
    {
        return BlogCategoryCollection::class;
    }

    public function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey()),
            new TranslatedField('name', 'name'),
            new ManyToManyAssociationField(
                'blogs',
                BlogDefinition::class,
                BlogCategoryMappingDefinition::class,
                'blog_category_id',
                'blog_id'
            ),
            (new TranslationsAssociationField(BlogCategoryTranslationDefinition::class, 'blog_category_id')),
        ]);
    }
}
