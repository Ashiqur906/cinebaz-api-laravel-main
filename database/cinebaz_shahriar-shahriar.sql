-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 29, 2021 at 02:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinebaz_shahriar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Top Menu', '2021-03-29 00:10:05', '2021-03-29 00:10:05'),
(2, 'Footer Menu', '2021-03-29 00:32:01', '2021-03-29 00:35:18'),
(3, 'Series', '2021-03-29 01:43:35', '2021-03-29 01:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu_items`
--

CREATE TABLE `admin_menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu` bigint(20) UNSIGNED NOT NULL,
  `depth` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu_items`
--

INSERT INTO `admin_menu_items` (`id`, `label`, `link`, `parent`, `sort`, `class`, `menu`, `depth`, `created_at`, `updated_at`) VALUES
(1, 'Home', '#', 0, 0, NULL, 1, 0, '2021-03-29 00:10:18', '2021-03-29 00:10:24'),
(2, 'Categories', 'http://localhost/cinebaz/category', 0, 1, NULL, 1, 0, '2021-03-29 00:28:56', '2021-03-29 00:37:38'),
(3, 'Series', 'http://localhost/cinebaz/category', 0, 0, NULL, 3, 0, '2021-03-29 01:46:17', '2021-03-29 01:46:21'),
(4, 'Series', 'http://localhost/cinebaz/series', 0, 2, NULL, 1, 0, '2021-03-29 01:48:24', '2021-03-29 03:44:38'),
(5, 'Season', '#', 4, 3, NULL, 1, 1, '2021-03-29 03:45:54', '2021-03-29 03:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age_limit` int(11) NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bannerimage.jpg',
  `read_status` int(11) NOT NULL DEFAULT 1,
  `play_button_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `play_button_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details_button_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details_button_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailler_button_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailler_button_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_bangla` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_english` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_hindi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT 'Yes',
  `create_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `menu_show` tinyint(1) DEFAULT NULL,
  `page_show` tinyint(1) DEFAULT NULL,
  `home_show` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title_bangla`, `title_english`, `title_hindi`, `slug`, `is_active`, `create_by`, `modified_by`, `created_at`, `updated_at`, `deleted_at`, `menu_show`, `page_show`, `home_show`) VALUES
