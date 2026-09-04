-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 04, 2026 at 07:35 AM
-- Server version: 11.8.8-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u603509256_satyamev`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rooms` int(5) DEFAULT NULL,
  `area` int(5) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `show` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`id`, `project_id`, `rooms`, `area`, `description`, `show`, `created_at`, `updated_at`) VALUES
(38, 5, 3, 1250, 'test', 'yes', '2026-09-03 11:37:23', '2026-09-03 11:37:23'),
(39, 7, 4, 1900, 'Awesome 4 BHK property', 'yes', '2026-09-03 13:22:57', '2026-09-03 13:22:57');

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
(88, 38, 'apartments/gallery/-2026-09-03-JQF.jpg', 0, '2026-09-03 11:37:23', '2026-09-03 11:37:23'),
(89, 38, 'apartments/gallery/-2026-09-03-ldx.jpg', 1, '2026-09-03 11:37:23', '2026-09-03 11:37:23'),
(90, 38, 'apartments/gallery/-2026-09-03-emP.jpg', 2, '2026-09-03 11:37:23', '2026-09-03 11:37:23'),
(91, 39, 'apartments/gallery/-2026-09-03-XrY.jpg', 0, '2026-09-03 13:22:57', '2026-09-03 13:22:57'),
(92, 39, 'apartments/gallery/-2026-09-03-sXm.jpg', 1, '2026-09-03 13:22:57', '2026-09-03 13:22:57'),
(93, 39, 'apartments/gallery/-2026-09-03-LeG.jpg', 2, '2026-09-03 13:22:58', '2026-09-03 13:22:58'),
(94, 39, 'apartments/gallery/-2026-09-03-cKl.jpg', 3, '2026-09-03 13:22:58', '2026-09-03 13:22:58'),
(95, 39, 'apartments/gallery/-2026-09-03-yhH.jpg', 4, '2026-09-03 13:22:58', '2026-09-03 13:22:58');

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
('satyamev_cache_356a192b7913b04c54574d18c28d46e6395428ab', 'i:5;', 1788442368),
('satyamev_cache_356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1788442368;', 1788442368),
('satyamev_cache_livewire-rate-limiter:11d6ad6bca43649060b7f4955091554013af5552', 'i:2;', 1788428427),
('satyamev_cache_livewire-rate-limiter:11d6ad6bca43649060b7f4955091554013af5552:timer', 'i:1788428427;', 1788428427),
('satyamev_cache_livewire-rate-limiter:1e3da602a55d3a78776cd39aae71013f78303b4e', 'i:1;', 1788442191),
('satyamev_cache_livewire-rate-limiter:1e3da602a55d3a78776cd39aae71013f78303b4e:timer', 'i:1788442191;', 1788442191),
('satyamev_cache_livewire-rate-limiter:8254d9bc8f508c01164a8c2f13ab0d8fbbc1bae5', 'i:1;', 1788506700),
('satyamev_cache_livewire-rate-limiter:8254d9bc8f508c01164a8c2f13ab0d8fbbc1bae5:timer', 'i:1788506700;', 1788506700),
('satyamev_cache_livewire-rate-limiter:e89fd5f4afcc568ab0f41ee7c0a3ee3c13a4f504', 'i:1;', 1788427293),
('satyamev_cache_livewire-rate-limiter:e89fd5f4afcc568ab0f41ee7c0a3ee3c13a4f504:timer', 'i:1788427293;', 1788427293);

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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `show` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `image`, `description`, `show`, `created_at`, `updated_at`) VALUES
(1, 'test 2', NULL, 'test 2', 'yes', '2026-09-04 00:53:22', '2026-09-04 06:29:17');

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
  `featured_title` varchar(100) DEFAULT NULL,
  `featured_description` text DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `featured_title`, `featured_description`, `featured_image`, `status`, `created_at`, `updated_at`) VALUES
