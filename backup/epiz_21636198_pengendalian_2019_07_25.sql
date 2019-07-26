-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql109.epizy.com
-- Generation Time: Jul 25, 2019 at 02:49 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epiz_21636198_pengendalian`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE IF NOT EXISTS `jenis` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `kondisi_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(200) NOT NULL,
  `pekerjaan` int(10) unsigned NOT NULL,
  `kondisi` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pekerjaan` (`pekerjaan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `kondisi_img`
--

INSERT INTO `kondisi_img` (`id`, `filename`, `pekerjaan`, `kondisi`) VALUES
(47, '0_160.jpg', 160, 0),
(42, '100_160.jpg', 160, 100),
(51, '15_158.jpg', 158, 15),
(49, '1_160.jpg', 160, 1),
(54, '20_73.jpg', 73, 20),
(55, '95_111.png', 111, 95),
(56, '0_119.jpg', 119, 0),
(57, '0_81.jpg', 81, 0),
(58, '0_83.png', 83, 0),
(59, '0_89.jpg', 89, 0),
(63, '0_171.jpg', 171, 0),
(64, '0_172.jpg', 172, 0),
(65, '0_90.jpg', 90, 0),
(66, '0_70.png', 70, 0),
(71, '0_109.jpg', 109, 0),
(70, '0_109.jpg', 109, 0),
(69, '0_109.jpg', 109, 0),
(72, '0_71.png', 71, 0),
(73, '10_174.jpg', 174, 10),
(74, '25_174.jpg', 174, 25);

-- --------------------------------------------------------

--
-- Table structure for table `kontrak`
--

CREATE TABLE IF NOT EXISTS `kontrak` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomor` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `penyedia` varchar(200) NOT NULL,
  `nilai` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `lama` varchar(50) NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL,
  `ket` varchar(200) NOT NULL,
  `pekerjaan` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pekerjaan` (`pekerjaan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`id`, `nomor`, `tanggal`, `penyedia`, `nilai`, `lama`, `awal`, `akhir`, `ket`, `pekerjaan`) VALUES
(15, '002/PPK-SAPRAS/BMPPSV-Videotron/2019', '2019-03-14', 'CV. Megatech', '906947250.00', '45 Hari Kalender', '2019-03-14', '2019-04-27', '-', 160),
(16, '011/SP/Kesra/IV/2019', '2019-04-15', 'CV. VASUNDAN ELC', '747948200.00', '261 Hari Kalender', '2019-04-15', '2019-12-31', '-', 158),
(18, '04/ADD-SP/Kesra/V/2019', '2019-05-03', 'CV. VASUNDAN ELC', '759085100.00', '261 Hari Kalender', '2019-04-15', '2019-12-31', 'Addendum kontrak', 158),
(23, '05/DPUPR-BJL&PJU-PPK-PJ.DAK.P1/VI/2019', '2019-06-28', 'CV. ANALIS', '3535295000.00', '180 Hari Kalender', '2019-06-28', '2019-12-24', '-', 89),
(20, '04/DPUPR-CKJK/PJP.SPAM.PRAMUKA.DAK/VII/2019', '2019-07-19', 'CV. MITRAYASA NUSANTARA', '460831000.00', '120 Hari Kalender', '2019-07-19', '2019-11-15', '-', 102),
(26, '/DLH/Juli/2019', '2019-07-02', 'PT. Itnasindo Jaya Konsultan', '200117500.00', '90 Hari Kalender', '2019-07-02', '2019-09-29', '-', 130),
(22, '600/19/DPUPR-ED/VI/2019', '2019-06-20', 'cv. cita karya maharani', '415935003.00', '150 Hari Kalender', '2019-06-24', '2019-11-20', '-', 81),
(24, '663/02-DPKP.KP/PLPKK.PKT.4-KD/2019', '2019-07-17', 'CV. Shelma Mitra', '954602000.00', '120 Hari Kalender', '2019-07-17', '2019-11-13', '-', 119),
(29, '03/DPUPR-CKJK/PBDA/VI/2019', '2019-06-26', 'CV. JAYA MANDIRI', '8888888888.00', '165 Hari Kalender', '2019-06-26', '2019-12-07', '-', 71),
(25, '03/DPUPR-CKJK/MKPRSUD/VI/2019', '2019-06-25', 'PT. PUSER BUMI MEKON', '1434692765.00', '190 Hari Kalender', '2019-06-25', '2019-12-31', 'kontrak', 82),
(27, '663/03-DPKP.KP/PBJ.PKT2.PBN/2019', '2019-07-15', 'CV. TIGA PUTERA BANUA', '638010000.00', '120 Hari Kalender', '2019-07-15', '2019-11-11', '-', 173),
(30, '05/DPUPR-BJL&PJU-PPK-RPJ.DAK.P1/VII/2019', '2019-07-18', 'CV. SUFERINDO ABADI', '3571986000.00', '120 Hari Kalender', '2019-07-18', '2019-11-14', '-', 109),
(31, '03/DPUPR-CKJK/PRSUD/VI/2019', '2019-06-10', 'PT. Tigamas Mitra Selaras', '66499392274.00', '205 Hari Kalender', '2019-06-10', '2019-12-31', 'kontrak', 83),
(32, '03/DPUPR-CKJK/WASTEKPDA/VII/2019', '2019-07-19', 'CV. SADWA RAMA CONSULTANT', '246636000.00', '150 Hari Kalender', '2019-07-19', '2019-12-15', '-', 70),
(33, '05/DPUPR-BJL&PJU-PPK-PJ.DAK.P2/VI/2019', '2019-06-28', 'PT. WASSENAR KARYA MARGA', '2705572000.00', '150 Hari Kalender', '2019-06-28', '2019-11-24', '-', 90),
(34, '05/DPUPR-BJL&PJU-PPK-RPJ.DAK.P2/VII/2019', '2019-07-17', 'CV. DELIMA UTAMA', '772616000.00', '90 Hari Kalender', '2019-07-17', '2019-10-14', '-', 110),
(35, '900/65-Sekr.Keu/DKP3/2019', '2019-07-08', 'CV. Borneo Raya', '191536450.00', '63 Hari Kalender', '2019-07-08', '2019-09-08', 'Belum ada adendum', 174),
(36, '07/DPUPR-BJL&PJU-PPK-PPRJNF-Was.PJ/VI/2019', '2019-06-10', 'PT. WINAYA KONTEKS KHARISMA', '207350000.00', '180 Hari Kalender', '2019-06-28', '2019-12-24', '-', 80),
(37, '07/DPUPR-BJL&PJU-PPK-Was.PJ.DAK.P1/VI/2019', '2019-06-28', 'PT. WINAYA KONTEKS KHARISMA', '174795500.00', '180 Hari Kalender', '2019-06-28', '2019-12-24', '-', 88),
(38, '03/DPUPR-BJb-Tender-BOX.P3/VII/2019', '2019-07-01', 'CV. Duta Karya Adhitama', '767917088.00', '180 Hari Kalender', '2019-07-01', '2019-12-27', 'lingkup pekerjaan 4 buah jembatan pada kec. banjarmasin utara', 73);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE IF NOT EXISTS `lokasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `latitude` decimal(15,9) NOT NULL,
  `longitude` decimal(15,9) NOT NULL,
  `deskripsi` varchar(300) NOT NULL,
  `pekerjaan` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pekerjaan` (`pekerjaan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `latitude`, `longitude`, `deskripsi`, `pekerjaan`) VALUES
(16, '-3.327928757', '114.588807821', 'Kantor Wali Kota Banjarmasin', 160),
(17, '-3.327227203', '114.588448405', 'Kantor Barenlitbangda Kota Banjarmasin', 14),
(18, '-3.327735705', '114.588764600', 'Bagian Kesra dan Kemasyarakatan Setdako Banjarmasin', 158),
(28, '-3.329738871', '114.590299129', 'Gedung Depot Arsip', 71),
(23, '-3.300080432', '114.606285095', 'jalan sultan adam kelurahan surgi mufti', 81),
(24, '-3.350704889', '114.573975205', 'rumah singgah', 125),
(25, '-3.326950866', '114.561824799', 'Komp. Lumba-Lumba', 89),
(26, '-3.332859971', '114.585084915', 'RSUD SUltan Suriansyah', 82),
(89, '-3.304039226', '114.591436386', 'Jembatan Antasan Kecil Timur', 73),
(30, '-3.368437023', '114.580568075', 'TPA Basirih Kota Banjarmasin', 142),
(31, '-3.360763777', '114.620734155', 'Jalan Setia Kelurahan Pemurus Dalam', 102),
(32, '-3.325212509', '114.581544399', 'jembatan griliya Rt 21', 111),
(34, '-3.324147857', '114.624186158', 'di Rt. 08, Rt. 09, Rt. 10, Rt. 28', 173),
(35, '-3.317030515', '114.594252706', 'Jl. Kapten Pierre Tendean No 29 Banjarmasin', 29),
(36, '-3.334808243', '114.597643018', 'Gang Setuju RT 13', 119),
(38, '-3.296706268', '114.604022205', 'jl. komplek mandiri II RT. 28 Banjarmasin', 126),
(39, '-3.327348828', '114.588831122', 'DLH Kota Banjarmasin', 130),
(41, '-3.331070213', '114.597122669', 'Kelayan Luar', 171),
(42, '-3.332898529', '114.584913254', 'RSUD Sultan Suriansyah', 61),
(43, '-3.288374262', '114.589651108', 'Jl. Adhiyaksa 3', 109),
(44, '-3.312725543', '114.592732429', 'Jl. Ambon', 109),
(45, '-3.286971901', '114.589601755', 'Gg. Tangga', 109),
(46, '-3.300508338', '114.607701302', 'Jl. Andai Raya Permai', 109),
(47, '-3.289436809', '114.589136124', 'Jl. Perdagangan', 109),
(48, '-3.289300242', '114.588131905', 'Jl. Perdagangan 1', 109),
(49, '-3.289390484', '114.587756395', 'Jl. Perdagangan 2', 109),
(50, '-3.312402073', '114.592723846', 'Jl. Marothai', 109),
(51, '-3.298696028', '114.605366707', 'Jl. Sungai Andai', 109),
(52, '-3.332945656', '114.585127831', 'RSUD Sultan Suriansyah', 83),
(53, '-3.331741774', '114.627485275', 'Puskesmas Terminal Komplek Satelit Permai, Jl. Pramuka, RT.19, Sungai Lulut, Kec. Banjarmasin Tim., Kota Banjarmasin, Kalimantan Selatan 70236', 58),
(54, '-3.329776358', '114.590256214', 'Gedung Depot Arsip', 70),
(55, '-3.350759512', '114.585256577', 'Kelayan Selatan', 172),
(56, '-3.360381773', '114.594987631', 'Jl. Tatah Makmur', 90),
(57, '-3.338189595', '114.620130658', 'Jl. Dharma Praja II', 110),
(58, '-3.339399896', '114.621165991', 'Jl. Dharma Praja III', 110),
(59, '-3.339581976', '114.621214271', 'Jl. Dharma Praja V', 110),
(60, '-3.338106588', '114.620275497', 'Jl. Dharma Praja VII', 110),
(61, '-3.338050357', '114.620141387', 'Jl. Dharma Praja VIII', 110),
(62, '-3.337035524', '114.622120857', 'Jl. Dharma Bakti VA', 110),
(63, '-3.335983203', '114.625768661', 'Kecamatan Banjarmasin Timur', 78),
(64, '-3.320559738', '114.589376450', 'Kecamatan Banjarmasin Tengah', 78),
(65, '-3.329214045', '114.566631317', 'Kecamatan Banjarmasin Barat', 78),
(66, '-3.282257093', '114.584999084', 'Kecamatan Banjarmasin Utara', 78),
(67, '-3.353205786', '114.608516693', 'Kecamatan Banjarmasin Selatan', 78),
(68, '-3.335062086', '114.615962505', 'Trotoar Jl. A. Yani', 80),
(69, '-3.326793417', '114.608098269', 'Jl. Melati', 80),
(70, '-3.327120095', '114.607513547', 'Jl. Kenanga I/II', 80),
(73, '-3.366615199', '114.590170383', 'Jl. Tatah Bangkal (SMU 9)', 80),
(72, '-3.327752029', '114.588732719', 'Balai Kota Banjarmasin', 106),
(74, '-3.341755557', '114.589440806', 'RPH Basirih Dekat Gudang Karet', 174),
(75, '-3.356959798', '114.617078304', 'Jl. AMD Manunggal', 80),
(78, '-3.326856343', '114.561803341', 'Komp. Lumba-Lumba', 88),
(79, '-3.371710755', '114.543948546', 'Jl. Kuin Kecil Ujung', 72),
(83, '-3.355404107', '114.628724456', 'Jl. Pemurus', 79),
(84, '-3.357231575', '114.620305002', 'Jl. Sepakat', 79),
(85, '-3.357350728', '114.607036114', 'Jl. AMD', 79),
(86, '-3.363514557', '114.592198133', 'Jl. Tatah Bangkal', 79),
(87, '-3.342764096', '114.613993764', 'Jl. Bumi Mas Komp. Bumi Ayu (Lanjutan)', 94),
(88, '-3.341446693', '114.611805081', 'Jl. Bumi Mas Komp. Bumi Jaya', 94);

