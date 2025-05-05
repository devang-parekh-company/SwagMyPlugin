<?php

declare(strict_types=1);

namespace BlogPlugin\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @internal
 */
class Migration1745903573BlogPluginMigration extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1745903573;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
            CREATE TABLE `blog_category` (
                `id` BINARY(16) NOT NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

            CREATE TABLE `blog_category_translation` (
                `name` VARCHAR(255) NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                `blog_category_id` BINARY(16) NOT NULL,
                `language_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`blog_category_id`,`language_id`),
                KEY `fk.blog_category_translation.blog_category_id` (`blog_category_id`),
                KEY `fk.blog_category_translation.language_id` (`language_id`),
                CONSTRAINT `fk.blog_category_translation.blog_category_id` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.blog_category_translation.language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

            CREATE TABLE `blog` (
                `id` BINARY(16) NOT NULL,
                `release_date` DATE NULL,
                `active` TINYINT(1) NULL DEFAULT '0',
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

            CREATE TABLE `blog_translation` (
                `name` VARCHAR(255) NULL,
                `description` LONGTEXT NULL,
                `author` VARCHAR(255) NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                `blog_id` BINARY(16) NOT NULL,
                `language_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`blog_id`,`language_id`),
                KEY `fk.blog_translation.blog_id` (`blog_id`),
                KEY `fk.blog_translation.language_id` (`language_id`),
                CONSTRAINT `fk.blog_translation.blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.blog_translation.language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

            CREATE TABLE `blog_blog_category` (
                `blog_id` BINARY(16) NOT NULL,
                `blog_category_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`blog_id`,`blog_category_id`),
                KEY `fk.blog_blog_category.blog_id` (`blog_id`),
                KEY `fk.blog_blog_category.blog_category_id` (`blog_category_id`),
                CONSTRAINT `fk.blog_blog_category.blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.blog_blog_category.blog_category_id` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

            CREATE TABLE `blog_mapping_product` (
                `blog_id` BINARY(16) NOT NULL,
                `product_id` BINARY(16) NOT NULL,
                `product_version_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`blog_id`,`product_id`,`product_version_id`),
                KEY `fk.blog_mapping_product.blog_id` (`blog_id`),
                KEY `fk.blog_mapping_product.product_id` (`product_id`,`product_version_id`),
                CONSTRAINT `fk.blog_mapping_product.blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.blog_mapping_product.product_id` FOREIGN KEY (`product_id`,`product_version_id`) REFERENCES `product` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        SQL;

        $connection->executeStatement($sql);
    }

    public function updateDestructive(Connection $connection): void
    {
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
