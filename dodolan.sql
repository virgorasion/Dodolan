-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2020 at 10:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dodolan`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SyncPembelian` (IN `id_barang` INT(5), IN `kode_user` VARCHAR(12), IN `tanggal` DATE, IN `jumlah_barang` INT(5), IN `harga_beli` INT(11), OUT `jumlah_barang_lama` INT(5))  BEGIN
#Get Jumlah Barang Lama
select daftar_barang.jumlah 
INTO jumlah_barang_lama
FROM daftar_barang
WHERE daftar_barang.id = id_barang
AND daftar_barang.kode_user = kode_user;

#Update Daftar Barang
UPDATE daftar_barang 
SET daftar_barang.jumlah = jumlah_barang + jumlah_barang_lama,
daftar_barang.tanggal_restock = tanggal,
daftar_barang.harga_beli = harga_beli
WHERE daftar_barang.id = id_barang
AND daftar_barang.kode_user = kode_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SyncPenjualan` (OUT `jumlah_barang` INT(5), OUT `jumlah_terjual` INT(5), IN `id_barang` INT(5), IN `kode_user` VARCHAR(12), IN `jumlah_jual` INT(5))  NO SQL
BEGIN
#Get Jumlah Barang Lama
SELECT daftar_barang.jumlah, daftar_barang.jumlah_terjual 
INTO jumlah_barang, jumlah_terjual
FROM daftar_barang
WHERE daftar_barang.id = id_barang
AND daftar_barang.kode_user = kode_user;

#Update Daftar Barang
UPDATE daftar_barang 
SET daftar_barang.jumlah = jumlah_barang - jumlah_jual,
daftar_barang.jumlah_terjual = jumlah_terjual + jumlah_jual
WHERE daftar_barang.id = id_barang
AND daftar_barang.kode_user = kode_user;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_barang`
--

CREATE TABLE `daftar_barang` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(12) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kode_satuan` int(1) NOT NULL,
  `tanggal_restock` date NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL DEFAULT 0,
  `jumlah_terjual` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_barang`
--

