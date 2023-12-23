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
-- Struktur dari tabel `cash_keluar`
--

CREATE TABLE `cash_keluar` (
  `id_ckeluar` int(11) NOT NULL,
  `nomor_keluar` int(11) NOT NULL,
  `bukti_keluar` varchar(256) NOT NULL,
  `terima_dari` varchar(256) NOT NULL,
  `dari` varchar(256) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status_hapus` varchar(1) NOT NULL DEFAULT 'Y',
  `id_akun` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cash_keluar`
--

INSERT INTO `cash_keluar` (`id_ckeluar`, `nomor_keluar`, `bukti_keluar`, `terima_dari`, `dari`, `jumlah`, `status_hapus`, `id_akun`, `tanggal_keluar`, `keterangan`) VALUES
(1, 1, 'CK/2306/0001', 'pihak_jasa', '1', 200000, 'Y', 1, '2029-06-23', ''),
(2, 2, 'CK/2306/0002', 'pihak_jasa', '1', 300000, 'Y', 1, '2029-06-23', ''),
(3, 3, 'CK/2306/0003', 'pihak_jasa', '2', 400000, 'Y', 1, '2029-06-23', ''),
(4, 4, 'CK/2306/0004', 'pihak_jasa', '1', 100000, 'Y', 1, '2029-06-23', 'Pincang');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cash_keluar`
--
ALTER TABLE `cash_keluar`
  ADD PRIMARY KEY (`id_ckeluar`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cash_keluar`
--
ALTER TABLE `cash_keluar`
  MODIFY `id_ckeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
