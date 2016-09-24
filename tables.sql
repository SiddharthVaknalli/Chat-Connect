/*
Navicat MySQL Data Transfer

Source Server         : us-cdbr-iron-east-04.cleardb.net_3306
Source Server Version : 50546
Source Host           : us-cdbr-iron-east-04.cleardb.net:3306
Source Database       : heroku_ffc2416b09868b3

Target Server Type    : MYSQL
Target Server Version : 50546
File Encoding         : 65001

Date: 2016-09-24 15:22:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for webchat_lines
-- ----------------------------
DROP TABLE IF EXISTS `webchat_lines`;
CREATE TABLE `webchat_lines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(16) NOT NULL,
  `gravatar` varchar(32) NOT NULL,
  `text` varchar(255) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ts` (`ts`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of webchat_lines
-- ----------------------------

-- ----------------------------
-- Table structure for webchat_users
-- ----------------------------
DROP TABLE IF EXISTS `webchat_users`;
CREATE TABLE `webchat_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `gravatar` varchar(32) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `last_activity` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of webchat_users
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
