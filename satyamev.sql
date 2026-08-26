-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2026 at 04:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `satyamev`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `apartment_name` varchar(255) NOT NULL,
  `category` enum('ongoing','upcoming','completed') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `rooms` int(5) DEFAULT NULL,
  `area` int(5) DEFAULT NULL,
  `units` int(5) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `completion` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`id`, `project_id`, `apartment_name`, `category`, `image`, `location`, `rooms`, `area`, `units`, `description`, `completion`, `status`, `created_at`, `updated_at`) VALUES
(19, 1, 'Swastik Marvella', 'upcoming', 'projects/thumb/test-2026-08-14-124059.JPG', 'test', NULL, NULL, NULL, 'test', NULL, 1, '2026-08-14 07:10:59', '2026-08-20 09:04:32'),
(20, NULL, 'Keerthi Royal Palms', 'completed', 'projects/thumb/test-5-2026-08-14-124202.JPG', 'test', NULL, NULL, NULL, 'test', NULL, 1, '2026-08-14 07:12:02', '2026-08-14 07:12:02'),
(32, 1, 'Shlok Heights', 'ongoing', 'apartments/thumb/shlok-heights-2026-08-21.JPG', 'test', 3, 3, 3, 'test', '2026-08', 1, '2026-08-21 06:14:53', '2026-08-21 06:14:53'),
(34, 1, 'Swastik Marvella', 'ongoing', 'apartments/thumb/swastik-marvella-2026-08-21.JPG', 'test', 3, 3, 3, 'test', '2026-08', 1, '2026-08-21 06:21:49', '2026-08-21 06:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `apartment_images`
--

CREATE TABLE `apartment_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `apartment_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apartment_images`
--

INSERT INTO `apartment_images` (`id`, `apartment_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(82, 34, 'apartments/gallery/swastik-marvella-2026-08-21-iHV.JPG', 0, '2026-08-21 06:21:49', '2026-08-21 06:21:49'),
(83, 34, 'apartments/gallery/swastik-marvella-2026-08-21-yMd.JPG', 1, '2026-08-21 06:21:50', '2026-08-21 06:21:50'),
(84, 34, 'apartments/gallery/swastik-marvella-2026-08-21-keZ.JPG', 2, '2026-08-21 06:21:50', '2026-08-21 06:21:50'),
(85, 34, 'apartments/gallery/swastik-marvella-2026-08-21-nVi.JPG', 3, '2026-08-21 06:21:51', '2026-08-21 06:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:3;', 1787751983),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1787751982;', 1787751983),
('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6', 'i:1;', 1787752432),
('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer', 'i:1787752432;', 1787752432);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_10_121113_create_pages_table', 2),
(5, '2026_08_10_122341_create_apartments_table', 3),
(6, '2026_08_10_133901_create_galleries_table', 4),
(7, '2026_08_10_140559_create_timelines_table', 5),
(8, '2026_08_12_113754_create_projects_table', 6),
(9, '2026_08_12_113800_create_project_images_table', 6),
(10, '2026_08_12_153959_create_settings_table', 7),
(11, '2026_08_20_071008_rename_galleries_table_to_slides_table', 8),
(12, '2026_08_20_141110_rename_projects_table_to_apartments_table', 9),
(13, '2026_08_20_141239_rename_project_images_table_to_apartment_images_table', 10),
(14, '2026_08_20_141820_create_projects_table', 11),
(15, '2026_08_20_142057_add_project_id_to_apartments_table', 12),
(16, '2026_08_20_142217_add_project_id_to_apartments_table', 13),
(17, '2026_08_20_145303_rename_project_id_to_apartment_id_in_apartment_images_table', 14),
(18, '2026_08_26_103504_create_page_images_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'published',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `featured_image`, `status`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(20, 'Work', 'work', '<p>t</p>', 'pages/work-2026-08-26.JPG', 'published', NULL, 't', '2026-08-26 08:15:43', '2026-08-26 08:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `page_images`
--

CREATE TABLE `page_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_images`
--

INSERT INTO `page_images` (`id`, `page_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(26, 20, 'pages/images/XJQkWz-500.webp', 0, '2026-08-26 08:15:43', '2026-08-26 08:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `created_at`, `updated_at`) VALUES
(1, 'Satyamev Royal 1', NULL, NULL),
(2, 'Satyamev Royal 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CW0v5Re6nRG3umGEemt2y1yFgzCF6cwgMIr5GqmN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGE5Y1g5eFR4WXJKR0V3Q0xoN25KeklwS2xKdmQ2cmRXR285ckFMSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoyNToiZmlsYW1lbnQuYWRtaW4uYXV0aC5sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1787747813),
('LRwHjzTG173FWJvEvuWZQYshC6CySVX3OaC2Wq57', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoibEFxS1RpcmJIVjlXc2tOZlM1RHk0dzRvdWc0ZGt2dUxmTXEyTWx1TyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcHJvamVjdHMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjU5NjdiOWNjNTFiMjMyY2RjZGQ4ZTIzYjdlODI1Y2RjNTEyOGFmMWJkYTgzZmIwYzNkZjVhYjVjMDZhMWFlODIiO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1787753334),
('mTmxZvzevL0yn9mAxS7pFvnnaaZaQXwkK6AZ32PS', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiblZCdlU2dmhJeHJ4SEx2bDR0b3hyaWFXT2FhdHNSM1d0aVRyVWVIRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoyNToiZmlsYW1lbnQuYWRtaW4uYXV0aC5sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1787746957),
('oUZw6VSq6rpsQqn2WFvhS25ja5zUoeGwqXTUydfJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmFXaU1kUW9QajVLQ3pURVA1SE9RYWV6TUZ3TGN2RmswQ3VEbmhRSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoyNToiZmlsYW1lbnQuYWRtaW4uYXV0aC5sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1787747095),
('pg3L72yxdcSzwzEQnTMfw6dQNdHL76pkQNqsyAsW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiWjRtdDlNUVlVMnRSM21meFJEV1ZidzdMM2dtd21LaDRCMkdTc0IwaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcy8yMC9lZGl0IjtzOjU6InJvdXRlIjtzOjM1OiJmaWxhbWVudC5hZG1pbi5yZXNvdXJjZXMucGFnZXMuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjU5NjdiOWNjNTFiMjMyY2RjZGQ4ZTIzYjdlODI1Y2RjNTEyOGFmMWJkYTgzZmIwYzNkZjVhYjVjMDZhMWFlODIiO3M6NjoidGFibGVzIjthOjE6e3M6NDA6Ijk3OTJiNmRlNTczMTU2ZWMwNDVlYTgxODgxYmUzZDNkX2NvbHVtbnMiO2E6Mzp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjU6InRpdGxlIjtzOjU6ImxhYmVsIjtzOjU6IlRpdGxlIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo2OiJzdGF0dXMiO3M6NToibGFiZWwiO3M6NjoiU3RhdHVzIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiY3JlYXRlZF9hdCI7czo1OiJsYWJlbCI7czoxMDoiQ3JlYXRlZCBhdCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO319fXM6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1787752329),
('rObNIxfqMZXZf7eAZHVUz7KHi9ndTzEKygGtFPvn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWnlhS1JiZGVodnZBV3dLQTY0eTVHOVp0N2FmRGRBUEJRakdiMWVUTyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3BhZ2VzIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYWdlcyI7czo1OiJyb3V0ZSI7czozNjoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLnBhZ2VzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787747812);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `address_line1` varchar(100) DEFAULT NULL,
  `address_line2` varchar(100) DEFAULT NULL,
  `foreign_office` varchar(100) DEFAULT NULL,
  `business_line` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `theme_template` enum('default','modern','classic') NOT NULL DEFAULT 'default',
  `punch_line1` varchar(25) DEFAULT NULL,
  `punch_line2` varchar(25) DEFAULT NULL,
  `experience_line` varchar(100) DEFAULT NULL,
  `ceo_message` varchar(700) DEFAULT NULL,
  `ceo_name` varchar(25) DEFAULT NULL,
  `since` varchar(20) DEFAULT NULL,
  `hero` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `why` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`why`)),
  `showcase` longtext DEFAULT NULL,
  `primary_color` varchar(10) DEFAULT NULL,
  `secondary_color` varchar(10) DEFAULT NULL,
  `preloader` int(5) NOT NULL DEFAULT 1,
  `preloader_color` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `email`, `phone`, `mobile`, `address_line1`, `address_line2`, `foreign_office`, `business_line`, `facebook_url`, `instagram_url`, `theme_template`, `punch_line1`, `punch_line2`, `experience_line`, `ceo_message`, `ceo_name`, `since`, `hero`, `gallery`, `why`, `showcase`, `primary_color`, `secondary_color`, `preloader`, `preloader_color`, `created_at`, `updated_at`) VALUES
(1, 'Satyamev Group', 'info@satyamevgroup.com', '9824036846', '9824538519', 'Satyamev Group 301, Anand I-Pride, above Radhe Restaurant,', 'Visat-Tapovan Road, Motera, Ahmedabad – 380019.', '200-4170 Still Creek Drive, Burnaby BC V5C 6C6, Canada', 'Satyamev Group is a leading property developer, committed to creating exceptional living and working spaces in Gujarat.', 'http://www.facebook.com', 'http://www.facebook.com', 'default', 'Building Trust', 'Brick by Brick', 'More than 25 years of Experiences', 'Our vision is to create exceptional spaces that inspire better living and lasting value. Every project we undertake reflects our commitment to quality, innovation, transparency, and customer trust. We don&#039;t just build buildings—we create communities where families, businesses, and dreams can thrive for generations to come.', 'Jay Patel', '1997', '{\"500\":\"settings\\/hero\\/hero_500.webp\",\"800\":\"settings\\/hero\\/hero_800.webp\",\"1080\":\"settings\\/hero\\/hero_1080.webp\",\"1600\":\"settings\\/hero\\/hero_1600.webp\",\"1920\":\"settings\\/hero\\/hero_1920.webp\"}', '{\"500\":\"settings\\/why\\/why500.webp\",\"800\":\"settings\\/why\\/why800.webp\",\"1080\":\"settings\\/why\\/why1080.webp\",\"1600\":\"settings\\/why\\/why1600.webp\",\"1920\":\"settings\\/why\\/why1920.webp\"}', '{\"500\":\"settings\\/why\\/why500.webp\",\"800\":\"settings\\/why\\/why800.webp\",\"1080\":\"settings\\/why\\/why1080.webp\",\"1600\":\"settings\\/why\\/why1600.webp\",\"1920\":\"settings\\/why\\/why1920.webp\"}', '{\"500\":\"settings\\/showcase\\/showcase500.webp\",\"800\":\"settings\\/showcase\\/showcase800.webp\",\"1080\":\"settings\\/showcase\\/showcase1080.webp\",\"1600\":\"settings\\/showcase\\/showcase1600.webp\",\"1920\":\"settings\\/showcase\\/showcase1920.webp\"}', '#000000', '#FFFFFF', 1, '#340c24', '2026-08-12 14:49:50', '2026-08-20 08:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `size` varchar(11) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `image`, `description`, `size`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Test 2', 'settings/slides/test-2-20260820074308.JPG', 'test', '1500', 2, 1, '2026-08-20 02:13:08', '2026-08-20 02:13:08'),
(5, 'Slide 3', 'settings/slides/slide-3-20260821071024.JPG', 'test', NULL, 1, 1, '2026-08-21 01:40:24', '2026-08-21 01:40:24'),
(6, 'Test 1', 'settings/slides/test-1-20260821072756.JPG', 'test', NULL, 1, 1, '2026-08-21 01:57:56', '2026-08-21 01:57:56'),
(7, 'Test 4', 'settings/slides/test-4-20260821074237.JPG', 'test', NULL, 1, 1, '2026-08-21 02:12:37', '2026-08-21 02:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `timelines`
--

CREATE TABLE `timelines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timelines`
--

INSERT INTO `timelines` (`id`, `year`, `title`, `image`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(9, '1998', 'Satyamev Royal 7', 'timeline/satyamev-royal-7-1998.JPG', 'test', 0, '2026-08-21 01:39:49', '2026-08-21 01:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'mukeshbhavsar210@gmail.com', NULL, '$2y$12$JGSMbvnpgQEWOgJDIsuzse0kMuDeZx8joFOHx8rY3Pu0t7vuOQTri', '012Qw01LL32bVftvWeXv90eECbnVZ4qhGgYN8xeQpPxpbczIH1PsXY6MiR1j', '2026-08-10 06:40:31', '2026-08-10 06:40:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartments_project_id_foreign` (`project_id`);

--
-- Indexes for table `apartment_images`
--
ALTER TABLE `apartment_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_images_project_id_foreign` (`apartment_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `page_images`
--
ALTER TABLE `page_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_images_page_id_foreign` (`page_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timelines`
--
ALTER TABLE `timelines`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `apartment_images`
--
ALTER TABLE `apartment_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `page_images`
--
ALTER TABLE `page_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `timelines`
--
ALTER TABLE `timelines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `apartments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `apartment_images`
--
ALTER TABLE `apartment_images`
  ADD CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_images`
--
ALTER TABLE `page_images`
  ADD CONSTRAINT `page_images_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
