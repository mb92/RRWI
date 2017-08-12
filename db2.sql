/*
Navicat MySQL Data Transfer

Source Server         : xaamp
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : selfie-cpw

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-08-10 13:35:55
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stores
-- ----------------------------
INSERT INTO `stores` VALUES ('54', 'Basildon Great Oaks', '1', '0');
INSERT INTO `stores` VALUES ('55', 'Greenford', '1', '0');
INSERT INTO `stores` VALUES ('56', 'Reading Broad Street', '1', '0');
INSERT INTO `stores` VALUES ('58', 'Southampton Above Bar', '1', '0');
INSERT INTO `stores` VALUES ('59', 'Doncaster Frenchgate', '1', '0');
INSERT INTO `stores` VALUES ('61', 'Oldbury', '1', '0');
INSERT INTO `stores` VALUES ('62', 'Southport Kew', '1', '0');
INSERT INTO `stores` VALUES ('63', 'Sheffield Fargate', '1', '0');
INSERT INTO `stores` VALUES ('64', 'Leeds Briggate', '1', '0');
INSERT INTO `stores` VALUES ('65', 'Stockport Portwood', '1', '0');
INSERT INTO `stores` VALUES ('66', 'Bluewater Lower', '1', '0');
INSERT INTO `stores` VALUES ('67', 'Brighton Churchill Square', '1', '0');
INSERT INTO `stores` VALUES ('68', 'Gateshead Metro Centre Lower Yellow', '1', '0');
INSERT INTO `stores` VALUES ('69', 'Portsmouth Commercial Road', '1', '0');
INSERT INTO `stores` VALUES ('70', 'Saffron Walden', '1', '0');
INSERT INTO `stores` VALUES ('71', 'Wood Green Mall', '1', '0');
INSERT INTO `stores` VALUES ('72', 'Bristol Broadmead', '1', '0');
INSERT INTO `stores` VALUES ('73', 'Trafford Centre Lower', '1', '0');
INSERT INTO `stores` VALUES ('74', 'Leeds White Rose', '1', '0');
INSERT INTO `stores` VALUES ('75', 'White City (Westfield Shopping Centre)', '1', '0');
INSERT INTO `stores` VALUES ('76', 'Petersfield (The Square)', '1', '0');
INSERT INTO `stores` VALUES ('77', 'Salisbury New Canal', '1', '0');
INSERT INTO `stores` VALUES ('78', 'Blackpool Houndshill Shopping Centre', '1', '0');
INSERT INTO `stores` VALUES ('79', 'Luton Arndale', '1', '0');
INSERT INTO `stores` VALUES ('80', 'Taunton Fore Street', '1', '0');
INSERT INTO `stores` VALUES ('81', 'Brent Cross', '1', '0');
INSERT INTO `stores` VALUES ('82', 'Exeter (Princesshay)', '1', '0');
INSERT INTO `stores` VALUES ('83', 'Bristol (Longwell Green)', '1', '0');
INSERT INTO `stores` VALUES ('84', 'Sheffield (Meadowhall Shopping Centre)', '1', '0');
INSERT INTO `stores` VALUES ('85', 'Plymouth (Drakes Circus)', '1', '0');
INSERT INTO `stores` VALUES ('86', 'Leeds Trinity Shopping Centre', '1', '0');
INSERT INTO `stores` VALUES ('87', 'Woking', '1', '0');
INSERT INTO `stores` VALUES ('88', 'Norwich (Chapelfield)', '1', '0');
INSERT INTO `stores` VALUES ('89', 'Coventry (Business Park)', '1', '0');
INSERT INTO `stores` VALUES ('90', 'Leicester Fosse Park', '1', '0');
INSERT INTO `stores` VALUES ('91', 'Durham Arnison', '1', '0');
INSERT INTO `stores` VALUES ('92', 'Ormskirk (Moor St)', '1', '0');
INSERT INTO `stores` VALUES ('93', 'Milton Keynes (Eldergate)', '1', '0');
INSERT INTO `stores` VALUES ('94', 'Norwich (Riverside Retail Park)', '1', '0');
INSERT INTO `stores` VALUES ('95', 'Grimsby (Freshney Place)', '1', '0');
INSERT INTO `stores` VALUES ('96', 'Aberdreen Union Square', '1', '0');
INSERT INTO `stores` VALUES ('97', 'Glasgow Braehead Centre', '1', '0');
INSERT INTO `stores` VALUES ('98', 'Glasgow Forge Pod', '1', '0');
INSERT INTO `stores` VALUES ('99', 'Neath', '1', '0');
INSERT INTO `stores` VALUES ('100', 'Bangor (Bloomfield)', '1', '0');

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
