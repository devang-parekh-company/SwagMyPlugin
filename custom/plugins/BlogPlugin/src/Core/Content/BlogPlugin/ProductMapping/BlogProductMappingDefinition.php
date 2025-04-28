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
use Shopware\Core\Framework\DataAbstractionLayer\MappingEntityDefinition;

class BlogProductMappingDefinition extends  MappingEntityDefinition
{
    const ENTITY_NAME = 'blog_mapping_product';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('blog_id', 'blogId', BlogDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('product_id', 'productId', ProductDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            (new ReferenceVersionField(ProductDefinition::class, "product_version_id"))->addFlags(new ApiAware(), new Required()),
            new ManyToOneAssociationField(
                'blog',
                'blog_id',
                BlogDefinition::class,
                'id'
            ),
            new ManyToOneAssociationField(
                'product',
                'product_id',
                ProductDefinition::class,
                'id'
            )
        ]);
    }
}
