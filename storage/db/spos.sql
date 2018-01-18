-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2018 at 08:17 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spos`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_stok_barang`(IN `kode_barang_param` INT(10), IN `jumlah_transaksi_detil_param` SMALLINT)
    NO SQL
BEGIN  
    DECLARE eof INT DEFAULT FALSE;

    DECLARE kode INT(10);
    DECLARE jumlah SMALLINT;
    
    DECLARE BRG CURSOR FOR
        SELECT kode_barang, jumlah_transaksi_detil 
        FROM transaksi_detil
        WHERE kode_barang=kode_barang_param;    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET eof=TRUE;
    
    OPEN BRG;
    
    BRG_LOOP: LOOP
        FETCH BRG INTO kode, jumlah;
        
        IF (eof) THEN
            LEAVE BRG_LOOP;
        END IF;
        
        UPDATE barang
        SET stok_barang=
        (stok_barang - (jumlah_transaksi_detil_param * jumlah))
        WHERE kode_barang=kode;
        
    END LOOP;    
    
    CLOSE BRG;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_total_biaya`(IN `kode_transaksi_param` INT(10) UNSIGNED)
    NO SQL
UPDATE transaksi
SET total_biaya_transaksi=
	(SELECT SUM(transaksi_detil.jumlah_transaksi_detil * barang.harga_barang)
    FROM transaksi_detil, barang 
    WHERE transaksi_detil.kode_barang=barang.kode_barang 
    AND transaksi_detil.kode_transaksi=kode_transaksi_param)
WHERE kode_transaksi=kode_transaksi_param$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
`kode_barang` int(10) unsigned NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `harga_barang` int(10) unsigned NOT NULL,
  `stok_barang` int(10) unsigned NOT NULL,
  `deskripsi_barang` text COLLATE utf8_unicode_ci NOT NULL,
  `gambar_barang` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `harga_barang`, `stok_barang`, `deskripsi_barang`, `gambar_barang`) VALUES
(1, 'Sepatu Biker Oranye', 40000, 43, 'Sepatu all bike adalah salah satu produk yang dikhususkan untuk para bikers sejati. Dengan style yang keren dan model terbaru nyaman dipakai untuk bersepeda dan maupun santai. Terbuat dari bahan polymer dan anti air. Dilbagian sisinya dilengkapi ventilasi udara untuk menjaga kelembapan kaki saat dipakai.', '69a76c5bde0d0f95d6400f44338127d5.jpg'),
(3, 'Sepatu Pantofel Premium Hitam', 278000, 47, 'Absolute Black sangat populer karena menjadi sepatu pantofel yang paling banyak diminati oleh customers. Berbahan dasar kalep dengan sol campuran karet dan sintetis. Selain itu sepatu ini sangat ringat untuk dipakai. Dengan model yang simple dan elegant membuat harimu semakin percaya diri.', '67f1eba8eeaee94cee0d32abf0268b23.png'),
(7, 'Sepatu Bata', 125000, 47, 'Sepatu BataSepatu BataSepatu BataSepatu BataSepatu BataSepatu BataSepatu Bata', 'b9e5b6bb49a1c70747739c4aabd01941.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `otoritas`
--

CREATE TABLE IF NOT EXISTS `otoritas` (
  `kode_otoritas` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nama_otoritas` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `otoritas`
--

