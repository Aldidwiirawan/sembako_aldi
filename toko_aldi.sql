-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2025 pada 14.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_aldi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_operasional`
--

CREATE TABLE `biaya_operasional` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `biaya` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `biaya_operasional`
--

INSERT INTO `biaya_operasional` (`id`, `kategori`, `biaya`) VALUES
(1, 'toko', 0),
(2, 'urgent', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` bigint(20) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `transaksi_id`, `produk_id`, `jumlah`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
(171, 86, 13, 8, 16700, 133600, '2025-07-09 06:56:04', '2025-07-09 06:56:04'),
(172, 87, 11, 2, 17000, 34000, '2025-07-09 18:11:41', '2025-07-09 18:11:41'),
(173, 87, 24, 17, 11900, 202300, '2025-07-09 18:11:41', '2025-07-09 18:11:41'),
(174, 88, 11, 2, 17000, 34000, '2025-07-09 18:12:13', '2025-07-09 18:12:13'),
(175, 88, 24, 17, 11900, 202300, '2025-07-09 18:12:13', '2025-07-09 18:12:13'),
(176, 89, 12, 3, 50000, 150000, '2025-07-10 17:46:20', '2025-07-10 17:46:20'),
(177, 90, 12, 4, 50000, 200000, '2025-07-16 05:41:09', '2025-07-16 05:41:09'),
(178, 90, 11, 4, 17000, 68000, '2025-07-16 05:41:09', '2025-07-16 05:41:09'),
(179, 90, 23, 1, 12000, 12000, '2025-07-16 05:41:09', '2025-07-16 05:41:09'),
(180, 91, 12, 4, 50000, 200000, '2025-07-16 05:41:11', '2025-07-16 05:41:11'),
(181, 91, 11, 4, 17000, 68000, '2025-07-16 05:41:11', '2025-07-16 05:41:11'),
(182, 91, 23, 1, 12000, 12000, '2025-07-16 05:41:11', '2025-07-16 05:41:11'),
(183, 92, 12, 4, 50000, 200000, '2025-07-16 05:41:13', '2025-07-16 05:41:13'),
(184, 92, 11, 4, 17000, 68000, '2025-07-16 05:41:13', '2025-07-16 05:41:13'),
(185, 92, 23, 1, 12000, 12000, '2025-07-16 05:41:13', '2025-07-16 05:41:13'),
(186, 93, 11, 2, 17000, 34000, '2025-07-18 06:04:36', '2025-07-18 06:04:36'),
(187, 94, 12, 4, 50000, 200000, '2025-07-23 20:18:24', '2025-07-23 20:18:24'),
(188, 95, 15, 2, 30000, 60000, '2025-07-23 21:03:08', '2025-07-23 21:03:08'),
(189, 96, 15, 2, 30000, 60000, '2025-07-23 21:03:10', '2025-07-23 21:03:10'),
(190, 97, 48, 5, 17000, 85000, '2025-07-23 21:12:54', '2025-07-23 21:12:54'),
(191, 98, 13, 2, 95000, 190000, '2025-09-28 06:55:19', '2025-09-28 06:55:19'),
(192, 98, 12, 5, 65000, 325000, '2025-09-28 06:55:19', '2025-09-28 06:55:19'),
(193, 98, 11, 1, 22000, 22000, '2025-09-28 06:55:19', '2025-09-28 06:55:19'),
(194, 98, 10, 1, 80000, 80000, '2025-09-28 06:55:19', '2025-09-28 06:55:19'),
(195, 99, 13, 3, 95000, 285000, '2025-09-28 07:43:57', '2025-09-28 07:43:57'),
(196, 99, 12, 5, 65000, 325000, '2025-09-28 07:43:57', '2025-09-28 07:43:57'),
(197, 99, 11, 1, 22000, 22000, '2025-09-28 07:43:57', '2025-09-28 07:43:57'),
(198, 99, 10, 1, 80000, 80000, '2025-09-28 07:43:57', '2025-09-28 07:43:57'),
(199, 100, 13, 3, 95000, 285000, '2025-09-28 07:44:31', '2025-09-28 07:44:31'),
(200, 100, 12, 5, 65000, 325000, '2025-09-28 07:44:31', '2025-09-28 07:44:31'),
(201, 100, 11, 1, 22000, 22000, '2025-09-28 07:44:31', '2025-09-28 07:44:31'),
(202, 100, 10, 1, 80000, 80000, '2025-09-28 07:44:31', '2025-09-28 07:44:31'),
(203, 101, 13, 3, 95000, 285000, '2025-09-28 07:44:33', '2025-09-28 07:44:33'),
(204, 101, 12, 5, 65000, 325000, '2025-09-28 07:44:33', '2025-09-28 07:44:33'),
(205, 101, 11, 1, 22000, 22000, '2025-09-28 07:44:33', '2025-09-28 07:44:33'),
(206, 101, 10, 1, 80000, 80000, '2025-09-28 07:44:33', '2025-09-28 07:44:33'),
(207, 102, 11, 2, 22000, 44000, '2025-09-28 20:32:43', '2025-09-28 20:32:43'),
(208, 103, 10, 1, 74000, 74000, '2025-09-28 20:35:41', '2025-09-28 20:35:41'),
(209, 103, 12, 1, 120000, 120000, '2025-09-28 20:35:41', '2025-09-28 20:35:41'),
(210, 103, 11, 1, 20000, 20000, '2025-09-28 20:35:41', '2025-09-28 20:35:41'),
(211, 104, 10, 1, 74000, 74000, '2025-10-24 09:06:33', '2025-10-24 09:06:33'),
(212, 105, 10, 1, 74000, 74000, '2025-10-24 10:31:29', '2025-10-24 10:31:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Bahan Pokok', '2025-03-29 05:10:50', '2025-05-30 03:18:42'),
(3, 'Snack', '2025-03-07 22:18:22', '2025-03-11 22:23:18'),
(5, 'Minuman', '2025-03-07 22:21:28', '2025-05-30 03:18:54'),
(6, 'Obat', '2025-03-07 22:55:08', '2025-03-11 22:23:41'),
(7, 'Alat Mandi', '2025-03-12 04:36:29', '2025-03-12 04:36:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_04_142422_buat_tabel_produk', 1),
(5, '2025_03_05_050203_kategori', 2),
(6, '2025_03_06_131443_add_two_factor_columns_to_users_table', 3),
(7, '2025_07_15_010901_add_role_to_users_table', 3),
(8, '2025_07_24_030944_add_ongkir_to_transaksi_table', 4),
(9, '2025_08_22_145631_create_operasional_table', 5),
(10, '2025_08_23_082747_create_laporan_keuntungan_table', 5),
(11, '2025_09_29_000001_add_harga_kolak_harga_jual_to_produk_table', 5),
(12, '2025_09_29_000002_drop_harga_from_produk_table', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `operasional`
--

CREATE TABLE `operasional` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` varchar(100) DEFAULT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_kolak` varchar(100) NOT NULL DEFAULT '0',
  `harga_jual` varchar(100) NOT NULL DEFAULT '0',
  `stok` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama_produk`, `harga_kolak`, `harga_jual`, `stok`, `foto`, `created_at`, `updated_at`) VALUES
(10, '1', 'Beras 5 Kg', '70000', '74000', '228', 'images/1741777985.jfif', '2025-03-12 04:13:05', '2025-10-24 13:10:21'),
(11, '1', 'Gula', '18000', '20000', '488', 'images/1741778074.jfif', '2025-03-12 04:14:34', '2025-09-28 20:36:04'),
(12, '1', 'Indomie 1 Dus', '117000', '120000', '85', 'images/1741778121.jfif', '2025-03-12 04:15:21', '2025-09-28 20:36:04'),
(13, '1', 'Segitiga Biru', '0', '0', '187', 'images/1741778193.jfif', '2025-03-12 04:16:33', '2025-07-09 06:57:02'),
(14, '1', 'Sania 1 Liter', '0', '0', '120', 'images/1741778240.jfif', '2025-03-12 04:17:20', '2025-05-30 03:28:56'),
(15, '1', 'Bimoli Botol 1 Liter', '0', '0', '67', 'images/1741778282.jfif', '2025-03-12 04:18:02', '2025-07-23 21:03:28'),
(16, '1', 'Garam', '0', '0', '197', 'images/1741778314.jfif', '2025-03-12 04:18:34', '2025-06-11 06:31:57'),
(17, '1', 'Blue Band', '0', '0', '100', 'images/1741778346.jfif', '2025-03-12 04:19:06', '2025-07-08 23:30:41'),
(18, '1', 'Parcel Ramadhan', '0', '0', '16', 'images/1741778399.jfif', '2025-03-12 04:19:59', '2025-05-30 03:30:29'),
(19, '1', 'Marjan', '0', '0', '220', 'images/1741778437.jfif', '2025-03-12 04:20:37', '2025-05-30 03:30:38'),
(20, '3', 'Malkist', '0', '0', '98', 'images/1741778531.jfif', '2025-03-12 04:22:11', '2025-06-11 06:26:40'),
(21, '5', 'Pocari Sweat', '0', '0', '79', 'images/1741778567.jfif', '2025-03-12 04:22:47', '2025-07-08 23:05:51'),
(22, '5', 'Teh Pucuk', '0', '0', '200', 'images/1741778597.jfif', '2025-03-12 04:23:17', '2025-05-30 03:31:05'),
(23, '1', 'Susu Kental Manis', '0', '0', '54', 'images/1741778622.jfif', '2025-03-12 04:23:42', '2025-07-16 05:43:20'),
(24, '1', 'Sari Roti', '0', '0', '0', 'images/1741779226.jfif', '2025-03-12 04:33:46', '2025-07-09 18:13:30'),
(25, '7', 'Pepsodent', '0', '0', '100', 'images/1741781514.jfif', '2025-03-12 05:11:54', '2025-05-30 03:31:40'),
(26, '7', 'Sikat Gigi', '0', '0', '18', 'images/1741781535.jfif', '2025-03-12 05:12:15', '2025-05-30 03:31:51'),
(27, '7', 'Shampoo', '0', '0', '29', 'images/1741781561.jfif', '2025-03-12 05:12:41', '2025-07-08 23:05:51'),
(28, '5', 'Le Mineral', '0', '0', '99', 'images/1742365652.jfif', '2025-03-18 23:27:32', '2025-07-08 23:05:51'),
(29, '3', 'KitKat', '0', '0', '40', 'images/1742365853.jfif', '2025-03-18 23:30:53', '2025-03-19 06:51:31'),
(30, '3', 'Beng Beng', '0', '0', '18', 'images/1742365883.jfif', '2025-03-18 23:31:23', '2025-06-11 06:26:40'),
(31, '3', 'Kusuka', '0', '0', '100', 'images/1742365912.jfif', '2025-03-18 23:31:52', '2025-03-18 23:31:52'),
(32, '3', 'Kuaci Rebo', '0', '0', '19', 'images/1742365948.jfif', '2025-03-18 23:32:28', '2025-06-11 06:33:50'),
(33, '6', 'Hansaplas', '0', '0', '100', 'images/1742366050.jfif', '2025-03-18 23:34:10', '2025-03-18 23:34:10'),
(34, '6', 'Vicks Formula', '0', '0', '11', 'images/1742366082.jfif', '2025-03-18 23:34:42', '2025-05-30 03:33:03'),
(35, '3', 'Top', '0', '0', '196', 'images/1742366163.jfif', '2025-03-18 23:36:03', '2025-06-11 06:33:50'),
(36, '6', 'Betadine', '0', '0', '3', 'images/1742366318.jfif', '2025-03-18 23:38:38', '2025-06-11 06:27:50'),
(37, '5', 'Yakult', '0', '0', '94', 'images/1746622586.jpg', '2025-05-07 05:56:26', '2025-07-08 23:05:51'),
(38, '5', 'Floridina', '0', '0', '200', 'images/1746622614.jpg', '2025-05-07 05:56:54', '2025-05-07 05:56:54'),
(39, '1', 'Kecap Bango', '0', '0', '50', 'images/1746622635.jpg', '2025-05-07 05:57:15', '2025-05-07 05:57:15'),
(40, '6', 'Oskadon', '0', '0', '26', 'images/1746622670.jpg', '2025-05-07 05:57:50', '2025-06-11 06:27:50'),
(41, '5', 'Aqua', '0', '0', '300', 'images/1746622687.jpg', '2025-05-07 05:58:07', '2025-05-07 05:58:07'),
(42, '7', 'Sabun Lifebuoy', '0', '0', '50', 'images/1746622716.jpg', '2025-05-07 05:58:36', '2025-05-07 05:58:36'),
(43, '6', 'Tolak Angin', '0', '0', '43', 'images/1746622740.jpg', '2025-05-07 05:59:00', '2025-06-10 20:38:09'),
(44, '7', 'Gayung Plastik', '0', '0', '12', 'images/1746622758.jpg', '2025-05-07 05:59:18', '2025-05-07 05:59:18'),
(45, '3', 'Chitato', '0', '0', '77', 'images/1746622778.jpg', '2025-05-07 05:59:38', '2025-06-11 06:33:50'),
(46, '6', 'Alpara', '0', '0', '12', 'images/1746622798.jpg', '2025-05-07 05:59:58', '2025-05-07 05:59:58'),
(47, '3', 'Sponge', '0', '0', '3', 'images/1746622819.jpg', '2025-05-07 06:00:19', '2025-06-11 06:26:40'),
(48, '6', 'FreshCare', '0', '0', '19', 'images/1746622843.jpg', '2025-05-07 06:00:43', '2025-07-23 21:13:14'),
(49, '3', 'Nabati Siip', '0', '0', '47', 'images/1746622861.jpg', '2025-05-07 06:01:01', '2025-07-08 23:05:51'),
(51, '7', 'Sabun Lifebuoy Cair', '0', '0', '12', 'images/1746622910.jpg', '2025-05-07 06:01:50', '2025-05-07 06:01:50'),
(52, '6', 'Minyak Kayu Putih', '0', '0', '12', 'images/1746622933.jpg', '2025-05-07 06:02:13', '2025-05-07 06:02:13'),
(53, '3', 'Better', '0', '0', '99', 'images/1746622962.jpg', '2025-05-07 06:02:42', '2025-07-08 23:05:51'),
(56, '1', 'Uyahhh', '4000', '6500', '100', 'images/1761327263.png', '2025-10-24 10:34:23', '2025-10-24 12:16:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('fhirs0sHzEcrxks5BosZqSjopvSJlT7ZQ2wALZkW', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUFNjUzk4bHBGdWZJaTVWY2U5b001TmtrWDJJcERlOVRNZ01tRUl4VCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90YW1waWwtcHJvZHVrIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1762121396),
('P4hUhMnDSzyUNaiSpnR0qyuqaS4LzWPHp7YMAVRM', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic0FQcWU5RmFSWE1TMDZVT2hPRUFFeUhFNExEZDNTT3A2NFdlbEYwdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90YW1waWwtcHJvZHVrIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1762162994),
('Qw03KpitmjPmUAqx3BSlmE48c0vRiJwiLWcFd2x5', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicFJUcEZMb1I4SlAyU0Q0Q0lFWWo0QWhYSGdFWDQ3bzg4VHkyM0ZzMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90YW1waWwtdHJhbnNha3NpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1762237891),
('S0ICzRZMnLivYZuwk7PcG4ECMzcLamqEmcHdtgsf', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM2tpbThUcmFkNkxQZlM4Rko1VXhVRFlZRkh1SFJyaW41QnpnS0NSTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90YW1waWwtcHJvZHVrIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1762259636),
('xp0GUbgFjb6jf7LCcJ8m9FFKTaUVRHd1THeefjtP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVE5NV2tlVEZTMkYweEx5b2Q2TWs3WFY1RmpQOHlPYmdtMmo3Wk9ldyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90YW1waWwtcHJvZHVrIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1762162969);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stokhistori`
--

CREATE TABLE `stokhistori` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stokhistori`
--

INSERT INTO `stokhistori` (`id`, `keterangan`, `tipe`, `created_at`, `updated_at`) VALUES
(28, 'Harga beras naik', 'Stok Masuk', '2025-10-23 17:00:00', '2025-10-24 12:52:17'),
(29, 'Harga beras naik', 'Stok Masuk', '2025-10-23 17:00:00', '2025-10-24 12:54:45'),
(30, 'Laku dibeli', 'Stok Keluar', '2025-10-23 17:00:00', '2025-10-24 12:55:12'),
(31, 'Laku dibeli', 'Stok Keluar', '2025-10-23 17:00:00', '2025-10-24 12:58:07'),
(32, 'Laku dibeli', 'Stok Keluar', '2025-10-23 17:00:00', '2025-10-24 13:01:11'),
(33, 'Harga beras naik', 'Stok Masuk', '2025-10-23 17:00:00', '2025-10-24 13:02:10'),
(34, 'Laku dibeli', 'Stok Keluar', '2025-10-23 17:00:00', '2025-10-24 13:10:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stokhistoriopname`
--

CREATE TABLE `stokhistoriopname` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stokhistoriopname`
--

INSERT INTO `stokhistoriopname` (`id`, `keterangan`, `created_at`, `updated_at`) VALUES
(12, 'Opname 1', '2025-06-10 17:00:00', '2025-06-10 20:52:33'),
(13, 'TIdak ada keterangan', '2025-06-08 17:00:00', '2025-06-10 21:21:28'),
(14, 'TIdak ada keterangan', '2025-10-23 17:00:00', '2025-10-24 16:57:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stokkeluar`
--

CREATE TABLE `stokkeluar` (
  `id` int(11) NOT NULL,
  `id_histori` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stokkeluar`
--

INSERT INTO `stokkeluar` (`id`, `id_histori`, `id_produk`, `qty`, `created_at`, `updated_at`) VALUES
(5, 14, 11, 5, '2025-06-09 17:00:00', '2025-06-10 05:31:26'),
(6, 14, 10, 5, '2025-06-09 17:00:00', '2025-06-10 05:31:26'),
(7, 14, 12, 5, '2025-06-09 17:00:00', '2025-06-10 05:31:26'),
(8, 16, 11, 10, '2025-06-09 17:00:00', '2025-06-10 07:07:46'),
(9, 18, 11, 4, '2025-06-09 17:00:00', '2025-06-10 07:10:36'),
(10, 18, 10, 5, '2025-06-09 17:00:00', '2025-06-10 07:10:36'),
(11, 20, 11, 3, '2025-06-10 17:00:00', '2025-06-10 20:38:09'),
(12, 20, 36, 1, '2025-06-10 17:00:00', '2025-06-10 20:38:09'),
(13, 20, 43, 5, '2025-06-10 17:00:00', '2025-06-10 20:38:09'),
(14, 21, 11, 4, '2025-06-10 17:00:00', '2025-06-10 20:39:30'),
(15, 21, 36, 2, '2025-06-10 17:00:00', '2025-06-10 20:39:30'),
(16, 21, 37, 5, '2025-06-10 17:00:00', '2025-06-10 20:39:30'),
(17, 25, 10, 10, '2025-10-23 17:00:00', '2025-10-24 08:18:23'),
(18, 30, 10, 100, '2025-10-23 17:00:00', '2025-10-24 12:55:12'),
(19, 31, 10, 10, '2025-10-23 17:00:00', '2025-10-24 12:58:07'),
(20, 32, 10, 200, '2025-10-23 17:00:00', '2025-10-24 13:01:11'),
(21, 34, 10, 1, '2025-10-23 17:00:00', '2025-10-24 13:10:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stokmasuk`
--

CREATE TABLE `stokmasuk` (
  `id` int(11) NOT NULL,
  `id_histori` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stokmasuk`
--

INSERT INTO `stokmasuk` (`id`, `id_histori`, `id_produk`, `harga`, `qty`, `total`, `created_at`, `updated_at`) VALUES
(30, 28, 10, '80000', 100, 8000000, '2025-10-23 17:00:00', '2025-10-24 12:52:17'),
(31, 29, 10, '81000', 100, 8100000, '2025-10-23 17:00:00', '2025-10-24 12:54:45'),
(32, 33, 10, '82000', 10, 820000, '2025-10-23 17:00:00', '2025-10-24 13:02:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stokopname`
--

CREATE TABLE `stokopname` (
  `id` int(11) NOT NULL,
  `id_histori` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `stok_fisik` varchar(100) NOT NULL,
  `stok_sistem` varchar(100) NOT NULL,
  `selisih` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stokopname`
--

INSERT INTO `stokopname` (`id`, `id_histori`, `id_produk`, `stok_fisik`, `stok_sistem`, `selisih`, `created_at`, `updated_at`) VALUES
(83, 12, 10, '250', '240', '-10', '2025-06-10 17:00:00', '2025-06-10 20:52:33'),
(84, 12, 11, '450', '498', '48', '2025-06-10 17:00:00', '2025-06-10 20:52:33'),
(85, 13, 15, '71', '70', '-1', '2025-06-08 17:00:00', '2025-06-10 21:21:28'),
(86, 13, 16, '0', '199', '199', '2025-06-08 17:00:00', '2025-06-10 21:21:28'),
(87, 13, 17, '0', '17', '17', '2025-06-08 17:00:00', '2025-06-10 21:21:28'),
(88, 14, 10, '238', '228', '-10', '2025-10-23 17:00:00', '2025-10-24 16:57:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL DEFAULT 0,
  `status` enum('pending','selesai','dikirim','') NOT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal_bayar` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `user_id`, `harga`, `ongkir`, `status`, `snap_token`, `created_at`, `updated_at`, `tanggal_bayar`) VALUES
(104, 10, 90000, 0, 'dikirim', 'a7e0e923-694d-4195-afc3-c0c94ab579b7', '2025-10-24 09:06:33', '2025-10-24 11:47:20', '2025-10-24 11:47:20'),
(105, 10, 90000, 0, 'selesai', 'f80cd221-ed33-400f-b490-6a4ec42da44e', '2025-10-24 10:31:29', '2025-10-24 10:36:05', '2025-10-24 10:31:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `usertype` varchar(20) NOT NULL DEFAULT 'pembeli',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `usertype`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `alamat`, `foto`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(6, 'Aldi', 'admin', 'aldi@gmail.com', NULL, '$2y$12$xQYfmbk4Z17/C0m1HsBHNONB6R1DMXYTcIGQOczQRkzvdmuzzJP7i', NULL, NULL, NULL, 'Kediri, East Java, Java, Indonesia', NULL, NULL, '2025-03-07 20:38:59', '2025-03-07 20:38:59', 'user'),
(10, 'Pembeli', 'pembeli', 'pembeli@gmail.com', NULL, '$2y$12$.J4F32UhiGWLa/jeR/WJIeeiAHsXNj/N6MVPPm1iZuMB4/lH1Wyxi', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-02 21:04:02', '2025-07-02 21:04:02', 'user'),
(21, 'Owner', 'owner', 'owner@gmail.com', NULL, '$2y$12$XvVNpk.5UCz/GjuTcTevH.nPlPtSX/mz1b7yMqL0S0VPBzjot1nj2', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-22 05:57:21', '2025-07-22 05:57:21', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biaya_operasional`
--
ALTER TABLE `biaya_operasional`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `operasional`
--
ALTER TABLE `operasional`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `operasional_key_unique` (`key`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `stokhistori`
--
ALTER TABLE `stokhistori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stokhistoriopname`
--
ALTER TABLE `stokhistoriopname`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stokkeluar`
--
ALTER TABLE `stokkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stokmasuk`
--
ALTER TABLE `stokmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stokopname`
--
ALTER TABLE `stokopname`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `biaya_operasional`
--
ALTER TABLE `biaya_operasional`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `operasional`
--
ALTER TABLE `operasional`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `stokhistori`
--
ALTER TABLE `stokhistori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `stokhistoriopname`
--
ALTER TABLE `stokhistoriopname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `stokkeluar`
--
ALTER TABLE `stokkeluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `stokmasuk`
--
ALTER TABLE `stokmasuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `stokopname`
--
ALTER TABLE `stokopname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
