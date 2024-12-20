-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Des 2024 pada 03.52
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `prefix` varchar(3) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`category_id`, `name`, `prefix`, `is_deleted`, `created_at`, `created_by`) VALUES
(1, 'Software', 'SW', 0, '2024-10-22 15:12:14', '7'),
(2, 'Hardware', 'HW', 0, '2024-10-22 15:12:31', '7'),
(3, 'Network', 'NW', 0, '2024-10-22 15:12:48', '7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_pic`
--

CREATE TABLE `category_pic` (
  `category_pic_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `departement`
--

CREATE TABLE `departement` (
  `departement_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `departement`
--

INSERT INTO `departement` (`departement_id`, `name`, `is_deleted`, `created_at`, `created_by`) VALUES
(1, 'administrator', 0, '2024-10-22 15:14:16', '7'),
(2, 'user', 0, '2024-10-22 15:14:22', '7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `priority`
--

CREATE TABLE `priority` (
  `priority_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `priority`
--

INSERT INTO `priority` (`priority_id`, `name`, `is_deleted`, `created_at`, `created_by`) VALUES
(1, 'Low', 0, '2024-10-22 15:17:07', '7'),
(2, 'Medium', 0, '2024-10-22 15:17:13', '7'),
(3, 'High', 0, '2024-10-22 15:17:19', '7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `no_ticket` varchar(20) NOT NULL,
  `user_id_request` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `description` text,
  `feedback` text,
  `resource` varchar(100) NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `request`
--

INSERT INTO `request` (`request_id`, `no_ticket`, `user_id_request`, `category_id`, `priority_id`, `status_id`, `topic`, `description`, `feedback`, `resource`, `lampiran`, `is_deleted`, `created_at`, `created_by`) VALUES
(1, 'HW.2024.10.00001', 2, 2, 2, 1, 'Tes', 'Tes', NULL, 'Ticketing', NULL, 0, '2024-10-30 11:29:48', '1'),
(2, 'SW.2024.11.00002', 2, 1, 2, 1, 'HELP', 'ujicoba', NULL, 'web/system', 'lampiran_1730949312.jpeg', 0, '2024-11-07 10:15:12', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_category_pic`
--

CREATE TABLE `request_category_pic` (
  `category_pic_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`status_id`, `name`, `is_deleted`, `created_at`, `created_by`) VALUES
(1, 'Menunggu Antrean', 0, '2024-10-22 15:18:17', '7'),
(2, 'Sedang Diproses', 0, '2024-10-22 15:18:22', '7'),
(3, 'Selesai', 0, '2024-10-22 15:18:28', '7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `departement_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `nik`, `name`, `no_hp`, `email`, `password`, `departement_id`, `is_deleted`, `created_at`, `created_by`) VALUES
(1, '33222342', 'Fahri Admin', '0812391293182', 'admin@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 0, '2024-10-23 10:15:23', NULL),
(2, '2313125', 'Abdul', '081282150702', 'Abiyyu838@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, 0, '2024-10-23 10:16:07', NULL),
(3, '23424235', 'Udin', '08827635647', 'user@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, 0, '2024-10-23 10:16:27', NULL),
(4, '1234123423', 'Rojak', '081388358506', 'muhammad.azril.achdi@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, 0, '2024-10-23 10:18:25', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `category_pic`
--
ALTER TABLE `category_pic`
  ADD PRIMARY KEY (`category_pic_id`);

--
-- Indeks untuk tabel `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`departement_id`);

--
-- Indeks untuk tabel `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`priority_id`);

--
-- Indeks untuk tabel `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `category_pic`
--
ALTER TABLE `category_pic`
  MODIFY `category_pic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `departement`
--
ALTER TABLE `departement`
  MODIFY `departement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `priority`
--
ALTER TABLE `priority`
  MODIFY `priority_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
