/*
 Navicat Premium Data Transfer

 Source Server         : xampp
 Source Server Type    : MySQL
 Source Server Version : 100424 (10.4.24-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : gojasa

 Target Server Type    : MySQL
 Target Server Version : 100424 (10.4.24-MariaDB)
 File Encoding         : 65001

 Date: 01/10/2022 20:33:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'staff',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'Admin', '7e957d9933fff5a06e8b37d6e57a682bc121da9a', 'admin@gmail.com', '77b619ae2fb6b646d872c43dc8bca32c.png', 'admin');
INSERT INTO `admin` VALUES (3, 'Staff', '7e957d9933fff5a06e8b37d6e57a682bc121da9a', 'staff@gojasa.com', '77b619ae2fb6b646d872c43dc8bca32c.jpg', 'staff');

-- ----------------------------
-- Table structure for app_settings
-- ----------------------------
DROP TABLE IF EXISTS `app_settings`;
CREATE TABLE `app_settings`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `app_email` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `app_contact` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `app_website` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `app_description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `app_privacy_policy` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `app_aboutus` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_subject` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_subject_confirm` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_text1` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_text2` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_text3` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_text4` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `app_logo` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smtp_host` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smtp_port` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smtp_username` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smtp_password` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smtp_from` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `smtp_secure` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `app_name` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `app_address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `app_linkgoogle` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `app_currency` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `app_currency_text` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `map_key` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fcm_key` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `duitku_merchant` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `duitku_key` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `duitku_mode` int NULL DEFAULT 0,
  `duitku_status` int NULL DEFAULT 1,
  `maintenance` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `isotp` int NOT NULL,
  `jasaapp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `background` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '#4c84ff',
  `whatsappserver` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `whatsappapi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `whatsappnumber` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of app_settings
-- ----------------------------
INSERT INTO `app_settings` VALUES (1, 'cs@gojasa.com', '62812345678900', 'http://192.168.1.100', 'Gojasa', '<div>Lorem <strong>Ipsum</strong>  hanyalah teks tiruan dari industri percetakan dan penyusunan huruf. Lorem Ipsum telah menjadi teks dummy standar industri sejak tahun 1500-an, ketika seorang pencetak yang tidak dikenal mengambil kumpulan tipe dan mengacaknya untuk membuat buku spesimen tipe. Ini telah bertahan tidak hanya lima abad, tetapi juga lompatan ke pengaturan huruf elektronik, pada dasarnya tetap tidak berubah. Itu dipopulerkan pada 1960-an dengan merilis lembar Letraset yang berisi bagian-bagian Lorem Ipsum, dan baru-baru ini dengan perangkat lunak penerbitan desktop seperti Aldus PageMaker termasuk versi Lorem Ipsum</div>', '<div><strong>Lorem Ipsum</strong>  hanyalah teks tiruan dari industri percetakan dan penyusunan huruf. Lorem Ipsum telah menjadi teks dummy standar industri sejak tahun 1500-an, ketika seorang pencetak yang tidak dikenal mengambil kumpulan tipe dan mengacaknya untuk membuat buku spesimen tipe. Ini telah bertahan tidak hanya lima abad, tetapi juga lompatan ke pengaturan huruf elektronik, pada dasarnya tetap tidak berubah. Itu dipopulerkan pada 1960-an dengan merilis lembar Letraset yang berisi bagian-bagian Lorem Ipsum, dan baru-baru ini dengan perangkat lunak penerbitan desktop seperti Aldus PageMaker termasuk versi Lorem Ipsum</div>', 'Reset Password', 'Registration accepted', '<div style=\"text-align: justify;\"><span style=\"font-size: 0.875rem; font-weight: initial;\">We have received your request to reset the password. Please confirm via the button below:</span></div>', '<div style=\"text-align: justify;\"><span style=\"font-size: 0.875rem; font-weight: initial;\">Ignore this email if you never asked to reset your password. For questions, please contact </span></div>', '<div style=\"text-align: justify;\"><span style=\"font-size: 0.875rem; font-weight: initial;\">Thank you for registering a driver, we have accepted, please click the button below to reset your password:</span></div>', '<span style=\"text-align: justify;\">Ignore this email if you never asked to reset your password. For questions, please contact </span>', 'lol.jpg', 'mail.gojasa.com', '465', 'mail.gojasa.com', 'Juwendi2019', 'Gojasa', 'ssl', 'Gojasa New', '<p><span style=\"font-size: 14px; text-align: justify;\"><span style=\"vertical-align: inherit;\"><span style=\"vertical-align: inherit;\">Lorem Ipsum hanyalah teks tiruan dari industri percetakan dan penyusunan huruf. </span><span style=\"vertical-align: inherit;\">Lorem Ipsum telah menjadi teks dummy standar industri sejak tahun 1500-an</span></span></span></p>', 'https://play.google.com/', 'Rp', 'USD', 'AIzaSyCmkVwCTlPT6Hsc5efIh2aT0uP6gQeu0QA', 'AAAAvpQ6IIg:APA91bGz1t32_fTgodro6OtlvAEigXTXj5Kiln2CzON0D20ldroHFaGyZ_zmdqv2GGiLBqW8QA1kP0igIvKIfl-N2v4zzpeMu5MEGfe3XgIEvjNlZEXWepc3kSZQq83H8SXZcIvuoOAu', 'D11772', 'cec834b089284009a0a941132d251f83', 0, 1, '0', 0, '2000', '#0068f0', 'https://whatsapp.gojasa.com/send-message', 'AN55GjTuuw7UoVTyb3LQd2Uuq2KppQ', '628991585001');

-- ----------------------------
-- Table structure for area
-- ----------------------------
DROP TABLE IF EXISTS `area`;
CREATE TABLE `area`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `kota` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `promo` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rate1` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rate2` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rate3` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 42 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of area
-- ----------------------------
INSERT INTO `area` VALUES (23, 'Berau', '0', '2', '3', '4', '1');
INSERT INTO `area` VALUES (24, 'surakarta', '0', '1', '2', '3', '1');
INSERT INTO `area` VALUES (25, 'Kabupaten Semarang', '0', '1', '2', '3', '1');
INSERT INTO `area` VALUES (26, 'karanganyar', '0', '1', '2', '3', '1');
INSERT INTO `area` VALUES (29, 'lhokseumawe', '1000', '1', '2', '3', '1');
INSERT INTO `area` VALUES (30, 'Semarang', '1000', '2', '3', '4', '1');
INSERT INTO `area` VALUES (31, 'Ungaran', '0', '2', '3', '4', '1');
INSERT INTO `area` VALUES (33, 'Kotasemarang', '1000', '1', '1', '1', '1');
INSERT INTO `area` VALUES (34, 'Ketapang', '0', '2', '3', '5', '1');
INSERT INTO `area` VALUES (36, 'Sulawesi', '10', '1', '2', '3', '1');
INSERT INTO `area` VALUES (37, 'Pekanbaru', '2', '3', '4', '5', '1');
INSERT INTO `area` VALUES (39, 'Karawang', '0', '0', '0', '0', '1');
INSERT INTO `area` VALUES (40, 'manado', '0', '1', '2', '3', '1');
INSERT INTO `area` VALUES (41, 'Indramayu', '10000', '1', '2', '3', '1');

-- ----------------------------
-- Table structure for berita
-- ----------------------------
DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita`  (
  `id_berita` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `foto_berita` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_berita` timestamp NULL DEFAULT current_timestamp,
  `status_berita` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_berita`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of berita
-- ----------------------------

-- ----------------------------
-- Table structure for berkas_driver
-- ----------------------------
DROP TABLE IF EXISTS `berkas_driver`;
CREATE TABLE `berkas_driver`  (
  `id_berkas` int NOT NULL AUTO_INCREMENT,
  `id_driver` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto_ktp` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto_sim` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_sim` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_berkas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of berkas_driver
-- ----------------------------

-- ----------------------------
-- Table structure for category_item
-- ----------------------------
DROP TABLE IF EXISTS `category_item`;
CREATE TABLE `category_item`  (
  `id_kategori_item` int NOT NULL AUTO_INCREMENT,
  `nama_kategori_item` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto_kategori_item` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_cat_item` timestamp NOT NULL DEFAULT current_timestamp,
  `all_category` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_kategori` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_kategori_item`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category_item
-- ----------------------------

-- ----------------------------
-- Table structure for category_merchant
-- ----------------------------
DROP TABLE IF EXISTS `category_merchant`;
CREATE TABLE `category_merchant`  (
  `id_kategori_merchant` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto_kategori` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_fitur` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_kategori` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_kategori_merchant`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category_merchant
-- ----------------------------

-- ----------------------------
-- Table structure for chat
-- ----------------------------
DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `idtrans` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idcust` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `iddriver` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pesan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `isread` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `fotochat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `jam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of chat
-- ----------------------------

-- ----------------------------
-- Table structure for config_driver
-- ----------------------------
DROP TABLE IF EXISTS `config_driver`;
CREATE TABLE `config_driver`  (
  `id_driver` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `latitude` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `longitude` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `bearing` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `uang_belanja` int NOT NULL DEFAULT 1,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `target` int NOT NULL DEFAULT 0,
  `isreset` int NOT NULL DEFAULT 0,
  `nextday` date NOT NULL,
  `status` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '4',
  PRIMARY KEY (`id_driver`) USING BTREE,
  INDEX `latitude`(`latitude`) USING BTREE,
  INDEX `longitude`(`longitude`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of config_driver
-- ----------------------------

-- ----------------------------
-- Table structure for config_user
-- ----------------------------
DROP TABLE IF EXISTS `config_user`;
CREATE TABLE `config_user`  (
  `id_user` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `latitude` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `longitude` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `bearing` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `update_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `latitude`(`latitude`) USING BTREE,
  INDEX `longitude`(`longitude`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of config_user
-- ----------------------------

-- ----------------------------
-- Table structure for digi_brand
-- ----------------------------
DROP TABLE IF EXISTS `digi_brand`;
CREATE TABLE `digi_brand`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Pulsa',
  `fee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ikon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `iszone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of digi_brand
-- ----------------------------
INSERT INTO `digi_brand` VALUES (2, '469198', 'Telkomsel', 'TELKOMSEL', 'Pulsa Telkomsels', 'Pulsa', '200', 'd390407cc2bee5a261674987ff0acc73.png', '0', '1');
INSERT INTO `digi_brand` VALUES (3, '706402', 'Telkomsel Internet', 'TELKOMSEL', 'Paket Internet Telkomsel', 'Data', '250', '645442f2e7227ad321055e615bb47868.png', '0', '1');
INSERT INTO `digi_brand` VALUES (4, '568008', 'XL', 'XL', 'Pulsa XL', 'Pulsa', '0', '7cc378d574e88b8cf3878f0695c86b41.png', '0', '1');
INSERT INTO `digi_brand` VALUES (5, '680281', 'Indosat', 'INDOSAT', 'Pulsa Indosat', 'Pulsa', '0', 'e4c2b1e857c7e520c004dc1caf6aea84.png', '0', '1');
INSERT INTO `digi_brand` VALUES (6, '279036', 'Axis', 'AXIS', 'Pulsa Axis', 'Pulsa', '0', 'e0c01403e492dc73f7040340d9dcd513.png', '0', '1');
INSERT INTO `digi_brand` VALUES (7, '668487', 'Axis Internet', 'AXIS', 'Paket Internet Axis', 'Data', '0', '78a52892273473b99934f9cf8d91bc01.png', '0', '1');
INSERT INTO `digi_brand` VALUES (8, '654956', 'Pln', 'PLN', 'Pln', 'Pln', '0', 'cb7e9fabc0b1ef7d2994f1d308cfe9d9.png', '0', '1');
INSERT INTO `digi_brand` VALUES (9, '336849', 'Tri', 'TRI', 'Pulsa Tri', 'Pulsa', '0', 'a77bf69d51226b4ea19ea6026f5984b4.png', '0', '1');
INSERT INTO `digi_brand` VALUES (10, '662150', 'Tri Internet', 'TRI', 'Paket Internet Tri', 'Data', '0', '097caabcbfda9b8e8c89c43d49b41e92.png', '0', '1');
INSERT INTO `digi_brand` VALUES (11, '630068', 'Mobile Legend', 'MOBILELEGEND', 'Topup Mobile Legend', 'Games', '200', '1af348be0ef1f40da0a4d92316838f35.png', '1', '1');

-- ----------------------------
-- Table structure for driver
-- ----------------------------
DROP TABLE IF EXISTS `driver`;
CREATE TABLE `driver`  (
  `id` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_driver` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_ktp` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_lahir` date NULL DEFAULT NULL,
  `tempat_lahir` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_telepon` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `countrycode` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rating` double NOT NULL DEFAULT 0,
  `job` int NOT NULL,
  `gender` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Male',
  `alamat_driver` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kendaraan` int NULL DEFAULT 1,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `update_at` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `reg_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1234',
  `status` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '2',
  `point` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `Kota` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Indramayu',
  `aktivitas` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Offline',
  `islogin` int NOT NULL DEFAULT 0,
  `uplink` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Admin',
  `pin` int NOT NULL DEFAULT 1234,
  `otp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `expire` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE,
  UNIQUE INDEX `no_telepon`(`no_telepon`) USING BTREE,
  UNIQUE INDEX `no_ktp`(`no_ktp`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of driver
-- ----------------------------

-- ----------------------------
-- Table structure for driver_job
-- ----------------------------
DROP TABLE IF EXISTS `driver_job`;
CREATE TABLE `driver_job`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `driver_job` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `icon` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `ismobil` int NOT NULL DEFAULT 0,
  `status_job` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of driver_job
-- ----------------------------
INSERT INTO `driver_job` VALUES (18, 'Mobil', '2', 0, '1');
INSERT INTO `driver_job` VALUES (17, 'Motor', '1', 0, '1');

-- ----------------------------
-- Table structure for fitur
-- ----------------------------
DROP TABLE IF EXISTS `fitur`;
CREATE TABLE `fitur`  (
  `id_fitur` int NOT NULL AUTO_INCREMENT,
  `fitur` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `biaya` int NOT NULL,
  `biaya_minimum` int NOT NULL,
  `jarak_minimum` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `maks_distance` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `wallet_minimum` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `komisi` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `promo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `keterangan_biaya` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `driver_job` int NOT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `icon` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `home` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jasaapp` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `background` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '#FDEBF5',
  `tint` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '#FDEBF5',
  `usedtint` int NOT NULL DEFAULT 0,
  `kota` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'all',
  `active` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_fitur`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fitur
-- ----------------------------
INSERT INTO `fitur` VALUES (1, 'Ride', 2500, 10000, '3', '10', '10000', '10', '10', 'KM', 17, 'Order Ride', '2346b30b95c8d0dfa5392c18d00caa02.png', '1', '0', '#dbffe6', '#e4e0ff', 0, 'all', '1');
INSERT INTO `fitur` VALUES (2, 'Car', 5000, 10000, '5', '20', '20000', '10', '10', 'KM', 18, 'Order Car', '1c506521b7aa5b9dd0a65276a6e83ef3.png', '1', '0', '#dbffe6', '#e4e0ff', 0, 'all', '1');
INSERT INTO `fitur` VALUES (3, 'Food', 2500, 5000, '3', '10', '10000', '10', '10', 'KM', 17, 'Order Food', '3605fd354341702598db18047ac59aaf.png', '4', '0', '#dbffe6', '#e4e0ff', 0, 'all', '1');
INSERT INTO `fitur` VALUES (4, 'Store', 5000, 20000, '3', '10', '20000', '10', '10', 'KM', 17, 'Order Store', '6355dae31773dfcde2493fc60b07d607.png', '4', '0', '#dbffe6', '#e4e0ff', 0, 'all', '1');

-- ----------------------------
-- Table structure for forgot_password
-- ----------------------------
DROP TABLE IF EXISTS `forgot_password`;
CREATE TABLE `forgot_password`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `idkey` int NOT NULL,
  `userid` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `token` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of forgot_password
-- ----------------------------

-- ----------------------------
-- Table structure for history_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `history_transaksi`;
CREATE TABLE `history_transaksi`  (
  `nomor` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `id_driver` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp,
  `status` int NOT NULL,
  `catatan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `proses` int NOT NULL DEFAULT 0,
  `gender` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`nomor`) USING BTREE,
  UNIQUE INDEX `nomor`(`nomor`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of history_transaksi
-- ----------------------------

-- ----------------------------
-- Table structure for inbok
-- ----------------------------
DROP TABLE IF EXISTS `inbok`;
CREATE TABLE `inbok`  (
  `no` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idpesan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `konten` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of inbok
-- ----------------------------

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`  (
  `id_item` int NOT NULL AUTO_INCREMENT,
  `id_merchant` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_item` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga_item` int NOT NULL,
  `harga_promo` int NOT NULL,
  `kategori_item` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi_item` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto_item` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_item` timestamp NOT NULL DEFAULT current_timestamp,
  `status_item` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_promo` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_item`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of item
-- ----------------------------

-- ----------------------------
-- Table structure for kategori_news
-- ----------------------------
DROP TABLE IF EXISTS `kategori_news`;
CREATE TABLE `kategori_news`  (
  `id_kategori_news` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_kategori_news`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kategori_news
-- ----------------------------

-- ----------------------------
-- Table structure for kendaraan
-- ----------------------------
DROP TABLE IF EXISTS `kendaraan`;
CREATE TABLE `kendaraan`  (
  `id_k` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `merek` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipe` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_kendaraan` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `warna` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_k`) USING BTREE,
  UNIQUE INDEX `id`(`id_k`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kendaraan
-- ----------------------------

-- ----------------------------
-- Table structure for kodepromo
-- ----------------------------
DROP TABLE IF EXISTS `kodepromo`;
CREATE TABLE `kodepromo`  (
  `id_promo` int NOT NULL AUTO_INCREMENT,
  `nama_promo` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_promo` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nominal_promo` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `minimal` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `type_promo` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `expired` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fitur` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `image_promo` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_promo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kodepromo
-- ----------------------------

-- ----------------------------
-- Table structure for list_bank
-- ----------------------------
DROP TABLE IF EXISTS `list_bank`;
CREATE TABLE `list_bank`  (
  `id_bank` int NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `image_bank` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rekening_bank` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_bank` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_bank`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of list_bank
-- ----------------------------

-- ----------------------------
-- Table structure for lokasi_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `lokasi_pelanggan`;
CREATE TABLE `lokasi_pelanggan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pelanggan` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `latitude` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `longitude` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `utama` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lokasi_pelanggan
-- ----------------------------

-- ----------------------------
-- Table structure for merchant
-- ----------------------------
DROP TABLE IF EXISTS `merchant`;
CREATE TABLE `merchant`  (
  `id_merchant` int NOT NULL AUTO_INCREMENT,
  `id_fitur` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `latitude_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `longitude_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jam_buka` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jam_tutup` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `category_merchant` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telepon_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi_merchant` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `country_code_merchant` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `open_merchant` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `token_merchant` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_merchant`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of merchant
-- ----------------------------

-- ----------------------------
-- Table structure for midtrans
-- ----------------------------
DROP TABLE IF EXISTS `midtrans`;
CREATE TABLE `midtrans`  (
  `no` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tipe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of midtrans
-- ----------------------------

-- ----------------------------
-- Table structure for mitra
-- ----------------------------
DROP TABLE IF EXISTS `mitra`;
CREATE TABLE `mitra`  (
  `id_mitra` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_mitra` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis_identitas_mitra` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nomor_identitas_mitra` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_mitra` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_mitra` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telepon_mitra` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone_mitra` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `country_code_mitra` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `partner` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_mitra` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_mitra` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_mitra`) USING BTREE,
  UNIQUE INDEX `email_mitra`(`email_mitra` ASC) USING BTREE,
  UNIQUE INDEX `telepon_mitra`(`telepon_mitra` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mitra
-- ----------------------------

-- ----------------------------
-- Table structure for notice
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of notice
-- ----------------------------

-- ----------------------------
-- Table structure for paket
-- ----------------------------
DROP TABLE IF EXISTS `paket`;
CREATE TABLE `paket`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ikon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kendaraan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of paket
-- ----------------------------
INSERT INTO `paket` VALUES (2, 'Elektronik', '2500', '3182a07d407d9a59bd05284ac3f24594.png', '1', '1');

-- ----------------------------
-- Table structure for payusettings
-- ----------------------------
DROP TABLE IF EXISTS `payusettings`;
CREATE TABLE `payusettings`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `payu_key` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payu_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payu_salt` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payu_debug` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `active` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of payusettings
-- ----------------------------

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan`  (
  `id` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fullnama` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_telepon` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `countrycode` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp,
  `tgl_lahir` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rating_pelanggan` double NOT NULL DEFAULT 0,
  `status` int NOT NULL DEFAULT 1,
  `token` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1234',
  `fotopelanggan` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `israte` int NOT NULL DEFAULT 0,
  `id_driver` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `id_transaksi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `total_biaya` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `pakai_wallet` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'false',
  `nama_driver` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `foto_driver` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '',
  `fitur` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `response` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `point_driver` int NOT NULL DEFAULT 0,
  `istopup` int NOT NULL DEFAULT 0,
  `noreff` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `islogin` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`, `pakai_wallet`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `no_telepon`(`no_telepon`) USING BTREE,
  UNIQUE INDEX `phone`(`phone`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES ('P1664540902', 'Demo Customer', 'maswend.2020@gmail.com', '628991585001', '+62', '8991585001', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2022-09-30 19:28:22', '2022-09-30', 0, 1, 'dNFqk6QpTMq4HcMYIOLSsm:APA91bEmcLKEhTG8ixtIxaqDb-Acu1UwmfrO4Vjaj50BTI8wwf52b45bgeDG90O_mG_oBEHwFlh7aPBesMZXqhBUWiDRpm0pPGgx5T4Bfk8MGlndd44rJA1Zywd3rMn2jVwe71Tv19fX', 'noimage.jpg', 0, '0', '0', '0', 'false', '', '', '0', '0', 0, 0, '', 0);

-- ----------------------------
-- Table structure for poin
-- ----------------------------
DROP TABLE IF EXISTS `poin`;
CREATE TABLE `poin`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `poin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nilai` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `isdriver` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `image_poin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `expire` date NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of poin
-- ----------------------------

-- ----------------------------
-- Table structure for point
-- ----------------------------
DROP TABLE IF EXISTS `point`;
CREATE TABLE `point`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_user` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `point` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `tipe` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reward` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `update_at` datetime NOT NULL DEFAULT current_timestamp,
  `kode` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of point
-- ----------------------------

-- ----------------------------
-- Table structure for promosi
-- ----------------------------
DROP TABLE IF EXISTS `promosi`;
CREATE TABLE `promosi`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp,
  `tanggal_berakhir` date NOT NULL,
  `fitur_promosi` int NOT NULL,
  `link_promosi` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type_promosi` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_show` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `action` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of promosi
-- ----------------------------

-- ----------------------------
-- Table structure for rating_driver
-- ----------------------------
DROP TABLE IF EXISTS `rating_driver`;
CREATE TABLE `rating_driver`  (
  `nomor` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pelanggan` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_driver` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_transaksi` int NOT NULL,
  `catatan` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Good job',
  `rating` int NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`nomor`) USING BTREE,
  UNIQUE INDEX `nomor`(`nomor`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rating_driver
-- ----------------------------

-- ----------------------------
-- Table structure for redeem
-- ----------------------------
DROP TABLE IF EXISTS `redeem`;
CREATE TABLE `redeem`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `iduser` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `poin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nominal` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of redeem
-- ----------------------------

-- ----------------------------
-- Table structure for saldo
-- ----------------------------
DROP TABLE IF EXISTS `saldo`;
CREATE TABLE `saldo`  (
  `nomor` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `saldo` int NULL DEFAULT 0,
  `update_at` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`nomor`) USING BTREE,
  UNIQUE INDEX `nomor`(`nomor`) USING BTREE,
  UNIQUE INDEX `id_user`(`id_user`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of saldo
-- ----------------------------
INSERT INTO `saldo` VALUES (1, 'P1664540902', 0, '2022-09-30 19:28:22');

-- ----------------------------
-- Table structure for status_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `status_transaksi`;
CREATE TABLE `status_transaksi`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `status_transaksi` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of status_transaksi
-- ----------------------------
INSERT INTO `status_transaksi` VALUES (3, 'start');
INSERT INTO `status_transaksi` VALUES (4, 'finish');
INSERT INTO `status_transaksi` VALUES (5, 'cancel');
INSERT INTO `status_transaksi` VALUES (2, 'accept');
INSERT INTO `status_transaksi` VALUES (1, 'near');
INSERT INTO `status_transaksi` VALUES (6, 'proses');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_pelanggan` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_driver` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `order_fitur` tinyint NOT NULL,
  `start_latitude` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `start_longitude` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `end_latitude` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `end_longitude` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jarak` double NOT NULL,
  `harga` int NOT NULL,
  `jasaapp` int NULL DEFAULT 0,
  `waktu_order` datetime NOT NULL DEFAULT current_timestamp,
  `waktu_selesai` timestamp NULL DEFAULT NULL,
  `estimasi_time` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_asal` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat_tujuan` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kredit_promo` int NOT NULL DEFAULT 0,
  `biaya_akhir` int NULL DEFAULT 0,
  `pakai_wallet` tinyint(1) NOT NULL DEFAULT 0,
  `rate` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `penumpang` int NULL DEFAULT 1,
  `jenis` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Semua',
  PRIMARY KEY (`id_pelanggan`, `waktu_order`) USING BTREE,
  UNIQUE INDEX `nomor`(`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaksi
-- ----------------------------

-- ----------------------------
-- Table structure for transaksi_detail_merchant
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_detail_merchant`;
CREATE TABLE `transaksi_detail_merchant`  (
  `id_trans_merchant` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_merchant` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total_biaya` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga_akhir` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `struk` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_trans_merchant`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaksi_detail_merchant
-- ----------------------------

-- ----------------------------
-- Table structure for transaksi_detail_send
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_detail_send`;
CREATE TABLE `transaksi_detail_send`  (
  `id_send` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_barang` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pengirim` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_penerima` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telepon_pengirim` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telepon_penerima` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_send`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaksi_detail_send
-- ----------------------------

-- ----------------------------
-- Table structure for transaksi_item
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_item`;
CREATE TABLE `transaksi_item`  (
  `id_trans_item` int NOT NULL AUTO_INCREMENT,
  `id_item` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_merchant` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_transaksi` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah_item` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `catatan_item` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total_harga` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_trans_item`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaksi_item
-- ----------------------------

-- ----------------------------
-- Table structure for voucher
-- ----------------------------
DROP TABLE IF EXISTS `voucher`;
CREATE TABLE `voucher`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `voucher` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipe_voucher` char(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `untuk_fitur` int NOT NULL,
  `tanggal_expired` date NOT NULL,
  `nilai` int NOT NULL,
  `keterangan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `count_to_use` int NOT NULL,
  `is_valid` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of voucher
-- ----------------------------

-- ----------------------------
-- Table structure for wallet
-- ----------------------------
DROP TABLE IF EXISTS `wallet`;
CREATE TABLE `wallet`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `uuid` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `invoice` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int NOT NULL,
  `bank` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_pemilik` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rekening` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tujuan` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '-',
  `waktu` datetime NOT NULL DEFAULT current_timestamp,
  `type` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT 1,
  `foto_bukti` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reff` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `uplink` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'aplikasi',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE,
  UNIQUE INDEX `reff`(`reff`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of wallet
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
