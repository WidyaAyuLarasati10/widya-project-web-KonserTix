-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20260503.e79a6a78f4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2026 at 02:52 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_concert_ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@gmail.com|127.0.0.1', 'i:1;', 1792775447),
('laravel-cache-admin@gmail.com|127.0.0.1:timer', 'i:1792775447;', 1792775447);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` datetime NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'national'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `location`, `event_date`, `banner_image`, `created_at`, `updated_at`, `category`) VALUES
(1, 'Dewa 19 - Pesta Rakyat 30 Tahun Berkarya', 'Konser mahakarya Dewa 19 membawakan lagu-lagu legendaris bersama vokalis balad terbaik.', 'Stadion Utama GBK, Jakarta', '2026-11-20 19:30:00', '/images/dewa19.jpg', '2026-10-23 09:51:47', '2026-10-25 02:02:32', 'national'),
(2, 'Tulus - Tur Manusia 2026', 'Pengalaman musik hangat dan penuh makna bersama Tulus melantunkan lagu-lagu album Manusia.', 'Stadion Jatidiri, Semarang', '2026-12-05 19:00:00', '/images/tulus.jpg', '2026-10-23 09:51:47', '2026-10-23 09:51:47', 'national'),
(3, 'Payung Teduh - Akad Malam Syahdu', 'Malam syahdu penuh nostalgia dan alunan puitis bersama Payung Teduh di panggung terbuka.', 'Taman Balekambang, Surakarta', '2026-12-12 18:30:00', '/images/payungteduh.jpg', '2026-10-23 09:51:47', '2026-10-23 09:51:47', 'national'),
(4, 'Pamungkas - Birdy World Tour Special Edition', 'Pertunjukan intim Pamungkas dengan lagu-lagu hits khas synth-pop dan ballad.', 'Jogja Expo Center, Yogyakarta', '2026-12-19 20:00:00', '/images/pamungkas.jpg', '2026-10-23 09:51:47', '2026-10-23 09:51:47', 'national'),
(5, 'Perunggu - Pesta Olahraga & Musik Konser', 'Energi musik rock kantoran nan hangat dari grup musik Perunggu.', 'Bandung Convention Centre, Bandung', '2026-12-27 19:00:00', '/images/perunggu.jpg', '2026-10-23 09:51:47', '2026-10-23 09:51:47', 'national'),
(6, 'Taylor Swift - The Eras Tour Live in Jakarta', 'Tur sejarah dunia perjalanan karier Taylor Swift selama 3 jam penuh kejutan visual dan musik!', 'Stadion Utama GBK, Jakarta', '2027-01-10 18:00:00', '/images/taylorswift.jpg', '2026-10-23 09:51:47', '2026-10-23 09:51:47', 'international'),
(7, 'Oasis - Live \'27 World Reunion Tour', 'Kembalinya legenda Britpop dunia Noel & Liam Gallagher di satu panggung megah!', 'JIExpo Kemayoran, Jakarta', '2027-01-24 19:30:00', '/images/oasis.jpg', '2026-10-23 09:51:47', '2026-10-23 09:51:47', 'international'),
(8, 'Ariana Grande - Eternal Sunshine World Tour', 'Vokal spektakuler dan penampilan memukau Ariana Grande menyanyikan album terbarunya.', 'Indonesia Arena, Jakarta', '2027-02-05 20:00:00', '/images/arianagrande.jpg', '2026-10-23 09:51:47', '2026-10-23 09:51:47', 'international'),
(9, 'Justin Bieber - Justice World Tour', 'Aksi panggung penuh energik dari megabintang pop dunia Justin Bieber.', 'Stadion Madya GBK, Jakarta', '2027-02-18 19:00:00', '/images/justinbieber.jpg', '2026-10-23 09:51:47', '2026-10-23 09:51:47', 'international'),
(11, 'SZA - SOS World Tour Live in Jakarta', 'Malam penuh emosi R&B modern bersama SZA membawakan Kill Bill, Snooze, dan lagu hits favorit.', 'Indonesia Arena, Jakarta', '2027-03-15 20:00:00', '/images/sza.jpg', '2026-10-23 09:51:47', '2026-10-23 09:51:47', 'international'),
(12, 'Daniel Caesar - NEVER ENOUGH Asia Tour', 'Suara merdu soulful R&B Daniel Caesar membawakan Best Part, Get You, dan Always.', 'Balai Sarbini, Jakarta', '2027-03-28 19:30:00', '/images/danielcaesar.jpg', '2026-10-23 09:51:47', '2026-10-23 09:51:47', 'international'),
(18, 'Sheila On 7 - Tunggu Aku Di Solo (Tour 2026)', 'Konser tunggal Sheila On 7 dalam rangkaian tur album dan lagu-lagu hits nostalgia. Dapatkan tiket resmimu sekarang hanya di KonserTix!', 'Stadion Manahan, Surakarta', '2026-12-14 19:30:00', 'http://127.0.0.1:8000/storage/events/bOFbSuFpiL804xpnJGyYpACBqm9QfmOXoky6PwpW.jpg', '2026-10-25 01:51:02', '2026-10-25 01:51:02', 'national');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_06_015733_create_events_table', 1),
(5, '2026_10_06_015747_create_ticket_categories_table', 1),
(6, '2026_10_06_020000_create_orders_table', 1),
(7, '2026_10_06_135442_add_nik_to_orders_and_users_table', 1),
(8, '2026_10_06_142503_add_payment_method_to_orders_table', 1),
(9, '2026_10_23_084056_add_is_admin_to_users_table', 1),
(10, '2026_10_23_154324_add_category_to_events_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_category_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'qris',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `nik`, `ticket_category_id`, `quantity`, `total_amount`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(2, 'ORD-20261024-39LCI', 1, '1234567890123456', 20, 1, 6060000.00, 'QRIS', 'paid', '2026-10-23 19:51:39', '2026-10-25 00:20:28'),
(3, 'ORD-20261024-AKADD', 1, '1234567890123456', 29, 1, 4190000.00, 'QRIS', 'paid', '2026-10-24 01:15:14', '2026-10-25 00:22:42'),
(5, 'ORD-20261024-IRMO8', 4, '0836807579540986', 12, 1, 725000.00, 'QRIS', 'paid', '2026-10-24 01:18:56', '2026-10-25 00:42:26'),
(6, 'ORD-20261025-LGRFW', 4, '0836807579540986', 41, 3, 11230000.00, 'BCA VA', 'paid', '2026-10-25 00:42:02', '2026-10-25 02:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('c86l0PqpN2A0VwUYhta6dySu7cEBlK8vV8SwbayM', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIxVlBqM1RVWUdKak15clB4aDg2RzJRSWx6am56STVDZnZTenZmbzk3IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImFkbWluLmRhc2hib2FyZCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MiwicGFzc3dvcmRfaGFzaF93ZWIiOiIyMzY4OGFjNjA1YmI4MGQzZjEwZmE3MWRjZGVlZDdkODFmMjAyOGI4OTZhZDA0MDU4YmVmNzhiNTAxNWRiOWFkIn0=', 1792920375);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_categories`
--

