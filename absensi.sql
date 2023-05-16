-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2023 at 04:58 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_akun` int(11) NOT NULL,
  `id_absensi` int(11) NOT NULL,
  `jam_masuk` time(4) NOT NULL,
  `id_dosen` varchar(10) NOT NULL,
  `id_matkul` varchar(10) NOT NULL,
  `id_sesi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akun_admin`
--

CREATE TABLE `akun_admin` (
  `id_admin` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `nama` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `last_login` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_admin`
--

INSERT INTO `akun_admin` (`id_admin`, `nim`, `nama`, `email`, `password`, `last_login`) VALUES
(1001, 216151001, 'Irfan Noor Hidayat', 'IrfanNoorH@gmail.com', '$2y$10$e6XetDPxfo/FjTeZsT63bORzoX5BLw1rG28VnhhgJFEZhA4SS23ly', '2023-05-16 10:46:38'),
(1023, 216151023, 'Sri Ajeng Kartika', 'ajengkartika@gmail.com', '$2y$10$l9GFUpxOqOoqPLaIyX34ee19X8.s6gmHwRcuX/q55VpZh9jgX2886', '2023-05-16 10:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `akun_mahasiswa`
--

CREATE TABLE `akun_mahasiswa` (
  `id_akun` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_mahasiswa`
--

INSERT INTO `akun_mahasiswa` (`id_akun`, `nim`, `email`, `username`, `password`) VALUES
(1, 216151001, 'IrfanNoorH@gmail.com', 'irufan_noor', 0),
(23, 216151023, 'ajengkartika@gmail.com', 'ajengktk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip_dosen` int(11) NOT NULL,
  `no_hp` int(11) DEFAULT NULL,
  `nama_dosen` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_matkul` int(11) DEFAULT NULL,
  `id_sesi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_absensi`
--

CREATE TABLE `log_absensi` (
  `id_absensi` int(11) DEFAULT NULL,
  `status_kehadiran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_sesi`
--

CREATE TABLE `log_sesi` (
  `waktu_sesi` time(4) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `id_sesi` int(11) DEFAULT NULL,
  `id_matkul` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(11) NOT NULL,
  `nomor_absen` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jeniskelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nomor_absen`, `nama`, `kelas`, `jeniskelamin`, `tgl_lahir`, `foto`) VALUES
(216151001, 1, 'Irfan Noor Hidayat', '4A', 'Laki-laki', '2003-09-09', 'irfan.jpg'),
(216151023, 23, 'Sri Ajeng Kartika', '4A', 'Perempuan', '2003-05-15', 'irfan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id_matkul` int(11) NOT NULL,
  `id_dosen` varchar(20) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekapan_sementara`
--

CREATE TABLE `rekapan_sementara` (
  `id_rekap` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `hasil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekapan_tetap`
--

CREATE TABLE `rekapan_tetap` (
  `id_rekap` int(11) NOT NULL,
  `hasil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_admin`
--
ALTER TABLE `akun_admin`
  ADD PRIMARY KEY (`id_admin`) USING BTREE,
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `akun_mahasiswa`
--
ALTER TABLE `akun_mahasiswa`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `nim_akunmhs` (`nim`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip_dosen`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `rekapan_tetap`
--
ALTER TABLE `rekapan_tetap`
  ADD PRIMARY KEY (`id_rekap`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun_admin`
--
ALTER TABLE `akun_admin`
  ADD CONSTRAINT `nim` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`);

--
-- Constraints for table `akun_mahasiswa`
--
ALTER TABLE `akun_mahasiswa`
  ADD CONSTRAINT `nim_akunmhs` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
