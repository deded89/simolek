-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2019 at 03:40 AM
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
-- Database: `epiz_21636198_lkpk`
--

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) UNSIGNED NOT NULL,
  `kode_kegiatan` varchar(50) NOT NULL,
  `nama_kegiatan` varchar(500) NOT NULL,
  `sumber_dana` varchar(50) NOT NULL,
  `tahun_anggaran` smallint(4) NOT NULL,
  `skpd` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pagu`
--

CREATE TABLE `nilai_pagu` (
  `id_nilai_pagu` int(10) UNSIGNED NOT NULL,
  `nilai` decimal(15,2) NOT NULL,
  `kegiatan` int(10) UNSIGNED NOT NULL,
  `periode_pagu` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pagu_skpd`
--

CREATE TABLE `pagu_skpd` (
  `id_nilai_pagu` int(10) UNSIGNED NOT NULL,
  `nilai` decimal(15,2) NOT NULL,
  `skpd` mediumint(8) UNSIGNED NOT NULL,
  `periode_pagu` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `periode_pagu`
--

CREATE TABLE `periode_pagu` (
  `id_per_pagu` tinyint(3) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `periode_setting`
--

CREATE TABLE `periode_setting` (
  `id_per_setting` int(10) UNSIGNED NOT NULL,
  `tahun` smallint(4) UNSIGNED NOT NULL,
  `skpd` mediumint(8) UNSIGNED NOT NULL,
  `b01` tinyint(3) UNSIGNED NOT NULL,
  `b02` tinyint(3) UNSIGNED NOT NULL,
  `b03` tinyint(3) UNSIGNED NOT NULL,
  `b04` tinyint(3) UNSIGNED NOT NULL,
  `b05` tinyint(3) UNSIGNED NOT NULL,
  `b06` tinyint(3) UNSIGNED NOT NULL,
  `b07` tinyint(3) UNSIGNED NOT NULL,
  `b08` tinyint(3) UNSIGNED NOT NULL,
  `b09` tinyint(3) UNSIGNED NOT NULL,
  `b10` tinyint(3) UNSIGNED NOT NULL,
  `b11` tinyint(3) UNSIGNED NOT NULL,
  `b12` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode_setting`
--

INSERT INTO `periode_setting` (`id_per_setting`, `tahun`, `skpd`, `b01`, `b02`, `b03`, `b04`, `b05`, `b06`, `b07`, `b08`, `b09`, `b10`, `b11`, `b12`) VALUES
(1, 2019, 5, 5, 5, 5, 5, 5, 5, 5, 5, 4, 4, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `real_fisik`
--

CREATE TABLE `real_fisik` (
  `id_real_fisik` int(10) UNSIGNED NOT NULL,
  `kegiatan` int(11) NOT NULL,
  `periode_pagu` tinyint(3) UNSIGNED NOT NULL,
  `b01` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b02` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b03` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b04` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b05` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b06` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b07` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b08` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b09` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b10` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b11` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b12` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb01` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb02` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb03` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb04` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb05` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb06` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb07` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb08` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb09` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb10` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb11` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb12` decimal(10,7) NOT NULL DEFAULT '0.0000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `real_fisik_skpd`
--

CREATE TABLE `real_fisik_skpd` (
  `id_real_fisik_skpd` int(10) UNSIGNED NOT NULL,
  `skpd` mediumint(8) NOT NULL,
  `periode_pagu` tinyint(3) UNSIGNED NOT NULL,
  `b01` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b02` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b03` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b04` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b05` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b06` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b07` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b08` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b09` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b10` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b11` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `b12` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb01` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb02` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb03` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb04` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb05` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb06` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb07` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb08` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb09` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb10` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb11` decimal(10,7) NOT NULL DEFAULT '0.0000000',
  `kumb12` decimal(10,7) NOT NULL DEFAULT '0.0000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `real_keu`
--

CREATE TABLE `real_keu` (
  `id_real_keu` int(10) UNSIGNED NOT NULL,
  `kegiatan` int(11) NOT NULL,
  `periode_pagu` tinyint(3) UNSIGNED NOT NULL,
  `b01` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b02` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b03` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b04` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b05` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b06` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b07` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b08` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b09` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b10` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b11` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b12` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb01` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb02` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb03` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb04` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb05` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb06` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb07` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb08` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb09` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb10` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb11` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb12` decimal(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `real_keu_skpd`
--

CREATE TABLE `real_keu_skpd` (
  `id_real_keu_skpd` int(10) UNSIGNED NOT NULL,
  `skpd` mediumint(8) NOT NULL,
  `periode_pagu` tinyint(3) UNSIGNED NOT NULL,
  `b01` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b02` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b03` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b04` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b05` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b06` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b07` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b08` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b09` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b10` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b11` decimal(15,2) NOT NULL DEFAULT '0.00',
  `b12` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb01` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb02` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb03` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb04` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb05` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb06` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb07` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb08` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb09` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb10` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb11` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kumb12` decimal(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ren_fisik`
--

CREATE TABLE `ren_fisik` (
  `id_ren_fisik` int(10) UNSIGNED NOT NULL,
  `kegiatan` int(11) NOT NULL,
  `periode_pagu` tinyint(3) UNSIGNED NOT NULL,
  `b01` decimal(10,7) UNSIGNED NOT NULL,
  `b02` decimal(10,7) UNSIGNED NOT NULL,
  `b03` decimal(10,7) UNSIGNED NOT NULL,
  `b04` decimal(10,7) UNSIGNED NOT NULL,
  `b05` decimal(10,7) UNSIGNED NOT NULL,
  `b06` decimal(10,7) UNSIGNED NOT NULL,
  `b07` decimal(10,7) UNSIGNED NOT NULL,
  `b08` decimal(10,7) UNSIGNED NOT NULL,
  `b09` decimal(10,7) UNSIGNED NOT NULL,
  `b10` decimal(10,7) UNSIGNED NOT NULL,
  `b11` decimal(10,7) UNSIGNED NOT NULL,
  `b12` decimal(10,7) UNSIGNED NOT NULL,
  `kumb01` decimal(10,7) UNSIGNED NOT NULL,
  `kumb02` decimal(10,7) UNSIGNED NOT NULL,
  `kumb03` decimal(10,7) UNSIGNED NOT NULL,
  `kumb04` decimal(10,7) UNSIGNED NOT NULL,
  `kumb05` decimal(10,7) UNSIGNED NOT NULL,
  `kumb06` decimal(10,7) UNSIGNED NOT NULL,
  `kumb07` decimal(10,7) UNSIGNED NOT NULL,
  `kumb08` decimal(10,7) UNSIGNED NOT NULL,
  `kumb09` decimal(10,7) UNSIGNED NOT NULL,
  `kumb10` decimal(10,7) UNSIGNED NOT NULL,
  `kumb11` decimal(10,7) UNSIGNED NOT NULL,
  `kumb12` decimal(10,7) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ren_fisik_skpd`
--

CREATE TABLE `ren_fisik_skpd` (
  `id_ren_fisik_skpd` int(10) UNSIGNED NOT NULL,
  `skpd` mediumint(8) UNSIGNED NOT NULL,
  `periode_pagu` tinyint(3) UNSIGNED NOT NULL,
  `b01` decimal(10,7) UNSIGNED NOT NULL,
  `b02` decimal(10,7) UNSIGNED NOT NULL,
  `b03` decimal(10,7) UNSIGNED NOT NULL,
  `b04` decimal(10,7) UNSIGNED NOT NULL,
  `b05` decimal(10,7) UNSIGNED NOT NULL,
  `b06` decimal(10,7) UNSIGNED NOT NULL,
  `b07` decimal(10,7) UNSIGNED NOT NULL,
  `b08` decimal(10,7) UNSIGNED NOT NULL,
  `b09` decimal(10,7) UNSIGNED NOT NULL,
  `b10` decimal(10,7) UNSIGNED NOT NULL,
  `b11` decimal(10,7) UNSIGNED NOT NULL,
  `b12` decimal(10,7) UNSIGNED NOT NULL,
  `kumb01` decimal(10,7) UNSIGNED NOT NULL,
  `kumb02` decimal(10,7) UNSIGNED NOT NULL,
  `kumb03` decimal(10,7) UNSIGNED NOT NULL,
  `kumb04` decimal(10,7) UNSIGNED NOT NULL,
  `kumb05` decimal(10,7) UNSIGNED NOT NULL,
  `kumb06` decimal(10,7) UNSIGNED NOT NULL,
  `kumb07` decimal(10,7) UNSIGNED NOT NULL,
  `kumb08` decimal(10,7) UNSIGNED NOT NULL,
  `kumb09` decimal(10,7) UNSIGNED NOT NULL,
  `kumb10` decimal(10,7) UNSIGNED NOT NULL,
  `kumb11` decimal(10,7) UNSIGNED NOT NULL,
  `kumb12` decimal(10,7) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ren_keu`
--

CREATE TABLE `ren_keu` (
  `id_ren_keu` int(10) UNSIGNED NOT NULL,
  `kegiatan` int(11) NOT NULL,
  `periode_pagu` tinyint(3) UNSIGNED NOT NULL,
  `b01` decimal(15,2) UNSIGNED NOT NULL,
  `b02` decimal(15,2) UNSIGNED NOT NULL,
  `b03` decimal(15,2) UNSIGNED NOT NULL,
  `b04` decimal(15,2) UNSIGNED NOT NULL,
  `b05` decimal(15,2) UNSIGNED NOT NULL,
  `b06` decimal(15,2) UNSIGNED NOT NULL,
  `b07` decimal(15,2) UNSIGNED NOT NULL,
  `b08` decimal(15,2) UNSIGNED NOT NULL,
  `b09` decimal(15,2) UNSIGNED NOT NULL,
  `b10` decimal(15,2) UNSIGNED NOT NULL,
  `b11` decimal(15,2) UNSIGNED NOT NULL,
  `b12` decimal(15,2) UNSIGNED NOT NULL,
  `kumb01` decimal(15,2) UNSIGNED NOT NULL,
  `kumb02` decimal(15,2) UNSIGNED NOT NULL,
  `kumb03` decimal(15,2) UNSIGNED NOT NULL,
  `kumb04` decimal(15,2) UNSIGNED NOT NULL,
  `kumb05` decimal(15,2) UNSIGNED NOT NULL,
  `kumb06` decimal(15,2) UNSIGNED NOT NULL,
  `kumb07` decimal(15,2) UNSIGNED NOT NULL,
  `kumb08` decimal(15,2) UNSIGNED NOT NULL,
  `kumb09` decimal(15,2) UNSIGNED NOT NULL,
  `kumb10` decimal(15,2) UNSIGNED NOT NULL,
  `kumb11` decimal(15,2) UNSIGNED NOT NULL,
  `kumb12` decimal(15,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ren_keu_skpd`
--

CREATE TABLE `ren_keu_skpd` (
  `id_ren_keu_skpd` int(10) UNSIGNED NOT NULL,
  `skpd` mediumint(8) UNSIGNED NOT NULL,
  `periode_pagu` tinyint(3) UNSIGNED NOT NULL,
  `b01` decimal(15,2) UNSIGNED NOT NULL,
  `b02` decimal(15,2) UNSIGNED NOT NULL,
  `b03` decimal(15,2) UNSIGNED NOT NULL,
  `b04` decimal(15,2) UNSIGNED NOT NULL,
  `b05` decimal(15,2) UNSIGNED NOT NULL,
  `b06` decimal(15,2) UNSIGNED NOT NULL,
  `b07` decimal(15,2) UNSIGNED NOT NULL,
  `b08` decimal(15,2) UNSIGNED NOT NULL,
  `b09` decimal(15,2) UNSIGNED NOT NULL,
  `b10` decimal(15,2) UNSIGNED NOT NULL,
  `b11` decimal(15,2) UNSIGNED NOT NULL,
  `b12` decimal(15,2) UNSIGNED NOT NULL,
  `kumb01` decimal(15,2) UNSIGNED NOT NULL,
  `kumb02` decimal(15,2) UNSIGNED NOT NULL,
  `kumb03` decimal(15,2) UNSIGNED NOT NULL,
  `kumb04` decimal(15,2) UNSIGNED NOT NULL,
  `kumb05` decimal(15,2) UNSIGNED NOT NULL,
  `kumb06` decimal(15,2) UNSIGNED NOT NULL,
  `kumb07` decimal(15,2) UNSIGNED NOT NULL,
  `kumb08` decimal(15,2) UNSIGNED NOT NULL,
  `kumb09` decimal(15,2) UNSIGNED NOT NULL,
  `kumb10` decimal(15,2) UNSIGNED NOT NULL,
  `kumb11` decimal(15,2) UNSIGNED NOT NULL,
  `kumb12` decimal(15,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD UNIQUE KEY `kode_kegiatan` (`kode_kegiatan`),
  ADD KEY `skpd` (`skpd`);

--
-- Indexes for table `nilai_pagu`
--
ALTER TABLE `nilai_pagu`
  ADD PRIMARY KEY (`id_nilai_pagu`),
  ADD KEY `kegiatan` (`kegiatan`),
  ADD KEY `periode_pagu` (`periode_pagu`);

--
-- Indexes for table `pagu_skpd`
--
ALTER TABLE `pagu_skpd`
  ADD PRIMARY KEY (`id_nilai_pagu`),
  ADD KEY `skpd` (`skpd`),
  ADD KEY `periode_pagu` (`periode_pagu`);

--
-- Indexes for table `periode_pagu`
--
ALTER TABLE `periode_pagu`
  ADD PRIMARY KEY (`id_per_pagu`);

--
-- Indexes for table `periode_setting`
--
ALTER TABLE `periode_setting`
  ADD PRIMARY KEY (`id_per_setting`),
  ADD KEY `skpd` (`skpd`),
  ADD KEY `b01` (`b01`),
  ADD KEY `b02` (`b02`),
  ADD KEY `b03` (`b03`),
  ADD KEY `b04` (`b04`),
  ADD KEY `b05` (`b05`),
  ADD KEY `b06` (`b06`),
  ADD KEY `b07` (`b07`),
  ADD KEY `b08` (`b08`),
  ADD KEY `b09` (`b09`),
  ADD KEY `b10` (`b10`),
  ADD KEY `b11` (`b11`),
  ADD KEY `b12` (`b12`);

--
-- Indexes for table `real_fisik`
--
ALTER TABLE `real_fisik`
  ADD PRIMARY KEY (`id_real_fisik`),
  ADD KEY `kegiatan` (`kegiatan`),
  ADD KEY `periode_pagu` (`periode_pagu`);

--
-- Indexes for table `real_fisik_skpd`
--
ALTER TABLE `real_fisik_skpd`
  ADD PRIMARY KEY (`id_real_fisik_skpd`),
  ADD KEY `kegiatan` (`skpd`),
  ADD KEY `periode_pagu` (`periode_pagu`);

--
-- Indexes for table `real_keu`
--
ALTER TABLE `real_keu`
  ADD PRIMARY KEY (`id_real_keu`),
  ADD KEY `kegiatan` (`kegiatan`),
  ADD KEY `periode_pagu` (`periode_pagu`);

--
-- Indexes for table `real_keu_skpd`
--
ALTER TABLE `real_keu_skpd`
  ADD PRIMARY KEY (`id_real_keu_skpd`),
  ADD KEY `kegiatan` (`skpd`),
  ADD KEY `periode_pagu` (`periode_pagu`);

--
-- Indexes for table `ren_fisik`
--
ALTER TABLE `ren_fisik`
  ADD PRIMARY KEY (`id_ren_fisik`),
  ADD KEY `periode_pagu` (`periode_pagu`),
  ADD KEY `kegiatan` (`kegiatan`);

--
-- Indexes for table `ren_fisik_skpd`
--
ALTER TABLE `ren_fisik_skpd`
  ADD PRIMARY KEY (`id_ren_fisik_skpd`),
  ADD KEY `periode_pagu` (`periode_pagu`),
  ADD KEY `kegiatan` (`skpd`);

--
-- Indexes for table `ren_keu`
--
ALTER TABLE `ren_keu`
  ADD PRIMARY KEY (`id_ren_keu`),
  ADD KEY `periode_pagu` (`periode_pagu`),
  ADD KEY `kegiatan` (`kegiatan`);

--
-- Indexes for table `ren_keu_skpd`
--
ALTER TABLE `ren_keu_skpd`
  ADD PRIMARY KEY (`id_ren_keu_skpd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nilai_pagu`
--
ALTER TABLE `nilai_pagu`
  MODIFY `id_nilai_pagu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagu_skpd`
--
ALTER TABLE `pagu_skpd`
  MODIFY `id_nilai_pagu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `periode_pagu`
--
ALTER TABLE `periode_pagu`
  MODIFY `id_per_pagu` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `periode_setting`
--
ALTER TABLE `periode_setting`
  MODIFY `id_per_setting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `real_fisik`
--
ALTER TABLE `real_fisik`
  MODIFY `id_real_fisik` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `real_fisik_skpd`
--
ALTER TABLE `real_fisik_skpd`
  MODIFY `id_real_fisik_skpd` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `real_keu`
--
ALTER TABLE `real_keu`
  MODIFY `id_real_keu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `real_keu_skpd`
--
ALTER TABLE `real_keu_skpd`
  MODIFY `id_real_keu_skpd` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ren_fisik`
--
ALTER TABLE `ren_fisik`
  MODIFY `id_ren_fisik` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ren_fisik_skpd`
--
ALTER TABLE `ren_fisik_skpd`
  MODIFY `id_ren_fisik_skpd` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ren_keu`
--
ALTER TABLE `ren_keu`
  MODIFY `id_ren_keu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ren_keu_skpd`
--
ALTER TABLE `ren_keu_skpd`
  MODIFY `id_ren_keu_skpd` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
