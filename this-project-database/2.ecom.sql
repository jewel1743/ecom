-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 27, 2022 at 08:03 AM
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
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `title`, `link`, `alt`, `status`, `created_at`, `updated_at`) VALUES
(7, 'images/banners/banner_1663583036.png', 'Black Jacket', 'http://www.facebook.com', 'Black Jacket', 1, '2022-09-18 21:12:14', '2022-09-21 18:02:18'),
(6, 'images/banners/banner_1663510312.png', 'Green T-Shirt', NULL, 'White T-Shirt', 1, '2022-09-18 21:11:52', '2022-09-21 18:02:19'),
(5, 'images/banners/banner_1663583060.png', 'Blue T-Shirt', NULL, 'Blue T-Shirt', 1, '2022-09-18 21:11:35', '2022-09-21 18:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_image`, `status`, `created_at`, `updated_at`) VALUES
(12, 'H&M', 'images/brand-images/H&M_1664262662.PNG', 1, '2022-09-27 14:11:02', '2022-09-27 14:11:02'),
(10, 'Apex', 'images/brand-images/Apex_1663665768.jpg', 1, '2022-09-20 16:22:48', '2022-09-20 16:22:48'),
(11, 'Bata', 'images/brand-images/Bata_1664262615.jpg', 1, '2022-09-27 14:10:15', '2022-09-27 14:10:15');

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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_image`, `category_discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'T-Shirt', '', 150.00, '', '/t-shirt', '', '', '', 0, NULL, '2022-08-31 05:35:51'),
(5, 3, 1, 'Formal Tshirt', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-09-02 02:34:53', '2022-09-17 15:32:41'),
(3, 0, 1, 'T-Shirt', '', NULL, 'This is men t-shirt category, it\'s suitable for all mens.', 'men-tshirt', NULL, NULL, NULL, 1, '2022-09-01 02:53:36', '2022-09-25 17:10:26'),
(4, 3, 1, 'Casual T shirt', '', NULL, 'Casual t-shirt', 'men-casual-tshirt', NULL, NULL, NULL, 1, '2022-09-01 02:53:59', '2022-09-20 16:14:27'),
(7, 0, 2, 'T-Shirt', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-09-15 18:15:48', '2022-09-17 15:32:46'),
(8, 0, 2, 'Shirt', '', NULL, NULL, 'women-shirt', NULL, NULL, NULL, 1, '2022-09-15 18:15:58', '2022-09-20 16:14:38'),
(9, 0, 2, 'Scart', '', NULL, NULL, 'scart', NULL, NULL, NULL, 1, '2022-09-15 18:16:23', '2022-09-20 16:06:46'),
(10, 7, 2, 'Formal T-Shirt', '', NULL, NULL, 'women-formal-tshirt', NULL, NULL, NULL, 1, '2022-09-15 18:19:08', '2022-09-20 16:04:36'),
(11, 7, 2, 'Casual T-Shirt', '', NULL, NULL, 'women-casual-tshirt', NULL, NULL, NULL, 1, '2022-09-15 18:19:22', '2022-09-20 16:05:12'),
(12, 8, 2, 'Formal Shirt', '', NULL, NULL, 'women-formal- shirt', NULL, NULL, NULL, 1, '2022-09-15 18:22:33', '2022-09-20 16:05:50'),
(13, 8, 2, 'Casual Shirt', '', NULL, NULL, 'women-casual-shirt', NULL, NULL, NULL, 1, '2022-09-15 18:22:47', '2022-09-20 16:06:12'),
(14, 9, 2, 'Printed Scart', '', NULL, NULL, 'printed-scart', NULL, NULL, NULL, 1, '2022-09-15 18:23:19', '2022-09-20 16:06:34'),
(15, 9, 2, 'Solid Scart', '', NULL, NULL, 'solid-scart', NULL, NULL, NULL, 1, '2022-09-15 18:23:39', '2022-09-20 16:07:02'),
(16, 0, 1, 'Shirt', '', NULL, NULL, 'men-shirt', NULL, NULL, NULL, 1, '2022-09-15 18:25:08', '2022-09-20 20:42:03'),
(17, 16, 1, 'Formal Shirt', '', NULL, NULL, 'men-formal-shirt', NULL, NULL, NULL, 1, '2022-09-15 18:25:40', '2022-09-20 16:16:22'),
(18, 16, 1, 'Casual Shirt', '', NULL, NULL, 'men-casual-shirt', NULL, NULL, NULL, 1, '2022-09-15 18:25:55', '2022-09-20 16:17:41'),
(19, 0, 3, 'T-Shirt', '', NULL, NULL, 'kids-tshirt', NULL, NULL, NULL, 1, '2022-09-15 18:27:57', '2022-09-20 16:18:06'),
(20, 0, 3, 'Shirt', '', NULL, NULL, 'kids-shirt', NULL, NULL, NULL, 1, '2022-09-15 18:28:22', '2022-09-20 16:18:23'),
(21, 19, 3, 'Casual T-Shirt', '', NULL, NULL, 'kids-casual-tshirt', NULL, NULL, NULL, 1, '2022-09-15 18:28:43', '2022-09-20 16:19:28'),
(22, 19, 3, 'Formal T-Shirt', '', NULL, NULL, 'kids-formal-tshirt', NULL, NULL, NULL, 1, '2022-09-15 18:28:58', '2022-09-20 16:19:52'),
(23, 20, 3, 'Formal Shirt', '', NULL, NULL, 'kids-formal-shirt', NULL, NULL, NULL, 1, '2022-09-15 18:29:11', '2022-09-20 16:20:14'),
(29, 3, 1, 'Xiaomi', '', NULL, NULL, 'xiaomi', NULL, NULL, NULL, 1, '2022-09-21 16:17:32', '2022-09-25 13:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `fabrics`
--

DROP TABLE IF EXISTS `fabrics`;
CREATE TABLE IF NOT EXISTS `fabrics` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fabrics`
--

INSERT INTO `fabrics` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cottons', 1, NULL, '2022-09-26 17:09:09');

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
-- Table structure for table `fits`
--

DROP TABLE IF EXISTS `fits`;
CREATE TABLE IF NOT EXISTS `fits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fits`
--

INSERT INTO `fits` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Slim Fit', 1, NULL, NULL),
(2, 'Regular Fit', 1, NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(16, '2022_09_06_120855_create_product_attributes_table', 8),
(17, '2022_09_10_064235_create_product_images_table', 9),
(18, '2022_09_12_053050_create_brands_table', 10),
(19, '2022_09_12_053527_add_colum_to_products', 11),
(20, '2022_09_18_115422_create_banners_table', 12),
(21, '2022_09_26_090429_create_fabrics_table', 13),
(22, '2022_09_26_090526_create_patterns_table', 13),
(23, '2022_09_26_090548_create_sleeves_table', 13),
(24, '2022_09_26_090623_create_fits_table', 13),
(25, '2022_09_26_090645_create_occasions_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `occasions`
--

DROP TABLE IF EXISTS `occasions`;
CREATE TABLE IF NOT EXISTS `occasions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `occasions`
--

INSERT INTO `occasions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Casuals', 1, NULL, '2022-09-27 13:06:19'),
(2, 'Formal', 1, NULL, '2022-09-27 13:06:15');

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
-- Table structure for table `patterns`
--

DROP TABLE IF EXISTS `patterns`;
CREATE TABLE IF NOT EXISTS `patterns` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patterns`
--

INSERT INTO `patterns` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Printe', 1, NULL, '2022-09-26 18:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `section_id`, `brand_id`, `category_id`, `product_name`, `product_code`, `product_color`, `product_price`, `product_discount`, `product_weight`, `product_video`, `main_image`, `short_description`, `long_description`, `wash_care`, `fabric`, `pattern`, `sleeve`, `fit`, `occasion`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 10, 4, 'China Casual T-Shirt', 'CCT01', 'Black', 2500.00, NULL, NULL, '', 'China Casual T-Shirt1663753128.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, '2022-09-21 16:38:48', '2022-09-21 17:17:47'),
(6, 1, 10, 4, 'White Casual Tshirt', 'WCT01', 'White', 1800.00, NULL, NULL, '', 'White Casual Tshirt1663753162.PNG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, '2022-09-21 16:39:22', '2022-09-21 17:17:47'),
(7, 1, 10, 29, 'Mi 5', 'Mi5-01', 'Black', 31200.00, NULL, NULL, '', 'Mi 51663753264.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 1, '2022-09-21 16:41:04', '2022-09-21 17:17:46'),
(8, 1, 10, 4, 'China Casual T-Shirt', 'CCT02', 'Black', 3600.00, NULL, NULL, '', 'China Casual T-Shirt1664093529.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', 1, '2022-09-25 15:12:10', '2022-09-25 15:12:10'),
(9, 1, 10, 4, 'White Casual Tshirt', 'WCT02', 'Black', 2500.00, NULL, NULL, '', 'White Casual Tshirt1664093557.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', 1, '2022-09-25 15:12:38', '2022-09-25 15:12:38'),
(10, 1, 10, 29, 'Mi mix', 'mimix-01', 'Blue', 2590.00, NULL, NULL, '', 'Mi mix1664093598.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', 1, '2022-09-25 15:13:18', '2022-09-25 15:13:18'),
(11, 1, 12, 4, 'Slim T-Shirt', 'SMT-01', 'Blue', 2500.00, NULL, NULL, '', 'Slim T-Shirt1664262731.jpg', NULL, NULL, NULL, 'Cottons', 'Printe', 'Full Sleeves', 'Slim Fit', 'Formal', NULL, NULL, NULL, 'No', 1, '2022-09-27 14:12:12', '2022-09-27 14:12:12');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `images` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Men', 1, '2022-08-30 10:23:33', '2022-09-17 18:51:12'),
(2, 'Women', 1, '2022-08-30 10:23:33', '2022-09-15 18:02:00'),
(3, 'Kids', 0, '2022-08-30 10:23:33', '2022-09-21 14:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `sleeves`
--

DROP TABLE IF EXISTS `sleeves`;
CREATE TABLE IF NOT EXISTS `sleeves` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sleeves`
--

INSERT INTO `sleeves` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Full Sleeves', 1, NULL, '2022-09-26 20:06:34'),
(3, 'Half Sleeve', 1, '2022-09-26 20:05:55', '2022-09-26 20:05:55');

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
