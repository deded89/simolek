-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2019 at 03:18 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simolek_p`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `nama`) VALUES
(1, 'Barang'),
(2, 'Pekerjaan Konstruksi'),
(3, 'Jasa Konsultansi'),
(4, 'Jasa Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi_img`
--

CREATE TABLE `kondisi_img` (
  `id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(200) NOT NULL,
  `pekerjaan` int(10) UNSIGNED NOT NULL,
  `kondisi` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kondisi_img`
--

INSERT INTO `kondisi_img` (`id`, `filename`, `pekerjaan`, `kondisi`) VALUES
(36, '0_24.JPG', 24, 0),
(37, '100_24.jpg', 24, 100);

-- --------------------------------------------------------

--
-- Table structure for table `kontrak`
--

CREATE TABLE `kontrak` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `penyedia` varchar(200) NOT NULL,
  `nilai` decimal(15,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `lama` varchar(50) NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL,
  `ket` varchar(200) NOT NULL,
  `pekerjaan` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`id`, `nomor`, `tanggal`, `penyedia`, `nilai`, `lama`, `awal`, `akhir`, `ket`, `pekerjaan`) VALUES
(15, 'xxxx', '2019-09-11', 'PT. abc', '1000000000.00', '80 Hari Kalender', '2019-09-11', '2019-11-30', '-', 24);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `latitude` decimal(15,9) NOT NULL,
  `longitude` decimal(15,9) NOT NULL,
  `deskripsi` varchar(300) NOT NULL,
  `pekerjaan` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `latitude`, `longitude`, `deskripsi`, `pekerjaan`) VALUES
(16, '-3.318031980', '114.584612846', 'Dinas Pendidikan', 24);

-- --------------------------------------------------------

--
-- Table structure for table `metode`
--

