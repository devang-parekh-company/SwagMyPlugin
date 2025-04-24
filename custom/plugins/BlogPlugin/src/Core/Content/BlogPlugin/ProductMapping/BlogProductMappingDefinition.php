<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\ProductMapping;

use BlogPlugin\Core\Content\BlogPlugin\Blog\BlogDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ReferenceVersionField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogProductMappingDefinition extends  EntityDefinition
{
    const ENTITY_NAME = 'blog_plugin_blog_mapping_products';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('blog_plugin_blog_id', 'blogPluginBlogId', BlogDefinition::class))->addFlags(new Required(), new PrimaryKey()),
            (new FkField('product_id', 'productId', ProductDefinition::class))->addFlags(new Required(), new PrimaryKey()),
            (new ReferenceVersionField(ProductDefinition::class, "product_version_id"))->addFlags(new ApiAware(), new Required()),

            new ManyToOneAssociationField('blogPluginBlog', 'blog_plugin_blog_id', BlogDefinition::class),
            new ManyToOneAssociationField('product', 'product_id', ProductDefinition::class)
        ]);
    }
}
