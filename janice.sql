-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Agu 2020 pada 16.02
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.1.32

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
-- Struktur dari tabel `detail_transaksi`
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
-- Struktur dari tabel `domisili`
--

CREATE TABLE `domisili` (
  `id_dom` int(11) NOT NULL,
  `nama_dom` varchar(20) NOT NULL,
  `status_dom` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `domisili`
--

INSERT INTO `domisili` (`id_dom`, `nama_dom`, `status_dom`) VALUES
(1, 'Bogor', 1),
(2, 'Jakarta', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfig` int(11) NOT NULL,
  `fk_id_level` int(11) NOT NULL,
  `minimal_pembelian` int(15) NOT NULL,
  `deposit` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfig`, `fk_id_level`, `minimal_pembelian`, `deposit`) VALUES
(1, 3, 240, 100000),
(2, 4, 200, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi_pembayaran`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL,
  `status_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `status_level`) VALUES
(1, 'Super Admin', 1),
(2, 'Admin', 1),
(3, 'Distributor', 1),
(4, 'Reseller', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `notifikasi_id` int(11) NOT NULL,
  `notifikasi_untuk_id` int(11) NOT NULL,
  `notifikasi_isi` text NOT NULL,
  `notifikasi_status` int(1) NOT NULL,
  `notifikasi_tgl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `nama_rekening` varchar(30) NOT NULL,
  `nomor_rekening` varchar(25) NOT NULL,
  `bank_rekening` varchar(30) NOT NULL,
  `status_rekening` int(1) NOT NULL COMMENT '0 = tidak aktif, 1 = aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sesi_transaksi`
--

CREATE TABLE `sesi_transaksi` (
  `id_sesi` int(11) NOT NULL,
  `fk_id_u` int(11) NOT NULL,
  `id_distributor` int(11) NOT NULL,
  `tipe_sesi` int(1) NOT NULL COMMENT '1 = register distributor, 2 = register reseller, 3 = pemesanan distributor, 4 = pemesanan reseller',
  `tanggal_sesi` date NOT NULL,
  `status_sesi` int(1) NOT NULL COMMENT ' 0 = belum lunas, 1 = sudah lunas',
  `deposit` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `fk_id_produk` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  `jumlah_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_u`, `email_u`, `dob_u`, `telp_u`, `alamat_u`, `alamat_pengiriman`, `tanggal_daftar`, `password_u`, `fk_id_level`, `fk_id_domisili`, `status_u`) VALUES
(1, 'Dak Dak', 'dak@gmail.com', '2020-07-08', '0218788888', 'Jalan Raya Bogor', 'Dak Dak Office', '0000-00-00 00:00:00', 'c4ca4238a0b923820dcc509a6f75849b', 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `domisili`
--
ALTER TABLE `domisili`
  ADD PRIMARY KEY (`id_dom`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfig`);

--
-- Indeks untuk tabel `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`notifikasi_id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indeks untuk tabel `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sesi_transaksi`
--
ALTER TABLE `sesi_transaksi`
  ADD PRIMARY KEY (`id_sesi`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `domisili`
--
ALTER TABLE `domisili`
  MODIFY `id_dom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `notifikasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sesi_transaksi`
--
ALTER TABLE `sesi_transaksi`
  MODIFY `id_sesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
