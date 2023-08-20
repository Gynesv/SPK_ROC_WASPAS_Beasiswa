-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 5.7.33 - MySQL Community Server (GPL)
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk db_spk_pip
CREATE DATABASE IF NOT EXISTS `db_spk_pip` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_spk_pip`;

-- membuang struktur untuk table db_spk_pip.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_spk_pip.failed_jobs: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_spk_pip.migrations: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_spk_pip.password_resets: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_spk_pip.personal_access_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.sekolah_ta_siswa
CREATE TABLE IF NOT EXISTS `sekolah_ta_siswa` (
  `siswa_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_id` int(11) NOT NULL,
  `siswa_nisn` varchar(50) COLLATE armscii8_bin NOT NULL,
  `siswa_nama` varchar(50) COLLATE armscii8_bin NOT NULL,
  `siswa_jekel` enum('L','P') COLLATE armscii8_bin NOT NULL DEFAULT 'L',
  `siswa_alamat` text COLLATE armscii8_bin NOT NULL,
  `siswa_aktif` enum('Y','T') COLLATE armscii8_bin NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`siswa_id`) USING BTREE,
  UNIQUE KEY `siswa_nisn` (`siswa_nisn`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_spk_pip.sekolah_ta_siswa: ~15 rows (lebih kurang)
/*!40000 ALTER TABLE `sekolah_ta_siswa` DISABLE KEYS */;
INSERT INTO `sekolah_ta_siswa` (`siswa_id`, `tahun_id`, `siswa_nisn`, `siswa_nama`, `siswa_jekel`, `siswa_alamat`, `siswa_aktif`, `created_at`, `updated_at`) VALUES
	(1, 3, '1000001', 'Aditya Saputra', 'L', 'Padang', 'Y', '2023-06-17 10:35:18', '2023-06-17 10:43:04'),
	(2, 3, '1000002', 'Arahmad Radar', 'L', 'Padang', 'Y', '2023-06-17 10:35:40', '2023-06-17 10:43:23'),
	(3, 3, '1000003', 'Ayma Wulandari', 'L', 'Padang', 'Y', '2023-06-17 10:36:01', '2023-06-17 10:43:53'),
	(4, 3, '1000004', 'Azzahra Olivia ', 'L', 'Padang', 'Y', '2023-06-17 10:36:52', '2023-06-17 10:44:04'),
	(5, 3, '1000005', 'Cut Aulia Astini', 'L', 'Padang', 'Y', '2023-06-17 10:37:21', '2023-06-17 10:44:16'),
	(6, 3, '1000006', 'Faza Muhammad', 'L', 'Padang', 'Y', '2023-06-17 10:37:51', '2023-06-17 10:44:29'),
	(7, 3, '1000007', 'Feby Sofiani', 'L', 'Padang', 'Y', '2023-06-17 10:38:08', '2023-06-17 10:44:38'),
	(8, 3, '1000008', 'Ferlicia Kasih', 'L', 'Padang', 'Y', '2023-06-17 10:38:42', '2023-06-17 10:44:47'),
	(9, 3, '1000009', 'Fitri Senia', 'L', 'Padang', 'Y', '2023-06-17 10:39:04', '2023-06-17 10:44:57'),
	(10, 3, '1000010', 'Haikal Putra', 'L', 'Padang', 'Y', '2023-06-17 10:39:24', '2023-06-17 10:45:13'),
	(11, 3, '1000011', 'Siswa CD', 'L', 'Padang', 'Y', '2023-06-17 10:39:51', '2023-06-17 10:39:51'),
	(12, 3, '1000012', 'Siswa DA', 'L', 'Padang', 'Y', '2023-06-17 10:40:20', '2023-06-17 10:40:20'),
	(13, 3, '1000013', 'Siswa DB', 'L', 'Padang', 'Y', '2023-06-17 10:41:49', '2023-06-17 10:41:49'),
	(14, 3, '1000014', 'Siswa DC', 'L', 'Padang', 'Y', '2023-06-17 10:42:05', '2023-06-17 10:42:05'),
	(15, 3, '1000015', 'Siswa DD', 'L', 'Padang', 'Y', '2023-06-17 10:42:38', '2023-06-17 10:42:38'),
	(16, 3, '1000016', 'Siswa DE', 'P', 'Puruih', 'Y', '2023-08-01 13:06:18', '2023-08-01 13:06:40');
/*!40000 ALTER TABLE `sekolah_ta_siswa` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.sekolah_ta_tahun
CREATE TABLE IF NOT EXISTS `sekolah_ta_tahun` (
  `tahun_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_kode` varchar(4) COLLATE armscii8_bin NOT NULL,
  `tahun_nama` varchar(50) COLLATE armscii8_bin NOT NULL,
  `tahun_aktif` enum('Y','T') COLLATE armscii8_bin NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tahun_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_spk_pip.sekolah_ta_tahun: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `sekolah_ta_tahun` DISABLE KEYS */;
INSERT INTO `sekolah_ta_tahun` (`tahun_id`, `tahun_kode`, `tahun_nama`, `tahun_aktif`, `created_at`, `updated_at`) VALUES
	(1, '2021', 'Tahun Ajaran 2020/2021', 'T', '2023-06-11 00:32:30', '2023-06-11 00:32:30'),
	(2, '2122', 'Tahun Ajaran 2021/2022', 'T', '2023-06-11 00:33:12', '2023-06-11 00:33:12'),
	(3, '2223', 'Tahun Ajaran 2022/2023', 'Y', '2023-06-11 00:35:03', '2023-06-11 00:35:03');
/*!40000 ALTER TABLE `sekolah_ta_tahun` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.sekolah_tb_kelas
CREATE TABLE IF NOT EXISTS `sekolah_tb_kelas` (
  `kelas_id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_id` int(11) NOT NULL,
  `kelas_nama` varchar(50) COLLATE armscii8_bin NOT NULL,
  `kelas_aktif` enum('Y','T') COLLATE armscii8_bin NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kelas_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_spk_pip.sekolah_tb_kelas: ~9 rows (lebih kurang)
/*!40000 ALTER TABLE `sekolah_tb_kelas` DISABLE KEYS */;
INSERT INTO `sekolah_tb_kelas` (`kelas_id`, `tahun_id`, `kelas_nama`, `kelas_aktif`, `created_at`, `updated_at`) VALUES
	(1, 3, '10 A', 'Y', '2023-06-11 00:41:37', '2023-06-17 13:21:28'),
	(2, 3, '10 B', 'Y', '2023-06-11 00:41:47', '2023-06-17 13:21:28'),
	(3, 3, '10 C', 'Y', '2023-06-11 00:41:56', '2023-06-17 13:21:29'),
	(4, 3, '11 A', 'Y', '2023-06-11 00:42:07', '2023-06-17 13:21:30'),
	(5, 3, '11 B', 'Y', '2023-06-11 00:42:15', '2023-06-17 13:21:30'),
	(6, 3, '11 C', 'Y', '2023-06-11 00:42:24', '2023-06-17 13:21:31'),
	(7, 3, '12 A', 'Y', '2023-06-11 00:42:37', '2023-06-17 13:21:31'),
	(8, 3, '12 B', 'Y', '2023-06-11 00:42:45', '2023-06-17 13:21:32'),
	(9, 3, '12 C', 'Y', '2023-06-11 00:42:55', '2023-06-17 13:21:33'),
	(10, 3, '12 E', 'Y', '2023-08-01 13:07:58', '2023-08-01 13:08:12');
/*!40000 ALTER TABLE `sekolah_tb_kelas` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.sekolah_tc_peserta
CREATE TABLE IF NOT EXISTS `sekolah_tc_peserta` (
  `peserta_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `peserta_aktif` enum('Y','T') COLLATE armscii8_bin NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`peserta_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_spk_pip.sekolah_tc_peserta: ~10 rows (lebih kurang)
/*!40000 ALTER TABLE `sekolah_tc_peserta` DISABLE KEYS */;
INSERT INTO `sekolah_tc_peserta` (`peserta_id`, `kelas_id`, `siswa_id`, `peserta_aktif`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Y', '2023-06-17 10:46:14', '2023-06-17 10:46:14'),
	(2, 1, 2, 'Y', '2023-06-17 10:46:21', '2023-06-17 10:46:21'),
	(3, 1, 3, 'Y', '2023-06-17 10:46:25', '2023-06-17 10:46:25'),
	(4, 2, 4, 'Y', '2023-06-17 10:46:31', '2023-06-17 10:46:31'),
	(5, 2, 5, 'Y', '2023-06-17 10:46:36', '2023-06-17 10:46:36'),
	(6, 2, 6, 'Y', '2023-06-17 10:46:43', '2023-06-17 10:46:43'),
	(7, 2, 7, 'Y', '2023-06-17 10:46:47', '2023-06-17 10:46:47'),
	(8, 3, 8, 'Y', '2023-06-17 10:46:52', '2023-06-17 10:46:52'),
	(9, 3, 9, 'Y', '2023-06-17 10:47:04', '2023-06-17 10:47:04'),
	(10, 3, 10, 'Y', '2023-06-17 10:47:10', '2023-06-17 10:47:10');
/*!40000 ALTER TABLE `sekolah_tc_peserta` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.spk_ta_periode
CREATE TABLE IF NOT EXISTS `spk_ta_periode` (
  `periode_id` int(11) NOT NULL AUTO_INCREMENT,
  `periode_nama` varchar(50) COLLATE armscii8_bin NOT NULL,
  `periode_aktif` enum('Y','T') COLLATE armscii8_bin NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`periode_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_spk_pip.spk_ta_periode: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `spk_ta_periode` DISABLE KEYS */;
