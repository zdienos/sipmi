-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2017 at 11:43 AM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `id_indikator` int(11) NOT NULL,
  `id_standar` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bobot` double NOT NULL,
  `level` int(11) NOT NULL,
  `jangka_waktu` varchar(11) NOT NULL,
  `tgl_mulai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id_indikator`, `id_standar`, `nama`, `bobot`, `level`, `jangka_waktu`, `tgl_mulai`) VALUES
(1, 1, 'Dosen Tetap : Kecukupan dan ...', 6.91, 1, '1 Tahun', '2017-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `indikator_ta`
--

CREATE TABLE `indikator_ta` (
  `id_indikator_ta` int(11) NOT NULL,
  `id_ta` int(11) NOT NULL,
  `id_indikator` int(11) NOT NULL,
  `tgl_isi` date NOT NULL,
  `tgl_update` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `nilai` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `isian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator_ta`
--

INSERT INTO `indikator_ta` (`id_indikator_ta`, `id_ta`, `id_indikator`, `tgl_isi`, `tgl_update`, `file`, `nilai`, `status`, `isian`) VALUES
(4, 1, 1, '2017-10-11', '2017-10-11', 'Modul_1_Rangkaian_Digital_-_YAS1.docx', 3, 'Aktif', 'isian');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(10) NOT NULL,
  `nama_level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'Kepala Program Studi'),
(2, 'Kepala Unit'),
(3, 'Direktorat'),
(4, 'UPP');

-- --------------------------------------------------------

--
-- Table structure for table `standar`
--

CREATE TABLE `standar` (
  `id_standar` int(11) NOT NULL,
  `nama_standar` text NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `standar`
--

INSERT INTO `standar` (`id_standar`, `nama_standar`, `urutan`) VALUES
(1, 'Sumber Daya Manusia', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ta`
--

CREATE TABLE `ta` (
  `id_ta` int(11) NOT NULL,
  `nama_ta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ta`
--

INSERT INTO `ta` (`id_ta`, `nama_ta`) VALUES
(1, '2015/2016');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_atasan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_level`, `username`, `password`, `id_atasan`) VALUES
(1, 3, 'HKO', '73fa7a241b152292416ae228864043b8', 0),
(2, 2, 'MIZ', 'd7240ae35360076d4fc559b31120bc7c', 1),
(3, 1, 'AND', '558ffc8f5770d8e4f95f51d822685532', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_indikator`
--

CREATE TABLE `user_indikator` (
  `id_user_indikator` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_indikator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_indikator`
--

INSERT INTO `user_indikator` (`id_user_indikator`, `id_user`, `id_indikator`) VALUES
(1, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id_indikator`),
  ADD KEY `id_standar` (`id_standar`);

--
-- Indexes for table `indikator_ta`
--
ALTER TABLE `indikator_ta`
  ADD PRIMARY KEY (`id_indikator_ta`),
  ADD KEY `id_indikator` (`id_indikator`),
  ADD KEY `id_ta` (`id_ta`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `standar`
--
ALTER TABLE `standar`
  ADD PRIMARY KEY (`id_standar`);

--
-- Indexes for table `ta`
--
ALTER TABLE `ta`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `user_indikator`
--
ALTER TABLE `user_indikator`
  ADD PRIMARY KEY (`id_user_indikator`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_indikator` (`id_indikator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `indikator_ta`
--
ALTER TABLE `indikator_ta`
  MODIFY `id_indikator_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `standar`
--
ALTER TABLE `standar`
  MODIFY `id_standar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ta`
--
ALTER TABLE `ta`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_indikator`
--
ALTER TABLE `user_indikator`
  MODIFY `id_user_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `indikator`
--
ALTER TABLE `indikator`
  ADD CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`id_standar`) REFERENCES `standar` (`id_standar`);

--
-- Constraints for table `indikator_ta`
--
ALTER TABLE `indikator_ta`
  ADD CONSTRAINT `indikator_ta_ibfk_1` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`),
  ADD CONSTRAINT `indikator_ta_ibfk_2` FOREIGN KEY (`id_ta`) REFERENCES `ta` (`id_ta`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`);

--
-- Constraints for table `user_indikator`
--
ALTER TABLE `user_indikator`
  ADD CONSTRAINT `user_indikator_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `user_indikator_ibfk_2` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