(25, 'Work', 'work', '<p>test</p>', 'Second Title', 'test', 'pages/work-2026-08-31.webp', 'published', '2026-08-31 12:31:46', '2026-08-31 12:31:46'),
(26, 'Test', 'test', '<p>Test contents</p>', 'Featured Title', 'test', 'pages/test-2026-09-03.jpg', 'published', '2026-09-03 13:32:28', '2026-09-03 13:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `page_images`
--

CREATE TABLE `page_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_images`
--

INSERT INTO `page_images` (`id`, `page_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(36, 25, 'pages/images/kpPcp4-500.webp', 0, '2026-08-31 12:31:46', '2026-08-31 12:31:46'),
(37, 25, 'pages/images/PuTIkX-500.webp', 0, '2026-08-31 12:31:46', '2026-08-31 12:31:46'),
(38, 26, 'pages/images/ze1V9z-500.webp', 0, '2026-09-03 13:32:28', '2026-09-03 13:32:28'),
(39, 26, 'pages/images/bRh6cD-500.webp', 0, '2026-09-03 13:32:28', '2026-09-03 13:32:28'),
(40, 26, 'pages/images/77tfP5-500.webp', 0, '2026-09-03 13:32:28', '2026-09-03 13:32:28'),
(41, 26, 'pages/images/0GAPM6-500.webp', 0, '2026-09-03 13:32:28', '2026-09-03 13:32:28');

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
  `title` varchar(100) NOT NULL,
  `category` enum('ongoing','upcoming','completed') NOT NULL DEFAULT 'ongoing',
  `location` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `pdf` varchar(200) DEFAULT NULL,
  `units` varchar(11) DEFAULT NULL,
  `rera` varchar(100) DEFAULT NULL,
  `completion` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `year` varchar(5) DEFAULT NULL,
  `timeline` enum('yes','no') NOT NULL DEFAULT 'yes',
  `show` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `category`, `location`, `image`, `pdf`, `units`, `rera`, `completion`, `description`, `year`, `timeline`, `show`, `created_at`, `updated_at`) VALUES
(5, 'Satyamev Royal 1', 'ongoing', 'Mansarovar road', 'projects/satyamev-royal-1.webp', 'projects/satyamev-royal-1.pdf', '700', 'RERA', '2026-09', 'Awesome Property', '2026', 'yes', 'yes', '2026-09-03 11:28:20', '2026-09-04 04:47:31'),
(6, 'Satyamev Royal 2', 'ongoing', 'Tragad road', 'projects/satyamev-royal-2.jpg', 'projects/satyamev-royal-2.pdf', '400', 'RERA 123', '2026-09', 'Awesome Property 2', '2024', 'yes', 'yes', '2026-09-03 11:36:55', '2026-09-04 04:47:38'),
(7, 'Satyamev Royal 10', 'ongoing', 'TP 44, Chandkheda', 'projects/satyamev-royal-10.jpg', 'projects/satyamev-royal-10.pdf', '300', 'RERA', NULL, 'Awesome Property', '2025', 'yes', 'yes', '2026-09-03 13:21:40', '2026-09-04 04:47:45');

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
('gB0vCxrTEifwlmngJB5HziRhHG641nL0kB9AZ41l', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.135.0 Chrome/148.0.7778.280 Electron/42.8.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUtjbFVLN3dsdmFkVGtRUEZqRmNRbFZoa0xCYTA0VHExemo2MnIwYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787920272),
('hIaWxKZiXnXEbA6wFQkrfSNZ1gRviirlUzwGtzfc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWxPZ2FhTjZvdHV6RDF3QVRYSWJJTmRiSXZCVDlRS2VXd3l3NE1LWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGFydG1lbnRzIjtzOjU6InJvdXRlIjtzOjEwOiJhcGFydG1lbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787921675),
('J1vI3gLzq8goGFrd9OQaPuVgGbnxm1liKd6OEuwc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlZKTHlzQ1AzOWhaR3dHWUxQeFVjVHY5ekNKVHNzUnFaU1ExbTV4YyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787923322),
('oAblTPpxDoX1wYbVGLyZ16eQGiuavT3JS6YjAn1y', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZnBPMjJvUjcwQ0dqRkQ2SGVMM08wTTlnWkdxcHVlVUFCallBNlpHNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zZXR0aW5ncyI7czo1OiJyb3V0ZSI7czozOToiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLnNldHRpbmdzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjU5NjdiOWNjNTFiMjMyY2RjZGQ4ZTIzYjdlODI1Y2RjNTEyOGFmMWJkYTgzZmIwYzNkZjVhYjVjMDZhMWFlODIiO30=', 1787927709),
('QyYzgNAX2zpovP0hm3nSfcXovwUskpDtOAuESozc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYzdsOFR0VGdTRmRQTjBwSEVvV0gyakVSOWF6YUV0bmxGMFJqMkU4YiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoyNToiZmlsYW1lbnQuYWRtaW4uYXV0aC5sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1787920474),
('t2HjsnmjNx5C0zFp4rWPsLHa3cdW2eLP6vdMhifx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWU9GSWQzSzBFeW1MZW1HbjZ5WlVwT3RYUzh0dkVsZVAzZzJjWGVaViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGFydG1lbnRzIjtzOjU6InJvdXRlIjtzOjEwOiJhcGFydG1lbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787923089),
('U4fhzjJNIE0UEbMXDLxjmUsRMCVhuxniflAGnbf8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHVwT0FwaWhYaVpnZWwwU3c1RXdQSkxmOFIwWEhyMDRuN09xbFRCdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787923162),
('vMvfjQ4nf8lDEI0HMMlPFPSaCSDm5B8zuSigi76B', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialRrSUg2SFpXVXUwUjFNQkU0a0xDWjVCbUxNMk45TnVjYlk2aWlMNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGFydG1lbnRzIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1787920774),
('Vw8ICdyfdWjn3IFR0OJXnRsDC5ZCv19kHG1JATXg', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNVZxOVFnd3NlamdocVRnTzloRFJTZ2pYaGtzNHFkeTR5b0pEc2dHZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGFydG1lbnRzIjtzOjU6InJvdXRlIjtzOjEwOiJhcGFydG1lbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiNTk2N2I5Y2M1MWIyMzJjZGNkZDhlMjNiN2U4MjVjZGM1MTI4YWYxYmRhODNmYjBjM2RmNWFiNWMwNmExYWU4MiI7fQ==', 1787921164),
('ZsZVja03KrVvNariT4U4qwjr9uVJvMRN69yCw386', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlN4bUg1UTNpYTE0SE44UW9vSG5scEdrVVN2MnlsZW0wd0hEd05QNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGFydG1lbnRzL2luZGV4LnBocCI7czo1OiJyb3V0ZSI7czoxODoiYXBhcnRtZW50cy5kZXRhaWxzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787922739);

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
  `whatsapp` varchar(11) DEFAULT NULL,
  `address_line1` varchar(100) DEFAULT NULL,
  `address_line2` varchar(100) DEFAULT NULL,
  `foreign_office` varchar(100) DEFAULT NULL,
  `business_line` varchar(255) DEFAULT NULL,
  `google_map` text DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL,
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
  `preloader_line1` varchar(50) DEFAULT NULL,
  `preloader_line2` varchar(50) DEFAULT NULL,
  `preloader_color` varchar(10) DEFAULT NULL,
  `cookies` int(5) NOT NULL DEFAULT 1,
  `arch_color` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `email`, `phone`, `mobile`, `whatsapp`, `address_line1`, `address_line2`, `foreign_office`, `business_line`, `google_map`, `linkedin`, `facebook`, `instagram`, `youtube`, `theme_template`, `punch_line1`, `punch_line2`, `experience_line`, `ceo_message`, `ceo_name`, `since`, `hero`, `gallery`, `why`, `showcase`, `primary_color`, `secondary_color`, `preloader`, `preloader_line1`, `preloader_line2`, `preloader_color`, `cookies`, `arch_color`, `created_at`, `updated_at`) VALUES
(1, 'Satyamev Group', 'info@satyamevgroup.com', '9824036846', '9824538519', '9824036846', 'Satyamev Group 301, Anand I-Pride, above Radhe Restaurant,', 'Visat-Tapovan Road, Motera, Ahmedabad – 380019.', '200-4170 Still Creek Drive, Burnaby BC V5C 6C6, Canada', 'Satyamev Group is a leading property developer, committed to creating exceptional living and working spaces in Gujarat.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3669.410096723922!2d72.56492787514354!3d23.11868077910652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e83bef4f45bcb%3A0xc192409abf8ab93d!2sShlok%20Heights!5e0!3m2!1sen!2sin!4v1788437460826!5m2!1sen!2sin', 'http://www.facebook.com', 'http://www.facebook.com', 'http://www.facebook.com', 'http://www.facebook.com', 'default', 'Crafting Landmarks', 'Creating Legacies', 'More than 25 years of Experiences', 'Our vision is to create exceptional spaces that inspire better living and lasting value. Every project we undertake reflects our commitment to quality, innovation, transparency, and customer trust. We don&#039;t just build buildings—we create communities where families, businesses, and dreams can thrive for generations to come.', 'Jay Patel', '1997', '{\"500\":\"settings\\/hero\\/hero_500.webp\",\"800\":\"settings\\/hero\\/hero_800.webp\",\"1080\":\"settings\\/hero\\/hero_1080.webp\",\"1600\":\"settings\\/hero\\/hero_1600.webp\",\"1920\":\"settings\\/hero\\/hero_1920.webp\"}', '{\"500\":\"settings\\/gallery\\/gallery_500.webp\",\"800\":\"settings\\/gallery\\/gallery_800.webp\",\"1080\":\"settings\\/gallery\\/gallery_1080.webp\",\"1600\":\"settings\\/gallery\\/gallery_1600.webp\",\"1920\":\"settings\\/gallery\\/gallery_1920.webp\"}', '{\"500\":\"settings\\/why\\/why500.webp\",\"800\":\"settings\\/why\\/why800.webp\",\"1080\":\"settings\\/why\\/why1080.webp\",\"1600\":\"settings\\/why\\/why1600.webp\",\"1920\":\"settings\\/why\\/why1920.webp\"}', '{\"500\":\"settings\\/showcase\\/showcase500.webp\",\"800\":\"settings\\/showcase\\/showcase800.webp\",\"1080\":\"settings\\/showcase\\/showcase1080.webp\",\"1600\":\"settings\\/showcase\\/showcase1600.webp\",\"1920\":\"settings\\/showcase\\/showcase1920.webp\"}', '#000000', '#FFFFFF', 1, 'Crafting Landmarks', 'Creating Legacies', '#340c24', 1, '#5bcedb', '2026-08-12 14:49:50', '2026-09-03 13:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `show` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `image`, `description`, `show`, `created_at`, `updated_at`) VALUES
(2, 'Digant Jobanputra', 'Manager', 'settings/testimonial/digant-jobanputra.png', 'Awesome place to live, great location at Zundal Circle with nearby BRTS connectivity.  All the required amenities and well-structured flats with large balconies.', 'yes', '2026-09-04 00:36:17', '2026-09-04 00:40:48');

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
  `role` enum('admin','author','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mukesh Bhavsar', 'mukeshbhavsar210@gmail.com', NULL, '$2y$12$TEdCCGRU0djfOyRzaRbN5uvxMyrk8EZOKYFZQglL2Om297l6/sUl6', 'admin', 'rDWS2HzZIvbBj5eBJd79kxen8TT3tB1SmK57vE9MD30ALeCdH7lT2fGpHpd4', '2026-08-10 06:40:31', '2026-09-03 09:39:25'),
(5, 'Hardikbhai Shah', 'hardikshah@gmail.com', NULL, '$2y$12$BTW1HlVncco2X9niMRq8beBeRSEmXye5qflQBLd5AwzxrGjTSG5Bu', 'author', NULL, '2026-09-03 13:28:25', '2026-09-04 07:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `whies`
--

CREATE TABLE `whies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whies`
--

INSERT INTO `whies` (`id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'test 2', 'Customer-Centric Approach', 'Our commitment to putting our customers first has earned us a reputation as a reliable and trustworthy developer, focused on building lasting relationships', '2026-09-03 23:59:09', '2026-09-04 00:06:02');

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
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `whies`
--
ALTER TABLE `whies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `apartment_images`
--
ALTER TABLE `apartment_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `page_images`
--
ALTER TABLE `page_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `whies`
--
ALTER TABLE `whies`
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
