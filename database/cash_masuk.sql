-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2023 pada 06.04
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

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
-- Struktur dari tabel `cash_masuk`
--

CREATE TABLE `cash_masuk` (
  `id_cash_masuk` int(11) NOT NULL,
  `bukti_masuk` varchar(256) NOT NULL,
  `nomor_masuk` int(11) NOT NULL,
  `sumber` varchar(256) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah` int(11) DEFAULT 0,
  `keterangan` text NOT NULL,
  `status_hapus` varchar(1) NOT NULL DEFAULT 'Y',
  `creator` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cash_masuk`
--

INSERT INTO `cash_masuk` (`id_cash_masuk`, `bukti_masuk`, `nomor_masuk`, `sumber`, `id_akun`, `tanggal_masuk`, `jumlah`, `keterangan`, `status_hapus`, `creator`) VALUES
(8, 'CM/2306/0001', 0, 'Djohan', 1, '2020-06-23', 200000, '', 'Y', ''),
(9, 'CM/2306/0001', 1, 'Djohan', 2, '2020-06-23', 100000, '', 'Y', ''),
(10, 'CM/2306/0002', 2, 'Djohan', 1, '2020-06-23', 0, '', 'Y', ''),
(11, 'CM/2306/0003', 3, 'Nicholas', 1, '2020-06-23', 100000, '', 'Y', ''),
(12, 'CM/2306/0004', 4, 'Nicholas', 1, '2020-06-23', 100000, '', 'Y', ''),
(13, 'CM/2306/0005', 5, 'Nicholas', 1, '2020-06-23', 100000, '', 'Y', ''),
(14, 'CM/2306/0006', 6, 'Djohan', 2, '2020-06-23', 100000, 'Pincang', 'Y', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cash_masuk`
--
ALTER TABLE `cash_masuk`
  ADD PRIMARY KEY (`id_cash_masuk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cash_masuk`
--
ALTER TABLE `cash_masuk`
  MODIFY `id_cash_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
