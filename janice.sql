-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 01:16 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `janice`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `fk_id_sesi` int(11) NOT NULL,
  `fk_id_produk` int(11) NOT NULL,
  `quantity_barang` int(11) NOT NULL,
  `harga_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `fk_id_sesi`, `fk_id_produk`, `quantity_barang`, `harga_barang`) VALUES
(1, 1, 1, 60, 20000),
(2, 1, 2, 50, 40000),
(3, 2, 2, 240, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `domisili`
--

CREATE TABLE `domisili` (
  `id_dom` int(11) NOT NULL,
  `nama_dom` varchar(20) NOT NULL,
  `status_dom` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domisili`
--

INSERT INTO `domisili` (`id_dom`, `nama_dom`, `status_dom`) VALUES
(1, 'Bogor', 1),
(2, 'Jakarta', 1);

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfig` int(11) NOT NULL,
  `fk_id_level` int(11) NOT NULL,
  `minimal_pembelian` int(15) NOT NULL,
  `deposit` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfig`, `fk_id_level`, `minimal_pembelian`, `deposit`) VALUES
(1, 3, 240, 100000),
(2, 4, 500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_pembayaran`
--

CREATE TABLE `konfirmasi_pembayaran` (
  `id_konfirmasi` int(11) NOT NULL,
  `fk_id_sesi_transaksi` int(11) NOT NULL,
  `fk_id_rekening` int(11) NOT NULL,
  `nomor_rekening_pengirim` varchar(25) NOT NULL,
  `bank_pengirim` varchar(30) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `jumlah_transfer` int(15) NOT NULL,
  `tgl_transfer` date NOT NULL,
  `bukti_transfer` text NOT NULL,
  `konfirmasi_status` int(11) NOT NULL COMMENT '0 = belum bayar, 1 sudah lunas',
  `konfirmasi_tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi_pembayaran`
--

INSERT INTO `konfirmasi_pembayaran` (`id_konfirmasi`, `fk_id_sesi_transaksi`, `fk_id_rekening`, `nomor_rekening_pengirim`, `bank_pengirim`, `nama_pengirim`, `jumlah_transfer`, `tgl_transfer`, `bukti_transfer`, `konfirmasi_status`, `konfirmasi_tgl`) VALUES
(1, 1, 1, '7645645645345', 'MANDIRI', 'Anggun', 500000, '2020-07-15', 'etst', 1, '2020-07-21'),
(2, 2, 1, '4544444', 'BANK MEGA', 'kuntor', 600000, '2020-07-20', 'test', 1, '2020-07-21');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL,
  `status_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `status_level`) VALUES
