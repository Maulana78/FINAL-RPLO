-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 24 Des 2021 pada 12.52
-- Versi Server: 5.5.32
-- Versi PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `stokbarang`
--
CREATE DATABASE IF NOT EXISTS `stokbarang` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `stokbarang`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE IF NOT EXISTS `keluar` (
  `idkeluar` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`idkeluar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `customer`, `qty`) VALUES
(1, 5, '2021-12-22 16:29:17', 'wawan', 60),
(2, 6, '2021-12-22 17:06:35', 'budi', 45),
(3, 5, '2021-12-22 17:10:55', 'maul', 50),
(4, 6, '2021-12-22 17:13:41', 'Rani', 5),
(6, 9, '2021-12-23 10:41:16', 'ada ', 190),
(7, 9, '2021-12-23 10:44:28', 'wawan', 200),
(8, 10, '2021-12-23 11:03:55', 'maul', 10),
(9, 9, '2021-12-23 11:04:48', 'budi', 300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(1, 'stokbarang@gmail.com', '12345'),
(2, 'Maulana@gmail.com', '13020190244');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE IF NOT EXISTS `masuk` (
  `idmasuk` int(11) NOT NULL AUTO_INCREMENT,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keterangan` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`idmasuk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`) VALUES
(11, 6, '2021-12-22 17:05:53', 'yanto', 50),
(12, 7, '2021-12-23 08:10:13', 'udin', 100),
(15, 9, '2021-12-23 10:44:04', 'anto', 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `idbarang` int(11) NOT NULL AUTO_INCREMENT,
  `namabarang` varchar(25) NOT NULL,
  `deskripsi` varchar(25) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`idbarang`, `namabarang`, `deskripsi`, `stok`) VALUES
(9, 'Ultra milk', 'susu', 0),
(10, 'Roti', 'makanan', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
