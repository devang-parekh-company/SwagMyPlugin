CREATE TABLE `blog` (
    `id` BINARY(16) NOT NULL,
    `release_date` DATE NULL,
    `active` TINYINT(1) NULL DEFAULT '0',
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `json.blog.translated` CHECK (JSON_VALID(`translated`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog_translation` (
    `id` BINARY(16) NULL,
    `blog_id` BINARY(16) NOT NULL,
    `name` VARCHAR(255) NULL,
    `description` VARCHAR(255) NULL,
    `author` VARCHAR(255) NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    `language_id` BINARY(16) NOT NULL,
    PRIMARY KEY (`id`,`blog_id`,`language_id`),
    KEY `fk.blog_translation.blog_id` (`blog_id`),
    KEY `fk.blog_translation.language_id` (`language_id`),
    CONSTRAINT `fk.blog_translation.blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk.blog_translation.language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog_blog_category` (
    `blog_id` BINARY(16) NOT NULL,
    `blog_category_id` BINARY(16) NOT NULL,
    PRIMARY KEY (`blog_id`,`blog_category_id`),
    KEY `fk.blog_blog_category.blog_id` (`blog_id`),
    KEY `fk.blog_blog_category.blog_category_id` (`blog_category_id`),
    CONSTRAINT `fk.blog_blog_category.blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk.blog_blog_category.blog_category_id` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog_category` (
    `id` BINARY(16) NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `json.blog_category.translated` CHECK (JSON_VALID(`translated`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog_category_translation` (
    `id` BINARY(16) NULL,
    `blog_category_id` BINARY(16) NOT NULL,
    `name` VARCHAR(255) NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    `language_id` BINARY(16) NOT NULL,
    PRIMARY KEY (`id`,`blog_category_id`,`language_id`),
    KEY `fk.blog_category_translation.blog_category_id` (`blog_category_id`),
    KEY `fk.blog_category_translation.language_id` (`language_id`),
    CONSTRAINT `fk.blog_category_translation.blog_category_id` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk.blog_category_translation.language_id` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog_mapping_product` (
    `blog_id` BINARY(16) NOT NULL,
    `product_id` BINARY(16) NOT NULL,
    `product_version_id` BINARY(16) NOT NULL,
    PRIMARY KEY (`blog_id`,`product_id`),
    KEY `fk.blog_mapping_product.blog_id` (`blog_id`),
    KEY `fk.blog_mapping_product.product_id` (`product_id`,`product_version_id`),
    CONSTRAINT `fk.blog_mapping_product.blog_id` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk.blog_mapping_product.product_id` FOREIGN KEY (`product_id`,`product_version_id`) REFERENCES `product` (`id`,`version_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;