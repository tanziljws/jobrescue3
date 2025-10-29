-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 07:36 AM
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
-- Database: `jobrescue`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employer_id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `job_id`, `employer_id`, `worker_id`, `created_at`, `updated_at`) VALUES
(6, 14, 11, 12, '2025-10-25 01:30:49', '2025-10-27 19:53:05');

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
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `cover_letter` text NOT NULL,
  `proposed_budget` decimal(10,2) DEFAULT NULL,
  `estimated_days` int(11) DEFAULT NULL,
  `portfolio_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`portfolio_links`)),
  `status` enum('pending','accepted','rejected','withdrawn') NOT NULL DEFAULT 'pending',
  `employer_notes` text DEFAULT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `responded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `worker_id`, `cover_letter`, `proposed_budget`, `estimated_days`, `portfolio_links`, `status`, `employer_notes`, `applied_at`, `responded_at`, `created_at`, `updated_at`) VALUES
(2, 14, 12, 'karena saya jago desainbhvghvgcfgcftcxtdxdrxzxcvbnm,qwertyuio1234f ajs ch sah casN dh cnas chsa fhebfasgfhshfgsaygfhgsafhgshbfhsgfgsiufgisgfisgifugifgfisgiuf', 15000.00, 35000, '[\"https:\\/\\/open.spotify.com\\/playlist\\/0tmilmOU4h9Sp5WnUl5vAj\"]', 'accepted', 'yang bener', '2025-10-25 00:36:04', '2025-10-25 00:48:16', '2025-10-25 00:36:04', '2025-10-25 00:48:16');

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
-- Table structure for table `job_categories`
--

CREATE TABLE `job_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_categories`
--

INSERT INTO `job_categories` (`id`, `name`, `slug`, `description`, `icon`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Desain Grafis', 'desain-grafis', 'Jasa desain logo, banner, brosur, dan materi visual lainnya', '🎨', 1, '2025-10-10 03:40:19', '2025-10-10 03:40:19'),
(2, 'Catering & Kuliner', 'catering-kuliner', 'Layanan catering untuk event, makanan rumahan, dan jasa kuliner', '🍽️', 1, '2025-10-10 03:40:19', '2025-10-10 03:40:19'),
(3, 'Teknisi & Perbaikan', 'teknisi-perbaikan', 'Jasa perbaikan elektronik, AC, komputer, dan peralatan rumah tangga', '🔧', 1, '2025-10-10 03:40:19', '2025-10-10 03:40:19'),
(4, 'Kebersihan & Cleaning', 'kebersihan-cleaning', 'Jasa pembersihan rumah, kantor, dan area komersial', '🧹', 1, '2025-10-10 03:40:19', '2025-10-10 03:40:19'),
(5, 'Fotografi & Videografi', 'fotografi-videografi', 'Jasa foto dan video untuk event, produk, dan dokumentasi', '📸', 1, '2025-10-10 03:40:19', '2025-10-10 03:40:19'),
(6, 'Transportasi & Logistik', 'transportasi-logistik', 'Jasa pengiriman, pindahan, dan transportasi barang', '🚚', 1, '2025-10-10 03:40:19', '2025-10-10 03:40:19'),
(7, 'Event Organizer', 'event-organizer', 'Jasa penyelenggaraan acara, dekorasi, dan manajemen event', '🎉', 1, '2025-10-10 03:40:19', '2025-10-10 03:40:19'),
(8, 'Tukang & Konstruksi', 'tukang-konstruksi', 'Jasa tukang bangunan, renovasi, dan perbaikan rumah', '🏗️', 1, '2025-10-10 03:40:19', '2025-10-10 03:40:19'),
(9, 'Digital Marketing', 'digital-marketing', 'Jasa pemasaran digital, social media, dan promosi online', '📱', 1, '2025-10-10 03:40:19', '2025-10-10 03:40:19'),
(10, 'Pendidikan & Les', 'pendidikan-les', 'Jasa les privat, kursus, dan bimbingan belajar', '📚', 1, '2025-10-10 03:40:19', '2025-10-10 03:40:19'),
(11, 'Web Development', 'web-development', NULL, 'computer', 1, '2025-10-24 21:00:14', '2025-10-24 21:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

CREATE TABLE `job_postings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `employer_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `budget_min` decimal(10,2) DEFAULT NULL,
  `budget_max` decimal(10,2) DEFAULT NULL,
  `budget_type` enum('fixed','hourly','negotiable') NOT NULL DEFAULT 'negotiable',
  `location` varchar(255) NOT NULL,
  `job_type` enum('full_time','part_time','freelance','contract') NOT NULL,
  `status` enum('draft','pending','approved','active','completed','cancelled') NOT NULL DEFAULT 'pending',
  `deadline` date DEFAULT NULL,
  `requirements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`requirements`)),
  `skills_required` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills_required`)),
  `applications_count` int(11) NOT NULL DEFAULT 0,
  `is_urgent` tinyint(1) NOT NULL DEFAULT 0,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`id`, `title`, `description`, `employer_id`, `category_id`, `budget_min`, `budget_max`, `budget_type`, `location`, `job_type`, `status`, `deadline`, `requirements`, `skills_required`, `applications_count`, `is_urgent`, `approved_at`, `approved_by`, `created_at`, `updated_at`) VALUES
