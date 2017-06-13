/*
Navicat MySQL Data Transfer

Source Server         : xaamp
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : selfie-app

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-13 15:11:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `actions`
-- ----------------------------
DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `action` varchar(2) NOT NULL COMMENT 'Dropdown list:\r\n\r\ntP - Take a photo\r\nsF - Share photo on facebook\r\nsI - Share photo on instagram\r\nsE - Share photo on email\r\nrT - Press RETAKE button\r\n',
  `path` varchar(255) NOT NULL COMMENT 'Path''s values:\r\n\r\ntP - Take a photo                     => link to photoUrl (name)\r\n\r\nsF - Share photo on facebook => link to facebook\r\n\r\nsI - Share photo on instagram => link to instagram\r\n\r\nsE - Share photo on email        => user''s email address\r\n\r\nrT ',
  `created_at` datetime NOT NULL COMMENT 'Format: 1970-01-01 00:00:01',
  `sessionsAppId` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `session` (`sessionsAppId`),
  CONSTRAINT `session` FOREIGN KEY (`sessionsAppId`) REFERENCES `sessionsapps` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=285 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of actions
-- ----------------------------

-- ----------------------------
-- Table structure for `clients`
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `offers` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clients
-- ----------------------------

-- ----------------------------
-- Table structure for `countries`
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `short` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'England', 'EN');
INSERT INTO `countries` VALUES ('2', 'Portugal', 'PT');
INSERT INTO `countries` VALUES ('3', 'Germany', 'DE');
INSERT INTO `countries` VALUES ('4', 'Romania', 'RO');
INSERT INTO `countries` VALUES ('5', 'South Africa', 'ZA');
INSERT INTO `countries` VALUES ('6', 'Czech Republic', 'CZ');

-- ----------------------------
-- Table structure for `languages`
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `short` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES ('1', 'English', 'EN');
INSERT INTO `languages` VALUES ('2', 'Portuguese', 'PT');
INSERT INTO `languages` VALUES ('3', 'German', 'DE');
INSERT INTO `languages` VALUES ('4', 'Romanian', 'RO');
INSERT INTO `languages` VALUES ('5', 'South African English', 'ZA');
INSERT INTO `languages` VALUES ('6', 'Czech', 'CZ');

-- ----------------------------
-- Table structure for `sessionsapps`
-- ----------------------------
DROP TABLE IF EXISTS `sessionsapps`;
CREATE TABLE `sessionsapps` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `sesId` varchar(32) DEFAULT NULL,
  `appId` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` varchar(1) DEFAULT '0',
  `emailStatus` varchar(1) DEFAULT '0',
  `shareEmail` varchar(255) DEFAULT NULL,
  `clientId` int(8) DEFAULT NULL,
  `storeId` int(8) DEFAULT NULL,
  `languageId` int(6) DEFAULT NULL,
  `countryId` int(6) DEFAULT NULL,
  `shareEmailStatus` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client` (`clientId`),
  KEY `country` (`countryId`),
  KEY `language` (`languageId`),
  KEY `store` (`storeId`),
  CONSTRAINT `client` FOREIGN KEY (`clientId`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `country` FOREIGN KEY (`countryId`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `language` FOREIGN KEY (`languageId`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `store` FOREIGN KEY (`storeId`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sessionsapps
-- ----------------------------

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `param` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8 DEFAULT 'Email',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for `stores`
-- ----------------------------
DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `countryId` int(6) NOT NULL,
  `count` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shopcountry` (`countryId`),
  CONSTRAINT `shopcountry` FOREIGN KEY (`countryId`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stores
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `pass` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
