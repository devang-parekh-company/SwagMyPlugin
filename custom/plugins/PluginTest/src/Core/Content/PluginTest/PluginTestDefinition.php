<?php

declare(strict_types=1);

namespace PluginTest\Core\Content\PluginTest;

use PluginTest\Core\Content\PluginTest\Aggregate\PluginTestTranslationDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ReferenceVersionField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Country\Aggregate\CountryState\CountryStateDefinition;
use Shopware\Core\System\Country\CountryDefinition;

class PluginTestDefinition extends EntityDefinition
{
    const ENTITY_NAME = 'plugin_test';
    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }
    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new PrimaryKey(), new Required()),
            (new ReferenceVersionField(ProductDefinition::class, "product_version_id"))->addFlags(new ApiAware(), new Required()),
            (new TranslatedField('name')),
            (new TranslatedField('city')),
            (new BoolField('active', 'active')),
            (new FkField('country_id', 'countryId', CountryDefinition::class)),
            (new FkField('state_id', 'stateId', CountryStateDefinition::class)),
            (new FkField('media_id', 'mediaId', MediaDefinition::class)),
            (new FkField('product_id', 'productId', ProductDefinition::class)),

            (new ManyToOneAssociationField('country', 'country_id', CountryDefinition::class, 'id')),

            (new ManyToOneAssociationField('state', 'state_id', CountryStateDefinition::class, 'id')),
            (new OneToOneAssociationField('media', 'media_id', 'id', MediaDefinition::class, false)),
            (new ManyToOneAssociationField('product', 'product_id', ProductDefinition::class, 'id')),
            (new TranslationsAssociationField(PluginTestTranslationDefinition::class, 'plugin_test_id'))->addFlags(new Required())
        ]);
    }

    public function getCollectionClass(): string
    {
        return PluginTestCollection::class;
    }
    public function getEntityClass(): string
    {
        return PluginTestEntity::class;
    }
}
