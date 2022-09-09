-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 08, 2022 at 02:40 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `phone`, `type`, `email`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jewel Mahmud', '01744164396', 'admin', 'jewel@gmail.com', NULL, '$2y$10$2at2owl1dZ8U2Ia4bFDuEeqdgJTwLEfmbt1090YhOzB2gExJxgCFu', 'images/admin-image/profile_img1662243448.jpg', 1, NULL, '2022-08-30 10:22:43', '2022-09-04 05:17:28'),
(2, 'Tanzila Mahmud', '01744164396', 'admin', 'tanzila@gmail.com', NULL, '$2y$10$k1U/mfVAA6r9/nK6gZ2RY.s.smJaHntEUz3L5x1VNo.QrQ9Hb79Fm', '', 1, NULL, '2022-08-30 10:22:43', '2022-08-30 10:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_discount` double(8,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_image`, `category_discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'T-Shirt', '', 150.00, '', '/t-shirt', '', '', '', 0, NULL, '2022-08-31 05:35:51'),
(5, 3, 1, 'Formal Tshirt', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-09-02 02:34:53', '2022-09-02 02:34:53'),
(3, 0, 1, 'TShirt', '', NULL, 'gjhjgj', NULL, NULL, NULL, NULL, 1, '2022-09-01 02:53:36', '2022-09-01 02:53:36'),
(4, 3, 1, 'Casual T shirt', '', NULL, 'Casual t-shirt', 'casual-tshirt', NULL, NULL, NULL, 1, '2022-09-01 02:53:59', '2022-09-02 01:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 6),
(9, '2014_10_12_100000_create_password_resets_table', 6),
(10, '2019_08_19_000000_create_failed_jobs_table', 6),
(11, '2022_08_09_092227_create_admins_table', 6),
(12, '2022_08_11_071507_create_sections_table', 6),
(7, '2022_08_16_093352_create_products_table', 5),
(13, '2022_08_11_124230_create_categories_table', 6),
(14, '2022_08_30_022758_create_products_table', 7),
(16, '2022_09_06_120855_create_product_attributes_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_discount` double(8,2) DEFAULT NULL,
  `product_weight` double(8,2) DEFAULT NULL,
  `product_video` text COLLATE utf8mb4_unicode_ci,
  `main_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `long_description` text COLLATE utf8mb4_unicode_ci,
  `wash_care` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabric` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pattern` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sleeve` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occasion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `section_id`, `category_id`, `product_name`, `product_code`, `product_color`, `product_price`, `product_discount`, `product_weight`, `product_video`, `main_image`, `short_description`, `long_description`, `wash_care`, `fabric`, `pattern`, `sleeve`, `fit`, `occasion`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 4, 'White Casual Tshirt', 'WCT01', 'White', 2500.00, 10.00, 150.00, '', 'White Casual Tshirt1662072379.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', 1, '2022-09-02 05:46:19', '2022-09-02 05:46:19'),
(5, 1, 4, 'China Casual T-Shirt', 'CCT01', 'Red', 2500.00, 10.00, 150.00, '', 'China Casual T-Shirt1662070413.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', 1, '2022-09-02 05:13:33', '2022-09-08 19:56:18'),
(7, 1, 5, 'Black  Formal Tshirt', 'BFT01', 'Black', 2590.00, 5.00, 150.00, '', 'Black  Formal Tshirt1662172332.jpg', 'Made in China', 'This Formal T-shirt is best comportable t-shirt.. every person buy this product at any where..', '130', 'Cotton', 'Short Pattern', 'Half Sleeve', 'Regular Fit', 'Formal', 'Foraml T-shirt', '100% Cotton made in china formal t-shirt', 'T-shirt, Formal T-shirt, White T-shirt', 'Yes', 1, '2022-09-03 09:32:12', '2022-09-08 19:55:24'),
(9, 1, 5, 'Black-Formal-Tshirt', 'BFT02', 'Black', 1800.00, 10.00, 150.00, '', 'Black-Formal-Tshirt1662229379.jpg', NULL, NULL, '250', 'AllOver Print', 'Long Pattern', 'Sleeveless', 'Slim Fit', 'Formal', NULL, NULL, NULL, 'No', 1, '2022-09-04 00:24:33', '2022-09-08 19:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

DROP TABLE IF EXISTS `product_attributes`;
CREATE TABLE IF NOT EXISTS `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `size`, `sku`, `price`, `stock`, `status`, `created_at`, `updated_at`) VALUES
(2, 6, 'Small', 'WCT01-S', 1500.00, 21, 1, '2022-09-07 19:58:09', '2022-09-08 18:29:27'),
(3, 6, 'Medium', 'WCT01-M', 1250.00, 10, 0, '2022-09-07 19:58:09', '2022-09-08 18:29:31'),
(4, 6, 'Large', 'WCT01-L', 1300.00, 10, 1, '2022-09-07 19:58:09', '2022-09-08 18:29:28'),
(9, 9, 'Medium', 'BFT02-M', 1300.00, 20, 1, '2022-09-08 18:44:39', '2022-09-08 18:44:39'),
(8, 9, 'Small', 'BFT02-S', 1200.00, 10, 1, '2022-09-08 18:44:39', '2022-09-08 18:44:39'),
(10, 9, 'Large', 'BFT02-L', 1400.00, 15, 1, '2022-09-08 18:44:39', '2022-09-08 18:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Men', 1, '2022-08-30 10:23:33', '2022-08-31 08:29:22'),
(2, 'Women', 1, '2022-08-30 10:23:33', '2022-08-30 10:23:33'),
(3, 'Kids', 1, '2022-08-30 10:23:33', '2022-08-31 08:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
