/*
Navicat MySQL Data Transfer

Source Server         : Kali
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : testc1

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-02-16 04:03:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for persona_dirs
-- ----------------------------
DROP TABLE IF EXISTS `persona_dirs`;
CREATE TABLE `persona_dirs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `persona_id` int(10) unsigned NOT NULL DEFAULT 0,
  `location_id` int(10) unsigned NOT NULL DEFAULT 0,
  `codpo_id` int(10) unsigned NOT NULL DEFAULT 0,
  `pais` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calle` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numExt` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `piso` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numInt` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referencia1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referencia2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkmapa` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagenMapa` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `persona_dirs_persona_id_foreign` (`persona_id`),
  KEY `persona_dirs_location_id_foreign` (`location_id`),
  KEY `persona_dirs_codpo_id_foreign` (`codpo_id`),
  CONSTRAINT `persona_dirs_codpo_id_foreign` FOREIGN KEY (`codpo_id`) REFERENCES `cod_pos` (`id`),
  CONSTRAINT `persona_dirs_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `persona_dirs_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
