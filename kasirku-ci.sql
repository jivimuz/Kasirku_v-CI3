-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk kasirku-ci
CREATE DATABASE IF NOT EXISTS `kasirku-ci` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kasirku-ci`;

-- membuang struktur untuk table kasirku-ci.tbl_cart
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `id_cart` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL DEFAULT '0',
  `id_transaksi` int NOT NULL DEFAULT '0',
  `qty` int DEFAULT '1',
  PRIMARY KEY (`id_cart`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Membuang data untuk tabel kasirku-ci.tbl_cart: ~1 rows (lebih kurang)
INSERT INTO `tbl_cart` (`id_cart`, `id_product`, `id_transaksi`, `qty`) VALUES
	(6, 17, 1, 1),
	(7, 1, 1, 1),
	(9, 17, 2, 1);

-- membuang struktur untuk table kasirku-ci.tbl_jenis_product
CREATE TABLE IF NOT EXISTS `tbl_jenis_product` (
  `id_jenis_product` int NOT NULL AUTO_INCREMENT,
  `nama_jenis_product` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_jenis_product`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Membuang data untuk tabel kasirku-ci.tbl_jenis_product: ~2 rows (lebih kurang)
INSERT INTO `tbl_jenis_product` (`id_jenis_product`, `nama_jenis_product`) VALUES
	(1, 'Baju'),
	(9, 'Celana');

-- membuang struktur untuk table kasirku-ci.tbl_pegawai
CREATE TABLE IF NOT EXISTS `tbl_pegawai` (
  `id_pegawai` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `nama_pegawai` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `no_hp` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT '-',
  `is_admin` int DEFAULT '0',
  PRIMARY KEY (`id_pegawai`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Membuang data untuk tabel kasirku-ci.tbl_pegawai: ~2 rows (lebih kurang)
INSERT INTO `tbl_pegawai` (`id_pegawai`, `username`, `password`, `nama_pegawai`, `email`, `no_hp`, `is_admin`) VALUES
	(1, 'ADMIN', '$2y$10$SmKwORiSxdj1Rd67okqkG.Or/cARn9NfBzZqe9Z8eHYjzITq2VXei', 'Jivi MG', 'jmv@gmail.com', '131232', 1),
	(9, 'JIVI', '$2y$10$/XnbDq/8hwVaPTDaKkHU1eYsKttmhZPSKEBKZYkhoVQAJ0lcQU35a', 'Jivi Muzaqi Guntur', 'asdasd@gmail.com', '082120741970', 0);

-- membuang struktur untuk table kasirku-ci.tbl_product
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `id_jenis_product` int DEFAULT '0',
  `nama_product` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL DEFAULT '0',
  `stok` int NOT NULL DEFAULT '0',
  `harga_beli` int DEFAULT '0',
  `harga_jual` int NOT NULL DEFAULT '0',
  `foto` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`id_product`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Membuang data untuk tabel kasirku-ci.tbl_product: ~1 rows (lebih kurang)
INSERT INTO `tbl_product` (`id_product`, `id_jenis_product`, `nama_product`, `stok`, `harga_beli`, `harga_jual`, `foto`) VALUES
	(1, 1, 'Kaos Oblong', 22, 20000, 30000, 'baju-1.jpg'),
	(17, 9, 'Celana Bagus', 18, 20000, 30000, '1683169589_dokter.png');

-- membuang struktur untuk table kasirku-ci.tbl_transaksi
CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_pegawai` int NOT NULL,
  `total_tunai` int DEFAULT '0',
  `total_harga` int DEFAULT '0',
  `total_kembali` int DEFAULT '0',
  `is_paid` int DEFAULT '0',
  `created_at` datetime NOT NULL,
  `paid_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Membuang data untuk tabel kasirku-ci.tbl_transaksi: ~1 rows (lebih kurang)
INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_pegawai`, `total_tunai`, `total_harga`, `total_kembali`, `is_paid`, `created_at`, `paid_at`) VALUES
	(1, 1, 70000, 60000, 10000, 1, '2023-05-04 01:32:26', '2023-05-04 05:13:51'),
	(2, 1, 30000, 30000, 0, 1, '2023-05-04 05:14:40', '2023-05-04 06:16:48'),
	(3, 1, 0, 0, 0, 0, '2023-05-04 06:18:54', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
