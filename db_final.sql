-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Nov 2021 pada 07.45
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.23

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`USERNAME`, `PASSWORD`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

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
  `NAMA_LOMBA` varchar(30) NOT NULL,
  `JENIS_LOMBA` varchar(30) NOT NULL,
  `TINGKAT_LOMBA` varchar(30) NOT NULL,
  `HADIAH` int(11) NOT NULL,
  `SERTIFIKAT` varchar(20) NOT NULL,
  `ID_LOMBA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lomba`
--

INSERT INTO `lomba` (`NAMA_LOMBA`, `JENIS_LOMBA`, `TINGKAT_LOMBA`, `HADIAH`, `SERTIFIKAT`, `ID_LOMBA`) VALUES
('Mboh', 'Mboh Opo', 'Tingkat Mboh', 1, 'Mboh', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perguruan_tinggi`
--

CREATE TABLE `perguruan_tinggi` (
  `NAMA_PERGURUAN` varchar(20) NOT NULL,
  `ALAMAT` text NOT NULL,
  `AKREDITAS` varchar(5) NOT NULL,
  `ID_PERGURUAN_TINGGI` int(11) NOT NULL,
  `ID_LOMBA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perguruan_tinggi`
--

INSERT INTO `perguruan_tinggi` (`NAMA_PERGURUAN`, `ALAMAT`, `AKREDITAS`, `ID_PERGURUAN_TINGGI`, `ID_LOMBA`) VALUES
('Unigga', 'asdfasdfasdfasdfasdf', 'A', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `NAMA` varchar(20) NOT NULL,
  `KELAS` varchar(15) NOT NULL,
  `ASAL` varchar(30) NOT NULL,
  `JENIS_KELAMIN` char(1) NOT NULL,
  `JURUSAN` varchar(20) NOT NULL,
  `ALAMAR` text NOT NULL,
  `ID_PESERTA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`NAMA`, `KELAS`, `ASAL`, `JENIS_KELAMIN`, `JURUSAN`, `ALAMAR`, `ID_PESERTA`) VALUES
('Udin', 'XII TB A', 'Malang', 'L', 'TB', 'dadadsasdasd', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`USERNAME`);

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
  ADD PRIMARY KEY (`ID_LOMBA`);

--
-- Indeks untuk tabel `perguruan_tinggi`
--
ALTER TABLE `perguruan_tinggi`
  ADD PRIMARY KEY (`ID_PERGURUAN_TINGGI`),
  ADD KEY `FK_PERGURUA_MENGADAKA_LOMBA` (`ID_LOMBA`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`ID_PESERTA`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lomba`
--
ALTER TABLE `lomba`
  MODIFY `ID_LOMBA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `perguruan_tinggi`
--
ALTER TABLE `perguruan_tinggi`
  MODIFY `ID_PERGURUAN_TINGGI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `ID_PESERTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Ketidakleluasaan untuk tabel `perguruan_tinggi`
--
ALTER TABLE `perguruan_tinggi`
  ADD CONSTRAINT `FK_PERGURUA_MENGADAKA_LOMBA` FOREIGN KEY (`ID_LOMBA`) REFERENCES `lomba` (`ID_LOMBA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
