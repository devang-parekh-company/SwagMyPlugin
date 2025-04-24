<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\Blog;

use BlogPlugin\Core\Content\BlogPlugin\BlogCategory\BlogCategoryDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogMapping\BlogMappingDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\DateField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
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
            new StringField('title', 'title'),
            new StringField('description', 'description'),
            new DateField('release_date', 'releaseDate'),
            new BoolField('active', 'active'),
            new ManyToManyAssociationField(
                'blog_plugin_blog_categories',
                BlogCategoryDefinition::class,
                BlogMappingDefinition::class,
                'blog_plugin_blog_id',
                "blog_plugin_blog_category_id",
            )
        ]);
    }
}