INSERT INTO `daftar_barang` (`id`, `kode_user`, `nama_barang`, `jumlah`, `kode_satuan`, `tanggal_restock`, `harga_beli`, `harga_jual`, `jumlah_terjual`) VALUES
(18, 'USER3108001', 'Autan', 8, 7, '2020-05-18', 3500, 18364, 16),
(19, 'USER3108001', 'Rokok Samsu', 9, 3, '2020-05-15', 4689, 16533, 14),
(20, 'USER3108001', 'Beras', 19, 9, '2020-05-15', 4726, 14850, 55),
(21, 'USER3108001', 'Gula', 19, 12, '2020-05-15', 3130, 18293, 27),
(22, 'USER3108001', 'telur', 2, 3, '2020-05-15', 9550, 14350, 35),
(23, 'USER3108001', 'gula merah', 16, 1, '2020-05-15', 5406, 17071, 48),
(24, 'USER3108001', 'kerupuk', 8, 3, '2020-05-15', 3740, 14981, 38),
(25, 'USER3108001', 'heirs', 10, 12, '2020-05-15', 1087, 14545, 46),
(26, 'USER3108001', 'kopi kapal api kecil', 12, 2, '2020-05-15', 5434, 11753, 71),
(27, 'USER3108001', 'goodday freast', 4, 6, '2020-05-15', 2269, 18939, 79),
(28, 'USER3108001', 'indomie goreng', 20, 6, '2020-05-15', 3118, 11418, 100),
(29, 'USER3108001', 'indomie soto', 9, 4, '2020-05-15', 3889, 18695, 71),
(30, 'USER3108001', 'sedap goreng', 18, 7, '2020-05-15', 2624, 16206, 69),
(31, 'USER3108001', 'sedap soto', 8, 7, '2020-05-15', 2903, 12661, 12),
(32, 'USER3108001', 'sedap kari sepsial', 2, 1, '2020-05-15', 8594, 15530, 78),
(34, 'USER3108001', 'Gedang', 4, 2, '2020-05-18', 5000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_satuan`
--

CREATE TABLE `daftar_satuan` (
  `kode_satuan` int(11) NOT NULL,
  `kode_user` varchar(12) NOT NULL,
  `nama_satuan` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar_satuan`
--

INSERT INTO `daftar_satuan` (`kode_satuan`, `kode_user`, `nama_satuan`, `status`) VALUES
(1, 'USER3108001', 'Sachet', 1),
(2, 'USER3108001', 'Kg', 1),
(3, 'USER3108001', 'G', 1),
(4, 'USER3108001', 'Mg', 1),
(5, 'USER3108001', 'Liter', 1),
(6, 'USER3108001', 'Bungkus', 1),
(7, 'USER3108001', 'Biji', 1),
(8, 'USER3108001', 'Renceng', 1),
(9, 'USER3108001', 'Lusin', 1),
(10, 'USER3108001', 'Gros', 1),
(11, 'USER3108001', 'Kodi', 1),
(12, 'USER3108001', 'Rim', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi_pembelian`
--

CREATE TABLE `detail_transaksi_pembelian` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(12) NOT NULL,
  `kode_transaksi` varchar(12) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `kode_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi_pembelian`
--

INSERT INTO `detail_transaksi_pembelian` (`id`, `kode_user`, `kode_transaksi`, `id_barang`, `harga_beli`, `jumlah_barang`, `subtotal`, `kode_satuan`) VALUES
(28, 'USER3108001', 'TRXBELI9995', 18, 3500, 5, 17500, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi_penjualan`
--

CREATE TABLE `detail_transaksi_penjualan` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(12) NOT NULL,
  `kode_transaksi` varchar(12) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `kode_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembelian`
--

CREATE TABLE `transaksi_pembelian` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(12) NOT NULL,
  `kode_transaksi` varchar(12) NOT NULL,
  `tanggal` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `tempat_pembelian` varchar(30) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `total_kurang` int(11) NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_pembelian`
--

INSERT INTO `transaksi_pembelian` (`id`, `kode_user`, `kode_transaksi`, `tanggal`, `total_pembelian`, `tempat_pembelian`, `total_bayar`, `total_kurang`, `catatan`, `log_time`) VALUES
(35, 'USER3108001', 'TRXBELI9995', '2020-05-18', 17500, '', 17500, 0, 'kosong', '2020-05-17 19:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(12) NOT NULL,
  `kode_transaksi` varchar(12) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `total_kurang` int(11) NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`id`, `kode_user`, `kode_transaksi`, `tanggal`, `total_harga`, `total_bayar`, `total_kurang`, `catatan`, `log_time`) VALUES
(1, 'USER3108001', 'TRXJUAL1234', '2020-05-18', 40000, 40000, 0, 'kosong', '2020-05-17 19:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `kode_user` varchar(12) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `username` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `tanggal_pembuatan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modal` int(11) DEFAULT 0,
  `token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `kode_user`, `nama`, `username`, `email`, `password`, `tanggal_pembuatan`, `modal`, `token`) VALUES
(3, 'USER3108001', 'M Nur Fauzan W', 'virgorasion', 'fauzan.widyanto@gmail.com', '$2y$10$ehYppZK8bEFIqVQUazlLveTa/f7ioso/LyxY7M7K4UlEgvz0RQuwq', '2020-05-17 19:36:44', 5000000, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`),
  ADD KEY `kode_satuan` (`kode_satuan`),
  ADD KEY `kode_user` (`kode_user`);

--
-- Indexes for table `daftar_satuan`
--
ALTER TABLE `daftar_satuan`
  ADD PRIMARY KEY (`kode_satuan`),
  ADD KEY `kode_user` (`kode_user`);

--
-- Indexes for table `detail_transaksi_pembelian`
--
ALTER TABLE `detail_transaksi_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `kode_user` (`kode_user`);

--
-- Indexes for table `detail_transaksi_penjualan`
--
ALTER TABLE `detail_transaksi_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `kode_user` (`kode_user`);

--
-- Indexes for table `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `kode_user` (`kode_user`);

--
-- Indexes for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `kode_user` (`kode_user`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `kode_user` (`kode_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `daftar_satuan`
--
ALTER TABLE `daftar_satuan`
  MODIFY `kode_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_transaksi_pembelian`
--
ALTER TABLE `detail_transaksi_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `detail_transaksi_penjualan`
--
ALTER TABLE `detail_transaksi_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_barang`
--
ALTER TABLE `daftar_barang`
  ADD CONSTRAINT `daftar_barang_ibfk_1` FOREIGN KEY (`kode_satuan`) REFERENCES `daftar_satuan` (`kode_satuan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_barang_ibfk_2` FOREIGN KEY (`kode_user`) REFERENCES `user_login` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `daftar_satuan`
--
ALTER TABLE `daftar_satuan`
  ADD CONSTRAINT `daftar_satuan_ibfk_1` FOREIGN KEY (`kode_user`) REFERENCES `user_login` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi_pembelian`
--
ALTER TABLE `detail_transaksi_pembelian`
  ADD CONSTRAINT `detail_transaksi_pembelian_ibfk_1` FOREIGN KEY (`kode_transaksi`) REFERENCES `transaksi_pembelian` (`kode_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_pembelian_ibfk_2` FOREIGN KEY (`kode_user`) REFERENCES `user_login` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_pembelian_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `daftar_barang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi_penjualan`
--
ALTER TABLE `detail_transaksi_penjualan`
  ADD CONSTRAINT `detail_transaksi_penjualan_ibfk_1` FOREIGN KEY (`kode_transaksi`) REFERENCES `transaksi_penjualan` (`kode_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_penjualan_ibfk_2` FOREIGN KEY (`kode_user`) REFERENCES `user_login` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_penjualan_ibfk_3` FOREIGN KEY (`id_barang`) REFERENCES `daftar_barang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_pembelian`
--
ALTER TABLE `transaksi_pembelian`
  ADD CONSTRAINT `transaksi_pembelian_ibfk_1` FOREIGN KEY (`kode_user`) REFERENCES `user_login` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD CONSTRAINT `transaksi_penjualan_ibfk_1` FOREIGN KEY (`kode_user`) REFERENCES `user_login` (`kode_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
