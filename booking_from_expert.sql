-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 09:08 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_from_expert`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL,
  `year` smallint(6) NOT NULL,
  `day` smallint(6) NOT NULL,
  `month` smallint(6) NOT NULL,
  `start_of_slot_id` bigint(20) UNSIGNED NOT NULL,
  `expert_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointment_date`, `year`, `day`, `month`, `start_of_slot_id`, `expert_id`, `user_id`, `created_at`, `updated_at`) VALUES
(27, '2020-05-10', 2020, 10, 5, 186, 12, 22, '2020-05-10 14:14:31', '2020-05-10 14:14:31'),
(28, '2020-05-10', 2020, 10, 5, 187, 12, 22, '2020-05-10 14:14:31', '2020-05-10 14:14:31'),
(29, '2020-05-10', 2020, 10, 5, 188, 12, 22, '2020-05-10 14:14:31', '2020-05-10 14:14:31'),
(35, '2020-05-10', 2020, 10, 5, 186, 12, 25, '2020-05-10 19:12:26', '2020-05-10 19:12:26'),
(36, '2020-05-10', 2020, 10, 5, 191, 12, 28, '2020-05-10 19:19:46', '2020-05-10 19:19:46'),
(39, '2020-05-11', 2020, 10, 5, 208, 12, 31, '2020-05-10 22:28:43', '2020-05-10 22:28:43'),
(40, '2020-05-11', 2020, 10, 5, 209, 12, 31, '2020-05-10 22:28:43', '2020-05-10 22:28:43'),
(41, '2020-05-11', 2020, 10, 5, 195, 12, 32, '2020-05-10 22:33:37', '2020-05-10 22:33:37'),
(42, '2020-05-11', 2020, 10, 5, 210, 33, 34, '2020-05-10 23:31:09', '2020-05-10 23:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_04_13_175531_create_admins_table', 1),
(4, '2019_06_05_094651_add_email_verified_at_column_to_admins_table', 1),
(5, '2020_05_09_192805_create_start_of_slots_table', 2),
(6, '2020_05_10_100110_create_appointments_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `start_of_slots`
--

CREATE TABLE `start_of_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `current_working_hours_start_am_or_pm` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_working_hours_start` smallint(5) UNSIGNED NOT NULL,
  `current_working_hours_in_minutes_start` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `start_of_slots`
--

INSERT INTO `start_of_slots` (`id`, `current_working_hours_start_am_or_pm`, `current_working_hours_start`, `current_working_hours_in_minutes_start`, `user_id`, `is_available`, `created_at`, `updated_at`) VALUES
(186, 'AM', 3, 'exactly', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(187, 'AM', 3, 'and 15 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(188, 'AM', 3, 'and 30 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(189, 'AM', 3, 'and 45 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(190, 'AM', 4, 'exactly', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(191, 'AM', 4, 'and 15 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(192, 'AM', 4, 'and 30 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(193, 'AM', 4, 'and 45 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(194, 'AM', 5, 'exactly', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(195, 'AM', 5, 'and 15 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(196, 'AM', 5, 'and 30 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(197, 'AM', 5, 'and 45 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(198, 'AM', 6, 'exactly', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(199, 'AM', 6, 'and 15 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(200, 'AM', 6, 'and 30 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(201, 'AM', 6, 'and 45 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(202, 'AM', 7, 'exactly', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(203, 'AM', 7, 'and 15 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(204, 'AM', 7, 'and 30 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(205, 'AM', 7, 'and 45 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(206, 'AM', 8, 'exactly', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(207, 'AM', 8, 'and 15 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(208, 'AM', 8, 'and 30 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(209, 'AM', 8, 'and 45 min', 12, 0, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(210, 'AM', 1, 'exactly', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(211, 'AM', 1, 'and 15 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(212, 'AM', 1, 'and 30 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(213, 'AM', 1, 'and 45 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(214, 'AM', 2, 'exactly', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(215, 'AM', 2, 'and 15 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(216, 'AM', 2, 'and 30 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(217, 'AM', 2, 'and 45 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(218, 'AM', 3, 'exactly', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(219, 'AM', 3, 'and 15 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(220, 'AM', 3, 'and 30 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(221, 'AM', 3, 'and 45 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(222, 'AM', 4, 'exactly', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(223, 'AM', 4, 'and 15 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(224, 'AM', 4, 'and 30 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(225, 'AM', 4, 'and 45 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(226, 'AM', 5, 'exactly', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(227, 'AM', 5, 'and 15 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(228, 'AM', 5, 'and 30 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(229, 'AM', 5, 'and 45 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(230, 'AM', 6, 'exactly', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(231, 'AM', 6, 'and 15 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(232, 'AM', 6, 'and 30 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(233, 'AM', 6, 'and 45 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(234, 'AM', 7, 'exactly', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(235, 'AM', 7, 'and 15 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(236, 'AM', 7, 'and 30 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(237, 'AM', 7, 'and 45 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(238, 'AM', 8, 'exactly', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(239, 'AM', 8, 'and 15 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(240, 'AM', 8, 'and 30 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(241, 'AM', 8, 'and 45 min', 33, 0, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(306, 'AM', 11, 'exactly', 40, 0, '2020-05-11 00:27:26', '2020-05-11 00:27:26'),
(307, 'AM', 11, 'and 15 min', 40, 0, '2020-05-11 00:27:26', '2020-05-11 00:27:26'),
(308, 'AM', 11, 'and 30 min', 40, 0, '2020-05-11 00:27:26', '2020-05-11 00:27:26'),
(309, 'AM', 11, 'and 45 min', 40, 0, '2020-05-11 00:27:26', '2020-05-11 00:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expert` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_working_hours_start_am_or_pm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_working_hours_start` smallint(5) UNSIGNED DEFAULT NULL,
  `current_working_hours_end_am_or_pm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_working_hours_end` smallint(5) UNSIGNED DEFAULT NULL,
  `current_timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `county` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_expert_verfied_from_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_expert` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `expert`, `current_working_hours_start_am_or_pm`, `current_working_hours_start`, `current_working_hours_end_am_or_pm`, `current_working_hours_end`, `current_timezone`, `county`, `is_expert_verfied_from_admin`, `is_expert`, `remember_token`, `created_at`, `updated_at`) VALUES
(12, 'Quasi Shawa', 'Quasi_Shawa@gmail.com', '2020-05-09 17:36:34', '$2y$10$JDRYOzkLCLUVM/nah/JoY.ohvfhb/9HZGwMV8F3Of6JsTTdfAe42e', 'Civil engineer', 'AM', 3, 'AM', 9, 'Asia/Damascus', 'Syria', 0, 0, NULL, '2020-05-09 17:36:34', '2020-05-09 17:36:34'),
(22, 'eng yaser', 'engineeryaserddddomran@gmail.com', NULL, '$2y$10$f4KRC1UZg5dp9MvDqInpx.BNSdPgAxvOB8Y9/arve3ca0wkQOIuA.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-05-10 14:14:31', '2020-05-10 14:14:31'),
(23, 'yaser', 'v3o@diovo.com', NULL, '$2y$10$ey6Hun5RGI.D9ka5OeTDlOUWPE4AQct0Mv8OdXMiXYshilB5j9USG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-05-10 19:04:46', '2020-05-10 19:04:46'),
(24, 'yaser', 'rerern@gmail.com', NULL, '$2y$10$A1OcYr0ErSlkvY3KZB7/L.k80qSuOuwNTpB1Ib419QljlUt6sOwPa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-05-10 19:06:31', '2020-05-10 19:06:31'),
(25, 'dfdfdfd', 'dfdfdfdmran@gmail.com', NULL, '$2y$10$xOjiy.sk8rpWz0AEkIsLnOn5b14sSXiRWKG/spEAlYzUEM/o0/dG2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-05-10 19:12:26', '2020-05-10 19:12:26'),
(28, '32323', '323232mran@gmail.com', NULL, '$2y$10$W.mrHjS4swK1leRxabFc5OEGi93grPv7GBZnUxWyikBbqr868Kv6m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-05-10 19:19:46', '2020-05-10 19:19:46'),
(31, '343434343', 'dfdfdfda@gmail.com', NULL, '$2y$10$LR7qREw1ZhKtIkuW4p7QcuNcXvi/Db813QUM6t7LNeB5tQfp3OxAG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-05-10 22:28:43', '2020-05-10 22:28:43'),
(32, 'gjr', 'rereromran@gmail.com', NULL, '$2y$10$y7BWbiRl2DKVNIpY.6HZHu8jO6EaXgL1NN6QIpUrmk0J2JGb99jq6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-05-10 22:33:37', '2020-05-10 22:33:37'),
(33, 'Li Wei', 'Li-Wei@gmail.com', '2020-05-09 17:36:34', '$2y$10$HfJp7uA.x.TTLn94je21RuwEupniXSQ3lr/uMtxol3WSIwmFnZFNq', 'Chinese teacher', 'AM', 1, 'AM', 9, 'Asia/China', 'China', 0, 0, NULL, '2020-05-10 23:21:34', '2020-05-10 23:21:34'),
(34, 'dfdf', 'dfdfdf@gmail.com', NULL, '$2y$10$OQ1ayGqa7ETEAyvR77JQI.eqgeceUqwHgxMhBb7XzueUXGomoq4l.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, '2020-05-10 23:31:09', '2020-05-10 23:31:09'),
(40, 'Shimaa Badawy', 'dsdsdsdsei@gmail.com', NULL, '$2y$10$XxR8VVVpIc7bpNRyOUkv0ee1mgCiuDjyfC.RIFYKRJyRr.6Hu8eT6', 'computer engineer', 'AM', 11, 'PM', 12, 'Asia/Damascus', 'Egypt', 0, 0, NULL, '2020-05-11 00:27:26', '2020-05-11 00:27:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_start_of_slot_id_foreign` (`start_of_slot_id`),
  ADD KEY `appointments_expert_id_foreign` (`expert_id`),
  ADD KEY `appointments_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `start_of_slots`
--
ALTER TABLE `start_of_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `start_of_slots_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `start_of_slots`
--
ALTER TABLE `start_of_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_expert_id_foreign` FOREIGN KEY (`expert_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointments_start_of_slot_id_foreign` FOREIGN KEY (`start_of_slot_id`) REFERENCES `start_of_slots` (`id`),
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `start_of_slots`
--
ALTER TABLE `start_of_slots`
  ADD CONSTRAINT `start_of_slots_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
