/*
Navicat MySQL Data Transfer

Source Server         : xaamp
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : selfie-app

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-17 12:15:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `actions`
-- ----------------------------
DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `action` varchar(2) CHARACTER SET utf8 NOT NULL COMMENT 'Dropdown list:\r\n\r\ntP - Take a photo\r\nsF - Share photo on facebook\r\nsI - Share photo on instagram\r\nsE - Share photo on email\r\nrT - Press RETAKE button\r\n',
  `path` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Path''s values:\r\n\r\ntP - Take a photo                     => link to photoUrl (name)\r\n\r\nsF - Share photo on facebook => link to facebook\r\n\r\nsI - Share photo on instagram => link to instagram\r\n\r\nsE - Share photo on email        => user''s email address\r\n\r\nrT ',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Format: 1970-01-01 00:00:01',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of actions
-- ----------------------------
INSERT INTO `actions` VALUES ('3', 'tP', 'a50c23b5e690830e9111ddd2bcd38151.jpg', '0000-00-00 00:00:00');
INSERT INTO `actions` VALUES ('4', 'tP', 'a50c23b5e690830e9111ddd2bcd38151.jpg', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `clients`
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('4', 'email@asd.com', 'marian');
INSERT INTO `clients` VALUES ('5', 'email@asd.com', 'marian');

-- ----------------------------
-- Table structure for `countries`
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `short` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'England', 'EN');
INSERT INTO `countries` VALUES ('2', 'Portugal', 'PT');
INSERT INTO `countries` VALUES ('3', 'Germany', 'DE');

-- ----------------------------
-- Table structure for `languages`
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `short` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES ('1', 'English', 'EN');
INSERT INTO `languages` VALUES ('2', 'Portuguese', 'PT');
INSERT INTO `languages` VALUES ('3', 'German', 'DE');

-- ----------------------------
-- Table structure for `sessionsapps`
-- ----------------------------
DROP TABLE IF EXISTS `sessionsapps`;
CREATE TABLE `sessionsapps` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `sesId` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `appId` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` varchar(1) CHARACTER SET utf8 DEFAULT '0',
  `emailStatus` varchar(1) CHARACTER SET utf8 DEFAULT '0',
  `shareEmail` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `clientId` int(8) DEFAULT NULL,
  `storeId` int(8) DEFAULT NULL,
  `languageId` int(6) DEFAULT NULL,
  `countryId` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client` (`clientId`),
  KEY `country` (`countryId`),
  KEY `language` (`languageId`),
  KEY `store` (`storeId`),
  CONSTRAINT `client` FOREIGN KEY (`clientId`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `country` FOREIGN KEY (`countryId`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `language` FOREIGN KEY (`languageId`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `store` FOREIGN KEY (`storeId`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sessionsapps
-- ----------------------------
INSERT INTO `sessionsapps` VALUES ('2', '12312', '123', null, '0', '0', 'daasd21', null, null, null, null);
INSERT INTO `sessionsapps` VALUES ('3', 'qqwe21', '333', '2017-05-20 11:32:40', '0', '0', 'dasdasd', null, null, '1', '1');
INSERT INTO `sessionsapps` VALUES ('4', 'a50c23b5e690830e9111ddd2bcd38151', 'com.example.app', '2017-05-17 12:01:39', '0', '0', null, null, null, null, null);

-- ----------------------------
-- Table structure for `sessions_actions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions_actions`;
CREATE TABLE `sessions_actions` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `actionId` int(8) DEFAULT NULL,
  `sessionAppId` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sess` (`sessionAppId`),
  KEY `act` (`actionId`),
  CONSTRAINT `act` FOREIGN KEY (`actionId`) REFERENCES `actions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sess` FOREIGN KEY (`sessionAppId`) REFERENCES `sessionsapps` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sessions_actions
-- ----------------------------

-- ----------------------------
-- Table structure for `stores`
-- ----------------------------
DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) NOT NULL,
  `geolocation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of stores
-- ----------------------------
INSERT INTO `stores` VALUES ('1', 'XYZ', 'Lorem ipsu 12-123ASD', 'loremipsume');
