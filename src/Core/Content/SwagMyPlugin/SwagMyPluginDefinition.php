<?php

declare(strict_types=1);

namespace SwagMyPlugin\Core\Content\SwagMyPlugin;

use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Country\CountryDefinition;

class SwagMyPluginDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'swag_my_plugin';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new StringField('name', 'name'))->addFlags(new ApiAware(), new Required()),
            (new StringField('city', 'city'))->addFlags(new ApiAware(), new Required()),
            (new BoolField('active', 'active')),
            new FkField('media_id', 'mediaId', MediaDefinition::class),
            new FkField('country_id', 'countryId', CountryDefinition::class),
            new ManyToOneAssociationField('country', 'country_id', CountryDefinition::class, 'id', false),
            new ManyToOneAssociationField('media', 'media_id', MediaDefinition::class, 'id', false),
        ]);
    }
    public function getCollectionClass(): string
    {
        return SwagMyPluginCollection::class;
    }
    public function getEntityClass(): string
    {
        return SwagMyPluginEntity::class;
    }
}
