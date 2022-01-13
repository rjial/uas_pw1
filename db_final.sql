-- phpMyAdmin SQL Dump
-- version 5.1.1-3.fc36
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 13 Jan 2022 pada 08.37
-- Versi server: 10.5.13-MariaDB
-- Versi PHP: 8.1.2RC1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_pw1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ambil_lomba`
--

CREATE TABLE `ambil_lomba` (
  `ID_PESERTA` int(11) NOT NULL,
  `ID_LOMBA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lomba`
--

CREATE TABLE `lomba` (
  `NAMA_LOMBA` varchar(200) NOT NULL,
  `JENIS_LOMBA` varchar(30) NOT NULL,
  `TINGKAT_LOMBA` varchar(30) NOT NULL,
  `HADIAH` int(11) NOT NULL,
  `SERTIFIKAT` varchar(20) NOT NULL,
  `ID_LOMBA` int(11) NOT NULL,
  `ID_PERGURUAN_TINGGI` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lomba`
--

INSERT INTO `lomba` (`NAMA_LOMBA`, `JENIS_LOMBA`, `TINGKAT_LOMBA`, `HADIAH`, `SERTIFIKAT`, `ID_LOMBA`, `ID_PERGURUAN_TINGGI`) VALUES
('Line Follower', 'Robotik', 'Provinsi', 10000000, 'LSP', 2, 2),
('Android Programming', 'Web', 'Nasional', 200000, 'LSP', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perguruan_tinggi`
--

CREATE TABLE `perguruan_tinggi` (
  `NAMA_PERGURUAN` varchar(100) NOT NULL,
  `ALAMAT` text NOT NULL,
  `AKREDITAS` varchar(5) NOT NULL,
  `ID_PERGURUAN_TINGGI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perguruan_tinggi`
--

INSERT INTO `perguruan_tinggi` (`NAMA_PERGURUAN`, `ALAMAT`, `AKREDITAS`, `ID_PERGURUAN_TINGGI`) VALUES
('Universitas Gajah Duduk', 'Jl. Gajah duduk Gg.1 No.1', 'A', 2),
('STIKI Malang', 'Jl. Tidaraaaaaaaa', 'A', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `NAMA` varchar(200) NOT NULL,
  `KELAS` varchar(15) NOT NULL,
  `ASAL` varchar(30) NOT NULL,
  `JENIS_KELAMIN` char(1) NOT NULL,
  `JURUSAN` varchar(20) NOT NULL,
  `ALAMAR` text NOT NULL,
  `ID_PESERTA` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`NAMA`, `KELAS`, `ASAL`, `JENIS_KELAMIN`, `JURUSAN`, `ALAMAR`, `ID_PESERTA`, `ID_USER`) VALUES
('Peserta', 'XI', 'Malank', 'L', 'RPL', 'adfasdfasdfaf', 1, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `ID_LEVEL` int(11) DEFAULT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID_USER`, `ID_LEVEL`, `USERNAME`, `PASSWORD`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(6, 2, 'peserta', '129451d83a60351a82516cb836842c68');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_level`
--

CREATE TABLE `user_level` (
  `ID_LEVEL` int(11) NOT NULL,
  `NAMA_LEVEL` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_level`
--

INSERT INTO `user_level` (`ID_LEVEL`, `NAMA_LEVEL`) VALUES
(1, 'Admin'),
(2, 'Peserta');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ambil_lomba`
--
ALTER TABLE `ambil_lomba`
  ADD PRIMARY KEY (`ID_PESERTA`,`ID_LOMBA`),
  ADD KEY `FK_AMBIL_LO_AMBIL_LOM_LOMBA` (`ID_LOMBA`);

--
-- Indeks untuk tabel `lomba`
--
ALTER TABLE `lomba`
  ADD PRIMARY KEY (`ID_LOMBA`),
  ADD KEY `FK_LOMBA_MENGADAKA_PERGURUA` (`ID_PERGURUAN_TINGGI`);

--
-- Indeks untuk tabel `perguruan_tinggi`
--
ALTER TABLE `perguruan_tinggi`
  ADD PRIMARY KEY (`ID_PERGURUAN_TINGGI`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`ID_PESERTA`),
  ADD KEY `FK_PESERTA_RELATIONS_USER` (`ID_USER`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `FK_USER_RELATIONS_USER_LEV` (`ID_LEVEL`);

--
-- Indeks untuk tabel `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`ID_LEVEL`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lomba`
--
ALTER TABLE `lomba`
  MODIFY `ID_LOMBA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `perguruan_tinggi`
--
ALTER TABLE `perguruan_tinggi`
  MODIFY `ID_PERGURUAN_TINGGI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `ID_PESERTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_level`
--
ALTER TABLE `user_level`
  MODIFY `ID_LEVEL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ambil_lomba`
--
ALTER TABLE `ambil_lomba`
  ADD CONSTRAINT `FK_AMBIL_LO_AMBIL_LOM_LOMBA` FOREIGN KEY (`ID_LOMBA`) REFERENCES `lomba` (`ID_LOMBA`),
  ADD CONSTRAINT `FK_AMBIL_LO_AMBIL_LOM_PESERTA` FOREIGN KEY (`ID_PESERTA`) REFERENCES `peserta` (`ID_PESERTA`);

--
-- Ketidakleluasaan untuk tabel `lomba`
--
ALTER TABLE `lomba`
  ADD CONSTRAINT `FK_LOMBA_MENGADAKA_PERGURUA` FOREIGN KEY (`ID_PERGURUAN_TINGGI`) REFERENCES `perguruan_tinggi` (`ID_PERGURUAN_TINGGI`);

--
-- Ketidakleluasaan untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `FK_PESERTA_RELATIONS_USER` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_RELATIONS_USER_LEV` FOREIGN KEY (`ID_LEVEL`) REFERENCES `user_level` (`ID_LEVEL`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
