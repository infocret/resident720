/*
Navicat MySQL Data Transfer

Source Server         : Kali
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : testc1

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-02-16 02:37:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for inmueble_tipos
-- ----------------------------
DROP TABLE IF EXISTS `inmueble_tipos`;
CREATE TABLE `inmueble_tipos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ident` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imgfilename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
