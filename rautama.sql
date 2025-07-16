-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2025 at 05:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rautama`
--

-- --------------------------------------------------------

--
-- Table structure for table `akad`
--

CREATE TABLE `akad` (
  `id` bigint UNSIGNED NOT NULL,
  `akun_id` int NOT NULL,
  `rumah_id` int NOT NULL,
  `tanggal_akad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` bigint UNSIGNED NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `no_hp`, `name`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, '081349445267', 'Dian Lucky Prayogi Edited', '$2y$12$CksbMvNjWv7LJvHbHRPJbeeWRHJRo16gOkrP7EjdAcoto5nRs3Sum', 'customer', '2025-04-09 07:09:33', '2025-04-14 04:13:53'),
(3, '081348782374', 'rautama', '$2y$12$gjA/reVHWWkeOpK2g0qqBeTD5nA4xv7ji4kz6.FPDcYajmTw40Xg2', 'customer', '2025-04-15 05:49:24', '2025-04-15 05:49:24'),
(4, '081349445268', 'admin', '$2y$12$fevTlPUPmdx1IzrdIePYBOmHxSbHKgkKj2AbUh/JBtQ1mQHuHDwHi', 'admin', '2025-04-18 04:07:15', '2025-04-18 04:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama_lokasi`, `created_at`, `updated_at`) VALUES
(4, 'Jl. Tembus Mantuil, Basirih, Banjarmasin Kota', '2025-04-17 06:20:29', '2025-04-17 06:20:29');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_04_02_142236_akun', 1),
(3, '2025_04_02_142630_lokasi', 1),
(4, '2025_04_02_143059_rumah', 1),
(5, '2025_04_02_143312_akad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rumah`
--

CREATE TABLE `rumah` (
  `id` bigint UNSIGNED NOT NULL,
  `lokasi_id` int NOT NULL,
  `no_rumah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_rumah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rumah`
--

INSERT INTO `rumah` (`id`, `lokasi_id`, `no_rumah`, `tipe`, `harga`, `ukuran`, `detail`, `status`, `foto_rumah`, `created_at`, `updated_at`) VALUES
(8, 4, '001', '36', '192000000', '6 x 12', 'Dengan luas yang pas dan desain efisien, rumah tipe 36 memberikan kenyamanan tinggal tanpa mengorbankan fungsi ruang. Cocok untuk gaya hidup modern yang simpel namun tetap elegan.', 'Belum Terjual', '1744899722_1.png', '2025-04-17 06:22:02', '2025-04-17 06:22:02'),
(9, 4, '002', '36', '192000000', '6 x 12', 'Tipe 36 menghadirkan suasana hangat dalam hunian mungil. Dilengkapi dua kamar tidur, ruang tamu, dan dapur, rumah ini pas untuk Anda yang baru memulai kehidupan keluarga.', 'Terjual', '1744899755_2.png', '2025-04-17 06:22:35', '2025-04-22 21:20:04'),
(10, 4, '003', '36', '192000000', '6 x 12', 'Tipe 36 menawarkan kenyamanan dalam ruang compact, dilengkapi 2 kamar tidur dan ruang keluarga yang fungsional.', 'Belum Terjual', '1744899788_3.png', '2025-04-17 06:23:08', '2025-04-17 06:23:08'),
(11, 4, '004', '45', '192000000', '8 x 12', 'Hunian yang nyaman untuk anda, luas dan memiliki beberapa kamar yang dapat anda gunakan untuk keluarga anda. Bonus carport yang luas', 'Belum Terjual', '1744916394_3.png', '2025-04-17 10:59:54', '2025-04-17 10:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` bigint NOT NULL,
  `akun_id` int NOT NULL,
  `rumah_id` int NOT NULL,
  `tanggal_survey` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `akun_id`, `rumah_id`, `tanggal_survey`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 9, '2025-04-22', 'Selesai', '2025-04-22 05:57:23', '2025-04-22 21:11:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akad`
--
ALTER TABLE `akad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `akun_no_hp_unique` (`no_hp`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rumah`
--
ALTER TABLE `rumah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akad`
--
ALTER TABLE `akad`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rumah`
--
ALTER TABLE `rumah`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
