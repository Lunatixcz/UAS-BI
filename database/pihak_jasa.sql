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
-- Struktur dari tabel `pihak_jasa`
--

CREATE TABLE `pihak_jasa` (
  `id_pjasa` int(11) NOT NULL,
  `nama_pihak` varchar(256) NOT NULL,
  `kontak` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pihak_jasa`
--

INSERT INTO `pihak_jasa` (`id_pjasa`, `nama_pihak`, `kontak`, `alamat`, `status`) VALUES
(1, 'CV Testing 1', '', '', 'Y'),
(2, 'CV Testing 2', '081267643835', 'Jln. Boulevard Raya', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pihak_jasa`
--
ALTER TABLE `pihak_jasa`
  ADD PRIMARY KEY (`id_pjasa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pihak_jasa`
--
ALTER TABLE `pihak_jasa`
  MODIFY `id_pjasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
