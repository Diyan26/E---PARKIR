-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Feb 2024 pada 18.31
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
-- Database: `db_parkiran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `parkirkeluar`
--

CREATE TABLE `parkirkeluar` (
  `NoPlat` varchar(20) NOT NULL,
  `WaktuMasuk` datetime DEFAULT NULL,
  `WaktuKeluar` datetime DEFAULT NULL,
  `Merek` varchar(50) DEFAULT NULL,
  `Keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `parkirkeluar`
--

INSERT INTO `parkirkeluar` (`NoPlat`, `WaktuMasuk`, `WaktuKeluar`, `Merek`, `Keterangan`) VALUES
('E 1000 ABS', '2024-02-07 00:35:02', '2024-02-11 06:23:50', 'yamaha', 'img/Screenshot (117).png'),
('E 1082 BGS', '2024-02-11 13:39:52', '2024-02-11 07:44:45', 'honda', 'img/Screenshot (111).png'),
('E 9866 YHA', '2024-02-06 20:54:31', '2024-02-11 06:12:04', 'yamaha', 'img/Screenshot (247).png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `terparkir`
--

CREATE TABLE `terparkir` (
  `NoPlat` varchar(20) NOT NULL,
  `WaktuMasuk` datetime DEFAULT NULL,
  `Merek` varchar(50) DEFAULT NULL,
  `Keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `terparkir`
--

INSERT INTO `terparkir` (`NoPlat`, `WaktuMasuk`, `Merek`, `Keterangan`) VALUES
('E 3123 DVN', '2024-02-11 15:58:55', 'kawasaki', 'img/Screenshot (164).png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'diyan', '12345'),
(4, 'admin', 'admin123\r\n');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `parkirkeluar`
--
ALTER TABLE `parkirkeluar`
  ADD PRIMARY KEY (`NoPlat`);

--
-- Indeks untuk tabel `terparkir`
--
ALTER TABLE `terparkir`
  ADD PRIMARY KEY (`NoPlat`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
