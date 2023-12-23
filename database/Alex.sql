-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2023 at 02:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `kode_akun` text NOT NULL,
  `nama_akun` varchar(50) NOT NULL,
  `kredit` bigint(20) NOT NULL,
  `debit` bigint(20) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `kode_akun`, `nama_akun`, `kredit`, `debit`, `status`) VALUES
(1, '11021', 'Kas Besar', 2150000, 0, 'Y'),
(2, '110', 'Kas Kecil', 0, 0, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(256) NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `satuan_besar` int(11) NOT NULL,
  `satuan_kecil` int(11) NOT NULL,
  `uom_besar` varchar(20) NOT NULL,
  `uom_kecil` varchar(20) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_modal`, `satuan_besar`, `satuan_kecil`, `uom_besar`, `uom_kecil`, `kuantitas`, `status`) VALUES
(1, 'PIPA PARALONTE GAJAHMADA', 10000, 1, 20, 'Kotak', 'Pcs', 19910, 'Y'),
(2, 'GSM', 20000, 1, 30, 'Kotak', 'Pcs', 40010, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `cash_keluar`
--

CREATE TABLE `cash_keluar` (
  `id_ckeluar` int(11) NOT NULL,
  `nomor_keluar` int(11) NOT NULL,
  `bukti_keluar` int(11) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_masuk`
--

CREATE TABLE `cash_masuk` (
  `id_cash_masuk` int(11) NOT NULL,
  `no_bukti` varchar(256) NOT NULL,
  `bukti_masuk` int(11) NOT NULL,
  `nomor_masuk` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `plat` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `netto` int(11) DEFAULT 0,
  `status_hapus` varchar(1) NOT NULL DEFAULT 'Y',
  `creator` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `kontak`, `keterangan`, `alamat`, `status`) VALUES
(2, 'brian', '1', '-', 'Jl Adam Malik', 'Y'),
(3, 'GENK', '1', '-', 'Adam Malik', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `data_mobil`
--

CREATE TABLE `data_mobil` (
  `id_mobil` int(11) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `plat` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `pemeriksa` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  `creator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_mobil`
--

INSERT INTO `data_mobil` (`id_mobil`, `merk`, `plat`, `tanggal`, `pemeriksa`, `status`, `creator`) VALUES
(1, 'Innova', 'BK 689 ABF', '2023-06-20', 'Abun', 'Y', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `history_akun`
--

CREATE TABLE `history_akun` (
  `id_ha` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_akun`
--

INSERT INTO `history_akun` (`id_ha`, `id_akun`, `id_pembelian`, `kredit`, `debit`, `tanggal`) VALUES
(5, 1, 1, 150000, 0, '2023-05-26'),
(6, 1, 5, 2000000, 0, '2023-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `history_cash_masuk`
--

CREATE TABLE `history_cash_masuk` (
  `id_hcm` int(11) NOT NULL,
  `id_cash_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_barang` bigint(20) NOT NULL,
  `disc` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `bruto` bigint(20) NOT NULL,
  `netto` bigint(20) NOT NULL,
  `user` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_jasa`
--

CREATE TABLE `history_jasa` (
  `id_hjasa` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `harga_jasa` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_jasa`
--

INSERT INTO `history_jasa` (`id_hjasa`, `id_jasa`, `id_penjualan`, `harga_jasa`, `deskripsi`) VALUES
(1, 1, 6, 20000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `history_mobil`
--

CREATE TABLE `history_mobil` (
  `id_mobil` int(11) NOT NULL,
  `id_perlengkapan` int(11) NOT NULL,
  `kondisi` varchar(50) NOT NULL,
  `perlengkapan` varchar(50) NOT NULL,
  `creator` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_mobil`
--

INSERT INTO `history_mobil` (`id_mobil`, `id_perlengkapan`, `kondisi`, `perlengkapan`, `creator`) VALUES
(1, 3, 'Baik', 'Ada', 'admin'),
(1, 3, 'Baik', 'Ada', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `history_pembelian`
--

CREATE TABLE `history_pembelian` (
  `id_hbeli` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_barang` bigint(20) NOT NULL,
  `disc` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `bruto` bigint(20) NOT NULL,
  `netto` bigint(20) NOT NULL,
  `user` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_pembelian`
--

INSERT INTO `history_pembelian` (`id_hbeli`, `id_pembelian`, `id_barang`, `id_supplier`, `kuantitas`, `harga_barang`, `disc`, `diskon`, `bruto`, `netto`, `user`) VALUES
(1, 1, 1, 23, 5, 10000, 0, 0, 50000, 50000, 'admin'),
(2, 1, 2, 23, 10, 10000, 0, 0, 100000, 100000, 'admin'),
(3, 2, 1, 23, 5, 10000, 0, 0, 50000, 50000, 'admin'),
(4, 2, 2, 23, 20000, 10000, 0, 0, 200000000, 200000000, 'admin'),
(5, 3, 1, 24, 5, 10000, 0, 0, 50000, 50000, 'admin'),
(6, 3, 2, 24, 20000, 10000, 0, 0, 200000000, 200000000, 'admin'),
(7, 4, 1, 23, 20000, 10000, 0, 0, 200000000, 200000000, 'admin'),
(8, 5, 1, 23, 20, 100000, 0, 0, 2000000, 2000000, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `history_penjualan`
--

CREATE TABLE `history_penjualan` (
  `id_hjual` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_barang` bigint(20) NOT NULL,
  `disc` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `bruto` bigint(20) NOT NULL,
  `netto` bigint(20) NOT NULL,
  `user` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_penjualan`
--

INSERT INTO `history_penjualan` (`id_hjual`, `id_penjualan`, `id_barang`, `id_customer`, `kuantitas`, `harga_barang`, `disc`, `diskon`, `bruto`, `netto`, `user`) VALUES
(1, 1, 1, 2, 5, 10000, 0, 0, 50000, 50000, 'admin'),
(2, 2, 2, 3, 20000, 10000, 0, 0, 200000000, 200000000, 'admin'),
(3, 2, 1, 3, 5, 10000, 0, 0, 50000, 50000, 'admin'),
(4, 3, 2, 2, 10, 10000, 0, 0, 100000, 100000, 'admin'),
(5, 4, 1, 2, 10, 10000, 0, 0, 100000, 100000, 'admin'),
(6, 4, 1, 2, 10, 10000, 0, 0, 100000, 100000, 'admin'),
(7, 4, 1, 2, 10, 10000, 0, 0, 100000, 100000, 'admin'),
(8, 4, 1, 3, 10, 10000, 0, 0, 100000, 100000, 'admin'),
(9, 6, 1, 2, 20, 210000, 0, 0, 4200000, 4200000, 'admin'),
(10, 1, 1, 2, 100, 10000, 0, 0, 1000000, 1000000, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `is_users`
--

CREATE TABLE `is_users` (
  `id_user` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `hak_akses` enum('Super Admin','User','Client','CCTV','Jo','HeadStok','Stok','HeadStokIT','StokIT','Headtransport','SupportKUS','Direktur','PersonKUS','PersonSMP','Head Audit','PersonKPN','PersonARP','PersonKAP','Personalia','KasirKpn','ApKpn','KasirKus','ApKus','KasirArp','ApArp','KasirKap','ApKap','HeadFinance','AccKUS','KasirKas','ApKas','KasirSmp','ApSmp','MIS_1','MIS_2','PersonKAS','Servis','KtuArp','KtuKpn','KtuKap','KtuKus','KtuKas','KtuSmp') NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `is_users`
--

INSERT INTO `is_users` (`id_user`, `username`, `nama_user`, `password`, `email`, `telepon`, `foto`, `hak_akses`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '1', 'alex@gmail.com', 'ddadawd', NULL, 'Super Admin', 'aktif', '2023-04-18 02:19:16', '2023-04-18 02:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `id_jasa` int(11) NOT NULL,
  `nama_jasa` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id_jasa`, `nama_jasa`, `status`) VALUES
(1, 'GANTI OLI', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_prlkpn` int(11) NOT NULL,
  `prlkpn` varchar(30) NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_prlkpn`, `prlkpn`, `status`) VALUES
(3, 'Baut', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `no_faktur` varchar(256) NOT NULL,
  `nomor_transaksi` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `jatuh_tempo` date DEFAULT NULL,
  `netto` int(11) DEFAULT 0,
  `status_hapus` varchar(1) NOT NULL DEFAULT 'Y',
  `status_pembayaran` varchar(1) NOT NULL DEFAULT 'N',
  `creator` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `no_faktur`, `nomor_transaksi`, `id_supplier`, `tanggal`, `jatuh_tempo`, `netto`, `status_hapus`, `status_pembayaran`, `creator`) VALUES
(1, 'PB/2304/0001', 1, 23, '2023-04-24', '2023-04-25', 150000, 'Y', 'Y', 'admin'),
(2, 'PB/2304/0002', 2, 23, '2023-04-24', '2023-04-25', 200050000, 'Y', 'N', 'admin'),
(3, 'PB/2304/0003', 3, 24, '2023-04-24', '2023-04-25', 200050000, 'Y', 'N', 'admin'),
(4, 'PB/2304/0004', 4, 23, '2023-04-26', '2023-04-27', 200000000, 'Y', 'N', 'admin'),
(5, 'PB/2305/0001', 1, 23, '2023-05-05', '2023-06-03', 2000000, 'Y', 'Y', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `no_faktur` varchar(256) NOT NULL,
  `nomor_transaksi` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `plat` varchar(20) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `jatuh_tempo` date DEFAULT NULL,
  `netto` int(11) DEFAULT 0,
  `status_hapus` varchar(1) NOT NULL DEFAULT 'Y',
  `status_pembayaran` varchar(1) NOT NULL DEFAULT 'N',
  `creator` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `no_faktur`, `nomor_transaksi`, `id_customer`, `plat`, `tanggal`, `jatuh_tempo`, `netto`, `status_hapus`, `status_pembayaran`, `creator`) VALUES
(1, 'PJ/2305/0001', 1, 2, 'BK 1583 TK', '2023-05-26', '2023-05-27', 1000000, 'Y', 'N', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `no_rekening` varchar(256) NOT NULL,
  `keterangan` text NOT NULL,
  `alamat` varchar(512) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `kontak`, `no_rekening`, `keterangan`, `alamat`, `status`) VALUES
(23, 'Nicholas Yang', '081267643835', '8645185699', 'Pincang', 'Jln. Boulevard Raya', 'Y'),
(24, 'brian', 'dwadw', '1212', '-', 'Jl Adam Malik', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `cash_keluar`
--
ALTER TABLE `cash_keluar`
  ADD PRIMARY KEY (`id_ckeluar`);

--
-- Indexes for table `cash_masuk`
--
ALTER TABLE `cash_masuk`
  ADD PRIMARY KEY (`id_cash_masuk`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `data_mobil`
--
ALTER TABLE `data_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `history_akun`
--
ALTER TABLE `history_akun`
  ADD PRIMARY KEY (`id_ha`);

--
-- Indexes for table `history_cash_masuk`
--
ALTER TABLE `history_cash_masuk`
  ADD PRIMARY KEY (`id_hcm`);

--
-- Indexes for table `history_jasa`
--
ALTER TABLE `history_jasa`
  ADD PRIMARY KEY (`id_hjasa`);

--
-- Indexes for table `history_pembelian`
--
ALTER TABLE `history_pembelian`
  ADD PRIMARY KEY (`id_hbeli`);

--
-- Indexes for table `history_penjualan`
--
ALTER TABLE `history_penjualan`
  ADD PRIMARY KEY (`id_hjual`);

--
-- Indexes for table `is_users`
--
ALTER TABLE `is_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `level` (`hak_akses`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_prlkpn`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cash_keluar`
--
ALTER TABLE `cash_keluar`
  MODIFY `id_ckeluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_masuk`
--
ALTER TABLE `cash_masuk`
  MODIFY `id_cash_masuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_mobil`
--
ALTER TABLE `data_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history_akun`
--
ALTER TABLE `history_akun`
  MODIFY `id_ha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `history_cash_masuk`
--
ALTER TABLE `history_cash_masuk`
  MODIFY `id_hcm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_jasa`
--
ALTER TABLE `history_jasa`
  MODIFY `id_hjasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history_pembelian`
--
ALTER TABLE `history_pembelian`
  MODIFY `id_hbeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `history_penjualan`
--
ALTER TABLE `history_penjualan`
  MODIFY `id_hjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `is_users`
--
ALTER TABLE `is_users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_prlkpn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
