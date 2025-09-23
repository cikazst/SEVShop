-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sevshop_db
CREATE DATABASE IF NOT EXISTS `sevshop_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sevshop_db`;

-- Dumping structure for table sevshop_db.artis
CREATE TABLE IF NOT EXISTS `artis` (
  `id_artis` int NOT NULL AUTO_INCREMENT,
  `nama_artis` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_artis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sevshop_db.artis: ~0 rows (approximately)

-- Dumping structure for table sevshop_db.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sevshop_db.kategori: ~0 rows (approximately)

-- Dumping structure for table sevshop_db.komentar
CREATE TABLE IF NOT EXISTS `komentar` (
  `id_komentar` int NOT NULL AUTO_INCREMENT,
  `rating` int DEFAULT NULL,
  `komentar` longtext,
  `id_user` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  PRIMARY KEY (`id_komentar`),
  KEY `user` (`id_user`),
  KEY `produk` (`id_produk`),
  CONSTRAINT `produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sevshop_db.komentar: ~0 rows (approximately)

-- Dumping structure for table sevshop_db.penerbit
CREATE TABLE IF NOT EXISTS `penerbit` (
  `id_penerbit` int NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sevshop_db.penerbit: ~0 rows (approximately)

-- Dumping structure for table sevshop_db.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) DEFAULT NULL,
  `id_artis` int DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `detail` mediumtext,
  `gambar_produk` int DEFAULT NULL,
  `thn_terbit` int DEFAULT NULL,
  `id_kategori` int DEFAULT NULL,
  `id_penerbit` int DEFAULT NULL,
  `id_komentar` int DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `artis` (`id_artis`),
  KEY `kategori` (`id_kategori`),
  KEY `penerbit` (`id_penerbit`),
  KEY `komentar` (`id_komentar`),
  CONSTRAINT `artis` FOREIGN KEY (`id_artis`) REFERENCES `artis` (`id_artis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `komentar` FOREIGN KEY (`id_komentar`) REFERENCES `komentar` (`id_komentar`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penerbit` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sevshop_db.produk: ~0 rows (approximately)

-- Dumping structure for table sevshop_db.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `total_harga` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `tgl_transaksi` int NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sevshop_db.transaksi: ~0 rows (approximately)

-- Dumping structure for table sevshop_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(50) DEFAULT NULL,
  `email_user` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_hp` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sevshop_db.user: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
