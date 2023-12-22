-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 02:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `affiliate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_SuperAdmin` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: No, 1: Yes',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `image`, `is_SuperAdmin`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'admin@gmail.com', '1702014556.jpg', 1, 1, '2023-12-04 06:48:10', '$2y$12$sfQ0o8FqulqHi9yNKcvefO.4yJxV4Iuu4mW.j/PKmJdLs5vqa1nJq', 'OeuTt4Bvylt98DCl6ANJ7FnB0I7jZz9b8RTmj6L3qRaEDSTCSSnAObgtSNv1', '2023-12-04 07:44:31', '2023-12-08 00:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affiliates`
--

INSERT INTO `affiliates` (`id`, `user_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2023-12-04 07:56:40', '2023-12-04 07:56:40'),
(4, 5, 2, '2023-12-06 01:14:51', '2023-12-06 01:14:51'),
(5, 6, 5, '2023-12-06 01:16:07', '2023-12-06 01:16:07'),
(6, 7, 5, '2023-12-06 01:17:38', '2023-12-06 01:17:38'),
(7, 8, 7, '2023-12-06 01:18:49', '2023-12-06 01:18:49'),
(8, 9, 7, '2023-12-06 01:23:38', '2023-12-06 01:23:38'),
(9, 10, 7, '2023-12-06 01:24:51', '2023-12-06 01:24:51'),
(10, 11, 10, '2023-12-06 01:27:30', '2023-12-06 01:27:30'),
(11, 12, 10, '2023-12-06 01:28:24', '2023-12-06 01:28:24'),
(12, 13, 9, '2023-12-06 01:35:25', '2023-12-06 01:35:25'),
(13, 14, 13, '2023-12-06 01:37:16', '2023-12-06 01:37:16'),
(14, 15, 11, '2023-12-06 01:39:31', '2023-12-06 01:39:31'),
(15, 16, 7, '2023-12-06 02:27:29', '2023-12-06 02:27:29'),
(16, 17, 16, '2023-12-06 02:29:19', '2023-12-06 02:29:19'),
(17, 18, 17, '2023-12-06 02:31:00', '2023-12-06 02:31:00'),
(18, 19, 17, '2023-12-06 02:32:17', '2023-12-06 02:32:17'),
(25, 26, NULL, '2023-12-11 05:36:11', '2023-12-11 05:36:11'),
(29, 30, NULL, '2023-12-11 07:10:24', '2023-12-11 07:10:24'),
(30, 31, 30, '2023-12-11 07:13:04', '2023-12-11 07:13:04'),
(31, 32, NULL, '2023-12-12 08:25:39', '2023-12-12 08:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commission_percentages`
--

CREATE TABLE `commission_percentages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_level` varchar(255) NOT NULL,
  `commission_percentage` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commission_percentages`
--

INSERT INTO `commission_percentages` (`id`, `parent_level`, `commission_percentage`, `created_at`, `updated_at`) VALUES
(1, '1', '5', NULL, '2023-12-11 07:17:27'),
(2, '2', '3', NULL, '2023-12-07 07:55:36'),
(3, '3', '1', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_12_04_113037_create_admins_table', 1),
(7, '2023_12_04_122541_add_image_to_users_table', 2),
(8, '2023_12_04_122610_add_image_to_admins_table', 2),
(9, '2023_12_04_123831_create_affiliates_table', 3),
(10, '2023_12_07_080324_create_products_table', 4),
(11, '2023_12_07_093134_create_carts_table', 5),
(12, '2023_12_07_114316_create_orders_table', 6),
(13, '2023_12_07_114653_create_order_items_table', 6),
(14, '2023_12_07_123704_create_commission_percentages_table', 7),
(15, '2023_12_07_130107_create_user_earnings_table', 8),
(16, '2023_12_07_131026_create_user_commissions_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:processing, 1:in transit, 2:delivered , 3:declined',
  `total` decimal(20,6) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `status`, `total`, `notes`, `created_at`, `updated_at`) VALUES
(9, 'ORD-6571CB089F280', 14, 1, 191.000000, '', '2023-12-07 08:39:20', '2023-12-07 08:39:20'),
(10, 'ORD-6571CFB4CCB49', 14, 1, 320.500000, '', '2023-12-07 08:59:16', '2023-12-07 08:59:16'),
(11, 'ORD-6572B1F5E047C', 7, 0, 40.000000, '', '2023-12-08 01:04:37', '2023-12-08 01:04:37'),
(12, 'ORD-6572B7433B678', 14, 1, 200.000000, '', '2023-12-08 01:27:15', '2023-12-08 01:27:15'),
(13, 'ORD-6572CB9528C20', 9, 1, 210.000000, '', '2023-12-08 02:53:57', '2023-12-08 02:53:57'),
(14, 'ORD-6572CD67CD5EB', 7, 1, 260.000000, '', '2023-12-08 03:01:43', '2023-12-08 03:01:43'),
(15, 'ORD-657315A90127E', 7, 2, 260.500000, '', '2023-12-08 08:10:01', '2023-12-08 08:10:01'),
(16, 'ORD-657315E5AAE2F', 7, 3, 170.000000, '', '2023-12-08 08:11:01', '2023-12-08 08:11:01'),
(17, 'ORD-657318E4C9BF2', 7, 1, 281.500000, '', '2023-12-08 08:23:48', '2023-12-08 08:23:48'),
(18, 'ORD-6573259B44070', 7, 1, 220.000000, '', '2023-12-08 09:18:03', '2023-12-08 09:18:03'),
(19, 'ORD-6573260456BA5', 7, 1, 170.000000, '', '2023-12-08 09:19:48', '2023-12-08 09:19:48'),
(20, 'ORD-6573264FB69EB', 7, 1, 310.000000, '', '2023-12-08 09:21:03', '2023-12-08 09:21:03'),
(21, 'ORD-65769FF1F39B9', 7, 1, 90.500000, '', '2023-12-11 00:36:49', '2023-12-11 00:36:49'),
(22, 'ORD-6576DD4B812DD', 1, 1, 40.000000, '', '2023-12-11 04:58:35', '2023-12-11 04:58:35'),
(23, 'ORD-6576DDA6C6C2D', 1, 1, 0.000000, '', '2023-12-11 05:00:06', '2023-12-11 05:00:06'),
(24, 'ORD-6576DDB8AA49B', 1, 1, 0.000000, '', '2023-12-11 05:00:24', '2023-12-11 05:00:24'),
(25, 'ORD-6576DDE780E6B', 1, 1, 80.000000, '', '2023-12-11 05:01:11', '2023-12-11 05:01:11'),
(26, 'ORD-6576DE6CDF265', 25, 1, 50.500000, '', '2023-12-11 05:03:24', '2023-12-11 05:03:24'),
(27, 'ORD-6576E6FB4620F', 26, 1, 40.000000, '', '2023-12-11 05:39:55', '2023-12-11 05:39:55'),
(28, 'ORD-6576E7735A2BD', 26, 1, 40.000000, '', '2023-12-11 05:41:55', '2023-12-11 05:41:55'),
(29, 'ORD-6576EA8D34E2B', 27, 1, 90.500000, '', '2023-12-11 05:55:09', '2023-12-11 05:55:09'),
(30, 'ORD-6576EB4927840', 28, 1, 90.500000, '', '2023-12-11 05:58:17', '2023-12-11 05:58:17'),
(31, 'ORD-6576EBE24AF40', 28, 1, 0.000000, '', '2023-12-11 06:00:50', '2023-12-11 06:00:50'),
(32, 'ORD-6576EC3F29C04', 28, 1, 0.000000, '', '2023-12-11 06:02:23', '2023-12-11 06:02:23'),
(33, 'ORD-6576EC9355C02', 28, 1, 0.000000, '', '2023-12-11 06:03:47', '2023-12-11 06:03:47'),
(34, 'ORD-6576ECC8863B4', 28, 1, 40.000000, '', '2023-12-11 06:04:40', '2023-12-11 06:04:40'),
(35, 'ORD-6576F2F2CF9C8', 9, 1, 40.000000, '', '2023-12-11 06:30:58', '2023-12-11 06:30:58'),
(36, 'ORD-6576F32E23A17', 29, 1, 90.000000, '', '2023-12-11 06:31:58', '2023-12-11 06:31:58'),
(37, 'ORD-6576F3922C4A9', 7, 1, 220.000000, '', '2023-12-11 06:33:38', '2023-12-11 06:33:38'),
(38, 'ORD-6576FC36A348D', 30, 1, 140.500000, '', '2023-12-11 07:10:30', '2023-12-11 07:10:30'),
(39, 'ORD-6576FD1C8DCF1', 31, 1, 250.500000, '', '2023-12-11 07:14:20', '2023-12-11 07:14:20'),
(40, 'ORD-6577066EA79D8', 7, 1, 300.000000, '', '2023-12-11 07:54:06', '2023-12-11 07:54:06'),
(41, 'ORD-65785F5ABEAE2', 32, 1, 300.000000, '', '2023-12-12 08:25:46', '2023-12-12 08:25:46'),
(42, 'ORD-657864806DCF3', 7, 1, 120.000000, '', '2023-12-12 08:47:44', '2023-12-12 08:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(20,6) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(20,6) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `total`, `notes`, `created_at`, `updated_at`) VALUES
(11, 9, 2, 'Multi-Way Ultra Crop Top', 90.000000, 1, 90.000000, '', '2023-12-07 08:39:20', '2023-12-07 08:39:20'),
(12, 9, 5, 'Woven Crop Cami', 50.500000, 2, 101.000000, '', '2023-12-07 08:39:20', '2023-12-07 08:39:20'),
(13, 10, 2, 'Multi-Way Ultra Crop Top', 90.000000, 3, 270.000000, '', '2023-12-07 08:59:17', '2023-12-07 08:59:17'),
(14, 10, 5, 'Woven Crop Cami', 50.500000, 1, 50.500000, '', '2023-12-07 08:59:17', '2023-12-07 08:59:17'),
(15, 11, 3, 'Side-Tie Tank', 40.000000, 1, 40.000000, '', '2023-12-08 01:04:38', '2023-12-08 01:04:38'),
(16, 12, 3, 'Side-Tie Tank', 40.000000, 5, 200.000000, '', '2023-12-08 01:27:15', '2023-12-08 01:27:15'),
(17, 13, 4, 'Cold Crewneck Sweater', 40.000000, 3, 120.000000, '', '2023-12-08 02:53:57', '2023-12-08 02:53:57'),
(18, 13, 2, 'Multi-Way Ultra Crop Top', 90.000000, 1, 90.000000, '', '2023-12-08 02:53:57', '2023-12-08 02:53:57'),
(19, 14, 3, 'Side-Tie Tank', 40.000000, 2, 80.000000, '', '2023-12-08 03:01:43', '2023-12-08 03:01:43'),
(20, 14, 2, 'Multi-Way Ultra Crop Top', 90.000000, 2, 180.000000, '', '2023-12-08 03:01:44', '2023-12-08 03:01:44'),
(21, 15, 3, 'Side-Tie Tank', 40.000000, 1, 40.000000, '', '2023-12-08 08:10:01', '2023-12-08 08:10:01'),
(22, 15, 4, 'Cold Crewneck Sweater', 40.000000, 2, 80.000000, '', '2023-12-08 08:10:01', '2023-12-08 08:10:01'),
(23, 15, 5, 'Woven Crop Cami', 50.500000, 1, 50.500000, '', '2023-12-08 08:10:01', '2023-12-08 08:10:01'),
(24, 15, 2, 'Multi-Way Ultra Crop Top', 90.000000, 1, 90.000000, '', '2023-12-08 08:10:01', '2023-12-08 08:10:01'),
(25, 16, 3, 'Side-Tie Tank', 40.000000, 1, 40.000000, '', '2023-12-08 08:11:01', '2023-12-08 08:11:01'),
(26, 16, 4, 'Cold Crewneck Sweater', 40.000000, 1, 40.000000, '', '2023-12-08 08:11:02', '2023-12-08 08:11:02'),
(27, 16, 2, 'Multi-Way Ultra Crop Top', 90.000000, 1, 90.000000, '', '2023-12-08 08:11:02', '2023-12-08 08:11:02'),
(28, 17, 2, 'Multi-Way Ultra Crop Top', 90.000000, 1, 90.000000, '', '2023-12-08 08:23:48', '2023-12-08 08:23:48'),
(29, 17, 4, 'Cold Crewneck Sweater', 40.000000, 1, 40.000000, '', '2023-12-08 08:23:48', '2023-12-08 08:23:48'),
(30, 17, 5, 'Woven Crop Cami', 50.500000, 3, 151.500000, '', '2023-12-08 08:23:49', '2023-12-08 08:23:49'),
(31, 18, 2, 'Multi-Way Ultra Crop Top', 90.000000, 2, 180.000000, '', '2023-12-08 09:18:03', '2023-12-08 09:18:03'),
(32, 18, 3, 'Side-Tie Tank', 40.000000, 1, 40.000000, '', '2023-12-08 09:18:03', '2023-12-08 09:18:03'),
(33, 19, 2, 'Multi-Way Ultra Crop Top', 90.000000, 1, 90.000000, '', '2023-12-08 09:19:48', '2023-12-08 09:19:48'),
(34, 19, 4, 'Cold Crewneck Sweater', 40.000000, 2, 80.000000, '', '2023-12-08 09:19:48', '2023-12-08 09:19:48'),
(35, 20, 2, 'Multi-Way Ultra Crop Top', 90.000000, 3, 270.000000, '', '2023-12-08 09:21:03', '2023-12-08 09:21:03'),
(36, 20, 3, 'Side-Tie Tank', 40.000000, 1, 40.000000, '', '2023-12-08 09:21:04', '2023-12-08 09:21:04'),
(37, 21, 4, 'Cold Crewneck Sweater', 40.000000, 1, 40.000000, '', '2023-12-11 00:36:50', '2023-12-11 00:36:50'),
(38, 21, 5, 'Woven Crop Cami', 50.500000, 1, 50.500000, '', '2023-12-11 00:36:51', '2023-12-11 00:36:51'),
(39, 22, 4, 'Cold Crewneck Sweater', 40.000000, 1, 40.000000, '', '2023-12-11 04:58:35', '2023-12-11 04:58:35'),
(40, 25, 3, 'Side-Tie Tank', 40.000000, 2, 80.000000, '', '2023-12-11 05:01:11', '2023-12-11 05:01:11'),
(41, 26, 5, 'Woven Crop Cami', 50.500000, 1, 50.500000, '', '2023-12-11 05:03:25', '2023-12-11 05:03:25'),
(42, 27, 4, 'Cold Crewneck Sweater', 40.000000, 1, 40.000000, '', '2023-12-11 05:39:55', '2023-12-11 05:39:55'),
(43, 28, 4, 'Cold Crewneck Sweater', 40.000000, 1, 40.000000, '', '2023-12-11 05:41:55', '2023-12-11 05:41:55'),
(44, 29, 3, 'Side-Tie Tank', 40.000000, 1, 40.000000, '', '2023-12-11 05:55:09', '2023-12-11 05:55:09'),
(45, 29, 5, 'Woven Crop Cami', 50.500000, 1, 50.500000, '', '2023-12-11 05:55:09', '2023-12-11 05:55:09'),
(46, 30, 4, 'Cold Crewneck Sweater', 40.000000, 1, 40.000000, '', '2023-12-11 05:58:17', '2023-12-11 05:58:17'),
(47, 30, 5, 'Woven Crop Cami', 50.500000, 1, 50.500000, '', '2023-12-11 05:58:17', '2023-12-11 05:58:17'),
(48, 34, 4, 'Cold Crewneck Sweater', 40.000000, 1, 40.000000, '', '2023-12-11 06:04:40', '2023-12-11 06:04:40'),
(49, 35, 4, 'Cold Crewneck Sweater', 40.000000, 1, 40.000000, '', '2023-12-11 06:30:59', '2023-12-11 06:30:59'),
(50, 36, 2, 'Multi-Way Ultra Crop Top', 90.000000, 1, 90.000000, '', '2023-12-11 06:31:58', '2023-12-11 06:31:58'),
(51, 37, 2, 'Multi-Way Ultra Crop Top', 90.000000, 2, 180.000000, '', '2023-12-11 06:33:38', '2023-12-11 06:33:38'),
(52, 37, 3, 'Side-Tie Tank', 40.000000, 1, 40.000000, '', '2023-12-11 06:33:38', '2023-12-11 06:33:38'),
(53, 38, 2, 'Multi-Way Ultra Crop Top', 90.000000, 1, 90.000000, '', '2023-12-11 07:10:30', '2023-12-11 07:10:30'),
(54, 38, 5, 'Woven Crop Cami', 50.500000, 1, 50.500000, '', '2023-12-11 07:10:30', '2023-12-11 07:10:30'),
(55, 39, 3, 'Side-Tie Tank', 40.000000, 1, 40.000000, '', '2023-12-11 07:14:20', '2023-12-11 07:14:20'),
(56, 39, 4, 'Cold Crewneck Sweater', 40.000000, 4, 160.000000, '', '2023-12-11 07:14:20', '2023-12-11 07:14:20'),
(57, 39, 5, 'Woven Crop Cami', 50.500000, 1, 50.500000, '', '2023-12-11 07:14:20', '2023-12-11 07:14:20'),
(58, 40, 2, 'Multi-Way Ultra Crop Top', 90.000000, 2, 180.000000, '', '2023-12-11 07:54:07', '2023-12-11 07:54:07'),
(59, 40, 4, 'Cold Crewneck Sweater', 40.000000, 3, 120.000000, '', '2023-12-11 07:54:07', '2023-12-11 07:54:07'),
(60, 41, 2, 'Multi-Way Ultra Crop Top', 90.000000, 2, 180.000000, '', '2023-12-12 08:25:46', '2023-12-12 08:25:46'),
(61, 41, 4, 'Cold Crewneck Sweater', 40.000000, 3, 120.000000, '', '2023-12-12 08:25:47', '2023-12-12 08:25:47'),
(62, 42, 4, 'Cold Crewneck Sweater', 40.000000, 3, 120.000000, '', '2023-12-12 08:47:44', '2023-12-12 08:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('calebjanaltair@gmail.com', '$2y$12$7h3nci4Ra/P5zesWZ4T6PunVhHU0v4O/WwNNRN9lTwwPFS/DlN0bq', '2023-12-11 08:02:26'),
('komerak345@newcupon.com', '$2y$12$l5rI7rj8xzeDjKR4Dtq6je/HQcCBZbJpGvDkv59xSQUsdOnsZTZia', '2023-12-11 05:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `reviews` int(11) NOT NULL DEFAULT 5,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `short_description`, `description`, `price`, `image`, `reviews`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Multi-Way Ultra Crop Top', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspic atis unde omnis iste natus error sit voluptam accusan enim ipsam voluptam quia voluptas sit aspern odit aut fugit.', 'Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ulla mco laboris nisi ut aliquip ex ea commodo consequat. duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nNemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesc iunt. neque porro quisquam est qui dolorem ipsum quia dolor sit amet consectetur adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '90.00', '1702015314.product-details-8.jpg', 5, 'multi-way-ultra-crop-top-1702015314', 1, '2023-12-07 03:37:18', '2023-12-08 01:01:54'),
(3, 'Side-Tie Tank', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspic atis unde omnis iste natus error sit voluptam accusan enim ipsam voluptam quia voluptas sit aspern odit aut fugit.', 'Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ulla mco laboris nisi ut aliquip ex ea commodo consequat. duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nNemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesc iunt. neque porro quisquam est qui dolorem ipsum quia dolor sit amet consectetur adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '40.00', '1702015321.product-details-9.jpg', 5, 'side-tie-tank-1702015321', 1, '2023-12-07 03:38:43', '2023-12-08 01:02:01'),
(4, 'Cold Crewneck Sweater', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspic atis unde omnis iste natus error sit voluptam accusan enim ipsam voluptam quia voluptas sit aspern odit aut fugit.', 'Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ulla mco laboris nisi ut aliquip ex ea commodo consequat. duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nNemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesc iunt. neque porro quisquam est qui dolorem ipsum quia dolor sit amet consectetur adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '40.00', '1702015328.product-details-10.jpg', 5, 'cold-crewneck-sweater-1702015328', 1, '2023-12-07 03:39:11', '2023-12-08 01:02:08'),
(5, 'Woven Crop Cami', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspic atis unde omnis iste natus error sit voluptam accusan enim ipsam voluptam quia voluptas sit aspern odit aut fugit.', 'Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ulla mco laboris nisi ut aliquip ex ea commodo consequat. duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nNemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesc iunt. neque porro quisquam est qui dolorem ipsum quia dolor sit amet consectetur adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '50.50', '1702015334.product-details-11.jpg', 5, 'woven-crop-cami-1702015334', 1, '2023-12-07 03:40:19', '2023-12-08 01:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `referral_code` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `referral_code`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Arslan', 'arslan@gmail.com', '1702022684.jpg', 'of8Y4jsd', 1, '2023-12-04 07:11:30', '$2y$12$JeJHCZJHlvYUKZG2M7FPJeVGEwC7LV52NKDrTt.xURceyw0lOI/FG', NULL, '2023-12-04 06:44:43', '2023-12-08 03:04:44'),
(2, 'Jack Reacher', 'jackreacher@gmail.com', '1701856293.jpg', '5q1WDY3S', 1, '2023-12-04 07:57:58', '$2y$12$Kpy68/GpYzAv0yIXvttGpeflTsfx95eAIfdiJ/xJoRer5lFeEMzPG', NULL, '2023-12-04 07:56:39', '2023-12-06 04:51:33'),
(5, 'John Doe', 'calebjanaltair@gmail.com', NULL, 'csyeQmPn', 1, '2023-12-06 01:15:20', '$2y$12$Ku2TQzA8uZ8/9xnZzrcTuOh1j9AnC0cKnSOzc3Lm6a0DBeMpDQ8ay', 'uF3lT40IVqqNpbzCbIdTvJxpbEUxtcdBOf7wMWU6JN6WpwjBP4O9UckwzjsD', '2023-12-06 01:14:50', '2023-12-11 05:33:26'),
(6, 'Roger Fedrar', 'rogerfedrar@gmail.com', NULL, 'C37ZcOpv', 1, '2023-12-06 01:16:25', '$2y$12$fxjE08aumojRi3YPOtUDkO1cpdb2Iu3.BjiIbJmAS5uY2a8tG/H4m', NULL, '2023-12-06 01:16:07', '2023-12-06 01:16:25'),
(7, 'Novak Djokovic', 'user@gmail.com', '1702282444.jpg', 'JnGlUgwS', 1, '2023-12-06 01:17:52', '$2y$12$cLBILiefbbC0kBjoU/3iTuCwYr7MsbePsF2vFrX6BzH6pDhRX8jX2', NULL, '2023-12-07 03:17:37', '2023-12-11 04:50:56'),
(8, 'Naomi Osaka', 'naomiosaka@gmail.com', '1701856384.jpg', 'NRvi9oJA', 1, '2023-12-06 01:19:04', '$2y$12$jIGPmRE1Vb4WUBsG3kZwz.tJUbey7tCW00IczWPhtd6YZiSOboW5u', NULL, '2023-12-06 01:18:49', '2023-12-06 04:53:04'),
(9, 'Barack Obama', 'barackobama@gmail.com', '1701856438.jpg', 'ByIg2mRS', 1, '2023-12-06 01:23:52', '$2y$12$JHjhcNrpbsDMM0gAMayYK.0/ApnR6bG9OeVg9l7UOLjV6VjagnAS2', NULL, '2023-12-06 01:23:38', '2023-12-06 04:53:58'),
(10, 'Sam Altman', 'samaltman@gmail.com', '1701856492.jpg', 'HBy7gzrY', 1, '2023-12-06 01:25:09', '$2y$12$6dzjbiDKCW/rwk4YMNYnLeWNuTppG26TV.yrZf3gQ0X598T6ItJ7.', NULL, '2023-12-06 01:24:51', '2023-12-06 04:54:52'),
(11, 'Kamelia Peterson', 'kpeterson@gmail.com', '1701856687.jpg', 'yMpb2qEW', 1, '2023-12-06 01:27:49', '$2y$12$O8x78EsOQC72GmkTrUGFPeBkjS36BgiRa22YldaW1/7PACD3ArF0e', NULL, '2023-12-06 01:27:30', '2023-12-06 04:58:07'),
(12, 'Sean Paul', 'seanpaul@gmail.com', '1701856741.jpg', '2cIb9Zz6', 1, '2023-12-06 01:28:40', '$2y$12$c11bXXlPzYtTM0ttY2QoEeyfik5/AJ/EWpNrKV19XRM9QVcj2Suui', NULL, '2023-12-06 01:28:24', '2023-12-06 04:59:01'),
(13, 'Dave Chappelle', 'davechappelle@gmail.com', '1701856598.jpg', 'pUzfYS6m', 1, '2023-12-06 01:35:40', '$2y$12$JGvgXNRD23SU/ulgn6AfBe3pPvyqrofoe8UVBX9xtuK0P.RMPdaxa', NULL, '2023-12-06 01:35:25', '2023-12-06 04:56:38'),
(14, 'Mathew Perry', 'mathewperry@gmail.com', '1701858070.jpg', '5M2gQ9Th', 1, '2023-12-06 01:37:30', '$2y$12$28kDQZmAWOBi01d5YgAvy.QRl0s/ctRqTHwq5nqPLaLu3khkGD6gy', NULL, '2023-12-06 01:37:16', '2023-12-06 05:21:10'),
(15, 'Scooby Doo', 'scoobydoo@gmail.com', '1701858121.jpg', 'cTN3oZ1O', 1, '2023-12-06 01:39:47', '$2y$12$bXfkMbZEN4nHdfCvqH9rG.sLjaa350txyHqxB1IMicz4H62k7Vdki', NULL, '2023-12-06 01:39:31', '2023-12-06 06:47:40'),
(16, 'Tom Odell', 'tomodell@gmail.com', '1701856544.jpg', 'NLjkuO6w', 1, '2023-12-06 02:27:45', '$2y$12$OwZci8cWcCcOpqo86E56KektlC5b8ViF9Rs1TXn41gcol4Ub40wOK', NULL, '2023-12-06 02:27:29', '2023-12-08 00:54:44'),
(17, 'Juan Cervantes', 'juan@gmail.com', '1701857932.jpg', 'AO39eBUG', 1, '2023-12-06 02:29:35', '$2y$12$xBizKgVdwK34s5RGFp.F2OKwiG6hiwxXlsXiNTlnhQbeQqaAj18Hu', NULL, '2023-12-06 02:29:18', '2023-12-08 00:54:33'),
(18, 'Saul Goodman', 'saulgoodman@gmail.com', '1701858163.png', 'SlFpRvi0', 1, '2023-12-06 02:31:19', '$2y$12$MHX202f/9ui3e/bfHBZlOOxFJJie9qFk9JB40rTfEqXGnX1AyWePy', NULL, '2023-12-06 02:31:00', '2023-12-06 05:22:43'),
(19, 'Alan Turing', 'alanturing@gmail.com', '1701858226.jpg', '97oT38iw', 1, '2023-12-06 02:32:31', '$2y$12$GF0VugAJTDfHXRshzlxrqudSsJmX3JBog1ZNFm6/BgJ1JgJ4d0uVG', NULL, '2023-12-06 02:32:16', '2023-12-06 08:05:13'),
(26, 'John Wick', 'johnwick@gmail.com', '1702291035.jpg', 'HmuKtYMg', 1, '2023-12-11 05:37:05', '$2y$12$VSIry2vuKdrRNem4m5Rwq.araC6uOS4EjwTnkbP3cS5O2.Oz254fi', NULL, '2023-12-11 05:36:11', '2023-12-11 05:37:29'),
(30, 'Alex Rider', 'alex@gmail.com', '1702296699.jpg', '0PkuEAng', 1, '2023-12-11 07:11:06', '$2y$12$0agCVHC0pTSxTHtDn7Uc5.EsRu70dxeplhdsEdD7brAcjO0zMGj/S', NULL, '2023-12-11 07:10:24', '2023-12-11 07:11:39'),
(31, 'Jason Bourne', 'jason@gmail.com', '1702296835.jfif', 'E7eQRVF2', 1, '2023-12-11 07:13:21', '$2y$12$xfB1DusMpB2sX85KummLl.XzeRzF5zh0ILTv1lQPDshMpJ/GqlrU6', NULL, '2023-12-11 07:13:04', '2023-12-11 07:13:55'),
(32, 'Test User', 'fipak94126@mcenb.com', NULL, 'E6o8tdQB', 1, NULL, '$2y$12$P/7S9Zsv8zmIJ5pXtfw/UONmacXY71h92xN6.4pN4YxE.hJBskhDS', NULL, '2023-12-12 08:25:38', '2023-12-12 08:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_commissions`
--

CREATE TABLE `user_commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `shopper_id` bigint(20) UNSIGNED NOT NULL,
  `commission_level_id` bigint(20) UNSIGNED NOT NULL,
  `commission_amount` varchar(255) NOT NULL,
  `commission_percentage` varchar(255) NOT NULL,
  `order_amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_commissions`
--

INSERT INTO `user_commissions` (`id`, `user_id`, `order_id`, `shopper_id`, `commission_level_id`, `commission_amount`, `commission_percentage`, `order_amount`, `created_at`, `updated_at`) VALUES
(7, 13, 9, 14, 1, '9.55', '5', '191', '2023-12-07 08:39:20', '2023-12-07 08:39:20'),
(8, 9, 9, 14, 2, '5.73', '3', '191', '2023-12-07 08:39:20', '2023-12-07 08:39:20'),
(9, 7, 9, 14, 3, '1.91', '1', '191', '2023-12-07 08:39:21', '2023-12-07 08:39:21'),
(10, 13, 10, 14, 1, '16.025', '5', '320.5', '2023-12-07 08:59:17', '2023-12-07 08:59:17'),
(11, 9, 10, 14, 2, '9.615', '3', '320.5', '2023-12-07 08:59:17', '2023-12-07 08:59:17'),
(12, 7, 10, 14, 3, '3.205', '1', '320.5', '2023-12-07 08:59:17', '2023-12-07 08:59:17'),
(13, 5, 11, 7, 1, '2', '5', '40', '2023-12-08 01:04:38', '2023-12-08 01:04:38'),
(14, 2, 11, 7, 2, '1.2', '3', '40', '2023-12-08 01:04:38', '2023-12-08 01:04:38'),
(15, 1, 11, 7, 3, '0.4', '1', '40', '2023-12-08 01:04:38', '2023-12-08 01:04:38'),
(16, 13, 12, 14, 1, '10', '5', '200', '2023-12-08 01:27:15', '2023-12-08 01:27:15'),
(17, 9, 12, 14, 2, '6', '3', '200', '2023-12-08 01:27:15', '2023-12-08 01:27:15'),
(18, 7, 12, 14, 3, '2', '1', '200', '2023-12-08 01:27:16', '2023-12-08 01:27:16'),
(19, 7, 13, 9, 1, '10.5', '5', '210', '2023-12-08 02:53:57', '2023-12-08 02:53:57'),
(20, 5, 13, 9, 2, '6.3', '3', '210', '2023-12-08 02:53:57', '2023-12-08 02:53:57'),
(21, 2, 13, 9, 3, '2.1', '1', '210', '2023-12-08 02:53:57', '2023-12-08 02:53:57'),
(22, 5, 14, 7, 1, '13', '5', '260', '2023-12-08 03:01:44', '2023-12-08 03:01:44'),
(23, 2, 14, 7, 2, '7.8', '3', '260', '2023-12-08 03:01:44', '2023-12-08 03:01:44'),
(24, 1, 14, 7, 3, '2.6', '1', '260', '2023-12-08 03:01:44', '2023-12-08 03:01:44'),
(25, 5, 15, 7, 1, '13.025', '5', '260.5', '2023-12-08 08:10:01', '2023-12-08 08:10:01'),
(26, 2, 15, 7, 2, '7.815', '3', '260.5', '2023-12-08 08:10:01', '2023-12-08 08:10:01'),
(27, 1, 15, 7, 3, '2.605', '1', '260.5', '2023-12-08 08:10:01', '2023-12-08 08:10:01'),
(28, 5, 16, 7, 1, '8.5', '5', '170', '2023-12-08 08:11:02', '2023-12-08 08:11:02'),
(29, 2, 16, 7, 2, '5.1', '3', '170', '2023-12-08 08:11:02', '2023-12-08 08:11:02'),
(30, 1, 16, 7, 3, '1.7', '1', '170', '2023-12-08 08:11:02', '2023-12-08 08:11:02'),
(31, 5, 17, 7, 1, '14.075', '5', '281.5', '2023-12-08 08:23:49', '2023-12-08 08:23:49'),
(32, 2, 17, 7, 2, '8.445', '3', '281.5', '2023-12-08 08:23:49', '2023-12-08 08:23:49'),
(33, 1, 17, 7, 3, '2.815', '1', '281.5', '2023-12-08 08:23:49', '2023-12-08 08:23:49'),
(34, 5, 18, 7, 1, '11', '5', '220', '2023-12-08 09:18:03', '2023-12-08 09:18:03'),
(35, 2, 18, 7, 2, '6.6', '3', '220', '2023-12-08 09:18:03', '2023-12-08 09:18:03'),
(36, 1, 18, 7, 3, '2.2', '1', '220', '2023-12-08 09:18:03', '2023-12-08 09:18:03'),
(37, 5, 19, 7, 1, '8.5', '5', '170', '2023-12-08 09:19:48', '2023-12-08 09:19:48'),
(38, 2, 19, 7, 2, '5.1', '3', '170', '2023-12-08 09:19:48', '2023-12-08 09:19:48'),
(39, 1, 19, 7, 3, '1.7', '1', '170', '2023-12-08 09:19:49', '2023-12-08 09:19:49'),
(40, 5, 20, 7, 1, '15.5', '5', '310', '2023-12-08 09:21:04', '2023-12-08 09:21:04'),
(41, 2, 20, 7, 2, '9.3', '3', '310', '2023-12-08 09:21:04', '2023-12-08 09:21:04'),
(42, 1, 20, 7, 3, '3.1', '1', '310', '2023-12-08 09:21:04', '2023-12-08 09:21:04'),
(43, 5, 21, 7, 1, '4.525', '5', '90.5', '2023-12-11 00:36:51', '2023-12-11 00:36:51'),
(44, 2, 21, 7, 2, '2.715', '3', '90.5', '2023-12-11 00:36:52', '2023-12-11 00:36:52'),
(45, 1, 21, 7, 3, '0.905', '1', '90.5', '2023-12-11 00:36:52', '2023-12-11 00:36:52'),
(54, 7, 35, 9, 1, '2', '5', '40', '2023-12-11 06:30:59', '2023-12-11 06:30:59'),
(55, 5, 35, 9, 2, '1.2', '3', '40', '2023-12-11 06:30:59', '2023-12-11 06:30:59'),
(56, 2, 35, 9, 3, '0.4', '1', '40', '2023-12-11 06:30:59', '2023-12-11 06:30:59'),
(57, 5, 37, 7, 1, '11', '5', '220', '2023-12-11 06:33:38', '2023-12-11 06:33:38'),
(58, 2, 37, 7, 2, '6.6', '3', '220', '2023-12-11 06:33:38', '2023-12-11 06:33:38'),
(59, 1, 37, 7, 3, '2.2', '1', '220', '2023-12-11 06:33:38', '2023-12-11 06:33:38'),
(60, 30, 39, 31, 1, '12.525', '5', '250.5', '2023-12-11 07:14:20', '2023-12-11 07:14:20'),
(61, 5, 40, 7, 1, '15', '5', '300', '2023-12-11 07:54:07', '2023-12-11 07:54:07'),
(62, 2, 40, 7, 2, '9', '3', '300', '2023-12-11 07:54:07', '2023-12-11 07:54:07'),
(63, 1, 40, 7, 3, '3', '1', '300', '2023-12-11 07:54:07', '2023-12-11 07:54:07'),
(64, 5, 42, 7, 1, '6', '5', '120', '2023-12-12 08:47:44', '2023-12-12 08:47:44'),
(65, 2, 42, 7, 2, '3.6', '3', '120', '2023-12-12 08:47:44', '2023-12-12 08:47:44'),
(66, 1, 42, 7, 3, '1.2', '1', '120', '2023-12-12 08:47:44', '2023-12-12 08:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_earnings`
--

CREATE TABLE `user_earnings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `available_balance` varchar(255) NOT NULL DEFAULT '0',
  `total_earnings` varchar(255) NOT NULL DEFAULT '0',
  `total_withdrawn` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_earnings`
--

INSERT INTO `user_earnings` (`id`, `user_id`, `available_balance`, `total_earnings`, `total_withdrawn`, `created_at`, `updated_at`) VALUES
(21, 1, '24.425', '24.425', '0', '2023-12-07 08:09:32', '2023-12-12 08:47:44'),
(22, 2, '76.28', '76.28', '0', '2023-12-07 08:09:32', '2023-12-12 08:47:44'),
(25, 5, '131.14', '131.14', '0', '2023-12-07 08:09:32', '2023-12-12 08:47:44'),
(26, 6, '0', '0', '0', '2023-12-07 08:09:32', '2023-12-07 08:09:32'),
(27, 7, '22.14', '22.14', '0', '2023-12-07 08:09:32', '2023-12-11 06:30:59'),
(28, 8, '0', '0', '0', '2023-12-07 08:09:32', '2023-12-07 08:09:32'),
(29, 9, '21.345', '21.345', '0', '2023-12-07 08:09:32', '2023-12-08 01:27:15'),
(30, 10, '0', '0', '0', '2023-12-07 08:09:32', '2023-12-07 08:09:32'),
(31, 11, '0', '0', '0', '2023-12-07 08:09:32', '2023-12-07 08:09:32'),
(32, 12, '0', '0', '0', '2023-12-07 08:09:32', '2023-12-07 08:09:32'),
(33, 13, '35.575', '35.575', '0', '2023-12-07 08:09:32', '2023-12-08 01:27:15'),
(34, 14, '0', '0', '0', '2023-12-07 08:09:32', '2023-12-07 08:09:32'),
(35, 15, '0', '0', '0', '2023-12-07 08:09:33', '2023-12-07 08:09:33'),
(36, 16, '0', '0', '0', '2023-12-07 08:09:33', '2023-12-07 08:09:33'),
(37, 17, '0', '0', '0', '2023-12-07 08:09:33', '2023-12-07 08:09:33'),
(38, 18, '0', '0', '0', '2023-12-07 08:09:33', '2023-12-07 08:09:33'),
(39, 19, '0', '0', '0', '2023-12-07 08:09:33', '2023-12-07 08:09:33'),
(41, 26, '0', '0', '0', '2023-12-11 05:36:16', '2023-12-11 05:36:16'),
(45, 31, '0', '0', '0', '2023-12-11 07:13:09', '2023-12-11 07:13:09'),
(46, 30, '12.525', '12.525', '0', '2023-12-11 07:14:20', '2023-12-11 07:14:20');

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
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affiliates_user_id_foreign` (`user_id`),
  ADD KEY `affiliates_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_percentages`
--
ALTER TABLE `commission_percentages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_referral_code_unique` (`referral_code`);

--
-- Indexes for table `user_commissions`
--
ALTER TABLE `user_commissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_commissions_user_id_foreign` (`user_id`),
  ADD KEY `user_commissions_shopper_id_foreign` (`shopper_id`),
  ADD KEY `user_commissions_order_id_foreign` (`order_id`),
  ADD KEY `user_commissions_commission_level_id_foreign` (`commission_level_id`);

--
-- Indexes for table `user_earnings`
--
ALTER TABLE `user_earnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_earnings_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `commission_percentages`
--
ALTER TABLE `commission_percentages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_commissions`
--
ALTER TABLE `user_commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user_earnings`
--
ALTER TABLE `user_earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD CONSTRAINT `affiliates_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `affiliates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_commissions`
--
ALTER TABLE `user_commissions`
  ADD CONSTRAINT `user_commissions_commission_level_id_foreign` FOREIGN KEY (`commission_level_id`) REFERENCES `commission_percentages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_commissions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_commissions_shopper_id_foreign` FOREIGN KEY (`shopper_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_commissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_earnings`
--
ALTER TABLE `user_earnings`
  ADD CONSTRAINT `user_earnings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
