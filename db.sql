/*
Navicat MySQL Data Transfer

Source Server         : xaamp
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : selfie-cpw

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-09 14:07:47
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
  `base64` mediumtext,
  PRIMARY KEY (`id`),
  KEY `session` (`sessionsAppId`),
  CONSTRAINT `session` FOREIGN KEY (`sessionsAppId`) REFERENCES `sessionsapps` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'Carphone Warehouse', 'CPW');

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
INSERT INTO `languages` VALUES ('1', 'English', 'UK');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stores
-- ----------------------------
INSERT INTO `stores` VALUES ('1', 'Bolton Middlebrook', '1', '0');
INSERT INTO `stores` VALUES ('3', 'Basildon Great Oaks', '1', '0');
INSERT INTO `stores` VALUES ('4', 'Telford Forge Pod', '1', '0');
INSERT INTO `stores` VALUES ('5', 'Greenford', '1', '0');
INSERT INTO `stores` VALUES ('7', 'Southampton Hedge End Retail Park', '1', '0');
INSERT INTO `stores` VALUES ('8', 'Hull Kingston Park', '1', '0');
INSERT INTO `stores` VALUES ('9', 'Birmingham New Street', '1', '0');
INSERT INTO `stores` VALUES ('10', 'Reading Broad Street', '1', '0');
INSERT INTO `stores` VALUES ('11', 'Southampton Above Bar', '1', '0');
INSERT INTO `stores` VALUES ('12', 'Grantham High Street', '1', '0');
INSERT INTO `stores` VALUES ('13', 'Tonbridge', '1', '0');
INSERT INTO `stores` VALUES ('14', 'Doncaster Frenchgate', '1', '0');
INSERT INTO `stores` VALUES ('15', 'St Helens Ravenhead Pod', '1', '0');
INSERT INTO `stores` VALUES ('16', 'Edinburgh Fort Kinnaird', '1', '0');
INSERT INTO `stores` VALUES ('17', 'Oldbury', '1', '0');
INSERT INTO `stores` VALUES ('18', 'Southport Kew', '1', '0');
INSERT INTO `stores` VALUES ('19', 'Sheffield Fargate', '1', '0');
INSERT INTO `stores` VALUES ('20', 'Leeds Briggate', '1', '0');
INSERT INTO `stores` VALUES ('21', 'Great Yarmouth', '1', '0');
INSERT INTO `stores` VALUES ('22', 'Stockport Portwood', '1', '0');
INSERT INTO `stores` VALUES ('23', 'Poole Falkland Square', '1', '0');
INSERT INTO `stores` VALUES ('24', 'Bluewater Lower', '1', '0');
INSERT INTO `stores` VALUES ('25', 'Merry Hill Centre Upper', '1', '0');
INSERT INTO `stores` VALUES ('26', 'Brighton Churchill Square', '1', '0');
INSERT INTO `stores` VALUES ('27', 'Gateshead Metro Centre Lower Yellow', '1', '0');
INSERT INTO `stores` VALUES ('28', 'Haywards Heath', '1', '0');
INSERT INTO `stores` VALUES ('29', 'Portsmouth Commercial Road', '1', '0');
INSERT INTO `stores` VALUES ('30', 'Edinburgh Ocean Terminal', '1', '0');
INSERT INTO `stores` VALUES ('31', 'Hornchurch', '1', '0');
INSERT INTO `stores` VALUES ('32', 'Saffron Walden', '1', '0');
INSERT INTO `stores` VALUES ('33', 'Manchester Arndale', '1', '0');
INSERT INTO `stores` VALUES ('34', 'Wood Green Mall', '1', '0');
INSERT INTO `stores` VALUES ('35', 'Bristol Broadmead', '1', '0');
INSERT INTO `stores` VALUES ('37', 'Trafford Centre Lower', '1', '0');
INSERT INTO `stores` VALUES ('38', 'Leeds White Rose', '1', '0');
INSERT INTO `stores` VALUES ('39', 'White City', '1', '0');
INSERT INTO `stores` VALUES ('40', 'St Neots', '1', '0');
INSERT INTO `stores` VALUES ('41', 'Petersfield', '1', '0');
INSERT INTO `stores` VALUES ('42', 'Belfast Castle Court', '1', '0');
INSERT INTO `stores` VALUES ('43', 'Paignton', '1', '0');
INSERT INTO `stores` VALUES ('44', 'Salisbury New Canal', '1', '0');
INSERT INTO `stores` VALUES ('45', 'Blackpool Houndshill Centre', '1', '0');
INSERT INTO `stores` VALUES ('46', 'Luton Arndale', '1', '0');
INSERT INTO `stores` VALUES ('47', 'Taunton Fore Street', '1', '0');
INSERT INTO `stores` VALUES ('48', 'Cardiff Capital', '1', '0');
INSERT INTO `stores` VALUES ('49', 'Brent Cross', '1', '0');
INSERT INTO `stores` VALUES ('50', 'Glasgow Braehead Centre', '1', '0');
INSERT INTO `stores` VALUES ('51', 'Glasgow Forge Pod', '1', '0');
INSERT INTO `stores` VALUES ('52', 'Aberdeen Union Square', '1', '0');
INSERT INTO `stores` VALUES ('53', 'Neath', '1', '0');

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
