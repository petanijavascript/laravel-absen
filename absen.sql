-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 08:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(13) NOT NULL,
  `email` varchar(40) NOT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `jumlah_lembur` int(11) DEFAULT 0,
  `selisih_kurang` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `email`, `waktu_masuk`, `waktu_keluar`, `jumlah_lembur`, `selisih_kurang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 'fujhi@gmail.com', '2024-01-01 09:00:00', '2024-01-01 17:30:00', 0, 0, '2024-01-01 10:25:31', '2024-01-01 11:06:02', NULL),
(22, 'fujhi@gmail.com', '2024-01-02 08:38:33', '2024-01-02 17:30:00', 0, 0, '2024-01-02 10:38:41', '2024-01-02 11:06:02', NULL),
(23, 'fujhi@gmail.com', '2024-01-03 09:04:00', '2024-01-03 17:30:00', 0, 4, '2024-01-03 11:05:01', '2024-01-03 11:06:02', NULL),
(24, 'fujhi@gmail.com', '2024-01-04 09:11:53', '2024-01-04 17:51:44', 9, 0, '2024-01-04 11:38:58', '2024-01-04 11:40:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `email` varchar(40) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `realpassword` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`email`, `nama`, `realpassword`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
('aldry@gmail.com', 'Aldry Hidayat', 'test123', '$2y$12$9lefz1TjVTjmX8bItymwrO2oVsyttJI7ohrsTs9V8liajIdkrVhI.', '2024-01-15 19:16:14', '2024-01-16 18:16:14', NULL),
('fitri23@gmail.com', 'Fitri Wicaksena', 'test123', '$2y$12$nA.TUuKsWRvGYytq7xFcr.01mKYX7lFh5JMX/Pn3ot0BsSCm5MB1W', '2024-01-15 19:16:14', '2024-01-16 18:20:17', NULL),
('fujhi@gmail.com', 'Fujhi Meykhi Suryadi', 'test123', '$2y$12$VgOb/H4t/ejR4ZYE5sI4T.3iQypMLknmv1JRrPw2Ww4jbu7/sEeLS', '2024-01-15 19:16:14', '2024-01-16 18:20:22', NULL),
('keefe45@gmail.com', 'Keefe Kynan', 'test123', '$2y$12$KEqJvLNmtrFEbKTnCDlyhuINCtInbIUOHz86iPi1qydxy39fnNg9W', '2024-01-15 19:16:14', '2024-01-16 18:20:25', NULL),
('testing@gmail.com', 'testing', 'test123', '$2y$12$T2QycUP.eA9eIxYU1FeDLug2c.4yXmWPILPbqDjsaDBw8htIwJNMm', '2024-01-16 17:20:12', '2024-01-16 17:20:20', '2024-01-16 17:20:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
