-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2023 at 05:29 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tipe_akun`
--

CREATE TABLE `tipe_akun` (
  `id_tipe` int(11) NOT NULL,
  `tipe_akun` varchar(50) NOT NULL,
  `nomor_akun` varchar(50) NOT NULL,
  `debit` bigint(20) DEFAULT 0,
  `kredit` bigint(20) DEFAULT 0,
  `status` varchar(2) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipe_akun`
--

INSERT INTO `tipe_akun` (`id_tipe`, `tipe_akun`, `nomor_akun`, `debit`, `kredit`, `status`) VALUES
(1, 'Aktiva Lancar', '110', 0, 0, 'Y'),
(2, 'BANK', '111', 0, 0, 'Y'),
(3, 'KAS', '112', 0, 0, 'Y'),
(4, 'PIUTANG DAGANG', '113', 0, 0, 'Y'),
(5, 'PIUTANG GAJI', '114', 0, 0, 'Y'),
(6, 'UTANG DAGANG', '211', 0, 0, 'Y'),
(7, 'UTANG GAJI', '212', 0, 0, 'Y'),
(8, 'BYBENGKEL', '522.0020', 0, 0, 'Y'),
(9, 'BY GAJI', '522.0021', 0, 0, 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tipe_akun`
--
ALTER TABLE `tipe_akun`
  ADD PRIMARY KEY (`id_tipe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tipe_akun`
--
ALTER TABLE `tipe_akun`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
