<?php declare(strict_types=1);

namespace PluginTest\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @internal
 */
#[Package('core')]
class Migration1745402887PluginTestMigration extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1745402887;
    }

    public function update(Connection $connection): void
    {
        $connection->executeStatement("
            CREATE TABLE `plugin_test` (
                `id` BINARY(16) NOT NULL,
                `product_version_id` BINARY(16) NOT NULL,
                `active` TINYINT(1) NULL DEFAULT '0',
                `country_id` BINARY(16) NULL,
                `state_id` BINARY(16) NULL,
                `media_id` BINARY(16) NULL,
                `product_id` BINARY(16) NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`),
                KEY `fk.plugin_test.country_id` (`country_id`),
                KEY `fk.plugin_test.state_id` (`state_id`),
                KEY `fk.plugin_test.product_id` (`product_id`,`product_version_id`),
                CONSTRAINT `fk.plugin_test.country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.plugin_test.state_id` FOREIGN KEY (`state_id`) REFERENCES `country_state` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.plugin_test.product_id` FOREIGN KEY (`product_id`,`product_version_id`) REFERENCES `product` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

            CREATE TABLE `plugin_test_translation` (
                `id` BINARY(16) NOT NULL,
                `plugin_test_id` BINARY(16) NOT NULL,
                `name` VARCHAR(255) NULL,
                `city` VARCHAR(255) NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`,`plugin_test_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");
    }
}
