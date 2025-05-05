<?php

declare(strict_types=1);

namespace BlogPlugin;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;

class BlogPlugin extends Plugin
{
    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }

        $connection = $this->container->get(Connection::class);
        $sql = <<<SQL
            DROP TABLE IF EXISTS `blog_mapping_product`;
            DROP TABLE IF EXISTS `blog_blog_category`;
            DROP TABLE IF EXISTS `blog_translation`;
            DROP TABLE IF EXISTS `blog`;
            DROP TABLE IF EXISTS `blog_category_translation`;
            DROP TABLE IF EXISTS `blog_category`;
            SQL;
        $connection->executeStatement($sql);
    }
}
