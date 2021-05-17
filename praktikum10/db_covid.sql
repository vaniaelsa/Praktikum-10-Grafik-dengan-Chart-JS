-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03 Mei 2020 pada 09.40
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_covid`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_covid`
--

CREATE TABLE `tb_covid` (
  `negara` varchar(25) NOT NULL,
  `total_kasus` int(25) DEFAULT NULL,
  `kasus_baru` int(25) DEFAULT NULL,
  `total_kematian` int(25) DEFAULT NULL,
  `kematian_baru` int(25) DEFAULT NULL,
  `total_sembuh` int(25) DEFAULT NULL,
  `kasus_aktif` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_covid`
--

INSERT INTO `tb_covid` (`negara`, `total_kasus`, `kasus_baru`, `total_kematian`, `kematian_baru`, `total_sembuh`, `kasus_aktif`) VALUES
('Amerika Serikat', 33715951, NULL, 600147 , NULL, 27136020, 5979784),
('India', 24964925, NULL, 274411, NULL, 21167609, 3522905),
('Brazil', 15627475, NULL, 435823, NULL, 14097287, 1094365),
('Prancis', 5877787, NULL, 107616, NULL, 5116705, 653466),
('Turki', 5117374, NULL, 44760, NULL, 4947256, 125358),
('Rusia', 4940245, NULL, 115871, NULL, 4556073, 268031),
('Inggris', 4450777, NULL, 127679 , NULL, 4277207, 45891),
('Italia', 4159122, NULL, 124156, NULL, 3706084, 328882),
('Spanyol', 3604799, NULL, 79339, NULL, 3297340, 228120),
('Jerman', 3602939, NULL, 86731, NULL, 3286400, 229808);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_covid`
--
ALTER TABLE `tb_covid`
  ADD PRIMARY KEY (`negara`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
