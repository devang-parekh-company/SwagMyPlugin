<?php

declare(strict_types=1);

namespace BlogPlugin\Core\Content\Extension;

use BlogPlugin\Core\Content\BlogPlugin\Blog\Aggregate\BlogTranslationDefinition;
use BlogPlugin\Core\Content\BlogPlugin\BlogCategory\Aggregate\BlogCategoryTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Language\LanguageDefinition;

class LanguageExtension extends EntityExtension
{
    public function extendFields(FieldCollection $fieldCollection): void
    {
        $fieldCollection->add(
            new OneToManyAssociationField('BlogPluginBlogTranslationId', BlogTranslationDefinition::class, 'blog_plugin_blog_id'),
        );
        $fieldCollection->add(
            new OneToManyAssociationField('BlogPluginBlogCategoryTranslationId', BlogCategoryTranslationDefinition::class, 'blog_plugin_blog_category_id'),
        );
    }
    public function getDefinitionClass(): string
    {
        return LanguageDefinition::class;
    }
}
