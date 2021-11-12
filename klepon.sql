-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 03:18 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klepon`
--

-- --------------------------------------------------------

--
-- Table structure for table `datadiri`
--

CREATE TABLE `datadiri` (
  `id` int(11) NOT NULL,
  `id_golongan` int(10) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `id_pangkalan` varchar(50) NOT NULL,
  `tempatlahir` varchar(50) NOT NULL,
  `tanggallahir` date NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `kartu_identitas` varchar(100) NOT NULL,
  `suratmandat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datadiri`
--

INSERT INTO `datadiri` (`id`, `id_golongan`, `id_user`, `id_pangkalan`, `tempatlahir`, `tanggallahir`, `provinsi`, `kota`, `alamat`, `foto`, `kartu_identitas`, `suratmandat`) VALUES
(3, 3, 'znLaJlqiy', '61882eb6e8bc4', 'Tanjung Agung', '2000-11-29', 'Sumatera Selatan', 'Lubuklinggau', 'Jl. Nangka Lintas Rt.01 Kel. Ponorogo Kec. Lubuklinggau Utara II', 'znLaJlqiy.jpg', 'znLaJlqiy.pdf', 'znLaJlqiy.pdf'),
(7, 2, 'Ri2flUNL7', '6188bd1b06a01', 'Seluma', '2000-10-30', 'Bengkulu', 'Seluma', 'Jl. Nangka Lintas Rt.01 Kel. Ponorogo Kec. Lubuklinggau Utara II', 'Ri2flUNL7.jpg', 'Ri2flUNL7.pdf', 'Ri2flUNL7.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `datapangkalan`
--

CREATE TABLE `datapangkalan` (
  `id_pangkalan` varchar(50) NOT NULL,
  `nogudep` varchar(12) NOT NULL,
  `namapangkalan` varchar(100) NOT NULL,
  `kotapangkalan` varchar(50) NOT NULL,
  `provinsipangkalan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datapangkalan`
--

INSERT INTO `datapangkalan` (`id_pangkalan`, `nogudep`, `namapangkalan`, `kotapangkalan`, `provinsipangkalan`) VALUES
('61882eb6e8bc4', '02.001', 'Universitas Bengkulu', 'Bengkulu', 'Bengkulu'),
('6188bd1b06a01', '02.001', 'Universitas Bengkulu', 'Bengkulu', 'Bengkulu');

-- --------------------------------------------------------

--
-- Table structure for table `emailrequest`
--

CREATE TABLE `emailrequest` (
  `id` int(10) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emailrequest`
--

INSERT INTO `emailrequest` (`id`, `email`) VALUES
(9, 'dev.rafin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `idgolongan` int(3) NOT NULL,
  `golongan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`idgolongan`, `golongan`) VALUES
(1, 'Siaga'),
(2, 'Penggalang'),
(3, 'Penegak'),
(4, 'Pandega'),
(5, 'Umum');

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int(16) NOT NULL,
  `id_user` varchar(9) NOT NULL,
  `id_lomba` int(11) NOT NULL,
  `identitas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id`, `id_user`, `id_lomba`, `identitas`) VALUES
(1636620726, 'znLaJlqiy', 4737, ''),
(1636621198, 'znLaJlqiy', 8337, ''),
(1636621199, 'znLaJlqiy', 9182, '');

-- --------------------------------------------------------

--
-- Table structure for table `lomba`
--

CREATE TABLE `lomba` (
  `id` int(11) NOT NULL,
  `id_golongan` int(10) NOT NULL,
  `matalomba` varchar(50) NOT NULL,
  `biaya` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `tim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lomba`
--

INSERT INTO `lomba` (`id`, `id_golongan`, `matalomba`, `biaya`, `status`, `tim`) VALUES
(1547, 4, 'Essai', '30000', 1, 1),
(2789, 3, 'Syahril Qur\'an', '40000', 1, 2),
(4328, 1, 'Membaca Puisi', '25000', 1, 1),
(4737, 3, 'Fotografi', '30000', 1, 1),
(6791, 5, 'Essai', '30000', 1, 1),
(7542, 2, 'Tilawah', '30000', 1, 1),
(7745, 2, 'Video Edukasi Pramuka', '30000', 1, 1),
(8147, 1, 'Membaca Dongeng', '25000', 1, 1),
(8337, 3, 'Film Pendek', '40000', 1, 2),
(8359, 2, 'Olimpiade Pramuka Online', '30000', 1, 1),
(9182, 3, 'Stand Up Comedy', '30000', 1, 1),
(9647, 4, 'Video Pembelajaran Pramuka', '30000', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(9) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(14) NOT NULL,
  `password` text NOT NULL,
  `time_reg` varchar(20) NOT NULL,
  `tgl_reg` varchar(10) NOT NULL,
  `foto_profile` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `token` int(6) NOT NULL,
  `url` text NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `telepon`, `password`, `time_reg`, `tgl_reg`, `foto_profile`, `status`, `token`, `url`, `role`) VALUES
('sZBhbcg1C', 'SI Popon', 'sipoponprabu@kelepon.online', '082377936674', '$2y$10$gFoFAEvFk/d4Yw6SYamlgedI57JVDk3YKV3sXQjXbREnM0aZZ6X1K', '1635700712', '2021-10-31', 'popon.png', 1, 596216, '5DJ6uGKZc+cLsj9FZcNegucFahhFRo4Zu0Ws2Ss3Rvk=', 1),
('znLaJlqiy', 'Rafin Andika', 'dev.rafin@gmail.com', '082375332212', '$2y$10$szVTrySg7Qd0X9VMpMvR9ebOrffKuvhPOzVqVuF0G3R.xfO62Ax4S', '12:06:47pm', '2021-11-06', 'default.png', 1, 579368, 'wwvKqau+lrOM82qRq7INEk5s0vagbuIqfP3CY0FewlA=', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_activation`
--

CREATE TABLE `user_activation` (
  `id` int(50) NOT NULL,
  `id_user` varchar(9) NOT NULL,
  `token` int(6) NOT NULL,
  `url` text NOT NULL,
  `date` varchar(12) NOT NULL,
  `time` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datadiri`
--
ALTER TABLE `datadiri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailrequest`
--
ALTER TABLE `emailrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`idgolongan`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lomba`
--
ALTER TABLE `lomba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activation`
--
ALTER TABLE `user_activation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datadiri`
--
ALTER TABLE `datadiri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `emailrequest`
--
ALTER TABLE `emailrequest`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `idgolongan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1636621200;

--
-- AUTO_INCREMENT for table `lomba`
--
ALTER TABLE `lomba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9648;

--
-- AUTO_INCREMENT for table `user_activation`
--
ALTER TABLE `user_activation`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
