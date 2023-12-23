-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 11:40 AM
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
-- Table structure for table `history_akun`
--

CREATE TABLE `history_akun` (
  `id_ha` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `kredit` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_akun`
--

INSERT INTO `history_akun` (`id_ha`, `id_akun`, `id_pembelian`, `id_penjualan`, `kredit`, `debit`, `tanggal`) VALUES
(1, 1, NULL, 1, 0, 1000000, '2023-06-20'),
(2, 1, NULL, 2, 0, 1000000, '2023-06-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_akun`
--
ALTER TABLE `history_akun`
  ADD PRIMARY KEY (`id_ha`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_akun`
--
ALTER TABLE `history_akun`
  MODIFY `id_ha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