INSERT INTO `spk_ta_periode` (`periode_id`, `periode_nama`, `periode_aktif`, `created_at`, `updated_at`) VALUES
	(1, 'PIP - 7 Kriteria ', 'Y', '2023-06-16 22:04:13', '2023-06-16 22:04:13');
/*!40000 ALTER TABLE `spk_ta_periode` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.spk_tb_kriteria
CREATE TABLE IF NOT EXISTS `spk_tb_kriteria` (
  `kriteria_id` int(11) NOT NULL AUTO_INCREMENT,
  `periode_id` int(11) NOT NULL,
  `kriteria_kode` varchar(2) COLLATE armscii8_bin NOT NULL,
  `kriteria_nama` varchar(100) COLLATE armscii8_bin NOT NULL,
  `kriteria_tipe` enum('B','C') COLLATE armscii8_bin NOT NULL DEFAULT 'B',
  `kriteria_urut` int(11) NOT NULL,
  `kriteria_aktif` enum('Y','T') COLLATE armscii8_bin NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kriteria_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_spk_pip.spk_tb_kriteria: ~7 rows (lebih kurang)
/*!40000 ALTER TABLE `spk_tb_kriteria` DISABLE KEYS */;
INSERT INTO `spk_tb_kriteria` (`kriteria_id`, `periode_id`, `kriteria_kode`, `kriteria_nama`, `kriteria_tipe`, `kriteria_urut`, `kriteria_aktif`, `created_at`, `updated_at`) VALUES
	(1, 1, 'C1', 'Nilai Raport', 'B', 1, 'Y', '2023-06-10 23:58:16', '2023-07-23 10:20:10'),
	(2, 1, 'C2', 'Prestasi', 'B', 2, 'Y', '2023-06-10 23:58:27', '2023-06-16 22:03:13'),
	(3, 1, 'C3', 'Penghasilan OrangTua', 'C', 3, 'Y', '2023-06-10 23:59:08', '2023-06-17 14:36:13'),
	(4, 1, 'C4', 'Memiliki KKS atau SKTM', 'B', 4, 'Y', '2023-06-11 00:00:41', '2023-06-17 14:36:15'),
	(5, 1, 'C5', 'Jumlah Tanggungan', 'B', 5, 'Y', '2023-06-11 00:01:18', '2023-06-16 22:03:15'),
	(6, 1, 'C6', 'Status Tempat Tinggal', 'B', 6, 'Y', '2023-06-11 00:01:51', '2023-06-16 22:03:16'),
	(7, 1, 'C7', 'Jarak', 'B', 7, 'Y', '2023-06-11 00:02:13', '2023-07-23 10:20:11');
