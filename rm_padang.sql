-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2024 at 08:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rm_padang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'bungaacc@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail_pesanan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_pesanan`, `id_menu`, `jumlah`) VALUES
(2, 14, 10, 2),
(3, 14, 11, 3),
(4, 16, 22, 6),
(5, 16, 11, 3),
(6, 16, 16, 4),
(7, 17, 11, 5),
(8, 17, 10, 3),
(9, 17, 18, 8),
(14, 22, 11, 2),
(15, 23, 16, 8);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_menu`, `jumlah`) VALUES
(63, 22, 22, 4);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `harga_menu` decimal(15,2) NOT NULL,
  `jenis_menu` enum('Makanan','Minuman','Cemilan') NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga_menu`, `jenis_menu`, `stok`, `gambar`) VALUES
(10, 'Lele Goreng', 6000.00, 'Makanan', 1, '674ba61d1cb5d3.92032723.webp'),
(11, 'Air Putih', 2000.00, 'Minuman', 56, '674bbc8725e5d5.62538867.webp'),
(16, 'Tongkol Balado', 6000.00, 'Makanan', 72, '674bec8ac7cf96.12825580.webp'),
(18, 'Teh Manis Panas', 3000.00, 'Minuman', 82, '674bec383b7bb6.84911219.webp'),
(19, 'Dencis Balado', 6000.00, 'Makanan', 90, '674c6172ad8184.45181650.webp'),
(20, 'Ayam Rendang', 6000.00, 'Makanan', 90, '674fc7d55d1857.80477942.webp'),
(21, 'Jus Buah', 6000.00, 'Minuman', 90, '674fc86b3b1086.83105466.webp'),
(22, 'Nasi Putih', 4000.00, 'Makanan', 82, '674fc8bce94da3.59914376.webp'),
(23, 'Sayur Kol', 1000.00, 'Makanan', 90, '674fc93cb643c9.90274011.webp'),
(24, 'Sambal Ijo', 1000.00, 'Makanan', 90, '674fc9f361acf9.31028181.webp'),
(25, 'Ayam Goreng', 6000.00, 'Makanan', 90, '674fcb327bc9b2.00909678.webp'),
(26, 'Ayam Bakar', 6000.00, 'Makanan', 90, '6750041acb08f2.82766697.jpg'),
(27, 'Gulai Ayam', 6000.00, 'Makanan', 90, '675a6b1bcf3439.62892372.webp');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_menu` int(11) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `tanggal_pesanan` date NOT NULL,
  `status_pesanan` enum('Diproses','Selesai') NOT NULL DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `jumlah_menu`, `total_harga`, `tanggal_pesanan`, `status_pesanan`) VALUES
(14, 17, 5, 18000.00, '2024-12-11', 'Diproses'),
(16, 17, 13, 54000.00, '2024-12-11', 'Selesai'),
(17, 17, 16, 52000.00, '2024-12-11', 'Selesai'),
(22, 22, 2, 4000.00, '2024-12-11', 'Selesai'),
(23, 22, 8, 48000.00, '2024-12-11', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `no_hp`, `password`) VALUES
(17, 'bunga', '085172460410', '123'),
(22, 'polmed', '083802598364', 'polmed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
