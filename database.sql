-- --------------------------------------------------------
-- Database Schema for Great Ten Technology
-- --------------------------------------------------------

-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS great10_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the database
USE great10_db;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `categories`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `tools`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `tools`;
CREATE TABLE `tools` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1.0.0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tools_slug_unique` (`slug`),
  KEY `tools_category_id_foreign` (`category_id`),
  CONSTRAINT `tools_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `licenses`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `licenses`;
CREATE TABLE `licenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tool_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `license_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','expired','revoked','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `max_downloads` int NOT NULL DEFAULT '1',
  `download_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `licenses_license_key_unique` (`license_key`),
  KEY `licenses_tool_id_foreign` (`tool_id`),
  KEY `licenses_user_id_foreign` (`user_id`),
  CONSTRAINT `licenses_tool_id_foreign` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`) ON DELETE CASCADE,
  CONSTRAINT `licenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `downloads`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `downloads`;
CREATE TABLE `downloads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `license_id` bigint unsigned NOT NULL,
  `tool_id` bigint unsigned NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `downloads_license_id_foreign` (`license_id`),
  KEY `downloads_tool_id_foreign` (`tool_id`),
  CONSTRAINT `downloads_license_id_foreign` FOREIGN KEY (`license_id`) REFERENCES `licenses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `downloads_tool_id_foreign` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Dumping data for table `categories`
-- --------------------------------------------------------
INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Themes', 'themes', NOW(), NOW()),
(2, 'Plugins', 'plugins', NOW(), NOW()),
(3, 'Projects', 'projects', NOW(), NOW()),
(4, 'Bots', 'bots', NOW(), NOW()),
(5, 'Documentation', 'documentation', NOW(), NOW());

-- --------------------------------------------------------
-- Dumping data for table `users`
-- --------------------------------------------------------
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@great10.xyz', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, NULL, NOW(), NOW()),
(2, 'Regular User', 'user@great10.xyz', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, NULL, NOW(), NOW());

-- Password is 'password' for both accounts

-- --------------------------------------------------------
-- Dumping data for table `tools`
-- --------------------------------------------------------
INSERT INTO `tools` (`id`, `name`, `category_id`, `description`, `price`, `file_path`, `status`, `slug`, `version`, `created_at`, `updated_at`) VALUES
(1, 'Elegant Business Theme', 1, 'A modern WordPress theme designed specifically for business websites with multiple layout options.', 59.00, 'tools/elegant-business-theme.zip', 'published', 'elegant-business-theme', '1.0.0', NOW(), NOW()),
(2, 'Advanced Contact Form', 2, 'Feature-rich contact form plugin with spam protection and analytics.', 29.00, 'tools/advanced-contact-form.zip', 'published', 'advanced-contact-form', '1.2.1', NOW(), NOW()),
(3, 'Social Media Bot', 4, 'Automated social media management script with scheduling capabilities.', 49.00, 'tools/social-media-bot.zip', 'published', 'social-media-bot', '2.1.0', NOW(), NOW()),
(4, 'Documentation System', 5, 'Comprehensive documentation platform for products and services.', 0.00, 'tools/documentation-system.zip', 'published', 'documentation-system', '1.5.3', NOW(), NOW()),
(5, 'E-commerce Pro', 1, 'Complete e-commerce solution for WordPress with advanced features.', 89.00, 'tools/ecommerce-pro.zip', 'published', 'ecommerce-pro', '3.2.1', NOW(), NOW()),
(6, 'Security Shield', 2, 'Advanced security plugin protecting against common threats.', 39.00, 'tools/security-shield.zip', 'published', 'security-shield', '1.4.2', NOW(), NOW());

-- --------------------------------------------------------
-- Dumping data for table `licenses`
-- --------------------------------------------------------
INSERT INTO `licenses` (`id`, `tool_id`, `user_id`, `license_key`, `domain`, `expires_at`, `status`, `max_downloads`, `download_count`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'GT10-ABCD-EFGH-IJKL-MNOP', 'example1.com', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'active', 5, 2, NOW(), NOW()),
(2, 2, 2, 'GT10-BCDE-FGHI-JKLM-NOPQ', 'example2.com', DATE_ADD(NOW(), INTERVAL 1 YEAR), 'active', 3, 1, NOW(), NOW()),
(3, 3, 1, 'GT10-CDEF-GHIJ-KLMN-OPQR', 'example3.com', DATE_ADD(NOW(), INTERVAL 6 MONTH), 'active', 10, 4, NOW(), NOW()),
(4, 4, 2, 'GT10-DEFG-HIJK-LMNO-PQRS', 'example4.com', DATE_ADD(NOW(), INTERVAL 2 YEAR), 'active', 1, 0, NOW(), NOW()),
(5, 5, 1, 'GT10-EFGH-IJKL-MNOP-QRST', 'example5.com', DATE_SUB(NOW(), INTERVAL 1 DAY), 'expired', 5, 3, NOW(), NOW());

-- --------------------------------------------------------
-- Dumping data for table `downloads`
-- --------------------------------------------------------
INSERT INTO `downloads` (`id`, `license_id`, `tool_id`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '192.168.1.1', 'Mozilla/5.0...', NOW(), NOW()),
(2, 2, 2, '192.168.1.2', 'Mozilla/5.0...', NOW(), NOW()),
(3, 3, 3, '192.168.1.3', 'Mozilla/5.0...', NOW(), NOW());

COMMIT;