CREATE TABLE `metode` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode`
--

INSERT INTO `metode` (`id`, `nama`) VALUES
(2, 'Tender'),
(3, 'Tender Cepat'),
(4, 'E-Purchasing'),
(5, 'Seleksi');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL,
  `kegiatan` varchar(200) NOT NULL,
  `skpd` mediumint(8) UNSIGNED NOT NULL,
  `jenis` tinyint(4) UNSIGNED NOT NULL,
  `metode` tinyint(4) UNSIGNED NOT NULL,
  `pagu` decimal(15,2) NOT NULL,
  `progress_now` tinyint(3) UNSIGNED DEFAULT '9',
  `user` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `nama`, `kegiatan`, `skpd`, `jenis`, `metode`, `pagu`, `progress_now`, `user`) VALUES
(14, 'Penyusunan Rencana Pengembangan Kawasan Industri Terpadu Mantuil Kota Banjarmasin', 'Koordinasi  Perencanaan  Pembangunan  Sub Bidang   Ekonomi Hulu', 40, 3, 5, '300000000.00', 9, NULL),
(15, 'Pembangunan Gedung TK Pembina Negeri Banjarmasin Selatan (Pembangunan Unit Sekolah Baru (USB) TK Negeri)', 'Pembangunan Gedung Sekolah', 1, 2, 2, '1337873000.00', 1, NULL),
(16, 'Pembangunan Gedung TK Pembina Negeri Banjarmasin Utara (lanjutan)', 'Pembangunan Gedung Sekolah', 1, 2, 2, '798355000.00', 9, NULL),
(17, 'Pembangunan Gedung TK Pembina Negeri Banjarmasin Timur', 'Pembangunan Gedung Sekolah', 1, 2, 2, '1794975000.00', 1, NULL),
(18, 'Belanja modal pengadaan Personal Komputer (Pengadaan Komputer) DAK SKB', 'Pengadaan Peralatan Pendidikan (DAK SKB)', 1, 1, 4, '260000000.00', 9, NULL),
(19, 'Penambahan Ruang Kelas SDN Sungai Andai 3 (lanjutan)', 'Penambahan Ruang Kelas Sekolah', 1, 2, 2, '400000000.00', 9, NULL),
(20, 'Penambahan Ruang Kelas SDN Pasar Lama 3 (2 Kelas)', 'Penambahan Ruang Kelas Sekolah', 1, 2, 2, '1025000000.00', 9, NULL),
(21, 'Pembangunan Gedung Perpustakaan Sekolah SDN Basirih 10 (Tahap 1)', 'Pembangunan Perpustakaan Sekolah', 1, 2, 2, '260000000.00', 9, NULL),
(22, 'Belanja Pengadaan Kursi SDN', 'Pengadaan Mebeluer Sekolah', 1, 1, 4, '242060000.00', 9, NULL),
(23, 'Belanja Pengadaan Meja SDN', 'Pengadaan Mebeluer Sekolah', 1, 1, 4, '347165000.00', 9, NULL),
(24, 'Pengadaan Buku Koleksi Perpustakaan (DAK SD)', 'Pengadaan Buku Koleksi Perpustakaan (DAK SD)', 1, 1, 4, '1850000000.00', 5, 43),
(26, 'Pengadaan Komputer', 'Pengadaan Peralatan Penunjang UNBK SMP', 1, 1, 4, '492225000.00', 9, NULL),
(27, 'Pengadaan Meja SMPN', 'Pengadaan Mebeleur SMP', 1, 1, 4, '595791000.00', 9, NULL),
(28, 'Pengadaan Kursi SMPN', 'Pengadaan Mebeleur SMP', 1, 1, 4, '399693000.00', 9, NULL),
(29, 'Belanja Cetak Cover Raport K13 SD', '-', 1, 4, 3, '590940000.00', 9, NULL),
(30, 'Pengadaan Alat Laboratorium Biologi (DAK SMP)', '-', 1, 1, 4, '163000000.00', 9, NULL),
(31, 'Belanja Modal Pengadaan Sentrifuge', 'Pengadaan Alat Medis Puskesmas', 2, 1, 4, '401950000.00', 9, NULL),
(32, 'Belanja Modal Pengadaan Alat Kedokteran Bagian Penyakit Dalam', 'Pengadaan Alat Medis Puskesmas', 2, 1, 4, '299874460.00', 9, NULL),
(33, 'Belanja Modal Pengadaan Alat Kedokteran Bedah', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', 2, 1, 4, '6778636415.00', 9, NULL),
(34, 'Belanja Modal Pengadaan Alat Kedokteran Gawat Darurat', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', 2, 1, 4, '1262356600.00', 9, NULL),
(35, 'Belanja Modal Pengadaan Alat Kedokteran Gigi', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', 2, 1, 4, '1193911225.00', 9, NULL),
(36, 'Belanja Modal Pengadaan Alat Kedokteran Radiologi', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', 2, 1, 4, '3829886700.00', 9, NULL),
(37, 'Belanja Modal Pengadaan Alat Kesehatan Kebidanan dan Penyakit Kandungan', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', 2, 1, 4, '2047342660.00', 9, NULL),
(38, 'Belanja Modal Pengadaan Alat Kesehatan Perawatan', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', 2, 1, 4, '579627972.00', 9, NULL),
(39, 'Belanja Modal Pengadaan Alat Laboratorium Hematologi', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', 2, 1, 4, '564601000.00', 9, NULL),
(40, 'Belanja Modal Pengadaan Alat Laboratorium Kimia', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', 2, 1, 4, '1186988421.00', 9, NULL),
(41, 'Belanja Modal Pengadaan Alat Laboratorium Lainnya', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', 2, 1, 4, '331465518.00', 9, NULL),
(42, 'Belanja Pengadaan Sterilisasi', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', 2, 1, 4, '2900700000.00', 9, NULL),
(43, 'Belanja modal pengadaan Peralatan Studio Visual', 'Pengadaan Alat-alat Non Medis Rumah Sakit', 2, 1, 4, '324000000.00', 9, NULL),
(44, 'Belanja modal pengadaan Personal Komputer', 'Pengadaan Alat-alat Non Medis Rumah Sakit', 2, 1, 4, '904250000.00', 9, NULL),
(45, 'Belanja Alat-Alat Kesehatan', 'Pengadaan obat-obatan RS', 2, 1, 4, '200800000.00', 9, NULL),
(46, 'Belanja bahan obat-obatan', 'Pengadaan obat-obatan RS', 2, 1, 4, '530145000.00', 9, NULL),
(47, 'Belanja Bahan Obat-Obatan Generik', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', 2, 1, 4, '1973800000.00', 9, NULL),
(48, 'Belanja Bahan Obat-Obatan Gigi', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', 2, 1, 4, '253600000.00', 9, NULL),
(49, 'Belanja Reagent Hematologi Analizer A Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', 2, 1, 4, '200850000.00', NULL, NULL),
(50, 'Belanja Reagent Hematologi Analizer B Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', 2, 1, 4, '200850000.00', NULL, NULL),
(51, 'Belanja Reagent HIV dan Syphilis', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', 2, 1, 4, '200850000.00', 9, NULL),
(52, 'Belanja Reagent Klinis A Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', 2, 1, 4, '200850000.00', 9, NULL),
(53, 'Belanja Reagent Klinis B Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', 2, 1, 4, '200850000.00', NULL, NULL),
(54, 'Belanja Reagent Klinis C Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', 2, 1, 4, '200850000.00', NULL, NULL),
(55, 'Belanja Reagent Stik Untuk Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', 2, 1, 4, '200850000.00', 9, NULL),
(56, 'DED Pembangunan/Rehab Total Puskesmas Kayu Tangi  (Dana Insentif Daerah)', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', 2, 3, 2, '220400000.00', 9, NULL),
(57, 'Pembangunan Pustu Simpang Limau (Dana Insentif Daerah', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', 2, 2, 2, '453900000.00', 9, NULL),
(58, 'Rehab Sedang Rumah Dinas Puskesmas Terminal (Dana Insentif Daerah)', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', 2, 2, 2, '353250000.00', 9, NULL),
(59, 'Belanja Bahan Obat-Obatan Penunjang (Belanja Bahan Obat-Obatan Penunjang, Poliklinik Pemko, Program Gizi)', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', 2, 1, 3, '1599400000.00', 9, NULL),
(60, 'Belanja cetak', 'Pembinaan Pelayanan Kesehatan Usia Lanjut', 2, 1, 2, '573750000.00', 9, NULL),
(61, 'Belanja Modal Pengadaan Program/aplikasi/software/operating system', 'Pengadaan Alat-alat Non Medis Rumah Sakit', 2, 1, 2, '836102600.00', 9, NULL),
(62, 'Normalisasi Sungai Andai ke Sungai Gampa', 'Pelaksanaan Normalisasi Saluran Sungai Kecil', 3, 2, 2, '419900000.00', 9, NULL),
(63, 'Normalisasi Sungai Lumbah', 'Pelaksanaan Normalisasi Saluran Sungai Kecil', 3, 2, 2, '418000000.00', 9, NULL),
(64, 'Pengadaan Alat Listrik', 'Pemasangan dan Peningkatan Mutu Penerangan Jalan Umum (PJU)', 3, 1, 2, '998784400.00', 9, NULL),
(65, 'Pengadaan Armature', 'Pemasangan dan Peningkatan Mutu Penerangan Jalan Umum (PJU)', 3, 1, 4, '2649690000.00', 9, NULL),
(66, 'DED Jembatan Antasan Bromo', 'Pembangunan dan Peningkatan Jembatan (Non Fisik)', 3, 3, 5, '500000000.00', 9, NULL),
(67, 'DED Jembatan HKSN 01', 'Pembangunan dan Peningkatan Jembatan (Non Fisik)', 3, 3, 5, '350000000.00', 9, NULL),
(68, 'Pengawasan Pembangunan Jembatan Box Paket 1', 'Pembangunan dan Peningkatan Jembatan (Non Fisik)', 3, 3, 5, '194600000.00', 9, NULL),
(69, 'Pengawasan Pembangunan Jembatan Box Paket 2', 'Pembangunan dan Peningkatan Jembatan (Non Fisik)', 3, 3, 5, '177000000.00', 9, NULL),
(70, 'Pengawasan Teknis Pembangunan Depot Arsip', 'Pembangunan Gedung Bukan Kantor', 3, 4, 5, '479000000.00', 9, NULL),
(71, 'Pengadaan Bangunan Depot Arsip', 'Pembangunan Gedung Bukan Kantor', 3, 2, 2, '9459047500.00', 9, NULL),
(72, 'Belanja Bahan/Material Pekerjaan Pembangunan Jalan Kuin Kecil ujung (TMMD)', 'Pembangunan Jalan', 3, 1, 3, '995918000.00', 9, NULL),
(73, 'Paket 3 Penggantian Jembatan Kecamatan Banjarmasin Utara (Jembatan Pangeran II, Jembatan Jl Cemara I, Jembatan Jl Masjid Jami dan Jembatan AKT Dalam)', 'Pembangunan Jembatan Box', 3, 2, 2, '885000000.00', 9, NULL),
(74, 'Paket 4. Penggantian Jembatan Kecamatan Banjarmasin Timur (Jembatan Komp. Timur Perdana, Jembatan Komp. DPRD II, Jembatan Pengambangan 2 dan Jembatan Jalan Hikmah Banua Gang 3)', 'Pembangunan Jembatan Box', 3, 2, 2, '740000000.00', 9, NULL),
(75, 'Paket 2. Penggantian Jembatan Kecamatan Banjarmasin Barat (Jembatan 3 Jl. Saka Permai, Jembatan Jl. Intan Sari, Jembatan Jl. S. Parman Gg. Kalimantan I dan Jembatan Jl. Belitung Gg. AA)', 'Pembangunan Jembatan Box', 3, 2, 2, '705000000.00', 9, NULL),
(76, 'Paket 5. Penggantian Jembatan Kecamatan Banjarmasin Selatan (Jembatan IX Jl. Tatah Belayung, Jembatan AMD I, Jembatan Kuin Kacil 19 dan Jembatan Kuin Kacil 20)', 'Pembangunan Jembatan Box', 3, 2, 2, '700000000.00', 9, NULL),
(77, 'Paket 1. Penggantian Jembatan Kecamatan Banjarmasin Tengah (Jembatan II Jl. Bali, Jembatan Jl. Seberang Masjid 2, Jembatan Batu Benawa Gang IV)', 'Pembangunan Jembatan Box', 3, 2, 2, '516000000.00', 9, NULL),
(78, 'Survey Kondisi Jalan dan Jembatan Kota Banjarmasin Tahun 2019', 'Pembangunan, Peningkatan dan Rehabilitasi Jalan (Non Fisik)', 3, 3, 5, '500000000.00', 9, NULL),
(79, 'DED Banjarmasin Outer Ring Road (BORR) Segmen 1A', 'Pembangunan, Peningkatan dan Rehabilitasi Jalan (Non Fisik)', 3, 3, 5, '410000000.00', 9, NULL),
(80, 'Pengawasan Kegiatan Peningkatan Jalan Tahun 2019', 'Pembangunan, Peningkatan dan Rehabilitasi Jalan (Non Fisik)', 3, 3, 5, '300000000.00', 9, NULL),
(81, 'Pembangunan/Rehabilitasi Tutup Saluran Drainase Jl. Sultan Adam', 'Pembangunan/Rehab Saluran Drainase/Gorong-Gorong', 3, 2, 2, '500000000.00', 9, NULL),
(82, 'Manajemen Konstruksi Pembangunan Rumah Sakit Umum Daerah (lanjutan)', 'Pembangunan Rumah Sakit', 3, 3, 5, '3100000000.00', 9, NULL),
(83, 'Pembangunan Rumah Sakit Umum Daerah (lanjutan)', 'Pembangunan Rumah Sakit', 3, 2, 2, '75814400000.00', 9, NULL),
(84, 'Pengadaan Mobil Truck Tangki Vacuum (sedot Lumpur Tinja)', 'Pengadaan Alat-Alat Berat', 3, 1, 2, '1000000000.00', 9, NULL),
(85, 'Pengadaan Pick up dan karoseri untuk pemeliharaan PJU/PJL', 'Pengadaan Alat-Alat Berat', 3, 1, 2, '780750000.00', 9, NULL),
(86, 'Peningkatan Jalan Paket 1 (Jl Melati, Jl Kenanga I/II dan Trotoar Jl A Yani (lanjutan))', 'Peningkatan Jalan', 3, 2, 2, '18300000000.00', 9, NULL),
(87, 'Peningkatan Jalan Paket 2 (Jl. Tatah Bangkal (SMU 9) dan Jl. AMD Manunggal)', 'Peningkatan Jalan', 3, 2, 2, '4104410000.00', 9, NULL),
(88, 'Pengawasan Teknis Pekerjaan Peningkatan Struktur Jalan (Komp. Lumba-Lumba) (DAK)', 'Peningkatan Jalan Dana Alokasi Khusus (DAK)', 3, 3, 5, '215219000.00', 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE `pic` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nip` varchar(19) NOT NULL,
  `status` varchar(50) NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `nama`) VALUES
