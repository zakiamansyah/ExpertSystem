-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25 Okt 2018 pada 20.51
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rusak`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` char(10) NOT NULL,
  `judul` char(100) NOT NULL,
  `isi` text NOT NULL,
  `foto` char(255) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `judul`, `isi`, `foto`, `tanggal`) VALUES
('ART01', 'POS', '<p>ASW</p>', 'asuka-senpai.PNG', '2018-10-25 03:41:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailuser`
--

CREATE TABLE `detailuser` (
  `id` int(11) NOT NULL,
  `nama` char(255) NOT NULL,
  `alamat` text NOT NULL,
  `jabatan` char(30) NOT NULL,
  `foto` char(255) NOT NULL,
  `user` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detailuser`
--

INSERT INTO `detailuser` (`id`, `nama`, `alamat`, `jabatan`, `foto`, `user`) VALUES
(1, 'TEST', 'jalan', 'Kasir', 'asuka-senpai.PNG', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` char(10) NOT NULL,
  `gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `gejala`) VALUES
('GJL01', 'Rapuh'),
('GJL02', 'Cacat'),
('GJL03', 'Pecah'),
('GJL04', 'Runyam'),
('GJL05', 'Berantakan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `id_laporan` char(10) NOT NULL,
  `id_artikel` char(10) NOT NULL,
  `id_rusak` char(10) NOT NULL,
  `id_gejala` char(10) NOT NULL,
  `user` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `relasigejala`
--

CREATE TABLE `relasigejala` (
  `id_relasigejala` char(10) NOT NULL,
  `id_gejala` char(10) NOT NULL,
  `id_solusi` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `relasigejala`
--

INSERT INTO `relasigejala` (`id_relasigejala`, `id_gejala`, `id_solusi`) VALUES
('RELGEJ01', 'GJL01', 'SOL01'),
('RELGEJ02', 'GJL02', 'SOL03'),
('RELGEJ03', 'GJL03', 'SOL03'),
('RELGEJ04', 'GJL05', 'SOL02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `relasiprogram`
--

CREATE TABLE `relasiprogram` (
  `id_relasiprogram` char(10) NOT NULL,
  `id_artikel` char(10) NOT NULL,
  `id_rusak` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `relasiprogram`
--

INSERT INTO `relasiprogram` (`id_relasiprogram`, `id_artikel`, `id_rusak`) VALUES
('RELPROG01', 'ART01', 'RUSAK01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `relasirusak`
--

CREATE TABLE `relasirusak` (
  `id_relasirusak` char(10) NOT NULL,
  `id_rusak` char(10) NOT NULL,
  `id_gejala` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `relasirusak`
--

INSERT INTO `relasirusak` (`id_relasirusak`, `id_rusak`, `id_gejala`) VALUES
('RELRSK01', 'RUSAK01', 'GJL01'),
('RELRSK02', 'RUSAK01', 'GJL02'),
('RELRSK03', 'RUSAK01', 'GJL04'),
('RELRSK04', 'RUSAK01', 'GJL05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rusak`
--

CREATE TABLE `rusak` (
  `id_rusak` char(10) NOT NULL,
  `nama_rusak` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rusak`
--

INSERT INTO `rusak` (`id_rusak`, `nama_rusak`) VALUES
('RUSAK01', 'Burak'),
('RUSAK02', 'Hancur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `solusi`
--

CREATE TABLE `solusi` (
  `id_solusi` char(10) NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `solusi`
--

INSERT INTO `solusi` (`id_solusi`, `solusi`) VALUES
('SOL01', 'Ganti'),
('SOL02', 'Beli Baru'),
('SOL03', 'Buang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` char(100) NOT NULL,
  `password` char(100) NOT NULL,
  `level` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user'),
(3, 'kepala', '870f669e4bbbfa8a6fde65549826d1c4', 'kepala'),
(4, 'kepala2', '5f1f84155432b4ac9839d38bca28ec8b', 'kepala');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indexes for table `detailuser`
--
ALTER TABLE `detailuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relasigejala`
--
ALTER TABLE `relasigejala`
  ADD PRIMARY KEY (`id_relasigejala`);

--
-- Indexes for table `relasiprogram`
--
ALTER TABLE `relasiprogram`
  ADD PRIMARY KEY (`id_relasiprogram`);

--
-- Indexes for table `relasirusak`
--
ALTER TABLE `relasirusak`
  ADD PRIMARY KEY (`id_relasirusak`);

--
-- Indexes for table `rusak`
--
ALTER TABLE `rusak`
  ADD PRIMARY KEY (`id_rusak`);

--
-- Indexes for table `solusi`
--
ALTER TABLE `solusi`
  ADD PRIMARY KEY (`id_solusi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailuser`
--
ALTER TABLE `detailuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