INSERT INTO `otoritas` (`kode_otoritas`, `nama_otoritas`) VALUES
('cashier', 'Kasir'),
('keeper', 'Penjaga Toko'),
('root', 'Administrator'),
('supervisor', 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `kode_pegawai` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `kata_sandi_pegawai` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nama_pegawai` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `gambar_pegawai` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `kode_otoritas` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`kode_pegawai`, `kata_sandi_pegawai`, `nama_pegawai`, `gambar_pegawai`, `kode_otoritas`) VALUES
('conan', '$2y$10$LuzQRHEEOF3htQonJdhdo.WM9knedYj.8p4l5dYo.hki47VDSw0X2', 'Edogawa Conan', 'c4ac205f96bb5684f4c89fd232eeffe4.png', 'root'),
('genta', '$2y$10$v6i601q65WZf38rg8OwWp.O0aSH8wEjTg7WGKKFdG03PV560CCJLm', 'Genta Kojima', 'a469e1f6d17e14c64e1a65bd97b608ff.jpg', 'keeper'),
('haibara', '$2y$10$IqmCTJ2/lx5vKf6bmKvXTuSD5dcczZN28g/0qZOZ2BzWdE0XC/BDW', 'Haibara Ai', 'ef4da66c0f89eaf51b9714471f2286b2.jpg', 'supervisor'),
('mitsuhiko', '$2y$10$myshpn.r1Rs1EVl/LzXQZe9tNgiyPXsQUuvBsPysf.yZFAwV9yoSi', 'Mitsuhiko Tsuburaya', '78ef10272f60fefd9991f247d83eb942.jpg', 'cashier'),
('toor', '$2y$10$vZL7k48cANSMuhsoaFK.VOBH7Lwe.VnPNhLv0h69jkzYJ8sBUagUO', 'Raka Suryaardi Widjaja', '5ae6f0ad3bf564dd2ad1466162d67779.png', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
`kode_transaksi` int(10) unsigned NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_biaya_transaksi` int(10) unsigned NOT NULL DEFAULT '0',
  `total_bayar_transaksi` int(10) unsigned NOT NULL DEFAULT '0',
  `keterangan_transaksi` text COLLATE utf8_unicode_ci NOT NULL,
  `nama_pembeli` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nomor_telepon` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `kode_pegawai` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `tanggal_transaksi`, `total_biaya_transaksi`, `total_bayar_transaksi`, `keterangan_transaksi`, `nama_pembeli`, `nomor_telepon`, `kode_pegawai`) VALUES
(24, '2018-01-15 13:11:54', 165000, 200000, 'Garansi retur barang 1 minggu.', 'Raka Suryaardi Widjaja', '087825720207', 'conan'),
(25, '2018-01-15 22:34:39', 278000, 300000, '', '', '', 'conan'),
(26, '2018-01-16 18:31:07', 205000, 210000, '', '', '', 'conan'),
(27, '2018-01-18 19:01:06', 278000, 290000, '', '', '', 'toor');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detil`
--

CREATE TABLE IF NOT EXISTS `transaksi_detil` (
`kode_transaksi_detil` int(10) unsigned NOT NULL,
  `jumlah_transaksi_detil` smallint(5) unsigned NOT NULL,
  `kode_barang` int(10) unsigned NOT NULL,
  `kode_transaksi` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaksi_detil`
--

INSERT INTO `transaksi_detil` (`kode_transaksi_detil`, `jumlah_transaksi_detil`, `kode_barang`, `kode_transaksi`) VALUES
(17, 1, 1, 24),
(18, 1, 7, 24),
(19, 1, 3, 25),
(20, 1, 7, 26),
(21, 2, 1, 26),
(22, 1, 3, 27);

--
-- Triggers `transaksi_detil`
--
DELIMITER //
CREATE TRIGGER `TRANSAKSI_DETIL_AFTER_INSERT` AFTER INSERT ON `transaksi_detil`
 FOR EACH ROW BEGIN
    CALL update_total_biaya(new.kode_transaksi);
	CALL update_stok_barang(new.kode_barang, new.jumlah_transaksi_detil);
END
//
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `otoritas`
--
ALTER TABLE `otoritas`
 ADD PRIMARY KEY (`kode_otoritas`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
 ADD PRIMARY KEY (`kode_pegawai`), ADD UNIQUE KEY `user_name` (`kode_pegawai`), ADD KEY `user_auth` (`kode_otoritas`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
 ADD PRIMARY KEY (`kode_transaksi`), ADD KEY `kode_pegawai` (`kode_pegawai`);

--
-- Indexes for table `transaksi_detil`
--
ALTER TABLE `transaksi_detil`
 ADD PRIMARY KEY (`kode_transaksi_detil`), ADD KEY `kode_barang` (`kode_barang`,`kode_transaksi`), ADD KEY `kode_transaksi` (`kode_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
MODIFY `kode_barang` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
MODIFY `kode_transaksi` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `transaksi_detil`
--
ALTER TABLE `transaksi_detil`
MODIFY `kode_transaksi_detil` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`kode_otoritas`) REFERENCES `otoritas` (`kode_otoritas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`kode_pegawai`) REFERENCES `pegawai` (`kode_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_detil`
--
ALTER TABLE `transaksi_detil`
ADD CONSTRAINT `transaksi_detil_ibfk_1` FOREIGN KEY (`kode_transaksi`) REFERENCES `transaksi` (`kode_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `transaksi_detil_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