(14, 'Desain Logo', 'desain logo restoran yang modern dan kekinian', 11, 1, 20000.00, 50000.00, 'negotiable', 'Bogor', 'freelance', 'active', '2025-10-28', '[\"bisa desain\"]', '[\"canva\",\"photoshoop\"]', 1, 1, NULL, NULL, '2025-10-25 00:34:41', '2025-10-25 00:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `sender_role` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `conversation_id`, `sender_id`, `sender_role`, `body`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 6, 11, 'employer', 'kerja yang bener', NULL, '2025-10-25 01:47:27', '2025-10-25 01:47:27'),
(2, 6, 11, 'employer', 'kerja yang bener', NULL, '2025-10-27 06:16:31', '2025-10-27 06:16:31'),
(3, 6, 12, 'worker', 'iya dek', NULL, '2025-10-27 06:38:14', '2025-10-27 06:38:14'),
(4, 6, 12, 'worker', 'tes', NULL, '2025-10-27 19:53:05', '2025-10-27 19:53:05');

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
(5, '2025_10_10_103022_add_role_to_users_table', 2),
(6, '2025_10_10_103004_create_job_categories_table', 3),
(7, '2025_10_10_103338_create_job_postings_table', 4),
(8, '2025_10_10_104253_create_job_applications_table', 5),
(9, '2025_10_10_103016_create_reports_table', 6),
(10, '2025_10_23_030856_add_profile_photo_to_users_table', 7),
(11, '2025_10_25_053529_add_subscription_plan_to_users_table', 8),
(12, '2025_10_25_145100_create_conversations_table', 9),
(13, '2025_10_25_145200_create_messages_table', 9),
(14, '2025_10_25_153000_fix_conversations_job_fk', 10);

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
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reporter_id` bigint(20) UNSIGNED NOT NULL,
  `reported_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reported_job_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('user','job','fraud','spam','inappropriate','other') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `evidence` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`evidence`)),
  `status` enum('pending','investigating','resolved','dismissed') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `handled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('WcXPbA02elgw2DjEAgChqPFBDAZbQ5Z8XABFJzOq', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMFhESm5kS1N6TXhrbFRncHpJNkx1U0xBc2twYUJYT0s4YUp5TW1hQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC93b3JrZXIvam9icyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMjt9', 1761719367);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','worker','employer') NOT NULL DEFAULT 'worker',
  `subscription_plan` varchar(255) NOT NULL DEFAULT 'basic',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) NOT NULL DEFAULT 'Bogor',
  `district` varchar(255) DEFAULT NULL,
  `subdistrict` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `skills` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skills`)),
  `profile_photo` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `verified_at` timestamp NULL DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `total_reviews` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `subscription_plan`, `phone`, `address`, `city`, `district`, `subdistrict`, `bio`, `skills`, `profile_photo`, `is_verified`, `is_active`, `verified_at`, `rating`, `total_reviews`) VALUES
