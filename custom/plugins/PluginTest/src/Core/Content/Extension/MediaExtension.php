<?php
declare(strict_types=1);
namespace PluginTest\Core\Content\Extension;
use PluginTest\Core\Content\PluginTest\PluginTestDefinition;
use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class MediaExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new OneToOneAssociationField('pluginTest', 'id', 'media_id', PluginTestDefinition::class, false)),

        );
    }
    public function getDefinitionClass(): string
    {
        return MediaDefinition::class;
    }
}