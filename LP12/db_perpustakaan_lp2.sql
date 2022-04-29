/*
 Navicat Premium Data Transfer

 Source Server         : mykoneksi
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : db_perpustakaan_lp2

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 29/04/2022 16:05:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for author
-- ----------------------------
DROP TABLE IF EXISTS `author`;
CREATE TABLE `author`  (
  `id_author` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_author`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of author
-- ----------------------------
INSERT INTO `author` VALUES (1, 'Richard Adkins', 'Senior');
INSERT INTO `author` VALUES (2, 'Pein Akatsuki', 'Senior');
INSERT INTO `author` VALUES (4, 'Ken Northwood', 'Senior');
INSERT INTO `author` VALUES (5, 'ad', 'Senior');

-- ----------------------------
-- Table structure for buku
-- ----------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku`  (
  `id_buku` int NOT NULL AUTO_INCREMENT,
  `judul_buku` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `penerbit` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_author` int NOT NULL,
  PRIMARY KEY (`id_buku`) USING BTREE,
  INDEX `id_author`(`id_author` ASC) USING BTREE,
  CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buku
-- ----------------------------
INSERT INTO `buku` VALUES (1, 'Alan Wade', 'Premium #', 'Cerita dibalik cerita', 'Best Seller', 2);
INSERT INTO `buku` VALUES (2, 'Awan', 'Akamedia', 'buku tentang cerita awan, hujan, langit', 'Best Seller', 1);
INSERT INTO `buku` VALUES (4, 'Puisi Patrick Star', 'Patrick', 'mawar itu biru, violet itu merah', 'Best Seller', 2);

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `nim` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jurusan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`nim`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('20000', 'Uzumaki Nartanto', 'Teknik Ninja');
INSERT INTO `member` VALUES ('20004333', 'Julius', 'Psikolog');
INSERT INTO `member` VALUES ('2004305', 'Luffy Hidayat', 'Teknik Melaut');

-- ----------------------------
-- Table structure for peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman`  (
  `kode_peminjaman` int NOT NULL AUTO_INCREMENT,
  `Buku` int NOT NULL,
  `Member` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Status_Pengembalian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`kode_peminjaman`) USING BTREE,
  INDEX `Buku`(`Buku` ASC) USING BTREE,
  INDEX `Member`(`Member` ASC) USING BTREE,
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`Buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`Member`) REFERENCES `member` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 104 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of peminjaman
-- ----------------------------
INSERT INTO `peminjaman` VALUES (100, 2, '20000', 'Sudah');
INSERT INTO `peminjaman` VALUES (101, 4, '20000', 'Sudah');
INSERT INTO `peminjaman` VALUES (102, 1, '20000', 'Belum');
INSERT INTO `peminjaman` VALUES (103, 4, '2004305', 'Belum');

SET FOREIGN_KEY_CHECKS = 1;
