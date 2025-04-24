<?php
declare(strict_types=1);
namespace BlogPlugin\Core\Content\Extension;

use BlogPlugin\Core\Content\BlogPlugin\Blog\BlogDefinition;
use BlogPlugin\Core\Content\BlogPlugin\ProductMapping\BlogProductMappingDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new ManyToManyAssociationField(
                'blog_plugin_blogs',
                BlogDefinition::class,
                BlogProductMappingDefinition::class,
                'product_id',
                'blog_plugin_blog_id'
            )
        );
    }
    public function getDefinitionClass(): string
    {
        return ProductDefinition::class;
    }
}