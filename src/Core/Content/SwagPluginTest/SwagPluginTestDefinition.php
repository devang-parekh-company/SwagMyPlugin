<?php

declare(strict_types=1);

namespace SwagPluginTest\Core\Content\SwagPluginTest;

use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\App\Manifest\Xml\CustomField\CustomFieldTypes\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Country\Aggregate\CountryState\CountryStateDefinition;
use Shopware\Core\System\Country\CountryDefinition;

class SwagPluginTest extends EntityDefinition
{
    public function getEntityName(): string
    {
        return 'swag_plugin_test';
    }
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new TranslatedField('name')),
            (new TranslatedField('city')),
            (new BoolField('active', 'active')),
            (new FkField('country_id', 'countryId', CountryDefinition::class)),
            (new FkField('state_id', 'stateId', CountryStateDefinition::class)),
            (new FkField('media_id', 'mediaId', MediaDefinition::class)),
            (new FkField('product_id', 'productId', ProductDefinition::class)),
            (new ManyToOneAssociationField('country', 'country_id', CountryDefinition::class, 'id')),
            (new ManyToOneAssociationField('state', 'state_id', CountryStateDefinition::class, 'id')),
            (new OneToOneAssociationField('image', 'media_id', 'id', MediaDefinition::class, false)),
            (new ManyToOneAssociationField('product', 'product_id', ProductDefinition::class, 'id')),
        ]);
    }
    
    public function getCollectionClass(): string
    {
        return "";
    }
    public function getEntityClass(): string
    {
        return "";
    }
}
