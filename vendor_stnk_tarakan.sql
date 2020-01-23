-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jan 2020 pada 22.11
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vendor_stnk_tarakan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_11_06_201417_create_ms_kendaraans_table', 1),
(5, '2019_11_06_202343_create_ms_hargas_table', 1),
(6, '2019_11_06_202412_create_ms_samsats_table', 1),
(7, '2019_11_06_202430_create_ms_dealers_table', 1),
(8, '2019_11_06_202733_create_po_msts_table', 1),
(9, '2019_11_06_202749_create_po_trns_table', 1),
(10, '2019_11_12_073941_create_sys_menu_groups_table', 2),
(11, '2019_11_12_073510_create_sys_menus_table', 3),
(12, '2019_11_13_083123_create_sys_permissions_table', 4),
(13, '2019_11_15_031942_create_wilayah_kotas_table', 5),
(14, '2019_11_15_031356_create_wilayah_provinsis_table', 6),
(15, '2019_11_25_084444_create_po_stnk_samsats_table', 7),
(16, '2019_11_25_084626_create_po_stnk_dealers_table', 8),
(17, '2019_11_25_084642_create_po_bpkb_samsats_table', 9),
(18, '2019_11_25_084651_create_po_bpkb_dealers_table', 10),
(19, '2019_11_27_032808_create_sys_profiles_table', 11),
(20, '2020_01_14_095438_create_po_plat_dealers_table', 12),
(21, '2020_01_14_095642_create_po_plat_samsats_table', 13),
(22, '2020_01_17_114803_add_kode_validasi_to_po_plat_dealer', 14),
(23, '2020_01_20_144656_add_kode_validasi_to_po_bpkb_dealer', 15),
(24, '2020_01_20_144609_add_kode_validasi_to_po_stnk_dealer', 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_dealer`
--

CREATE TABLE `ms_dealer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jatuh_tempo` int(11) NOT NULL,
  `harga_jasa` decimal(9,2) NOT NULL,
  `kuitansi` int(1) NOT NULL DEFAULT 1,
  `keterangan` text COLLATE utf8mb4_unicode_ci NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0: non aktif, 1: aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ms_dealer`
--

INSERT INTO `ms_dealer` (`id`, `nama`, `provinsi`, `kota`, `alamat`, `telp`, `pic`, `jatuh_tempo`, `harga_jasa`, `kuitansi`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(2, 'MOTOR ASTRA SEMARANG', '33', '3374', 'Jln. Gajah Mada No. 88 Semarang', '086569001', 'Mora', 25, '650000.00', 2, '', 1, '2019-11-26 03:05:23', '2019-11-26 03:05:23'),
(3, 'CV. JAYA ABADI', '33', '3374', 'Jl. Jend Gatot Subroto 671 A, Semarang, 50517', '+62246924260', 'Yadi', 30, '750000.00', 1, '', 1, '2019-11-26 03:18:00', '2019-11-26 03:18:00'),
(4, 'PT MINTOJIWO', '33', '3374', 'JL. MINTOJIWO RAYA', '024-70791510', 'RIKI', 30, '1000000.00', 1, '', 1, '2019-11-26 03:39:05', '2019-11-26 03:39:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_harga`
--

CREATE TABLE `ms_harga` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_kendaraan` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(9,2) NOT NULL,
  `pnbp` decimal(9,2) NOT NULL,
  `pph` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ms_harga`
--

INSERT INTO `ms_harga` (`id`, `kode_kendaraan`, `harga`, `pnbp`, `pph`, `created_at`, `updated_at`) VALUES
(2, 'NF11T14C01', '1707000.00', '250000.00', '14600.00', '2019-11-26 03:37:40', '2019-11-26 03:37:40'),
(3, 'R5F04R25L0AQ', '3317000.00', '250000.00', '14600.00', '2019-11-26 03:38:19', '2019-11-26 03:38:19'),
(4, '77654321', '1000000.00', '250000.00', '50000.00', '2019-11-26 03:50:04', '2019-11-26 03:50:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_kendaraan`
--

CREATE TABLE `ms_kendaraan` (
  `tipe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0: non aktif, 1: aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ms_kendaraan`
--

INSERT INTO `ms_kendaraan` (`tipe`, `kode`, `nama`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
('77654321', '123', 'TRIAL', 'MATIC', 1, '2019-11-26 03:49:22', '2019-11-26 03:49:22'),
('NF11T14C01', '', 'New Revo Fit', 'M/T', 1, '2019-11-26 02:36:22', '2019-11-26 02:36:22'),
('R5F04R25L0AQ', '', 'CBR 250RR STD', 'K M/T', 1, '2019-11-26 02:51:40', '2019-11-26 02:51:40'),
('W7781-89991', 'PQOW111', 'MOTOR', NULL, 1, '2019-12-11 03:31:07', '2019-12-11 03:31:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_samsat`
--

CREATE TABLE `ms_samsat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0: non aktif, 1: aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ms_samsat`
--

INSERT INTO `ms_samsat` (`id`, `nama`, `provinsi`, `kota`, `alamat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SAMSAT SEMARANG 3', '33', '3374', 'Jl. Hanoman Raya No.2, Krapyak, Kec. Semarang Bar., Kota Semarang, Jawa Tengah 50146', 1, '2019-11-26 03:23:09', '2019-11-26 03:23:09'),
(2, 'SAMSAT SEMARANG 5', '33', '3374', 'Jl. Pamularsih', 1, '2019-11-26 03:41:49', '2019-11-26 03:41:49'),
(3, 'SAMSAT SEMARANG 6', '88', '3374', 'Jl. Pemuda', 1, '2019-11-26 03:42:42', '2019-11-26 03:42:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_bpkb_dealer`
--

CREATE TABLE `po_bpkb_dealer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_po` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_trn` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tgl_validasi` date DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_validasi` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `po_bpkb_dealer`
--

INSERT INTO `po_bpkb_dealer` (`id`, `no_po`, `id_trn`, `status`, `tgl_validasi`, `catatan`, `created_at`, `updated_at`, `kode_validasi`) VALUES
(1, 'PO.001', 1, 1, '2020-01-20', '', '2019-11-26 08:13:03', '2019-11-26 08:13:03', '2001PD0008'),
(2, 'PO.001', 2, 0, NULL, '', '2019-11-26 08:13:03', '2019-11-26 08:13:03', NULL),
(3, 'PO.001', 3, 0, NULL, NULL, '2019-11-26 08:13:03', '2019-11-26 08:13:03', NULL),
(4, 'PO.TRIAL-0001', 4, 1, '2020-01-20', '', '2019-11-28 09:03:30', '2019-11-28 09:03:30', '2001PD0006'),
(5, 'PO.TRIAL-0001', 5, 1, '2020-01-20', '', '2019-11-28 09:03:30', '2019-11-28 09:03:30', '2001PD0006'),
(6, 'TRIAL0020', 6, 1, '2020-01-20', '', '2019-12-11 07:25:06', '2019-12-11 07:25:06', '2001PD0008'),
(7, 'TRIAL0020', 7, 1, '2020-01-20', '', '2019-12-11 07:25:06', '2019-12-11 07:25:06', '2001PD0008'),
(8, 'TRIAL0021', 8, 1, '2020-01-20', '', '2019-12-11 08:14:55', '2019-12-11 08:14:55', '2001PD0008'),
(9, 'TRIAL0021', 9, 0, NULL, NULL, '2019-12-11 08:14:55', '2019-12-11 08:14:55', NULL),
(11, 'TRIAL003', 11, 1, '2020-01-20', '', '2020-01-14 03:48:09', '2020-01-14 03:48:09', '2001PD0008'),
(12, 'TRIAL003', 12, 1, '2020-01-20', '', '2020-01-14 03:48:09', '2020-01-14 03:48:09', '2001PD0008');

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_bpkb_samsat`
--

CREATE TABLE `po_bpkb_samsat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_po` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_trn` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tgl_validasi` date DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `po_bpkb_samsat`
--

INSERT INTO `po_bpkb_samsat` (`id`, `no_po`, `id_trn`, `status`, `tgl_validasi`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 'PO.001', 1, 1, NULL, '', '2019-11-26 08:13:03', '2019-11-26 08:13:03'),
(2, 'PO.001', 2, 0, NULL, NULL, '2019-11-26 08:13:03', '2019-11-26 08:13:03'),
(3, 'PO.001', 3, 0, NULL, NULL, '2019-11-26 08:13:03', '2019-11-26 08:13:03'),
(4, 'PO.TRIAL-0001', 4, 0, NULL, NULL, '2019-11-28 09:03:30', '2019-11-28 09:03:30'),
(5, 'PO.TRIAL-0001', 5, 0, NULL, NULL, '2019-11-28 09:03:30', '2019-11-28 09:03:30'),
(6, 'TRIAL0020', 6, 0, NULL, NULL, '2019-12-11 07:25:06', '2019-12-11 07:25:06'),
(7, 'TRIAL0020', 7, 0, NULL, NULL, '2019-12-11 07:25:06', '2019-12-11 07:25:06'),
(8, 'TRIAL0021', 8, 0, NULL, NULL, '2019-12-11 08:14:55', '2019-12-11 08:14:55'),
(9, 'TRIAL0021', 9, 0, NULL, NULL, '2019-12-11 08:14:55', '2019-12-11 08:14:55'),
(11, 'TRIAL003', 11, 0, NULL, NULL, '2020-01-14 03:48:09', '2020-01-14 03:48:09'),
(12, 'TRIAL003', 12, 0, NULL, NULL, '2020-01-14 03:48:09', '2020-01-14 03:48:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_mst`
--

CREATE TABLE `po_mst` (
  `no_po` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_po` date NOT NULL,
  `id_dealer` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_samsat` int(11) NOT NULL,
  `provinsi` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `id_user` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_notice` int(11) NOT NULL DEFAULT 0 COMMENT '0:belum selesai notice, 1: selesai notice',
  `status_notice_kelengkapan` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum lengkap, 1: lengkap semua',
  `keterangan_stnk_samsat` text COLLATE utf8mb4_unicode_ci NULL,
  `status_stnk_samsat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum terima dari samsat, 1: sudah terima dari samsat',
  `status_stnk_dealer` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum dikirim ke dealer, 1: sudah diterima dealer',
  `status_bpkb_samsat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum terima dari samsat, 1: sudah terima dari samsat',
  `status_bpkb_dealer` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum dikirim ke dealer, 1: sudah diterima dealer',
  `status_plat_samsat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum terima dari samsat, 1: sudah terima dari samsat',
  `status_plat_dealer` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum dikirim ke dealer, 1: sudah diterima dealer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `po_mst`
--

INSERT INTO `po_mst` (`no_po`, `tgl_po`, `id_dealer`, `id_samsat`, `provinsi`, `kota`, `total`, `id_user`, `keterangan`, `status_notice`, `status_notice_kelengkapan`, `keterangan_stnk_samsat`, `status_stnk_samsat`, `status_stnk_dealer`, `status_bpkb_samsat`, `status_bpkb_dealer`, `status_plat_samsat`, `status_plat_dealer`, `created_at`, `updated_at`) VALUES
('PO.001', '2019-11-26', '2', 1, '11', '1107', '5550000.00', 3, '', 1, 0, '-', 0, 0, 0, 0, 0, 1, '2019-11-26 08:13:03', '2019-11-26 08:13:03'),
('PO.TRIAL-0001', '2019-11-28', '3', 2, '51', '5102', '0.00', 3, '', 0, 0, '-', 0, 0, 0, 1, 0, 0, '2019-11-28 09:03:30', '2019-11-28 09:03:30'),
('PO0024', '2019-12-14', '2', 2, '36', '3671', '0.00', 3, '', 0, 0, '-', 0, 0, 0, 0, 0, 0, '2019-12-14 06:05:18', '2019-12-14 06:05:18'),
('TRIAL0020', '2019-12-11', '3', 3, '33', '3374', '0.00', 3, '', 0, 0, '-', 0, 0, 0, 1, 0, 1, '2019-12-11 07:25:06', '2019-12-11 07:25:06'),
('TRIAL0021', '2019-12-11', '3', 2, '36', '3601', '6252400.00', 3, '', 0, 0, '-', 0, 0, 0, 0, 0, 1, '2019-12-11 08:14:55', '2019-12-11 08:14:55'),
('TRIAL003', '2020-01-14', '3', 1, '11', '1107', '6994800.00', 3, '', 0, 0, '-', 0, 0, 0, 1, 0, 0, '2020-01-14 03:48:09', '2020-01-14 03:48:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_plat_dealer`
--

CREATE TABLE `po_plat_dealer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_po` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_trn` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tgl_validasi` date DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_validasi` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `po_plat_dealer`
--

INSERT INTO `po_plat_dealer` (`id`, `no_po`, `id_trn`, `status`, `tgl_validasi`, `catatan`, `created_at`, `updated_at`, `kode_validasi`) VALUES
(3, 'PO.001', 1, 1, '2020-01-17', '', NULL, NULL, '2001PD0002'),
(4, 'PO.001', 2, 1, '2020-01-17', '', NULL, NULL, '2001PD0002'),
(5, 'PO.001', 3, 1, '2020-01-17', '', NULL, NULL, '2001PD0002'),
(6, 'PO.TRIAL-0001', 4, 1, '2020-01-18', '', NULL, NULL, '2001PD0003'),
(7, 'PO.TRIAL-0001', 5, 0, NULL, NULL, NULL, NULL, NULL),
(8, 'TRIAL0020', 6, 1, '2020-01-20', '', NULL, NULL, '2001PD0004'),
(9, 'TRIAL0020', 7, 1, '2020-01-20', '', NULL, NULL, '2001PD0006'),
(10, 'TRIAL0021', 8, 1, '2020-01-20', '', NULL, NULL, '2001PD0005'),
(11, 'TRIAL0021', 9, 1, '2020-01-20', '', NULL, NULL, '2001PD0007'),
(12, 'TRIAL003', 11, 0, NULL, NULL, NULL, NULL, NULL),
(13, 'TRIAL003', 12, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_plat_samsat`
--

CREATE TABLE `po_plat_samsat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_po` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_trn` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tgl_validasi` date DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `po_plat_samsat`
--

INSERT INTO `po_plat_samsat` (`id`, `no_po`, `id_trn`, `status`, `tgl_validasi`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 'TRIAL003', 11, 1, NULL, '', '2020-01-14 03:48:09', '2020-01-14 03:48:09'),
(2, 'TRIAL003', 12, 0, NULL, NULL, '2020-01-14 03:48:09', '2020-01-14 03:48:09'),
(3, 'PO.001', 1, 0, NULL, NULL, NULL, NULL),
(4, 'PO.001', 2, 0, NULL, NULL, NULL, NULL),
(5, 'PO.001', 3, 0, NULL, NULL, NULL, NULL),
(6, 'PO.TRIAL-0001', 4, 0, NULL, NULL, NULL, NULL),
(7, 'PO.TRIAL-0001', 5, 0, NULL, NULL, NULL, NULL),
(8, 'TRIAL0020', 6, 0, NULL, NULL, NULL, NULL),
(9, 'TRIAL0020', 7, 0, NULL, NULL, NULL, NULL),
(10, 'TRIAL0021', 8, 0, NULL, NULL, NULL, NULL),
(11, 'TRIAL0021', 9, 0, NULL, NULL, NULL, NULL),
(12, 'TRIAL003', 11, 0, NULL, NULL, NULL, NULL),
(13, 'TRIAL003', 12, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_stnk_dealer`
--

CREATE TABLE `po_stnk_dealer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_po` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_trn` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tgl_validasi` date DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_validasi` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `po_stnk_dealer`
--

INSERT INTO `po_stnk_dealer` (`id`, `no_po`, `id_trn`, `status`, `tgl_validasi`, `catatan`, `created_at`, `updated_at`, `kode_validasi`) VALUES
(1, 'PO.001', 1, 1, '2020-01-21', '', '2019-11-26 08:13:03', '2019-11-26 08:13:03', '2001PD0001'),
(2, 'PO.001', 2, 0, NULL, NULL, '2019-11-26 08:13:03', '2019-11-26 08:13:03', NULL),
(3, 'PO.001', 3, 1, '2020-01-21', '', '2019-11-26 08:13:03', '2019-11-26 08:13:03', '2001PD0001'),
(4, 'PO.TRIAL-0001', 4, 1, '2020-01-21', '', '2019-11-28 09:03:30', '2019-11-28 09:03:30', '2001PD0002'),
(5, 'PO.TRIAL-0001', 5, 0, NULL, NULL, '2019-11-28 09:03:30', '2019-11-28 09:03:30', NULL),
(6, 'TRIAL0020', 6, 0, NULL, NULL, '2019-12-11 07:25:06', '2019-12-11 07:25:06', NULL),
(7, 'TRIAL0020', 7, 0, NULL, NULL, '2019-12-11 07:25:06', '2019-12-11 07:25:06', NULL),
(8, 'TRIAL0021', 8, 1, '2020-01-16', '', '2019-12-11 08:14:55', '2019-12-11 08:14:55', NULL),
(9, 'TRIAL0021', 9, 0, NULL, NULL, '2019-12-11 08:14:55', '2019-12-11 08:14:55', NULL),
(11, 'TRIAL003', 11, 0, NULL, NULL, '2020-01-14 03:48:09', '2020-01-14 03:48:09', NULL),
(12, 'TRIAL003', 12, 0, NULL, NULL, '2020-01-14 03:48:09', '2020-01-14 03:48:09', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_stnk_samsat`
--

CREATE TABLE `po_stnk_samsat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_po` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_trn` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tgl_validasi` date DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `po_stnk_samsat`
--

INSERT INTO `po_stnk_samsat` (`id`, `no_po`, `id_trn`, `status`, `tgl_validasi`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 'PO.001', 1, 1, '2020-01-16', '', '2019-11-26 08:13:03', '2019-11-26 08:13:03'),
(2, 'PO.001', 2, 1, NULL, '', '2019-11-26 08:13:03', '2019-11-26 08:13:03'),
(3, 'PO.001', 3, 0, NULL, NULL, '2019-11-26 08:13:03', '2019-11-26 08:13:03'),
(4, 'PO.TRIAL-0001', 4, 0, NULL, NULL, '2019-11-28 09:03:30', '2019-11-28 09:03:30'),
(5, 'PO.TRIAL-0001', 5, 0, NULL, NULL, '2019-11-28 09:03:30', '2019-11-28 09:03:30'),
(6, 'TRIAL0020', 6, 0, NULL, NULL, '2019-12-11 07:25:06', '2019-12-11 07:25:06'),
(7, 'TRIAL0020', 7, 0, NULL, NULL, '2019-12-11 07:25:06', '2019-12-11 07:25:06'),
(8, 'TRIAL0021', 8, 0, NULL, NULL, '2019-12-11 08:14:55', '2019-12-11 08:14:55'),
(9, 'TRIAL0021', 9, 0, NULL, NULL, '2019-12-11 08:14:55', '2019-12-11 08:14:55'),
(11, 'TRIAL003', 11, 0, NULL, NULL, '2020-01-14 03:48:09', '2020-01-14 03:48:09'),
(12, 'TRIAL003', 12, 0, NULL, NULL, '2020-01-14 03:48:09', '2020-01-14 03:48:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `po_trns`
--

CREATE TABLE `po_trns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_po` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kendaraan` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_pol` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_mesin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_stnk` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warna_dasar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulan_pajak` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proses` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_notice_bbn` decimal(9,2) DEFAULT NULL,
  `harga_jasa` decimal(9,2) DEFAULT NULL,
  `pph` decimal(9,2) DEFAULT NULL,
  `pnbp` decimal(9,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `no_notice_bbn` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_notice_bbn` date DEFAULT NULL,
  `info_kelengkapan` text COLLATE utf8mb4_unicode_ci NULL,
  `status_bbn_proses` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum, 1: sudah',
  `status_bbn_kelengkapan` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum lengkap, 1: lengkap',
  `status_stnk_samsat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum terima dari samsat, 1: sudah terima dari samsat',
  `status_stnk_dealer` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum dikirim ke dealer, 1: sudah diterima dealer',
  `status_bpkb_samsat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum terima dari samsat, 1: sudah terima dari samsat',
  `status_bpkb_dealer` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum dikirim ke dealer, 1: sudah diterima dealer',
  `status_plat_samsat` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum terima dari samsat, 1: sudah terima dari samsat',
  `status_plat_dealer` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: belum dikirim ke dealer, 1: sudah diterima dealer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `po_trns`
--

INSERT INTO `po_trns` (`id`, `no_po`, `kode_kendaraan`, `no_pol`, `no_mesin`, `nama_stnk`, `ukuran`, `warna_dasar`, `bulan_pajak`, `tahun`, `proses`, `keterangan`, `harga_notice_bbn`, `harga_jasa`, `pph`, `pnbp`, `subtotal`, `no_notice_bbn`, `tgl_notice_bbn`, `info_kelengkapan`, `status_bbn_proses`, `status_bbn_kelengkapan`, `status_stnk_samsat`, `status_stnk_dealer`, `status_bpkb_samsat`, `status_bpkb_dealer`, `status_plat_samsat`, `status_plat_dealer`, `created_at`, `updated_at`) VALUES
(1, 'PO.001', '77654321', 'H-1-A', '1', 'AAN', '', '', '', '', '', '', '1000000.00', '650000.00', '50000.00', '250000.00', '1850000.00', 'NTC.001', '2019-11-26', '-', 1, 1, 1, 1, 1, 1, 1, 1, '2019-11-26 08:13:03', '2019-11-26 08:13:03'),
(2, 'PO.001', '77654321', 'H-2-A', '2', 'ANI', '', '', '', '', '', '', '1000000.00', '650000.00', '50000.00', '250000.00', '1850000.00', 'NTC.001', '2019-11-26', '', 0, 0, 1, 0, 0, 0, 0, 1, '2019-11-26 08:13:03', '2019-11-26 08:13:03'),
(3, 'PO.001', '77654321', 'H-3-A', '3', 'ALI', '', '', '', '', '', '', '1000000.00', '650000.00', '50000.00', '250000.00', '1850000.00', 'NTC.001', '2019-11-26', '', 1, 1, 0, 1, 0, 0, 0, 1, '2019-11-26 08:13:03', '2019-11-26 08:13:03'),
(4, 'PO.TRIAL-0001', 'R5F04R25L0AQ', NULL, 'SZBVD832947581', 'LAURENTIUS KEVIN HENDRAWANTO', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', 0, 0, 0, 1, 0, 1, 0, 1, '2019-11-28 09:03:30', '2019-11-28 09:03:30'),
(5, 'PO.TRIAL-0001', '77654321', NULL, 'SZBVD83294758', 'LAURENTIUS KEVIN HENDRAWANTO', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-', 0, 0, 0, 0, 0, 1, 0, 0, '2019-11-28 09:03:30', '2019-11-28 09:03:30'),
(6, 'TRIAL0020', 'NF11T14C01', 'H 4481 AGG', 'SZBVD832947581', 'LAURENTIUS KEVIN HENDRAWANTO', '', '', '', '', '', '', '1707000.00', '750000.00', '14600.00', '250000.00', '2692400.00', 'ASDC', '2019-12-11', '', 1, 0, 0, 0, 0, 1, 0, 1, '2019-12-11 07:25:06', '2019-12-11 07:25:06'),
(7, 'TRIAL0020', '77654321', NULL, 'SZBVD83294758', 'LAURENTIUS KEVIN HENDRAWANTO', NULL, NULL, NULL, NULL, NULL, '', '1000000.00', '750000.00', '50000.00', '250000.00', '1950000.00', NULL, NULL, '-', 0, 0, 0, 0, 0, 1, 0, 1, '2019-12-11 07:25:06', '2019-12-11 07:25:06'),
(8, 'TRIAL0021', 'R5F04R25L0AQ', NULL, 'ASD', 'LAURENTIUS KEVIN HENDRAWANTO', NULL, NULL, NULL, NULL, NULL, '', '3317000.00', '750000.00', '14600.00', '250000.00', '4302400.00', NULL, NULL, '-', 0, 0, 0, 1, 0, 1, 0, 1, '2019-12-11 08:14:55', '2019-12-11 08:14:55'),
(9, 'TRIAL0021', '77654321', 'H 4481 AGG', 'QWE', 'LAURENTIUS KEVIN HENDRAWANTO', '', '', '', '', '', '', '1000000.00', '750000.00', '50000.00', '250000.00', '1950000.00', 'ASDC', '2019-12-11', '', 1, 0, 0, 0, 0, 0, 0, 1, '2019-12-11 08:14:55', '2019-12-11 08:14:55'),
(11, 'TRIAL003', 'NF11T14C01', NULL, 'SZBVD832947581', 'LAURENTIUS KEVIN HENDRAWANTO', NULL, NULL, NULL, NULL, NULL, '', '1707000.00', '750000.00', '14600.00', '250000.00', '2692400.00', NULL, NULL, '-', 0, 0, 0, 0, 0, 1, 1, 0, '2020-01-14 03:48:09', '2020-01-14 03:48:09'),
(12, 'TRIAL003', 'R5F04R25L0AQ', NULL, 'ZXCQWREXVBC', 'LAURENTIUS KEVIN HENDRAWANTO', NULL, NULL, NULL, NULL, NULL, '', '3317000.00', '750000.00', '14600.00', '250000.00', '4302400.00', NULL, NULL, '-', 0, 0, 0, 0, 0, 1, 0, 0, '2020-01-14 03:48:09', '2020-01-14 03:48:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_menus`
--

CREATE TABLE `sys_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_group` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segment_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ord` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0: umum,1: developer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sys_menus`
--

INSERT INTO `sys_menus` (`id`, `id_group`, `name`, `segment_name`, `url`, `ord`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Menu', 'menu', 'system-utility/menu', 2, 1, '2019-11-12 02:05:15', '2019-11-12 02:05:15'),
(2, 1, 'Group Menu', 'menu-group', 'system-utility/menu-group', 1, 1, '2019-11-12 19:38:47', '2019-11-12 19:38:47'),
(3, 2, 'Dealer', 'dealer', 'master/dealer', 2, 0, '2019-11-12 19:40:49', '2019-11-12 19:40:49'),
(4, 2, 'Samsat', 'samsat', 'master/samsat', 3, 0, '2019-11-12 19:41:17', '2019-11-12 19:41:17'),
(5, 2, 'Kendaraan', 'kendaraan', 'master/kendaraan', 4, 0, '2019-11-12 19:42:22', '2019-11-12 19:42:22'),
(6, 2, 'Harga', 'harga', 'master/harga', 5, 0, '2019-11-12 19:42:51', '2019-11-12 19:42:51'),
(7, 2, 'User Management', 'user-management', 'master/user-management', 1, 0, '2019-11-12 23:48:12', '2019-11-12 23:48:12'),
(8, 3, 'Purchase Order', 'purchase-order', 'transaction/purchase-order', 1, 0, '2019-11-13 18:49:26', '2019-11-13 18:49:26'),
(9, 3, 'Validasi Notice BBN', 'validasi-notice', 'transaction/validasi-notice', 2, 0, '2019-11-15 08:02:50', '2019-11-15 08:02:50'),
(10, 3, 'STNK dari SAMSAT', 'stnk-dari-samsat', 'transaction/stnk-dari-samsat', 4, 0, '2019-11-15 08:05:51', '2019-11-15 08:05:51'),
(11, 3, 'BPKB dari SAMSAT', 'bpkb-dari-samsat', 'transaction/bpkb-dari-samsat', 6, 0, '2019-11-15 08:06:18', '2019-11-15 08:06:18'),
(12, 3, 'STNK ke Dealer', 'stnk-ke-dealer', 'transaction/stnk-ke-dealer', 5, 0, '2019-11-17 18:55:40', '2019-11-17 18:55:40'),
(13, 3, 'BPKB ke Dealer', 'bpkb-ke-dealer', 'transaction/bpkb-ke-dealer', 7, 0, '2019-11-17 18:57:20', '2019-11-17 18:57:20'),
(14, 3, 'Update Kelengkapan BBN', 'update-kelengkapan-bbn', 'transaction/update-kelengkapan-bbn', 3, 0, '2019-11-19 23:48:56', '2019-11-19 23:48:56'),
(15, 1, 'Company Info', 'company-info', 'system-utility/company-info', 3, 0, '2019-11-26 04:03:43', '2019-11-26 04:03:43'),
(16, 4, 'BBN per SAMSAT', 'bbn-per-samsat', 'laporan/bbn-per-samsat', 2, 0, '2019-11-28 06:57:07', '2019-11-28 06:57:07'),
(17, 4, 'BBN per Periode', 'bbn-per-periode', 'laporan/bbn-per-periode', 3, 0, '2019-11-29 08:04:32', '2019-11-29 08:04:32'),
(18, 4, 'BBN per DEALER', 'bbn-per-dealer', 'laporan/bbn-per-dealer', 4, 0, '2019-11-30 05:49:10', '2019-11-30 05:49:10'),
(19, 4, 'Rekap Tagihan per PO', 'rekap-tagihan-per-po', 'laporan/rekap-tagihan-per-po', 5, 0, '2019-12-02 20:07:00', '2019-12-02 20:07:00'),
(20, 4, 'Transaksi', 'transaksi', 'laporan/transaksi', 1, 0, '2019-12-02 20:08:32', '2019-12-02 20:08:32'),
(21, 4, 'Detail Pencairan Piutang', 'detail-pencairan-piutang', 'laporan/detail-pencairan-piutang', 6, 0, '2019-12-06 07:05:12', '2019-12-06 07:05:12'),
(22, 3, 'PLAT NO dari SAMSAT', 'plat-dari-samsat', 'transaction/plat-dari-samsat', 8, 0, '2020-01-14 03:05:21', '2020-01-14 03:05:21'),
(23, 3, 'PLAT NO ke Dealer', 'plat-ke-dealer', 'transaction/plat-ke-dealer', 9, 0, '2020-01-14 03:06:09', '2020-01-14 03:06:09'),
(24, 4, 'Pengiriman BPKB', 'pengiriman-bpkb', 'laporan/pengiriman-bpkb', 7, 0, '2020-01-16 03:15:40', '2020-01-16 03:15:40'),
(25, 4, 'Pengiriman STNK', 'pengiriman-stnk', 'laporan/pengiriman-stnk', 8, 0, '2020-01-16 08:40:01', '2020-01-16 08:40:01'),
(26, 4, 'Pengiriman Plat Nomor', 'pengiriman-plat', 'laporan/pengiriman-plat', 9, 0, '2020-01-16 09:18:34', '2020-01-16 09:18:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_menu_groups`
--

CREATE TABLE `sys_menu_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segment_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ord` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0: umum,1: developer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sys_menu_groups`
--

INSERT INTO `sys_menu_groups` (`id`, `name`, `segment_name`, `icon`, `ord`, `status`, `created_at`, `updated_at`) VALUES
(1, 'System Utility', 'system-utility', 'fas fa-cogs', 1, 1, '2019-11-12 01:33:26', '2019-11-12 01:33:26'),
(2, 'Master Data', 'master', 'fas fa-database', 2, 0, '2019-11-12 01:35:35', '2019-11-12 01:35:35'),
(3, 'Transaction', 'transaction', 'fas fa-motorcycle', 3, 0, '2019-11-13 18:45:13', '2019-11-13 18:45:13'),
(4, 'Laporan', 'laporan', 'fas fa-chart-bar', 4, 0, '2019-11-19 01:33:32', '2019-11-19 01:33:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_permissions`
--

CREATE TABLE `sys_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_menu` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sys_permissions`
--

INSERT INTO `sys_permissions` (`id`, `username`, `id_menu`, `created_at`, `updated_at`) VALUES
(9, 'dev', 2, '2019-11-13 07:19:12', '2019-11-13 07:19:12'),
(10, 'dev', 1, '2019-11-13 07:19:12', '2019-11-13 07:19:12'),
(11, 'dev', 4, '2019-11-13 07:19:12', '2019-11-13 07:19:12'),
(12, 'kvn', 2, '2019-11-13 07:21:10', '2019-11-13 07:21:10'),
(13, 'kvn', 1, '2019-11-13 07:21:10', '2019-11-13 07:21:10'),
(14, 'kvn', 7, '2019-11-13 07:21:10', '2019-11-13 07:21:10'),
(15, 'kvn', 4, '2019-11-13 07:21:10', '2019-11-13 07:21:10'),
(16, 'kvn', 6, '2019-11-13 07:21:10', '2019-11-13 07:21:10'),
(31, 'rizky', 2, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(32, 'rizky', 1, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(33, 'rizky', 7, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(34, 'rizky', 3, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(35, 'rizky', 4, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(36, 'rizky', 5, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(37, 'rizky', 6, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(38, 'rizky', 8, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(39, 'rizky', 9, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(40, 'rizky', 14, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(41, 'rizky', 10, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(42, 'rizky', 12, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(43, 'rizky', 11, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(44, 'rizky', 13, '2019-11-26 03:19:25', '2019-11-26 03:19:25'),
(45, 'rizky2', 2, '2019-11-26 03:20:19', '2019-11-26 03:20:19'),
(46, 'rizky2', 1, '2019-11-26 03:20:19', '2019-11-26 03:20:19'),
(47, 'rizky2', 3, '2019-11-26 03:20:19', '2019-11-26 03:20:19'),
(48, 'rizky2', 4, '2019-11-26 03:20:19', '2019-11-26 03:20:19'),
(49, 'rizky2', 6, '2019-11-26 03:20:19', '2019-11-26 03:20:19'),
(50, 'rizky2', 8, '2019-11-26 03:20:19', '2019-11-26 03:20:19'),
(51, 'rizky2', 10, '2019-11-26 03:20:19', '2019-11-26 03:20:19'),
(52, 'rizky2', 13, '2019-11-26 03:20:19', '2019-11-26 03:20:19'),
(53, 'rizky3', 2, '2019-11-26 03:22:29', '2019-11-26 03:22:29'),
(54, 'rizky3', 1, '2019-11-26 03:22:29', '2019-11-26 03:22:29'),
(55, 'rizky3', 7, '2019-11-26 03:22:29', '2019-11-26 03:22:29'),
(56, 'rizky3', 3, '2019-11-26 03:22:29', '2019-11-26 03:22:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sys_profile`
--

CREATE TABLE `sys_profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sys_profile`
--

INSERT INTO `sys_profile` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'nama', 'CV. Desy Cahaya Mandiri', '2019-11-27 04:15:24', '2019-11-27 04:15:24'),
(2, 'alamat', 'Jl. Ketapang - Sukadana, Kel. Tolak,  Kec. Matan Hilir Utara,  Kab. Ketapang,  Kalimantan Barat', '2019-11-27 04:16:39', '2019-11-27 04:16:39'),
(3, 'email', 'desy.cahayamandiri@gmail.com', '2019-11-27 04:16:50', '2019-11-27 04:16:50'),
(4, 'pic_area', 'Miswan', '2019-11-27 04:17:08', '2019-12-14 05:40:36'),
(5, 'pic_admin', 'Yunita Kumala Sari', '2019-11-27 04:17:19', '2019-12-14 02:28:00'),
(6, 'pic_bpkb', 'Adi Karyadi', '2019-11-27 04:17:33', '2019-12-14 02:27:52'),
(7, 'kota', 'Ketapang', '2019-12-14 01:54:47', '2019-12-14 01:54:47'),
(8, 'bank', 'BCA', '2019-12-14 02:08:58', '2019-12-14 02:08:58'),
(9, 'no_rekening', '8955138887', '2019-12-14 02:09:32', '2019-12-14 02:09:32'),
(10, 'nama_rekening', 'DESY CAHAYA MANDIRI CV', '2019-12-14 02:10:49', '2019-12-14 02:10:49'),
(11, 'trial', '1', '2019-12-14 06:16:00', '2019-12-14 06:16:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'dev', 'Developer', 'laurentiuskevin44@gmail.com', NULL, 'eyJpdiI6Ikt1VU1wYnBndFdsWDk1R3MrOXdacmc9PSIsInZhbHVlIjoiQnJrNG5ranlwbXdaTEFHNGtRWVZMQT09IiwibWFjIjoiOGEyMmZjM2Q1YmI4NzMzYThmNGViMDNmZTg4ZGM5MGUxMWIwY2Y1YThhNzFhOThiMzY4NmExN2NkMGM1MDY1YiJ9', NULL, '2019-11-13 00:50:39', '2019-11-13 00:50:39'),
(4, 'kvn', 'kvn', 'laurentiuskevin@hotmail.com', NULL, 'eyJpdiI6ImRVSFlKSnBMRjdzSW1Md1o0M3ZQT1E9PSIsInZhbHVlIjoicThwb29oREVuSHVOR2V5YXpycGNmUT09IiwibWFjIjoiOGQ0NTE2ODczMzcxNWE3MDgxYjFiM2U0YmUxOGFlMzc0MTYyNzZlYjhiMzNjNjczYjQ5Y2Y1NzkwMzJlNzk1ZiJ9', NULL, '2019-11-13 07:21:10', '2019-11-13 07:21:10'),
(5, 'rizky', 'rizky pranata', 'septian.rizky89@yahoo.com', NULL, 'eyJpdiI6ImgxeVc1RlFBSUJrZytjTUI5WDg4RlE9PSIsInZhbHVlIjoiNDQ2UUpCV2dWUnI4bWFrN1wvb2dlRWc9PSIsIm1hYyI6IjIzYmM2Yjk5Y2Q4NThmYWU4YTQxNzAxMmEzNGE5MjQzMTE5NWQwYmE3ZWY3ZDEyOGNmMzgyYmZmZWM5MWE0NzUifQ==', NULL, '2019-11-26 03:18:40', '2019-11-26 03:18:40'),
(6, 'rizky2', 'rizky2', 'rizky2@gmail.com', NULL, 'eyJpdiI6IjFjeUp5RE5CSGJud2I2QTJDNGZBZVE9PSIsInZhbHVlIjoiYzh1Q2lQdGg3RSt1QU85aWVEa0NMZz09IiwibWFjIjoiMDNiYzMwZjRiNDMwYjMwZTZmZGNhYjYxZjNjODQyMGQ1MjkyOGQ2NmY0YjAwNTVhZWU5ZTZiYjUzYmNkNzZiZiJ9', NULL, '2019-11-26 03:20:19', '2019-11-26 03:20:19'),
(10, 'rizky3', 'rizky3', 'rizky3@gmail.com', NULL, 'eyJpdiI6ImxQM3ZkS3lLQXdDRFJuWWEyQVJQUWc9PSIsInZhbHVlIjoiMVhLeWo4V3V2QUltQmkwaEJtcVM5UT09IiwibWFjIjoiNDJiZTU0ZDU1NjgxYzQxMDc0ZTJiOWFjZGU2MGU5Mjk1NWE1NGM3ZjJiMmEzYTE4ZTU5Yzk1NDA0NGY4MTY2MyJ9', NULL, '2019-11-26 03:22:29', '2019-11-26 03:22:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wilayah_kota`
--

CREATE TABLE `wilayah_kota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wilayah_kota`
--

INSERT INTO `wilayah_kota` (`id`, `id_provinsi`, `name`, `created_at`, `updated_at`) VALUES
(1101, 11, 'KABUPATEN SIMEULUE', '2019-11-15 03:41:32', '2019-11-15 03:41:32'),
(1102, 11, 'KABUPATEN ACEH SINGKIL', '2019-11-15 03:41:32', '2019-11-15 03:41:32'),
(1103, 11, 'KABUPATEN ACEH SELATAN', '2019-11-15 03:41:32', '2019-11-15 03:41:32'),
(1104, 11, 'KABUPATEN ACEH TENGGARA', '2019-11-15 03:41:32', '2019-11-15 03:41:32'),
(1105, 11, 'KABUPATEN ACEH TIMUR', '2019-11-15 03:41:32', '2019-11-15 03:41:32'),
(1106, 11, 'KABUPATEN ACEH TENGAH', '2019-11-15 03:41:32', '2019-11-15 03:41:32'),
(1107, 11, 'KABUPATEN ACEH BARAT', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1108, 11, 'KABUPATEN ACEH BESAR', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1109, 11, 'KABUPATEN PIDIE', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1110, 11, 'KABUPATEN BIREUEN', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1111, 11, 'KABUPATEN ACEH UTARA', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1112, 11, 'KABUPATEN ACEH BARAT DAYA', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1113, 11, 'KABUPATEN GAYO LUES', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1114, 11, 'KABUPATEN ACEH TAMIANG', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1115, 11, 'KABUPATEN NAGAN RAYA', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1116, 11, 'KABUPATEN ACEH JAYA', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1117, 11, 'KABUPATEN BENER MERIAH', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1118, 11, 'KABUPATEN PIDIE JAYA', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1171, 11, 'KOTA BANDA ACEH', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1172, 11, 'KOTA SABANG', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1173, 11, 'KOTA LANGSA', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1174, 11, 'KOTA LHOKSEUMAWE', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1175, 11, 'KOTA SUBULUSSALAM', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1201, 12, 'KABUPATEN NIAS', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1202, 12, 'KABUPATEN MANDAILING NATAL', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1203, 12, 'KABUPATEN TAPANULI SELATAN', '2019-11-15 03:41:33', '2019-11-15 03:41:33'),
(1204, 12, 'KABUPATEN TAPANULI TENGAH', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1205, 12, 'KABUPATEN TAPANULI UTARA', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1206, 12, 'KABUPATEN TOBA SAMOSIR', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1207, 12, 'KABUPATEN LABUHAN BATU', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1208, 12, 'KABUPATEN ASAHAN', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1209, 12, 'KABUPATEN SIMALUNGUN', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1210, 12, 'KABUPATEN DAIRI', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1211, 12, 'KABUPATEN KARO', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1212, 12, 'KABUPATEN DELI SERDANG', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1213, 12, 'KABUPATEN LANGKAT', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1214, 12, 'KABUPATEN NIAS SELATAN', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1215, 12, 'KABUPATEN HUMBANG HASUNDUTAN', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1216, 12, 'KABUPATEN PAKPAK BHARAT', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1217, 12, 'KABUPATEN SAMOSIR', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1218, 12, 'KABUPATEN SERDANG BEDAGAI', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1219, 12, 'KABUPATEN BATU BARA', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1220, 12, 'KABUPATEN PADANG LAWAS UTARA', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1221, 12, 'KABUPATEN PADANG LAWAS', '2019-11-15 03:41:34', '2019-11-15 03:41:34'),
(1222, 12, 'KABUPATEN LABUHAN BATU SELATAN', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1223, 12, 'KABUPATEN LABUHAN BATU UTARA', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1224, 12, 'KABUPATEN NIAS UTARA', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1225, 12, 'KABUPATEN NIAS BARAT', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1271, 12, 'KOTA SIBOLGA', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1272, 12, 'KOTA TANJUNG BALAI', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1273, 12, 'KOTA PEMATANG SIANTAR', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1274, 12, 'KOTA TEBING TINGGI', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1275, 12, 'KOTA MEDAN', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1276, 12, 'KOTA BINJAI', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1277, 12, 'KOTA PADANGSIDIMPUAN', '2019-11-15 03:41:35', '2019-11-15 03:41:35'),
(1278, 12, 'KOTA GUNUNGSITOLI', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1301, 13, 'KABUPATEN KEPULAUAN MENTAWAI', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1302, 13, 'KABUPATEN PESISIR SELATAN', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1303, 13, 'KABUPATEN SOLOK', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1304, 13, 'KABUPATEN SIJUNJUNG', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1305, 13, 'KABUPATEN TANAH DATAR', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1306, 13, 'KABUPATEN PADANG PARIAMAN', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1307, 13, 'KABUPATEN AGAM', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1308, 13, 'KABUPATEN LIMA PULUH KOTA', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1309, 13, 'KABUPATEN PASAMAN', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1310, 13, 'KABUPATEN SOLOK SELATAN', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1311, 13, 'KABUPATEN DHARMASRAYA', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1312, 13, 'KABUPATEN PASAMAN BARAT', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1371, 13, 'KOTA PADANG', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1372, 13, 'KOTA SOLOK', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1373, 13, 'KOTA SAWAH LUNTO', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1374, 13, 'KOTA PADANG PANJANG', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1375, 13, 'KOTA BUKITTINGGI', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1376, 13, 'KOTA PAYAKUMBUH', '2019-11-15 03:41:36', '2019-11-15 03:41:36'),
(1377, 13, 'KOTA PARIAMAN', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1401, 14, 'KABUPATEN KUANTAN SINGINGI', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1402, 14, 'KABUPATEN INDRAGIRI HULU', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1403, 14, 'KABUPATEN INDRAGIRI HILIR', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1404, 14, 'KABUPATEN PELALAWAN', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1405, 14, 'KABUPATEN S I A K', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1406, 14, 'KABUPATEN KAMPAR', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1407, 14, 'KABUPATEN ROKAN HULU', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1408, 14, 'KABUPATEN BENGKALIS', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1409, 14, 'KABUPATEN ROKAN HILIR', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1410, 14, 'KABUPATEN KEPULAUAN MERANTI', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1471, 14, 'KOTA PEKANBARU', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1473, 14, 'KOTA D U M A I', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1501, 15, 'KABUPATEN KERINCI', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1502, 15, 'KABUPATEN MERANGIN', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1503, 15, 'KABUPATEN SAROLANGUN', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1504, 15, 'KABUPATEN BATANG HARI', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1505, 15, 'KABUPATEN MUARO JAMBI', '2019-11-15 03:41:37', '2019-11-15 03:41:37'),
(1506, 15, 'KABUPATEN TANJUNG JABUNG TIMUR', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1507, 15, 'KABUPATEN TANJUNG JABUNG BARAT', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1508, 15, 'KABUPATEN TEBO', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1509, 15, 'KABUPATEN BUNGO', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1571, 15, 'KOTA JAMBI', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1572, 15, 'KOTA SUNGAI PENUH', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1601, 16, 'KABUPATEN OGAN KOMERING ULU', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1602, 16, 'KABUPATEN OGAN KOMERING ILIR', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1603, 16, 'KABUPATEN MUARA ENIM', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1604, 16, 'KABUPATEN LAHAT', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1605, 16, 'KABUPATEN MUSI RAWAS', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1606, 16, 'KABUPATEN MUSI BANYUASIN', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1607, 16, 'KABUPATEN BANYU ASIN', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1608, 16, 'KABUPATEN OGAN KOMERING ULU SELATAN', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1609, 16, 'KABUPATEN OGAN KOMERING ULU TIMUR', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1610, 16, 'KABUPATEN OGAN ILIR', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1611, 16, 'KABUPATEN EMPAT LAWANG', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1612, 16, 'KABUPATEN PENUKAL ABAB LEMATANG ILIR', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1613, 16, 'KABUPATEN MUSI RAWAS UTARA', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1671, 16, 'KOTA PALEMBANG', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1672, 16, 'KOTA PRABUMULIH', '2019-11-15 03:41:38', '2019-11-15 03:41:38'),
(1673, 16, 'KOTA PAGAR ALAM', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1674, 16, 'KOTA LUBUKLINGGAU', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1701, 17, 'KABUPATEN BENGKULU SELATAN', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1702, 17, 'KABUPATEN REJANG LEBONG', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1703, 17, 'KABUPATEN BENGKULU UTARA', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1704, 17, 'KABUPATEN KAUR', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1705, 17, 'KABUPATEN SELUMA', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1706, 17, 'KABUPATEN MUKOMUKO', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1707, 17, 'KABUPATEN LEBONG', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1708, 17, 'KABUPATEN KEPAHIANG', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1709, 17, 'KABUPATEN BENGKULU TENGAH', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1771, 17, 'KOTA BENGKULU', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1801, 18, 'KABUPATEN LAMPUNG BARAT', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1802, 18, 'KABUPATEN TANGGAMUS', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1803, 18, 'KABUPATEN LAMPUNG SELATAN', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1804, 18, 'KABUPATEN LAMPUNG TIMUR', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1805, 18, 'KABUPATEN LAMPUNG TENGAH', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1806, 18, 'KABUPATEN LAMPUNG UTARA', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1807, 18, 'KABUPATEN WAY KANAN', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1808, 18, 'KABUPATEN TULANGBAWANG', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1809, 18, 'KABUPATEN PESAWARAN', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1810, 18, 'KABUPATEN PRINGSEWU', '2019-11-15 03:41:39', '2019-11-15 03:41:39'),
(1811, 18, 'KABUPATEN MESUJI', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1812, 18, 'KABUPATEN TULANG BAWANG BARAT', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1813, 18, 'KABUPATEN PESISIR BARAT', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1871, 18, 'KOTA BANDAR LAMPUNG', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1872, 18, 'KOTA METRO', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1901, 19, 'KABUPATEN BANGKA', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1902, 19, 'KABUPATEN BELITUNG', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1903, 19, 'KABUPATEN BANGKA BARAT', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1904, 19, 'KABUPATEN BANGKA TENGAH', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1905, 19, 'KABUPATEN BANGKA SELATAN', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1906, 19, 'KABUPATEN BELITUNG TIMUR', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(1971, 19, 'KOTA PANGKAL PINANG', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(2101, 21, 'KABUPATEN KARIMUN', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(2102, 21, 'KABUPATEN BINTAN', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(2103, 21, 'KABUPATEN NATUNA', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(2104, 21, 'KABUPATEN LINGGA', '2019-11-15 03:41:40', '2019-11-15 03:41:40'),
(2105, 21, 'KABUPATEN KEPULAUAN ANAMBAS', '2019-11-15 03:41:41', '2019-11-15 03:41:41'),
(2171, 21, 'KOTA B A T A M', '2019-11-15 03:41:41', '2019-11-15 03:41:41'),
(2172, 21, 'KOTA TANJUNG PINANG', '2019-11-15 03:41:41', '2019-11-15 03:41:41'),
(3101, 31, 'KABUPATEN KEPULAUAN SERIBU', '2019-11-15 03:41:41', '2019-11-15 03:41:41'),
(3171, 31, 'KOTA JAKARTA SELATAN', '2019-11-15 03:41:41', '2019-11-15 03:41:41'),
(3172, 31, 'KOTA JAKARTA TIMUR', '2019-11-15 03:41:41', '2019-11-15 03:41:41'),
(3173, 31, 'KOTA JAKARTA PUSAT', '2019-11-15 03:41:41', '2019-11-15 03:41:41'),
(3174, 31, 'KOTA JAKARTA BARAT', '2019-11-15 03:41:41', '2019-11-15 03:41:41'),
(3175, 31, 'KOTA JAKARTA UTARA', '2019-11-15 03:41:41', '2019-11-15 03:41:41'),
(3201, 32, 'KABUPATEN BOGOR', '2019-11-15 03:41:41', '2019-11-15 03:41:41'),
(3202, 32, 'KABUPATEN SUKABUMI', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3203, 32, 'KABUPATEN CIANJUR', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3204, 32, 'KABUPATEN BANDUNG', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3205, 32, 'KABUPATEN GARUT', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3206, 32, 'KABUPATEN TASIKMALAYA', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3207, 32, 'KABUPATEN CIAMIS', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3208, 32, 'KABUPATEN KUNINGAN', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3209, 32, 'KABUPATEN CIREBON', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3210, 32, 'KABUPATEN MAJALENGKA', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3211, 32, 'KABUPATEN SUMEDANG', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3212, 32, 'KABUPATEN INDRAMAYU', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3213, 32, 'KABUPATEN SUBANG', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3214, 32, 'KABUPATEN PURWAKARTA', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3215, 32, 'KABUPATEN KARAWANG', '2019-11-15 03:41:42', '2019-11-15 03:41:42'),
(3216, 32, 'KABUPATEN BEKASI', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3217, 32, 'KABUPATEN BANDUNG BARAT', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3218, 32, 'KABUPATEN PANGANDARAN', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3271, 32, 'KOTA BOGOR', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3272, 32, 'KOTA SUKABUMI', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3273, 32, 'KOTA BANDUNG', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3274, 32, 'KOTA CIREBON', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3275, 32, 'KOTA BEKASI', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3276, 32, 'KOTA DEPOK', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3277, 32, 'KOTA CIMAHI', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3278, 32, 'KOTA TASIKMALAYA', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3279, 32, 'KOTA BANJAR', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3301, 33, 'KABUPATEN CILACAP', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3302, 33, 'KABUPATEN BANYUMAS', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3303, 33, 'KABUPATEN PURBALINGGA', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3304, 33, 'KABUPATEN BANJARNEGARA', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3305, 33, 'KABUPATEN KEBUMEN', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3306, 33, 'KABUPATEN PURWOREJO', '2019-11-15 03:41:43', '2019-11-15 03:41:43'),
(3307, 33, 'KABUPATEN WONOSOBO', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3308, 33, 'KABUPATEN MAGELANG', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3309, 33, 'KABUPATEN BOYOLALI', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3310, 33, 'KABUPATEN KLATEN', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3311, 33, 'KABUPATEN SUKOHARJO', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3312, 33, 'KABUPATEN WONOGIRI', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3313, 33, 'KABUPATEN KARANGANYAR', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3314, 33, 'KABUPATEN SRAGEN', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3315, 33, 'KABUPATEN GROBOGAN', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3316, 33, 'KABUPATEN BLORA', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3317, 33, 'KABUPATEN REMBANG', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3318, 33, 'KABUPATEN PATI', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3319, 33, 'KABUPATEN KUDUS', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3320, 33, 'KABUPATEN JEPARA', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3321, 33, 'KABUPATEN DEMAK', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3322, 33, 'KABUPATEN SEMARANG', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3323, 33, 'KABUPATEN TEMANGGUNG', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3324, 33, 'KABUPATEN KENDAL', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3325, 33, 'KABUPATEN BATANG', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3326, 33, 'KABUPATEN PEKALONGAN', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3327, 33, 'KABUPATEN PEMALANG', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3328, 33, 'KABUPATEN TEGAL', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3329, 33, 'KABUPATEN BREBES', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3371, 33, 'KOTA MAGELANG', '2019-11-15 03:41:44', '2019-11-15 03:41:44'),
(3372, 33, 'KOTA SURAKARTA', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3373, 33, 'KOTA SALATIGA', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3374, 33, 'KOTA SEMARANG', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3375, 33, 'KOTA PEKALONGAN', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3376, 33, 'KOTA TEGAL', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3401, 34, 'KABUPATEN KULON PROGO', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3402, 34, 'KABUPATEN BANTUL', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3403, 34, 'KABUPATEN GUNUNG KIDUL', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3404, 34, 'KABUPATEN SLEMAN', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3471, 34, 'KOTA YOGYAKARTA', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3501, 35, 'KABUPATEN PACITAN', '2019-11-15 03:41:45', '2019-11-15 03:41:45'),
(3502, 35, 'KABUPATEN PONOROGO', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3503, 35, 'KABUPATEN TRENGGALEK', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3504, 35, 'KABUPATEN TULUNGAGUNG', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3505, 35, 'KABUPATEN BLITAR', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3506, 35, 'KABUPATEN KEDIRI', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3507, 35, 'KABUPATEN MALANG', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3508, 35, 'KABUPATEN LUMAJANG', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3509, 35, 'KABUPATEN JEMBER', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3510, 35, 'KABUPATEN BANYUWANGI', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3511, 35, 'KABUPATEN BONDOWOSO', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3512, 35, 'KABUPATEN SITUBONDO', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3513, 35, 'KABUPATEN PROBOLINGGO', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3514, 35, 'KABUPATEN PASURUAN', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3515, 35, 'KABUPATEN SIDOARJO', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3516, 35, 'KABUPATEN MOJOKERTO', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3517, 35, 'KABUPATEN JOMBANG', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3518, 35, 'KABUPATEN NGANJUK', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3519, 35, 'KABUPATEN MADIUN', '2019-11-15 03:41:46', '2019-11-15 03:41:46'),
(3520, 35, 'KABUPATEN MAGETAN', '2019-11-15 03:41:47', '2019-11-15 03:41:47'),
(3521, 35, 'KABUPATEN NGAWI', '2019-11-15 03:41:47', '2019-11-15 03:41:47'),
(3522, 35, 'KABUPATEN BOJONEGORO', '2019-11-15 03:41:47', '2019-11-15 03:41:47'),
(3523, 35, 'KABUPATEN TUBAN', '2019-11-15 03:41:47', '2019-11-15 03:41:47'),
(3524, 35, 'KABUPATEN LAMONGAN', '2019-11-15 03:41:47', '2019-11-15 03:41:47'),
(3525, 35, 'KABUPATEN GRESIK', '2019-11-15 03:41:47', '2019-11-15 03:41:47'),
(3526, 35, 'KABUPATEN BANGKALAN', '2019-11-15 03:41:47', '2019-11-15 03:41:47'),
(3527, 35, 'KABUPATEN SAMPANG', '2019-11-15 03:41:47', '2019-11-15 03:41:47'),
(3528, 35, 'KABUPATEN PAMEKASAN', '2019-11-15 03:41:47', '2019-11-15 03:41:47'),
(3529, 35, 'KABUPATEN SUMENEP', '2019-11-15 03:41:47', '2019-11-15 03:41:47'),
(3571, 35, 'KOTA KEDIRI', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3572, 35, 'KOTA BLITAR', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3573, 35, 'KOTA MALANG', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3574, 35, 'KOTA PROBOLINGGO', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3575, 35, 'KOTA PASURUAN', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3576, 35, 'KOTA MOJOKERTO', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3577, 35, 'KOTA MADIUN', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3578, 35, 'KOTA SURABAYA', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3579, 35, 'KOTA BATU', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3601, 36, 'KABUPATEN PANDEGLANG', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3602, 36, 'KABUPATEN LEBAK', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3603, 36, 'KABUPATEN TANGERANG', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3604, 36, 'KABUPATEN SERANG', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3671, 36, 'KOTA TANGERANG', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3672, 36, 'KOTA CILEGON', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3673, 36, 'KOTA SERANG', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(3674, 36, 'KOTA TANGERANG SELATAN', '2019-11-15 03:41:48', '2019-11-15 03:41:48'),
(5101, 51, 'KABUPATEN JEMBRANA', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5102, 51, 'KABUPATEN TABANAN', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5103, 51, 'KABUPATEN BADUNG', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5104, 51, 'KABUPATEN GIANYAR', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5105, 51, 'KABUPATEN KLUNGKUNG', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5106, 51, 'KABUPATEN BANGLI', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5107, 51, 'KABUPATEN KARANG ASEM', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5108, 51, 'KABUPATEN BULELENG', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5171, 51, 'KOTA DENPASAR', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5201, 52, 'KABUPATEN LOMBOK BARAT', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5202, 52, 'KABUPATEN LOMBOK TENGAH', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5203, 52, 'KABUPATEN LOMBOK TIMUR', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5204, 52, 'KABUPATEN SUMBAWA', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5205, 52, 'KABUPATEN DOMPU', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5206, 52, 'KABUPATEN BIMA', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5207, 52, 'KABUPATEN SUMBAWA BARAT', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5208, 52, 'KABUPATEN LOMBOK UTARA', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5271, 52, 'KOTA MATARAM', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5272, 52, 'KOTA BIMA', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5301, 53, 'KABUPATEN SUMBA BARAT', '2019-11-15 03:41:49', '2019-11-15 03:41:49'),
(5302, 53, 'KABUPATEN SUMBA TIMUR', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5303, 53, 'KABUPATEN KUPANG', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5304, 53, 'KABUPATEN TIMOR TENGAH SELATAN', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5305, 53, 'KABUPATEN TIMOR TENGAH UTARA', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5306, 53, 'KABUPATEN BELU', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5307, 53, 'KABUPATEN ALOR', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5308, 53, 'KABUPATEN LEMBATA', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5309, 53, 'KABUPATEN FLORES TIMUR', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5310, 53, 'KABUPATEN SIKKA', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5311, 53, 'KABUPATEN ENDE', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5312, 53, 'KABUPATEN NGADA', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5313, 53, 'KABUPATEN MANGGARAI', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5314, 53, 'KABUPATEN ROTE NDAO', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5315, 53, 'KABUPATEN MANGGARAI BARAT', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5316, 53, 'KABUPATEN SUMBA TENGAH', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5317, 53, 'KABUPATEN SUMBA BARAT DAYA', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5318, 53, 'KABUPATEN NAGEKEO', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5319, 53, 'KABUPATEN MANGGARAI TIMUR', '2019-11-15 03:41:50', '2019-11-15 03:41:50'),
(5320, 53, 'KABUPATEN SABU RAIJUA', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(5321, 53, 'KABUPATEN MALAKA', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(5371, 53, 'KOTA KUPANG', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6101, 61, 'KABUPATEN SAMBAS', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6102, 61, 'KABUPATEN BENGKAYANG', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6103, 61, 'KABUPATEN LANDAK', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6104, 61, 'KABUPATEN MEMPAWAH', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6105, 61, 'KABUPATEN SANGGAU', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6106, 61, 'KABUPATEN KETAPANG', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6107, 61, 'KABUPATEN SINTANG', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6108, 61, 'KABUPATEN KAPUAS HULU', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6109, 61, 'KABUPATEN SEKADAU', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6110, 61, 'KABUPATEN MELAWI', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6111, 61, 'KABUPATEN KAYONG UTARA', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6112, 61, 'KABUPATEN KUBU RAYA', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6171, 61, 'KOTA PONTIANAK', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6172, 61, 'KOTA SINGKAWANG', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6201, 62, 'KABUPATEN KOTAWARINGIN BARAT', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6202, 62, 'KABUPATEN KOTAWARINGIN TIMUR', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6203, 62, 'KABUPATEN KAPUAS', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6204, 62, 'KABUPATEN BARITO SELATAN', '2019-11-15 03:41:51', '2019-11-15 03:41:51'),
(6205, 62, 'KABUPATEN BARITO UTARA', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6206, 62, 'KABUPATEN SUKAMARA', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6207, 62, 'KABUPATEN LAMANDAU', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6208, 62, 'KABUPATEN SERUYAN', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6209, 62, 'KABUPATEN KATINGAN', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6210, 62, 'KABUPATEN PULANG PISAU', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6211, 62, 'KABUPATEN GUNUNG MAS', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6212, 62, 'KABUPATEN BARITO TIMUR', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6213, 62, 'KABUPATEN MURUNG RAYA', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6271, 62, 'KOTA PALANGKA RAYA', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6301, 63, 'KABUPATEN TANAH LAUT', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6302, 63, 'KABUPATEN KOTA BARU', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6303, 63, 'KABUPATEN BANJAR', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6304, 63, 'KABUPATEN BARITO KUALA', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6305, 63, 'KABUPATEN TAPIN', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6306, 63, 'KABUPATEN HULU SUNGAI SELATAN', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6307, 63, 'KABUPATEN HULU SUNGAI TENGAH', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6308, 63, 'KABUPATEN HULU SUNGAI UTARA', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6309, 63, 'KABUPATEN TABALONG', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6310, 63, 'KABUPATEN TANAH BUMBU', '2019-11-15 03:41:52', '2019-11-15 03:41:52'),
(6311, 63, 'KABUPATEN BALANGAN', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6371, 63, 'KOTA BANJARMASIN', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6372, 63, 'KOTA BANJAR BARU', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6401, 64, 'KABUPATEN PASER', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6402, 64, 'KABUPATEN KUTAI BARAT', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6403, 64, 'KABUPATEN KUTAI KARTANEGARA', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6404, 64, 'KABUPATEN KUTAI TIMUR', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6405, 64, 'KABUPATEN BERAU', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6409, 64, 'KABUPATEN PENAJAM PASER UTARA', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6411, 64, 'KABUPATEN MAHAKAM HULU', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6471, 64, 'KOTA BALIKPAPAN', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6472, 64, 'KOTA SAMARINDA', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6474, 64, 'KOTA BONTANG', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6501, 65, 'KABUPATEN MALINAU', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6502, 65, 'KABUPATEN BULUNGAN', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6503, 65, 'KABUPATEN TANA TIDUNG', '2019-11-15 03:41:53', '2019-11-15 03:41:53'),
(6504, 65, 'KABUPATEN NUNUKAN', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(6571, 65, 'KOTA TARAKAN', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(7101, 71, 'KABUPATEN BOLAANG MONGONDOW', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(7102, 71, 'KABUPATEN MINAHASA', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(7103, 71, 'KABUPATEN KEPULAUAN SANGIHE', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(7104, 71, 'KABUPATEN KEPULAUAN TALAUD', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(7105, 71, 'KABUPATEN MINAHASA SELATAN', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(7106, 71, 'KABUPATEN MINAHASA UTARA', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(7107, 71, 'KABUPATEN BOLAANG MONGONDOW UTARA', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(7108, 71, 'KABUPATEN SIAU TAGULANDANG BIARO', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(7109, 71, 'KABUPATEN MINAHASA TENGGARA', '2019-11-15 03:41:54', '2019-11-15 03:41:54'),
(7110, 71, 'KABUPATEN BOLAANG MONGONDOW SELATAN', '2019-11-15 03:41:55', '2019-11-15 03:41:55'),
(7111, 71, 'KABUPATEN BOLAANG MONGONDOW TIMUR', '2019-11-15 03:41:55', '2019-11-15 03:41:55'),
(7171, 71, 'KOTA MANADO', '2019-11-15 03:41:55', '2019-11-15 03:41:55'),
(7172, 71, 'KOTA BITUNG', '2019-11-15 03:41:55', '2019-11-15 03:41:55'),
(7173, 71, 'KOTA TOMOHON', '2019-11-15 03:41:55', '2019-11-15 03:41:55'),
(7174, 71, 'KOTA KOTAMOBAGU', '2019-11-15 03:41:55', '2019-11-15 03:41:55'),
(7201, 72, 'KABUPATEN BANGGAI KEPULAUAN', '2019-11-15 03:41:55', '2019-11-15 03:41:55'),
(7202, 72, 'KABUPATEN BANGGAI', '2019-11-15 03:41:55', '2019-11-15 03:41:55'),
(7203, 72, 'KABUPATEN MOROWALI', '2019-11-15 03:41:55', '2019-11-15 03:41:55'),
(7204, 72, 'KABUPATEN POSO', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7205, 72, 'KABUPATEN DONGGALA', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7206, 72, 'KABUPATEN TOLI-TOLI', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7207, 72, 'KABUPATEN BUOL', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7208, 72, 'KABUPATEN PARIGI MOUTONG', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7209, 72, 'KABUPATEN TOJO UNA-UNA', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7210, 72, 'KABUPATEN SIGI', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7211, 72, 'KABUPATEN BANGGAI LAUT', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7212, 72, 'KABUPATEN MOROWALI UTARA', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7271, 72, 'KOTA PALU', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7301, 73, 'KABUPATEN KEPULAUAN SELAYAR', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7302, 73, 'KABUPATEN BULUKUMBA', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7303, 73, 'KABUPATEN BANTAENG', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7304, 73, 'KABUPATEN JENEPONTO', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7305, 73, 'KABUPATEN TAKALAR', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7306, 73, 'KABUPATEN GOWA', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7307, 73, 'KABUPATEN SINJAI', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7308, 73, 'KABUPATEN MAROS', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7309, 73, 'KABUPATEN PANGKAJENE DAN KEPULAUAN', '2019-11-15 03:41:56', '2019-11-15 03:41:56'),
(7310, 73, 'KABUPATEN BARRU', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7311, 73, 'KABUPATEN BONE', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7312, 73, 'KABUPATEN SOPPENG', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7313, 73, 'KABUPATEN WAJO', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7314, 73, 'KABUPATEN SIDENRENG RAPPANG', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7315, 73, 'KABUPATEN PINRANG', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7316, 73, 'KABUPATEN ENREKANG', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7317, 73, 'KABUPATEN LUWU', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7318, 73, 'KABUPATEN TANA TORAJA', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7322, 73, 'KABUPATEN LUWU UTARA', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7325, 73, 'KABUPATEN LUWU TIMUR', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7326, 73, 'KABUPATEN TORAJA UTARA', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7371, 73, 'KOTA MAKASSAR', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7372, 73, 'KOTA PAREPARE', '2019-11-15 03:41:57', '2019-11-15 03:41:57'),
(7373, 73, 'KOTA PALOPO', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7401, 74, 'KABUPATEN BUTON', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7402, 74, 'KABUPATEN MUNA', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7403, 74, 'KABUPATEN KONAWE', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7404, 74, 'KABUPATEN KOLAKA', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7405, 74, 'KABUPATEN KONAWE SELATAN', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7406, 74, 'KABUPATEN BOMBANA', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7407, 74, 'KABUPATEN WAKATOBI', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7408, 74, 'KABUPATEN KOLAKA UTARA', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7409, 74, 'KABUPATEN BUTON UTARA', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7410, 74, 'KABUPATEN KONAWE UTARA', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7411, 74, 'KABUPATEN KOLAKA TIMUR', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7412, 74, 'KABUPATEN KONAWE KEPULAUAN', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7413, 74, 'KABUPATEN MUNA BARAT', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7414, 74, 'KABUPATEN BUTON TENGAH', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7415, 74, 'KABUPATEN BUTON SELATAN', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7471, 74, 'KOTA KENDARI', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7472, 74, 'KOTA BAUBAU', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7501, 75, 'KABUPATEN BOALEMO', '2019-11-15 03:41:58', '2019-11-15 03:41:58'),
(7502, 75, 'KABUPATEN GORONTALO', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(7503, 75, 'KABUPATEN POHUWATO', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(7504, 75, 'KABUPATEN BONE BOLANGO', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(7505, 75, 'KABUPATEN GORONTALO UTARA', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(7571, 75, 'KOTA GORONTALO', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(7601, 76, 'KABUPATEN MAJENE', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(7602, 76, 'KABUPATEN POLEWALI MANDAR', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(7603, 76, 'KABUPATEN MAMASA', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(7604, 76, 'KABUPATEN MAMUJU', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(7605, 76, 'KABUPATEN MAMUJU UTARA', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(7606, 76, 'KABUPATEN MAMUJU TENGAH', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(8101, 81, 'KABUPATEN MALUKU TENGGARA BARAT', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(8102, 81, 'KABUPATEN MALUKU TENGGARA', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(8103, 81, 'KABUPATEN MALUKU TENGAH', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(8104, 81, 'KABUPATEN BURU', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(8105, 81, 'KABUPATEN KEPULAUAN ARU', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(8106, 81, 'KABUPATEN SERAM BAGIAN BARAT', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(8107, 81, 'KABUPATEN SERAM BAGIAN TIMUR', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(8108, 81, 'KABUPATEN MALUKU BARAT DAYA', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(8109, 81, 'KABUPATEN BURU SELATAN', '2019-11-15 03:41:59', '2019-11-15 03:41:59'),
(8171, 81, 'KOTA AMBON', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8172, 81, 'KOTA TUAL', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8201, 82, 'KABUPATEN HALMAHERA BARAT', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8202, 82, 'KABUPATEN HALMAHERA TENGAH', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8203, 82, 'KABUPATEN KEPULAUAN SULA', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8204, 82, 'KABUPATEN HALMAHERA SELATAN', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8205, 82, 'KABUPATEN HALMAHERA UTARA', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8206, 82, 'KABUPATEN HALMAHERA TIMUR', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8207, 82, 'KABUPATEN PULAU MOROTAI', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8208, 82, 'KABUPATEN PULAU TALIABU', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8271, 82, 'KOTA TERNATE', '2019-11-15 03:42:00', '2019-11-15 03:42:00'),
(8272, 82, 'KOTA TIDORE KEPULAUAN', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9101, 91, 'KABUPATEN FAKFAK', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9102, 91, 'KABUPATEN KAIMANA', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9103, 91, 'KABUPATEN TELUK WONDAMA', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9104, 91, 'KABUPATEN TELUK BINTUNI', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9105, 91, 'KABUPATEN MANOKWARI', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9106, 91, 'KABUPATEN SORONG SELATAN', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9107, 91, 'KABUPATEN SORONG', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9108, 91, 'KABUPATEN RAJA AMPAT', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9109, 91, 'KABUPATEN TAMBRAUW', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9110, 91, 'KABUPATEN MAYBRAT', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9111, 91, 'KABUPATEN MANOKWARI SELATAN', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9112, 91, 'KABUPATEN PEGUNUNGAN ARFAK', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9171, 91, 'KOTA SORONG', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9401, 94, 'KABUPATEN MERAUKE', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9402, 94, 'KABUPATEN JAYAWIJAYA', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9403, 94, 'KABUPATEN JAYAPURA', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9404, 94, 'KABUPATEN NABIRE', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9408, 94, 'KABUPATEN KEPULAUAN YAPEN', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9409, 94, 'KABUPATEN BIAK NUMFOR', '2019-11-15 03:42:01', '2019-11-15 03:42:01'),
(9410, 94, 'KABUPATEN PANIAI', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9411, 94, 'KABUPATEN PUNCAK JAYA', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9412, 94, 'KABUPATEN MIMIKA', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9413, 94, 'KABUPATEN BOVEN DIGOEL', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9414, 94, 'KABUPATEN MAPPI', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9415, 94, 'KABUPATEN ASMAT', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9416, 94, 'KABUPATEN YAHUKIMO', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9417, 94, 'KABUPATEN PEGUNUNGAN BINTANG', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9418, 94, 'KABUPATEN TOLIKARA', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9419, 94, 'KABUPATEN SARMI', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9420, 94, 'KABUPATEN KEEROM', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9426, 94, 'KABUPATEN WAROPEN', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9427, 94, 'KABUPATEN SUPIORI', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9428, 94, 'KABUPATEN MAMBERAMO RAYA', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9429, 94, 'KABUPATEN NDUGA', '2019-11-15 03:42:02', '2019-11-15 03:42:02'),
(9430, 94, 'KABUPATEN LANNY JAYA', '2019-11-15 03:42:03', '2019-11-15 03:42:03'),
(9431, 94, 'KABUPATEN MAMBERAMO TENGAH', '2019-11-15 03:42:03', '2019-11-15 03:42:03'),
(9432, 94, 'KABUPATEN YALIMO', '2019-11-15 03:42:03', '2019-11-15 03:42:03'),
(9433, 94, 'KABUPATEN PUNCAK', '2019-11-15 03:42:03', '2019-11-15 03:42:03'),
(9434, 94, 'KABUPATEN DOGIYAI', '2019-11-15 03:42:03', '2019-11-15 03:42:03'),
(9435, 94, 'KABUPATEN INTAN JAYA', '2019-11-15 03:42:03', '2019-11-15 03:42:03'),
(9436, 94, 'KABUPATEN DEIYAI', '2019-11-15 03:42:03', '2019-11-15 03:42:03'),
(9471, 94, 'KOTA JAYAPURA', '2019-11-15 03:42:03', '2019-11-15 03:42:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wilayah_provinsi`
--

CREATE TABLE `wilayah_provinsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wilayah_provinsi`
--

INSERT INTO `wilayah_provinsi` (`id`, `name`, `created_at`, `updated_at`) VALUES
(11, 'ACEH', '2019-11-15 03:42:21', '2019-11-15 03:42:21'),
(12, 'SUMATERA UTARA', '2019-11-15 03:42:21', '2019-11-15 03:42:21'),
(13, 'SUMATERA BARAT', '2019-11-15 03:42:21', '2019-11-15 03:42:21'),
(14, 'RIAU', '2019-11-15 03:42:21', '2019-11-15 03:42:21'),
(15, 'JAMBI', '2019-11-15 03:42:22', '2019-11-15 03:42:22'),
(16, 'SUMATERA SELATAN', '2019-11-15 03:42:22', '2019-11-15 03:42:22'),
(17, 'BENGKULU', '2019-11-15 03:42:22', '2019-11-15 03:42:22'),
(18, 'LAMPUNG', '2019-11-15 03:42:22', '2019-11-15 03:42:22'),
(19, 'KEPULAUAN BANGKA BELITUNG', '2019-11-15 03:42:22', '2019-11-15 03:42:22'),
(21, 'KEPULAUAN RIAU', '2019-11-15 03:42:22', '2019-11-15 03:42:22'),
(31, 'DKI JAKARTA', '2019-11-15 03:42:22', '2019-11-15 03:42:22'),
(32, 'JAWA BARAT', '2019-11-15 03:42:22', '2019-11-15 03:42:22'),
(33, 'JAWA TENGAH', '2019-11-15 03:42:22', '2019-11-15 03:42:22'),
(34, 'DI YOGYAKARTA', '2019-11-15 03:42:22', '2019-11-15 03:42:22'),
(35, 'JAWA TIMUR', '2019-11-15 03:42:23', '2019-11-15 03:42:23'),
(36, 'BANTEN', '2019-11-15 03:42:23', '2019-11-15 03:42:23'),
(51, 'BALI', '2019-11-15 03:42:23', '2019-11-15 03:42:23'),
(52, 'NUSA TENGGARA BARAT', '2019-11-15 03:42:23', '2019-11-15 03:42:23'),
(53, 'NUSA TENGGARA TIMUR', '2019-11-15 03:42:23', '2019-11-15 03:42:23'),
(61, 'KALIMANTAN BARAT', '2019-11-15 03:42:23', '2019-11-15 03:42:23'),
(62, 'KALIMANTAN TENGAH', '2019-11-15 03:42:23', '2019-11-15 03:42:23'),
(63, 'KALIMANTAN SELATAN', '2019-11-15 03:42:23', '2019-11-15 03:42:23'),
(64, 'KALIMANTAN TIMUR', '2019-11-15 03:42:23', '2019-11-15 03:42:23'),
(65, 'KALIMANTAN UTARA', '2019-11-15 03:42:24', '2019-11-15 03:42:24'),
(71, 'SULAWESI UTARA', '2019-11-15 03:42:24', '2019-11-15 03:42:24'),
(72, 'SULAWESI TENGAH', '2019-11-15 03:42:24', '2019-11-15 03:42:24'),
(73, 'SULAWESI SELATAN', '2019-11-15 03:42:24', '2019-11-15 03:42:24'),
(74, 'SULAWESI TENGGARA', '2019-11-15 03:42:24', '2019-11-15 03:42:24'),
(75, 'GORONTALO', '2019-11-15 03:42:24', '2019-11-15 03:42:24'),
(76, 'SULAWESI BARAT', '2019-11-15 03:42:24', '2019-11-15 03:42:24'),
(81, 'MALUKU', '2019-11-15 03:42:24', '2019-11-15 03:42:24'),
(82, 'MALUKU UTARA', '2019-11-15 03:42:24', '2019-11-15 03:42:24'),
(91, 'PAPUA BARAT', '2019-11-15 03:42:24', '2019-11-15 03:42:24'),
(94, 'PAPUA', '2019-11-15 03:42:24', '2019-11-15 03:42:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_dealer`
--
ALTER TABLE `ms_dealer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_harga`
--
ALTER TABLE `ms_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_kendaraan`
--
ALTER TABLE `ms_kendaraan`
  ADD PRIMARY KEY (`tipe`);

--
-- Indeks untuk tabel `ms_samsat`
--
ALTER TABLE `ms_samsat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `po_bpkb_dealer`
--
ALTER TABLE `po_bpkb_dealer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `po_bpkb_samsat`
--
ALTER TABLE `po_bpkb_samsat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `po_mst`
--
ALTER TABLE `po_mst`
  ADD PRIMARY KEY (`no_po`);

--
-- Indeks untuk tabel `po_plat_dealer`
--
ALTER TABLE `po_plat_dealer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `po_plat_samsat`
--
ALTER TABLE `po_plat_samsat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `po_stnk_dealer`
--
ALTER TABLE `po_stnk_dealer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `po_stnk_samsat`
--
ALTER TABLE `po_stnk_samsat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `po_trns`
--
ALTER TABLE `po_trns`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sys_menus`
--
ALTER TABLE `sys_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sys_menu_groups`
--
ALTER TABLE `sys_menu_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sys_permissions`
--
ALTER TABLE `sys_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sys_profile`
--
ALTER TABLE `sys_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `wilayah_kota`
--
ALTER TABLE `wilayah_kota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wilayah_provinsi`
--
ALTER TABLE `wilayah_provinsi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `ms_dealer`
--
ALTER TABLE `ms_dealer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ms_harga`
--
ALTER TABLE `ms_harga`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ms_samsat`
--
ALTER TABLE `ms_samsat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `po_bpkb_dealer`
--
ALTER TABLE `po_bpkb_dealer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `po_bpkb_samsat`
--
ALTER TABLE `po_bpkb_samsat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `po_plat_dealer`
--
ALTER TABLE `po_plat_dealer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `po_plat_samsat`
--
ALTER TABLE `po_plat_samsat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `po_stnk_dealer`
--
ALTER TABLE `po_stnk_dealer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `po_stnk_samsat`
--
ALTER TABLE `po_stnk_samsat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `po_trns`
--
ALTER TABLE `po_trns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `sys_menus`
--
ALTER TABLE `sys_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `sys_menu_groups`
--
ALTER TABLE `sys_menu_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sys_permissions`
--
ALTER TABLE `sys_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `sys_profile`
--
ALTER TABLE `sys_profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `wilayah_kota`
--
ALTER TABLE `wilayah_kota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9472;

--
-- AUTO_INCREMENT untuk tabel `wilayah_provinsi`
--
ALTER TABLE `wilayah_provinsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
