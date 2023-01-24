-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 04:06 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppd_lldikti`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `pusat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id`, `users_id`, `pusat_id`, `created_at`, `updated_at`) VALUES
(10, 2, 5, NULL, NULL),
(11, 2, 6, NULL, NULL),
(12, 2, 8, NULL, NULL),
(13, 2, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kantor`
--

CREATE TABLE `kantor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `judul_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pergi` date NOT NULL,
  `tanggal_pulang` date NOT NULL,
  `lampiran_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kantor`
--

INSERT INTO `kantor` (`id`, `lokasi_id`, `users_id`, `judul_surat`, `tanggal_pergi`, `tanggal_pulang`, `lampiran_surat`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'undangan rapat kerja', '2022-10-31', '2022-11-02', 'undangan rapat kerja.pdf', NULL, NULL),
(2, 3, 1, 'fegeg', '2022-10-31', '2022-11-01', 'fegeg.pdf', NULL, NULL),
(3, 1, 1, 'monev', '2022-11-08', '2022-11-12', 'monev.pdf', NULL, NULL),
(4, 3, 1, 'monev', '2022-12-22', '2022-12-23', 'monev.xlsx', NULL, NULL),
(5, 3, 1, 'Undangan Monitoring dan evaluasi', '2022-12-23', '2022-12-25', 'Undangan Monitoring dan evaluasi.xlsx', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nip`, `nama`, `jabatan`, `golongan`, `divisi`, `created_at`, `updated_at`) VALUES
(1, '197009192014091004', 'Yondri', 'Pengadministrasi Persuratan', 'II b', 'TU & BMN', NULL, NULL),
(2, '197012051992032002', 'Afdalisma', 'Kepala', 'IV c', 'Pimpinan', NULL, NULL),
(3, '196805301993032002', 'Ernita', 'Pengelola Kepegawaian', 'III d', 'HKT', NULL, NULL),
(4, '198109142010121003', 'Wandi', 'Pengelola Keuangan', 'III b', 'Perencanaan & Penganggaran', NULL, NULL),
(5, '196708231991032001', 'Ely susanti', 'Analis SDM Aparatur Ahli Madya', 'IV b', 'Akademik & Kemahasiswaan', NULL, NULL),
(6, '196502101991032002', 'febrina fitri', 'Analis SDM Aparatur Ahli Madya', 'IV b', 'SDPT', NULL, NULL),
(8, '197302021998031007', 'Evrinaldi', 'Analis Mutu dan Akademik', 'IV a', 'Akademik', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_disposisi`
--

CREATE TABLE `karyawan_disposisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `disposisi_id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan_disposisi`
--

INSERT INTO `karyawan_disposisi` (`id`, `disposisi_id`, `karyawan_id`, `created_at`, `updated_at`) VALUES
(6, 10, 6, '2022-11-08 00:59:42', '2022-11-08 00:59:42'),
(7, 11, 5, '2022-11-08 00:59:57', '2022-11-08 00:59:57'),
(8, 11, 4, '2022-11-08 00:59:57', '2022-11-08 00:59:57'),
(9, 12, 8, '2022-12-21 07:39:19', '2022-12-21 07:39:19'),
(10, 13, 6, '2022-12-21 22:00:53', '2022-12-21 22:00:53'),
(11, 13, 8, '2022-12-21 22:00:53', '2022-12-21 22:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_kantor`
--

CREATE TABLE `karyawan_kantor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kantor_id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan_kantor`
--

INSERT INTO `karyawan_kantor` (`id`, `kantor_id`, `karyawan_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2022-10-29 07:48:00', '2022-10-29 07:48:00'),
(2, 1, 6, '2022-10-29 07:48:01', '2022-10-29 07:48:01'),
(3, 2, 4, '2022-10-29 07:48:35', '2022-10-29 07:48:35'),
(4, 3, 1, '2022-11-07 21:12:53', '2022-11-07 21:12:53'),
(5, 3, 2, '2022-11-07 21:12:53', '2022-11-07 21:12:53'),
(6, 3, 3, '2022-11-07 21:12:53', '2022-11-07 21:12:53'),
(7, 4, 6, '2022-12-21 08:33:09', '2022-12-21 08:33:09'),
(8, 5, 3, '2022-12-21 22:13:27', '2022-12-21 22:13:27'),
(9, 5, 4, '2022-12-21 22:13:27', '2022-12-21 22:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE `keuangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `disposisi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kantor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transportasi_id` bigint(20) UNSIGNED NOT NULL,
  `penginapan_id` bigint(20) UNSIGNED NOT NULL,
  `uang_transport` int(11) NOT NULL,
  `uang_penginapan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id`, `users_id`, `disposisi_id`, `kantor_id`, `transportasi_id`, `penginapan_id`, `uang_transport`, `uang_penginapan`, `created_at`, `updated_at`) VALUES
(13, 5, NULL, 1, 1, 1, 150000, 250000, NULL, NULL),
(16, 5, NULL, 3, 1, 1, 200000, 150000, NULL, NULL),
(17, 5, NULL, 2, 2, 2, 100000, 125000, NULL, NULL),
(25, 5, 10, NULL, 1, 1, 100000, 125000, NULL, NULL),
(26, 5, 11, NULL, 1, 1, 100000, 125000, NULL, NULL),
(27, 5, 12, NULL, 3, 2, 100000, 200000, NULL, NULL),
(28, 5, 13, NULL, 2, 2, 50000, 100000, NULL, NULL),
(29, 5, NULL, 5, 2, 1, 600000, 1000000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `besaran_lumpsum` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama_kota`, `besaran_lumpsum`, `created_at`, `updated_at`) VALUES
(1, 'Jambi', 1000000, NULL, NULL),
(2, 'jakarta', 2000000, NULL, NULL),
(3, 'Kalimantan', 2500000, NULL, NULL);

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
(1, '2014_10_11_142021_create_karyawan_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_10_03_141802_create_lokasi_table', 1),
(7, '2022_10_03_141803_create_transportasi_table', 1),
(8, '2022_10_03_141804_create_penginapan_table', 1),
(9, '2022_10_03_141914_create_pusat_table', 1),
(10, '2022_10_03_141956_create_kantor_table', 1),
(11, '2022_10_03_141957_create_disposisi_table', 1),
(12, '2022_10_03_141958_create_keuangan_table', 1),
(13, '2022_10_25_031436_create_karyawan_kantor_table', 1),
(14, '2022_10_25_031533_create_karyawan_disposisi_table', 1);

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
-- Table structure for table `penginapan`
--

CREATE TABLE `penginapan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_penginapan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penginapan`
--

INSERT INTO `penginapan` (`id`, `nama_penginapan`, `created_at`, `updated_at`) VALUES
(1, 'grand zuri', NULL, NULL),
(2, 'axana', NULL, NULL),
(3, 'ibis', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pusat`
--

CREATE TABLE `pusat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pergi` date NOT NULL,
  `tanggal_pulang` date NOT NULL,
  `lampiran_undangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_disposisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pusat`
--

INSERT INTO `pusat` (`id`, `lokasi_id`, `users_id`, `no_surat`, `judul_surat`, `tanggal_pergi`, `tanggal_pulang`, `lampiran_undangan`, `status_disposisi`, `created_at`, `updated_at`) VALUES
(5, 1, 1, '68999', 'undangan rapat', '2022-11-09', '2022-11-12', '68999.pdf', 'Terima', NULL, NULL),
(6, 2, 1, '11223', 'undangan rapat kerja', '2022-11-14', '2022-11-17', '11223.pdf', 'Terima', NULL, NULL),
(8, 3, 1, '001', 'kegiatan pelatihan', '2022-12-22', '2022-12-24', '001.pdf', 'Terima', NULL, NULL),
(9, 2, 1, '002', 'workshop', '2022-12-22', '2022-12-26', '002.pdf', 'Tolak', NULL, NULL),
(10, 1, 1, '004', 'undangan workshop', '2022-12-23', '2022-12-25', '004.pdf', 'Terima', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transportasi`
--

CREATE TABLE `transportasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_transportasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transportasi`
--

INSERT INTO `transportasi` (`id`, `jenis_transportasi`, `created_at`, `updated_at`) VALUES
(1, 'bus', NULL, NULL),
(2, 'pesawat', NULL, NULL),
(3, 'mobil kantor', NULL, NULL),
(4, 'Taxi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `karyawan_id`, `email`, `email_verified_at`, `password`, `role_user`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'yondri@gmail.com', NULL, '$2y$10$K793WRjWlR7c5fGV2oj1U.jmRgt7zS/mz1aGUXOxj51FrstMHEiZC', 'Admin', '6oFflTDlhZEHNxGvYLaL4qqS1huAbiEvDxY9nfCXkfrfC8koovWs8RT2x3mY', '2022-10-29 07:38:02', '2022-10-29 07:38:02'),
(2, 2, 'afdalisma@gmail.com', NULL, '$2y$10$/pCF2RmlR31Zrr11Vlzn9uU9DIqzERAa/pkRYCVAwvxxRhOvuoTTq', 'Pimpinan', NULL, '2022-10-29 07:43:09', '2022-10-29 07:43:09'),
(3, 3, 'ernita@gmail.com', NULL, '$2y$10$iylHicxrVeVXRmjxPkABzeA4XIzvivbttbIdNguZAsSJMHHG1PTIm', 'Admin HKT', NULL, '2022-10-29 07:43:25', '2022-10-29 07:43:25'),
(5, 4, 'wandi@gmail.com', NULL, '$2y$10$CXIMK8OWOI.K8PkRmXX/huSdNN0XSsMKtsP1fiLYKwP56EYIlktwu', 'Admin Keuangan', NULL, '2022-11-01 23:28:13', '2022-12-21 22:17:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disposisi_users_id_index` (`users_id`),
  ADD KEY `disposisi_pusat_id_index` (`pusat_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kantor`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kantor_lokasi_id_index` (`lokasi_id`),
  ADD KEY `kantor_users_id_index` (`users_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawan_nip_unique` (`nip`);

--
-- Indexes for table `karyawan_disposisi`
--
ALTER TABLE `karyawan_disposisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_disposisi_disposisi_id_index` (`disposisi_id`),
  ADD KEY `karyawan_disposisi_karyawan_id_index` (`karyawan_id`);

--
-- Indexes for table `karyawan_kantor`
--
ALTER TABLE `karyawan_kantor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_kantor_kantor_id_index` (`kantor_id`),
  ADD KEY `karyawan_kantor_karyawan_id_index` (`karyawan_id`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keuangan_users_id_index` (`users_id`),
  ADD KEY `keuangan_disposisi_id_index` (`disposisi_id`),
  ADD KEY `keuangan_kantor_id_index` (`kantor_id`),
  ADD KEY `keuangan_transportasi_id_index` (`transportasi_id`),
  ADD KEY `keuangan_penginapan_id_index` (`penginapan_id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penginapan`
--
ALTER TABLE `penginapan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pusat`
--
ALTER TABLE `pusat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pusat_no_surat_unique` (`no_surat`),
  ADD KEY `pusat_lokasi_id_index` (`lokasi_id`),
  ADD KEY `pusat_users_id_index` (`users_id`);

--
-- Indexes for table `transportasi`
--
ALTER TABLE `transportasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_karyawan_id_index` (`karyawan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kantor`
--
ALTER TABLE `kantor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `karyawan_disposisi`
--
ALTER TABLE `karyawan_disposisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `karyawan_kantor`
--
ALTER TABLE `karyawan_kantor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `penginapan`
--
ALTER TABLE `penginapan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pusat`
--
ALTER TABLE `pusat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transportasi`
--
ALTER TABLE `transportasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_pusat_id_foreign` FOREIGN KEY (`pusat_id`) REFERENCES `pusat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `disposisi_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kantor`
--
ALTER TABLE `kantor`
  ADD CONSTRAINT `kantor_lokasi_id_foreign` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kantor_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `karyawan_disposisi`
--
ALTER TABLE `karyawan_disposisi`
  ADD CONSTRAINT `karyawan_disposisi_disposisi_id_foreign` FOREIGN KEY (`disposisi_id`) REFERENCES `disposisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `karyawan_disposisi_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `karyawan_kantor`
--
ALTER TABLE `karyawan_kantor`
  ADD CONSTRAINT `karyawan_kantor_kantor_id_foreign` FOREIGN KEY (`kantor_id`) REFERENCES `kantor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `karyawan_kantor_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD CONSTRAINT `keuangan_disposisi_id_foreign` FOREIGN KEY (`disposisi_id`) REFERENCES `disposisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keuangan_kantor_id_foreign` FOREIGN KEY (`kantor_id`) REFERENCES `kantor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keuangan_penginapan_id_foreign` FOREIGN KEY (`penginapan_id`) REFERENCES `penginapan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keuangan_transportasi_id_foreign` FOREIGN KEY (`transportasi_id`) REFERENCES `transportasi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keuangan_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pusat`
--
ALTER TABLE `pusat`
  ADD CONSTRAINT `pusat_lokasi_id_foreign` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pusat_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
