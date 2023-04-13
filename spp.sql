-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Apr 2023 pada 20.38
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `bulan_pembayaran` enum('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember') DEFAULT NULL,
  `nominal_pembayaran` int(11) NOT NULL,
  `status_pembayaran` enum('Belum','Lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_siswa`, `tgl_pembayaran`, `bulan_pembayaran`, `nominal_pembayaran`, `status_pembayaran`) VALUES
(1, 1, '2023-04-14 01:37:00', 'Januari', 200000, 'Lunas'),
(2, 1, '0000-00-00 00:00:00', 'Februari', 0, 'Belum'),
(3, 1, '0000-00-00 00:00:00', 'Maret', 0, 'Belum'),
(4, 1, '0000-00-00 00:00:00', 'April', 0, 'Belum'),
(5, 1, '0000-00-00 00:00:00', 'Mei', 0, 'Belum'),
(6, 1, '0000-00-00 00:00:00', 'Juni', 0, 'Belum'),
(7, 1, '0000-00-00 00:00:00', 'Juli', 0, 'Belum'),
(8, 1, '0000-00-00 00:00:00', 'Agustus', 0, 'Belum'),
(9, 1, '0000-00-00 00:00:00', 'September', 0, 'Belum'),
(10, 1, '0000-00-00 00:00:00', 'Oktober', 0, 'Belum'),
(11, 1, '0000-00-00 00:00:00', 'November', 0, 'Belum'),
(12, 1, '0000-00-00 00:00:00', 'Desember', 0, 'Belum'),
(13, 2, '0000-00-00 00:00:00', 'Januari', 0, 'Belum'),
(14, 2, '0000-00-00 00:00:00', 'Februari', 0, 'Belum'),
(15, 2, '0000-00-00 00:00:00', 'Maret', 0, 'Belum'),
(16, 2, '0000-00-00 00:00:00', 'April', 0, 'Belum'),
(17, 2, '0000-00-00 00:00:00', 'Mei', 0, 'Belum'),
(18, 2, '0000-00-00 00:00:00', 'Juni', 0, 'Belum'),
(19, 2, '0000-00-00 00:00:00', 'Juli', 0, 'Belum'),
(20, 2, '0000-00-00 00:00:00', 'Agustus', 0, 'Belum'),
(21, 2, '0000-00-00 00:00:00', 'September', 0, 'Belum'),
(22, 2, '0000-00-00 00:00:00', 'Oktober', 0, 'Belum'),
(23, 2, '0000-00-00 00:00:00', 'November', 0, 'Belum'),
(24, 2, '0000-00-00 00:00:00', 'Desember', 0, 'Belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `alamat_siswa` text NOT NULL,
  `tgl_lahir_siswa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `alamat_siswa`, `tgl_lahir_siswa`) VALUES
(1, 'Andri Firman Saputra', 'Jl. AMD Babakan Pocis', '2002-01-29'),
(2, 'Jafar', 'Tangerang', '2002-01-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '$2y$10$hpZDiK7AZGZqxfmzX2CbI.Aqp7MW8S6roNg2Ntnw4ityWL9f8yOt.', 'Andri Firman Saputra');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayaran_ibfk_1` (`id_siswa`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
