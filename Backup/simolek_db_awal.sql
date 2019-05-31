-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27 Agu 2017 pada 03.35
-- Versi Server: 10.1.22-MariaDB
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
-- Database: `simolek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_upload`
--

CREATE TABLE `file_upload` (
  `id_file` bigint(20) UNSIGNED NOT NULL,
  `nama_file` varchar(250) DEFAULT NULL,
  `id_pelaporan` bigint(20) UNSIGNED DEFAULT NULL,
  `tgl_upload` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_jab` mediumint(9) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'user_biasa', 'General User'),
(3, 'pengelola', 'Pengelola di SKPD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jab` mediumint(9) UNSIGNED NOT NULL,
  `id_level` tinyint(5) NOT NULL,
  `nama_jab` varchar(50) NOT NULL,
  `id_skpd` mediumint(8) UNSIGNED NOT NULL,
  `nip` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jab`, `id_level`, `nama_jab`, `id_skpd`, `nip`) VALUES
(1, 2, 'pelapor_disdik', 1, '01'),
(2, 2, 'pelapor_diskes', 2, '02'),
(3, 2, 'pelapor_dpupr', 3, '03'),
(4, 2, 'pelapor_dpkp', 4, '04'),
(5, 2, 'pelapor_satpolppdamkar', 5, '05'),
(6, 2, 'pelapor_bakesbangpol', 6, '06'),
(7, 2, 'pelapor_dinsos', 7, '07'),
(8, 2, 'pelapor_dpppa', 8, '08'),
(9, 2, 'pelapor_dkp3', 9, '09'),
(10, 2, 'pelapor_dlh', 10, '10'),
(11, 2, 'pelapor_disdukcapil', 11, '11'),
(12, 2, 'pelapor_dppkbpm', 12, '12'),
(13, 2, 'pelapor_dishub', 13, '13'),
(14, 2, 'pelapor_diskominfo', 14, '14'),
(15, 2, 'pelapor_diskopumker', 15, '15'),
(16, 2, 'pelapor_dpmptsp', 16, '16'),
(17, 2, 'pelapor_dispora', 17, '17'),
(18, 2, 'pelapor_disbudpar', 18, '18'),
(19, 2, 'pelapor_dpa', 19, '19'),
(20, 2, 'pelapor_dpp', 20, '20'),
(21, 2, 'pelapor_bagpem', 21, '21'),
(22, 2, 'pelapor_bagkum', 22, '22'),
(23, 2, 'pelapor_bagorg', 23, '23'),
(24, 2, 'pelapor_bageko', 24, '24'),
(25, 2, 'pelapor_bagkesramas', 25, '25'),
(26, 2, 'pelapor_baghumpro', 26, '26'),
(27, 2, 'pelapor_bagumm', 27, '27'),
(28, 2, 'pelapor_baglp', 28, '28'),
(29, 2, 'pelapor_bagpbg', 29, '29'),
(30, 2, 'pelapor_setwan', 30, '30'),
(31, 2, 'pelapor_bakeuda', 31, '31'),
(32, 2, 'pelapor_inspektorat', 32, '32'),
(33, 2, 'pelapor_bkddiklat', 33, '33'),
(34, 2, 'pelapor_bpbd', 34, '34'),
(35, 2, 'pelapor_kectimur', 35, '35'),
(36, 2, 'pelapor_kecutara', 36, '36'),
(37, 2, 'pelapor_kectengah', 37, '37'),
(38, 2, 'pelapor_kecbarat', 38, '38'),
(39, 2, 'pelapor_kecselatan', 39, '39'),
(40, 2, 'pelapor_barenlitbangda', 40, '40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasifikasi`
--

CREATE TABLE `klasifikasi` (
  `id_klasifikasi` tinyint(3) UNSIGNED NOT NULL,
  `nama_klasifikasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `klasifikasi`
--

INSERT INTO `klasifikasi` (`id_klasifikasi`, `nama_klasifikasi`) VALUES
(1, 'Bagian'),
(2, 'Dinas'),
(3, 'Badan'),
(4, 'Kecamatan'),
(5, 'Satuan/Setwan/Itko');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_lap` int(10) UNSIGNED NOT NULL,
  `nama_lap` varchar(200) NOT NULL,
  `batas_waktu` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_skpd` mediumint(8) UNSIGNED NOT NULL,
  `id_jab` mediumint(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_jabatan`
--

CREATE TABLE `level_jabatan` (
  `id_level` tinyint(5) NOT NULL,
  `level` tinyint(2) NOT NULL,
  `nama_level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level_jabatan`
--

INSERT INTO `level_jabatan` (`id_level`, `level`, `nama_level`) VALUES
(1, 1, 'Staf/ Pelaksana'),
(2, 2, 'Kasubbag/ Kasi/ Kasubbid'),
(3, 3, 'Kabid'),
(4, 4, 'Sekretaris'),
(5, 5, 'Kepala SKPD'),
(6, 4, 'Kabag');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(18) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `id_skpd` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama_lengkap`, `id_skpd`) VALUES
('01', 'pegawai_disdik', 1),
('02', 'pegawai_diskes', 2),
('03', 'pegawai_dpupr', 3),
('04', 'pegawai_dpkp', 4),
('05', 'pegawai_satpolppdamkar', 5),
('06', 'pegawai_bakesbangpol', 6),
('07', 'pegawai_dinsos', 7),
('08', 'pegawai_dpppa', 8),
('09', 'pegawai_dkp3', 9),
('10', 'pegawai_dlh', 10),
('11', 'pegawai_disdukcapil', 11),
('12', 'pegawai_dppkbpm', 12),
('13', 'pegawai_dishub', 13),
('14', 'pegawai_diskominfo', 14),
('15', 'pegawai_diskopumker', 15),
('16', 'pegawai_dpmptsp', 16),
('17', 'pegawai_dispora', 17),
('18', 'pegawai_disbudpar', 18),
('19', 'pegawai_dpa', 19),
('20', 'pegawai_dpp', 20),
('21', 'pegawai_bagpem', 21),
('22', 'pegawai_bagkum', 22),
('23', 'pegawai_bagorg', 23),
('24', 'pegawai_bageko', 24),
('25', 'pegawai_bagkesramas', 25),
('26', 'pegawai_baghumpro', 26),
('27', 'pegawai_bagumm', 27),
('28', 'pegawai_baglp', 28),
('29', 'pegawai_bagpbg', 29),
('30', 'pegawai_setwan', 30),
('31', 'pegawai_bakeuda', 31),
('32', 'pegawai_inspektorat', 32),
('33', 'pegawai_bkddiklat', 33),
('34', 'pegawai_bpbd', 34),
('35', 'pegawai_kectimur', 35),
('36', 'pegawai_kecutara', 36),
('37', 'pegawai_kectengah', 37),
('38', 'pegawai_kecbarat', 38),
('39', 'pegawai_kecselatan', 39),
('40', 'pegawai_barenlitbangda', 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelaporan`
--

CREATE TABLE `pelaporan` (
  `id_pelaporan` bigint(20) UNSIGNED NOT NULL,
  `id_lap` int(10) UNSIGNED NOT NULL,
  `id_skpd` mediumint(8) UNSIGNED NOT NULL,
  `id_status` tinyint(2) NOT NULL,
  `id_jab` mediumint(9) UNSIGNED DEFAULT NULL,
  `tgl_upload` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `skpd`
--

CREATE TABLE `skpd` (
  `id_skpd` mediumint(8) UNSIGNED NOT NULL,
  `nama_skpd` varchar(75) NOT NULL,
  `id_klasifikasi` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `skpd`
--

INSERT INTO `skpd` (`id_skpd`, `nama_skpd`, `id_klasifikasi`) VALUES
(1, 'Dinas Pendidikan', 2),
(2, 'Dinas Kesehatan', 2),
(3, 'Dinas Pekerjaan Umum dan Penataan Ruang', 2),
(4, 'Dinas Perumahan dan Kawasan Permukiman', 2),
(5, 'Satuan Polisi Pamong Praja dan Pemadam Kebakaran', 5),
(6, 'Badan Kesatuan Bangsa dan Politik', 3),
(7, 'Dinas Sosial', 2),
(8, 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak', 2),
(9, 'Dinas Ketahanan Pangan, Pertanian dan Perikanan', 2),
(10, 'Dinas Lingkungan Hidup', 2),
(11, 'Dinas Kependudukan dan Pencatatan Sipil', 2),
(12, 'Dinas Pengendalian Penduduk, KB dan Pemberdayaan Masyarakat', 2),
(13, 'Dinas Perhubungan', 2),
(14, 'Dinas Komunikasi, Informatika dan Statistik', 2),
(15, 'Dinas Koperasi, Usaha Mikro dan Tenaga Kerja', 2),
(16, 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', 2),
(17, 'Dinas Kepemudaan dan Olahraga', 2),
(18, 'Dinas Kebudayaan dan Pariwisata', 2),
(19, 'Dinas Perpustakaan dan Arsip', 2),
(20, 'Dinas Perdagangan dan Perindustrian', 2),
(21, 'Bagian Pemerintahan', 1),
(22, 'Bagian Hukum', 1),
(23, 'Bagian Organisasi', 1),
(24, 'Bagian Perekonomian', 1),
(25, 'Bagian Kesejahteraan Rakyat dan Kemasyarakatan', 1),
(26, 'Bagian Humas dan Protokol', 1),
(27, 'Bagian Umum', 1),
(28, 'Bagian Layanan Pengadaan', 1),
(29, 'Bagian Pembangunan', 1),
(30, 'Sekretariat DPRD', 5),
(31, 'Badan Keuangan Daerah', 3),
(32, 'Inspektorat', 5),
(33, 'Badan Kepegawaian, Pendidikan dan Pelatihan Daerah', 3),
(34, 'Badan Penanggulangan Bencana Daerah', 3),
(35, 'Kecamatan Banjarmasin Timur', 4),
(36, 'Kecamatan Banjarmasin Utara', 4),
(37, 'Kecamatan Banjarmasin Tengah', 4),
(38, 'Kecamatan Banjarmasin Barat', 4),
(39, 'Kecamatan Banjarmasin Selatan', 4),
(40, 'Badan Perencanaan, Penelitian dan Pengembangan Daerah', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` tinyint(2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'Belum Lapor'),
(2, 'Sudah Lapor'),
(3, 'Diminta Perbaiki'),
(4, 'Diterima'),
(5, 'Direvisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` tinyint(9) NOT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, '6onUAywW.MiS04w4oiT7J.', 1268889823, 1503796650, 1, 'Dedy', 'Setiawan', 0, '0'),
(2, '::1', 'disdik', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 1503797580, 1, 'pegawai', 'disdik', 1, '81'),
(3, '::1', 'diskes', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'diskes', 2, '81'),
(4, '::1', 'dpupr', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dpupr', 3, '81'),
(5, '::1', 'dpkp', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dpkp', 4, '81'),
(6, '::1', 'satpolppdamkar', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'satpolppdamkar', 5, '81'),
(7, '::1', 'bakesbangpol', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bakesbangpol', 6, '81'),
(8, '::1', 'dinsos', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dinsos', 7, '81'),
(9, '::1', 'dpppa', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dpppa', 8, '81'),
(10, '::1', 'dkp3', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dkp3', 9, '81'),
(11, '::1', 'dlh', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dlh', 10, '81'),
(12, '::1', 'disdukcapil', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'disdukcapil', 11, '81'),
(13, '::1', 'dppkbpm', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dppkbpm', 12, '81'),
(14, '::1', 'dishub', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dishub', 13, '81'),
(15, '::1', 'diskominfo', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'diskominfo', 14, '81'),
(16, '::1', 'diskopumker', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'diskopumker', 15, '81'),
(17, '::1', 'dpmptsp', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dpmptsp', 16, '81'),
(18, '::1', 'dispora', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dispora', 17, '81'),
(19, '::1', 'disbudpar', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'disbudpar', 18, '81'),
(20, '::1', 'dpa', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dpa', 19, '81'),
(21, '::1', 'dpp', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'dpp', 20, '81'),
(22, '::1', 'bagpem', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bagpem', 21, '81'),
(23, '::1', 'bagkum', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bagkum', 22, '81'),
(24, '::1', 'bagorg', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bagorg', 23, '81'),
(25, '::1', 'bageko', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bageko', 24, '81'),
(26, '::1', 'bagkesramas', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bagkesramas', 25, '81'),
(27, '::1', 'baghumpro', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'baghumpro', 26, '81'),
(28, '::1', 'bagumm', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bagumm', 27, '81'),
(29, '::1', 'baglp', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'baglp', 28, '81'),
(30, '::1', 'bagpbg', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bagpbg', 29, '81'),
(31, '::1', 'setwan', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'setwan', 30, '81'),
(32, '::1', 'bakeuda', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bakeuda', 31, '81'),
(33, '::1', 'inspektorat', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'inspektorat', 32, '81'),
(34, '::1', 'bkddiklat', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bkddiklat', 33, '81'),
(35, '::1', 'bpbd', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'bpbd', 34, '81'),
(36, '::1', 'kectimur', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'kectimur', 35, '81'),
(37, '::1', 'kecutara', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'kecutara', 36, '81'),
(38, '::1', 'kectengah', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'kectengah', 37, '81'),
(39, '::1', 'kecbarat', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'kecbarat', 38, '81'),
(40, '::1', 'kecselatan', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'kecselatan', 39, '81'),
(41, '::1', 'barenlitbangda', '$2y$08$kIJNDCIPUjCe9o.TDnSC7eJ9NJR8tZOXTXvD47fIReUpRl27KH9su', '', '-@gmail.com', '', '', 0, '', 0, 0, 1, 'pegawai', 'barenlitbangda', 40, '81');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2),
(5, 3, 2),
(6, 4, 2),
(7, 5, 2),
(8, 6, 2),
(9, 7, 2),
(10, 8, 2),
(11, 9, 2),
(12, 10, 2),
(13, 11, 2),
(14, 12, 2),
(15, 13, 2),
(16, 14, 2),
(17, 15, 2),
(18, 16, 2),
(19, 17, 2),
(20, 18, 2),
(21, 19, 2),
(22, 20, 2),
(23, 21, 2),
(24, 22, 2),
(25, 23, 2),
(26, 24, 2),
(27, 25, 2),
(28, 26, 2),
(29, 27, 2),
(30, 28, 2),
(31, 29, 2),
(32, 30, 2),
(33, 31, 2),
(34, 32, 2),
(35, 33, 2),
(36, 34, 2),
(37, 35, 2),
(38, 36, 2),
(39, 37, 2),
(40, 38, 2),
(41, 39, 2),
(42, 40, 2),
(43, 41, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_upload`
--
ALTER TABLE `file_upload`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `pelaporan_file_idx` (`id_pelaporan`),
  ADD KEY `jabatan_file_idx` (`id_jab`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jab`),
  ADD KEY `id_skpd` (`id_skpd`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `id_level_2` (`id_level`),
  ADD KEY `id_pegawai` (`nip`);

--
-- Indexes for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_lap`),
  ADD KEY `id_skpd` (`id_skpd`),
  ADD KEY `id_jab` (`id_jab`);

--
-- Indexes for table `level_jabatan`
--
ALTER TABLE `level_jabatan`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_skpd` (`id_skpd`);

--
-- Indexes for table `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `id_lap` (`id_lap`),
  ADD KEY `id_skpd` (`id_skpd`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_jab` (`id_jab`);

--
-- Indexes for table `skpd`
--
ALTER TABLE `skpd`
  ADD PRIMARY KEY (`id_skpd`),
  ADD KEY `id_klasifikasi` (`id_klasifikasi`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_upload`
--
ALTER TABLE `file_upload`
  MODIFY `id_file` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jab` mediumint(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  MODIFY `id_klasifikasi` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_lap` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `level_jabatan`
--
ALTER TABLE `level_jabatan`
  MODIFY `id_level` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pelaporan`
--
ALTER TABLE `pelaporan`
  MODIFY `id_pelaporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `skpd`
--
ALTER TABLE `skpd`
  MODIFY `id_skpd` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `file_upload`
--
ALTER TABLE `file_upload`
  ADD CONSTRAINT `jabatan_file` FOREIGN KEY (`id_jab`) REFERENCES `jabatan` (`id_jab`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `pelaporan_file` FOREIGN KEY (`id_pelaporan`) REFERENCES `pelaporan` (`id_pelaporan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_2` FOREIGN KEY (`id_level`) REFERENCES `level_jabatan` (`id_level`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jabatan_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jabatan_ibfk_4` FOREIGN KEY (`id_skpd`) REFERENCES `skpd` (`id_skpd`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_skpd`) REFERENCES `skpd` (`id_skpd`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD CONSTRAINT `pelaporan_ibfk_1` FOREIGN KEY (`id_lap`) REFERENCES `laporan` (`id_lap`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pelaporan_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pelaporan_ibfk_3` FOREIGN KEY (`id_skpd`) REFERENCES `skpd` (`id_skpd`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pelaporan_ibfk_4` FOREIGN KEY (`id_jab`) REFERENCES `jabatan` (`id_jab`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `skpd`
--
ALTER TABLE `skpd`
  ADD CONSTRAINT `skpd_ibfk_1` FOREIGN KEY (`id_klasifikasi`) REFERENCES `klasifikasi` (`id_klasifikasi`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