(1, 'Admin Job Rescue', 'admin@jobrescue.com', '2025-10-10 03:40:20', '$2y$12$73jyL767qmu3laGTuVWYQeboXN5cGAJPWD4CApryVK/hE1Fk5ekeO', NULL, '2025-10-10 03:40:20', '2025-10-27 22:08:40', 'admin', 'pro', '081234567890', 'Jl. Pajajaran No. 1, Bogor Tengah', 'Bogor', 'Bogor Tengah', 'Tegallega', 'Administrator sistem Job Rescue', NULL, 'avatars/0c37F39eXuoANcnW3W83ExZRPvZCh41YYSjDoOUg.jpg', 1, 1, '2025-10-10 03:40:20', 0.00, 0),
(7, 'Elklemer', 'elklemer@gmail.com', NULL, '$2y$12$hizQQedH4cpGZ1bwqahA3e1wyaaW5XCw/ihpRTDjTC7unzxmkrvcG', NULL, '2025-10-22 23:18:44', '2025-10-22 23:18:44', 'worker', 'pro', '(+62) 815 8526 7816', 'jalan.rose 71', 'Bogor', 'Bogor Selatan', 'muarasari', 'ganteng', '\"desain\"', NULL, 0, 1, NULL, 0.00, 0),
(9, 'THALITA', 'licha@gmail.com', NULL, '$2y$12$2b.4/aQQd.9Jxde.cvN15.4uhCjZacAXD9WHncr6zvSzxw7Z5dSle', NULL, '2025-10-23 23:42:03', '2025-10-23 23:42:03', 'worker', 'pro', '083808085800', 'ciapus', 'Bogor', 'Bogor Selatan', 'muarasari', 'kocak', '\"desain\"', NULL, 0, 1, NULL, 0.00, 0),
(11, 'HYSTERIA', 'hysteria@gmail.com', NULL, '$2y$12$Xpt3WzdabCBnrNb04P.tc.0QHKXfOs5FNV/mQ14jaeiU0pkQtIV56', NULL, '2025-10-24 23:55:28', '2025-10-27 22:15:28', 'employer', 'basic', '083808085870', 'jl. ahmad yani', 'Bogor', 'Bogor Selatan', 'muarasari', NULL, NULL, 'profile-photos/3uhNGug9L6ERGBOuRbVUW51jBKAdaZtgK4TRezOL.jpg', 0, 1, NULL, 0.00, 0),
(12, 'Benjamin Nayau', 'Nayau@gmail.com', NULL, '$2y$12$zAdQnf2ayqetu0EZKpB3b.zA/HuU/CpiTEBRrjselQhsRtMvoyPJi', NULL, '2025-10-25 00:06:23', '2025-10-25 00:06:23', 'worker', 'basic', '082123397766', 'jalan.rose 71', 'Bogor', 'Bogor Selatan', 'harjasari', NULL, '\"masak\"', NULL, 0, 1, NULL, 0.00, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `conversations_employer_id_worker_id_job_id_unique` (`employer_id`,`worker_id`,`job_id`),
  ADD KEY `conversations_worker_id_foreign` (`worker_id`),
  ADD KEY `conversations_job_id_foreign` (`job_id`);

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
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_applications_job_id_worker_id_unique` (`job_id`,`worker_id`),
  ADD KEY `job_applications_worker_id_foreign` (`worker_id`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_categories`
--
ALTER TABLE `job_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_categories_slug_unique` (`slug`);

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_postings_employer_id_foreign` (`employer_id`),
  ADD KEY `job_postings_category_id_foreign` (`category_id`),
  ADD KEY `job_postings_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_reporter_id_foreign` (`reporter_id`),
  ADD KEY `reports_reported_user_id_foreign` (`reported_user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_categories`
--
ALTER TABLE `job_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job_postings`
--
ALTER TABLE `job_postings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversations_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job_postings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `conversations_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job_postings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD CONSTRAINT `job_postings_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `job_postings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `job_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_postings_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_reported_user_id_foreign` FOREIGN KEY (`reported_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_reporter_id_foreign` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
