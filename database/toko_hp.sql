-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 12 Okt 2023 pada 15.55
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
-- Database: `toko_hp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buyer`
--

CREATE TABLE `buyer` (
  `id_buyer` int(11) NOT NULL,
  `name_buyer` varchar(250) NOT NULL,
  `address_buyer` varchar(255) NOT NULL,
  `noktp` int(20) NOT NULL,
  `npwp` int(20) NOT NULL,
  `nohp_buyer` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buyer`
--

INSERT INTO `buyer` (`id_buyer`, `name_buyer`, `address_buyer`, `noktp`, `npwp`, `nohp_buyer`) VALUES
(6, 'agus', 'solo', 2147483345, 2147483647, '08964523453'),
(8, 'seli', 'Bandung', 2147483647, 2147483647, '0814325678'),
(9, 'beni', 'tasik', 2147483647, 2147483647, '08934521765'),
(10, 'abas', 'karawang', 123456789, 122345678, '085123456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `credit`
--

CREATE TABLE `credit` (
  `id_credit` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `uang_muka` bigint(250) NOT NULL,
  `angsuran` int(36) NOT NULL,
  `angsuran_berjalan` int(36) NOT NULL,
  `dana` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `credit`
--

INSERT INTO `credit` (`id_credit`, `id_transaksi`, `date`, `uang_muka`, `angsuran`, `angsuran_berjalan`, `dana`) VALUES
(29, 52, '2023-01-23 10:05:04', 5000000, 12, 6, 3000000),
(30, 52, '2023-01-23 15:51:09', 5000000, 12, 7, 3000000),
(31, 55, '2023-01-23 16:03:28', 10000000, 24, 24, 10000000),
(32, 57, '2023-01-24 05:24:29', 5000000, 12, 2, 1000000),
(33, 52, '2023-01-24 05:41:01', 5000000, 12, 12, 18582000),
(34, 57, '2023-01-24 06:51:53', 5000000, 12, 12, 50000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `spek` varchar(255) NOT NULL,
  `photo_stock` varchar(255) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`id_stock`, `phone`, `price`, `stok`, `spek`, `photo_stock`) VALUES
(7, 'Samsung Galaxy S22 Ultra ', 13291000, 5, 'layar 6.8\" dan tingkat densitas piksel sebesar 500ppi.  kamera belakang 12 + 108 + 10 + 10MP dan kamera depan 40MP. Memiliki berat sebesar 228g,  kapasitas baterai 5000mAh. ', 'Samsung-Galaxy-S22-Ultra-img.png'),
(9, 'iphone 11', 10000000, 6, 'Chipset A13 Bionic', 'iphone 11.jpg'),
(11, 'iphone 12', 15000000, 0, 'Chipset Abionic 13', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_buyer` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phone` varchar(255) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `tunai` bigint(20) NOT NULL,
  `type_pembayaran` varchar(25) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_buyer`, `id_stock`, `userid`, `tanggal`, `phone`, `jumlah`, `total_harga`, `tunai`, `type_pembayaran`, `status`) VALUES
(52, 6, 7, 4, '2023-01-24 05:41:01', 'Samsung Galaxy S22 Ultra ', 2, 26582000, 5000000, 'Credit', 'Lunas'),
(55, 9, 9, 4, '2023-01-23 16:03:28', 'iphone 11', 2, 20000000, 10000000, 'Credit', 'Lunas'),
(56, 8, 9, 3, '2023-01-23 16:15:04', 'iphone 11', 1, 10000000, 10000000, 'Cash', 'Lunas'),
(57, 9, 11, 5, '2023-01-24 06:51:53', 'iphone 12', 1, 15000000, 5000000, 'Credit', 'Lunas'),
(58, 8, 7, 3, '2023-01-24 06:47:57', 'Samsung Galaxy S22 Ultra ', 2, 26582000, 1000000, 'Credit', 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `usertype`, `fullname`) VALUES
(2, 'admin2', '$2y$10$1rH.FgRii0D1rYjzjqXu9.eZc99qw0L7jz2loswHhizd5TSh/b15C', 'Admin', 'bambang'),
(3, 'nana', '$2y$10$sqktqnKqqFBtv.D9CGXvue6izW5u6.NDQW.EkSsK78nwnl7ISpXyy', 'Kasir', 'nana kusna'),
(4, 'shiva', '$2y$10$fL2wch/.hOMYn/w1IEMpmeG7x.4bIAVd840kdHP.gvqPKQBX84xGO', 'Admin', 'shiva fauzani'),
(5, 'ahmad', '$2y$10$9EiUof6..a8ntg4E1MbqE.o7QSCCraI2k.gNFWoGHxkaEKmiE.9Wi', 'Kasir', 'ahmad adam');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`id_buyer`);

--
-- Indeks untuk tabel `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`id_credit`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_buyer` (`id_buyer`),
  ADD KEY `id_stock` (`id_stock`),
  ADD KEY `userid` (`userid`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buyer`
--
ALTER TABLE `buyer`
  MODIFY `id_buyer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `credit`
--
ALTER TABLE `credit`
  MODIFY `id_credit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_buyer`) REFERENCES `buyer` (`id_buyer`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
