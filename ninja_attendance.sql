-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2020 at 10:16 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ninja_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_user`
--

CREATE TABLE `company_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `zalo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `date_sell` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_user`
--

INSERT INTO `company_user` (`id`, `email`, `name`, `address`, `phone`, `avatar`, `facebook`, `zalo`, `type`, `date_start`, `date_end`, `date_sell`, `created_at`, `updated_at`) VALUES
(2, 'ninjatool@gmail.com', 'ninja', '62 nguyen huy tuong', '024666888', NULL, 'facebook.comzalo', 'zalo.com', '1', '2020-12-12', '2021-12-12', '2020-06-12', '2020-06-21 20:48:10', '2020-06-21 20:48:10'),
(3, 'ninjatool1@gmail.com', 'ninja', '62 nguyen huy tuong', '024666888', NULL, 'facebook.comzalo', 'zalo.com', '1', '2020-12-12', '2021-12-12', '2020-06-12', '2020-06-21 21:31:38', '2020-06-21 21:31:38'),
(4, 'ninjatool12@gmail.com', 'ninja', '62 nguyen huy tuong', '024666888', NULL, 'facebook.comzalo', 'zalo.com', '1', '2020-12-12', '2021-12-12', '2020-06-12', '2020-06-21 21:33:20', '2020-06-21 21:33:20'),
(5, 'ninjatool122@gmail.com', 'ninja', '62 nguyen huy tuong', '024666888', NULL, 'facebook.comzalo', 'zalo.com', '1', '2020-12-12', '2021-12-12', '2020-06-12', '2020-06-21 21:33:37', '2020-06-21 21:33:37'),
(6, 'ninjatool22@gmail.com', 'ninja', '62 nguyen huy tuong', '024666888', NULL, 'facebook.comzalo', 'zalo.com', '1', '2020-12-12', '2021-12-12', '2020-06-12', '2020-06-21 21:34:30', '2020-06-21 21:34:30'),
(7, 'ninjatool232@gmail.com', 'ninja', '62 nguyen huy tuong', '024666888', NULL, 'facebook.comzalo', 'zalo.com', '1', '2020-12-12', '2021-12-12', '2020-06-12', '2020-06-21 21:35:18', '2020-06-21 21:35:18'),
(8, 'ninjatool2322@gmail.com', 'ninja', '62 nguyen huy tuong', '024666888', NULL, 'facebook.comzalo', 'zalo.com', '1', '2020-12-12', '2021-12-12', '2020-06-12', '2020-06-21 21:35:45', '2020-06-21 21:35:45'),
(9, 'ninjatool2@gmail.com', 'ninja', '62 nguyen huy tuong', '024666888', NULL, 'facebook.comzalo', 'zalo.com', '1', '2020-12-12', '2021-12-12', '2020-06-12', '2020-06-21 21:36:06', '2020-06-21 21:36:06'),
(10, 'ninjatool212@gmail.com', 'ninja', '62 nguyen huy tuong', '024666888', NULL, 'facebook.comzalo', 'zalo.com', '1', '2020-12-12', '2021-12-12', '2020-06-12', '2020-06-21 21:36:38', '2020-06-21 21:36:38'),
(11, 'ninjatool2122@gmail.com', 'ninja', '62 nguyen huy tuong', '024666888', NULL, 'facebook.comzalo', 'zalo.com', '1', '2020-12-12', '2021-12-12', '2020-06-12', '2020-06-21 21:36:51', '2020-06-21 21:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `configuration_cpny`
--

CREATE TABLE `configuration_cpny` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time NOT NULL,
  `work_schedule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cpny` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configuration_cpny`
--

INSERT INTO `configuration_cpny` (`id`, `time_start`, `time_end`, `work_schedule`, `ip`, `location`, `id_cpny`, `created_at`, `updated_at`) VALUES
(11, '08:30:00', '17:50:00', '2|8', '172.17.72.129', 'thanh xuan, Ha noi', 11, '2020-06-21 21:36:51', '2020-06-21 21:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_attendance`
--

CREATE TABLE `history_attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_member` int(11) NOT NULL,
  `time_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_attendance` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_user`
--

CREATE TABLE `member_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `zalo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_day` date NOT NULL,
  `facebook` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avartar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` int(11) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `id_department` int(11) NOT NULL,
  `id_cpny` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_06_11_040627_create_table', 1),
(4, '2020_06_11_040719_create_company_table', 1),
(5, '2020_06_11_041828_create_member_table', 1),
(6, '2020_06_11_042523_create_departmant_table', 1),
(7, '2020_06_11_042726_create_configuration_table', 1),
(8, '2020_06_11_044202_create_history_table', 1),
(9, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(10, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(11, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(12, '2016_06_01_000004_create_oauth_clients_table', 2),
(13, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(14, '2020_06_13_025608_create_service_pack_table', 3),
(15, '2020_06_13_034552_create_user_table', 4),
(16, '2014_10_12_100000_create_password_resets_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('01292424ffc6281780a715d9b9abc3cf5899e501512e75f3c2a0f77e43b97b70552e5c4f14538c1d', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-21 19:47:18', '2020-06-21 19:47:18', '2021-06-22 02:47:18'),
('0dbb1f6d3f8b475454cb0c343a18d3fb9e6559f39c150f33c4296f655fb8b820179944d4b9e5cc2d', 3, 1, 'MyApp', '[]', 0, '2020-06-11 02:00:11', '2020-06-11 02:00:11', '2021-06-11 09:00:11'),
('2e3667c2fe30fdbf5d464514e6593d0271b879b7bd1ed7fb45f0b4f73931171482f21e85e6f50cff', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-21 19:59:38', '2020-06-21 19:59:38', '2021-06-22 02:59:38'),
('2e4ca88cfbae8ff83f167b9210799edb93855655914c3d3b2c160112c026a294d66092e354b22df4', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-21 18:11:24', '2020-06-21 18:11:24', '2021-06-22 01:11:24'),
('370359b167047b52943afc9ed85378d132e07f789800f806fcf68d679d9d04d9d22d617420447b18', 1, 5, 'Ninja Attendace', '[]', 0, '2020-06-12 21:03:30', '2020-06-12 21:03:30', '2021-06-13 04:03:30'),
('4547d053cc7c7ce77caa06f6b320dc839fa893328e7ee1e5d65f56962ca910f00ac5723c14ad2b80', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-19 20:49:09', '2020-06-19 20:49:09', '2021-06-20 03:49:09'),
('60905179cb52e2fbfcabf5b7b379479942dff8167f920f3bb9ff3dd85554cde7dc9ef89e783675cb', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-19 20:12:46', '2020-06-19 20:12:46', '2021-06-20 03:12:46'),
('6f1d2520f8528e1d98554834b8ef0cd12aa0d0cdf44c477ac428f5f6bb681d46ceb30a579d9ac9c0', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-21 23:09:11', '2020-06-21 23:09:11', '2021-06-22 06:09:11'),
('72cb6144708938fd99bea11968ed9589d6977644b88ab79b93e892013c3a93d4d2f9023bd02da710', 3, 5, 'Ninja Attendace', '[]', 0, '2020-06-11 02:26:24', '2020-06-11 02:26:24', '2021-06-11 09:26:24'),
('7ef671e65d6dc87a352a2c6d28851f3cf1848515f0bcc6696b5cf81e1fee8d3a09d3964543c870fa', 3, 1, 'MyApp', '[]', 0, '2020-06-11 02:04:28', '2020-06-11 02:04:28', '2021-06-11 09:04:28'),
('8f6eb91597fc1ac03f06af171e1d27a2aa2777dedf4925e2ca6c53662fafb119b29b52cf2e1c936b', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-21 23:03:16', '2020-06-21 23:03:16', '2021-06-22 06:03:16'),
('a21f93fdf7999fc7761b323852a4c90fc382fdb1464252b5835a11e888b730e0ee22ac2fd983d8c3', 3, 1, 'Ninja Attendace', '[]', 0, '2020-06-11 02:17:54', '2020-06-11 02:17:54', '2021-06-11 09:17:54'),
('a3d98afddefea23e8e31f65511ab9d02a73a001c377f231ac9149f9b064e59592bf85b03124c6781', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-21 21:01:31', '2020-06-21 21:01:31', '2021-06-22 04:01:31'),
('ab72780f3576eb26381931eb86b13cb3206a6383a76f5f966f6d1a5ed3f7082a3b977e6f02b4f432', 3, 1, 'MyApp', '[]', 0, '2020-06-11 01:51:40', '2020-06-11 01:51:40', '2021-06-11 08:51:40'),
('c85c3dbdc5f761bafb992ac197ec7f9660f9aac2692a8ec968cf1e94f5e5a36d9d9252b0c8dd606a', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-21 21:05:04', '2020-06-21 21:05:04', '2021-06-22 04:05:04'),
('d47a42d85e532bf1ec803dd8e14e13dbbbc6be07dbe91b7805d1ca8c753391aab2b060957743f0c2', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-19 18:49:35', '2020-06-19 18:49:35', '2021-06-20 01:49:35'),
('d77aa12a53052db7f4545837da9723bbc9df8ffb6fa641d002d7c313bf94a762aaec5a56109f3416', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-21 20:13:44', '2020-06-21 20:13:44', '2021-06-22 03:13:44'),
('d7e9028a19b227ea2ffc3a28e992392eaa077a907310ae22bcb866a2923d09f7678f01fec23c881f', 4, 5, 'Ninja Attendace', '[]', 0, '2020-06-12 19:51:18', '2020-06-12 19:51:18', '2021-06-13 02:51:18'),
('e2aa36be2c96fff522355b09730f10e2d1b7ce950cebf4b35f29a1ad378321dedb0de14c5907bb01', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-21 18:24:00', '2020-06-21 18:24:00', '2021-06-22 01:24:00'),
('f88f1216760f315e78f0ddd366bc59ab5fc68ef391397b8d7e12eebae75f9b21e0ec743bb62beab0', 1, 7, 'Personal Access Token', '[]', 0, '2020-06-19 18:49:12', '2020-06-19 18:49:12', '2021-06-20 01:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'c7HAfkH4p0aP3gWis8PCjd64J0RP7golODcLCYYK', NULL, 'http://localhost', 1, 0, 0, '2020-06-10 23:54:05', '2020-06-10 23:54:05'),
(2, NULL, 'Laravel Password Grant Client', 'HF4wWCbw7IhAvImt83pcxUuP2OdYeZPZRqfOEAEw', 'users', 'http://localhost', 0, 1, 0, '2020-06-10 23:54:05', '2020-06-10 23:54:05'),
(3, NULL, 'Laravel Personal Access Client', 'rUcPqN1yYWHu1cDCNXF21TLIcqBIPBXLjepNnokx', NULL, 'http://localhost', 1, 0, 0, '2020-06-11 02:22:49', '2020-06-11 02:22:49'),
(4, NULL, 'Laravel Password Grant Client', 'ldCZXEg6OaRN1405NxVqNWqPJDyaWQekjTfpZ8YG', 'users', 'http://localhost', 0, 1, 0, '2020-06-11 02:22:49', '2020-06-11 02:22:49'),
(5, NULL, 'Laravel Personal Access Client', 'Nvw5qwFwMglUmKXeCY0tv2PuycmsQPVeYyxk3t1j', NULL, 'http://localhost', 1, 0, 0, '2020-06-11 02:23:12', '2020-06-11 02:23:12'),
(6, NULL, 'Laravel Password Grant Client', 'B8ARtxokQa2gT10uJq6oEGzM8t8z5Lxy7oN9udwQ', 'users', 'http://localhost', 0, 1, 0, '2020-06-11 02:23:12', '2020-06-11 02:23:12'),
(7, NULL, 'Laravel Personal Access Client', 'mhGz2ragy4e1a68ARhJoy0MSA3p8ZnjuzjGuPivM', NULL, 'http://localhost', 1, 0, 0, '2020-06-19 18:20:13', '2020-06-19 18:20:13'),
(8, NULL, 'Laravel Password Grant Client', '4ZF1d8eAK6SCH5WhDqZYzAhxWAdTAPHb6bQvcLLI', 'users', 'http://localhost', 0, 1, 0, '2020-06-19 18:20:13', '2020-06-19 18:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-06-10 23:54:05', '2020-06-10 23:54:05'),
(2, 3, '2020-06-11 02:22:49', '2020-06-11 02:22:49'),
(3, 5, '2020-06-11 02:23:12', '2020-06-11 02:23:12'),
(4, 7, '2020-06-19 18:20:13', '2020-06-19 18:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `service_pack`
--

CREATE TABLE `service_pack` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `zalo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_day` date NOT NULL,
  `facebook` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` int(11) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `id_department` int(11) NOT NULL,
  `id_cpny` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `name`, `phone`, `zalo`, `birth_day`, `facebook`, `image`, `avatar`, `permission`, `sex`, `id_department`, `id_cpny`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'okkaka12345@gmail.com', NULL, '$2y$10$/U7e.c95Sfte.J8k9mQyg.oQhtgLKPzEx7bo7gBfB.Bm.RhvKk33S', 'Hung', '0354080799', 'zalo.me', '2016-06-06', 'facebook.com', '12345', '103177662_904534929951944_4045422878124906326_n - Copy.jpg', 1, 3, 1, 11, NULL, NULL, '2020-06-21 18:18:08'),
