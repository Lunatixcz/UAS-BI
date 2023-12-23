-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2023 pada 06.05
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
-- Struktur dari tabel `history_cash_masuk`
--

CREATE TABLE `history_cash_masuk` (
  `id_hcm` int(11) NOT NULL,
  `id_cash_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jasa` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `user` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `history_cash_masuk`
--

INSERT INTO `history_cash_masuk` (`id_hcm`, `id_cash_masuk`, `id_barang`, `jasa`, `kuantitas`, `jumlah`, `keterangan`, `user`) VALUES
(1, 12, 0, 0, 0, 100000, '0', ''),
(2, 13, 0, 0, 0, 100000, 'Ganti Oli', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `history_cash_masuk`
--
ALTER TABLE `history_cash_masuk`
  ADD PRIMARY KEY (`id_hcm`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `history_cash_masuk`
--
ALTER TABLE `history_cash_masuk`
  MODIFY `id_hcm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