(1, 'Persiapan'),
(2, 'Pemilihan Penyedia'),
(3, 'Hasil Pemilihan'),
(4, 'Kontrak'),
(5, 'Serah Terima (PHO)'),
(6, 'Serah Terima (FHO)'),
(7, 'Selesai'),
(8, 'Dibatalkan'),
(9, 'Belum Ada Progress');

-- --------------------------------------------------------

--
-- Table structure for table `progress_pekerjaan`
--

CREATE TABLE `progress_pekerjaan` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `pekerjaan` int(10) UNSIGNED NOT NULL,
  `progress` tinyint(3) UNSIGNED NOT NULL,
  `tgl_progress` date NOT NULL,
  `next_progress` tinyint(3) UNSIGNED NOT NULL,
  `tgl_n_progress` date NOT NULL,
  `ket` varchar(200) NOT NULL,
  `real_keu` decimal(15,2) UNSIGNED NOT NULL,
  `real_fisik` decimal(15,2) UNSIGNED NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress_pekerjaan`
--

INSERT INTO `progress_pekerjaan` (`id`, `pekerjaan`, `progress`, `tgl_progress`, `next_progress`, `tgl_n_progress`, `ket`, `real_keu`, `real_fisik`, `create_date`) VALUES
(58, 17, 1, '2019-07-10', 2, '2019-07-11', '-', '0.00', '0.00', '2019-07-10 09:22:38'),
(59, 15, 1, '2019-07-10', 2, '2019-07-11', '-', '0.00', '0.00', '2019-07-10 09:35:23'),
(60, 24, 1, '2019-07-10', 2, '2019-08-08', 'Penyusunan HPS', '0.00', '0.00', '2019-07-10 12:12:17'),
(61, 24, 2, '2019-08-08', 3, '2019-09-09', 'sedang proses tender', '0.00', '0.00', '2019-07-10 12:14:56'),
(62, 24, 3, '2019-09-09', 4, '2019-09-11', 'tender selesai, negosiasi dengan penyedia', '0.00', '0.00', '2019-07-10 12:16:00'),
(63, 24, 4, '2019-09-11', 5, '2019-09-11', 'tanda tangan kontrak dengan penyedia', '0.00', '0.00', '2019-07-10 12:16:41'),
(64, 24, 4, '2019-09-11', 5, '2019-09-11', 'tanda tangan kontrak dengan penyedia', '300000000.00', '25.00', '2019-07-10 12:18:50'),
(65, 24, 4, '2019-09-11', 5, '2019-09-11', 'tanda tangan kontrak dengan penyedia', '300000000.00', '25.00', '2019-07-10 12:18:50'),
(66, 24, 5, '2019-11-30', 7, '2019-11-30', 'pekerjaan sudah selesai', '1000000000.00', '100.00', '2019-07-10 12:20:47');

-- --------------------------------------------------------

--
-- Table structure for table `serah_terima`
--

CREATE TABLE `serah_terima` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `penyedia` varchar(200) NOT NULL,
  `pekerjaan` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serah_terima`
