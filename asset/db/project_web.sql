-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 06:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `koleksi`
--

CREATE TABLE `koleksi` (
  `id` int(11) NOT NULL,
  `nama` text DEFAULT NULL,
  `deskrip` text DEFAULT NULL,
  `sesi` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` text DEFAULT NULL,
  `pw` text DEFAULT NULL,
  `sesi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `pw`, `sesi`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Owner');

-- --------------------------------------------------------

--
-- Table structure for table `portdata`
--

CREATE TABLE `portdata` (
  `namaleng` text DEFAULT NULL,
  `txthero` text DEFAULT NULL,
  `txtabout1` text DEFAULT NULL,
  `txtabout2` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `sesi` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portdata`
--

INSERT INTO `portdata` (`namaleng`, `txthero`, `txtabout1`, `txtabout2`, `foto`, `sesi`) VALUES
('Moh. Iqbal Hunowu', 'MahasiswaUNG23 || Teknik Elektro & Komputer || Teknik Komputer', 'Halo cuy', 'World!', 'nopict.jpg', 'Owner');

-- --------------------------------------------------------

--
-- Table structure for table `projek`
--

CREATE TABLE `projek` (
  `id` int(11) NOT NULL,
  `gambar` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `txt` text DEFAULT NULL,
  `sesi` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `koleksi`
--
ALTER TABLE `koleksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sesi` (`sesi`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`sesi`);

--
-- Indexes for table `portdata`
--
ALTER TABLE `portdata`
  ADD KEY `sesi` (`sesi`);

--
-- Indexes for table `projek`
--
ALTER TABLE `projek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sesi` (`sesi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `koleksi`
--
ALTER TABLE `koleksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projek`
--
ALTER TABLE `projek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `koleksi`
--
ALTER TABLE `koleksi`
  ADD CONSTRAINT `koleksi_ibfk_1` FOREIGN KEY (`sesi`) REFERENCES `login` (`sesi`);

--
-- Constraints for table `portdata`
--
ALTER TABLE `portdata`
  ADD CONSTRAINT `portdata_ibfk_1` FOREIGN KEY (`sesi`) REFERENCES `login` (`sesi`);

--
-- Constraints for table `projek`
--
ALTER TABLE `projek`
  ADD CONSTRAINT `projek_ibfk_1` FOREIGN KEY (`sesi`) REFERENCES `login` (`sesi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