/*!40000 ALTER TABLE `spk_tb_kriteria` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.spk_tc_kuantitatif
CREATE TABLE IF NOT EXISTS `spk_tc_kuantitatif` (
  `kua_id` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria_id` int(11) NOT NULL,
  `nilai_ket` varchar(100) COLLATE armscii8_bin NOT NULL,
  `nilai_bobot` int(11) NOT NULL,
  `nilai_aktif` enum('Y','T') COLLATE armscii8_bin NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kua_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_spk_pip.spk_tc_kuantitatif: ~16 rows (lebih kurang)
/*!40000 ALTER TABLE `spk_tc_kuantitatif` DISABLE KEYS */;
INSERT INTO `spk_tc_kuantitatif` (`kua_id`, `kriteria_id`, `nilai_ket`, `nilai_bobot`, `nilai_aktif`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Sangat Baik', 3, 'Y', '2023-06-11 00:12:39', '2023-06-11 00:12:39'),
	(2, 1, 'Baik', 2, 'Y', '2023-06-11 00:13:07', '2023-06-11 00:13:07'),
	(3, 1, 'Cukup', 1, 'Y', '2023-06-11 00:13:32', '2023-06-11 00:13:32'),
	(4, 2, 'Ada', 2, 'Y', '2023-06-11 00:14:18', '2023-06-11 00:14:18'),
	(5, 2, 'Tidak Ada', 1, 'Y', '2023-06-11 00:14:51', '2023-06-11 00:14:51'),
	(6, 3, '>1000.000', 2, 'Y', '2023-06-11 00:15:04', '2023-08-13 10:57:49'),
	(7, 3, '<1000.000', 1, 'Y', '2023-06-11 00:15:29', '2023-08-13 10:58:01'),
	(8, 4, 'Tidak Ada', 1, 'Y', '2023-06-11 00:16:13', '2023-08-13 10:58:27'),
	(9, 4, 'ada', 2, 'Y', '2023-06-11 00:16:50', '2023-08-13 10:58:24'),
	(10, 5, '1', 1, 'Y', '2023-06-11 00:17:30', '2023-06-11 00:17:30'),
	(11, 5, '2', 2, 'Y', '2023-06-11 00:17:41', '2023-06-11 00:17:41'),
	(12, 5, '3', 3, 'Y', '2023-06-11 00:18:15', '2023-06-11 00:18:15'),
	(13, 6, 'Rumah Sendiri', 1, 'Y', '2023-06-11 00:18:34', '2023-06-11 00:18:34'),
	(14, 6, 'Ngontrak', 2, 'Y', '2023-06-11 00:18:50', '2023-06-11 00:18:50'),
	(15, 7, 'Dekat', 1, 'Y', '2023-06-11 00:19:15', '2023-06-11 00:19:15'),
	(16, 7, 'Jauh', 2, 'Y', '2023-06-11 00:19:25', '2023-06-11 00:19:25');
/*!40000 ALTER TABLE `spk_tc_kuantitatif` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.spk_td_penilaian
CREATE TABLE IF NOT EXISTS `spk_td_penilaian` (
  `penilaian_id` int(11) NOT NULL AUTO_INCREMENT,
  `peserta_id` int(11) NOT NULL,
  `kua_id` int(11) NOT NULL DEFAULT '0',
  `penilaian_aktif` enum('Y','T') COLLATE armscii8_bin NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`penilaian_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin ROW_FORMAT=DYNAMIC;

-- Membuang data untuk tabel db_spk_pip.spk_td_penilaian: ~70 rows (lebih kurang)
/*!40000 ALTER TABLE `spk_td_penilaian` DISABLE KEYS */;
INSERT INTO `spk_td_penilaian` (`penilaian_id`, `peserta_id`, `kua_id`, `penilaian_aktif`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 'Y', '2023-06-17 13:22:40', '2023-06-17 13:22:40'),
	(2, 1, 4, 'Y', '2023-06-17 13:23:36', '2023-06-17 13:23:36'),
	(3, 1, 6, 'Y', '2023-06-17 13:25:29', '2023-06-17 13:25:29'),
	(4, 1, 9, 'Y', '2023-06-17 13:25:44', '2023-06-17 13:25:44'),
	(5, 1, 10, 'Y', '2023-06-17 13:29:47', '2023-06-17 13:29:47'),
	(6, 1, 13, 'Y', '2023-06-17 13:29:56', '2023-06-17 13:29:56'),
	(7, 1, 16, 'Y', '2023-06-17 13:30:06', '2023-06-17 13:30:06'),
	(8, 2, 1, 'Y', '2023-06-17 13:30:35', '2023-06-17 13:30:35'),
	(9, 2, 5, 'Y', '2023-06-17 13:31:13', '2023-06-17 13:31:13'),
	(10, 2, 7, 'Y', '2023-06-17 13:31:28', '2023-06-17 13:31:28'),
	(11, 2, 8, 'Y', '2023-06-17 13:32:35', '2023-06-17 13:32:35'),
	(12, 2, 11, 'Y', '2023-06-17 13:33:41', '2023-06-17 13:33:41'),
	(13, 2, 14, 'Y', '2023-06-17 13:34:14', '2023-06-17 13:34:14'),
	(14, 2, 15, 'Y', '2023-06-17 13:34:23', '2023-06-17 13:34:23'),
	(15, 3, 3, 'Y', '2023-06-17 13:34:41', '2023-06-17 13:34:41'),
	(16, 3, 4, 'Y', '2023-06-17 13:34:52', '2023-06-17 13:34:52'),
	(17, 3, 6, 'Y', '2023-06-17 13:35:12', '2023-06-17 13:35:12'),
	(18, 3, 9, 'Y', '2023-06-17 13:35:27', '2023-06-17 13:35:27'),
	(19, 3, 12, 'Y', '2023-06-17 13:35:42', '2023-06-17 13:35:42'),
	(20, 3, 13, 'Y', '2023-06-17 13:35:53', '2023-06-17 13:35:53'),
	(21, 3, 16, 'Y', '2023-06-17 13:36:16', '2023-06-17 13:36:16'),
	(22, 4, 2, 'Y', '2023-06-17 13:36:43', '2023-06-17 13:36:43'),
	(23, 4, 5, 'Y', '2023-06-17 13:36:53', '2023-06-17 13:36:53'),
	(24, 4, 6, 'Y', '2023-06-17 13:37:13', '2023-06-17 13:37:13'),
	(25, 4, 8, 'Y', '2023-06-17 13:37:30', '2023-06-17 13:37:30'),
	(26, 4, 11, 'Y', '2023-06-17 13:38:46', '2023-06-17 13:38:46'),
	(27, 4, 14, 'Y', '2023-06-17 13:38:57', '2023-06-17 13:38:57'),
	(28, 4, 15, 'Y', '2023-06-17 13:39:30', '2023-06-17 13:39:30'),
	(29, 5, 3, 'Y', '2023-06-17 13:40:49', '2023-06-17 13:40:49'),
	(30, 5, 4, 'Y', '2023-06-17 13:41:08', '2023-06-17 13:41:08'),
	(31, 5, 7, 'Y', '2023-06-17 13:41:53', '2023-06-17 13:41:53'),
	(32, 5, 9, 'Y', '2023-06-17 13:42:33', '2023-06-17 13:42:33'),
	(33, 5, 10, 'Y', '2023-06-17 13:42:47', '2023-06-17 13:42:47'),
	(34, 5, 13, 'Y', '2023-06-17 13:43:00', '2023-06-17 13:43:00'),
	(35, 5, 16, 'Y', '2023-06-17 13:43:12', '2023-06-17 13:43:12'),
	(36, 6, 1, 'Y', '2023-06-17 13:44:04', '2023-06-17 13:44:04'),
	(37, 6, 5, 'Y', '2023-06-17 13:46:50', '2023-06-17 13:46:50'),
	(38, 6, 7, 'Y', '2023-06-17 13:47:26', '2023-06-17 13:47:26'),
	(39, 6, 9, 'Y', '2023-06-17 13:48:08', '2023-06-17 13:48:08'),
	(40, 6, 11, 'Y', '2023-06-17 13:48:40', '2023-06-17 13:48:40'),
	(41, 6, 13, 'Y', '2023-06-17 13:49:05', '2023-06-17 13:49:05'),
	(42, 6, 15, 'Y', '2023-06-17 13:49:14', '2023-06-17 13:49:14'),
	(43, 7, 2, 'Y', '2023-06-17 13:49:30', '2023-06-17 13:49:30'),
	(44, 7, 4, 'Y', '2023-06-17 13:49:41', '2023-06-17 13:49:41'),
	(45, 7, 6, 'Y', '2023-06-17 13:49:56', '2023-06-17 13:49:56'),
	(46, 7, 9, 'Y', '2023-06-17 13:50:11', '2023-06-17 13:50:11'),
	(47, 7, 12, 'Y', '2023-06-17 13:51:09', '2023-06-17 13:51:09'),
	(48, 7, 14, 'Y', '2023-06-17 13:51:22', '2023-06-17 13:51:22'),
	(49, 7, 16, 'Y', '2023-06-17 13:51:39', '2023-06-17 13:51:39'),
	(50, 8, 3, 'Y', '2023-06-17 13:51:57', '2023-06-17 13:51:57'),
	(51, 8, 5, 'Y', '2023-06-17 13:52:16', '2023-06-17 13:52:16'),
	(52, 8, 6, 'Y', '2023-06-17 13:52:29', '2023-06-17 13:52:29'),
	(53, 8, 9, 'Y', '2023-06-17 13:52:41', '2023-06-17 13:52:41'),
	(54, 8, 10, 'Y', '2023-06-17 13:53:13', '2023-06-17 13:53:13'),
	(55, 8, 14, 'Y', '2023-06-17 13:53:24', '2023-06-17 13:53:24'),
	(56, 8, 15, 'Y', '2023-06-17 13:53:36', '2023-06-17 13:53:36'),
	(57, 9, 3, 'Y', '2023-06-17 13:53:54', '2023-06-17 13:53:54'),
	(58, 9, 4, 'Y', '2023-06-17 13:54:03', '2023-06-17 13:54:03'),
	(59, 9, 6, 'Y', '2023-06-17 13:54:16', '2023-06-17 13:54:16'),
	(60, 9, 9, 'Y', '2023-06-17 13:54:42', '2023-06-17 13:54:42'),
	(61, 9, 10, 'Y', '2023-06-17 13:54:59', '2023-06-17 13:54:59'),
	(62, 9, 14, 'Y', '2023-06-17 13:55:26', '2023-06-17 13:55:26'),
	(63, 9, 16, 'Y', '2023-06-17 13:55:36', '2023-06-17 13:55:36'),
	(64, 10, 3, 'Y', '2023-06-17 13:56:00', '2023-06-17 13:56:00'),
	(65, 10, 4, 'Y', '2023-06-17 13:56:25', '2023-06-17 13:56:25'),
	(66, 10, 6, 'Y', '2023-06-17 13:56:33', '2023-06-17 13:56:33'),
	(67, 10, 8, 'Y', '2023-06-17 13:56:52', '2023-06-17 13:56:52'),
	(68, 10, 10, 'Y', '2023-06-17 13:57:03', '2023-06-17 13:57:03'),
	(69, 10, 13, 'Y', '2023-06-17 13:57:12', '2023-06-17 13:57:12'),
	(70, 10, 15, 'Y', '2023-06-17 13:57:24', '2023-06-17 13:57:24');
/*!40000 ALTER TABLE `spk_td_penilaian` ENABLE KEYS */;

-- membuang struktur untuk table db_spk_pip.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('A','K') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_view` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_spk_pip.users: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `level`, `email_verified_at`, `password`, `password_view`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Haqqul Yakin', 'haq', 'haqnesia@gmail.com', 'A', NULL, '$2y$10$ZHrXUacmxuZNIIxHJw4DkOCm78Q5B5S2YqrJFAMKvwmujyepzo9ku', 'haqnesia2023*', NULL, '2023-06-11 15:51:47', '2023-06-11 15:51:47'),
	(5, 'Fajar', 'fajar', 'fajarsetia58@gmail.com', 'K', NULL, '$2y$10$g/wdD6Du44RyOct56zM9qe35GuQh.Eq6GbNmtH3S1XYbqbD2tDtm2', '123', NULL, '2023-08-13 21:30:19', '2023-08-13 21:30:19');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
