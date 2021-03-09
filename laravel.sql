/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 100417
Source Host           : localhost:3306
Source Database       : laravel

Target Server Type    : MYSQL
Target Server Version : 100417
File Encoding         : 65001

Date: 2021-03-09 14:29:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('1', 'root', 'root@mail.com', '$2y$10$FdJiSSrk8NwUTvAVOHeSAuY6Zl038ETUG.tArL3NuOCORfzMiPFAW', null, '2021-02-11 05:11:48', '2021-02-11 05:11:48');
INSERT INTO `t_admin` VALUES ('2', 'tester', 'test@mail.com', '$2y$10$z75yC9HqtAcIayo6gVl0XOhTf1wf9GkR2OkjometqqsC8MK3bc84K', null, '2021-02-22 02:34:51', '2021-02-22 02:34:51');

-- ----------------------------
-- Table structure for t_atec
-- ----------------------------
DROP TABLE IF EXISTS `t_atec`;
CREATE TABLE `t_atec` (
  `no` int(2) NOT NULL,
  `kind` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_atec
-- ----------------------------

-- ----------------------------
-- Table structure for t_carrying
-- ----------------------------
DROP TABLE IF EXISTS `t_carrying`;
CREATE TABLE `t_carrying` (
  `no` int(2) NOT NULL,
  `shop_no` int(2) NOT NULL,
  `date` date NOT NULL,
  `goods` varchar(255) NOT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_carrying
-- ----------------------------

-- ----------------------------
-- Table structure for t_county
-- ----------------------------
DROP TABLE IF EXISTS `t_county`;
CREATE TABLE `t_county` (
  `no` int(2) NOT NULL,
  `province_no` int(2) NOT NULL,
  `county_name` varchar(255) NOT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_county
-- ----------------------------

-- ----------------------------
-- Table structure for t_coupon
-- ----------------------------
DROP TABLE IF EXISTS `t_coupon`;
CREATE TABLE `t_coupon` (
  `no` int(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `shop_no` int(2) NOT NULL DEFAULT 0,
  `reuse` int(2) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `agree` int(2) NOT NULL DEFAULT 0,
  `created_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_coupon
-- ----------------------------

-- ----------------------------
-- Table structure for t_customer
-- ----------------------------
DROP TABLE IF EXISTS `t_customer`;
CREATE TABLE `t_customer` (
  `id` int(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_japan` varchar(100) DEFAULT NULL,
  `tel_no` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthday` date NOT NULL,
  `fax` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_customer
-- ----------------------------

-- ----------------------------
-- Table structure for t_inquiry
-- ----------------------------
DROP TABLE IF EXISTS `t_inquiry`;
CREATE TABLE `t_inquiry` (
  `no` int(2) NOT NULL,
  `shop_no` int(2) NOT NULL,
  `content` varchar(255) NOT NULL,
  `customer` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `sender` varchar(100) NOT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_inquiry
-- ----------------------------

-- ----------------------------
-- Table structure for t_notice
-- ----------------------------
DROP TABLE IF EXISTS `t_notice`;
CREATE TABLE `t_notice` (
  `no` int(2) NOT NULL,
  `kind` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `shop_no` int(2) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `agree` int(1) NOT NULL DEFAULT 0,
  `created_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_notice
-- ----------------------------

-- ----------------------------
-- Table structure for t_province
-- ----------------------------
DROP TABLE IF EXISTS `t_province`;
CREATE TABLE `t_province` (
  `no` int(2) NOT NULL,
  `province_name` varchar(255) NOT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_province
-- ----------------------------

-- ----------------------------
-- Table structure for t_shop
-- ----------------------------
DROP TABLE IF EXISTS `t_shop`;
CREATE TABLE `t_shop` (
  `no` int(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `province` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `province_no` int(2) DEFAULT NULL,
  `county_no` int(2) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `tel_no` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_shop
-- ----------------------------

-- ----------------------------
-- Table structure for t_tossup
-- ----------------------------
DROP TABLE IF EXISTS `t_tossup`;
CREATE TABLE `t_tossup` (
  `no` int(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `shop_no` int(2) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `tossed` int(1) DEFAULT 0,
  PRIMARY KEY (`no`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of t_tossup
-- ----------------------------

-- ----------------------------
-- View structure for v_coupon
-- ----------------------------
DROP VIEW IF EXISTS `v_coupon`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_coupon` AS select `t_coupon`.`no` AS `no`,`t_coupon`.`title` AS `title`,`t_coupon`.`content` AS `content`,`t_coupon`.`from_date` AS `from_date`,`t_coupon`.`to_date` AS `to_date`,`t_coupon`.`shop_no` AS `shop_no`,`t_coupon`.`reuse` AS `reuse`,`t_coupon`.`image` AS `image`,`t_coupon`.`agree` AS `agree`,`t_shop`.`name` AS `name` from (`t_coupon` left join `t_shop` on((`t_coupon`.`shop_no` = `t_shop`.`no`))); ;

-- ----------------------------
-- View structure for v_notice
-- ----------------------------
DROP VIEW IF EXISTS `v_notice`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_notice` AS select `t_notice`.`no` AS `no`,`t_notice`.`kind` AS `kind`,`t_notice`.`title` AS `title`,`t_notice`.`content` AS `content`,`t_notice`.`shop_no` AS `shop_no`,`t_notice`.`date` AS `date`,`t_notice`.`image` AS `image`,`t_notice`.`agree` AS `agree`,`t_notice`.`created_by` AS `created_by`,`t_shop`.`name` AS `name` from (`t_notice` left join `t_shop` on((`t_notice`.`shop_no` = `t_shop`.`no`))); ;

-- ----------------------------
-- View structure for v_shop
-- ----------------------------
DROP VIEW IF EXISTS `v_shop`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_shop` AS select `t_shop`.`no` AS `no`,`t_shop`.`name` AS `name`,`t_shop`.`province_no` AS `province_no`,`t_shop`.`county_no` AS `county_no`,`t_shop`.`address` AS `address`,`t_shop`.`tel_no` AS `tel_no`,`t_shop`.`image` AS `image`,`t_province`.`province_name` AS `province_name`,`t_county`.`county_name` AS `county_name` from ((`t_province` left join `t_shop` on((`t_shop`.`province_no` = `t_province`.`no`))) left join `t_county` on((`t_shop`.`county_no` = `t_county`.`no`))); ;

-- ----------------------------
-- View structure for v_tossup
-- ----------------------------
DROP VIEW IF EXISTS `v_tossup`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_tossup` AS select `t_tossup`.`no` AS `no`,`t_tossup`.`title` AS `title`,`t_tossup`.`content` AS `content`,`t_tossup`.`shop_no` AS `shop_no`,`t_tossup`.`date` AS `date`,`t_shop`.`name` AS `name`,`t_tossup`.`tossed` AS `tossed` from (`t_tossup` left join `t_shop` on((`t_tossup`.`shop_no` = `t_shop`.`no`))); ;
SET FOREIGN_KEY_CHECKS=1;