(1, 'Movie', 'Movie', 'Movie-hindi', NULL, 'Yes', 1, 1, '2021-03-25 04:44:33', '2021-03-25 04:44:33', NULL, 1, 1, NULL),
(2, 'Drama Bangla', 'Drama Bangla', 'Drama Hindi', 'drama', 'Yes', 3, 3, '2021-03-28 00:17:47', '2021-03-28 00:17:47', NULL, 1, 1, NULL),
(3, 'Action bn', 'Action', 'Action hn', 'action', 'Yes', 3, 3, '2021-03-29 04:26:09', '2021-03-29 04:26:09', NULL, NULL, NULL, NULL),
(4, 'Thrill bn', 'Thriller', 'Thrill hn', 'Thriller', 'Yes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_hn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_hn` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description_bn` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description_hn` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age_limit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT 0,
  `published_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starring` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_by` int(11) DEFAULT NULL,
  `is_active` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `create_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `title_en`, `title_bn`, `title_hn`, `slug`, `description_en`, `description_bn`, `description_hn`, `short_description_en`, `short_description_bn`, `short_description_hn`, `age_limit`, `duration`, `release_year`, `video_type`, `premium`, `published_status`, `starring`, `remarks`, `sort_by`, `is_active`, `create_by`, `modified_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bomkesh', 'Bomkesh', 'Bomkesh', 'bomkesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, NULL, 'Yes', 3, 3, '2021-03-29 04:31:44', '2021-03-29 05:14:53', NULL),
(2, 'Chup Kotha', 'Chup Kotha', 'Chup Kotha', 'chup-kotha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, NULL, 'Yes', 3, 3, '2021-03-29 04:35:34', '2021-03-29 06:06:38', NULL),
(3, 'Chup Kotha', 'Chup Kotha', 'Chup Kotha', 'chup-kotha2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0', NULL, NULL, NULL, 'Yes', 3, 3, '2021-03-29 04:36:18', '2021-03-29 06:06:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media_category`
--

CREATE TABLE `media_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_category`
--

INSERT INTO `media_category` (`id`, `media_id`, `category_id`) VALUES
(1, 1, 4),
(2, 2, 2),
(3, 3, 2),
(4, 1, 1),
(5, 2, 1),
(6, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `media_tag`
--

CREATE TABLE `media_tag` (
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_tag`
--

INSERT INTO `media_tag` (`media_id`, `tag_id`) VALUES
(1, 1),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_08_11_073824_create_menus_wp_table', 1),
(4, '2017_08_11_074006_create_menu_items_wp_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2020_11_24_074058_create_pages_table', 1),
(7, '2020_11_24_105530_create_seos_table', 1),
(8, '2021_03_14_065549_create_banners_table', 1),
(9, '2021_03_21_091020_create_permission_tables', 1),
(10, '2021_03_22_085437_create_categories_table', 1),
(11, '2021_03_23_070223_create_settings_table', 1),
(12, '2021_03_24_062621_create_seasons_table', 1),
(13, '2021_03_24_070129_create_series_table', 1),
(14, '2021_03_24_112749_create_tags_table', 1),
(15, '2021_03_25_083526_create_media_table', 2),
(16, '2021_03_28_104723_create_media_category_table', 2),
(17, '2021_03_28_114524_create_media_tag_table', 2),
(18, '2021_03_29_065329_add_showable_to_categories', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_hn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title_hn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_bn` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_hn` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_by` int(11) DEFAULT NULL,
  `is_active` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `create_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title_en`, `title_bn`, `title_hn`, `sub_title_en`, `sub_title_bn`, `sub_title_hn`, `slug`, `description_en`, `description_bn`, `description_hn`, `remarks`, `sort_by`, `is_active`, `create_by`, `modified_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sample Page', NULL, NULL, 'Sample Subtitle', NULL, NULL, 'sample-page', 'sample sample....', NULL, NULL, NULL, NULL, 'No', 1, 1, '2021-03-25 05:09:58', '2021-03-25 05:09:58', NULL),
(2, 'Thriller', NULL, NULL, NULL, NULL, NULL, 'thriller', NULL, NULL, NULL, NULL, NULL, 'No', 3, 3, '2021-03-29 04:08:36', '2021-03-29 04:08:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-03-25 04:42:33', '2021-03-25 04:42:33'),
(2, 'editor', 'web', '2021-03-25 04:42:33', '2021-03-25 04:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_hn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `series_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT 'Yes',
  `sort_by` int(11) DEFAULT NULL,
  `create_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `canonical_tag` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seoable_id` bigint(20) UNSIGNED NOT NULL,
  `seoable_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_by` int(11) DEFAULT NULL,
  `is_active` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `create_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_tag`, `meta_type`, `meta_image`, `seoable_id`, `seoable_type`, `remarks`, `sort_by`, `is_active`, `create_by`, `modified_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'title', 'description', 'key', 'www.dd.com', NULL, NULL, 1, 'Cinebaz\\Page\\Models\\Page', NULL, NULL, 'No', 1, 1, '2021-03-25 05:09:58', '2021-03-25 05:09:58', NULL),
(2, 'drama', NULL, NULL, NULL, NULL, NULL, 2, 'Cinebaz\\Category\\Models\\Category', NULL, NULL, 'No', 3, 3, '2021-03-28 00:17:47', '2021-03-28 00:17:47', NULL),
(3, 'Detective', NULL, NULL, NULL, NULL, NULL, 2, 'Cinebaz\\Page\\Models\\Page', NULL, NULL, 'No', 3, 3, '2021-03-29 04:08:36', '2021-03-29 04:08:36', NULL),
(4, 'fight', NULL, NULL, NULL, NULL, NULL, 3, 'Cinebaz\\Category\\Models\\Category', NULL, NULL, 'No', 3, 3, '2021-03-29 04:26:09', '2021-03-29 04:26:09', NULL),
(5, 'drama', NULL, NULL, NULL, NULL, NULL, 3, 'Cinebaz\\Media\\Models\\Media', NULL, NULL, 'No', 3, 3, '2021-03-29 04:36:18', '2021-03-29 04:36:18', NULL),
(6, 'jhgig', NULL, NULL, NULL, NULL, NULL, 1, 'Cinebaz\\Media\\Models\\Media', NULL, NULL, 'Yes', NULL, 3, '2021-03-29 05:14:53', '2021-03-29 05:14:53', NULL),
(7, 'eid', NULL, NULL, NULL, NULL, NULL, 2, 'Cinebaz\\Media\\Models\\Media', NULL, NULL, 'Yes', NULL, 3, '2021-03-29 06:06:38', '2021-03-29 06:06:38', NULL),
(8, 'eid', NULL, NULL, NULL, NULL, NULL, 3, 'Cinebaz\\Media\\Models\\Media', NULL, NULL, 'Yes', NULL, 3, '2021-03-29 06:06:56', '2021-03-29 06:06:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_hn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT 'Yes',
  `sort_by` int(11) DEFAULT NULL,
  `create_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site-title', 'Site Title', 'Cinebaz | Move platform', NULL, 'text', 1, NULL, '2021-03-22 21:25:59', '2021-03-23 16:29:29'),
(2, 'site-logo', 'Site Logo', 'http://localhost/cinebaz/storage/uploads/setting/0.48687100 1616559019logo.png', NULL, 'image', 1, NULL, '2021-03-22 21:39:49', '2021-03-23 16:10:19'),
(3, 'site-copyright', 'Site Copyright', 'Copyright 2021 <a href=\"#\">Cinebaz</a> All Rights Reserved.', NULL, 'text_area', 1, NULL, '2021-03-23 16:28:40', '2021-03-23 16:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_hn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT 'Yes',
  `sort_by` int(11) DEFAULT NULL,
  `create_by` bigint(20) UNSIGNED DEFAULT NULL,
  `modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title_bn`, `title_en`, `title_hn`, `remarks`, `slug`, `is_active`, `sort_by`, `create_by`, `modified_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'new', 'new tag bn', 'tag hn', NULL, 'tag slug', 'Yes', NULL, 1, 1, '2021-03-25 05:43:00', '2021-03-25 05:43:00', NULL),
(2, 'Hot bn', 'Hot', 'hot hn', NULL, 'Hot', 'Yes', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Eid Collertion', 'Eid Collertion', 'Eid Collertion', NULL, 'Eid Collertion', 'Yes', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '2021-03-25 04:42:33', '$2y$10$JDMJmDnXD7.vFOcgotRXR.6SNufzRvytXslgWoCwqY63HbbzC4nBy', NULL, '2021-03-25 04:42:33', '2021-03-25 04:42:33'),
(2, 'editor', 'editor@gmail.com', '2021-03-25 04:42:33', '$2y$10$X/JwdQFbaG89CdC82i.n8uN5d6a/ErvMasBcBHv3VjNW7kbDAw3pa', NULL, '2021-03-25 04:42:33', '2021-03-25 04:42:33'),
(3, 'Mossaddak Hossain', 'shahriar@gmail.com', NULL, '$2y$10$Qbi3U37V9d6HplF0DfVGHusS3WlnHvBvWeIz0JmXyDyCWRxfFJmsq', '9pKGOxnvF89Y90mdoXVYzVD8RNp7xtuhuR1NaBzMvvXSUpOagAc45ULW21in', '2021-03-26 08:47:14', '2021-03-26 08:47:14'),
(4, 'Al Amin', 'alamin@gmail.com', NULL, '$2y$10$BNaSf.gsHYf8JKcQD3RtxeBbFTmMRYctBOcPDief0SEbKlJkr2b7i', NULL, '2021-03-27 08:59:15', '2021-03-27 08:59:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_menu_items_menu_foreign` (`menu`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_create_by_foreign` (`create_by`),
  ADD KEY `categories_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_slug_unique` (`slug`),
  ADD KEY `media_create_by_foreign` (`create_by`),
  ADD KEY `media_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `media_category`
--
ALTER TABLE `media_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_category_media_id_foreign` (`media_id`),
  ADD KEY `media_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `media_tag`
--
ALTER TABLE `media_tag`
  ADD KEY `media_tag_media_id_foreign` (`media_id`),
  ADD KEY `media_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_create_by_foreign` (`create_by`),
  ADD KEY `pages_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seasons_create_by_foreign` (`create_by`),
  ADD KEY `seasons_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seos_create_by_foreign` (`create_by`),
  ADD KEY `seos_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `series_create_by_foreign` (`create_by`),
  ADD KEY `series_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_create_by_foreign` (`create_by`),
  ADD KEY `tags_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media_category`
--
ALTER TABLE `media_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD CONSTRAINT `admin_menu_items_menu_foreign` FOREIGN KEY (`menu`) REFERENCES `admin_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `categories_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `media_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `media_category`
--
ALTER TABLE `media_category`
  ADD CONSTRAINT `media_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_category_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media_tag`
--
ALTER TABLE `media_tag`
  ADD CONSTRAINT `media_tag_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `media_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pages_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seasons`
--
ALTER TABLE `seasons`
  ADD CONSTRAINT `seasons_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `seasons_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `seos`
--
ALTER TABLE `seos`
  ADD CONSTRAINT `seos_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `seos_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `series_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tags_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