(30, 'okkaka1w225s2@gmail.com', NULL, '$2y$10$mwXmhpM/lTRC27gR8XfpZeO0Z3y2wGULhfaWVrsjyTns5r9qyMkxe', 'hung', '0354080798', 'zalo.me', '2016-06-06', NULL, NULL, '103095080_307460736932710_8596327333627453310_n - Copy.jpg', 1, 1, 1, 2, NULL, '2020-06-19 19:55:36', '2020-06-19 19:55:36'),
(31, 'okkaka1w22s5s2@gmail.com', NULL, '$2y$10$.SIZv3glfCeL3PdldrBJXek.eCLtEkqfHRpdCFWjNw2rckndf354W', 'hung', '0354080798', 'zalo.me', '2016-06-06', NULL, NULL, '103095080_307460736932710_8596327333627453310_n - Copy.jpg', 1, 1, 1, 2, NULL, '2020-06-19 19:56:57', '2020-06-19 19:56:57'),
(32, 'okkaka1s5s2@gmail.com', NULL, '$2y$10$T9FlLC9He5lidgRnlus4dOTC.3mDjxKdFU15F9VEyTKK4sOSbJ4vS', 'hung', '0354080798', 'zalo.me', '2016-06-06', 'facebook.com', NULL, '103095080_307460736932710_8596327333627453310_n - Copy.jpg', 1, 1, 1, 2, NULL, '2020-06-19 20:02:04', '2020-06-19 20:02:04'),
(33, 'okkaka1s2@gmail.com', NULL, '$2y$10$iYKC/BvqmJnqvvh4SxTVcOVVHaWQOT3pUGYXm4DVP7lYckkvDTaZW', 'hung', '0354080798', 'zalo.me', '2016-06-06', 'facebook.com', NULL, '103095080_307460736932710_8596327333627453310_n - Copy.jpg', 1, 1, 1, 2, NULL, '2020-06-19 20:18:16', '2020-06-19 20:18:16'),
(35, 'okkaka1s22@gmail.com', NULL, '$2y$10$tIii.Vy05juJfidr2QnPXeXLVHF4EytAwCqXPZIEOBFah3RC0Xafy', 'hung', '0354080798', 'zalo.me', '2016-06-06', 'facebook.com', NULL, '103095080_307460736932710_8596327333627453310_n - Copy.jpg', 1, 1, 1, 2, NULL, '2020-06-21 18:24:54', '2020-06-21 18:24:54'),
(36, 'okkaka1s2233@gmail.com', NULL, '$2y$10$9obt/Lllot799CUaT/zE4eIfk3fysEhiOZofjrskhGhTbeIPGg/dS', 'hung', '0354080798', 'zalo.me', '2016-06-06', 'facebook.com', NULL, '103095080_307460736932710_8596327333627453310_n - Copy.jpg', 1, 1, 1, 3, NULL, '2020-06-21 20:11:45', '2020-06-21 20:11:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_user`
--
ALTER TABLE `company_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuration_cpny`
--
ALTER TABLE `configuration_cpny`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_attendance`
--
ALTER TABLE `history_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_user`
--
ALTER TABLE `member_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `service_pack`
--
ALTER TABLE `service_pack`
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
-- AUTO_INCREMENT for table `company_user`
--
ALTER TABLE `company_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `configuration_cpny`
--
ALTER TABLE `configuration_cpny`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_attendance`
--
ALTER TABLE `history_attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_user`
--
ALTER TABLE `member_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_pack`
--
ALTER TABLE `service_pack`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
