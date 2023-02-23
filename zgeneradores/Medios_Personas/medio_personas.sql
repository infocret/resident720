/*
Navicat MySQL Data Transfer

Source Server         : Kali
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : testc1

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-02-16 04:03:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for medio_personas
-- ----------------------------
DROP TABLE IF EXISTS `medio_personas`;
CREATE TABLE `medio_personas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medio_id` int(10) unsigned NOT NULL DEFAULT 0,
  `persona_id` int(10) unsigned NOT NULL DEFAULT 0,
  `dato` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medio_personas_medio_id_foreign` (`medio_id`),
  KEY `medio_personas_persona_id_foreign` (`persona_id`),
  CONSTRAINT `medio_personas_medio_id_foreign` FOREIGN KEY (`medio_id`) REFERENCES `medios` (`id`),
  CONSTRAINT `medio_personas_persona_id_foreign` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
