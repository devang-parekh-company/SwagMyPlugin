CREATE TABLE `swag_language_pack_language` (
    `id` BINARY(16) NOT NULL,
    `administration_active` TINYINT(1) NULL DEFAULT '0',
    `sales_channel_active` TINYINT(1) NULL DEFAULT '0',
    `language_id` BINARY(16) NOT NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;