/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost
 Source Database       : matching_db

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : utf-8

 Date: 07/15/2019 03:17:05 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `category`
-- ----------------------------
BEGIN;
INSERT INTO `category` VALUES ('53', '7', '0', 'Sản phẩm thuộc lĩnh vực?', '0', '0', '0'), ('54', '7', '53', 'Y tế', '1', '0', '0'), ('55', '7', '53', 'Giao thông', '1', '0', '0'), ('56', '7', '53', 'Giáo dục', '1', '0', '0'), ('57', '7', '53', 'Tài chính ngân hàng', '1', '0', '0'), ('58', '7', '53', 'Thương mại điện tử', '1', '0', '0'), ('59', '7', '53', 'Nhà hàng, khách sạn', '1', '0', '0'), ('60', '7', '53', 'Chính phủ điện tử', '1', '0', '0'), ('61', '7', '0', 'Công nghệ được ứng dụng?', '0', '0', '0'), ('62', '7', '61', 'C++', '1', '0', '0'), ('63', '7', '61', '.NET', '1', '0', '0'), ('64', '7', '61', 'Java', '1', '0', '0'), ('65', '7', '61', 'mySQL', '1', '0', '0'), ('66', '7', '61', 'PHP', '1', '0', '0'), ('67', '7', '61', 'Blogchain', '1', '0', '0'), ('68', '7', '61', 'Big Data', '1', '0', '0'), ('69', '7', '61', 'Trello', '1', '0', '0'), ('70', '7', '53', 'Quản lý doanh nghiệp', '1', '0', '0'), ('71', '7', '0', 'Giải pháp mong muốn', '0', '0', '0'), ('72', '7', '71', 'Quản lý theo thời gian thực', '1', '0', '0'), ('73', '7', '71', 'Trích xuất báo cáo', '1', '0', '0'), ('74', '7', '71', 'Tiết kiệm chi phí', '1', '0', '0'), ('75', '7', '71', 'Quản lý thiết bị', '1', '0', '0'), ('76', '7', '71', 'Quản lý hồ sơ', '1', '0', '0'), ('77', '7', '0', 'Hình thức hợp tác', '0', '0', '0'), ('78', '7', '77', 'Nhà phân phối', '1', '0', '0'), ('79', '7', '77', 'Đối tác phát triển sản phẩm', '1', '0', '0'), ('80', '7', '77', 'Đối tác cung cấp giải pháp', '1', '0', '0'), ('81', '7', '77', 'Đối tác cung cấp nguồn nhân lực', '1', '0', '0'), ('82', '7', '53', 'Domain, hosting', '1', '0', '0'), ('83', '7', '53', 'Game', '1', '0', '0'), ('84', '8', '0', '1', '0', '0', '0'), ('85', '8', '84', '2', '1', '0', '0'), ('86', '8', '85', '3', '1', '0', '0'), ('87', '8', '0', 'a', '0', '0', '0'), ('88', '8', '87', 'b', '1', '0', '0'), ('89', '8', '88', 'c', '1', '0', '0'), ('90', '8', '88', 'd', '1', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `ci_sessions`
-- ----------------------------
BEGIN;
INSERT INTO `ci_sessions` VALUES ('051a12030e9a05edb6bd3d35e55206b22fec19f7', '::1', '1562002885', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323030323833343b6964656e746974797c733a31383a22616e6e763836766e40676d61696c2e636f6d223b656d61696c7c733a31383a22616e6e763836766e40676d61696c2e636f6d223b757365725f69647c733a333a22343135223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313536313939353934343b), ('057c49b21b56a2d5cd02933d4052a1964ae2e5c6', '::1', '1562002489', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323030323438393b6964656e746974797c733a31383a22616e6e763836766e40676d61696c2e636f6d223b656d61696c7c733a31383a22616e6e763836766e40676d61696c2e636f6d223b757365725f69647c733a333a22343135223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313536313939353934343b), ('23f84ecc7f62272123d85955ccdf86a88eff44aa', '::1', '1563129636', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333132393633363b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a333a22343136223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632303032343439223b6c6173745f636865636b7c693a313536333132393132353b), ('2ec56ccf8e13ac94347fd3cd2a79493e02106d3f', '::1', '1563129017', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333132393031373b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632303032343330223b6c6173745f636865636b7c693a313536333132393031373b), ('463ec12ca32857308310d523d12d409e59fd1b7a', '::1', '1562002449', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323030323434393b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a333a22343136223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632303032333334223b6c6173745f636865636b7c693a313536323030323434393b), ('4fd58c540abd8ff806f3e7d1608a360c33cfa1e8', '::1', '1561912824', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313931323832333b6c6f67696e5f6d6573736167655f6572726f727c733a35333a223c703e54c3a069206b686fe1baa36e20686fe1bab763206de1baad74206b68e1baa975206b68c3b46e6720c491c3ba6e673c2f703e223b5f5f63695f766172737c613a313a7b733a31393a226c6f67696e5f6d6573736167655f6572726f72223b733a333a226f6c64223b7d), ('601e77ef4a3d1f9309e37e0eb6a476ad413db4d2', '::1', '1563129001', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333132393030313b6964656e746974797c733a31383a22616e6e763836766e40676d61696c2e636f6d223b656d61696c7c733a31383a22616e6e763836766e40676d61696c2e636f6d223b757365725f69647c733a333a22343135223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353631393935393434223b6c6173745f636865636b7c693a313536333132393030313b), ('657c0d39f483e744f96517d93e99b73e58c7c8fe', '::1', '1562002157', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323030323135373b6964656e746974797c733a31383a22616e6e763836766e40676d61696c2e636f6d223b656d61696c7c733a31383a22616e6e763836766e40676d61696c2e636f6d223b757365725f69647c733a333a22343135223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313536313939353934343b), ('6689ed28f1e7205e3aca2700ad2b661d9e0e1646', '::1', '1562002834', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323030323833343b6964656e746974797c733a31383a22616e6e763836766e40676d61696c2e636f6d223b656d61696c7c733a31383a22616e6e763836766e40676d61696c2e636f6d223b757365725f69647c733a333a22343135223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313536313939353934343b), ('684722d5bb104f0fe46f0c06dc044ca0ce9bfaf9', '::1', '1561912835', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313931323833353b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353631393038393835223b6c6173745f636865636b7c693a313536313931323833353b), ('68f6fa2b2ec6a8a4f70850adbe9c2d0cc5c7f449', '::1', '1561913137', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313931333133373b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353631393038393835223b6c6173745f636865636b7c693a313536313931323833353b), ('7a842ce064cff4ad0b4254e504a494596127c0f3', '::1', '1561913137', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313931333133373b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353631393038393835223b6c6173745f636865636b7c693a313536313931323833353b), ('84351dd11074d9846cdb592ce98998823d603239', '::1', '1563129632', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333132393632373b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633313239303137223b6c6173745f636865636b7c693a313536333132393134383b), ('900c63a3d607bcd7060b0ecb4af2726fc7b58965', '::1', '1563129661', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333132393633363b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a333a22343136223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632303032343439223b6c6173745f636865636b7c693a313536333132393132353b), ('910d2b2d0bdc7418f2d011502ce6d70f712d63e4', '::1', '1563129627', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333132393632373b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633313239303137223b6c6173745f636865636b7c693a313536333132393134383b), ('92f0236d881d54bbdd835fa8353d7fdaa40d5cb5', '::1', '1561995944', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536313939353934343b6964656e746974797c733a31383a22616e6e763836766e40676d61696c2e636f6d223b656d61696c7c733a31383a22616e6e763836766e40676d61696c2e636f6d223b757365725f69647c733a333a22343135223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313536313939353934343b), ('9a2568c8e77f9e7d33d643ef5e8e8f22153d5d12', '::1', '1563129148', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333132393134383b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633313239303137223b6c6173745f636865636b7c693a313536333132393134383b), ('a1858dd95f67177fb420c11436a13312878f70ea', '::1', '1562002430', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323030323433303b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632303032323831223b6c6173745f636865636b7c693a313536323030323433303b), ('c1808dbab955e4a7aa55172d1b5a1f0f27bf97f7', '::1', '1562002281', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323030323238313b6964656e746974797c733a31353a2261646d696e4061646d696e2e636f6d223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353631393132383335223b6c6173745f636865636b7c693a313536323030323238313b), ('e2d362d7842b9127df173da6382a356967bbd105', '::1', '1563129125', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333132393132353b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a333a22343136223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632303032343439223b6c6173745f636865636b7c693a313536333132393132353b), ('e83172ff5aea9f56dce9e9afd960ee8a98a0e85e', '::1', '1562002486', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323030323434393b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a333a22343136223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632303032333334223b6c6173745f636865636b7c693a313536323030323434393b), ('fe06a3c811e225512e2b6d332ee05ee1bbe56e6a', '::1', '1562002334', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323030323333343b6c616e67416262726576696174696f6e7c733a323a227669223b6964656e746974797c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b656d61696c7c733a32313a2276696e68616e313673657040676d61696c2e636f6d223b757365725f69647c733a333a22343136223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313536323030323333343b);
COMMIT;

-- ----------------------------
--  Table structure for `event`
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` int(11) DEFAULT NULL,
  `table` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `start` varchar(50) DEFAULT NULL,
  `duration` int(10) DEFAULT NULL,
  `step` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `event`
-- ----------------------------
BEGIN;
INSERT INTO `event` VALUES ('7', 'Vietnam ICT Summit 2019', '1563296400', '20', '1', '0', '9:00', '8', '30'), ('8', 'Test', '1560963600', null, '1', '0', '8:00', '8', '20');
COMMIT;

-- ----------------------------
--  Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `groups`
-- ----------------------------
BEGIN;
INSERT INTO `groups` VALUES ('1', 'admin', 'Administrator'), ('2', 'members', 'General User'), ('3', 'clients', 'Guest User');
COMMIT;

-- ----------------------------
--  Table structure for `information`
-- ----------------------------
DROP TABLE IF EXISTS `information`;
CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` int(10) NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` int(10) NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `overview` text COLLATE utf8mb4_unicode_ci,
  `profile` text COLLATE utf8mb4_unicode_ci,
  `file` text COLLATE utf8mb4_unicode_ci,
  `is_overview` tinyint(4) DEFAULT '0',
  `product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `market` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `partner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desire` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_charge` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `matching`
-- ----------------------------
DROP TABLE IF EXISTS `matching`;
CREATE TABLE `matching` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `finder_id` int(11) DEFAULT NULL COMMENT 'id of table temp_register ',
  `target_id` int(11) DEFAULT NULL COMMENT 'id of table temp_register ',
  `event_id` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `note` text,
  `status` tinyint(1) DEFAULT '0' COMMENT '0: pending; 1: accepted; 2: rejected',
  `created_at` datetime DEFAULT NULL,
  `log` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `setting`
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: default; 1: charged; 2: pending request',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `setting`
-- ----------------------------
BEGIN;
INSERT INTO `setting` VALUES ('11', '415', '7', ',53,55,56,', '1', '0', '63a10'), ('12', '416', '7', ',53,54,55,56,57,58,59,60,70,82,83,', '1', '0', '0db3d'), ('13', '416', '8', '', '2', '0', '7ad18');
COMMIT;

-- ----------------------------
--  Table structure for `temp_register`
-- ----------------------------
DROP TABLE IF EXISTS `temp_register`;
CREATE TABLE `temp_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` int(10) NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` int(10) NOT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `overview` text COLLATE utf8mb4_unicode_ci,
  `profile` text COLLATE utf8mb4_unicode_ci,
  `file` text COLLATE utf8mb4_unicode_ci,
  `is_overview` tinyint(4) DEFAULT NULL,
  `product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `market` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `partner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desire` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `manpower` int(11) NOT NULL,
  `revenue` int(50) NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_saved` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `temp_register`
-- ----------------------------
BEGIN;
INSERT INTO `temp_register` VALUES ('33', 'annv86vn', 'annv86vn', '', 'annv86vn', '1231231231', 'annv86vn@gmail.com', '0', '0', '', '0', '', '415', null, 'asd', 'dang-ky-matching-truc-tuyenpdf-1.pdf', null, 'asd', 'asd', '', '', '', '', 'maillink.live', '123', '123', 'c44ea6277390cce113f1a8013cf61143.png', '1'), ('34', 'vinhan16sep', 'vinhan16sep', '', 'vinhan16sep', '1231231231', 'vinhan16sep@gmail.com', '0', '0', '', '0', '', '416', null, 'qwe', 'dang-ky-matching-truc-tuyenpdf-2.pdf', null, 'qwe', 'qwe', '', '', '', '', 'maillink.live', '321', '321', '9f10b6fc9b18201279f7e5b720f32015.png', '1');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `company_id` text NOT NULL,
  `information_id` int(11) DEFAULT NULL,
  `member_role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=417 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', '127.0.0.1', 'administrator', '$2y$08$SeMiLq0OTtbQaL3GKJZtFelCEtAIGzCDbTwwk7TvrzRyU15N5b3iS', '', 'admin@admin.com', '', null, null, null, '1268889823', '1563129148', '1', 'Admin', 'istrator', null, 'ADMIN', '0', null, '', null, null), ('415', '::1', 'annv86vn', '$2y$08$Mr2ifiuYeib0rTSTR5CMKO7Tn.ysQ0mjUehf5oJZBdsyHGwFvGYLO', null, 'annv86vn@gmail.com', '63c976500fcf6e579e720cdb09db244ce4c27876', null, null, null, '1561995930', '1563129001', '1', null, null, null, 'annv86vn', '1231231231', null, '', null, null), ('416', '::1', 'vinhan16sep', '$2y$08$otLeFGGiLjpkjlb3hprQNOGsq9nKmi8Y8/ZWrbjXeuFFcBNGYHaEe', null, 'vinhan16sep@gmail.com', '759bf79c70805774baa5c908dacf38737ddd012e', null, null, null, '1562002324', '1563129125', '1', null, null, null, 'vinhan16sep', '1231231231', null, '', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=400 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users_groups`
-- ----------------------------
BEGIN;
INSERT INTO `users_groups` VALUES ('203', '1', '1'), ('398', '415', '2'), ('399', '416', '2');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
