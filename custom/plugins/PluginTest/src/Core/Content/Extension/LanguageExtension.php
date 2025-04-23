<?php

declare(strict_types=1);

namespace PluginTest\Core\Content\Extension;

use PluginTest\Core\Content\PluginTest\Aggregate\PluginTestTranslationDefinition;
use PluginTest\Core\Content\PluginTest\PluginTestDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Country\Aggregate\CountryState\CountryStateDefinition;
use Shopware\Core\System\Country\CountryDefinition;
use Shopware\Core\System\Language\LanguageDefinition;

class LanguageExtension extends EntityExtension
{
    public function extendFields(FieldCollection $fieldCollection): void
    {
        $fieldCollection->add(
            new OneToManyAssociationField('PluginTestTranslationId', PluginTestTranslationDefinition::class, 'plugin_test_id'),
        );
    }
    public function getDefinitionClass(): string
    {
        return LanguageDefinition::class;
    }
}
