-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jun 2023 pada 04.41
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
-- Struktur dari tabel `history_cash_keluar`
--

CREATE TABLE `history_cash_keluar` (
  `id_hck` int(11) NOT NULL,
  `id_cash_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `history_cash_keluar`
--

INSERT INTO `history_cash_keluar` (`id_hck`, `id_cash_keluar`, `id_barang`, `kuantitas`, `id_jasa`, `jumlah`) VALUES
(1, 1, 0, 0, 1, 100000),
(2, 1, 0, 0, 2, 100000),
(3, 2, 0, 0, 1, 100000),
(4, 2, 0, 0, 2, 200000),
(5, 3, 0, 0, 1, 200000),
(6, 3, 0, 0, 2, 200000),
(7, 4, 0, 0, 1, 100000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `history_cash_keluar`
--
ALTER TABLE `history_cash_keluar`
  ADD PRIMARY KEY (`id_hck`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `history_cash_keluar`
--
ALTER TABLE `history_cash_keluar`
  MODIFY `id_hck` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
