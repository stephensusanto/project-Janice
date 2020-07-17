-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2020 at 04:19 PM
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
(1, 'Bogor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfig` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `minimal_pembelian` int(15) NOT NULL,
  `deposit` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfig`, `level`, `minimal_pembelian`, `deposit`) VALUES
(1, 3, 240, 500000),
(2, 4, 500, 600000);

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_pembayaran`
--

CREATE TABLE `konfirmasi_pembayaran` (
  `id_konfirmasi` int(11) NOT NULL,
  `fk_id_sesi_transaksi` int(11) NOT NULL,
  `fk_id_rekening` int(11) NOT NULL,
  `nomor_rekening_pengirim` varchar(25) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `jumlah_transfer` int(15) NOT NULL,
  `tgl_transfer` date NOT NULL,
  `bukti_transfer` text NOT NULL,
  `konfirmasi_status` int(11) NOT NULL COMMENT '0 = belum bayar, 1 sudah lunas',
  `konfirmasi_tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `last_change` int(11) NOT NULL,
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

INSERT INTO `produk` (`id_produk`, `last_change`, `nama_produk`, `harga_produk`, `harga_reseller`, `desc_produk`, `gambar_produk`, `tgl_masuk`, `status_produk`) VALUES
(1, 1, 'Dak Dak Hot 2', 20000, 30000, 'Ini Produk Dak Dak Pedas Level 3', 'http://localhost/gitHub/projectJanice/img/produk/0DakDakHot.jpg', '2020-07-17 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `nomor_rekening` varchar(25) NOT NULL,
  `bank_rekening` varchar(30) NOT NULL,
  `status_rekening` int(1) NOT NULL COMMENT '0 = tidak aktif, 1 = aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `fk_user_id`, `nomor_rekening`, `bank_rekening`, `status_rekening`) VALUES
(1, 1, '02135125213', 'BCA', 1),
(2, 1, '0000021035566482', 'MANDIRI', 1);

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
  `tipe_sesi` int(1) NOT NULL COMMENT '1 = register distributor, 2 = register reseller, 3 = pemesanan distributor, 4 = pemesanan reseller',
  `tanggal_sesi` datetime NOT NULL,
  `status_sesi` int(1) NOT NULL,
  `deposit` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `tanggal_daftar` datetime NOT NULL,
  `password_u` text NOT NULL,
  `level` int(11) NOT NULL,
  `fk_id_domisili` int(11) NOT NULL,
  `status_u` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_u`, `email_u`, `dob_u`, `telp_u`, `alamat_u`, `tanggal_daftar`, `password_u`, `level`, `fk_id_domisili`, `status_u`) VALUES
(1, 'Dak Dak', 'pw@gmail.com', '0000-00-00', '0218788888', 'test', '0000-00-00 00:00:00', 'c4ca4238a0b923820dcc509a6f75849b', 2, 0, 1),
(2, 'asd', 'test2@gmail.com', '2020-07-22', '123123123', ' asd\r\n                  ', '0000-00-00 00:00:00', 'c4ca4238a0b923820dcc509a6f75849b', 1, 1, 1),
(4, 'stephen2', 'test@gmail.com', '2020-07-01', '5555', ' bbbbb\r\n                  ', '2020-07-17 16:26:38', 'c4ca4238a0b923820dcc509a6f75849b', 3, 1, 2);

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
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domisili`
--
ALTER TABLE `domisili`
  MODIFY `id_dom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `notifikasi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sesi_transaksi`
--
ALTER TABLE `sesi_transaksi`
  MODIFY `id_sesi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