--

INSERT INTO `serah_terima` (`id`, `nomor`, `tanggal`, `penyedia`, `pekerjaan`) VALUES
(2, 'xxxx', '2019-11-30', 'PT. ABC', 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kondisi_img`
--
ALTER TABLE `kondisi_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pekerjaan` (`pekerjaan`);

--
-- Indexes for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pekerjaan` (`pekerjaan`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pekerjaan` (`pekerjaan`);

--
-- Indexes for table `metode`
--
ALTER TABLE `metode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skpd` (`skpd`),
  ADD KEY `jenis` (`jenis`),
  ADD KEY `metode` (`metode`),
  ADD KEY `progress_now` (`progress_now`);

--
-- Indexes for table `pic`
--
ALTER TABLE `pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress_pekerjaan`
--
ALTER TABLE `progress_pekerjaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pekerjaan` (`pekerjaan`),
  ADD KEY `progress` (`progress`),
  ADD KEY `next_progress` (`next_progress`);

--
-- Indexes for table `serah_terima`
--
ALTER TABLE `serah_terima`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pekerjaan` (`pekerjaan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kondisi_img`
--
ALTER TABLE `kondisi_img`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `metode`
--
ALTER TABLE `metode`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `pic`
--
ALTER TABLE `pic`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `progress_pekerjaan`
--
ALTER TABLE `progress_pekerjaan`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `serah_terima`
--
ALTER TABLE `serah_terima`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kondisi_img`
--
ALTER TABLE `kondisi_img`
  ADD CONSTRAINT `img_pekerjaan` FOREIGN KEY (`pekerjaan`) REFERENCES `pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD CONSTRAINT `lokasi_pekerjaan` FOREIGN KEY (`pekerjaan`) REFERENCES `pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD CONSTRAINT `pekerjaan_ibfk_2` FOREIGN KEY (`metode`) REFERENCES `metode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pekerjaan_ibfk_4` FOREIGN KEY (`jenis`) REFERENCES `jenis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pekerjaan_ibfk_5` FOREIGN KEY (`progress_now`) REFERENCES `progress` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pekerjaan_skpd` FOREIGN KEY (`skpd`) REFERENCES `simolek`.`skpd` (`id_skpd`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `progress_pekerjaan`
--
ALTER TABLE `progress_pekerjaan`
  ADD CONSTRAINT `progress_pekerjaan_ibfk_1` FOREIGN KEY (`progress`) REFERENCES `progress` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `progress_pekerjaan_ibfk_2` FOREIGN KEY (`next_progress`) REFERENCES `progress` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `progress_pekerjaan_ibfk_3` FOREIGN KEY (`pekerjaan`) REFERENCES `pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
