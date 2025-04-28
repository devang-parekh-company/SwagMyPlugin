<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\BlogMapping;

use BlogPlugin\Core\Content\BlogPlugin\Blog\BlogDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogCategory\BlogCategoryDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\MappingEntityDefinition;

class BlogCategoryMappingDefinition extends  MappingEntityDefinition
{
    const ENTITY_NAME = 'blog_blog_category';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('blog_id', 'blogId', BlogDefinition::class))->addFlags(new Required(), new PrimaryKey()),
            (new FkField('blog_category_id', 'blogCategoryId', BlogCategoryDefinition::class))->addFlags(new Required(), new PrimaryKey()),
            
            new ManyToOneAssociationField('blog', 'blog_id', BlogDefinition::class),
            new ManyToOneAssociationField('blogCategory', 'blog_category_id', BlogCategoryDefinition::class),
        ]);
    }
}