(1, 'Super Admin', 1),
(2, 'Admin', 1),
(3, 'Distributor', 1),
(4, 'Reseller', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `notifikasi_id` int(11) NOT NULL,
  `notifikasi_untuk_id` int(11) NOT NULL,
  `notifikasi_isi` text NOT NULL,
  `notifikasi_status` int(1) NOT NULL,
  `notifikasi_tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_produk` bigint(20) NOT NULL,
  `harga_reseller` bigint(25) NOT NULL,
  `desc_produk` text NOT NULL,
  `gambar_produk` text NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `status_produk` int(11) NOT NULL COMMENT '0 = tidak aktif, 1 = aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `fk_id_user`, `nama_produk`, `harga_produk`, `harga_reseller`, `desc_produk`, `gambar_produk`, `tgl_masuk`, `status_produk`) VALUES
(1, 2, 'Dak Dak Hot 1', 40000, 30000, 'Ini Produk Dak Dak Pedas Level 3', '2Dak Dak Hot 1.jpg', '2020-07-17 00:00:00', 1),
(2, 1, 'test2', 10000, 20000, 'ini barang gagal', '2test2.gif', '2020-07-15 00:00:28', 1),
(3, 1, 'test3', 500000, 60000, 'ini barang asin', '1test3.jpeg', '2020-07-18 09:42:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `nama_rekening` varchar(30) NOT NULL,
  `nomor_rekening` varchar(25) NOT NULL,
  `bank_rekening` varchar(30) NOT NULL,
  `status_rekening` int(1) NOT NULL COMMENT '0 = tidak aktif, 1 = aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `fk_user_id`, `nama_rekening`, `nomor_rekening`, `bank_rekening`, `status_rekening`) VALUES
(1, 0, 'DAk Dak', '02135125213', 'BCA', 1),
(2, 0, 'DAk Dak', '0000021035566482', 'MANDIRI', 1),
(3, 4, 'Anggun', '363633333', 'BANK MEGA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sesi_transaksi`
--

CREATE TABLE `sesi_transaksi` (
  `id_sesi` int(11) NOT NULL,
  `fk_id_u` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `tipe_sesi` int(1) NOT NULL COMMENT '1 = register distributor, 2 = register reseller, 3 = pemesanan distributor, 4 = pemesanan reseller',
  `tanggal_sesi` date NOT NULL,
  `status_sesi` int(1) NOT NULL,
  `deposit` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sesi_transaksi`
--

INSERT INTO `sesi_transaksi` (`id_sesi`, `fk_id_u`, `id_distributor`, `tipe_sesi`, `tanggal_sesi`, `status_sesi`, `deposit`) VALUES
(1, 4, 1, 2, '2020-07-19', 1, NULL),
(2, 5, 4, 2, '2020-07-01', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `fk_id_produk` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `jumlah_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `fk_id_produk`, `fk_id_user`, `jumlah_stock`) VALUES
(1, 2, 4, 10),
(20, 1, 4, 60);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_u` varchar(30) NOT NULL,
  `email_u` varchar(40) NOT NULL,
  `dob_u` date NOT NULL,
  `telp_u` varchar(15) NOT NULL,
  `alamat_u` text NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `password_u` text NOT NULL,
  `fk_id_level` int(11) NOT NULL,
  `fk_id_domisili` int(11) NOT NULL,
  `status_u` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_u`, `email_u`, `dob_u`, `telp_u`, `alamat_u`, `alamat_pengiriman`, `tanggal_daftar`, `password_u`, `fk_id_level`, `fk_id_domisili`, `status_u`) VALUES
(1, 'Dak Dak', 'dak@gmail.com', '2020-07-08', '0218788888', 'Jalan Raya Bogor', 'Dak Dak Office', '0000-00-00 00:00:00', 'c4ca4238a0b923820dcc509a6f75849b', 1, 0, 1),
(2, 'nobody', 'test2@gmail.com', '2020-07-22', '123123123', 'Dak Dak Office', 'Dak Dak Office2', '0000-00-00 00:00:00', 'c4ca4238a0b923820dcc509a6f75849b', 2, 1, 1),
(4, 'janice', 'test@gmail.com', '2020-07-01', '5555', 'Bogor Raya', 'Dak Dak Office', '2020-07-17 16:26:38', 'c4ca4238a0b923820dcc509a6f75849b', 3, 1, 1),
(8, 'dwwww', 'dw@gmail.com', '2020-07-08', '123213213', 'bojong gede', 'Dak Dak Office  333', '2020-07-18 10:42:44', 'c4ca4238a0b923820dcc509a6f75849b', 2, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `domisili`
--
ALTER TABLE `domisili`
  ADD PRIMARY KEY (`id_dom`);

--
-- Indexes for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfig`);

--
-- Indexes for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`notifikasi_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sesi_transaksi`
--
ALTER TABLE `sesi_transaksi`
  ADD PRIMARY KEY (`id_sesi`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `domisili`
--
ALTER TABLE `domisili`
  MODIFY `id_dom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `notifikasi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sesi_transaksi`
--
ALTER TABLE `sesi_transaksi`
  MODIFY `id_sesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
