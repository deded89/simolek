-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2019 at 10:05 AM
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
-- Table structure for table `kontrak`
--

CREATE TABLE `kontrak` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `penyedia` varchar(200) NOT NULL,
  `lama` varchar(50) NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL,
  `ket` varchar(200) NOT NULL,
  `pekerjaan` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`id`, `nomor`, `tanggal`, `penyedia`, `lama`, `awal`, `akhir`, `ket`, `pekerjaan`) VALUES
(1, 'fkjkasjd', '0000-00-00', 'flsdflksd', 'fdsa hari', '0000-00-00', '0000-00-00', 'fksdafjdks', 0),
(2, 'ksjfkadsj', '2019-05-01', 'kfjsdfk', '34 hari kerja', '2019-05-20', '2019-05-16', 'flskdflds', 0),
(9, 'kjkjkjkj/e5354/fkdsajfkdsf/fdasf', '2019-05-08', 'pt fdskjfakds', '78 hari kalender', '2019-05-01', '2019-05-31', 'addendum', 6),
(10, 'xxxx.xxx', '2019-06-13', 'PT. ABC', '25 Hari Kalender', '2019-06-14', '2019-07-06', '-', 7);

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
(9, '-3.319638606', '114.587241411', 'Patung Kelabau', 7),
(10, '-3.332213045', '114.613752365', 'Jl A.Yani', 7),
(11, '-3.332994925', '114.585138559', 'RS. SS', 3);

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
(2, 'Tender');

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
  `realisasi` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `nama`, `kegiatan`, `skpd`, `jenis`, `metode`, `pagu`, `realisasi`) VALUES
(3, 'Pembangunan Rumah Sakit Sultan Suriansyah', 'Pembagunan Sarpras Kesehatan', 3, 2, 2, '50000000000.00', '45000000000.00'),
(7, 'Pembangunan Tugu Kelabau', 'Pembangunan Taman Kota', 4, 2, 2, '300000000.00', '289000000.00');

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
(5, 'Serah Terima');

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
  `real_fisik` decimal(15,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress_pekerjaan`
--

INSERT INTO `progress_pekerjaan` (`id`, `pekerjaan`, `progress`, `tgl_progress`, `next_progress`, `tgl_n_progress`, `ket`, `real_keu`, `real_fisik`) VALUES
(4, 7, 1, '2019-06-01', 2, '2019-07-01', 'Pembuatan Rancangan Kontrak', '0.00', '0.00'),
(5, 7, 2, '2019-07-01', 3, '2019-08-01', 'Upload dokumen penawaran', '2000000.00', '10.00');

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
(2, 'yyy.yyy', '2019-07-08', 'PT. ABC', 7),
(3, 'zz.zzz', '2019-07-03', 'PT. Sulaiman', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `metode` (`metode`);

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
-- AUTO_INCREMENT for table `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `metode`
--
ALTER TABLE `metode`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `progress_pekerjaan`
--
ALTER TABLE `progress_pekerjaan`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `serah_terima`
--
ALTER TABLE `serah_terima`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

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
