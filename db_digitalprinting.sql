-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jul 2023 pada 15.19
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_digitalprinting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `kode_bahan` char(3) NOT NULL,
  `jenis_bahan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`kode_bahan`, `jenis_bahan`) VALUES
('CAN', 'Canvas'),
('FXC', 'Flexi China'),
('FXK', 'Flexi Korea'),
('SRI', 'Sticker Ritrama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `level`) VALUES
(1, 'sales_order', 'sales123', 1),
(2, 'data_analyst', 'data123', 2),
(3, 'inventory_control', 'inventory123', 3),
(4, 'finance', 'finance123', 4),
(5, 'pelanggan', 'pelanggan123', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kode_pelanggan` char(6) NOT NULL,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` char(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`kode_pelanggan`, `nama_pelanggan`, `alamat`, `no_telp`) VALUES
('KP0001', 'Adit', 'Cikokol', '081212345678'),
('KP0002', 'Herry', 'Kebon Nanas', '081223456789'),
('KP0003', 'Angga', 'Balaraja', '081234567890');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesan_detail`
--

CREATE TABLE `pemesan_detail` (
  `id_pesan` char(5) DEFAULT NULL,
  `kode_print` char(3) DEFAULT NULL,
  `jumlah_permeter` smallint(6) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesan_detail`
--

INSERT INTO `pemesan_detail` (`id_pesan`, `kode_print`, `jumlah_permeter`, `harga`) VALUES
('P0001', 'PST', 100, 2500000),
('P0002', 'PFO', 130, 22750000),
('P0003', 'PBO', 300, 6000000),
('P0003', 'PST', 140, 3500000),
('P0002', 'PBR', 200, 10000000);

--
-- Trigger `pemesan_detail`
--
DELIMITER $$
CREATE TRIGGER `update_stok` AFTER INSERT ON `pemesan_detail` FOR EACH ROW BEGIN
	UPDATE prints SET stok_bahan = stok_bahan - NEW.jumlah_permeter
    WHERE kode_print = NEW.kode_print;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesan_header`
--

CREATE TABLE `pemesan_header` (
  `id_pesan` char(5) NOT NULL,
  `kode_pelanggan` char(6) DEFAULT NULL,
  `tanggal_pesan` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesan_header`
--

INSERT INTO `pemesan_header` (`id_pesan`, `kode_pelanggan`, `tanggal_pesan`, `tanggal_selesai`, `total_harga`) VALUES
('P0001', 'KP0001', '2023-05-01', '2023-05-04', 2500000),
('P0002', 'KP0002', '2023-05-06', '2023-05-11', 32750000),
('P0003', 'KP0003', '2023-05-07', '2023-05-16', 9500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prints`
--

CREATE TABLE `prints` (
  `kode_print` char(3) NOT NULL,
  `jenis_print` varchar(100) DEFAULT NULL,
  `kode_bahan` char(3) DEFAULT NULL,
  `stok_bahan` smallint(6) DEFAULT NULL,
  `harga_permeter` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prints`
--

INSERT INTO `prints` (`kode_print`, `jenis_print`, `kode_bahan`, `stok_bahan`, `harga_permeter`) VALUES
('PBO', 'Print Baliho', 'FXC', 5983, 20000),
('PBR', 'Print Banner', 'FXK', 3783, 50000),
('PFO', 'Print Foto', 'CAN', 7995, 175000),
('PST', 'Print Sticker', 'SRI', 9993, 25000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`kode_bahan`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indeks untuk tabel `pemesan_detail`
--
ALTER TABLE `pemesan_detail`
  ADD KEY `FK_pemesan_detail_print` (`kode_print`),
  ADD KEY `FK_pemesan_detail_pemesan_header` (`id_pesan`);

--
-- Indeks untuk tabel `pemesan_header`
--
ALTER TABLE `pemesan_header`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `FK_pemesan_header_pelanggan` (`kode_pelanggan`);

--
-- Indeks untuk tabel `prints`
--
ALTER TABLE `prints`
  ADD PRIMARY KEY (`kode_print`),
  ADD KEY `FK_print_bahan` (`kode_bahan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemesan_detail`
--
ALTER TABLE `pemesan_detail`
  ADD CONSTRAINT `FK_pemesan_detail_pemesan_header` FOREIGN KEY (`id_pesan`) REFERENCES `pemesan_header` (`id_pesan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_pemesan_detail_print` FOREIGN KEY (`kode_print`) REFERENCES `prints` (`kode_print`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesan_header`
--
ALTER TABLE `pemesan_header`
  ADD CONSTRAINT `FK_pemesan_header_pelanggan` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode_pelanggan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `prints`
--
ALTER TABLE `prints`
  ADD CONSTRAINT `FK_print_bahan` FOREIGN KEY (`kode_bahan`) REFERENCES `bahan` (`kode_bahan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
