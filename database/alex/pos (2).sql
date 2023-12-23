-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2023 at 09:58 AM
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
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nomor_transaksi` int(11) DEFAULT NULL,
  `kode_akun` text NOT NULL,
  `nama_akun` varchar(50) NOT NULL,
  `tipe_akun` varchar(30) NOT NULL,
  `kredit` bigint(20) NOT NULL,
  `debit` bigint(20) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nomor_transaksi`, `kode_akun`, `nama_akun`, `tipe_akun`, `kredit`, `debit`, `status`) VALUES
(5, 1, '111-1', 'BANK BCA', '2', 0, 850000, 'Y'),
(6, 2, '111-2', 'BANK BRI', '2', 0, 0, 'Y'),
(7, 3, '111-3', 'BANK DANAMON', '2', 0, 0, 'Y');

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
(1, 'Linggis', 100000, 1, 10, 'Kotak', 'Batang', 20030, 'Y'),
(2, 'pipa', 100000, 1, 100, 'Kg', 'gram', 39873, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `cash_keluar`
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

-- --------------------------------------------------------

--
-- Table structure for table `cash_masuk`
--

CREATE TABLE `cash_masuk` (
  `id_cmasuk` int(11) NOT NULL,
  `bukti_masuk` varchar(256) NOT NULL,
  `nomor_masuk` int(11) NOT NULL,
  `terima_dari` varchar(256) NOT NULL,
  `sumber` varchar(256) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah` int(11) DEFAULT 0,
  `keterangan` text NOT NULL,
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
(1, 'Djohan', '08126613468', 'Djohan Semen', 'Jln. Boulevard Raya', 'Y');

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
(1, 'Innova', 'BK 689 ABF', '2023-06-20', 'Abun', 'Y', 'admin'),
(2, 'Agya', 'BK 689 AC', '2023-06-20', 'Aboen', 'Y', 'admin'),
(3, 'grang max', 'bk 8909', '2023-06-22', 'dura', 'Y', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `history_akun`
--

CREATE TABLE `history_akun` (
  `id_ha` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `id_cmasuk` int(11) NOT NULL,
  `id_ckeluar` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_akun`
--

INSERT INTO `history_akun` (`id_ha`, `id_akun`, `id_pembelian`, `id_penjualan`, `id_cmasuk`, `id_ckeluar`, `kredit`, `debit`, `tanggal`) VALUES
(3, 5, NULL, 3, 0, 0, 0, 850000, '2023-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `history_cash_keluar`
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
-- Dumping data for table `history_cash_keluar`
--

INSERT INTO `history_cash_keluar` (`id_hck`, `id_cash_keluar`, `id_barang`, `kuantitas`, `id_jasa`, `jumlah`) VALUES
(1, 1, 0, 0, 1, 100000),
(2, 1, 0, 0, 2, 100000),
(3, 2, 0, 0, 1, 100000),
(4, 2, 0, 0, 2, 200000),
(5, 3, 0, 0, 1, 200000),
(6, 3, 0, 0, 2, 200000),
(7, 4, 0, 0, 1, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `history_cash_masuk`
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
-- Dumping data for table `history_cash_masuk`
--

INSERT INTO `history_cash_masuk` (`id_hcm`, `id_cash_masuk`, `id_barang`, `jasa`, `kuantitas`, `jumlah`, `keterangan`, `user`) VALUES
(6, 5, 1, 0, 20, 200000, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `history_jasa`
--

CREATE TABLE `history_jasa` (
  `id_hjasa` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `harga_jasa` int(11) NOT NULL,
  `pendapatan` bigint(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_jasa`
--

INSERT INTO `history_jasa` (`id_hjasa`, `id_jasa`, `id_penjualan`, `harga_jasa`, `pendapatan`, `deskripsi`) VALUES
(1, 1, 6, 20000, 0, '0'),
(2, 1, 2, 20000, 0, 'kimsiu'),
(3, 1, 5, 100000, 100000, '-');

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
(1, 3, 'Baik', 'Ada', 'admin'),
(2, 3, '-', 'Tidak ada', 'admin'),
(3, 3, 'Rusak', 'Ada', 'admin');

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
(8, 5, 1, 23, 20, 100000, 0, 0, 2000000, 2000000, 'admin'),
(9, 6, 1, 24, 10, 100000, 0, 0, 1000000, 1000000, 'admin'),
(10, 7, 2, 24, 20, 2000, 0, 0, 40000, 40000, 'admin'),
(11, 8, 2, 23, 100, 100000, 0, 0, 10000000, 10000000, 'admin');

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
  `pendapatan` int(11) NOT NULL,
  `disc` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `bruto` bigint(20) NOT NULL,
  `netto` bigint(20) NOT NULL,
  `user` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_penjualan`
--

INSERT INTO `history_penjualan` (`id_hjual`, `id_penjualan`, `id_barang`, `id_customer`, `kuantitas`, `harga_barang`, `pendapatan`, `disc`, `diskon`, `bruto`, `netto`, `user`) VALUES
(6, 5, 2, 1, 5, 200000, 500000, 0, 0, 1000000, 1000000, 'admin'),
(7, 6, 1, 1, 5, 150000, 250000, 0, 0, 750000, 750000, 'admin'),
(8, 6, 2, 1, 5, 200000, 500000, 0, 0, 1000000, 1000000, 'admin'),
(9, 6, 2, 1, 5, 200000, 500000, 0, 0, 1000000, 1000000, 'admin');

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
  `harga_jasa` bigint(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id_jasa`, `nama_jasa`, `harga_jasa`, `status`) VALUES
(1, 'Ganti Oli', 0, 'Y'),
(2, 'Ganit Ban', 0, 'Y');

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
(1, 'PB/2304/0001', 1, 23, '2023-04-24', '2023-04-25', 150000, 'Y', 'N', 'admin'),
(2, 'PB/2304/0002', 2, 23, '2023-04-24', '2023-04-25', 200050000, 'Y', 'N', 'admin'),
(3, 'PB/2304/0003', 3, 24, '2023-04-24', '2023-04-25', 200050000, 'Y', 'N', 'admin'),
(4, 'PB/2304/0004', 4, 23, '2023-04-26', '2023-04-27', 200000000, 'Y', 'N', 'admin'),
(5, 'PB/2305/0001', 1, 23, '2023-05-05', '2023-06-03', 2000000, 'Y', 'N', 'admin'),
(6, 'PB/2305/0001', 1, 24, '2023-05-31', '2023-06-10', 1000000, 'Y', 'N', 'admin'),
(7, 'PB/2306/0001', 1, 24, '2023-06-22', '2023-06-22', 40000, 'Y', 'N', 'admin'),
(8, 'PB/2306/0001', 1, 23, '2023-06-22', '2023-06-30', 10000000, 'Y', 'N', 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `pembelian_netto`
-- (See below for the actual view)
--
CREATE TABLE `pembelian_netto` (
`tahun_akum_beli` int(4)
,`bulan_akum_beli` int(2)
,`total_netto_beli` decimal(32,0)
);

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
  `pendapatan` bigint(20) NOT NULL,
  `status_hapus` varchar(1) NOT NULL DEFAULT 'Y',
  `status_pembayaran` varchar(1) NOT NULL DEFAULT 'N',
  `creator` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `no_faktur`, `nomor_transaksi`, `id_customer`, `plat`, `tanggal`, `jatuh_tempo`, `netto`, `pendapatan`, `status_hapus`, `status_pembayaran`, `creator`) VALUES
(5, 'PJ/2308/0001', 1, 1, 'bm 119 ', '2023-08-11', '2023-08-12', 1100000, 0, 'Y', 'N', 'admin'),
(6, 'PJ/2308/0002', 2, 1, 'bm 119 ', '2023-08-11', '2023-08-11', 1850000, 1250000, 'Y', 'N', 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `penjualan_netto`
-- (See below for the actual view)
--
CREATE TABLE `penjualan_netto` (
`tahun_akum_jual` int(4)
,`bulan_akum_jual` int(2)
,`total_netto_jual` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `pihak_jasa`
--

CREATE TABLE `pihak_jasa` (
  `id_pjasa` int(11) NOT NULL,
  `nama_pihak` varchar(256) NOT NULL,
  `kontak` varchar(256) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pihak_jasa`
--

INSERT INTO `pihak_jasa` (`id_pjasa`, `nama_pihak`, `kontak`, `alamat`, `status`) VALUES
(1, 'CV Testing 1', '', '', 'Y'),
(2, 'CV Testing 2', '081267643835', 'Jln. Boulevard Raya', 'Y');

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

-- --------------------------------------------------------

--
-- Structure for view `pembelian_netto`
--
DROP TABLE IF EXISTS `pembelian_netto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pembelian_netto`  AS SELECT year(`pembelian`.`tanggal`) AS `tahun_akum_beli`, month(`pembelian`.`tanggal`) AS `bulan_akum_beli`, sum(`pembelian`.`netto`) AS `total_netto_beli` FROM `pembelian` GROUP BY year(`pembelian`.`tanggal`), month(`pembelian`.`tanggal`) ;

-- --------------------------------------------------------

--
-- Structure for view `penjualan_netto`
--
DROP TABLE IF EXISTS `penjualan_netto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `penjualan_netto`  AS SELECT year(`penjualan`.`tanggal`) AS `tahun_akum_jual`, month(`penjualan`.`tanggal`) AS `bulan_akum_jual`, sum(`penjualan`.`netto`) AS `total_netto_jual` FROM `penjualan` GROUP BY year(`penjualan`.`tanggal`), month(`penjualan`.`tanggal`) ;

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
  ADD PRIMARY KEY (`id_cmasuk`);

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
-- Indexes for table `history_cash_keluar`
--
ALTER TABLE `history_cash_keluar`
  ADD PRIMARY KEY (`id_hck`);

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
-- Indexes for table `pihak_jasa`
--
ALTER TABLE `pihak_jasa`
  ADD PRIMARY KEY (`id_pjasa`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tipe_akun`
--
ALTER TABLE `tipe_akun`
  ADD PRIMARY KEY (`id_tipe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id_cmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_mobil`
--
ALTER TABLE `data_mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history_akun`
--
ALTER TABLE `history_akun`
  MODIFY `id_ha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `history_cash_keluar`
--
ALTER TABLE `history_cash_keluar`
  MODIFY `id_hck` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `history_cash_masuk`
--
ALTER TABLE `history_cash_masuk`
  MODIFY `id_hcm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `history_jasa`
--
ALTER TABLE `history_jasa`
  MODIFY `id_hjasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history_pembelian`
--
ALTER TABLE `history_pembelian`
  MODIFY `id_hbeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `history_penjualan`
--
ALTER TABLE `history_penjualan`
  MODIFY `id_hjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `is_users`
--
ALTER TABLE `is_users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_prlkpn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pihak_jasa`
--
ALTER TABLE `pihak_jasa`
  MODIFY `id_pjasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tipe_akun`
--
ALTER TABLE `tipe_akun`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
