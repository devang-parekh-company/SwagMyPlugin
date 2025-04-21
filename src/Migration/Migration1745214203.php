<?php declare(strict_types=1);

namespace SwagMyPlugin\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\Migration\MigrationStep;

/**
 * @internal
 */
#[Package('core')]
class Migration1745214203 extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1745214203;
    }

    public function update(Connection $connection): void
    {
        $query = '
            CREATE TABLE `swag_my_plugin` (
                `id` BINARY(16) NOT NULL,
                `name` VARCHAR(255) NOT NULL,
                `city` VARCHAR(255) NOT NULL,
                `active` TINYINT(1) NOT NULL DEFAULT 0,
                `media_id` BINARY(16) NULL,
                `country_id` BINARY(16) NULL,
                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL,
                PRIMARY KEY (`id`),
                CONSTRAINT `fk.swag_my_plugin.media_id` FOREIGN KEY (`media_id`)
                    REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
                CONSTRAINT `fk.swag_my_plugin.country_id` FOREIGN KEY (`country_id`)
                    REFERENCES `country` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ';

        $connection->executeStatement($query);
    }
}
