-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 02:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims_inventory1`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `borrower_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `checkoutdate` varchar(255) DEFAULT NULL,
  `dateofreturn` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `brnumber` varchar(255) DEFAULT NULL,
  `stockout_id` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `productcode` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `itemdescription` varchar(255) DEFAULT NULL,
  `serialnumber` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'AVER', NULL, NULL, 1),
(2, 'DAKTRONICS', NULL, NULL, 2),
(3, 'LINSO', NULL, NULL, 3),
(4, 'ABSEN', NULL, NULL, 3),
(5, 'SHENZHEN', NULL, NULL, 3),
(6, 'TRT', NULL, NULL, 3),
(7, 'SHANGHAI', NULL, NULL, 3),
(8, 'SHANGHAI ELEC', NULL, NULL, 3),
(9, 'LIGHT KING', NULL, NULL, 3),
(10, 'LEYARD', NULL, NULL, 3),
(11, 'FABULUX', NULL, NULL, 3),
(12, 'UNILUMIN', NULL, NULL, 3),
(13, 'LEDTOP', NULL, NULL, 3),
(14, 'UNIVIEW', NULL, NULL, 3),
(15, 'APCUS', NULL, NULL, 3),
(16, 'YAHAM', NULL, NULL, 3),
(17, 'LIGHT HOUSE', NULL, NULL, 3),
(18, 'NOVA STAR', NULL, NULL, 4),
(19, 'NOVA STAR', NULL, NULL, 5),
(20, 'NOVA STAR', NULL, NULL, 7),
(21, 'NOVA STAR', NULL, NULL, 8),
(22, 'NOVA STAR', NULL, NULL, 10),
(23, 'PHILIPS', NULL, NULL, 6),
(24, 'ADPOD', NULL, NULL, 6),
(25, 'VOGELS', NULL, NULL, 11),
(26, 'KIOSK', NULL, NULL, 12),
(27, 'SHUTTLE', NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AVER', NULL, NULL),
(2, 'DAKTRONICS', NULL, NULL),
(3, 'LED', NULL, NULL),
(4, 'LED CONTROLLER', NULL, NULL),
(5, 'MEDIA PLAYER', NULL, NULL),
(6, 'PHILIPS', NULL, NULL),
(7, 'SENDING BOX', NULL, NULL),
(8, 'SENDING CARD', NULL, NULL),
(9, 'SHUTTLE', NULL, NULL),
(10, 'VIDEO PROCESSOR', NULL, NULL),
(11, 'VOGELS', NULL, NULL),
(12, 'WINALL', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checkins`
--

CREATE TABLE `checkins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `checkindate` varchar(255) DEFAULT NULL,
  `ponumber` varchar(255) DEFAULT NULL,
  `strnumber` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `productcode` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `itemdescription` varchar(255) DEFAULT NULL,
  `serialnumber` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `log_date` datetime NOT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `log_type` varchar(50) NOT NULL,
  `data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `log_date`, `table_name`, `log_type`, `data`) VALUES
(1, 1, '2023-04-25 08:32:19', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\"}'),
(2, 1, '2023-04-26 08:10:08', '', 'login', '{\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\"}');

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
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2020_11_20_100001_create_log_table', 1),
(8, '2023_02_22_015455_create_sessions_table', 1),
(9, '2023_02_22_022853_add_details_to_users_table', 1),
(10, '2023_02_22_031641_create_categories_table', 1),
(11, '2023_02_22_034404_create_brands_table', 1),
(12, '2023_02_22_034610_add_category_id_to_brands_table', 1),
(13, '2023_02_22_051913_create_products_table', 1),
(14, '2023_02_22_071436_create_carts_table', 1),
(15, '2023_02_22_071729_create_orders_table', 1),
(16, '2023_02_22_071840_create_order_items_table', 1),
(17, '2023_03_01_004212_create_checkins_table', 1),
(18, '2023_03_09_021731_create_return_slips_table', 1),
(19, '2023_03_09_061444_create_borrowers_table', 1),
(20, '2023_03_09_074256_create_purchase_returns_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `checkoutdate` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `drnumber` varchar(255) DEFAULT NULL,
  `srnumber` varchar(255) DEFAULT NULL,
  `ponumber` varchar(255) DEFAULT NULL,
  `stockout_id` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `productcode` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `itemdescription` varchar(255) DEFAULT NULL,
  `serialnumber` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `sku` varchar(255) NOT NULL,
  `productcode` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `location`, `brand`, `model`, `sku`, `productcode`, `uom`, `description`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'A-JUAN', 'ABSEN', 'P16', 'GLED0003', 'P-16 ABSEN', 'PANEL/S', 'P16 LED DISPLAY (1,024mm x 1,024mm) - OUTDOOR', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(2, 3, 'A-JUAN', 'FABULUX', 'INPAD PLUS P1.9', '2208003SA-1', 'INPAD PLUS P1.9-109', 'PANEL/S', 'INPAD PLUS / P1.9 LED DISPLAY (500mm x 1000mm)', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(3, 3, 'A-JUAN', 'FABULUX', 'INPAD PLUS P2.9', '2207048PO', 'INPAD PLUS P2.9-108', 'PANEL/S', 'INPAD PLUS / P2.9 LED DISPLAY (500mm x 1000mm)', 22, 'Available', NULL, '2023-04-26 00:19:46'),
(4, 3, 'A-JUAN', 'FABULUX', 'INPAD PLUS P3.9-1', '2204006PO-1', 'INPAD PLUS P3.9-106', 'PANEL/S', 'INPAD PLUS / P3.9 LED DISPLAY (500mm x 1000mm) - INDOOR', 248, 'Available', NULL, '2023-04-26 00:19:46'),
(5, 3, 'A-JUAN', 'FABULUX', 'INPAD PLUS P3.9-2', '2204006PO-2', 'INPAD PLUS P3.9-107', 'PANEL/S', 'INPAD PLUS / P3.9 LED DISPLAY (500mm x 500mm) - INDOOR', 80, 'Available', NULL, '2023-04-26 00:19:46'),
(6, 3, 'A-JUAN', 'FABULUX', 'INPAD PLUS P3.9-3', '2103010PO', 'INPAD PLUS P3.9', 'PANEL/S', 'INPAD PLUS / P3.9 LED DISPLAY (500mmx1000mm) - INDOOR', 13, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(7, 3, 'A-JUAN', 'FABULUX', 'P16.67', '2112006SA', 'P16.67-96', 'PANEL/S', 'P16.67 LED DISPLAY (1000mm x 1000mm)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(8, 3, 'A-JUAN', 'FABULUX', 'P6.67', '2210033PO', 'PTA 6.67-114', 'PANEL/S', 'P6.67 / PTA6.67 LED DISPLAY (960mm x 960mm) OUTDOOR', 109, 'Available', NULL, '2023-04-26 00:19:46'),
(9, 3, 'A-JUAN', 'FABULUX', 'P6.67', '2212022PO', 'PTA6.67-120', 'PANEL/S', 'P6.67 / PTA6.67 LED DISPLAY (960mm x 960mm) OUTDOOR', 222, 'Available', NULL, '2023-04-26 00:19:46'),
(10, 3, 'A-JUAN', 'FABULUX', 'PTA 6.67', '2208003SA-2', 'PTA 6.67-110', 'PANEL/S', 'PTA 6.67 LED DISPLAY (960mm x 960mm)', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(11, 3, 'A-JUAN', 'FABULUX', 'PTA 6.67', '2203024PO', 'PTA 6.67-105', 'PANEL/S', 'P6.67 / PTA6.67 LED DISPLAY (960mm x 960mm) OUTDOOR', 80, 'Available', NULL, '2023-04-26 00:19:46'),
(12, 3, 'A-JUAN', 'FABULUX', 'PTS 2.9', '2111014PO', 'PTS2.9-95', 'PANEL/S', 'PTS 2.9 LED DISPLAY (500mm x 500mm) - INDOOR / OUTDOOR', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(13, 3, 'A-JUAN', 'FABULUX', 'PTS 3.9', '2107022PO', 'PTS P3.91', 'PANEL/S', 'PTS 3.9/ P3.9 LED DISPLAY (500mmx1000mm) - OUTDOOR', 23, 'Available', NULL, '2023-04-26 00:19:46'),
(14, 3, 'A-JUAN', 'FABULUX', 'PTS 3.9', '2110013PO', 'PTS3.9-94', 'PANEL/S', 'PTS 3.9 / P3.9 LED DISPLAY (500mmx1000mm) OUTDOOR', 240, 'Available', NULL, '2023-04-26 00:19:46'),
(15, 3, 'A-JUAN', 'FABULUX', 'SPIDER 2.9', '2203013PO', 'SPIDER2.9.100', 'PANEL/S', 'SPIDER2.9 / P2.9 LED DISPLAY (500mm x 500mm) INDOOR', 200, 'Available', NULL, '2023-04-26 00:19:46'),
(16, 3, 'A-JUAN', 'FABULUX', 'SPIDER2.9', '2203035PO', 'SPIDER2.9.104', 'PANEL/S', 'SPIDER2.9 / P2.9 LED DISPLAY (500mm x 500mm) in BLUE BOX INDOOR', 480, 'Available', NULL, '2023-04-26 00:19:46'),
(17, 3, 'A-JUAN', 'FABULUX', 'TMAX', '2211020SA', 'TMAX-115', 'PANEL/S', 'TMAX COB P1.2 LED DISPLAY (600mm x 337.5mm) (SAMPLE)', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(18, 3, 'A-JUAN', 'LEDTOP', 'DRAGON-P3.9', 'LTVGT220901-D', 'DRAGON-P3.9-111', 'PANEL/S', 'DRAGON-P3.9 LED DISPLAY (500mmx500mmx83mm)', 307, 'Available', NULL, '2023-04-26 00:19:46'),
(19, 3, 'A-JUAN', 'LEDTOP', 'EC5', 'LTVGT221025-D', 'EC5-116', 'PANEL/S', 'EC5 / P5 LED DISPLAY (960mm x 960mm x 138.5) OUTDOOR', 170, 'Available', NULL, '2023-04-26 00:19:46'),
(20, 3, 'A-JUAN', 'LEDTOP', 'GOKU-P1.9', 'LKV220505-1-D', 'GOKU-P1.9-112', 'PANEL/S', 'GOKU-P1.9 LED DISPLAY (1000mmx250mmx42mm)', 90, 'Available', NULL, '2023-04-26 00:19:46'),
(21, 3, 'A-JUAN', 'LEDTOP', 'P2.6', 'P2.6 (SAMPLE)', 'P2.6-113', 'PANEL/S', 'P2.6 LED DISPLAY (SAMPLE)', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(22, 3, 'A-JUAN', 'LEDTOP', 'TIGER3.9', 'LTVGT221119-D', '3.9-117', 'PANEL/S', 'TIGER 3.9 / P3.9 LED DISPLAY (500mm x 500mm x 83mm) INDOOR', 603, 'Available', NULL, '2023-04-26 00:19:46'),
(23, 3, 'A-JUAN', 'LEYARD', 'P10', 'ZX200123', 'P10-G28', 'PANEL/S', 'P10 LED DISPLAY (960mm x 960mm) - OUTDOOR', 82, 'Available', NULL, '2023-04-26 00:19:46'),
(24, 3, 'A-JUAN', 'LEYARD', 'P10', 'ZX200189-CV10S', 'P10-G34', 'PANEL/S', 'P10 LED DISPLAY (1040x970x1080mm) - OUTDOOR', 36, 'Available', NULL, '2023-04-26 00:19:46'),
(25, 3, 'A-JUAN', 'LEYARD', 'P16/16', 'ZX200089', 'P16/16-G29', 'PANEL/S', 'P16/16 LED DISPLAY (500mm x 1000mm) - OUTDOOR', 210, 'Available', NULL, '2023-04-26 00:19:46'),
(26, 3, 'A-JUAN', 'LEYARD', 'P3.9', 'ZHX19G16', 'P3.9-GI14', 'PANEL/S', 'P3.9 FLOOR LED DISPLAY (500mm x 500mm) -INDOOR', 12, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(27, 3, 'A-JUAN', 'LIGHT KING', 'EC5 (PRO)', 'LKGT210917-D', 'EC5(PRO)-93', 'PANEL/S', 'P6 / EC5 (PRO) LED DISPLAY (960mm X 960mm X 138.5) OUTDOOR', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(28, 3, 'A-JUAN', 'LIGHT KING', 'EC5 (PRO)', 'LKVGT211227', 'EC5-97', 'PANEL/S', 'P6 / EC5 (PRO) LED DISPLAY (960mm x 960mm x 120MM) OUTDOOR', 20, 'Low Stock', NULL, NULL),
(29, 3, 'A-JUAN', 'LIGHT KING', 'EC6/P6', 'LKGT20190218-D', 'EC6/P6-MINDORO', 'PANEL/S', 'P6 / EC6 LED DISPLAY (960mm x 960mm x 138.5mm) - OUTDOOR', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(30, 3, 'A-JUAN', 'LIGHT KING', 'P10', '1611004-D1-1', 'P10-HONDA/MOGS', 'PANEL/S', 'P10 LED DISPLAY (960mm x 960mmx138.5) - OUTDOOR', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(31, 3, 'A-JUAN', 'LIGHT KING', 'P10/E10', '1803111-D', 'P10/E10-GI6', 'PANEL/S', 'P10/E10 LED DISPLAY (960mm x 960mm x 138.5) - OUTDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(32, 3, 'A-JUAN', 'LIGHT KING', 'P10/E10', 'LKGT20191018-D', 'P10/E10-GI23', 'PANEL/S', 'P10 / E10 LED DISPLAY (960mm x 960mm x 138.5mm) - OUTDOOR', 100, 'Available', NULL, '2023-04-26 00:19:46'),
(33, 3, 'A-JUAN', 'LIGHT KING', 'P15/15', 'LKGT20200224', 'P15/15-G25', 'PANEL/S', 'P15/15 LED DISPLAY (500mm x 1000mm) - OUTDOOR', 172, 'Available', NULL, '2023-04-26 00:19:46'),
(34, 3, 'A-JUAN', 'LIGHT KING', 'P2.5/FXPRO2.5', 'YF20191224-03-D1', 'P2.5/FXPRO-G32', 'PANEL/S', 'P2.5 / FX PRO 2.5 LED DISPLAY (250mm x 1000mm x 42mm) - CENTER - INDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(35, 3, 'A-JUAN', 'LIGHT KING', 'P2.5/FXPRO2.5', 'YF20191224-03-D2', 'P2.5/FXPRO-G32', 'PANEL/S', 'P2.5 / FX PRO 2.5 LED DISPLAY (250mm x 1000mm x 42mm) -LEFT - INDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(36, 3, 'A-JUAN', 'LIGHT KING', 'P2.5/FXPRO2.5', 'YF20191224-03-D3', 'P2.5/FXPRO-G32', 'PANEL/S', 'P2.5 / FX PRO 2.5 LED DISPLAY (250mm x 750mm x 42mm) - RIGHT - INDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(37, 3, 'A-JUAN', 'LIGHT KING', 'P2.5/FXPRO2.5', 'YF20191224-03-D4', 'P2.5/FXPRO-G32', 'PANEL/S', 'P2.5 / FX PRO 2.5 LED DISPLAY (250mm x 750mm x 42mm) – A4S/RDCX - INDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(38, 3, 'A-JUAN', 'LIGHT KING', 'P2.5/FXPRO2.5', 'YF20191224-03-D5', 'P2.5/FXPRO-G32', 'PANEL/S', 'P2.5 / FX PRO 2.5 LED DISPLAY (250mm x 500mm x 42mm) – A4S/RDCX - INDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(39, 3, 'A-JUAN', 'LIGHT KING', 'P2.8', 'LKGT20191019-D1', 'P2.8 LED-REGATTA', 'PANEL/S', 'KINGFLEX PRO P2.8 LED DISPLAY (250mm x 1000mm x 42mm) -INDOOR', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(40, 3, 'A-JUAN', 'LIGHT KING', 'P2.8/FS2.8', 'LKGT20201121-D', 'P2.8/FS2.8-G38', 'PANEL/S', 'P2.8 / FS2.8 LED DISPLAY (500mm x 500mm x 63mm) - INDOOR', 16, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(41, 3, 'A-JUAN', 'LIGHT KING', 'P2.8/FXPRO2.8', 'LKGT20201210-D', 'P2.8/FXPRO-G40', 'PANEL/S', 'P2.8 / FX PRO 2.8 LED DISPLAY (250mm x 1000mm x 42mm) - INDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(42, 3, 'A-JUAN', 'LIGHT KING', 'P2.8/FXPRO2.8', 'LKGT20210121-D', 'P2.8/FXPRO-G39', 'PANEL/S', 'P2.8 / FX PRO 2.8 LED DISPLAY (250mm x 1000mm x 42mm) - INDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(43, 3, 'A-JUAN', 'LIGHT KING', 'P2.8/RCF2.8', 'LKGT20190804-D', 'P2.8/RCF2.8-GI19', 'PANEL/S', 'P2.8/RCF2.8 LED (500mm x 500mmx63mm) - INDOOR', 20, 'Low Stock', NULL, NULL),
(44, 3, 'A-JUAN', 'LIGHT KING', 'P2.9/MR2.9', 'LKGT1612039-D1-2', 'P2.9/MR2.9-G12', 'PANEL/S', 'P2.9/MR2.9 LED DISPLAY (600mm x 400mm x 80.5mm) in BLACK BOX - INDOOR', 21, 'Available', NULL, NULL),
(45, 3, 'A-JUAN', 'LIGHT KING', 'P2.9/SGR2.9', '1612039-D1-2', 'P2.9/SGR-2.9-GI9', 'PANEL/S', 'P2.9/SGR-2.9II DISPLAY (600mm x 400mm x 80.5mm) in BLACK BOX - INDOOR', 73, 'Available', NULL, '2023-04-26 00:19:46'),
(46, 3, 'A-JUAN', 'LIGHT KING', 'P3.9/RW3', 'LKGT20200925-D', 'P3.9/RW3-G27', 'PANEL/S', 'P3.9/RW3 LED DISPLAY (500mm x 500mm x 75mm) - INDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(47, 3, 'A-JUAN', 'LIGHT KING', 'P3.9/RW3', 'LTKG20191220-D', 'P3.9/RW3-G26', 'PANEL/S', 'P3.9/RW3 LED DISPLAY (500mm x 500mm x 75mm) -INDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(48, 3, 'A-JUAN', 'LIGHT KING', 'P4.8/RC4', '1702016-D1-3', 'P4.8/RC4-GI8', 'PANEL/S', 'P4.8/RC4 LED DISPLAY (500mm x 500mmx 63mm) in BLACK BOX - INDOOR', 33, 'Available', NULL, '2023-04-26 00:19:46'),
(49, 3, 'A-JUAN', 'LIGHT KING', 'P5.9/EC6', 'LKGT20191022-D', 'P5.9/EC5-GI22', 'PANEL/S', 'P5.9 / EC6 LED DISPLAY (960mm x 960mm x 140mm) - OUTDOOR', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(50, 3, 'A-JUAN', 'LIGHT KING', 'P5.9/KB5', 'LKGT20190805-D', 'P5.9/KB5-GI20', 'PANEL/S', 'P5.9 / KB5 LED (500mm x 500mmx22mm) - OUTDOOR', 28, 'Available', NULL, '2023-04-26 00:19:46'),
(51, 3, 'A-JUAN', 'LIGHT KING', 'P6/E6', 'LKGT20180528-D', 'P6/E6-CSB/TRACERLINE', 'PANEL/S', 'P6/EC6 LED DISPLAY (960mm x 960mm x 138.5mm) - OUTDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(52, 3, 'A-JUAN', 'LIGHT KING', 'P6/RS6', '1710042-D', 'P6/RS6-GI7', 'PANEL/S', 'P6/RS6 LED DISPLAY (576mm x 576mm x 45mm) -INDOOR', 140, 'Available', NULL, '2023-04-26 00:19:46'),
(53, 3, 'A-JUAN', 'LIGHT KING', 'RDY2.8', 'LKHK211124-1-D', 'RDY2.8-99', 'PANEL/S', 'P2.8 / RDY2.8 DISPLAY (500mm x 500mm x 83mm) INDOOR', 196, 'Available', NULL, '2023-04-26 00:19:46'),
(54, 3, 'A-JUAN', 'LIGHT KING', 'RDY2.8', 'LKVGT211112-D', 'RDY2.8-98', 'PANEL/S', 'P2.8 / RDY2.8 DISPLAY (500mm x 500mm x 83mm) INDOOR', 40, 'Available', NULL, '2023-04-26 00:19:46'),
(55, 3, 'A-JUAN', 'LINSO', 'P12', 'GLED0012', 'P12-PAGSANJAN/TV5', 'PANEL/S', 'P12 LED DISPLAY (960mm x 960mm) - OUTDOOR', 8, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(56, 3, 'A-JUAN', 'LINSO', 'P12.3', 'GLED0009', 'P12.3-GI4', 'PANEL/S', 'P12 LED DISPLAY (768mm x 768mm) - OUTDOOR', 18, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(57, 3, 'A-JUAN', 'LINSO', 'P16', 'GLED0006', 'P16-TZU-CHI', 'PANEL/S', 'P16 LED DISPLAY (960mm x 960mm) - OUTDOOR', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(58, 3, 'A-JUAN', 'LINSO', 'P25', 'GLED0001', 'P25-GI1', 'UNIT/S', 'P25 LED DISPLAY (2,000mm x 2,000mm) - OUTDOOR', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(59, 3, 'A-JUAN', 'SHANGHAI', 'P12.3', 'GLED0008', 'P12.3-GI3', 'PANEL/S', 'P12.3 LED DISPLAY (960mm x 960mm) - OUTDOOR', 27, 'Available', NULL, '2023-04-26 00:19:46'),
(60, 3, 'A-JUAN', 'SHANGHAI ELEC', 'P10', 'GLED0015', 'P10-GI5', 'PANEL/S', 'P10 LED DISPLAY (960mm x 960mm) - OUTDOOR', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(61, 3, 'A-JUAN', 'SHENZHEN', 'P16', 'GLED0004', 'P16-GI2', 'PANEL/S', 'P16 LED DISPLAY (960mm x 960mm) - OUTDOOR', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(62, 3, 'A-JUAN', 'TRT', 'P10/10', 'TOC1906190', 'P10-10-GI15', 'PANEL/S', 'P10-10 LED (500mm x 1000mm) - OUTDOOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(63, 3, 'A-JUAN', 'TRT', 'P16', 'TOC1704132', 'P16-SKS', 'PANEL/S', 'P16 LED DISPLAY (500mm x 1,000mm) - OUTDOOR', 82, 'Available', NULL, '2023-04-26 00:19:46'),
(64, 3, 'A-JUAN', 'TRT', 'P16/16', 'TDC1712469', 'P16/16-SMILEE', 'PANEL/S', 'P16/16 LED DISPLAY (500mm x 1,000mm) - OUTDOOR', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(65, 3, 'A-JUAN', 'TRT', 'P16/16', 'TDC1803067', 'P16/16-MAGALLANES/CBC', 'PANEL/S', 'P16/16 LED DISPLAY (500mm x 1,000mm) - OUTDOOR', 135, 'Available', NULL, '2023-04-26 00:19:46'),
(66, 3, 'A-JUAN', 'TRT', 'P2.5', 'T0C1809350/1', 'P2.5-GI10', 'UNIT/S', 'P2.5 iPOSTER LED (1902mm x 572mm) - INDOOR', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(67, 3, 'A-JUAN', 'TRT', 'P2.5', 'T0C1904105/2', 'P2.5-GI10', 'UNIT/S', 'P2.5 iPOSTER LED (1902mm x 572mm) - INDOOR', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(68, 3, 'A-JUAN', 'TRT', 'P2.5', 'T0C1905155/3', 'P2.5-GI10', 'UNIT/S', 'P2.5 iPOSTER LED (1902mm x 572mm) - INDOOR', 24, 'Available', NULL, '2023-04-26 00:19:46'),
(69, 3, 'A-JUAN', 'TRT', 'P8.33/16.67', 'TDC1802040', 'P8.33/16.67-D.DRAGON', 'PANEL/S', 'P8.33/16.67 LED DISPLAY (500mm x1,000mm) - OUTDOOR', 150, 'Available', NULL, '2023-04-26 00:19:46'),
(70, 3, 'A-JUAN', 'TRT', 'P8.33/16.67', 'TDM1710405', 'P8.33/16.67-Y-BLDNG', 'PANEL/S', 'P8.33/16.67 LED DISPLAY (500mm x 1,000mm) - OUTDOOR', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(71, 3, 'A-JUAN', 'UNILUMIN', 'P2.5', 'APS201588', 'P2.5-G37', 'PANEL/S', 'P2.5/KSLIM LED DISPLAY (500mmX1000mm) - INDOOR', 23, 'Available', NULL, '2023-04-26 00:19:46'),
(72, 3, 'A-JUAN', 'UNILUMIN', 'UHWII1,2', 'APS220168', 'UHWII1,2-101', 'PANEL/S', 'UHWII1,2 / P1.2 LED DISPLAY (609.92mm x 343.08mm)', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(73, 3, 'A-JUAN', 'UNILUMIN', 'USLIMII2.5', 'APS220169', 'USLIMII2.5-102', 'PANEL/S', 'USLIMII2.5 / P2.5 LED DISPLAY (500mm x 1000mm)', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(74, 3, 'A-JUAN', 'UNILUMIN', 'USTORMIII16', 'E210030', 'USTORM16-103', 'PANEL/S', 'E210030 / P16 LED DISPLAY (800mm x 900mm)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(75, 3, 'A-JUAN', 'UNIVIEW', 'GX2.6', 'GX2.6-85321000', 'GX2.6-118', 'PANEL/S', 'GX2.6 / P2.6 LED DISPLAY (500mm x 1000mm)', 197, 'Available', NULL, '2023-04-26 00:19:46'),
(76, 3, 'A-JUAN', 'UNIVIEW', 'GX2.6', 'GX2.6-85321001', 'GX2.6-119', 'PANEL/S', 'GX2.6 / P2.6 LED DISPLAY (250mm x 1000mm)', 176, 'Available', NULL, '2023-04-26 00:19:46'),
(77, 6, 'A-JUAN', 'ADPOD', 'ADPOD4210Q', 'GBTXKIOSK011', 'PHVW-42AP', 'UNIT/S', '42\" PHILIPS VIDEO WALL IN ADPOD', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(78, 6, 'A-JUAN', 'PHILIPS', '10BDL4151T/00', '10BDL4151T/00-1', 'PH10T-1', 'UNIT/S', '10\" PHILIPS TOUCH SCREEN MONITOR', 14, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(79, 6, 'A-JUAN', 'PHILIPS', '24BDL4151T/00', '24BDL4151T/00-1', 'PH24T-2', 'UNIT/S', '24\" PHILIPS TOUCH SCREEN MONITOR', 18, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(80, 6, 'A-JUAN', 'PHILIPS', '32BDL4050D/75', '32BDL4050D/75-1', 'PH32D-3', 'PANEL/S', '32\" PHILIPS FLAT WIDE MONITOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(81, 6, 'A-JUAN', 'PHILIPS', '32BDL4550D', '32BDL4550D-1', 'PH32D-4', 'UNIT/S', '32\" PHILIPS FLAT WIDE MONITOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(82, 6, 'A-JUAN', 'PHILIPS', '32BDL4550D', '32BDL4550D-2', 'PH32D-5', 'UNIT/S', '32\" PHILIPS FLAT WIDE MONITOR', 21, 'Available', NULL, NULL),
(83, 6, 'A-JUAN', 'PHILIPS', '43BDL3010Q/75', '43BDL3010Q/75-1', 'PH43Q-2', 'UNIT/S', '43\" PHILIPS FLAT WIDE MONITOR', 105, 'Available', NULL, '2023-04-26 00:19:46'),
(84, 6, 'A-JUAN', 'PHILIPS', '43BDL3452T', '43BDL3452T-1', 'PH43T-1', 'UNIT/S', '43\" PHILIPS TOUCH SCREEN MONITOR', 13, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(85, 6, 'A-JUAN', 'PHILIPS', '43BDL4050D/00', '43BDL4050D/00-2', 'PH43D-4', 'UNIT/S', '43\" PHILIPS FLAT WIDE MONITOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(86, 6, 'A-JUAN', 'PHILIPS', '43BDL4550D/75', '43BDL4550D/75-1', 'PH43D-6', 'UNIT/S', '43” PHILIPS FLAT WIDE MONITOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(87, 6, 'A-JUAN', 'PHILIPS', '43BDL4550D/75', '43BDL4550D/75-2', 'PH43D-7', 'UNIT/S', '43” PHILIPS FLAT WIDE MONITOR', 79, 'Available', NULL, '2023-04-26 00:19:46'),
(88, 6, 'A-JUAN', 'PHILIPS', '50BDL3050Q/75', '50BDL3050Q/75-1', 'PH50Q-4', 'UNIT/S', '50\" PHILIPS FLAT WIDE MONITOR', 43, 'Available', NULL, '2023-04-26 00:19:46'),
(89, 6, 'A-JUAN', 'PHILIPS', '50BDL4550D', '50BDL4550D-1', 'PH50D-1', 'UNIT/S', '50” PHILIPS FLAT WIDE MONITOR', 47, 'Available', NULL, '2023-04-26 00:19:46'),
(90, 6, 'A-JUAN', 'PHILIPS', '50BDL4550D', '50BDL4550D-2', 'PH50D-2', 'UNIT/S', '50” PHILIPS FLAT WIDE MONITOR', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(91, 6, 'A-JUAN', 'PHILIPS', '55BDL2005X', '55BDL2005X-1', 'PH55X-2', 'UNIT/S', '55” PHILIPS FLAT WIDE MONITOR', 46, 'Available', NULL, '2023-04-26 00:19:46'),
(92, 6, 'A-JUAN', 'PHILIPS', '55BDL2005X', '55BDL2005X-2', 'PH55X-3', 'UNIT/S', '55” PHILIPS FLAT WIDE MONITOR', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(93, 6, 'A-JUAN', 'PHILIPS', '55BDL3010Q/ 75', '55BDL3010Q/75-1', 'PH55Q-3', 'UNIT/S', '55” PHILIPS FLAT WIDE MONITOR', 127, 'Available', NULL, '2023-04-26 00:19:46'),
(94, 6, 'A-JUAN', 'PHILIPS', '55BDL3452T', '55BDL3452T-1', 'PH55T-5', 'UNIT/S', '55\" PHILIPS TOUCH SCREEN MONITOR', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(95, 6, 'A-JUAN', 'PHILIPS', '55BDL4007X', '55BDL4007X-1', 'PH55X-4', 'UNIT/S', '55” PHILIPS FLAT WIDE MONITOR', 51, 'Available', NULL, '2023-04-26 00:19:46'),
(96, 6, 'A-JUAN', 'PHILIPS', '55BDL4007X', '55BDL4007X-2', 'PH55X-5', 'UNIT/S', '55” PHILIPS FLAT WIDE MONITOR', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(97, 6, 'A-JUAN', 'PHILIPS', '55BDL4550D', '55BDL4550D-1', 'PH55D-8', 'UNIT/S', '55” PHILIPS FLAT WIDE MONITOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(98, 6, 'A-JUAN', 'PHILIPS', '55BDL4550D', '55BDL4550D-2', 'PH55D-9', 'UNIT/S', '55” PHILIPS FLAT WIDE MONITOR', 62, 'Available', NULL, '2023-04-26 00:19:46'),
(99, 6, 'A-JUAN', 'PHILIPS', '65BDL3000Q/75', '65BDL3000Q/75-1', 'PH65Q-1', 'UNIT/S', '65\" PHILIPS FLAT WIDE MONITOR', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(100, 6, 'A-JUAN', 'PHILIPS', '65BDL3050Q/75', '65BDL3050Q/75-2', 'PH65Q-5', 'UNIT/S', '65” PHILIPS FLAT WIDE MONITOR', 51, 'Available', NULL, '2023-04-26 00:19:46'),
(101, 6, 'A-JUAN', 'PHILIPS', '65BDL3052T/75', '65BDL3052T/75-3', 'PH65T-6', 'UNIT/S', '65\" PHILIPS TOUCH SCREEN MONITOR', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(102, 6, 'A-JUAN', 'PHILIPS', '65BDL4150D/75', '65BDL4150D/75-2', 'PH65D-8', 'UNIT/S', '65\" PHILIPS FLAT WIDE MONITOR', 28, 'Available', NULL, '2023-04-26 00:19:46'),
(103, 6, 'A-JUAN', 'PHILIPS', '75BDL3050Q/75', '75BDL3050Q/75-1', 'PH75Q-6', 'UNIT/S', '75\" PHILIPS FLAT WIDE MONITOR', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(104, 6, 'A-JUAN', 'PHILIPS', '75BDL4150D/75', '75BDL4150D/75-1', 'PH75D-9', 'UNIT/S', '75\" PHILIPS FLAT WIDE MONITOR', 21, 'Available', NULL, NULL),
(105, 6, 'A-JUAN', 'PHILIPS', '86BDL3012T/00', '86BDL3012T/00-1', 'PH86T-7', 'UNIT/S', '86\" PHILIPS TOUCH SCREEN MONITOR', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(106, 6, 'A-JUAN', 'PHILIPS', '86BDL3050Q/75', '86BDL3050Q/75-2', 'PH86Q-7', 'UNIT/S', '86\" PHILIPS FLAT WIDE MONITOR', 35, 'Available', NULL, '2023-04-26 00:19:46'),
(107, 6, 'A-JUAN', 'PHILIPS', '98BDL4550D', '98BDL4550D-1', 'PH98D-1', 'UNIT/S', '98” PHILIPS FLAT WIDE MONITOR', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(108, 6, 'A-JUAN', 'PHILIPS', 'BDL3230QL/75', 'BDL3230QL/75-1', 'PH32QL-6', 'UNIT/S', '31.5\" PHILIPS FLAT WIDE MONITOR', 173, 'Available', NULL, '2023-04-26 00:19:46'),
(109, 6, 'A-JUAN', 'PHILIPS', 'BDL4620QL/00', 'BDL4620QL/00-1', 'PH46QL-4', 'UNIT/S', '46\" PHILIPS FLAT WIDE MONITOR', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(110, 6, 'A-JUAN', 'PHILIPS', 'BDL4651VH/00', 'BDL4651VH/00-1', 'PH46VH-2', 'UNIT/S', '46\" PHILIPS FLAT WIDE MONITOR', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(111, 6, 'A-JUAN', 'PHILIPS', 'BDL4680VL/00', 'BDL4680VL/00-1', 'PH46VL-3', 'UNIT/S', '46\" PHILIPS FLAT WIDE MONITOR', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(112, 6, 'A-JUAN', 'PHILIPS', 'BDL4776XL/00', 'BDL4776XL/00-1', 'PH47XL-1', 'UNIT/S', '47\" PHILIPS FLAT WIDE MONITOR', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(113, 6, 'A-JUAN', 'PHILIPS', 'BDL4777XL/00', 'BDL4777XL/00-1', 'PH47XL-2', 'UNIT/S', '47\" PHILIPS FLAT WIDE MONITOR', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(114, 6, 'A-JUAN', 'PHILIPS', 'BDL4780VH/75', 'BDL4780VH/75-1', 'PH47VH-1', 'UNIT/S', '47\" PHILIPS FLAT WIDE MONITOR', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(115, 6, 'A-JUAN', 'PHILIPS', 'BDL4835QL/00', 'BDL4835QL/00-1', 'PH48QL-7', 'UNIT/S', '48\" PHILIPS FLAT WIDE MONITOR', 14, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(116, 6, 'A-JUAN', 'PHILIPS', 'BDL4970EL/75', 'BDL4970EL/75-1', 'PH49EL-7', 'UNIT/S', '49\" PHILIPS FLAT WIDE MONITOR', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(117, 6, 'A-JUAN', 'PHILIPS', 'BDL5530QL/75', 'BDL5530QL/75-2', 'PH55QL-8', 'UNIT/S', '55\" PHILIPS FLAT WIDE MONITOR', 14, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(118, 6, 'A-JUAN', 'PHILIPS', 'BDL5551EL/00', 'BDL5551EL/00-1', 'PH55EL-5', 'UNIT/S', '55\" PHILIPS FLAT WIDE MONITOR', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(119, 6, 'A-JUAN', 'PHILIPS', 'BDL5571V/00', 'BDL5571V/00-1', 'PH55V-1', 'UNIT/S', '55\" PHILIPS FLAT WIDE MONITOR', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(120, 6, 'A-JUAN', 'PHILIPS', 'BDL5588XH/75', 'BDL5588XH/75-2', 'PH55XH-2', 'UNIT/S', '55\" PHILIPS FLAT WIDE MONITOR', 36, 'Available', NULL, '2023-04-26 00:19:46'),
(121, 6, 'A-JUAN', 'PHILIPS', 'BDL5588XL/00', 'BDL5588XL/00-1', 'PH55XL-4', 'UNIT/S', '55\" PHILIPS FLAT WIDE MONITOR', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(122, 6, 'A-JUAN', 'PHILIPS', 'BDL6520QL/00', 'BDL6520QL/00-1', 'PH65QL-5', 'UNIT/S', '65\" PHILIPS FLAT WIDE MONITOR', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(123, 6, 'A-JUAN', 'PHILIPS', 'BDL8470EU/75', 'BDL8470EU/75-1', 'PH84EU-1', 'UNIT/S', '84\" PHILIPS FLAT WIDE MONITOR', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(124, 11, 'A-JUAN', 'VOGELS', 'PFA9103', 'GBTXVGL0031', 'PHVB-0039', 'UNIT/S', 'CONNECT-IT LARGE FLOOR PLATE', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(125, 11, 'A-JUAN', 'VOGELS', 'PFA9104', 'GBTXVGL0032', 'PHVB-0040', 'UNIT/S', 'CONNECT-IT LARGE BAR COUPLER', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(126, 11, 'A-JUAN', 'VOGELS', 'PFA9116', 'GBTXVGL0079', 'PHVB-0087', 'UNIT/S', 'BLACK COVERS 50-55 INCH BLACK', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(127, 11, 'A-JUAN', 'VOGELS', 'PFA9120', 'GBTXVGL0078', 'PHVB-0086', 'UNIT/S', 'BACK COVERS 42-47 INCH PORTRAIT', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(128, 11, 'A-JUAN', 'VOGELS', 'PFA9121', 'GBTXVGL0077', 'PHVB-0085', 'UNIT/S', 'BACK COVERS 50-55 INCH PORTRAIT', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(129, 11, 'A-JUAN', 'VOGELS', 'PFA9126', 'GBTXVGL0022', 'PHVB-0025', 'UNIT/S', 'PFB 34XX BRACKET KIT', 16, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(130, 11, 'A-JUAN', 'VOGELS', 'PFA9127', 'GBTXVGL0073', 'PHVB-0081', 'UNIT/S', 'ACCESSORY CLAMP', 13, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(131, 11, 'A-JUAN', 'VOGELS', 'PFA9129', 'GBTXVGL0017', 'PHVB-0020', 'UNIT/S', 'VIDEO WALL CROSS BAR 1150MM', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(132, 11, 'A-JUAN', 'VOGELS', 'PFA9130', 'GBTXVGL0018', 'PHVB-0021', 'UNIT/S', 'VIDEO WALL CROSS BAR 1500MM', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(133, 11, 'A-JUAN', 'VOGELS', 'PFA9131', 'GBTXVGL0056', 'PHVB-0064', 'UNIT/S', 'POLE COUPLER FOR PUC', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(134, 11, 'A-JUAN', 'VOGELS', 'PFA9132', 'GBTXVGL0057', 'PHVB-0065', 'UNIT/S', 'FLOOR/CEILING SUPPORT', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(135, 11, 'A-JUAN', 'VOGELS', 'PFA9141', 'GBTXVGL0019', 'PHVB-0022', 'UNIT/S', 'WALL SUPPORT BASIC KIT LONG', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(136, 11, 'A-JUAN', 'VOGELS', 'PFA9142', 'GBTXVGL0020', 'PHVB-0023', 'UNIT/S', 'WALL SUPPORT EXTENSION 2 ARMS', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(137, 11, 'A-JUAN', 'VOGELS', 'PFA9144', 'GBTXVGL0086', 'PHVB-0094', 'UNIT/S', 'WALL SUPPORT BASIC KIT SHORT', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(138, 11, 'A-JUAN', 'VOGELS', 'PFA9156', 'GBTXVGL0074', 'PHVB-0082', 'UNIT/S', 'POLE COUPLER FOR PUC', 16, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(139, 11, 'A-JUAN', 'VOGELS', 'PFB 3433', 'GBTXVGL0125', 'PHVB-0133', 'UNIT/S', 'INT BAR 3315MM', 40, 'Available', NULL, '2023-04-26 00:19:46'),
(140, 11, 'A-JUAN', 'VOGELS', 'PFB3405', 'GBTXVGL0062', 'PHVB-0070', 'UNIT/S', 'INTERFACE BAR 515MM BLACK', 15, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(141, 11, 'A-JUAN', 'VOGELS', 'PFB3405', 'GBTXVGL0096', 'PHVB-0104', 'PC/S', 'INT BAR 515MM', 150, 'Available', NULL, '2023-04-26 00:19:46'),
(142, 11, 'A-JUAN', 'VOGELS', 'PFB3407', 'GBTXVGL0063', 'PHVB-0071', 'UNIT/S', 'INTERFACE BAR 715MM BLACK', 46, 'Available', NULL, '2023-04-26 00:19:46'),
(143, 11, 'A-JUAN', 'VOGELS', 'PFB3411', 'GBTXVGL0023', 'PHVB-0031', 'UNIT/S', 'INTERFACE BAR 1175MM BLACK', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(144, 11, 'A-JUAN', 'VOGELS', 'PFB3411', 'GBTXVGL0097', 'PHVB-0105', 'PC/S', 'INT BAR 1175MM', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(145, 11, 'A-JUAN', 'VOGELS', 'PFB3419', 'GBTXVGL0024', 'PHVB-0032', 'UNIT/S', 'INTERFACE BAR 1915MM BLACK', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(146, 11, 'A-JUAN', 'VOGELS', 'PFB3419', 'GBTXVGL0098', 'PHVB-0106', 'PC/S', 'INT BAR 1915MM', 20, 'Low Stock', NULL, NULL),
(147, 11, 'A-JUAN', 'VOGELS', 'PFB3427', 'GBTXVGL0025', 'PHVB-0033', 'UNIT/S', 'INTERFACE BAR 2765MM BLACK', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(148, 11, 'A-JUAN', 'VOGELS', 'PFB3427', 'GBTXVGL0099', 'PHVB-0107', 'PC/S', 'INT BAR 2765MM', 20, 'Low Stock', NULL, NULL),
(149, 11, 'A-JUAN', 'VOGELS', 'PFB3433', 'GBTXVGL0065', 'PHVB-0073', 'UNIT/S', 'INTERFACE BAR 3315MM BLACK', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(150, 11, 'A-JUAN', 'VOGELS', 'PFD8522', 'GBTXVGL0117', 'PHVB-0125', 'PC/S', 'DESK MOUNT', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(151, 11, 'A-JUAN', 'VOGELS', 'PFD8523', 'GBTXVGL0118', 'PHVB-0126', 'PC/S', 'DESK MOUNT', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(152, 11, 'A-JUAN', 'VOGELS', 'PFF5100', 'GBTXVGL0059', 'PHVB-0067', 'UNIT/S', 'VIDEO CONFERENCING FURNITURE', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(153, 11, 'A-JUAN', 'VOGELS', 'PFF5100', 'GBTXVGL0103', 'PHVB-0111', 'PC/S', 'VC FURNITURE', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(154, 11, 'A-JUAN', 'VOGELS', 'PFF5211', 'GBTXVGL0060', 'PHVB-0068', 'UNIT/S', 'VIDEO CONFERENCE FURNITURE', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(155, 11, 'A-JUAN', 'VOGELS', 'PFF5211', 'GBTXVGL0104', 'PHVB-0112', 'PC/S', 'VIDEO CONFERENCE FURNITURE', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(156, 11, 'A-JUAN', 'VOGELS', 'PFF7020', 'GBTXVGL0004', 'PHVB-0007', 'UNIT/S', 'FLOOR PLATE LARGE BLACK', 21, 'Available', NULL, NULL),
(157, 11, 'A-JUAN', 'VOGELS', 'PFF7030', 'GBTXVGL0005', 'PHVB-0008', 'UNIT/S', 'FLOOR PLATE EXTRA LARGE BLACK', 11, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(158, 11, 'A-JUAN', 'VOGELS', 'PFF7040', 'GBTXVGL0043', 'PHVB-0051', 'UNIT/S', 'FLOOR PLATE BACK TO BACK LARGE', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(159, 11, 'A-JUAN', 'VOGELS', 'PFF7050', 'GBTXVGL0044', 'PHVB-0052', 'UNIT/S', 'FLOOR PLATE BACK TO BACK EXTRA LARGE', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(160, 11, 'A-JUAN', 'VOGELS', 'PFF7060', 'GBTXVGL0045', 'PHVB-0053', 'UNIT/S', 'FLOOR MOUNTING PLATE - BLACK', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(161, 11, 'A-JUAN', 'VOGELS', 'PFF7060', 'GBTXVGL0093', 'PHVB-0101', 'PC/S', 'FLOOR MOUNTING PLATE', 20, 'Low Stock', NULL, NULL),
(162, 11, 'A-JUAN', 'VOGELS', 'PFF7920', 'GBTXVGL0012', 'PHVB-0015', 'UNIT/S', 'CONNECT-IT VIDEO WALL FLOOR STAND BASE', 8, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(163, 11, 'A-JUAN', 'VOGELS', 'PFF7965', 'GBTXVGL0016', 'PHVB-0019', 'UNIT/S', 'FLOOR MOUNTING PLATE ADJUSTABLE', 40, 'Available', NULL, '2023-04-26 00:19:46'),
(164, 11, 'A-JUAN', 'VOGELS', 'PFF7965', 'GBTXVGL0122', 'PHVB-0130', 'PC/S', 'FLOOR CEILING MOUNT PALTE', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(165, 11, 'A-JUAN', 'VOGELS', 'PFS 3504', 'GBTXVGL0132', 'PHVB-0140', 'PC/S', 'DISPLAY STRIPS', 66, 'Available', NULL, '2023-04-26 00:19:46'),
(166, 11, 'A-JUAN', 'VOGELS', 'PFS3304', 'GBTXVGL0027', 'PHVB-0035', 'UNIT/S', 'INTERFACE DISPLAY STRIPS 450MM', 74, 'Available', NULL, '2023-04-26 00:19:46'),
(167, 11, 'A-JUAN', 'VOGELS', 'PFS3304', 'GBTXVGL0100', 'PHVB-0108', 'PC/S', 'DISPLAY STRIPS 450MM', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(168, 11, 'A-JUAN', 'VOGELS', 'PFS3306', 'GBTXVGL0028', 'PHVB-0036', 'UNIT/S', 'INTERFACE DISPLAY STRIPS 630MM', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(169, 11, 'A-JUAN', 'VOGELS', 'PFS3306', 'GBTXVGL0101', 'PHVB-0109', 'PC/S', 'DISPLAY STRIPS 630MM', 20, 'Low Stock', NULL, NULL),
(170, 11, 'A-JUAN', 'VOGELS', 'PFS3504', 'GBTXVGL0029', 'PHVB-0037', 'UNIT/S', 'INTERFACE 3-D ADJUSTABLE DISPLAY STRIP', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(171, 11, 'A-JUAN', 'VOGELS', 'PFS3504', 'GBTXVGL0102', 'PHVB-0110', 'PC/S', 'DISPLAY STRIPS 400', 75, 'Available', NULL, '2023-04-26 00:19:46'),
(172, 11, 'A-JUAN', 'VOGELS', 'PFS3508', 'GBTXVGL0030', 'PHVB-0038', 'UNIT/S', 'INTERFACE 3-D ADJUSTABLE DISPLAY STRIP', 8, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(173, 11, 'A-JUAN', 'VOGELS', 'PFT2515', 'GBTXVGL0112', 'PHVB-0120', 'PC/S', 'DISPLAY TROLLEY 59-64', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(174, 11, 'A-JUAN', 'VOGELS', 'PFT2520', 'GBTXVGL0113', 'PHVB-0121', 'PC/S', 'DISPLAY TROLLEY 113-117', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(175, 11, 'A-JUAN', 'VOGELS', 'PFT8520', 'GBTXVGL0006', 'PHVB-0009', 'UNIT/S', 'TROLLEY FRAME LARGE BLACK', 14, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(176, 11, 'A-JUAN', 'VOGELS', 'PFT8530', 'GBTXVGL0007', 'PHVB-0010', 'UNIT/S', 'TROLLEY FRAME EXTRA LARGE BLACK', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(177, 11, 'A-JUAN', 'VOGELS', 'PFT8920', 'GBTXVGL0011', 'PHVB-0014', 'UNIT/S', 'CONNECT-IT VIDEO WALL TROLLEY BASE', 8, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(178, 11, 'A-JUAN', 'VOGELS', 'PFTE7112', 'GBTXVGL0083', 'PHVB-0091', 'UNIT/S', 'MOTORIZED DISPLAY TROLLEY', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(179, 11, 'A-JUAN', 'VOGELS', 'PFW 4700', 'GBTXVGL0126', 'PHVB-0134', 'PC/S', 'DISPLAY WALL MOUNT FIXED', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(180, 11, 'A-JUAN', 'VOGELS', 'PFW 6400', 'GBTXVGL0127', 'PHVB-0135', 'PC/S', 'DISPLAY WALL MOUNT FIXED', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(181, 11, 'A-JUAN', 'VOGELS', 'PFW4200', 'GBTXVGL0081', 'PHVB-0089', 'UNIT/S', 'WALL MOUNT', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(182, 11, 'A-JUAN', 'VOGELS', 'PFW4200', 'GBTXVGL0105', 'PHVB-0113', 'PC/S', 'WALL MOUNT', 20, 'Low Stock', NULL, NULL),
(183, 11, 'A-JUAN', 'VOGELS', 'PFW4510', 'GBTXVGL0034', 'PHVB-0042', 'UNIT/S', 'DISPLAY WALL MOUNTING TILT', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(184, 11, 'A-JUAN', 'VOGELS', 'PFW4710', 'GBTXVGL0035', 'PHVB-0043', 'UNIT/S', 'DISPLAY WALL MOUNTING TILT', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(185, 11, 'A-JUAN', 'VOGELS', 'PFW6706', 'GBTXVGL0115', 'PHVB-0123', 'PC/S', 'POP-OUT MODULE', 30, 'Available', NULL, '2023-04-26 00:19:46'),
(186, 11, 'A-JUAN', 'VOGELS', 'PFW6800', 'GBTXVGL0128', 'PHVB-0136', 'PC/S', 'DISPLAY WALL MOUNT FIXED', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(187, 11, 'A-JUAN', 'VOGELS', 'PFW6850', 'GBTXVGL0107', 'PHVB-0115', 'PC/S', 'WALL MOUNT ULTRA FLAT TU', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(188, 11, 'A-JUAN', 'VOGELS', 'PFW6851', 'GBTXVGL0108', 'PHVB-0116', 'PC/S', 'WALL MOUNT TURN & TILT 8', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(189, 11, 'A-JUAN', 'VOGELS', 'PFW6852', 'GBTXVGL0067', 'PHVB-0075', 'UNIT/S', 'DISPLAY WALL MOUNT TURN AND TILT 1', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(190, 11, 'A-JUAN', 'VOGELS', 'PFW6852', 'GBTXVGL0129', 'PHVB-0137', 'PC/S', 'WALL MOUNT TURN & TILT', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(191, 11, 'A-JUAN', 'VOGELS', 'PFW6855A', 'GBTXVGL0068', 'PHVB-0076', 'UNIT/S', 'DISPLAY WALL MOUNT, WALL MO', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(192, 11, 'A-JUAN', 'VOGELS', 'PFW6855A', 'GBTXVGL0109', 'PHVB-0117', 'PC/S', 'WALL MOUNT WALL MO', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(193, 11, 'A-JUAN', 'VOGELS', 'PFW6855B', 'GBTXVGL0069', 'PHVB-0077', 'UNIT/S', 'DISPLAY WALL MOUNT, WALL ARM ASS', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(194, 11, 'A-JUAN', 'VOGELS', 'PFW6855B', 'GBTXVGL0110', 'PHVB-0118', 'PC/S', 'WALL MOUNT ARM ASS', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(195, 11, 'A-JUAN', 'VOGELS', 'PFW6858', 'GBTXVGL0070', 'PHVB-0078', 'UNIT/S', 'DISPLAY WALL MOUNT ROTATE 90', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(196, 11, 'A-JUAN', 'VOGELS', 'PFW6858', 'GBTXVGL0111', 'PHVB-0119', 'PC/S', 'WALL MOUNT ROTATE 90#', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(197, 11, 'A-JUAN', 'VOGELS', 'PFW6870', 'GBTXVGL0002', 'PHVB-0002', 'UNIT/S', 'WALL RETRACTABLE WALL MOUNT BRACKET', 96, 'Available', NULL, '2023-04-26 00:19:46'),
(198, 11, 'A-JUAN', 'VOGELS', 'PFW6880', 'GBTXVGL0001', 'PHVB-0001', 'UNIT/S', 'RETRACTABLE WALL MOUNT BRACKET - POP OUT SLIM', 62, 'Available', NULL, '2023-04-26 00:19:46'),
(199, 11, 'A-JUAN', 'VOGELS', 'PFW6900', 'GBTXVGL0106', 'PHVB-0114', 'PC/S', 'FLAT MOUNT', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(200, 11, 'A-JUAN', 'VOGELS', 'PLM8030', 'GBTXVGL0021', 'PHVB-0024', 'UNIT/S', 'PROFILE 3000MM', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(201, 11, 'A-JUAN', 'VOGELS', 'PTA3101', 'GBTXVGL0075', 'PHVB-0083', 'UNIT/S', 'TABLOCK FLOOR STAND', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(202, 11, 'A-JUAN', 'VOGELS', 'PTS2010', 'GBTXVGL0076', 'PHVB-0084', 'UNIT/S', 'UNIVERSAL TABLOCK', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(203, 11, 'A-JUAN', 'VOGELS', 'PUA9503', 'GBTXVGL0033', 'PHVB-0041', 'UNIT/S', 'CONNECT-IT LARGE POLE COUPLER', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(204, 11, 'A-JUAN', 'VOGELS', 'PUA9507', 'GBTXVGL0072', 'PHVB-0080', 'UNIT/S', 'ACC TRAY PUC25XX/PUC27XX BLACK', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(205, 11, 'A-JUAN', 'VOGELS', 'PUC 2530', 'GBTXVGL0124', 'PHVB-0132', 'PC/S', 'POLE L CONNECT-IT 300CM', 20, 'Low Stock', NULL, NULL),
(206, 11, 'A-JUAN', 'VOGELS', 'PUC 2933', 'GBTXVGL0131', 'PHVB-0139', 'PC/S', 'POLE 330CM', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(207, 11, 'A-JUAN', 'VOGELS', 'PUC1060', 'GBTXVGL0037', 'PHVB-0045', 'UNIT/S', 'CEILING PLATE LARGE FIXED', 11, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(208, 11, 'A-JUAN', 'VOGELS', 'PUC1060', 'GBTXVGL0088', 'PHVB-0096', 'PC/S', 'CEILINGPLATE LARGE FIXED', 20, 'Low Stock', NULL, NULL),
(209, 11, 'A-JUAN', 'VOGELS', 'PUC1065', 'GBTXVGL0089', 'PHVB-0097', 'PC/S', 'CONNECT-IT CEILING PLATE', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(210, 11, 'A-JUAN', 'VOGELS', 'PUC1090', 'GBTXVGL0090', 'PHVB-0098', 'PC/S', 'TRUSS ADAPTER LARGE', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(211, 11, 'A-JUAN', 'VOGELS', 'PUC2508', 'GBTXVGL0003', 'PHVB-0004', 'UNIT/S', 'CONNECTING-IT LARGE POLE 80CM SILVER /BLACK', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(212, 11, 'A-JUAN', 'VOGELS', 'PUC2508', 'GBTXVGL0091', 'PHVB-0099', 'PC/S', 'POLE L CONNECT-IT 80CM', 20, 'Low Stock', NULL, NULL),
(213, 11, 'A-JUAN', 'VOGELS', 'PUC2515', 'GBTXVGL0039', 'PHVB-0047', 'UNIT/S', 'POLE LARGE CONNECT-IT 150cm -black', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(214, 11, 'A-JUAN', 'VOGELS', 'PUC2515', 'GBTXVGL0092', 'PHVB-0100', 'PC/S', 'POLE L CONNECT-IT 150CM', 30, 'Available', NULL, '2023-04-26 00:19:46'),
(215, 11, 'A-JUAN', 'VOGELS', 'PUC2530', 'GBTXVGL0040', 'PHVB-0048', 'UNIT/S', 'POLE LARGE CONNECT-IT 300cm -black', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(216, 11, 'A-JUAN', 'VOGELS', 'PUC2715', 'GBTXVGL0008', 'PHVB-0011', 'UNIT/S', 'CONNECT-IT XL POLE 150CM BLACK', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(217, 11, 'A-JUAN', 'VOGELS', 'PUC2718', 'GBTXVGL0009', 'PHVB-0012', 'UNIT/S', 'CONNECT-IT XL POLE 180CM BLACK', 11, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(218, 11, 'A-JUAN', 'VOGELS', 'PUC2718', 'GBTXVGL0094', 'PHVB-0102', 'PC/S', 'POLE CONNECT IT XL 180CM', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(219, 11, 'A-JUAN', 'VOGELS', 'PUC2720', 'GBTXVGL0010', 'PHVB-0013', 'UNIT/S', 'CONNECT-IT XL POLE 200CM BLACK', 21, 'Available', NULL, NULL),
(220, 11, 'A-JUAN', 'VOGELS', 'PUC2720', 'GBTXVGL0095', 'PHVB-0103', 'PC/S', 'POLE CONNECT IT XL 200CM', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(221, 11, 'A-JUAN', 'VOGELS', 'PUC2920', 'GBTXVGL0013', 'PHVB-0016', 'UNIT/S', 'POLE 200CM', 18, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(222, 11, 'A-JUAN', 'VOGELS', 'PUC2927', 'GBTXVGL0014', 'PHVB-0017', 'UNIT/S', 'POLE 270CM', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(223, 11, 'A-JUAN', 'VOGELS', 'PUC2927', 'GBTXVGL0116', 'PHVB-0124', 'PC/S', 'POLE 270CM', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(224, 11, 'A-JUAN', 'VOGELS', 'PUC2933', 'GBTXVGL0015', 'PHVB-0018', 'UNIT/S', 'POLE 330CM', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(225, 11, 'A-JUAN', 'VOGELS', 'PVA5050', 'GBTXVGL0061', 'PHVB-0069', 'UNIT/S', 'CAMERA AND SPEAKER HOLDER', 13, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(226, 11, 'A-JUAN', 'VOGELS', 'PX70531', 'GBTXVGL0087', 'PHVB-0095', 'UNIT/S', 'PRO - AV CATALOGUE 2020/2021 EN', 150, 'Available', NULL, '2023-04-26 00:19:46'),
(227, 11, 'A-JUAN', 'VOGELS', 'RISE 5308', 'GBTXVGL0130', 'PHVB-0138', 'PC/S', 'MOTORIZED TROLLEY 80EU', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(228, 11, 'A-JUAN', 'VOGELS', 'RISE5305 EU', 'GBTXVGL0114', 'PHVB-0122', 'PC/S', 'MOTORIZED TROLLEY 50EU', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(229, 11, 'A-JUAN', 'VOGELS', 'THIN550', 'GBTXVGL0071', 'PHVB-0079', 'UNIT/S', 'BLACK TURN 120 WALL MOUNT 40-100', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(230, 11, 'A-JUAN', 'VOGELS', 'TIP & TOUCH', 'GBTXVGL0133', 'PHVB-0141', 'PC/S', 'TIP & TOUCH STAND MAX 75 INCH,', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(231, 11, 'A-JUAN', 'VOGELS', 'TVM1425', 'GBTXVGL0119', 'PHVB-0127', 'PC/S', 'FULL MOTION MOUNT MEDIUM', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(232, 11, 'A-JUAN', 'VOGELS', 'TVM1445', 'GBTXVGL0121', 'PHVB-0129', 'PC/S', 'FULL MOTION + MOUNT MEDIUM', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(233, 11, 'A-JUAN', 'VOGELS', 'TVM1625', 'GBTXVGL0120', 'PHVB-0128', 'PC/S', 'FULL MOTION MOUNT LARGE', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(234, 11, 'A-JUAN', 'VOGELS', 'TVM5855', 'GBTXVGL0123', 'PHVB-0131', 'PC/S', 'FORWARD MOTION CONTROL XL', 8, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(235, 12, 'A-JUAN', 'KIOSK', 'QAK4200', 'GBTXKIOSK009', 'WA42-QAK', 'UNIT/S', '42\" NDS KIOSK W/ ANDROID PLAYER', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(236, 12, 'A-JUAN', 'KIOSK', 'WA-E1912LM', 'GBTXKIOSK006', 'WA19-LM', 'UNIT/S', '19\" WINALL LITERATURE KIOSK', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(237, 12, 'A-JUAN', 'KIOSK', 'WA-E4212LHT', 'GBTXKIOSK007', 'WA42-LHT', 'UNIT/S', '42\" WINALL KIOSK - TOUCH SCREEN W/ CAMERA', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(238, 12, 'A-JUAN', 'KIOSK', 'WA-E7018BHT', 'GBTXKIOSK005', 'WA70-EWB', 'UNIT/S', '70\" ELECTRONIC WHITE BOARD', 0, 'Out of Stock', NULL, '2023-04-26 00:19:46'),
(239, 2, 'MARIKINA', 'DAKTRONICS', 'APCUS', 'GLED0061', 'APCUS-001', 'UNIT/S', 'P32 APCUS LED', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(240, 2, 'MARIKINA', 'DAKTRONICS', 'DACKTICKER', 'GLED0048', 'DACKTICKER-001', 'UNIT/S', 'DACKTICKER (KE-1010-16240-21-RG-S)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(241, 2, 'MARIKINA', 'DAKTRONICS', 'DACKTICKER', 'GLED0049', 'DACKTICKER-002', 'UNIT/S', 'DACKTICKER (KE-1010-16240-21-RG-S)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(242, 2, 'MARIKINA', 'DAKTRONICS', 'DACKTICKER', 'GLED0050', 'DACKTICKER-003', 'UNIT/S', 'DACKTICKER (KE-1010-16240-21-RG-S)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(243, 2, 'MARIKINA', 'DAKTRONICS', 'DACKTICKER', 'GLED0051', 'DACKTICKER-004', 'UNIT/S', 'DACKTICKER (KE-1010-16240-RG-21)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(244, 2, 'MARIKINA', 'DAKTRONICS', 'DACKTICKER', 'GLED0052', 'DACKTICKER-005', 'UNIT/S', 'DACKTICKER (KE-1010-16240-21-RG-S)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(245, 2, 'MARIKINA', 'DAKTRONICS', 'DACKTICKER', 'GLED0053', 'DACKTICKER-006', 'UNIT/S', 'DACKTICKER (KE-1010-16400-21-RG-M)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(246, 2, 'MARIKINA', 'DAKTRONICS', 'DACKTICKER', 'GLED0054', 'DACKTICKER-007', 'UNIT/S', 'DACKTICKER (KE-1010-16X160-2.1-RG)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(247, 2, 'MARIKINA', 'DAKTRONICS', 'DACKTICKER', 'GLED0055', 'DACKTICKER-008', 'UNIT/S', 'DACKTICKER (KE-1010-16X320-RG-2.1)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(248, 2, 'MARIKINA', 'DAKTRONICS', 'DAKTRONICS', 'GLED0057', 'LEDTRONIC-001', 'UNIT/S', 'DAKTRONICS LED (360mm x 868mm)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(249, 2, 'MARIKINA', 'DAKTRONICS', 'DAKTRONICS', 'GLED0058', 'DAKTRONICS-001', 'UNIT/S', 'DAKTRONICS LED ( S-200-12-12) W/ BLACK BOX', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(250, 2, 'MARIKINA', 'DAKTRONICS', 'DAKTRONICS', 'GLED0059', 'DAKTRONICS-002', 'UNIT/S', 'DAKTRONICS LED (585mm x 585mm)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(251, 2, 'MARIKINA', 'DAKTRONICS', 'DAKTRONICS', 'GLED0060', 'DAKTRONICS-003', 'UNIT/S', 'DAKTRONICS LED (585mm x 585mm) - DEFECTIVE', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(252, 2, 'MARIKINA', 'DAKTRONICS', 'DAKTRONICS', 'GLED0069', 'DAKTRONICS-004', 'UNIT/S', 'DAKTRONICS (AF3010-8X96-9-R)', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(253, 2, 'MARIKINA', 'DAKTRONICS', 'DAKTRONICS', 'GLED0071', 'DAKTRONICS-007', 'UNIT/S', 'DAKTRONICS GALAXY LED', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(254, 2, 'MARIKINA', 'DAKTRONICS', 'DAKTRONICS', 'GLED0072', 'DAKTRONICS-008', 'UNIT/S', 'DAKTRONICS LED (AF3010 8X96-9-12)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(255, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0039', 'GALAXY-001', 'UNIT/S', 'GALAXY (AE-3010-48X128-21-RG)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(256, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0040', 'GALAXY-002', 'UNIT/S', 'GALAXY (AE-3010-48X160-21-RG)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(257, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0041', 'GALAXY-003', 'UNIT/S', 'GALAXY (AE-3010-4896-2.1RG)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(258, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0042', 'GALAXY-004', 'UNIT/S', 'GALAXY (AE-3010-48X128-RG-2.1)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(259, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0043', 'GALAXY-005', 'UNIT/S', 'GALAXY (AF3120-16X192-7.62-R)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(260, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0044', 'GALAXY-006', 'UNIT/S', 'GALAXY (AF3120-16X192-7.62-R)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(261, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0045', 'GALAXY-007', 'UNIT/S', 'GALAXY (AF3120-16X192-7.62-R)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(262, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0046', 'GALAXY-008', 'UNIT/S', 'GALAXY (AF3120-16X192-7.62-R)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(263, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0047', 'GALAXY-009', 'UNIT/S', 'GALAXY (X-1000-48X144-7.62R)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(264, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0062', 'GALAXY-010', 'UNIT/S', 'GALAXY LED (CE-1010-1230-21CC)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(265, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0064', 'DAKTRONICS-005', 'UNIT/S', 'DAKTRONICS LED - (AF3400-48X128X20RGB)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(266, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0065', 'GALAXY-011', 'UNIT/S', 'GALAXY (AF3155-64X96X20RGB ) - BDO', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(267, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0067', 'GALAXY-012', 'UNIT/S', 'GALAXY (AF-3060-8X144-9-X)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(268, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0068', 'GALAXY-013', 'UNIT/S', 'GALAXY (AF-3010-8X96-9-R)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(269, 2, 'MARIKINA', 'DAKTRONICS', 'GALAXY', 'GLED0070', 'GALAXY-014', 'UNIT/S', 'GALAXY (PS-5110-208X304-23) SM MOA', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(270, 2, 'MARIKINA', 'DAKTRONICS', 'LEDTRONIC', 'GLED0056', 'LEDTRONIC-001', 'UNIT/S', 'LEDTRONIC (C200-96X128-2.1)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(271, 2, 'MARIKINA', 'DAKTRONICS', 'LEDTRONIC', 'GLED0063', 'LEDTRONIC-002', 'UNIT/S', 'LEDTRONIC (10mm -96x128) - INDOOR', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(272, 2, 'MARIKINA', 'DAKTRONICS', 'YAHAM', 'GLED0066', 'YAHAM-001', 'UNIT/S', 'YAHAM LED (YHT33.33-4R2G1B-15)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(273, 3, 'MARIKINA', 'APCUS', 'P6', 'GLED0023', 'P6-APCUS', 'UNIT/S', 'APCUS P6 LED DISPLAY (128mm x 96mm)', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(274, 3, 'MARIKINA', 'LIGHT HOUSE', 'LIGHT HOUSE', 'GLED0036', 'LIGHT HOUSE', 'UNIT/S', 'LIGHT HOUSE LED IN BLACK BOX', 36, 'Available', NULL, '2023-04-26 00:19:46'),
(275, 3, 'MARIKINA', 'LIGHT KING', 'P10', 'GLED0034', 'P10-ESCAPE', 'UNIT/S', 'P10/E10 LED (960mm x 960mm x 138.5mm) (ESCAPE)', 49, 'Available', NULL, '2023-04-26 00:19:46'),
(276, 3, 'MARIKINA', 'LINSO', 'P10', 'GLED0031', 'P10-LED MOBILE', 'UNIT/S', 'P10 LED (960mm x 960mm) (LED MOBILE)', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(277, 3, 'MARIKINA', 'LINSO', 'P10', 'GLED0033', 'P10-GI2', 'UNIT/S', 'P10 LED (800mm x 800mm)', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(278, 3, 'MARIKINA', 'LINSO', 'P12', 'GLED0019', 'P16-DEFECT', 'UNIT/S', 'P12 LED (960mm x 960mm) - defective', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(279, 3, 'MARIKINA', 'LINSO', 'P12', 'GLED0020', 'P1-GI1', 'UNIT/S', 'P12 LED (768mm x 768mm)', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(280, 3, 'MARIKINA', 'LINSO', 'P12', 'GLED0029', 'P12-LED MOBILE', 'UNIT/S', 'P12 LED (960mm x 960mm) (LED MOBILE)', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(281, 3, 'MARIKINA', 'LINSO', 'P12', 'GLED0030', 'P12-ST. JUDE', 'UNIT/S', 'P12 LED (768mm x 1,152mm) (ST. JUDE)', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(282, 3, 'MARIKINA', 'LINSO', 'P12', 'GLED0032', '12-KALAYAAN', 'UNIT/S', 'P12 LED (960mm x 960mm) (KALAYAAN)', 22, 'Available', NULL, '2023-04-26 00:19:46'),
(283, 3, 'MARIKINA', 'LINSO', 'P16', 'GLED0018', 'P16-EASTWOOD', 'UNIT/S', 'P16 LED (1,024mm x 768mm) (EASTWOOD)', 143, 'Available', NULL, '2023-04-26 00:19:46'),
(284, 3, 'MARIKINA', 'LINSO', 'P16', 'GLED0025', 'P16-GI3', 'UNIT/S', 'P16 LED (1,024mm x 768mm)', 84, 'Available', NULL, '2023-04-26 00:19:46'),
(285, 3, 'MARIKINA', 'LINSO', 'P16', 'GLED0026', 'P16-CALTEX', 'UNIT/S', 'P16 LED DISPLAY - ABSEN (1,024mm x 1,024mm) (CALTEX MALIBAY)', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(286, 3, 'MARIKINA', 'LINSO', 'P16', 'GLED0027', 'P16-EBC', 'UNIT/S', 'P16 LED (1,280mm x 1,024mm) (EBC)', 30, 'Available', NULL, '2023-04-26 00:19:46'),
(287, 3, 'MARIKINA', 'LINSO', 'P16', 'GLED0028', 'P16-NAGA', 'UNIT/S', 'P16 LED (1,024mm x 768mm) (NAGA)', 36, 'Available', NULL, '2023-04-26 00:19:46'),
(288, 3, 'MARIKINA', 'LINSO', 'P16', 'GLED0038', 'P16-BACOOR', 'UNIT/S', 'P16 LED (500mm x 1000mm) (BACOOR MCDO)', 54, 'Available', NULL, '2023-04-26 00:19:46'),
(289, 3, 'MARIKINA', 'LINSO', 'P20', 'GLED0016', 'P20-GI1', 'UNIT/S', 'P20 LED DISPLAY (1,280mm x 960mm)', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(290, 3, 'MARIKINA', 'LINSO', 'P6', 'GLED0021', 'P6-SINGAPORE', 'UNIT/S', 'P6 LED (576 mm x 576mm) - SINGAPORE', 38, 'Available', NULL, '2023-04-26 00:19:46'),
(291, 3, 'MARIKINA', 'LINSO', 'P6', 'GLED0022', 'P6-SNAP ON', 'UNIT/S', 'P6 LED (576mm x 768mm) - SNAP ON', 41, 'Available', NULL, '2023-04-26 00:19:46'),
(292, 3, 'MARIKINA', 'SHANGHAI', 'LED PEDESTRIAN', 'GLED0037', 'PEDESTRIAN', 'UNIT/S', 'LED PEDESTRIAN TRAFFIC LIGHT (3400mmx570mmx410mm)', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(293, 3, 'MARIKINA', 'SHANGHAI', 'P16', 'GLED0024', 'P16-ORTIGAS', 'UNIT/S', 'P16 LED (1,024mm x 768mm) (0LD -ORTIGAS)', 68, 'Available', NULL, '2023-04-26 00:19:46'),
(294, 3, 'MARIKINA', 'TRT', 'P16', 'GLED0017', 'P16-PARKNFLY', 'UNIT/S', 'P16 LED LED CURTAIN (PARK & FLY)', 298, 'Available', NULL, '2023-04-26 00:19:46'),
(295, 3, 'MARIKINA', 'YAHAM', 'P4', 'GLED0035', 'P4-GI3', 'UNIT/S', 'P4 LED (384mm x 384mm)', 28, 'Available', NULL, '2023-04-26 00:19:46'),
(296, 1, 'ORTIGAS', 'AVER', 'CAM130', 'GBTXCAM007', 'CAM0007', 'PC/S', 'CONFERENCE CAMERA', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(297, 1, 'ORTIGAS', 'AVER', 'CAM130', 'GBTXCAM010', 'CAM0010', 'PC/S', 'CONTENT CAMERA BUNDLE KIT', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(298, 1, 'ORTIGAS', 'AVER', 'CAM340+', 'GBTXCAM008', 'CAM0008', 'PC/S', 'CONFERENCE CAMERA', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(299, 1, 'ORTIGAS', 'AVER', 'CAM520 PRO2', 'GBTXCAM001', 'CAM0001', 'PC/S', 'CONFERENCE CAMERA', 12, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(300, 1, 'ORTIGAS', 'AVER', 'CAM550', 'GBTXCAM012', 'CAM0012', 'PC/S', 'CONFERENCE CAMERA', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(301, 1, 'ORTIGAS', 'AVER', 'CAM570', 'GBTXCAM005', 'CAM0005', 'PC/S', 'CONFERENCE CAMERA', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(302, 1, 'ORTIGAS', 'AVER', 'FONE540', 'GBTXCAM004', 'CAM0004', 'PC/S', 'CONFERENCE SPEAKERPHONE', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(303, 1, 'ORTIGAS', 'AVER', 'VB130', 'GBTXCAM006', 'CAM0006', 'PC/S', 'CONFERENCE CAMERA', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(304, 1, 'ORTIGAS', 'AVER', 'VB342 PRO', 'GBTXCAM009', 'CAM0009', 'PC/S', 'CONFERENCE CAMERA', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(305, 1, 'ORTIGAS', 'AVER', 'VC520 PRO2', 'GBTXCAM011', 'CAM0011', 'PC/S', 'CONFERENCE CAMERA COMPUTER PERIPHERALS', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(306, 1, 'ORTIGAS', 'AVER', 'VC540', 'GBTXCAM002', 'CAM0002', 'PC/S', 'CONFERENCE CAMERA COMPUTER PERIPHERALS', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(307, 1, 'ORTIGAS', 'AVER', 'VC550', 'GBTXCAM003', 'CAM0003', 'PC/S', 'CONFERENCE CAMERA COMPUTER PERIPHERALS', 4, 'Low Stock', NULL, '2023-04-26 00:19:46');
INSERT INTO `products` (`id`, `category_id`, `location`, `brand`, `model`, `sku`, `productcode`, `uom`, `description`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(308, 3, 'ORTIGAS', 'ABSEN', 'P16', 'GLED0003 (ORG)', 'P16-ABSEN', 'UNIT/S', 'P16 LED DISPLAY (1,024mm x 1,024mm) - ABSEN', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(309, 3, 'ORTIGAS', 'FABULUX', 'INPAD PLUS P2.9', '2207048PO (ORG)', 'INPAD PLUS P2.9-108', 'PANEL/S', 'INPAD PLUS / P2.9 LED (500mm x 1000mm)', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(310, 3, 'ORTIGAS', 'FABULUX', 'P1.58', 'TDS1803068', 'P1.5-GI1', 'UNIT/S', 'P1.58 LED (608mm x 342mm)', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(311, 3, 'ORTIGAS', 'FABULUX', 'P1.8', 'GLED0039 (ORG)', 'P1.8-GI01', 'UNIT/S', 'P1.8 LED DISPLAY (320mm x18mm) - (TVF018)', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(312, 3, 'ORTIGAS', 'FABULUX', 'P1.923', 'SU4319A', 'P1.9-GI1', 'UNIT/S', 'P1.923 LED DISPLAY (608mm x 342mm)', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(313, 3, 'ORTIGAS', 'FABULUX', 'P2.5/KSLIM', 'APS201588 (ORG)', 'P2.5-GI01', 'UNIT/S', 'P2.5/KSLIM (500mm x 100mm)', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(314, 3, 'ORTIGAS', 'FABULUX', 'P2.8 /RDY2.8', 'YF20191225-03-D', 'P2.8-GI01', 'UNIT/S', 'P2.8 /RDY2.8 LED (500mm x 500mm x 76.3mm)', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(315, 3, 'ORTIGAS', 'FABULUX', 'P3', 'GLED0042 (ORG)', 'P3-GI01', 'UNIT/S', 'P3 LED DISPLAY (120mm x 120mm) - (VEC4)', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(316, 3, 'ORTIGAS', 'FABULUX', 'P3.9', '2103010PO (ORG)', 'PTS P3.91', 'UNIT/S', 'INPAD PLUS P3.9 LED DISPLAY (500mm x 1000mm)', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(317, 3, 'ORTIGAS', 'FABULUX', 'P3.9', 'SM-AURA', 'P3.9-G14', 'UNIT/S', 'P3.9 LED DISPLAY (500mm x 500mmx63mm)', 22, 'Available', NULL, '2023-04-26 00:19:46'),
(318, 3, 'ORTIGAS', 'FABULUX', 'PTS2.9', '2111014PO (ORG)', 'PTS2.9-95', 'PANEL/S', 'PTS 2.9 LED (500mm x 500mm) - INDOOR / OUTDOOR', 29, 'Available', NULL, '2023-04-26 00:19:46'),
(319, 3, 'ORTIGAS', 'LEDTOP', 'DRAGON-P3.9', 'LTVGT220901-D (ORG)', 'DRAGON-P3.9-111', 'PANEL/S', 'DRAGON-P3.9 (500mmx500mmx83mm)', 18, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(320, 3, 'ORTIGAS', 'LEYARD', 'P10', 'CV10S', 'P10-G34', 'PANEL/S', 'P10 LED DISPLAY (1040x970x1080mm) - DEMO UNIT', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(321, 3, 'ORTIGAS', 'LEYARD', 'P6', 'CV6S', 'P6-GI01', 'UNIT/S', 'P6 LED DISPLAY (900x280x1030x1) -DEMO UNIT', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(322, 3, 'ORTIGAS', 'LIGHT KING', 'K2-11', 'LTKG20190508-D1', 'K2-11-GI1', 'UNIT/S', 'K2-II INDOOR LED DISPLAY (750 x 1750mm)', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(323, 3, 'ORTIGAS', 'LIGHT KING', 'P10/E10', '1705032-D', 'P10-ASEANA', 'UNIT/S', 'P10/E10 LED (960mm x 960mm x 138.5) - ASEANA', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(324, 3, 'ORTIGAS', 'LIGHT KING', 'P12', 'GLED0022 (ORG)', 'P12-OO1', 'UNIT/S', 'P12 LED (768mm x 768mm)', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(325, 3, 'ORTIGAS', 'LIGHT KING', 'P12.3', 'GLED0023 (ORG)', 'P12-OO2', 'UNIT/S', 'P12.3 LED (960mm x 960mm)', 3, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(326, 3, 'ORTIGAS', 'LIGHT KING', 'P13', 'GLED0021 (ORG)', 'P13-CRYSTAL', 'UNIT/S', 'P13 INDOOR CRYSTAL LED DISPLAY', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(327, 3, 'ORTIGAS', 'LIGHT KING', 'P15/15', 'LKGT20200224 (ORG)', 'P15/15-G25', 'UNIT/S', 'P15/15 OUTDOOR LED DISPLAY (500MM x 1000MM)', 8, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(328, 3, 'ORTIGAS', 'LIGHT KING', 'P16', 'GLED0038 (ORG)', 'P16-BUTUAN', 'UNIT/S', 'P16 LED DISPLAY (960mm x 960mm) - BUTUAN', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(329, 3, 'ORTIGAS', 'LIGHT KING', 'P2.8', 'LKVGT211112-D (ORG)', 'RDY2.8-98', 'PANEL/S', 'P2.8 / RDY2.8 (500mm x 500mm x 83mm) INDOOR', 8, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(330, 3, 'ORTIGAS', 'LIGHT KING', 'P2.8/RCF2.8', 'LKGT20190804-D (ORG)', 'P2.8/RCF2.8-GI19', 'UNIT/S', 'P2.8/RCF2.8 LED (500mm x 500mmx63mm)', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(331, 3, 'ORTIGAS', 'LIGHT KING', 'P2.9/SGR-2.9', '1612039-D1-2 (ORG)', 'P2.9/SGR-2.9-GI9', 'UNIT/S', 'P2.9/ SGR-2.9II (600mm x 400mm x 80.5mm)', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(332, 3, 'ORTIGAS', 'LIGHT KING', 'P2.9/MR2.9', 'LKGT1612039-D1-2 (ORG)', 'P2.9/MR2.9-G12', 'UNIT/S', 'P2.9/MR2.9 LED (600MMX400MMX80.5MM)', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(333, 3, 'ORTIGAS', 'LIGHT KING', 'P3.9', 'GLED0032 (ORG)', 'P3.9-GRANDHYATT', 'UNIT/S', 'P3.9 LED (500mm x 500mm) - GRAND HYATT', 22, 'Available', NULL, '2023-04-26 00:19:46'),
(334, 3, 'ORTIGAS', 'LIGHT KING', 'P3.9', 'GLED0034-II', 'P3-GABC', 'UNIT/S', 'P3 LED (480mm x 480mm) - GABC/PENSHOPPE/SIGHT&SITES', 31, 'Available', NULL, '2023-04-26 00:19:46'),
(335, 3, 'ORTIGAS', 'LIGHT KING', 'P3.9', 'LKGT20200925-D (ORG)', 'P3.9/RW3-G27', 'PANEL/S', 'P3.9/RW3 LED DISPLAY (500mm x 500mm x 75mm) -INDOOR - 153W', 16, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(336, 3, 'ORTIGAS', 'LIGHT KING', 'P3.9', 'LTKG20191220-D (ORG)', 'P3.9/RW3-G26', 'PANEL/S', 'P3.9/RW3 LED DISPLAY (500mm x 500mm x 75mm) -INDOOR - 153W', 195, 'Available', NULL, '2023-04-26 00:19:46'),
(337, 3, 'ORTIGAS', 'LIGHT KING', 'P3.9/RW3', 'LKHK20190214-4-D', 'P3.9-G11', 'UNIT/S', 'P3.9/RW3 (500mm x 500mm) - 170watts', 28, 'Available', NULL, '2023-04-26 00:19:46'),
(338, 3, 'ORTIGAS', 'LIGHT KING', 'P4', 'GLED0030 (ORG)', 'P4-GI3', 'UNIT/S', 'P4 LED (512mm x 512mm)', 40, 'Available', NULL, '2023-04-26 00:19:46'),
(339, 3, 'ORTIGAS', 'LIGHT KING', 'P4', 'GLED0031 (ORG)', 'P4-GI4', 'UNIT/S', 'P4 LED (480mm x 480mm) w/ Black Box', 50, 'Available', NULL, '2023-04-26 00:19:46'),
(340, 3, 'ORTIGAS', 'LIGHT KING', 'P4.8', 'GLED0027 (ORG)', 'P4.8-GI1', 'UNIT/S', 'P4.8 LED (500mm x 500mm)', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(341, 3, 'ORTIGAS', 'LIGHT KING', 'P4.8', 'GLED0029 (ORG)', 'P4.8-GMA', 'UNIT/S', 'P4.8 LED (500mm x 500mm) - GMA', 32, 'Available', NULL, '2023-04-26 00:19:46'),
(342, 3, 'ORTIGAS', 'LIGHT KING', 'P4.8/RC4', '1702016-D1-3 (ORG)', 'P4.8/RC4-GI8', 'UNIT/S', 'P4.8/RC4 (500mm x 500mmx 63mm) in BLACK BOX', 15, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(343, 3, 'ORTIGAS', 'LIGHT KING', 'P5', '033-180613', 'P5-BACK2BACK', 'UNIT/S', 'P5 BACK BACK LED IN BLACK BOX', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(344, 3, 'ORTIGAS', 'LIGHT KING', 'P5.9/KB5', 'LKGT20190805-D (ORG)', 'P5.9/KB5-GI20', 'UNIT/S', 'P5.9 / KB5 LED (500mm x 500mmx22mm)', 8, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(345, 3, 'ORTIGAS', 'LIGHT KING', 'P6/EC6', '1803118-D', 'P6-CSB', 'UNIT/S', 'P6/EC6 LED (960mm x 960mm x 138.5mm) - CSB', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(346, 3, 'ORTIGAS', 'LIGHT KING', 'P7.81', 'GLED0024 (ORG)', 'P7.8-GLASS', 'UNIT/S', 'P7.81 LED GLASS PANEL', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(347, 3, 'ORTIGAS', 'LINSO', 'P16', 'GLED0020 (ORG)', 'P16-VENT', 'UNIT/S', 'P16 VENTILATING LED', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(348, 3, 'ORTIGAS', 'LINSO', 'P4', 'GLED0040 (ORG)', 'P4-LED FLOOR', 'UNIT/S', 'P4 LED FLOOR - OLD', 20, 'Low Stock', NULL, NULL),
(349, 3, 'ORTIGAS', 'SPIDER', 'P2.9', '2203013PO (ORG)', 'SPIDER2.9.100', 'PANEL/S', 'SPIDER2.9 / P2.9 LED (500mm x 500mm) INDOOR', 40, 'Available', NULL, '2023-04-26 00:19:46'),
(350, 3, 'ORTIGAS', 'TRT', 'IPOSTER', 'T0C1809350 (ORG)', 'P2.5-GI11', 'UNIT/S', 'P2.5 iPOSTER LED (560mm x 1,890mm) - DEMO & RENTAL', 22, 'Available', NULL, '2023-04-26 00:19:46'),
(351, 3, 'ORTIGAS', 'TRT', 'IPOSTER', 'T0C1904105 (ORG)', 'P2.5-GI10', 'UNIT/S', 'P2.5 iPOSTER LED (560mm x 1,890mm) - DEMO & RENTAL', 11, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(352, 3, 'ORTIGAS', 'TRT', 'IPOSTER', 'T0C1905155/3 (ORG)', 'P2.5-GI12', 'UNIT/S', 'P2.5 iPOSTER LED DISPLAY (560mm x 1,890mm)', 20, 'Low Stock', NULL, NULL),
(353, 3, 'ORTIGAS', 'TRT', 'P16', 'TOC1704132 (ORG)', 'P16-SKS', 'UNIT/S', 'P16 LED (500mm x 1,000mm) - SKS', 26, 'Available', NULL, '2023-04-26 00:19:46'),
(354, 3, 'ORTIGAS', 'TRT', 'P16/16', 'GLED0041 (ORG)', 'P16/16-GUISANO', 'UNIT/S', 'P16/16 LED (500mm x 1,000mm) - GAISANO DAVAO', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(355, 3, 'ORTIGAS', 'TRT', 'P16/16', 'TDC1803067 (ORG)', 'P16/16-MAGALLANES/CBC', 'UNIT/S', 'P16/16 LED (500mm x 1,000mm) - MAGALLANES', 4, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(356, 3, 'ORTIGAS', 'TRT', 'P8.33/16.67', 'TDM1710405 (ORG)', 'P8.33/16.67-Y-BLDNG', 'UNIT/S', 'P8.33/16.67 LED (500mm x1,000mm) - Y-BUILDING', 18, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(357, 4, 'ORTIGAS', 'NOVA STAR', 'A6000', 'NOVASTAR-005', 'LED ACC-GI05', 'UNIT/S', 'LED CONTROLLER', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(358, 4, 'ORTIGAS', 'NOVA STAR', 'MCRTL1600', 'NOVASTAR-004', 'LED ACC-GI04', 'UNIT/S', 'LED CONTROLLER', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(359, 4, 'ORTIGAS', 'NOVA STAR', 'MCTRL 300', 'NOVASTAR-002', 'LED ACC-GI02', 'UNIT/S', 'LED CONTROLLER', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(360, 4, 'ORTIGAS', 'NOVA STAR', 'MCTRL600', 'NOVASTAR-003', 'LED ACC-GI03', 'UNIT/S', 'LED CONTROLLER', 32, 'Available', NULL, '2023-04-26 00:19:46'),
(361, 4, 'ORTIGAS', 'NOVA STAR', 'X4', 'NOVASTAR-006', 'LED ACC-GI06', 'UNIT/S', 'LED CONTROLLER', 6, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(362, 5, 'ORTIGAS', 'NOVA STAR', 'EG2-G', 'NOVASTAR-020', 'LED ACC-GI28', 'PC/S', 'TAURUS MEDIA PLAYER', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(363, 5, 'ORTIGAS', 'NOVA STAR', 'EG25-G-SIM', 'NOVASTAR-021', 'LED ACC-GI29', 'PC/S', 'TAURUS MEDIA PLAYER - SIM', 20, 'Low Stock', NULL, NULL),
(364, 5, 'ORTIGAS', 'NOVA STAR', 'TB3', 'NOVASTAR-015', 'LED ACC-GI15', 'UNIT/S', 'TAURUS MEDIA PLAYER', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(365, 5, 'ORTIGAS', 'NOVA STAR', 'TB40', 'NOVASTAR-022', 'LED ACC-GI30', 'UNIT/S', 'TAURUS MEDIA PLAYER', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(366, 5, 'ORTIGAS', 'NOVA STAR', 'TB50', 'NOVASTAR-023', 'LED ACC-GI31', 'UNIT/S', 'TAURUS MEDIA PLAYER', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(367, 5, 'ORTIGAS', 'NOVA STAR', 'TB6', 'NOVASTAR-014', 'LED ACC-GI14', 'UNIT/S', 'TAURUS MEDIA PLAYER', 35, 'Available', NULL, '2023-04-26 00:19:46'),
(368, 5, 'ORTIGAS', 'NOVA STAR', 'TB60', 'NOVASTAR-013', 'LED ACC-GI13', 'UNIT/S', 'TAURUS MEDIA PLAYER', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(369, 5, 'ORTIGAS', 'NOVA STAR', 'TCB300', 'NOVASTAR-016', 'LED ACC-GI16', 'UNIT/S', 'TAURUS MEDIA PLAYER', 22, 'Available', NULL, '2023-04-26 00:19:46'),
(370, 7, 'ORTIGAS', 'NOVA STAR', 'SC-12', 'NOVASTAR-024', 'LED ACC-GI32', 'PC/S', 'NOVA STAR SENDING BOX', 2, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(371, 7, 'ORTIGAS', 'NOVA STAR', 'SC-4', 'NOVASTAR-025', 'LED ACC-GI33', 'PC/S', 'NOVA STAR SENDING BOX', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(372, 8, 'ORTIGAS', 'NOVA STAR', 'MSD300', 'NOVASTAR-001', 'LED ACC-GI01', 'UNIT/S', 'NOVA STAR SENDING CARD', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(373, 9, 'ORTIGAS', 'SHUTTLE', 'DH020U', 'SHUTTLE-005', 'LED ACC-GI21', 'UNIT/S', 'SHUTTLE MEDIA PLAYER', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(374, 9, 'ORTIGAS', 'SHUTTLE', 'DS02U', 'SHUTTLE-004', 'LED ACC-GI20', 'UNIT/S', 'SHUTTLE MEDIA PLAYER', 9, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(375, 9, 'ORTIGAS', 'SHUTTLE', 'DS10U', 'SHUTTLE-002', 'LED ACC-GI18', 'UNIT/S', 'SHUTTLE MEDIA PLAYER', 14, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(376, 9, 'ORTIGAS', 'SHUTTLE', 'NS02A', 'SHUTTLE-006', 'LED ACC-GI22', 'UNIT/S', 'SHUTTLE MEDIA PLAYER', 36, 'Available', NULL, '2023-04-26 00:19:46'),
(377, 9, 'ORTIGAS', 'SHUTTLE', 'P90U5', 'SHUTTLE-001', 'LED ACC-GI17', 'UNIT/S', 'SHUTTLE MEDIA PLAYER', 7, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(378, 10, 'ORTIGAS', 'NOVA STAR', 'GENERIC', 'NOVASTAR-018', 'LED ACC-GI15', 'UNIT/S', 'VIDEO PROCESSOR', 12, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(379, 10, 'ORTIGAS', 'NOVA STAR', 'H2', 'NOVASTAR-012', 'LED ACC-GI12', 'UNIT/S', 'VIDEO PROCESSOR', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(380, 10, 'ORTIGAS', 'NOVA STAR', 'LVP609', 'NOVASTAR-017', 'LED ACC-GI28', 'UNIT/S', 'VIDEO PROCESSOR', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(381, 10, 'ORTIGAS', 'NOVA STAR', 'LVP615S', 'NOVASTAR-011', 'LED ACC-GI11', 'UNIT/S', 'VIDEO PROCESSOR', 10, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(382, 10, 'ORTIGAS', 'NOVA STAR', 'VENUS X1', 'NOVASTAR-019', 'LED ACC-GI27', 'UNIT/S', 'VIDEO PROCESSOR', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(383, 10, 'ORTIGAS', 'NOVA STAR', 'VX1000', 'NOVASTAR-010', 'LED ACC-GI10', 'UNIT/S', 'VIDEO PROCESSOR', 1, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(384, 10, 'ORTIGAS', 'NOVA STAR', 'VX16S', 'NOVASTAR-009', 'LED ACC-GI09', 'UNIT/S', 'VIDEO PROCESSOR', 5, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(385, 10, 'ORTIGAS', 'NOVA STAR', 'VX400S', 'NOVASTAR-007', 'LED ACC-GI07', 'UNIT/S', 'VIDEO PROCESSOR', 39, 'Available', NULL, '2023-04-26 00:19:46'),
(386, 10, 'ORTIGAS', 'NOVA STAR', 'VX4S', 'NOVASTAR-008', 'LED ACC-GI08', 'UNIT/S', 'VIDEO PROCESSOR', 8, 'Low Stock', NULL, '2023-04-26 00:19:46'),
(387, 10, 'ORTIGAS', 'NOVA STAR', 'VX4S-N', 'NOVASTAR-017', 'LED ACC-GI26', 'UNIT/S', 'VIDEO PROCESSOR', 5, 'Low Stock', NULL, '2023-04-26 00:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `checkoutdate` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `drnumber` varchar(255) DEFAULT NULL,
  `prsnumber` varchar(255) DEFAULT NULL,
  `stockout_id` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `productcode` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `itemdescription` varchar(255) DEFAULT NULL,
  `serialnumber` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_slips`
--

CREATE TABLE `return_slips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `checkoutdate` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `drnumber` varchar(255) DEFAULT NULL,
  `rsnumber` varchar(255) DEFAULT NULL,
  `stockout_id` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `productcode` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `itemdescription` varchar(255) DEFAULT NULL,
  `serialnumber` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
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
('Rlhh88lVxZGUGwHZU3KoaAvpkpdqnqTMFCWymgQT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSDVrZ2hhUWl6UHNTdzN6eEhSaDdPM0hGd2FKVzdDM1BtdHBXbkRaaiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE2ODI0Njc4MDg7fX0=', 1682468433);

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
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=User,1=Admin,3=Manager'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `role_as`) VALUES
(1, 'Admin', 'admin@globaltronics.net', NULL, '$2y$10$UjlBqX5MWaBZHaepYC4jkey2Y.4jy393MVXkMBEbGH4Yw3LMELjNq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'Manager', 'manager@globaltronics.net', NULL, '$2y$10$G0KTSfCAXCzm6sxW7q0mpe4w51dp02ubaVqrSO4K/LyfXqNbOHPka', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(3, 'User', 'user@globaltronics.net', NULL, '$2y$10$hF4Nwms1mDQsAARzb.hZ5.jvfQIDa45OP/Cags0RazodTjMbfgHEq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowers_sku_foreign` (`sku`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkins`
--
ALTER TABLE `checkins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkins_category_id_foreign` (`category_id`),
  ADD KEY `checkins_sku_foreign` (`sku`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_sku_foreign` (`sku`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sku_index` (`sku`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_returns_sku_foreign` (`sku`);

--
-- Indexes for table `return_slips`
--
ALTER TABLE `return_slips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_slips_sku_foreign` (`sku`);

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
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `checkins`
--
ALTER TABLE `checkins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_slips`
--
ALTER TABLE `return_slips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD CONSTRAINT `borrowers_sku_foreign` FOREIGN KEY (`sku`) REFERENCES `products` (`sku`);

--
-- Constraints for table `checkins`
--
ALTER TABLE `checkins`
  ADD CONSTRAINT `checkins_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checkins_sku_foreign` FOREIGN KEY (`sku`) REFERENCES `products` (`sku`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_sku_foreign` FOREIGN KEY (`sku`) REFERENCES `products` (`sku`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD CONSTRAINT `purchase_returns_sku_foreign` FOREIGN KEY (`sku`) REFERENCES `products` (`sku`);

--
-- Constraints for table `return_slips`
--
ALTER TABLE `return_slips`
  ADD CONSTRAINT `return_slips_sku_foreign` FOREIGN KEY (`sku`) REFERENCES `products` (`sku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