-- --------------------------------------------------------

--
-- Table structure for table `metode`
--

CREATE TABLE IF NOT EXISTS `metode` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `metode`
--

INSERT INTO `metode` (`id`, `nama`) VALUES
(2, 'Tender'),
(3, 'Tender Cepat'),
(4, 'E-Purchasing'),
(5, 'Seleksi'),
(6, 'Penunjukan Langsung');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE IF NOT EXISTS `pekerjaan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `kegiatan` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `skpd` mediumint(8) unsigned NOT NULL,
  `jenis` tinyint(4) unsigned NOT NULL,
  `metode` tinyint(4) unsigned NOT NULL,
  `pagu` decimal(15,2) NOT NULL,
  `progress_now` tinyint(3) unsigned DEFAULT '9',
  `user` int(11) unsigned DEFAULT NULL,
  `id_rup` varchar(10) NOT NULL DEFAULT '-',
  `id_lpse` varchar(10) NOT NULL DEFAULT '-',
  `link_rup` varchar(500) NOT NULL DEFAULT '#',
  `link_lpse` varchar(500) NOT NULL DEFAULT '#',
  PRIMARY KEY (`id`),
  KEY `skpd` (`skpd`),
  KEY `jenis` (`jenis`),
  KEY `metode` (`metode`),
  KEY `progress_now` (`progress_now`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=213 ;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `nama`, `kegiatan`, `deskripsi`, `skpd`, `jenis`, `metode`, `pagu`, `progress_now`, `user`, `id_rup`, `id_lpse`, `link_rup`, `link_lpse`) VALUES
(14, 'Penyusunan Rencana Pengembangan Kawasan Industri Terpadu Mantuil Kota Banjarmasin', 'Koordinasi  Perencanaan  Pembangunan  Sub Bidang   Ekonomi Hulu', 'Pembuatan Dokumen ini bertujuan sebagai dasar bagi pihak-pihak terkait dalam mengembangkan kawasan industri baik bagi Aparatur Pemerintah dalam penertiban izin dan pembinaan serta pengawasan, maupun bagi dunia usaha dalam melihat peluang investasi di bidang pengembangan industri dan kawasan industri di Kota Banjarmasin. ', 40, 3, 5, '300000000.00', 9, 49, '21459887', '3163024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21459887&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3163024/pengumumanlelang'),
(15, 'Pembangunan Gedung TK Pembina Negeri Banjarmasin Selatan (Pembangunan Unit Sekolah Baru (USB) TK Negeri)', 'Pembangunan Gedung Sekolah', '', 1, 2, 2, '1337873000.00', 9, 52, '-', '-', '#', '#'),
(16, 'Pembangunan Gedung TK Pembina Negeri Banjarmasin Utara (lanjutan)', 'Pembangunan Gedung Sekolah', '', 1, 2, 2, '798355000.00', 9, 52, '-', '-', '#', '#'),
(17, 'Pembangunan Gedung TK Pembina Negeri Banjarmasin Timur', 'Pembangunan Gedung Sekolah', '', 1, 2, 2, '1794975000.00', 9, 52, '-', '-', '#', '#'),
(18, 'Belanja modal pengadaan Personal Komputer (Pengadaan Komputer) DAK SKB', 'Pengadaan Peralatan Pendidikan (DAK SKB)', '', 1, 1, 4, '260000000.00', 9, 110, '-', '-', '#', '#'),
(19, 'Penambahan Ruang Kelas SDN Sungai Andai 3 (lanjutan)', 'Penambahan Ruang Kelas Sekolah', '', 1, 2, 2, '400000000.00', 9, 54, '-', '-', '#', '#'),
(20, 'Penambahan Ruang Kelas SDN Pasar Lama 3 (2 Kelas)', 'Penambahan Ruang Kelas Sekolah', '', 1, 2, 2, '1025000000.00', 9, 54, '-', '-', '#', '#'),
(21, 'Pembangunan Gedung Perpustakaan Sekolah SDN Basirih 10 (Tahap 1)', 'Pembangunan Perpustakaan Sekolah', '', 1, 2, 2, '260000000.00', 9, 54, '-', '-', '#', '#'),
(22, 'Belanja Pengadaan Kursi SDN', 'Pengadaan Mebeluer Sekolah', '', 1, 1, 4, '242060000.00', 9, 54, '-', '-', '#', '#'),
(23, 'Belanja Pengadaan Meja SDN', 'Pengadaan Mebeluer Sekolah', '', 1, 1, 4, '347165000.00', 9, 54, '-', '-', '#', '#'),
(24, 'Pengadaan Buku Koleksi Perpustakaan (DAK SD)', 'Pengadaan Buku Koleksi Perpustakaan (DAK SD)', '', 1, 1, 4, '1850000000.00', 9, 54, '-', '-', '#', '#'),
(26, 'Pengadaan Komputer', 'Pengadaan Peralatan Penunjang UNBK SMP', '', 1, 1, 4, '492225000.00', 9, 53, '', '', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang//pengumumanlelang'),
(27, 'Pengadaan Meja SMPN', 'Pengadaan Mebeleur SMP', '', 1, 1, 4, '595791000.00', 9, 54, '-', '-', '#', '#'),
(28, 'Pengadaan Kursi SMPN', 'Pengadaan Mebeleur SMP', '', 1, 1, 4, '399693000.00', 9, 54, '-', '-', '#', '#'),
(29, 'Belanja Cetak Cover Raport K13 SD', 'Pengadaan Buku-buku dan Alat Tulis Siswa', 'Belanja Cetak Coper Raport K-13 SD tahun 2019 untuk Seluruh Sekolah Dasar di kota Banjarmasin Khusus  Kelas 1', 1, 4, 3, '590940000.00', 9, 54, '19476991', '3132024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19476991&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3132024/pengumumanlelang'),
(31, 'Belanja Modal Pengadaan Sentrifuge', 'Pengadaan Alat Medis Puskesmas', '', 2, 1, 4, '401950000.00', 9, 65, '-', '-', '#', '#'),
(32, 'Belanja Modal Pengadaan Alat Kedokteran Bagian Penyakit Dalam', 'Pengadaan Alat Medis Puskesmas', '', 2, 1, 4, '299874460.00', 9, 65, '-', '-', '#', '#'),
(33, 'Belanja Modal Pengadaan Alat Kedokteran Bedah', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', '', 2, 1, 4, '6778636415.00', 9, 65, '-', '-', '#', '#'),
(34, 'Belanja Modal Pengadaan Alat Kedokteran Gawat Darurat', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', '', 2, 1, 4, '1262356600.00', 9, 65, '-', '-', '#', '#'),
(35, 'Belanja Modal Pengadaan Alat Kedokteran Gigi', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', '', 2, 1, 4, '1193911225.00', 9, 65, '-', '-', '#', '#'),
(36, 'Belanja Modal Pengadaan Alat Kedokteran Radiologi', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', '', 2, 1, 4, '3829886700.00', 9, 65, '-', '-', '#', '#'),
(37, 'Belanja Modal Pengadaan Alat Kesehatan Kebidanan dan Penyakit Kandungan', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', '', 2, 1, 4, '2047342660.00', 9, 65, '-', '-', '#', '#'),
(38, 'Belanja Modal Pengadaan Alat Kesehatan Perawatan', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', '', 2, 1, 4, '579627972.00', 9, 65, '-', '-', '#', '#'),
(39, 'Belanja Modal Pengadaan Alat Laboratorium Hematologi', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', '', 2, 1, 4, '564601000.00', 9, 65, '-', '-', '#', '#'),
(40, 'Belanja Modal Pengadaan Alat Laboratorium Kimia', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', '', 2, 1, 4, '1186988421.00', 9, 65, '-', '-', '#', '#'),
(41, 'Belanja Modal Pengadaan Alat Laboratorium Lainnya', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', '', 2, 1, 4, '331465518.00', 9, 65, '-', '-', '#', '#'),
(42, 'Belanja Pengadaan Sterilisasi', 'Pengadaan Alat-Alat Kesehatan Rumah Sakit', '', 2, 1, 4, '2900700000.00', 9, 65, '-', '-', '#', '#'),
(43, 'Belanja modal pengadaan Peralatan Studio Visual', 'Pengadaan Alat-alat Non Medis Rumah Sakit', '', 2, 1, 4, '324000000.00', 9, 62, '-', '-', '#', '#'),
(44, 'Belanja modal pengadaan Personal Komputer', 'Pengadaan Alat-alat Non Medis Rumah Sakit', '', 2, 1, 4, '904250000.00', 9, 62, '-', '-', '#', '#'),
(45, 'Belanja Alat-Alat Kesehatan', 'Pengadaan obat-obatan RS', '', 2, 1, 4, '200800000.00', 9, 65, '-', '-', '#', '#'),
(46, 'Belanja bahan obat-obatan', 'Pengadaan obat-obatan RS', '', 2, 1, 4, '530145000.00', 9, 65, '-', '-', '#', '#'),
(47, 'Belanja Bahan Obat-Obatan Generik', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 4, '1973800000.00', 9, 65, '-', '-', '#', '#'),
(48, 'Belanja Bahan Obat-Obatan Gigi', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 4, '253600000.00', 9, 65, '-', '-', '#', '#'),
(49, 'Belanja Reagent Hematologi Analizer A Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 4, '200850000.00', 9, 65, '-', '-', '#', '#'),
(50, 'Belanja Reagent Hematologi Analizer B Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 4, '200850000.00', 9, 65, '-', '-', '#', '#'),
(51, 'Belanja Reagent HIV dan Syphilis', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 4, '200850000.00', 9, 65, '-', '-', '#', '#'),
(52, 'Belanja Reagent Klinis A Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 4, '200850000.00', 9, 65, '-', '-', '#', '#'),
(53, 'Belanja Reagent Klinis B Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 4, '200850000.00', 9, 65, '-', '-', '#', '#'),
(54, 'Belanja Reagent Klinis C Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 4, '200850000.00', 9, 65, '-', '-', '#', '#'),
(55, 'Belanja Reagent Stik Untuk Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 4, '200850000.00', 9, 65, '-', '-', '#', '#'),
(56, 'DED Pembangunan/Rehab Total Puskesmas Kayu Tangi  (Dana Insentif Daerah)', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', '', 2, 3, 5, '220400000.00', 9, 64, '-', '-', '#', '#'),
(57, 'Pembangunan Pustu Simpang Limau (Dana Insentif Daerah)', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', '', 2, 2, 2, '453900000.00', 9, 64, '-', '-', '#', '#'),
(58, 'Rehab Sedang Rumah Dinas Puskesmas Terminal (Dana Insentif Daerah)', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', 'Seiring dengan peningkatan kebutuhan masyarakat terhadap pelayanan puskesmas, maka Puskesmas Terminal Kota Banjarmasin perlu melakukan perbaikan pelayanan, baik terhadap pelayanan masyarakat secara langsung maupun terhadap pelayanan internal untuk meningkatkan kinerja operasional terkait. Guna peningkatan pelayanan masyarakat tersebut, terutama dalam bidang Kesehatan Masyarakat khususnya wilayah Kota Banjarmasin melihat kondisi rumah dinas yang ada sekarang ini sudah tidak dapat lagi digunakan karena kontruksi bangunan sudah rusak dimakan usia maka Dinas Kesehatan Kota Banjarmasin  berencana melaksanakan Rehabilitasi Rumah Dinas yang merupakan sarana pendukung pelayanan Kesehatan Masyarakat.', 2, 2, 2, '353250000.00', 2, 64, '21719671', '3345024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21719671&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3345024/pengumumanlelang'),
(59, 'Belanja Bahan Obat-Obatan Penunjang (Belanja Bahan Obat-Obatan Penunjang, Poliklinik Pemko, Program Gizi)', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 3, '1599400000.00', 9, 65, '-', '-', '#', '#'),
(60, 'Belanja cetak', 'Pembinaan Pelayanan Kesehatan Usia Lanjut', '', 2, 1, 2, '573750000.00', 9, 63, '-', '-', '#', '#'),
(61, 'Belanja Modal Pengadaan Aplikasi SIM RS', 'Pengadaan Alat-alat Non Medis Rumah Sakit', 'Software Aplikasi SIMRS', 2, 1, 2, '836102600.00', 1, 62, '21808060', '', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21808060&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang//pengumumanlelang'),
(62, 'Normalisasi Sungai Andai ke Sungai Gampa', 'Pelaksanaan Normalisasi Saluran Sungai Kecil', '', 3, 2, 2, '419900000.00', 9, 113, '-', '-', '#', '#'),
(63, 'Normalisasi Sungai Lumbah', 'Pelaksanaan Normalisasi Saluran Sungai Kecil', '', 3, 2, 2, '418000000.00', 9, 113, '-', '-', '#', '#'),
(64, 'Pengadaan Alat Listrik', 'Pemasangan dan Peningkatan Mutu Penerangan Jalan Umum (PJU)', '', 3, 1, 2, '998784400.00', 9, 101, '-', '-', '#', '#'),
(65, 'Pengadaan Armature', 'Pemeliharaan Jaringan dan Peralatan Listrik PJU', '', 3, 1, 4, '2649690000.00', 9, 101, '-', '-', '#', '#'),
(66, 'DED Jembatan Antasan Bromo', 'Pembangunan dan Peningkatan Jembatan (Non Fisik)', '', 3, 3, 5, '500000000.00', 9, 109, '-', '-', '#', '#'),
(67, 'DED Jembatan HKSN 01', 'Pembangunan dan Peningkatan Jembatan (Non Fisik)', '', 3, 3, 5, '350000000.00', 9, 109, '-', '-', '#', '#'),
(161, 'Pengadaan Pemagaran keliling 2 Lapangan Basket Siring bekantan', 'Pembangunan dan Pemeliharaan Sarana Olahraga', '', 17, 2, 2, '663392150.00', 9, 74, '-', '-', '#', '#'),
(160, 'Pengadaan Video Tron', 'Pengadaan Sarana dan Prasarana Kantor', 'Terpasangnya media informasi luar ruangan (Videotron) yang bermanfaat untuk masyarakat Kota Banjarmasin dimana dapat menyajikan informasi yang lengkap dan detail tentang kebijakan, program dan hasil pembangunan Pemerintah Kota Banjarmasin', 14, 1, 2, '1000000000.00', 5, 43, '19136241', '2993024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19136241&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/2993024/pengumumanlelang'),
(70, 'Pengawasan Teknis Pembangunan Depot Arsip', 'Pembangunan Gedung Bukan Kantor', 'Tugas Konsultan Pengawasan Teknis Pembangunan Depot Arsip adalah berupa Pengendalian terhadap Pekerjaan Pengadaan Bangunan Depot Arsip dengan ketinggian 2 Lantai', 3, 3, 5, '479000000.00', 4, 88, '21486477', '3167024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21486477&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3167024/pengumumanlelang'),
(71, 'Pengadaan Bangunan Depot Arsip', 'Pembangunan Gedung Bukan Kantor', 'Lingkup pekerjaan adalah Pembangunan Gedung Depot Arsip dengan ketinggian 2 lantai dengan rincian sebagai berikut : \r\na)Pekerjaan Pendahuluan; \r\nb) Pekerjaan Tanah / Pancangan; \r\nc) Pekerjaan Beton struktur lantai 1, dan lantai 2; \r\nd) Pekerjaan Pasangan Dinding dan Plesteran; \r\ne) Pekerjaan Lantai; \r\nf) Pekerjaan kap / Atap; \r\ng) Pekerjaan Plafond; \r\nh) Pekerjaan Pintu, Jendela & ventelasi; \r\ni) Pekerjaan Instalasi Listrik; \r\nj) Pekerjaan Sanitasi & Instalasi Air; \r\nk) Pekerjaan Cat-Catan; \r\nl) Pekerjaan Lain – Lain; dan \r\nm) Pekerjaan Site Development', 3, 2, 2, '9459047500.00', 4, 88, '19170597', '3175024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19170597&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3175024/pengumumanlelang'),
(72, 'Belanja Bahan/Material Pekerjaan Pembangunan Jalan Kuin Kecil ujung (TMMD)', 'Pembangunan Jalan', 'Belanja Bahan/Material Pekerjaan Pembangunan Jalan Kuin Kecil Ujung (TMMD)', 3, 1, 3, '995918000.00', 9, 99, '21338832', '3116024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21338832&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3116024/pengumumanlelang'),
(73, 'Paket 3 Penggantian Jembatan Kecamatan Banjarmasin Utara (Jembatan Pangeran II, Jembatan Jl Cemara I, Jembatan Jl Masjid Jami dan Jembatan AKT Dalam V)', 'Pembangunan Jembatan Box', 'pembangunan jembatan box', 3, 2, 2, '885000000.00', 9, 106, '19141473', '3209024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19141473&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3209024/pengumumanlelang'),
(74, 'Paket 4. Penggantian Jembatan Kecamatan Banjarmasin Timur (Jembatan Komp. Timur Perdana, Jembatan Komp. DPRD II, Jembatan Pengambangan 2 dan Jembatan Jalan Hikmah Banua Gang 3)', 'Pembangunan Jembatan Box', '', 3, 2, 2, '740000000.00', 9, 106, '-', '-', '#', '#'),
(75, 'Paket 2. Penggantian Jembatan Kecamatan Banjarmasin Barat (Jembatan 3 Jl. Saka Permai, Jembatan Jl. Intan Sari, Jembatan Jl. S. Parman Gg. Kalimantan I dan Jembatan Jl. Belitung Gg. AA)', 'Pembangunan Jembatan Box', '', 3, 2, 2, '705000000.00', 9, 106, '-', '-', '#', '#'),
(76, 'Paket 5. Penggantian Jembatan Kecamatan Banjarmasin Selatan (Jembatan IX Jl. Tatah Belayung, Jembatan AMD I, Jembatan Kuin Kacil 19 dan Jembatan Kuin Kacil 20)', 'Pembangunan Jembatan Box', '', 3, 2, 2, '700000000.00', 9, 106, '-', '-', '#', '#'),
(77, 'Paket 1. Penggantian Jembatan Kecamatan Banjarmasin Tengah (Jembatan II Jl. Bali, Jembatan Jl. Seberang Masjid 2, Jembatan Batu Benawa Gang IV)', 'Pembangunan Jembatan Box', '', 3, 2, 2, '516000000.00', 9, 106, '-', '-', '#', '#'),
(78, 'Survey Kondisi Jalan dan Jembatan Kota Banjarmasin Tahun 2019', 'Pembangunan, Peningkatan dan Rehabilitasi Jalan (Non Fisik)', 'Survey kondisi jalan dan jembatan kota Banjarmasin Tahun 2019', 3, 3, 5, '500000000.00', 2, 102, '19122879', '3368024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19122879&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3368024/pengumumanlelang'),
(79, 'DED Banjarmasin Outer Ring Road (BORR) Segmen 1A', 'Pembangunan, Peningkatan dan Rehabilitasi Jalan (Non Fisik)', 'DED Banjarmasin Outer Ring Road (BORR) Segmen 1A', 3, 3, 5, '410000000.00', 8, 102, '19122239', '0', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19122239&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/0/pengumumanlelang'),
(80, 'Pengawasan Kegiatan Peningkatan Jalan Tahun 2019', 'Pembangunan, Peningkatan dan Rehabilitasi Jalan (Non Fisik)', 'Pengawasan kegiatan peningkatan jalan tahun 2018', 3, 3, 5, '300000000.00', 4, 102, '19121987', '3023024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19121987&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3023024/pengumumanlelang'),
(81, 'Pembangunan/Rehabilitasi Tutup Saluran Drainase Jl. Sultan Adam', 'Pembangunan/Rehab Saluran Drainase/Gorong-Gorong', 'Pembangunan/Rehabilitasi Tutup Saluran  Drainase Jl. Sultan Adam Kota Banjarmasin\r\nuntuk memperlancar aliran air yang tergenang dan memberikan pelayanan yang layak', 3, 2, 2, '500000000.00', 4, 103, '19186479', '3119024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19186479&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3119024/pengumumanlelang'),
(82, 'Manajemen Konstruksi Pembangunan Rumah Sakit Umum Daerah (lanjutan)', 'Pembangunan Rumah Sakit', 'Tugas Konsultan Manajemen Konstruksi Pembangunan Rumah Sakit Umum Daerah Sultan Suriansyah adalah berupa Pengendalian Pekerjaan Pembangunan bangunan gedung utama 5 lantai RSUD Sultan Suriansyah Kota Banjarmasin', 3, 3, 5, '3100000000.00', 4, 114, '21091705', '3134024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21091705&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3134024/pengumumanlelang'),
(83, 'Pembangunan Rumah Sakit Umum Daerah (lanjutan)', 'Pembangunan Rumah Sakit', 'Pekerjaan Pembangunan  Rumah Sakit Umum Daerah (lanjutan)  merupakan pekerjaan  pembangunan gedung utama 5 lantai yang terdiri dari Ruang Rawat inap (lantai 3,4,5), ruang Radiologi dan Ruang Operasi  dengan lingkup pekerjaan  adalah sebagai berikut : \r\na) Pekerjaan struktur lantai 1, lantai 2, lantai 3, lantai 4 dan lantai 5 pada gedung utama; \r\nb) Pekerjaan arsitektur lantai 1, lantai 2, lantai 3 , lantai 4 dan lantai 5 pada gedung utama; \r\nc) Pekerjaan mekanikal, elektrikal dan plumbing gedung Utama rumah sakit.', 3, 2, 2, '75814400000.00', 4, 114, '21194931', '3102024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21194931&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3102024/pengumumanlelang'),
(84, 'Pengadaan Mobil Truck Tangki Vacuum (sedot Lumpur Tinja)', 'Pengadaan Alat-Alat Berat', '', 3, 1, 2, '1000000000.00', 9, 96, '-', '-', '#', '#'),
(85, 'Pengadaan Pick up dan karoseri untuk pemeliharaan PJU/PJL', 'Pengadaan Alat-Alat Berat', '', 3, 1, 2, '780750000.00', 9, 96, '-', '-', '#', '#'),
(86, 'Peningkatan Jalan Paket 1 (Jl Melati, Jl Kenanga I/II dan Trotoar Jl A Yani (lanjutan))', 'Peningkatan Jalan', '', 3, 2, 2, '18300000000.00', 9, 104, '-', '-', '#', '#'),
(87, 'Peningkatan Jalan Paket 2 (Jl. Tatah Bangkal (SMU 9) dan Jl. AMD Manunggal)', 'Peningkatan Jalan', '', 3, 2, 2, '4104410000.00', 9, 104, '-', '-', '#', '#'),
(88, 'Pengawasan Teknis Pekerjaan Peningkatan Struktur Jalan (Komp. Lumba-Lumba) (DAK)', 'Peningkatan Jalan Dana Alokasi Khusus (DAK)', 'Pengawasan teknis pekerjaan Peningkatan struktur jalan (Komp. Lumba-lumba)(DAK)', 3, 3, 5, '215219000.00', 4, 102, '19135678', '3040024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19135678&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3040024/pengumumanlelang'),
(89, 'Peningkatan Struktur Jalan (Komp. Lumba-Lumba) (DAK)', 'Peningkatan Jalan Dana Alokasi Khusus (DAK)', 'Peningkatan Struktur Jalan (Komp. Lumba-Lumba) (DAK) dengan jenis penanganan rigid pavement', 3, 2, 2, '3834744000.00', 4, 102, '19123524', '3190024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19123524&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3190024/pengumumanlelang'),
(90, 'Peningkatan Kapasitas Jalan (Jl. Tatah Makmur) (DAK)', 'Peningkatan Jalan Dana Alokasi Khusus (DAK)', 'Peningkatan kapasitas jalan (Jl. Tatah Makmur) (DAK) dengan  jenis penanganan aspal', 3, 2, 2, '2804256000.00', 4, 102, '19135627', '3155024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19135627&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3155024/pengumumanlelang'),
(91, 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Barat Paket 1', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Barat', '', 3, 2, 2, '4000000000.00', 9, 108, '-', '-', '#', '#'),
(92, 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Barat Paket 2', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Barat', '', 3, 2, 2, '2250000000.00', 9, 108, '-', '-', '#', '#'),
(93, 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Selatan Paket 1', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Selatan', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Selatan Paket 1', 3, 2, 2, '4500000000.00', 9, 99, '19137694', '21635275', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19137694&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/21635275/pengumumanlelang'),
(94, 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Selatan Paket 2', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Selatan', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Selatan Paket 2', 3, 2, 2, '2400000000.00', 9, 99, '19137912', '21635310', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19137912&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/21635310/pengumumanlelang'),
(95, 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Timur Paket 2', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Timur', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Timur Paket 2', 3, 2, 2, '2100000000.00', 9, 94, '3264024', '21635345', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=3264024&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/21635345/pengumumanlelang'),
(96, 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Utara Paket 1', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Utara', '', 3, 2, 2, '4300000000.00', 9, 92, '-', '-', '#', '#'),
(97, 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Utara Paket 2', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Utara', '', 3, 2, 2, '2300000000.00', 9, 92, '-', '-', '#', '#'),
(98, 'Pengawasan Teknis Peningkatan Struktur Jembatan Tatah Bangkal I (SMU 9) (DAK)', 'Peningkatan/Penggantian Jembatan (DAK)', '', 3, 3, 5, '450000000.00', 9, 97, '-', '-', '#', '#'),
(99, 'Peningkatan Struktur Jb.Kiwi I Pada Ruas Jl Kiwi, Jb Murai I Pada ruas jalan Komplek Murai, Jb Gelatik I Pada ruas jl Gelatik, Jb Sepakat I Pada ruas jl Sepakat, Jb Al Aman  I pada ruas jl Gg Al Aman,', 'Peningkatan/Penggantian Jembatan (DAK)', '', 3, 2, 2, '1500000000.00', 9, 97, '-', '-', '#', '#'),
(100, 'Peningkatan Struktur Jembatan Tatah Bangkal I pada Ruas Jalan Tatah Bangkal (SMU 9) (DAK)', 'Peningkatan/Penggantian Jembatan (DAK)', '', 3, 2, 2, '8500000000.00', 9, 97, '-', '-', '#', '#'),
(101, 'Pengadaan dan Pemasangan Air Limbah Jl. A.Yani', 'Penyediaan Prasarana dan Sarana Air Limbah', '', 3, 2, 2, '6000000000.00', 9, 95, '-', '-', '#', '#'),
(102, 'Pengembangan Jaringan Perpipaan SPAM Pramuka untuk Kelurahan Pemurus Dalam Kecamatan Banjarmasin Selatan Kota Banjarmasin (DAK)', 'Penyediaan Prasarana dan Sarana Air Minum (DAK)', 'Pekerjaan persiapan, pekerjaan pengadaan pipa & aksesoris HDPE, pekerjaan pemasangan pipa HDPE, pekerjaan jembatan pipa, pekerjaan box gate valve, pekerjaan sambungan rumah, pekerjaan lain-lain', 3, 2, 2, '799468000.00', 4, 89, '21503058', '3328026', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21503058&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3328026/pengumumanlelang'),
(103, 'Penyusunan Leger Jalan', 'Penyusunan Dokumen Inspeksi Kondisi Jalan', '', 3, 3, 5, '507622000.00', 9, 98, '-', '-', '#', '#'),
(104, 'Penyusunan Dokumen Studi LARAP Trase BORR Segmen 1A', 'Penyusunan Dokumen Perencanaan Jalan dan Jembatan', '', 3, 3, 5, '263700000.00', 9, 105, '-', '-', '#', '#'),
(105, 'Penyusunan RTBL Koridor RK Ilir', 'Penyusunan Rencana Tata Bangunan & Lingkungan', '', 3, 3, 5, '313400000.00', 9, 100, '-', '-', '#', '#'),
(106, 'Perencanaan Bangungan Gedung Kantor Pemerintah Kota Banjarmasin', 'Perencanaan Bangunan Gedung', 'Kegiatan perencanaan gedung kantor di lingkungan Balai Kota Banjarmasin', 3, 3, 5, '1479200000.00', 8, 88, '21235541', '', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21235541&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang//pengumumanlelang'),
(107, 'Perencanaan Konstruksi Perkuatan Tebing Siring Sungai Awang', 'Perencanaan Penataan Sungai-Sungai Besar', '', 3, 3, 5, '247000000.00', 9, 93, '-', '-', '#', '#'),
(108, 'Pembangunan IPAL komunal + perpipaan', 'Proyek Sanitasi Masyarakat (SANIMAS)', 'Pekerjaan pembangunan MCK dan IPAL Komunal untuk masyarakat sebanyak 6 unit', 3, 2, 2, '2000000000.00', 9, 89, '19135383', '0', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19135383&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/0/pengumumanlelang'),
(109, 'Pemeliharaan Berkala Jalan (Jl Adhiyaksa 3; Gg Tangga; Jl Ambon; Jl Marothai; Jl Andai Raya Permai; Jl Perdagangan; Jl Perdagangan 1; Jl Perdagangan 2; Jl Sungai Andai) (DAK)', 'Rehabilitasi/Pemeliharaan Jalan Dana Alokasi Khusus', 'Pemeliharaan Berkala Jalan (Jl. Adhiyaksa 3; Gg. Tangga; Jl. Ambon; Jl. Marothai; Jl. Andai Raya Permai; Jl. Perdagangan; Jl. Perdagangan 1; Jl. Perdagangan 2; Jl.  Sungai Andai (DAK)', 3, 2, 2, '3800670000.00', 4, 102, '19123524', '3190024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19123524&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3190024/pengumumanlelang'),
(110, 'Pemeliharaan Berkala Jalan (Jl Dharma Praja II; Jl Dharma Praja III; Jl Dharma Praja V; Jl Dharma Praja VII; Jl Dharma Praja VIII; Jl Dharma Bakti VA)(DAK)', 'Rehabilitasi/Pemeliharaan Jalan Dana Alokasi Khusus', 'Pemeliharaan Berkala Jalan (Jl. Dharma Praja II; Jl. Dharma Praja III; Jl. Dharma Praja V; Jl. Dharma Praja VII; Jl. Dharma Praja VIII;  Jl. Dharma Bakti VA) (DAK)', 3, 2, 2, '845330000.00', 4, 102, '19123574', '3192024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19123574&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3192024/pengumumanlelang'),
(111, 'Pemeliharaan Jembatan di Kota Banjarmasin Paket 1 (Rehabilitasi Jb Jl Gerilya dll)', 'Rehabilitasi/Pemeliharaan Jembatan', 'Pemeliharaan Jembatan Ulin yang rusak menjadi jembatan ulin yang baik', 3, 2, 2, '800000000.00', 9, 107, '19144537', '3045024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19144537&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3045024/pengumumanlelang'),
(112, 'Pemeliharaan Jembatan di Kota Banjarmasin Paket 2 (Rehabilitasi Jembatan Simpang Sei. Jelai RT. 27)', 'Rehabilitasi/Pemeliharaan Jembatan', '', 3, 2, 2, '407150000.00', 9, 107, '-', '-', '#', '#'),
(113, 'Belanja Pemeliharaan/ Pembersihan Sungai Martapura', 'Rehabilitasi/Pemeliharaan Sungai Besar', '', 3, 2, 2, '515000000.00', 9, 90, '-', '-', '#', '#'),
(114, 'Pendampingan Persetujuan Substansi Raperda Revisi RTRW Kota Banjarmasin', 'Revisi Rencana Tata Ruang Wilayah (RTRW) Kota Banjarmasin', '', 3, 3, 5, '404000000.00', 9, 91, '-', '-', '#', '#'),
(115, 'Pengawasan Konstruksi Perkuatan Tebing Sungai dan Penataan Bantaran Sungai', 'Revitalisasi dan Penataan Bantaran Sungai', '', 3, 3, 5, '235000000.00', 9, 113, '-', '-', '#', '#'),
(116, 'Belanja Modal Pengadaan Konstruksi Perkuatan Tebing Sungai dan Penataan Bantaran Sungai', 'Revitalisasi dan Penataan Bantaran Sungai', '', 3, 2, 2, '13238365000.00', 9, 113, '-', '-', '#', '#'),
(117, 'Rehabilitasi Bangunan Gedung Rusunawa Ganda Maghfirah', 'Rehabilitasi Rusunawa', '', 4, 2, 2, '2862600000.00', 9, 69, '-', '-', '#', '#'),
(118, 'Pembuatan Halaman dan Pagar Rusunawa Teluk Kelayan', 'Penunjang Pembangunan Rumah Susun', '', 4, 2, 2, '1418600000.00', 9, 69, '-', '-', '#', '#'),
(119, 'Perbaikan Lingkungan Permukiman Kawasan Kumuh Paket 4', 'Perbaikan Lingkungan Permukiman Kawasan Kumuh', 'Tertatanya lingkungan pemukiman kawasan kumuh kota Banjarmasin', 4, 2, 2, '1500000000.00', 4, 68, '19138348', '3135024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19138348&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3135024/pengumumanlelang'),
(120, 'BM Pengadaan Jalan di Komp. Perumahan Kec. Banjarmasin Selatan', 'Pembangunan Sarana Jalan Lingkungan di Perumahan', '', 4, 2, 2, '1523000000.00', 9, 67, '-', '-', '#', '#'),
(121, 'Pengadaan Taman di Komplek Perumahan Kec. Banjarmasin Utara', 'Pengadaan Taman di Komplek perumahan', '', 4, 2, 2, '770000000.00', 9, 67, '-', '-', '#', '#'),
(122, 'Belanja Pakai Habis Pakaian dan Atribut Upacara/ Acara Nasional dan /Atau Daerah', 'Dukungan Pengamanan dalam Rangka Pemilihan Umum Tahun 2019', '', 5, 1, 2, '401200000.00', 9, 46, '-', '-', '#', '#'),
(123, 'Pengadaan Bangunan Asrama Rumah Singgah', 'Operasional dan Pengadaan Perlengkapan Rumah Singgah bagi Tuna Sosial', '', 7, 2, 2, '426310000.00', 9, 70, '-', '-', '#', '#'),
(124, 'Belanja Persediaan Makanan Pokok', 'Operasional dan Pengadaan Perlengkapan Rumah Singgah bagi Tuna Sosial', '', 7, 1, 2, '388800000.00', 9, 70, '-', '-', '#', '#'),
(125, 'Pembangunan Asrama Rumah Singgah', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', 'meningkatkan kualitas layanan penanganan kepada Tuna Sosial di Banjarmasin', 7, 2, 2, '800000000.00', 2, 71, '19894227', '3354024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19894227&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3354024/pengumumanlelang'),
(126, 'Belanja Modal Pengadaan Alat Laboratorium Kualitas Air dan Tanah', 'Operasional Laboratorium', 'Tersedianya alat alat Laboratorium penujang kegiatan Laboratorium Lingkungan Dinas Lingkungan Hidup Kota Banjarmasin', 10, 1, 2, '297950000.00', 9, 81, '20454801', '3104024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=20454801&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3104024/pengumumanlelang'),
(127, 'Pembangunan Taman di Wilayah Kecamatan Banjarmasin Barat', 'Pembangunan Taman Kota', 'Terlaksananya pembangunan taman di wilayah Kecamatan Banjarmasin Barat yang berlokasi di Jl. Banjar Raya yang bermanfaat untuk masyarakat Kota Banjarmasin, dimana taman tersebut nantinya akan dimanfaatkan sebagai pembelajaran taman lalu lintas.', 10, 2, 2, '376300000.00', 9, 84, '20461413', '3361024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=20461413&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3361024/pengumumanlelang'),
(128, 'DED (Detail Engineering Design) Pembangunan dan Operasional Insenarator', 'Pembangunan tempat pembuangan benda padat/cair yang menimbulkan polusi', '', 10, 3, 5, '300000000.00', 9, 83, '-', '-', '#', '#'),
(129, 'Belanja Modal Pengadaan Excavator', 'Pengadaan Alat-Alat Berat', '', 10, 1, 4, '3587200000.00', 9, 85, '-', '-', '#', '#'),
(130, 'Master Plan Pembangunan dan Operasional Insenarator', 'Pembangunan tempat pembuangan benda padat/cair yang menimbulkan polusi', 'Sebagai kota besar banjarmasin menjadi pusat kegiatan yang menghasilkan sampah termasuk sampah medis.........', 10, 3, 5, '275000000.00', 4, 83, '19447884', '3057024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19447884&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3057024/pengumumanlelang'),
(131, 'Pengadaan Personal Komputer', 'Pengadaan Sarana dan Prasarana Kantor', '', 31, 1, 4, '332445000.00', 9, 61, '-', '-', '#', '#'),
(132, 'Belanja Modal Pengadaan Road Sweeper / Mobil Penyapu Jalan (DID)', 'Pengadaan Alat-Alat Berat', '', 10, 1, 3, '6606285000.00', 9, 85, '-', '-', '#', '#'),
(133, 'Belanja Modal Pengadaan Truck Pemadat Sampah (DID)', 'Pengadaan Alat-Alat Berat', '', 10, 1, 3, '1630000000.00', 9, 85, '-', '-', '#', '#'),
(134, 'Belanja Modal Pengadaan Truck Pemadat Sampah (APBD)', 'Pengadaan Alat-Alat Berat', '', 10, 1, 3, '1630000000.00', 9, 85, '-', '-', '#', '#'),
(135, 'Pengadaan Ribbon, Film Printer, Pembersih Printer (Cleaning Kit)', 'Pelayanan Administrasi Kependudukan', '', 11, 1, 4, '433850000.00', 9, 79, '-', '-', '#', '#'),
(136, 'Belanja Modal Pengadaan Skid Steer Loader (DID)', 'Pengadaan Alat-Alat Berat', '', 10, 1, 3, '1100000000.00', 9, 85, '-', '-', '#', '#'),
(137, 'Belanja Modal Pengadaan Dump Truck (GSO)', 'Pengadaan Alat-Alat Berat', '', 10, 1, 3, '834500000.00', 9, 85, '-', '-', '#', '#'),
(138, 'Belanja Modal Pengadaan Dump Truck (GSO) (DAK KLHK 2019)', 'Pengadaan Alat-Alat Berat', '', 10, 1, 3, '417250000.00', 9, 85, '-', '-', '#', '#'),
(139, 'Belanja Jasa Pelayanan Kantor/Publik (pakaian kerja, keselamatan kerja, perlengkapan kerja dan topi)', 'Penyediaan Prasarana dan Sarana Pengelolaan Persampahan', '', 10, 1, 2, '814555000.00', 9, 82, '-', '-', '#', '#'),
(140, 'Pembangunan Jalan Akses Menuju Zona Pembuangan Sampah di TPA Basirih', 'Penyediaan prasarana dan sarana pengelolaan persampahan TPA', '', 10, 2, 2, '1100000000.00', 9, 80, '-', '-', '#', '#'),
(141, 'Belanja Modal Pengadaan Tempat Parkir/Garasi', 'Penyediaan prasarana dan sarana pengelolaan persampahan TPA', '', 10, 2, 2, '810000000.00', 9, 80, '-', '-', '#', '#'),
(142, 'Penyusunan Dokumen Lingkungan (AMDAL/UKL-UPL/SPPL) Pembangunan dan Operasional Insenarator', 'Pembangunan tempat pembuangan benda padat/cair yang menimbulkan polusi', '', 10, 3, 5, '854950000.00', 9, 83, '-', '-', '#', '#'),
(145, 'Pengadaan Dokumen Kependudukan dan Kartu Identitas Anak', 'Pelayanan Administrasi Kependudukan', '', 11, 4, 2, '572390000.00', 9, 79, '-', '-', '#', '#'),
(146, 'Belanja Modal Pengadaan Bangunan Gedung Pertokoan/Koperasi/Pasar Pembangunan Gedung Kuliner Baiman', 'Kegiatan Pembangunan Gedung Bukan Kantor', '', 15, 2, 2, '458850000.00', 9, 75, '-', '-', '#', '#'),
(147, 'Belanja Modal Pengadaan Bangunan Tempat Kerja Lainnya Pembangunan Balai Latihan Kerja (BLK)', 'Kegiatan Pembangunan Gedung Bukan Kantor', '', 15, 2, 2, '3255700000.00', 9, 75, '-', '-', '#', '#'),
(148, 'Rehab Kantor Kelurahan', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', '', 38, 2, 2, '670500000.00', 9, 56, '-', '-', '#', '#'),
(149, 'Pembangunan Gedung Kantor Kelurahan Telawang', 'Pembangunan Gedung Kantor', '', 38, 2, 2, '2900816000.00', 9, 56, '-', '-', '#', '#'),
(150, 'Rehab Kantor Kelurahan Teluk Tiram, Rehab untuk Sarana Disabilitas Kelurahan Belitung Selatan, Belitung Utara dan Pelambuan', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', '', 38, 2, 2, '224290000.00', 9, 56, '-', '-', '#', '#'),
(151, 'Pembangunan Penambahan Fasilitas Penunjang untuk Penyandang Disabilitas di Kelurahan Kecamatan Banjarmasin Tengah', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', '', 37, 2, 2, '538605000.00', 9, 51, '-', '-', '#', '#'),
(152, 'Peningkatan Kantor Kecamatan dan 9 Kantor Kelurahan', 'Rehabilitasi Sedang/Berat Gedung Kantor', '', 35, 2, 2, '249000000.00', 9, 57, '-', '-', '#', '#'),
(153, 'Belanja Sewa Perlengkapan dan Peralatan Kantor', 'Intensifikasi Penerimaan Pajak Daerah dan Penerimaan Sumber-Sumber Lain', '', 31, 4, 2, '385200000.00', 9, 58, '-', '-', '#', '#'),
(154, 'Belanja Jasa Penilaian Aset', 'Pengamanan dan Pemeliharaan Aset Milik Daerah', '', 31, 4, 2, '1000000000.00', 9, 59, '-', '-', '#', '#'),
(155, 'Belanja Modal Pengadaan Bangunan Gedung Kantor / Rehab Gudang Arsip Bakeuda', 'Rehabilitasi Sedang/Berat Gedung Kantor', '', 31, 2, 2, '950000000.00', 9, 60, '-', '-', '#', '#'),
(156, 'Belanja Modal Pengadaan Peralatan Studi Visual / Videotron', 'Pengadaan Sarana dan Prasarana Kantor', '', 31, 1, 2, '726545000.00', 9, 61, '-', '-', '#', '#'),
(157, 'Belanja Modal Pengadaan Electrik Generating Set', 'Pengadaan Sarana dan Prasarana Kantor', '', 30, 1, 2, '800000000.00', 9, 50, '-', '-', '#', '#'),
(158, 'Belanja Penyediaan Makanan Pokok', 'Pembinaan Panti Asuhan di Kota Banjarmasin', 'Penyediaan bahan Makanan Pokok Tambahan pada 27 Panti Asuhan (562 anak) yang masuk dalam Forum Lembaga Kesejahteraan Sosial Anak (LKSA) se Kota Banjarmasin. Tujuannya untuk meningkatkan kesehatan, kesejahteraan dan daya tahan tubuh anak panti asuhan.', 25, 1, 2, '1132614000.00', 4, 48, '19869927', '3021024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19869927&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3021024/pengumumanlelang'),
(159, 'Belanja Pematangan Lahan dan Pembangunan Gedung Parkir dan Penataan Drainase', 'Pemeliharaan Rutin/Berkala Sarana dan Prasarana Kantor', '', 27, 2, 2, '1600000000.00', 9, 55, '-', '-', '#', '#'),
(162, 'Belanja Modal Pengadaan Bangunan Gedung Pertokoan/Koperasi/Pasar Pembangunan Gedung Kuliner Baiman', 'Revitalisasi Pasar Tradisional Kota Banjarmasin', '', 20, 2, 2, '2048626000.00', 9, 86, '-', '-', '#', '#'),
(163, 'Belanja Pemeliharaan Gedung dan Bangunan', 'Pemeliharaan Berkala / Berkala Bangun Pasar', '', 20, 2, 2, '312500000.00', 9, 87, '-', '-', '#', '#'),
(168, 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Timur Paket 1', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Timur', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Timur Paket 1', 3, 2, 2, '4250000000.00', 9, 94, '3310024', '21635331', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=3310024&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/21635331/pengumumanlelang'),
(167, 'Pengadaan Kendaraan Bermotor Penumpang', 'Peningkatan Pembangunan Sarana dan Prasarana Pariwisata', '', 18, 1, 2, '1000000000.00', 9, 47, '-', '-', '#', '#'),
(169, 'Perbaikan Lingkungan Permukiman Kawasan Kumuh Paket 7 (Pengambangan)', 'Perbaikan Lingkungan Permukiman Kawasan Kumuh', '', 4, 2, 2, '4843204000.00', 9, 68, '-', '-', '#', '#'),
(170, 'Belanja Alat-Alat Kesehatan', 'Pengendalian Penyakit (DAK)', '', 2, 1, 4, '2841863000.00', 9, 65, '-', '-', '#', '#'),
(171, 'Perbaikan Lingkungan Permukiman Kawasan Kumuh Paket 6', 'Perbaikan Lingkungan Permukiman Kawasan Kumuh', 'Tertatanya lingkungan pemukiman kawasan kumuh kota Banjarmasin', 4, 2, 2, '1500000000.00', 3, 68, '19140881', '3232024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19140881&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3232024/pengumumanlelang'),
(172, 'Perbaikan Lingkungan Permukiman Kawasan Kumuh Paket 5', 'Perbaikan Lingkungan Permukiman Kawasan Kumuh', 'Tertatanya lingkungan pemukiman kawasan kumuh kota Banjarmasin', 4, 2, 2, '1500000000.00', 2, 68, '19138445', '3305024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19138445&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3305024/pengumumanlelang'),
(173, 'Penataan Bangunan Lingkungan Perkotaan Kawasan Kampung Tradisional Tepian Air di Kota Banjarmasin Paket 2 (Kel. Pengambangan)', 'Penataan Bangunan Lingkungan Perkotaan', 'Tertatanya lingkungan perkotaan kawasan kampung tradisional tepian sungai di kota banjarmasin', 4, 2, 2, '1585000000.00', 4, 66, '19381294', '3112024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=19381294&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3112024/pengumumanlelang'),
(174, 'Belanja Modal Pengadaan Bangunan Gedung Kandang Hewan / Ternak (DAK) Rehab Atap kandang Penampungan RPH Lokasi Basirih Selatan', 'Rehabilitasi Sedang/Berat Gedung/Bangunan', 'Perbaikan Atap Kandang Penmpungan RPH sangat perlu segera dilakukan, mengingat kondisinya saat ini mengalami kerusakan yang cukup berat, karena  hampir 80% kondisi atap mengalami kebocoran pada saat hujan. Keadan ini sangant mengganggu terhadap ternak sapi yang ditampung pada kandang tersebut, seperti sapi mengalami stress, kelembaban tinggi dan terjadi peningkatan serangan hama pengganggu terutam lalat dan nyamuk. Adanya alokasi DAK Pertanian tahun 2019 sebagian dialokasi untuk melakukan rehap kandan tersebut dengan jumlah perkiraan sebesar Rp. 218.500.000 dan saat ini sudah dimulai tahap kegiatan fisik', 9, 2, 2, '218500000.00', 4, 72, '21238147', '3204024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21238147&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3204024/pengumumanlelang'),
(175, 'Belanja Modal Pengadaan Bangunan Tempat Kerja Lainnya (Pembangunan Bangunan Arena Lomba Burung Berkicau)', 'Pembangunan Gedung Bukan Kantor', '', 9, 2, 2, '300000000.00', 9, 73, '21238141', '3243024', 'https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword=21238141&jenisPengadaan=0&metodePengadaan=0', 'http://lpse.banjarmasinkota.go.id/eproc4/lelang/3243024/pengumumanlelang'),
(176, 'Belanja bahan obat-obatan', 'Penurunan Stunting (DAK)', '', 2, 1, 4, '971348000.00', 9, 65, '-', '-', '#', '#'),
(177, 'Pengadaan Ban Luar, Ban Dalam dan Flant untuk Armada Operasional', 'Pemeliharaan Rutin/Berkala Kendaraan Dinas/Operasional', '', 10, 1, 3, '532800000.00', 9, 82, '-', '-', '#', '#'),
(178, 'Pengadaan Komputer Unit Jaringan Mini Komputer (Tapping Box Pajak Online)', 'Pengadaan Sarana dan Prasarana Kantor', '', 13, 1, 2, '397900000.00', 9, 77, '-', '-', '#', '#'),
(179, 'Pembuatan Gedung Parkir', 'Pembangunan Sarana dan Prasarana Parkir', '', 13, 2, 2, '2771030000.00', 9, 77, '-', '-', '#', '#'),
(180, 'Belanja modal pengadaan bangunan gedung', 'Fasilitasi Pengembangan Usaha Kecil Menengah', '', 15, 2, 2, '400000000.00', 9, 75, '-', '-', '#', '#'),
(181, 'Peningkatan fasilitas sarana olahraga Kecamatan Banjarmasin Timur', 'Pembangunan dan Pemeliharaan Sarana Olahraga', '', 17, 2, 2, '2683112850.00', 9, 74, '-', '-', '#', '#'),
(182, 'Belanja modal pengadaan peralatan personal komputer', 'Pengadaan Sarana dan Prasarana Kantor', '', 35, 1, 4, '403000000.00', 9, 112, '-', '-', '#', '#'),
(195, 'Belanja Sertifikat ISO', 'Standarisasi/Sertifikasi Pelayanan Publik', '', 11, 4, 2, '498500000.00', 9, 78, '-', '-', '#', '#'),
(192, 'Pengadaan Kendaraan Dinas Bermotor Perorangan Roda 4', 'Pengadaan Sarana dan Prasarana Kantor', '', 27, 1, 4, '525000000.00', 9, 55, '-', '-', '#', '#'),
(194, 'Pengadaan Kendaraan Dinas Bermotor Penumpang Roda 4', 'Pengadaan Sarana dan Prasarana Kantor', '', 27, 1, 4, '2875000000.00', 9, 55, '-', '-', '#', '#'),
(196, 'Cetak Buku Rapot K13 SMP', 'Pengadaan Buku-buku dan Alat Tulis Siswa SMP', '', 1, 1, 2, '561600000.00', 9, 53, '-', '-', '#', '#'),
(198, 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Tengah Paket 1', 'Peningkatan Jalan Lingkungan Kecamatan Banjarmasin Tengah', '', 3, 2, 2, '2700000000.00', 9, 108, '-', '-', '#', '#'),
(199, 'Belanja Modal Pengadaan Kursi Kerja Non Eselon', 'Pengadaan Alat-alat Non Medis Rumah Sakit', '', 2, 1, 4, '2257150000.00', 9, 62, '-', '-', '#', '#'),
(200, 'Belanja Modal Pengadaan Kursi Hadap Depan Meja Kerja Pejabat', 'Pengadaan Alat-alat Non Medis Rumah Sakit', '', 2, 1, 4, '302200000.00', 9, 62, '-', '-', '#', '#'),
(202, 'Belanja Pengadaan Poliklinik THT', 'Pengadaan Alat-alat Kesehatan Rumah Sakit', '', 2, 1, 4, '897342511.00', 9, 65, '-', '-', '#', '#'),
(203, 'Belanja Modal Pengadaan Alat Pendingin', 'Pengendalian Penyakit (DAK)', '', 2, 1, 4, '270000000.00', 9, 65, '-', '-', '#', '#'),
(204, 'Belanja Pengadaan Rawat Inap', 'Pengadaan Alat-alat Kesehatan Rumah Sakit', '', 2, 1, 4, '858470060.00', 9, 65, '-', '-', '#', '#'),
(205, 'Belanja BMHP dan Perbekalan Kesehatan e-katalog (Blood Lancet Gizi, P2P dll)', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan', '', 2, 1, 4, '302300000.00', 9, 65, '-', '-', '#', '#'),
(206, 'Belanja Bahan Obat Puskesmas', 'Peningkatan Ketersediaan Obat Publik dan Perbekalan Kesehatan (Dana DAK Kefarmasian)', '', 2, 1, 4, '1716593199.00', 9, 65, '-', '-', '#', '#'),
(207, 'Pengadaan Armature', 'Pemasaangan dan Peningkatan Mutu Penerangan Jalan Umum (PJU)', '', 3, 1, 4, '686800000.00', 9, 101, '-', '-', '#', '#'),
(208, 'Belanja Modal Pengadaan Personal Komputer', 'Pengadaan Sarana dan Prasarana Kantor', '', 9, 1, 4, '230000000.00', 9, 111, '-', '-', '#', '#'),
(211, 'Pengadaan Peralatan Seni Budaya (DAK SD)', 'Pengadaan Peralatan Seni Budaya (DAK SD)', '', 1, 1, 3, '216000000.00', 9, 54, '-', '-', '#', '#'),
(212, 'Belanja Modal Pengadaan Alat Pengelolaan Air Kotor', 'Pengadaan Alat Medis dan Non Medis  Puskesmas (DAK)', '', 2, 1, 6, '450000000.00', 9, 65, '-', '-', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE IF NOT EXISTS `pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `nip` varchar(19) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tmt` date NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `pekerjaan` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `pic`
--

INSERT INTO `pic` (`id`, `nama`, `nip`, `status`, `tmt`, `kontak`, `pekerjaan`) VALUES
(1, 'gfghf', '5467567', 'pptk', '2019-07-18', '55645', 14),
(2, 'bngjhmgkjg', '65467467', 'ppk', '2019-07-18', '45646754', 14),
(3, 'gfhgj', '6565', 'pa', '2019-07-18', '6567587', 14),
(9, 'Juli Khair, S.Sos.I', '198207312006041012', 'pptk', '0000-00-00', '081348874335', 158),
(6, 'Laila Wahidah, S.Sos', '196901211992032003', 'pptk', '2019-01-07', '081251006440', 160),
(7, 'Yusma Rifani, S.AB', '197008272005011008', 'ppk', '2019-01-07', '081348343506', 160),
(8, 'Drs. H. Achmad Noor Djaya, M., MM', '196102061987031009', 'pa', '2019-03-25', '085101256261', 160),
(10, 'H. Muhammad Isa Ansari, SE. MAP.', '196801111993031006', 'ppk', '2019-01-01', '0811508362', 158),
(11, 'Rusmini, S.Sos', '197407061994032002', 'pptk', '2019-01-16', '081253347272', 14),
(12, 'Ir. SUGITO, MT', '196111081990031002', 'ppk', '2019-05-21', '0811506013', 14),
(13, 'Ir. SUGITO, MT', '196111081990031002', 'ppk', '2019-01-16', '0811506013', 14),
(14, 'Ir. SUGITO, MT', '196111081990031002', 'pa', '2019-07-02', '0811506013', 14),
(15, 'khairina rahmi, st', '198011172006042011', 'pptk', '2019-02-27', '0811500677', 81),
(16, 'Hj. Ir. Rusyidah', '196111251993032001', 'ppk', '2018-12-30', '085100381792', 81),
(17, 'Ir. Ahmad Fanani Saifudin, SH', '196502071992031006', 'pa', '2019-01-02', '0811511391', 119),
(18, 'Rahmat Rizali, S.ST', '197912062005011011', 'pptk', '2019-01-14', '082153610006', 119),
(47, 'Drs. Mukhyar, M.AP', '196111171993101001', 'pa', '2019-01-02', '081349639999', 126),
(20, 'H. Chandra I. W,  ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 89),
(21, 'Suyatno,ST,MS', '196808032000031008', 'ppk', '2019-07-15', '081351266659', 82),
(22, 'SUYATNO, ST, MS.', '196808032000031008', 'kpa', '2019-03-08', '081351266659', 71),
(23, 'Drs. H. MUKHYAR, M.AP', '196111171993101001', 'pa', '2019-01-02', '081349639999', 142),
(24, 'Agus Herri Wijayadi', '197608142006041008', 'pptk', '2019-07-15', '087814403801', 82),
(25, 'Muhammad', '196301131985031008', 'pptk', '2019-02-02', '085390453937', 111),
(26, 'SUYATNO, ST, MS', '196808032000031008', 'kpa', '2019-03-08', '081351266659', 102),
(27, 'Ir. Ahmad Fanani Saifudin, SH', '196502071992031006', 'ppk', '2019-06-24', '0811511391', 119),
(28, 'Indiharto Kurniawan, S.Pi', '197006081997031009', 'pptk', '2019-01-02', '081351885255', 125),
(29, 'SUYATNO, ST, MS', '196808032000031008', 'ppk', '2019-03-08', '081351266659', 102),
(30, 'Ir. H. JUANDA, MS', '196612121996031004', 'pptk', '2019-01-02', '0811527524', 142),
(31, 'ANDINI AMALIA RIFKY, ST', '198712302011012005', 'pptk', '2019-01-02', '082157944197', 102),
(32, 'SUYATNO, ST, MS.', '196808032000031008', 'ppk', '2019-03-08', '081351266659', 71),
(33, 'Iwan Ristianto, AP, M.AP', '197609141994121002', 'pa', '2019-05-16', '081351106300', 125),
(34, 'Ir. Ahmad Fanani Saifudin, SH', '196502071992031006', 'pa', '2019-01-02', '0811511391', 173),
(35, 'AGUS HERRI WIJAYADI, ST', '197608142006041008', 'pptk', '2019-01-14', '087814403801', 71),
(36, 'Erpansyah, ST', '197401242007011018', 'pptk', '2019-01-14', '081351757089', 173),
(37, 'siti', '1946789990078652675', 'pa', '2019-07-01', '081234151678', 73),
(38, 'Iwan Ristianto, AP, M.AP', '197609141994121002', 'ppk', '2019-05-16', '081351106300', 125),
(39, 'nunu', '199308022019032011', 'pptk', '2019-07-02', '08115190208', 73),
(40, 'NURYADI, S.Pd. MA', '196704131988041004', 'ppk', '2019-01-02', '081349703378', 29),
(41, 'siti', '1993080234567990', 'ppk', '2019-07-16', '08115190208', 73),
(42, 'Ir. Ahmad Fanani Saifudin, SH', '196502071992031006', 'ppk', '2019-06-24', '0811511391', 173),
(43, 'Drs. H. Mukhyar, M.AP', '19611171993101001', 'pa', '2019-01-02', '08111111', 130),
(44, 'Drs. H. Mukhyar, M.AP', '19611171993101001', 'ppk', '2019-01-02', '08111111', 130),
(45, 'SAHNAN, S.Pd, M.Pd', '196703271988041001', 'kpa', '2019-01-02', '085246271755', 196),
(46, 'IWAN SUPRIADI', '197708162009011001', 'pptk', '2019-01-01', '083153333044', 175),
(48, 'Ir. H. Juanda, MS', '196612121996031004', 'pptk', '2019-01-02', '0811111111', 130),
(49, 'Ir.H.Arifin Noor, MT', '196008221989031000', 'pa', '2019-03-08', '08115152344', 82),
(89, 'Kartika Estaurina, ST', '198208092006042013', 'pptk', '2019-01-02', '08115112200', 89),
(51, 'H. M. Sultani, SKM', '197105161991011001', 'pptk', '2019-05-01', '082154460444', 58),
(56, 'ISNOOREDY, SE', '197312262005011004', 'pptk', '2019-01-02', '081242662870', 196),
(53, 'Ir. ARIFIN NOOR, ST, MT', '196008221989031006', 'pa', '2019-03-08', '08115152344', 102),
(54, 'SAHNAN, S.Pd, M.Pd', '196703271988041001', 'ppk', '2019-01-02', '085246271755', 196),
(55, 'Ir.H.Lauhem Mahfuzi,M.A.p', '196004251989031008', 'pa', '2019-01-02', '081349787245', 175),
(57, 'Gt. Muhammad effendi, ST', '198706052015021002', 'pptk', '2019-03-01', '082158229891', 94),
(58, 'H. Chandra I. W,  ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 94),
(59, 'Ir. Ahmad Fanani Saifudin, SH', '196502071992031006', 'pa', '2019-01-02', '0811511391', 171),
(60, 'Ir. Ahmad Fanani Saifudin, SH', '196502071992031006', 'ppk', '2019-06-24', '0811511391', 171),
(61, 'Rahmat Rizali, S.ST', '197912062005011011', 'pptk', '2019-01-14', '082153610006', 171),
(62, 'dr. Hj. Dellis JF', '196308161997032001', 'ppk', '2019-01-15', '08125199696', 58),
(63, 'Dr. Machli Riyadi, SH. MH', '197011241991011004', 'pa', '2019-05-13', '0811111111', 61),
(64, 'Dr. Machli Riyadi, SH. MH', '197011241991011004', 'ppk', '2019-05-13', '0811111', 61),
(65, 'Muhammad Risadi', '374832748932', 'pptk', '2019-07-24', '32432432', 61),
(94, 'Kartika Estaurina, ST', '198208092006042013', 'pptk', '2019-01-02', '08115112200', 109),
(67, 'Kartika Estaurina, ST', '198208092006042013', 'pptk', '2019-03-01', '08115112200', 79),
(68, 'H. Chandra I. W,  ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 79),
(69, 'Gt. Muhammad effendi, ST', '198706052015021002', 'pptk', '2019-03-01', '082158229891', 93),
(70, 'H. Chandra I. W,  ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 93),
(71, 'Ir.H.Arifin Noor, MT', '196008221989031006', 'pa', '2019-03-08', '08115152344', 83),
(72, 'Suyatno,ST,MS', '196808032000031008', 'ppk', '2019-07-15', '081351266659', 83),
(73, 'Agus Herri Wijayadi, ST', '197608142006041008', 'pptk', '2019-07-15', '087814403801', 83),
(74, 'Gt. Muhammad effendi, ST', '198706052015021002', 'pptk', '2019-03-01', '082158229891', 72),
(75, 'H. Chandra I. W,  ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 72),
(76, 'Anna Firmauli Hutapea, ST', '198601062015022001', 'pptk', '2019-03-01', '081253197134', 168),
(77, 'SUYATNO, ST, MS.', '196808032000031008', 'kpa', '2019-03-08', '081351266659', 70),
(78, 'Anna Firmauli Hutapea, ST', '198601062015022001', 'pptk', '2019-03-01', '081253197134', 95),
(79, 'SUYATNO, ST, MS.', '196808032000031008', 'ppk', '2019-03-08', '081351266659', 70),
(80, 'AGUS HERRI WIJAYADI, ST', '197608142006041008', 'pptk', '2019-01-14', '087814403801', 70),
(81, 'Ir. ARIFIN NOOR, ST, MT', '196008221989031006', 'pa', '2019-03-08', '08115152344', 108),
(82, 'SUYATNO, ST, MS', '196808032000031008', 'ppk', '2019-03-08', '081351266659', 108),
(83, 'SUYATNO, ST, MS', '196808032000031008', 'kpa', '2019-03-08', '081351266659', 108),
(84, 'ANDINI AMALIA RIFKY, ST', '198712302011012005', 'pptk', '2019-01-02', '082157944197', 108),
(85, 'Ir. Ahmad Fanani Saifudin, SH', '196502071992031006', 'pa', '2019-01-02', '0811511391', 172),
(86, 'Ir. Ahmad Fanani Saifudin, SH', '196502071992031006', 'ppk', '2019-06-24', '0811511391', 172),
(87, 'Rahmat Rizali, S.ST', '197912062005011011', 'pptk', '2019-01-14', '082153610006', 172),
(90, 'H. Chandra I. W, ST, MM', '197107262000031004', 'kpa', '2019-03-01', '0811510688', 89),
(91, 'Kartika Estaurina, ST', '198208092006042013', 'pptk', '2019-01-02', '08115112200', 90),
(92, 'H. Chandra I. W, ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 90),
(93, 'H. Chandra I. W, ST, MM', '197107262000031004', 'kpa', '2019-03-01', '0811510688', 90),
(95, 'H. Chandra I. W, ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 109),
(96, 'H. Chandra I. W, ST, MM', '197107262000031004', 'kpa', '2019-03-01', '0811510688', 109),
(97, 'Kartika Estaurina, ST', '198208092006042013', 'pptk', '2019-01-02', '08115112200', 110),
(98, 'H. Chandra I. W, ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 110),
(99, 'H. Chandra I. W, ST, MM', '197107262000031004', 'kpa', '2019-03-01', '0811510688', 110),
(100, 'Kartika Estaurina, ST', '198208092006042013', 'pptk', '2019-01-02', '08115112200', 78),
(101, 'H. Chandra I. W, ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 78),
(102, 'H. Chandra I. W, ST, MM', '197107262000031004', 'kpa', '2019-03-01', '0811510688', 78),
(103, 'SUYATNO, ST, MS.', '196808032000031008', 'kpa', '2019-03-08', '081351266659', 106),
(104, 'Kartika Estaurina, ST', '198208092006042013', 'pptk', '2019-01-02', '08115112200', 80),
(105, 'H. Chandra I. W, ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 80),
(106, 'H. Chandra I. W, ST, MM', '197107262000031004', 'kpa', '2019-03-01', '0811510688', 80),
(107, 'SURIANATA', '196710081988031011', 'pptk', '2018-02-21', '0811519769', 174),
(108, 'SUYATNO, ST, MS.', '196808032000031008', 'ppk', '2019-03-08', '081351266659', 106),
(109, 'AGUS HERRI WIJAYADI, ST', '197608142006041008', 'pptk', '2019-01-14', '087814403801', 106),
(110, 'SURIANATA', '196710081988031001', 'pptk', '2019-01-15', '0811519769', 174),
(111, 'Ir.H. Lauhem Mahfuzi,M.AP.', '196004251989031008', 'ppk', '2018-01-17', '081349787245', 174),
(112, 'Ir.H. Lauhem Mahfuzi,M.AP.', '196004251989031008', 'kpa', '2019-01-15', '081349787245', 174),
(113, 'Ir.H. Lauhem Mahfuzi,M.AP.', '196004251989031008', 'pa', '2019-01-16', '081349787245', 174),
(114, 'Kartika Estaurina, ST', '198208092006042013', 'pptk', '2019-01-02', '08115112200', 88),
(115, 'H. Chandra I. W, ST, MM', '197107262000031004', 'ppk', '2019-03-01', '0811510688', 88),
(116, 'H. Chandra I. W, ST, MM', '197107262000031004', 'kpa', '2019-03-01', '0811510688', 88);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE IF NOT EXISTS `progress` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `nama`) VALUES
(1, 'Persiapan'),
(2, 'Pemilihan Penyedia'),
(3, 'Hasil Pemilihan'),
(4, 'Kontrak'),
(5, 'Serah Terima (PHO)'),
(6, 'Serah Terima Akhir (FHO)'),
(7, 'Selesai'),
(8, 'Dibatalkan'),
(9, 'Belum Ada Progress');

-- --------------------------------------------------------

--
-- Table structure for table `progress_pekerjaan`
--

CREATE TABLE IF NOT EXISTS `progress_pekerjaan` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `pekerjaan` int(10) unsigned NOT NULL,
  `progress` tinyint(3) unsigned NOT NULL,
  `tgl_progress` date NOT NULL,
  `next_progress` tinyint(3) unsigned NOT NULL,
  `tgl_n_progress` date NOT NULL,
  `ket` varchar(200) NOT NULL,
  `real_keu` decimal(15,2) unsigned NOT NULL,
  `real_fisik` decimal(15,2) unsigned NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pekerjaan` (`pekerjaan`),
  KEY `progress` (`progress`),
  KEY `next_progress` (`next_progress`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=191 ;

--
-- Dumping data for table `progress_pekerjaan`
--

INSERT INTO `progress_pekerjaan` (`id`, `pekerjaan`, `progress`, `tgl_progress`, `next_progress`, `tgl_n_progress`, `ket`, `real_keu`, `real_fisik`, `create_date`) VALUES
(63, 160, 3, '2019-03-08', 4, '2019-03-14', 'Surat Penunjukan Penyedia Barang/Jasa ditetapkan', '0.00', '0.00', '2019-07-22 15:19:50'),
(70, 158, 1, '2019-02-27', 2, '2019-03-13', 'Penetapan KAK, Penetapan HPS', '0.00', '0.00', '2019-07-22 16:34:15'),
(62, 160, 2, '2019-01-28', 3, '2019-02-22', 'Pengumuman Pascakualifikasi', '0.00', '0.00', '2019-07-22 15:13:55'),
(72, 160, 4, '2019-03-31', 5, '2019-04-26', 'Pekerjaan Konstruksi (Besi Rangka), Perakitan dan Pemasangan Layar Videotron dan Penyambungan Listrik', '0.00', '40.00', '2019-07-23 13:09:37'),
(56, 158, 4, '2019-06-30', 5, '2019-07-31', 'Pembayaran tahap pertama s.d Mei 2019', '112430450.00', '14.81', '2019-07-22 11:51:59'),
(57, 160, 1, '2019-01-02', 2, '2019-01-22', 'Penetapan HPS (Januari 2019), Penetapan KAK (Januari 2019), Surat Permohonan Penunjukan Pokja (08-01-2019)', '0.00', '0.00', '2019-07-22 14:46:24'),
(65, 160, 4, '2019-03-14', 5, '2019-04-26', 'Kontrak ditandatangani, pekerjaan pengadaan videotron dimulai', '0.00', '0.00', '2019-07-22 15:26:11'),
(68, 160, 5, '2019-04-26', 6, '2021-04-26', 'Pekerjaan sudah selesai, masuk tahapan penanggungan dan resiko', '906947250.00', '100.00', '2019-07-22 15:33:20'),
(137, 83, 4, '2019-07-12', 5, '2019-12-31', 'Pencairan Uang Muka', '13299878454.00', '1.24', '2019-07-24 13:53:50'),
(74, 125, 2, '2019-07-24', 3, '2019-07-30', 'Dalam Tahap Masa Sanggah Pemenang', '0.00', '0.00', '2019-07-24 11:23:30'),
(101, 71, 1, '2019-05-03', 2, '2019-05-16', 'Pengajuan ke Sistem LPSE', '0.00', '0.00', '2019-07-24 11:56:47'),
(76, 173, 1, '2019-04-04', 2, '2019-06-19', 'penetapan HPS', '0.00', '0.00', '2019-07-24 11:38:52'),
(77, 130, 1, '2019-03-01', 2, '2019-03-15', 'Penetapan HPS (Maret 2019),  Penetapan KAK (maret 2019)', '0.00', '0.00', '2019-07-24 11:38:54'),
(79, 173, 1, '2019-04-26', 2, '2019-06-19', 'penetapan KAK', '0.00', '0.00', '2019-07-24 11:41:25'),
(80, 130, 1, '2019-03-20', 2, '2019-04-03', 'Pengajuan ke LPSE', '0.00', '0.00', '2019-07-24 11:41:53'),
(81, 173, 1, '2019-05-22', 2, '2019-06-19', 'Pengajuan ke LPSE', '0.00', '0.00', '2019-07-24 11:43:07'),
(86, 81, 1, '2019-05-06', 2, '2019-05-09', 'Tanggal Penetapan HPS dan KAK', '0.00', '0.00', '2019-07-24 11:47:54'),
(84, 102, 1, '2019-05-01', 2, '2019-05-03', 'Penyiapan HPS dan KAK', '0.00', '0.00', '2019-07-24 11:45:56'),
(85, 130, 2, '2019-04-18', 3, '2019-06-18', 'Pengumuman Prakualifikasi', '0.00', '0.00', '2019-07-24 11:47:00'),
(87, 173, 2, '2019-06-19', 3, '2019-07-10', 'Tanggal Tayang tender di LPSE', '0.00', '0.00', '2019-07-24 11:48:01'),
(88, 102, 1, '2019-05-06', 2, '2019-05-17', 'Pengajuan ke Sistem LPSE', '0.00', '0.00', '2019-07-24 11:48:03'),
(89, 119, 2, '2019-05-21', 3, '2019-07-15', 'pengumuman tender mulai tayang 21 Mei 2019', '0.00', '0.00', '2019-07-24 11:48:45'),
(90, 81, 2, '2019-05-13', 3, '2019-06-19', 'Tanggal Tayang  Tender/Seleksi  di LPSE', '0.00', '0.00', '2019-07-24 11:50:08'),
(91, 173, 3, '2019-07-10', 4, '2019-07-15', 'Tanggal SPPBJ', '0.00', '0.00', '2019-07-24 11:50:50'),
(92, 119, 3, '2019-07-15', 4, '2019-07-17', 'penetapan SPPBJ', '0.00', '0.00', '2019-07-24 11:52:03'),
(118, 130, 4, '2019-07-24', 5, '2019-09-29', 'Laporan Pendahuluan sudah diserahkan oleh penyedia', '0.00', '20.00', '2019-07-24 12:07:34'),
(94, 130, 3, '2019-06-18', 4, '2019-07-01', 'Penetapan SPPBJ', '0.00', '0.00', '2019-07-24 11:53:14'),
(112, 102, 2, '2019-06-21', 2, '2019-07-12', 'Pengumuman Pascakualifikasi (Tayang Tender Ulang)', '0.00', '0.00', '2019-07-24 12:02:27'),
(104, 81, 3, '2019-06-19', 4, '2019-06-20', 'Tanggal Penetapan SPPBJ', '0.00', '0.00', '2019-07-24 11:58:11'),
(98, 71, 1, '2019-04-30', 2, '2019-05-16', 'Penetapan KAK', '0.00', '0.00', '2019-07-24 11:55:34'),
(117, 102, 3, '2019-07-18', 4, '2019-07-19', 'Surat Penunjukan Penyedia Barang/Jasa', '0.00', '0.00', '2019-07-24 12:07:07'),
(100, 71, 1, '2019-05-02', 2, '2019-05-16', 'Penetapan HPS', '0.00', '0.00', '2019-07-24 11:56:09'),
(158, 109, 3, '2019-07-16', 4, '2019-07-18', 'Tanggal Surat Penunjukkan Penyedia Barang/Jasa (SPPBJ)', '0.00', '0.00', '2019-07-24 15:51:20'),
(107, 130, 4, '2019-07-02', 5, '2019-09-29', 'Penandatanganan Kontrak', '0.00', '0.00', '2019-07-24 11:59:22'),
(108, 173, 4, '2019-07-15', 5, '2019-11-11', 'Tanggal Kontrak', '0.00', '0.00', '2019-07-24 11:59:49'),
(109, 71, 2, '2019-05-17', 3, '2019-06-24', 'Pengumuman Pascakualifikasi', '0.00', '0.00', '2019-07-24 11:59:54'),
(110, 119, 4, '2019-07-17', 5, '2019-11-13', 'penandatanganan kontrak', '0.00', '0.00', '2019-07-24 12:00:34'),
(115, 71, 3, '2019-06-24', 4, '2019-06-24', 'Surat Penunjukan Penyedia Barang Jasa', '0.00', '0.00', '2019-07-24 12:03:56'),
(116, 102, 3, '2019-07-12', 4, '2019-07-19', 'Pengumuman Pemenang', '0.00', '0.00', '2019-07-24 12:04:04'),
(121, 82, 1, '2019-03-15', 2, '2019-03-19', 'Penetapan HPS dan KAK', '0.00', '0.00', '2019-07-24 12:21:37'),
(120, 102, 4, '2019-07-19', 5, '2019-11-15', 'Penandatanganan Kontrak', '0.00', '0.00', '2019-07-24 12:09:12'),
(122, 171, 2, '2019-06-19', 3, '2019-07-24', 'pengumuman tender', '0.00', '0.00', '2019-07-24 12:23:48'),
(123, 82, 1, '2019-04-12', 2, '2019-04-22', 'Penetapan HPS dan KAK (lelang Ulang)', '0.00', '0.00', '2019-07-24 12:26:55'),
(124, 82, 2, '2019-04-16', 3, '2019-06-18', 'Pengumuman Prakualifikasi (lelang Ulang)', '0.00', '0.00', '2019-07-24 12:29:26'),
(125, 82, 3, '2019-06-25', 4, '2019-06-25', 'Penetapan SPPBJ', '0.00', '0.00', '2019-07-24 12:30:46'),
(126, 82, 4, '2019-06-25', 5, '2019-12-31', 'Penandatanganan Kontrak', '0.00', '0.00', '2019-07-24 12:58:45'),
(127, 71, 4, '2019-06-26', 5, '2019-12-07', 'Penandatanganan Kontrak', '0.00', '0.00', '2019-07-24 13:13:45'),
(128, 61, 1, '2019-07-15', 2, '2019-07-29', 'penetapan HPS, Penetapan KAK, Pengajuan ke LPSE (16 Juli 2019)', '0.00', '0.00', '2019-07-24 13:23:29'),
(129, 83, 1, '2019-04-01', 2, '2019-07-11', 'Penetapan HPS dan KAK', '0.00', '0.00', '2019-07-24 13:41:22'),
(130, 83, 1, '2019-04-01', 2, '2019-07-11', 'Pengajuan ke Sistem LPSE', '0.00', '0.00', '2019-07-24 13:43:21'),
(131, 83, 2, '2019-04-11', 3, '2019-05-27', 'Pengumuman Prakualifikasi', '0.00', '0.00', '2019-07-24 13:44:46'),
(132, 58, 1, '2019-05-16', 2, '2019-07-16', 'penetapan HPS, Penetapan KAK, Pengajuan ke LPSE (2 Juli 2019)', '0.00', '0.00', '2019-07-24 13:46:08'),
(133, 58, 2, '2019-07-19', 3, '2019-08-15', 'Pengumuman Pascakualifikasi', '0.00', '0.00', '2019-07-24 13:47:33'),
(134, 83, 3, '2019-05-29', 4, '2019-06-10', 'Penetapan SPPBJ', '0.00', '0.00', '2019-07-24 13:47:36'),
(135, 83, 4, '2019-06-10', 5, '2019-12-31', 'Penandatanganan Kontrak', '0.00', '0.00', '2019-07-24 13:48:50'),
(139, 119, 1, '2019-04-16', 2, '2019-05-21', 'penetapan HPS, penetapan KAK, pengajuan sistem ke LPSE (9 Mei 2019)', '0.00', '0.00', '2019-07-24 14:26:39'),
(138, 81, 4, '2019-06-20', 5, '2019-11-20', 'tanggal penandatanganan kontrak', '124780500.00', '11.00', '2019-07-24 13:54:32'),
(140, 171, 1, '2019-05-16', 2, '2019-06-19', 'penetapan HPS, penetapan KAK, pengajuan sistem ke LPSE (23 Mei 2019)', '0.00', '0.00', '2019-07-24 14:30:48'),
(141, 171, 3, '2019-07-24', 4, '2019-07-30', 'penetapan pemenang', '0.00', '0.00', '2019-07-24 14:33:18'),
(142, 172, 1, '2019-05-27', 2, '2019-07-02', 'penetapan HPS, penetapan KAK, pengajuan sistem ke LPSE (21 Juni 2019)', '0.00', '0.00', '2019-07-24 14:57:22'),
(144, 172, 2, '2019-07-02', 3, '2019-08-01', 'pengumuman tender mulai tayang', '0.00', '0.00', '2019-07-24 15:00:24'),
(147, 89, 2, '2019-05-17', 3, '2019-06-25', 'Tanggal tayang tender di LPSE', '0.00', '0.00', '2019-07-24 15:04:11'),
(148, 89, 1, '2019-03-27', 2, '2019-05-17', 'Tanggal Penetapan HPS dan KAK dan Tanggal pengajuan ke sistem LPSE', '0.00', '0.00', '2019-07-24 15:05:17'),
(149, 89, 3, '2019-06-25', 4, '2019-06-28', 'Tanggal Surat Penunjukkan Penyedia Barang/Jasa (SPPBJ)', '0.00', '0.00', '2019-07-24 15:07:47'),
(150, 89, 4, '2019-06-28', 5, '2019-12-24', 'Tanggal Kontrak', '1060588500.00', '5.00', '2019-07-24 15:11:08'),
(151, 90, 1, '2019-04-23', 2, '2019-05-17', 'Tanggal Penetapan HPS dan KAK dan Tanggal pengajuan ke sistem LPSE', '0.00', '0.00', '2019-07-24 15:37:58'),
(152, 90, 2, '2019-04-23', 3, '2019-06-25', 'Tanggal tayang tender di LPSE', '0.00', '0.00', '2019-07-24 15:38:46'),
(153, 90, 3, '2019-06-25', 4, '2019-06-28', 'Tanggal Surat Penunjukkan Penyedia Barang/Jasa (SPPBJ)', '0.00', '0.00', '2019-07-24 15:39:40'),
(155, 90, 4, '2019-06-28', 5, '2019-11-24', 'Tanggal Kontrak', '811671600.00', '5.00', '2019-07-24 15:44:12'),
(156, 109, 1, '2019-05-10', 2, '2019-05-31', 'Tanggal Penetapan HPS dan KAK dan Tanggal pengajuan ke sistem LPSE', '0.00', '0.00', '2019-07-24 15:48:41'),
(157, 109, 2, '2019-05-31', 3, '2019-07-16', 'Tanggal tayang tender di LPSE', '0.00', '0.00', '2019-07-24 15:49:36'),
(166, 70, 1, '2019-04-26', 2, '2019-05-15', 'Penetapan HPS dan KAK', '0.00', '0.00', '2019-07-24 16:22:37'),
(161, 109, 4, '2019-07-18', 5, '2019-11-14', 'Tanggal Kontrak', '0.00', '0.00', '2019-07-24 15:52:43'),
(162, 110, 1, '2019-05-10', 2, '2019-06-10', 'Tanggal Penetapan HPS dan KAK dan Tanggal pengajuan ke sistem LPSE', '0.00', '0.00', '2019-07-24 16:17:23'),
(163, 110, 2, '2019-06-10', 3, '2019-07-11', 'Tanggal tayang tender di LPSE', '0.00', '0.00', '2019-07-24 16:18:29'),
(164, 110, 3, '2019-07-11', 4, '2019-07-17', 'Tanggal Surat Penunjukkan Penyedia Barang/Jasa (SPPBJ)', '0.00', '0.00', '2019-07-24 16:19:14'),
(165, 110, 4, '2019-07-17', 5, '2019-10-14', 'Tanggal Kontrak', '0.00', '0.00', '2019-07-24 16:19:48'),
(167, 70, 1, '2019-04-30', 2, '2019-05-15', 'Pengajuan ke Sistem LPSE', '0.00', '0.00', '2019-07-24 16:22:53'),
(168, 70, 2, '2019-05-14', 3, '2019-07-17', 'Pengumuman Prakualifikasi', '0.00', '0.00', '2019-07-24 16:24:43'),
(169, 70, 3, '2019-07-19', 4, '2019-07-19', 'Surat Penunjukan Penyedia Barang Jasa', '0.00', '0.00', '2019-07-24 16:25:40'),
(170, 70, 4, '2019-07-19', 5, '2019-12-15', 'Penandatanganan Kontrak', '0.00', '0.00', '2019-07-24 16:26:11'),
(171, 78, 1, '2019-05-22', 2, '2019-07-12', 'Tanggal Penetapan HPS dan KAK dan Tanggal pengajuan ke sistem LPSE', '0.00', '0.00', '2019-07-24 16:31:53'),
(172, 78, 2, '2019-07-12', 3, '2019-09-02', 'Tanggal tayang tender di LPSE', '0.00', '0.00', '2019-07-24 16:32:26'),
(189, 71, 4, '2019-07-15', 5, '2019-12-07', 'Pencairan Uang Muka sebanyak 30 %', '2666666666.00', '13.89', '2019-07-25 09:19:27'),
(174, 80, 1, '2019-02-18', 1, '2019-02-27', 'Tanggal Penetapan HPS dan KAK', '0.00', '0.00', '2019-07-24 17:10:19'),
(175, 80, 1, '2019-02-27', 2, '2019-03-12', 'Tanggal pengajuan ke sistem LPSE', '0.00', '0.00', '2019-07-24 17:11:02'),
(176, 80, 2, '2019-03-12', 3, '2019-05-21', 'Tanggal tayang tender di LPSE', '0.00', '0.00', '2019-07-24 17:12:17'),
(178, 174, 1, '2019-05-22', 2, '2019-06-03', 'Penyiapan dukomen tender', '0.00', '100.00', '2019-07-24 21:47:40'),
(179, 174, 2, '2019-07-02', 3, '2019-06-03', 'Penyiapan dukomen tender', '0.00', '100.00', '2019-07-24 21:48:28'),
(180, 174, 4, '2019-07-08', 5, '2019-09-05', 'Kontrak Kegiatan Fisik dan Pengawasan', '0.00', '50.00', '2019-07-24 21:50:09'),
(181, 80, 3, '2019-05-21', 4, '2019-06-10', 'Tanggal Surat Penunjukkan Penyedia Barang/Jasa (SPPBJ)', '0.00', '0.00', '2019-07-25 08:38:34'),
(182, 80, 4, '2019-06-10', 5, '2019-12-24', 'Tanggal Kontrak', '0.00', '0.00', '2019-07-25 08:39:41'),
(183, 88, 1, '2019-03-08', 2, '2019-03-21', 'Tanggal Penetapan HPS dan KAK dan Tanggal pengajuan ke sistem LPSE', '0.00', '0.00', '2019-07-25 08:48:27'),
(184, 88, 2, '2019-03-21', 3, '2019-06-25', 'Tanggal tayang seleksi di LPSE', '0.00', '0.00', '2019-07-25 08:50:08'),
(185, 88, 3, '2019-06-25', 4, '2019-06-28', 'Tanggal Surat Penunjukkan Penyedia Barang/Jasa (SPPBJ)', '0.00', '0.00', '2019-07-25 08:51:11'),
(186, 88, 4, '2019-06-28', 5, '2019-12-24', 'Tanggal Kontrak', '0.00', '0.00', '2019-07-25 08:51:54'),
(188, 106, 8, '2019-06-19', 7, '2019-06-19', 'Kegiatan tidak direalisasikan sebagai tindak lanjut dari Laporan Hasil Pemeriksaan Inspektorat Provinsi Kalimantan Selatan TA. 2019 pada Barenlitbangda Kota Banjarmasin berdasarkan surat Plh. Kepala D', '0.00', '0.00', '2019-07-25 09:15:41'),
(190, 79, 8, '2019-07-15', 8, '2019-07-15', 'Dibatalkan', '0.00', '0.00', '2019-07-25 14:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `serah_terima`
--

CREATE TABLE IF NOT EXISTS `serah_terima` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomor` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `penyedia` varchar(200) NOT NULL,
  `pekerjaan` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pekerjaan` (`pekerjaan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `serah_terima`
--

INSERT INTO `serah_terima` (`id`, `nomor`, `tanggal`, `penyedia`, `pekerjaan`) VALUES
(4, '01/BASTB/SP-KESRA/V/2019', '2019-05-27', 'CV. VASUNDAN ELC', 158),
(3, '001/BASTP-Keg.PSPK/Videotron/IV/2019', '2019-04-26', 'CV. Megatech', 160);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