INSERT INTO `ticket_categories` (`id`, `event_id`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(5, 2, 'VIP Seating (Numbered Seating)', 850000, 25, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(6, 2, 'CAT 1 (Front Standing)', 550000, 60, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(7, 2, 'Festival Standing (Free Standing)', 350000, 100, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(8, 2, 'Tribun Hemat (Numbered Seating)', 200000, 75, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(9, 3, 'VIP Senja Pass (Numbered Seating)', 400000, 30, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(10, 3, 'Front Pit (Free Standing)', 250000, 70, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(11, 3, 'Regular Lawn Pass (Free Standing)', 150000, 110, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(12, 4, 'To The Bone VIP (Numbered Seating)', 650000, 34, '2026-10-23 09:51:47', '2026-10-24 01:18:56'),
(13, 4, 'Birdy Lounge (Numbered Seating)', 450000, 50, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(14, 4, 'Festival Front (Free Standing)', 300000, 90, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(15, 4, 'Festival Back (Free Standing)', 180000, 120, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(16, 5, 'Garuda VIP (Numbered Seating)', 500000, 30, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(17, 5, '33x Ring Pit (Free Standing)', 350000, 65, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(18, 5, 'Tribun Festival (Numbered Seating)', 225000, 85, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(19, 5, 'Kantoran Pass (Free Standing)', 150000, 100, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(20, 6, 'Ultimate Karma VIP Package (Numbered Seating)', 5500000, 14, '2026-10-23 09:51:47', '2026-10-23 19:51:39'),
(21, 6, 'CAT 1 (VIP Floor - Free Standing)', 3500000, 30, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(22, 6, 'CAT 2 (Festival Floor - Free Standing)', 1800000, 100, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(23, 6, 'CAT 3 (Tribune Lower - Numbered Seating)', 1200000, 80, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(24, 6, 'CAT 4 (Tribune Upper - Restricted View)', 800000, 60, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(25, 7, 'Wonderwall Front Pit (Free Standing)', 3200000, 25, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(26, 7, 'Don\'t Look Back In Anger VIP (Numbered Seating)', 2500000, 40, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(27, 7, 'Champagne Supernova (Free Standing)', 1750000, 80, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(28, 7, 'Supersonic Regular (Free Standing)', 1100000, 110, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(29, 8, 'VIP Sweetener Lounge (Numbered Seating)', 3800000, 19, '2026-10-23 09:51:47', '2026-10-24 01:15:14'),
(30, 8, 'CAT 1 (Front Stage - Standing)', 2600000, 45, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(31, 8, 'Positions Festival (Free Standing)', 1600000, 75, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(32, 8, 'Tribune Seating (Numbered Seating)', 950000, 90, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(33, 9, 'Ghost VIP Experience (Numbered Seating)', 4200000, 20, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(34, 9, 'Justice Pit (Free Standing)', 2800000, 50, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(35, 9, 'Peaches Festival (Free Standing)', 1750000, 90, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(36, 9, 'Lonely Tribune (Numbered Seating)', 1050000, 80, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(41, 11, 'Snooze VIP Lounge (Numbered Seating)', 3400000, 17, '2026-10-23 09:51:47', '2026-10-25 00:42:02'),
(42, 11, 'Kill Bill Pit (Free Standing)', 2250000, 50, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(43, 11, 'SOS Festival Zone (Free Standing)', 1400000, 85, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(44, 11, 'Saturn Upper Tier (Numbered Seating)', 900000, 75, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(45, 12, 'Best Part VIP Seating (Numbered Seating)', 2750000, 25, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(46, 12, 'Get You Front Pit (Free Standing)', 1850000, 60, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(47, 12, 'Always Regular Seating (Numbered Seating)', 1200000, 90, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(48, 12, 'Cyanide Tribune (Numbered Seating)', 750000, 70, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(88, 18, 'Pejantan Tambun VIP', 1250000, 100, '2026-10-25 01:51:02', '2026-10-25 01:51:02'),
(89, 18, 'CAT 1 (Tunggu Aku Zone)', 850000, 200, '2026-10-25 01:51:02', '2026-10-25 01:51:02'),
(90, 18, 'CAT 2 (Sephia Festival)', 550000, 60, '2026-10-25 01:51:02', '2026-10-25 01:51:02'),
(91, 18, 'Tribun Kita', 350000, 40, '2026-10-25 01:51:02', '2026-10-25 01:51:02'),
(92, 1, 'VIP Restoe Boemi (Numbered Seating)', 1250000, 3, '2026-10-25 02:02:32', '2026-10-25 02:02:32'),
(93, 1, 'CAT 1 (VIP Floor - Standing)', 750000, 20, '2026-10-25 02:02:32', '2026-10-25 02:02:32'),
(94, 1, 'Festival Laskar Cinta (Free Standing)', 450000, 12, '2026-10-25 02:02:32', '2026-10-25 02:02:32'),
(95, 1, 'Tribun Upper (Numbered Seating)', 250000, 79, '2026-10-25 02:02:32', '2026-10-25 02:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dian', 'dian@gmail.com', 0, NULL, '$2y$12$gczpaY1wvraxZx3XuIfv7eSNl7oFGyM0pXo1tfYlahZOL2yBf6JMW', NULL, '2026-10-23 09:51:47', '2026-10-23 09:51:47'),
(2, 'Admin KonserTix', 'admin@konsertix.id', 1, NULL, '$2y$12$v0vaERrPYLI8FUyZxiJWc.u1RqMPM8sRXbKwS5JI2t9MQtcteXjf2', NULL, '2026-10-23 09:58:03', '2026-10-23 09:58:03'),
(3, 'Admin Konser Tix', 'admin@gmail.com', 0, NULL, '$2y$12$8IPHc24DXDRKMYHBE6XuoOjvPq4phCR5mtgoD1EAV8lOE1hgKTuPq', NULL, '2026-10-23 10:15:30', '2026-10-23 10:15:30'),
(4, 'widya', 'widya@gmail.com', 0, NULL, '$2y$12$KbuBCUaKsijUgrz2foEoAuA9heeAGCu.VOQJxlU8pxdgaA1ML1zkS', NULL, '2026-10-24 01:18:10', '2026-10-24 01:18:10');

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_ticket_category_id_foreign` (`ticket_category_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_categories_event_id_foreign` (`event_id`);

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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ticket_category_id_foreign` FOREIGN KEY (`ticket_category_id`) REFERENCES `ticket_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD CONSTRAINT `ticket_categories_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
