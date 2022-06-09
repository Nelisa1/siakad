-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2022 at 04:03 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `id_dosen` varchar(50) NOT NULL,
  `nip` varchar(16) NOT NULL,
  `namadsn` varchar(80) NOT NULL,
  `jenkel` enum('L','P') NOT NULL,
  `gol` varchar(5) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`id_dosen`, `nip`, `namadsn`, `jenkel`, `gol`, `alamat`, `no_telp`, `jurusan`) VALUES
('b79274bc-7f8b-481c-896b-0b552ea0d5ff', '1966081220000710', 'YAYA', 'P', 'III/B', 'Jl. Mawar', '085345564556', 'Administrasi Negara'),
('c97317b7-a816-476a-88d5-b6bb2ade5e02', '1968010119980210', 'ADI', 'L', 'IV/A', 'jl. bali', '082212341234', 'Akutansi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jur` varchar(100) NOT NULL,
  `kodejur` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jur`, `kodejur`, `jurusan`) VALUES
('13581027-1ae4-4514-a004-0ded828fc54f', '400', 'Teknik Sipil'),
('9e7eadee-8341-4c23-bdc1-65212a6bd21a', '300', 'Administrasi Negara'),
('a358eb28-18b3-4fae-802f-487b2ce021ce', '100', 'Teknik Komputer dan Informatika'),
('c818a324-9a09-4e3e-9758-fdb21c83a62a', '200', 'Akutansi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mhs`
--

CREATE TABLE `tb_mhs` (
  `id_mhs` varchar(50) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `namamhs` varchar(80) NOT NULL,
  `jenkel` enum('L','P') NOT NULL,
  `tmasuk` text NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_mhs`
--

INSERT INTO `tb_mhs` (`id_mhs`, `nim`, `namamhs`, `jenkel`, `tmasuk`, `no_telp`, `jurusan`) VALUES
('18ef9064-54dc-43d0-8bea-af485da07f75', '1905112098', 'DIYA', 'P', '2019', '081397885656', 'Teknik Sipil'),
('742bd465-9475-4665-a489-cf7ca8211c62', '1905342312', 'DIDI', 'L', '2019', '0295382684', 'Teknik Komputer dan Informatika'),
('f49ca849-831d-4a30-937a-d5ed4ad82dbd', '1905112043', 'LIYYIN', 'P', '2019', '081356564545', 'Teknik Sipil');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(50) NOT NULL,
  `nama_user` varchar(80) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
('b1a0c7dd-0935-11e8-a30f-5c93a2c901cb', 'Mohammad Nur Fawaiq', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1'),
('bfc93300-093a-11e8-a30f-5c93a2c901cb', 'Dilan 1990', 'dilan', 'fa9f1991b525abb209b957a34a8a94ef3ffbce0b', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jur`);

--
-- Indexes for table `tb_mhs`
--
ALTER TABLE `tb_mhs`
  ADD PRIMARY KEY (`id_mhs`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
