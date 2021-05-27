/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 100417
Source Host           : localhost:3306
Source Database       : laravel

Target Server Type    : MYSQL
Target Server Version : 100417
File Encoding         : 65001

Date: 2021-05-27 11:48:46
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('1', 'root', 'root@mail.com', '$2y$10$FdJiSSrk8NwUTvAVOHeSAuY6Zl038ETUG.tArL3NuOCORfzMiPFAW', null, '2021-02-11 05:11:48', '2021-02-11 05:11:48');
INSERT INTO `t_admin` VALUES ('2', 'tester', 'test@mail.com', '$2y$10$z75yC9HqtAcIayo6gVl0XOhTf1wf9GkR2OkjometqqsC8MK3bc84K', null, '2021-02-22 02:34:51', '2021-02-22 02:34:51');

-- ----------------------------
-- Table structure for t_area
-- ----------------------------
DROP TABLE IF EXISTS `t_area`;
CREATE TABLE `t_area` (
  `code` varchar(16) DEFAULT NULL,
  `prefix` varchar(16) DEFAULT NULL,
  `postal` varchar(16) DEFAULT NULL,
  `huri_p` varchar(255) DEFAULT NULL,
  `huri_c` varchar(255) DEFAULT NULL,
  `huri_v` varchar(255) DEFAULT NULL,
  `name_p` varchar(64) DEFAULT NULL,
  `name_c` varchar(64) DEFAULT NULL,
  `name_v` varchar(255) DEFAULT NULL,
  `v1` int(11) DEFAULT NULL,
  `v2` int(11) DEFAULT NULL,
  `v3` int(11) DEFAULT NULL,
  `v4` int(11) DEFAULT NULL,
  `v5` int(11) DEFAULT NULL,
  `v6` int(11) DEFAULT NULL,
  KEY `IDX_AREA_CODE` (`code`,`prefix`,`postal`) USING BTREE,
  KEY `IDX_AREA_NAME` (`name_p`,`name_c`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_area
-- ----------------------------

-- ----------------------------
-- Table structure for t_atec
-- ----------------------------
DROP TABLE IF EXISTS `t_atec`;
CREATE TABLE `t_atec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kind` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_atec
-- ----------------------------

-- ----------------------------
-- Table structure for t_atec_confirm
-- ----------------------------
DROP TABLE IF EXISTS `t_atec_confirm`;
CREATE TABLE `t_atec_confirm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atec_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_atec_confirm
-- ----------------------------

-- ----------------------------
-- Table structure for t_bottle
-- ----------------------------
DROP TABLE IF EXISTS `t_bottle`;
CREATE TABLE `t_bottle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `use_type` int(2) NOT NULL COMMENT '1 : input,  2 : use, 3 : delete ',
  `amount` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `goods` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_bottle
-- ----------------------------

-- ----------------------------
-- Table structure for t_calculation
-- ----------------------------
DROP TABLE IF EXISTS `t_calculation`;
CREATE TABLE `t_calculation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `shop_id` int(11) NOT NULL,
  `sum1` float NOT NULL DEFAULT 0,
  `sum2` float NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_calculation
-- ----------------------------

-- ----------------------------
-- Table structure for t_calculation_goods
-- ----------------------------
DROP TABLE IF EXISTS `t_calculation_goods`;
CREATE TABLE `t_calculation_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calculation_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `other` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `price` float NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_calculation_goods
-- ----------------------------

-- ----------------------------
-- Table structure for t_carrying
-- ----------------------------
DROP TABLE IF EXISTS `t_carrying`;
CREATE TABLE `t_carrying` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `carrying_kind` int(11) NOT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `goods` varchar(255) NOT NULL,
  `face` int(11) DEFAULT NULL COMMENT '0:None 1:画面  2:裏面',
  `phone_kind` int(11) NOT NULL COMMENT '0:None 1:iPhone 2:android',
  `amount` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `notify` int(11) DEFAULT NULL COMMENT '0:None 1:3日後にWハルト通知する',
  `bottle_use` int(11) DEFAULT NULL,
  `bottle_use_amount` int(11) DEFAULT NULL,
  `performer` varchar(255) DEFAULT NULL,
  `c1` int(11) DEFAULT NULL,
  `c2` int(11) DEFAULT NULL,
  `c3` int(11) DEFAULT NULL,
  `c4` int(11) DEFAULT NULL,
  `c5` int(11) DEFAULT NULL,
  `c6` int(11) DEFAULT NULL,
  `c7` int(11) DEFAULT NULL,
  `c8` int(11) DEFAULT NULL,
  `sign_image` varchar(255) DEFAULT NULL,
  `sign_image_path` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_carrying
-- ----------------------------

-- ----------------------------
-- Table structure for t_carrying_goods
-- ----------------------------
DROP TABLE IF EXISTS `t_carrying_goods`;
CREATE TABLE `t_carrying_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(2) NOT NULL DEFAULT 0 COMMENT '0 : other 1 : phone',
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_carrying_goods
-- ----------------------------

-- ----------------------------
-- Table structure for t_carrying_history_image
-- ----------------------------
DROP TABLE IF EXISTS `t_carrying_history_image`;
CREATE TABLE `t_carrying_history_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrying_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_carrying_history_image
-- ----------------------------

-- ----------------------------
-- Table structure for t_coupon
-- ----------------------------
DROP TABLE IF EXISTS `t_coupon`;
CREATE TABLE `t_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT 0 COMMENT '0 :ハルト , 1 : ハルトtypeF',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `unit` int(11) NOT NULL DEFAULT 0 COMMENT '0 : 円引き, 1 : ％引き',
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `shop_id` int(11) NOT NULL,
  `reuse` int(2) NOT NULL DEFAULT 0 COMMENT '0 : 一回きり, 1 : 期間内無制限',
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `agree` int(2) NOT NULL DEFAULT 0,
  `stop` int(2) DEFAULT 0 COMMENT '0 : use, 1 : stop',
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`,`unit`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_coupon
-- ----------------------------

-- ----------------------------
-- Table structure for t_customer
-- ----------------------------
DROP TABLE IF EXISTS `t_customer`;
CREATE TABLE `t_customer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_huri` varchar(100) NOT NULL,
  `last_huri` varchar(100) NOT NULL,
  `name_japan` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `tel_no` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `member_no` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `resetPasswordToken` varchar(255) DEFAULT NULL COMMENT '암호재설정 임시 token',
  `transferCode` varchar(255) DEFAULT NULL COMMENT '인계코드설정(설정되지 않은 경우 0)',
  `transferCode_date` datetime DEFAULT NULL COMMENT '인계코드발행시간',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_customer
-- ----------------------------

-- ----------------------------
-- Table structure for t_customer_coupon
-- ----------------------------
DROP TABLE IF EXISTS `t_customer_coupon`;
CREATE TABLE `t_customer_coupon` (
  `f_id` int(10) NOT NULL AUTO_INCREMENT,
  `f_coupon` int(10) NOT NULL COMMENT '쿠폰아이디',
  `f_customer` int(10) NOT NULL COMMENT '사용자아이디',
  `f_state` int(10) NOT NULL DEFAULT 1 COMMENT '1: 사용중, 0: 사용완료',
  `f_expire_date` datetime DEFAULT NULL COMMENT '사용완료를 누른 날자',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_customer_coupon
-- ----------------------------

-- ----------------------------
-- Table structure for t_customer_inquiry_read
-- ----------------------------
DROP TABLE IF EXISTS `t_customer_inquiry_read`;
CREATE TABLE `t_customer_inquiry_read` (
  `f_id` int(10) NOT NULL AUTO_INCREMENT,
  `f_customer` int(10) NOT NULL COMMENT '고객아이디',
  `f_inquiry` int(10) NOT NULL COMMENT '읽은 수신메일아이디',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_customer_inquiry_read
-- ----------------------------

-- ----------------------------
-- Table structure for t_customer_verifynum
-- ----------------------------
DROP TABLE IF EXISTS `t_customer_verifynum`;
CREATE TABLE `t_customer_verifynum` (
  `f_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '유일아이디',
  `f_phone_number` varchar(20) DEFAULT NULL COMMENT '전화번호',
  `f_verify_number` varchar(10) DEFAULT NULL COMMENT '확인수값코드',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`f_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_customer_verifynum
-- ----------------------------

-- ----------------------------
-- Table structure for t_inquiry
-- ----------------------------
DROP TABLE IF EXISTS `t_inquiry`;
CREATE TABLE `t_inquiry` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `shop` int(2) NOT NULL,
  `content` text NOT NULL,
  `customer` int(11) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `kind` bit(1) NOT NULL DEFAULT b'0' COMMENT '0: 문의, 1: 내정예약',
  `isReply` bit(1) NOT NULL DEFAULT b'0' COMMENT '0: 회답안한상태, 1:회답한 상태',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `IDX_INQUERY` (`shop`,`customer`,`sender`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_inquiry
-- ----------------------------

-- ----------------------------
-- Table structure for t_license
-- ----------------------------
DROP TABLE IF EXISTS `t_license`;
CREATE TABLE `t_license` (
  `f_privacy` varchar(1024) DEFAULT NULL,
  `f_use` varchar(1024) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_license
-- ----------------------------

-- ----------------------------
-- Table structure for t_manager
-- ----------------------------
DROP TABLE IF EXISTS `t_manager`;
CREATE TABLE `t_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `real_password` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `store` varchar(255) NOT NULL,
  `allow` int(2) DEFAULT 0 COMMENT '1: 허가 0:금지',
  `access_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `device_id` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_manager
-- ----------------------------

-- ----------------------------
-- Table structure for t_manual
-- ----------------------------
DROP TABLE IF EXISTS `t_manual`;
CREATE TABLE `t_manual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_manual
-- ----------------------------

-- ----------------------------
-- Table structure for t_map_area
-- ----------------------------
DROP TABLE IF EXISTS `t_map_area`;
CREATE TABLE `t_map_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `x1` int(255) NOT NULL DEFAULT 0,
  `y1` varchar(255) NOT NULL DEFAULT '0',
  `x2` varchar(255) NOT NULL DEFAULT '0',
  `y2` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_map_area
-- ----------------------------
INSERT INTO `t_map_area` VALUES ('1', '長崎県', '4', '434', '42', '522');
INSERT INTO `t_map_area` VALUES ('2', '佐賀県', '44', '434', '82', '522');
INSERT INTO `t_map_area` VALUES ('3', '福岡県', '84', '434', '142', '522');
INSERT INTO `t_map_area` VALUES ('4', '熊本県', '84', '524', '142', '612');
INSERT INTO `t_map_area` VALUES ('5', '鹿児島県', '84', '614', '182', '672');
INSERT INTO `t_map_area` VALUES ('6', '沖縄県', '84', '694', '122', '752');
INSERT INTO `t_map_area` VALUES ('7', '福岡県', '143', '434', '182', '472');
INSERT INTO `t_map_area` VALUES ('8', '大分県', '144', '474', '182', '542');
INSERT INTO `t_map_area` VALUES ('9', '宮崎県', '144', '544', '182', '612');
INSERT INTO `t_map_area` VALUES ('10', '山口県', '204', '434', '242', '552');
INSERT INTO `t_map_area` VALUES ('11', '愛媛県', '204', '574', '272', '622');
INSERT INTO `t_map_area` VALUES ('12', '高知県', '204', '624', '272', '672');
INSERT INTO `t_map_area` VALUES ('13', '島根県', '244', '434', '282', '492');
INSERT INTO `t_map_area` VALUES ('14', '広島県', '244', '494', '282', '552');
INSERT INTO `t_map_area` VALUES ('15', '香川県', '274', '574', '342', '622');
INSERT INTO `t_map_area` VALUES ('16', '徳島県', '274', '624', '342', '672');
INSERT INTO `t_map_area` VALUES ('17', '鳥取県', '284', '434', '322', '492');
INSERT INTO `t_map_area` VALUES ('18', '岡山県', '284', '494', '322', '552');
INSERT INTO `t_map_area` VALUES ('19', '兵庫県', '324', '434', '362', '552');
INSERT INTO `t_map_area` VALUES ('20', '京都府', '364', '434', '402', '532');
INSERT INTO `t_map_area` VALUES ('21', '大阪府', '364', '534', '402', '602');
INSERT INTO `t_map_area` VALUES ('22', '和歌山県', '364', '604', '402', '672');
INSERT INTO `t_map_area` VALUES ('23', '京都府', '403', '474', '442', '532');
INSERT INTO `t_map_area` VALUES ('24', '和歌山県', '403', '634', '442', '672');
INSERT INTO `t_map_area` VALUES ('25', '福井県', '404', '434', '482', '472');
INSERT INTO `t_map_area` VALUES ('26', '奈良県', '404', '534', '442', '632');
INSERT INTO `t_map_area` VALUES ('27', '石川県', '444', '334', '482', '412');
INSERT INTO `t_map_area` VALUES ('28', '福井県', '444', '414', '482', '472');
INSERT INTO `t_map_area` VALUES ('29', '滋賀県', '444', '474', '482', '532');
INSERT INTO `t_map_area` VALUES ('30', '三重県', '444', '534', '482', '672');
INSERT INTO `t_map_area` VALUES ('31', '富山県', '484', '354', '542', '412');
INSERT INTO `t_map_area` VALUES ('32', '岐阜県', '484', '414', '522', '572');
INSERT INTO `t_map_area` VALUES ('33', '愛知県', '484', '574', '542', '632');
INSERT INTO `t_map_area` VALUES ('34', '長野県', '524', '414', '562', '572');
INSERT INTO `t_map_area` VALUES ('35', '新潟県', '544', '354', '622', '412');
INSERT INTO `t_map_area` VALUES ('36', '静岡県', '544', '574', '592', '632');
INSERT INTO `t_map_area` VALUES ('37', '長野県', '563', '414', '592', '522');
INSERT INTO `t_map_area` VALUES ('38', '山梨県', '564', '524', '622', '572');
INSERT INTO `t_map_area` VALUES ('39', '静岡県', '593', '604', '622', '632');
INSERT INTO `t_map_area` VALUES ('40', '北海道', '594', '4', '652', '162');
INSERT INTO `t_map_area` VALUES ('41', '青森県', '594', '184', '752', '232');
INSERT INTO `t_map_area` VALUES ('42', '秋田県', '594', '234', '672', '292');
INSERT INTO `t_map_area` VALUES ('43', '山形県', '594', '294', '672', '332');
INSERT INTO `t_map_area` VALUES ('44', '新潟県', '594', '334', '622', '412');
INSERT INTO `t_map_area` VALUES ('45', '群馬県', '594', '414', '652', '472');
INSERT INTO `t_map_area` VALUES ('46', '埼玉県', '594', '474', '712', '522');
INSERT INTO `t_map_area` VALUES ('47', '神奈川県', '594', '574', '682', '602');
INSERT INTO `t_map_area` VALUES ('48', '山形県', '624', '332', '672', '352');
INSERT INTO `t_map_area` VALUES ('49', '福島県', '624', '354', '752', '412');
INSERT INTO `t_map_area` VALUES ('50', '東京都', '624', '524', '682', '572');
INSERT INTO `t_map_area` VALUES ('51', '神奈川県', '624', '602', '682', '632');
INSERT INTO `t_map_area` VALUES ('52', '北海道', '653', '4', '812', '142');
INSERT INTO `t_map_area` VALUES ('53', '栃木県', '654', '414', '712', '472');
INSERT INTO `t_map_area` VALUES ('54', '岩手県', '674', '234', '752', '292');
INSERT INTO `t_map_area` VALUES ('55', '宮城県', '674', '294', '752', '352');
INSERT INTO `t_map_area` VALUES ('56', '東京都', '683', '524', '712', '552');
INSERT INTO `t_map_area` VALUES ('57', '茨城県', '714', '414', '752', '492');
INSERT INTO `t_map_area` VALUES ('58', '千葉県', '714', '494', '752', '632');

-- ----------------------------
-- Table structure for t_myshop
-- ----------------------------
DROP TABLE IF EXISTS `t_myshop`;
CREATE TABLE `t_myshop` (
  `f_id` int(10) NOT NULL AUTO_INCREMENT,
  `f_customer_id` int(10) NOT NULL DEFAULT 0 COMMENT '고객아이디(t_customer표의 아이디)',
  `f_shop_id` int(10) NOT NULL DEFAULT 0 COMMENT '상점아이디(t_shop표의 아이디)',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_myshop
-- ----------------------------

-- ----------------------------
-- Table structure for t_notice
-- ----------------------------
DROP TABLE IF EXISTS `t_notice`;
CREATE TABLE `t_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kind` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `shop_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `agree` int(1) NOT NULL DEFAULT 0,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_notice
-- ----------------------------

-- ----------------------------
-- Table structure for t_policy
-- ----------------------------
DROP TABLE IF EXISTS `t_policy`;
CREATE TABLE `t_policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `policy` text DEFAULT NULL,
  `privacy` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_policy
-- ----------------------------

-- ----------------------------
-- Table structure for t_shop
-- ----------------------------
DROP TABLE IF EXISTS `t_shop`;
CREATE TABLE `t_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `tel_no` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `area_id` int(10) NOT NULL DEFAULT 0 COMMENT '지역아이디(t_area표의 f_id)',
  `image_path` varchar(255) DEFAULT NULL,
  `docomo` int(1) NOT NULL DEFAULT 0 COMMENT '도코모숍인 경우 1',
  `link` varchar(255) DEFAULT NULL COMMENT '도코모숍인 경우 예약링크URL',
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_shop
-- ----------------------------

-- ----------------------------
-- Table structure for t_shop_image
-- ----------------------------
DROP TABLE IF EXISTS `t_shop_image`;
CREATE TABLE `t_shop_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_shop_image
-- ----------------------------

-- ----------------------------
-- Table structure for t_shop_reserve
-- ----------------------------
DROP TABLE IF EXISTS `t_shop_reserve`;
CREATE TABLE `t_shop_reserve` (
  `f_id` int(10) NOT NULL AUTO_INCREMENT,
  `f_customer_id` int(10) NOT NULL DEFAULT 0 COMMENT '고객아이디',
  `f_shop_id` int(10) NOT NULL DEFAULT 0 COMMENT '점포아이디',
  `f_reserve_date` date NOT NULL COMMENT '예약일자',
  `f_reserve_time` int(10) NOT NULL COMMENT '예약시간(t_time_list표의 아이디)아이디',
  `f_reserve_purpose` varchar(255) DEFAULT NULL COMMENT '예약용건',
  `f_other` varchar(1024) DEFAULT NULL COMMENT '기타 고객이 예약시 입력한 본문내용',
  `f_confirm` bit(1) NOT NULL DEFAULT b'0' COMMENT '확인정형(1:확인, 0: 불확인)',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_shop_reserve
-- ----------------------------

-- ----------------------------
-- Table structure for t_shop_rest_date
-- ----------------------------
DROP TABLE IF EXISTS `t_shop_rest_date`;
CREATE TABLE `t_shop_rest_date` (
  `f_id` int(10) NOT NULL AUTO_INCREMENT,
  `f_shop_id` int(10) NOT NULL DEFAULT 0 COMMENT '상점아이디',
  `f_rest_date` date NOT NULL COMMENT '휴식일',
  `f_rest_type` int(10) NOT NULL DEFAULT 1 COMMENT '휴식일형태(정기휴일, 명절, 임시휴일)',
  `f_rest_time` int(10) NOT NULL DEFAULT 0 COMMENT '휴식시간아이디(t_time표의아이디, 0인경우 그날 전체 휴식)',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_shop_rest_date
-- ----------------------------

-- ----------------------------
-- Table structure for t_time_list
-- ----------------------------
DROP TABLE IF EXISTS `t_time_list`;
CREATE TABLE `t_time_list` (
  `f_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '아이디',
  `f_time` varchar(255) DEFAULT NULL COMMENT '시간',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_time_list
-- ----------------------------

-- ----------------------------
-- Table structure for t_tossup
-- ----------------------------
DROP TABLE IF EXISTS `t_tossup`;
CREATE TABLE `t_tossup` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `shop` int(2) NOT NULL DEFAULT 0,
  `content` text NOT NULL,
  `tossed` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_tossup
-- ----------------------------

-- ----------------------------
-- View structure for v_atec_shop
-- ----------------------------
DROP VIEW IF EXISTS `v_atec_shop`;
CREATE ALGORITHM=UNDEFINED DEFINER=`laravel`@`%` SQL SECURITY DEFINER  VIEW `v_atec_shop` AS select `t_atec`.`id` AS `id`,`t_atec`.`kind` AS `kind`,`t_atec`.`title` AS `title`,`t_atec`.`content` AS `content`,`t_atec`.`image` AS `image`,`t_atec`.`created_at` AS `created_at`,`t_atec`.`updated_at` AS `updated_at`,`t_atec_confirm`.`shop_id` AS `shop_id`,`t_atec`.`image_path` AS `image_path` from (`t_atec` left join `t_atec_confirm` on((`t_atec`.`id` = `t_atec_confirm`.`atec_id`))) ;

-- ----------------------------
-- View structure for v_carrying
-- ----------------------------
DROP VIEW IF EXISTS `v_carrying`;
CREATE ALGORITHM=UNDEFINED DEFINER=`laravel`@`%` SQL SECURITY DEFINER  VIEW `v_carrying` AS select `t_carrying`.`id` AS `id`,`t_carrying`.`shop_id` AS `shop_id`,`t_carrying`.`customer_id` AS `customer_id`,`t_carrying`.`serial_no` AS `serial_no`,`t_carrying`.`carrying_kind` AS `carrying_kind`,`t_carrying`.`goods_id` AS `goods_id`,`t_carrying`.`goods` AS `goods`,`t_carrying`.`face` AS `face`,`t_carrying`.`phone_kind` AS `phone_kind`,`t_carrying`.`amount` AS `amount`,`t_carrying`.`price` AS `price`,`t_carrying`.`notify` AS `notify`,`t_carrying`.`bottle_use` AS `bottle_use`,`t_carrying`.`bottle_use_amount` AS `bottle_use_amount`,`t_carrying`.`performer` AS `performer`,`t_carrying`.`c1` AS `c1`,`t_carrying`.`c2` AS `c2`,`t_carrying`.`c3` AS `c3`,`t_carrying`.`c4` AS `c4`,`t_carrying`.`c5` AS `c5`,`t_carrying`.`c6` AS `c6`,`t_carrying`.`c7` AS `c7`,`t_carrying`.`c8` AS `c8`,`t_carrying`.`sign_image` AS `sign_image`,`t_carrying`.`sign_image_path` AS `sign_image_path`,`t_carrying`.`date` AS `date`,`t_carrying`.`created_at` AS `created_at`,`t_carrying`.`updated_at` AS `updated_at`,`t_shop`.`name` AS `shop_name`,`t_carrying_goods`.`image` AS `image`,`t_carrying_goods`.`image_path` AS `image_path`,`t_carrying_goods`.`type` AS `type`,`t_shop`.`docomo` AS `docomo` from ((`t_carrying` left join `t_shop` on((`t_shop`.`id` = `t_carrying`.`shop_id`))) left join `t_carrying_goods` on((`t_carrying`.`goods_id` = `t_carrying_goods`.`id`))) ;

-- ----------------------------
-- View structure for v_coupon
-- ----------------------------
DROP VIEW IF EXISTS `v_coupon`;
CREATE ALGORITHM=UNDEFINED DEFINER=`laravel`@`%` SQL SECURITY DEFINER  VIEW `v_coupon` AS select `t_coupon`.`id` AS `id`,`t_coupon`.`title` AS `title`,`t_coupon`.`content` AS `content`,date_format(`t_coupon`.`from_date`,'%Y/%m/%d') AS `from_date`,date_format(`t_coupon`.`to_date`,'%Y/%m/%d') AS `to_date`,`t_coupon`.`shop_id` AS `shop_id`,`t_coupon`.`reuse` AS `reuse`,`t_coupon`.`image` AS `image`,`t_coupon`.`agree` AS `agree`,`t_coupon`.`created_at` AS `created_at`,`t_coupon`.`updated_at` AS `updated_at`,`t_shop`.`name` AS `shop_name`,`t_coupon`.`created_by` AS `created_by`,`t_coupon`.`image_path` AS `image_path`,`t_coupon`.`type` AS `type`,`t_coupon`.`amount` AS `amount`,`t_coupon`.`unit` AS `unit`,`t_coupon`.`stop` AS `stop` from (`t_coupon` left join `t_shop` on((`t_coupon`.`shop_id` = `t_shop`.`id`))) ;

-- ----------------------------
-- View structure for v_customer_coupon
-- ----------------------------
DROP VIEW IF EXISTS `v_customer_coupon`;
CREATE ALGORITHM=UNDEFINED DEFINER=`laravel`@`%` SQL SECURITY DEFINER  VIEW `v_customer_coupon` AS select `t_customer_coupon`.`f_id` AS `f_id`,`t_customer_coupon`.`f_coupon` AS `f_coupon`,`t_customer_coupon`.`f_customer` AS `f_customer`,`t_coupon`.`from_date` AS `from_date`,`t_coupon`.`to_date` AS `to_date`,`t_coupon`.`title` AS `title`,`t_coupon`.`content` AS `content`,`t_coupon`.`shop_id` AS `shop_id`,`t_coupon`.`image` AS `image`,`t_coupon`.`image_path` AS `image_path`,`t_customer_coupon`.`created_at` AS `created_at`,`t_customer_coupon`.`updated_at` AS `updated_at`,`t_coupon`.`type` AS `type`,`t_coupon`.`amount` AS `amount`,`t_coupon`.`unit` AS `unit`,`t_coupon`.`reuse` AS `reuse`,`t_customer_coupon`.`f_state` AS `f_state`,`t_customer_coupon`.`f_expire_date` AS `f_expire_date` from (`t_customer_coupon` left join `t_coupon` on((`t_customer_coupon`.`f_coupon` = `t_coupon`.`id`))) ;

-- ----------------------------
-- View structure for v_inquiry
-- ----------------------------
DROP VIEW IF EXISTS `v_inquiry`;
CREATE ALGORITHM=UNDEFINED DEFINER=`laravel`@`%` SQL SECURITY DEFINER  VIEW `v_inquiry` AS select `t_inquiry`.`id` AS `id`,`t_inquiry`.`shop` AS `shop`,`t_inquiry`.`content` AS `content`,`t_inquiry`.`customer` AS `customer`,`t_inquiry`.`sender` AS `sender`,`t_inquiry`.`reply` AS `reply`,`t_inquiry`.`created_at` AS `created_at`,`t_inquiry`.`updated_at` AS `updated_at`,`t_customer`.`name` AS `customer_name`,`A`.`name` AS `shop_name`,`B`.`name` AS `sender_name` from (((`t_inquiry` left join `t_customer` on((`t_inquiry`.`customer` = `t_customer`.`id`))) left join `t_shop` `A` on((`t_inquiry`.`shop` = `A`.`id`))) left join `t_shop` `B` on((`B`.`id` = `t_inquiry`.`sender`))) ;

-- ----------------------------
-- View structure for v_manager
-- ----------------------------
DROP VIEW IF EXISTS `v_manager`;
CREATE ALGORITHM=UNDEFINED DEFINER=`laravel`@`%` SQL SECURITY DEFINER  VIEW `v_manager` AS select `t_manager`.`id` AS `id`,`t_manager`.`real_password` AS `real_password`,`t_manager`.`name` AS `name`,`t_manager`.`password` AS `password`,`t_manager`.`store` AS `store`,`t_manager`.`allow` AS `allow`,`t_manager`.`access_token` AS `access_token`,`t_manager`.`created_at` AS `created_at`,`t_manager`.`updated_at` AS `updated_at`,`t_manager`.`device_id` AS `device_id`,`t_shop`.`name` AS `shop_name` from (`t_manager` join `t_shop` on((`t_manager`.`store` = `t_shop`.`id`))) ;

-- ----------------------------
-- View structure for v_my_shop
-- ----------------------------
DROP VIEW IF EXISTS `v_my_shop`;
CREATE ALGORITHM=UNDEFINED DEFINER=`laravel`@`%` SQL SECURITY DEFINER  VIEW `v_my_shop` AS select `t_myShop`.`f_id` AS `f_id`,`t_myShop`.`f_customer_id` AS `f_customer_id`,`t_myShop`.`f_shop_id` AS `f_shop_id`,`t_myShop`.`created_at` AS `created_at`,`t_myShop`.`updated_at` AS `updated_at`,`t_shop`.`name` AS `name`,`t_shop`.`image_path` AS `image_path`,`t_shop`.`address` AS `address`,`t_shop`.`postal` AS `postal`,`t_shop`.`tel_no` AS `tel_no`,`t_shop`.`docomo` AS `docomo` from (`t_shop` left join `t_myShop` on((`t_myShop`.`f_shop_id` = `t_shop`.`id`))) ;

-- ----------------------------
-- View structure for v_notice
-- ----------------------------
DROP VIEW IF EXISTS `v_notice`;
CREATE ALGORITHM=UNDEFINED DEFINER=`laravel`@`%` SQL SECURITY DEFINER  VIEW `v_notice` AS select `t_notice`.`id` AS `id`,`t_notice`.`kind` AS `kind`,`t_notice`.`title` AS `title`,`t_notice`.`content` AS `content`,`t_notice`.`shop_id` AS `shop_id`,`t_notice`.`image` AS `image`,`t_notice`.`agree` AS `agree`,`t_notice`.`created_by` AS `created_by`,`t_notice`.`created_at` AS `created_at`,`t_notice`.`updated_at` AS `updated_at`,`t_shop`.`name` AS `shop_name`,`t_notice`.`image_path` AS `image_path` from (`t_notice` left join `t_shop` on((`t_notice`.`shop_id` = `t_shop`.`id`))) ;

-- ----------------------------
-- View structure for v_shop
-- ----------------------------
DROP VIEW IF EXISTS `v_shop`;
CREATE ALGORITHM=UNDEFINED DEFINER=`laravel`@`%` SQL SECURITY DEFINER  VIEW `v_shop` AS select `t_shop`.`id` AS `id`,`t_shop`.`name` AS `name`,`t_shop`.`address` AS `address`,`t_shop`.`postal` AS `postal`,`t_shop`.`tel_no` AS `tel_no`,`t_shop`.`image` AS `image`,`t_shop`.`area_id` AS `area_id`,`t_shop`.`image_path` AS `image_path`,`t_shop`.`docomo` AS `docomo`,`t_shop`.`link` AS `link`,`t_shop`.`created_at` AS `created_at`,`t_shop`.`updated_at` AS `updated_at`,`t_area`.`name_p` AS `name_p`,`t_area`.`name_c` AS `name_c`,`t_area`.`name_v` AS `name_v` from (`t_shop` left join `t_area` on((`t_shop`.`postal` = `t_area`.`postal`))) ;

-- ----------------------------
-- View structure for v_tossup
-- ----------------------------
DROP VIEW IF EXISTS `v_tossup`;
CREATE ALGORITHM=UNDEFINED DEFINER=`laravel`@`%` SQL SECURITY DEFINER  VIEW `v_tossup` AS select `t_tossup`.`id` AS `id`,`t_tossup`.`shop` AS `shop`,`t_tossup`.`content` AS `content`,`t_tossup`.`tossed` AS `tossed`,`t_tossup`.`created_at` AS `created_at`,`t_tossup`.`updated_at` AS `updated_at`,`t_shop`.`name` AS `shop_name` from (`t_tossup` left join `t_shop` on((`t_tossup`.`shop` = `t_shop`.`id`))) ;
SET FOREIGN_KEY_CHECKS=1;
