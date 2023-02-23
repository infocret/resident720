/*
Navicat MySQL Data Transfer

Source Server         : Kali
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : testc1

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-02-28 00:13:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for personas
-- ----------------------------
DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appat` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apmat` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datebirth` datetime NOT NULL,
  `rfc` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `curp` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nss` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personas
-- ----------------------------
INSERT INTO `personas` VALUES ('1', 'Julio', 'Buendía', 'González', '1971-01-13 00:00:00', 'BUGJ710113HP0', '123456789012345678', '12345678901', null, null, null);
INSERT INTO `personas` VALUES ('2', 'Cesar', 'Buendía', 'González', '1971-01-13 00:00:00', 'BUGJ710113HP0', '123456789012345678', '12345678901', null, null, null);
INSERT INTO `personas` VALUES ('3', 'Noemi', 'Guízar', 'Rodríguez', '1971-03-31 00:00:00', 'GURN710331NNN', '123456789012345678', '12345678901', null, null, null);
