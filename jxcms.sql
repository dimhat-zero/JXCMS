/*
Navicat MySQL Data Transfer

Source Server         : php
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : jxcms

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2016-05-18 19:09:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '中药', '中药类别');
INSERT INTO `category` VALUES ('2', '保健品', null);
INSERT INTO `category` VALUES ('3', '花茶', null);
INSERT INTO `category` VALUES ('4', '我的类别', '测试类别');
INSERT INTO `category` VALUES ('15', '其他', '');

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_card` varchar(50) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1表示普通员工，0表示管理员',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('1', '老板', null, null, 'admin', '123456', null, '0', '1');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `spec` varchar(20) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1096 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', '我的保健品', '16*16', '盒', '998.00', '3');
INSERT INTO `product` VALUES ('5', '茉莉花茶', '我', 'g', '15.00', '3');
INSERT INTO `product` VALUES ('6', '菊花茶', '33', '想', '0.00', '1');
INSERT INTO `product` VALUES ('7', '产品1', '', '', '3.20', '1');
INSERT INTO `product` VALUES ('8', '我是新增，2', '打', '', '56.00', '1');
INSERT INTO `product` VALUES ('9', '产品3', '', '', '0.00', '15');
INSERT INTO `product` VALUES ('10', '啊', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('11', '啊', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('12', '啊', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('13', '啊', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('14', '啊', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('15', '啊', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('16', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('17', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('18', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('996', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('998', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('999', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1000', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1001', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1002', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1003', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1004', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1005', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1006', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1007', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1008', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1009', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1010', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1011', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1012', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1013', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1014', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1015', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1016', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1017', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1018', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1019', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1020', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1021', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1022', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1023', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1024', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1025', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1026', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1027', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1028', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1029', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1030', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1031', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1032', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1033', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1034', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1035', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1036', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1037', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1038', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1039', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1040', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1041', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1042', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1043', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1044', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1045', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1046', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1047', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1048', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1049', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1050', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1051', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1052', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1053', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1054', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1055', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1056', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1057', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1058', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1059', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1060', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1061', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1062', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1063', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1064', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1065', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1066', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1067', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1068', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1069', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1070', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1071', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1072', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1073', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1074', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1075', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1076', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1077', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1078', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1079', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1080', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1081', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1082', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1083', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1084', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1085', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1086', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1087', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1088', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1089', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1090', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1091', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1092', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1093', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1094', '我的产品', '', '', '0.00', '1');
INSERT INTO `product` VALUES ('1095', '我的产品', '', '', '0.00', '1');

-- ----------------------------
-- Table structure for purchase
-- ----------------------------
DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `stock_house_id` bigint(20) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价格（成本）',
  PRIMARY KEY (`id`),
  KEY `stock_house_id` (`stock_house_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`stock_house_id`) REFERENCES `stock_house` (`id`),
  CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchase
-- ----------------------------

-- ----------------------------
-- Table structure for purchase_item
-- ----------------------------
DROP TABLE IF EXISTS `purchase_item`;
CREATE TABLE `purchase_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `purchase_id` bigint(20) NOT NULL COMMENT '入库单号',
  `product_id` bigint(20) NOT NULL COMMENT '产品id',
  `quantity` double(10,2) NOT NULL COMMENT '数量',
  `unit_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  PRIMARY KEY (`id`),
  KEY `enter_stock_id` (`purchase_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `purchase_item_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`),
  CONSTRAINT `purchase_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchase_item
-- ----------------------------

-- ----------------------------
-- Table structure for sale
-- ----------------------------
DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) NOT NULL,
  `enter_date` datetime NOT NULL,
  `stock_house_id` bigint(20) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价格（成本）',
  PRIMARY KEY (`id`),
  KEY `stock_house_id` (`stock_house_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`stock_house_id`) REFERENCES `stock_house` (`id`),
  CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sale
-- ----------------------------

-- ----------------------------
-- Table structure for sale_item
-- ----------------------------
DROP TABLE IF EXISTS `sale_item`;
CREATE TABLE `sale_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sale_id` bigint(20) NOT NULL COMMENT '销售单号',
  `product_id` bigint(20) NOT NULL COMMENT '产品id',
  `quantity` double(10,2) NOT NULL COMMENT '数量',
  `unit_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  PRIMARY KEY (`id`),
  KEY `sale_id` (`sale_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `sale_item_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`),
  CONSTRAINT `sale_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sale_item
-- ----------------------------

-- ----------------------------
-- Table structure for stock_house
-- ----------------------------
DROP TABLE IF EXISTS `stock_house`;
CREATE TABLE `stock_house` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stock_house
-- ----------------------------

-- ----------------------------
-- Table structure for stock_pile
-- ----------------------------
DROP TABLE IF EXISTS `stock_pile`;
CREATE TABLE `stock_pile` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stock_house_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_house_id` (`stock_house_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `stock_pile_ibfk_1` FOREIGN KEY (`stock_house_id`) REFERENCES `stock_house` (`id`),
  CONSTRAINT `stock_pile_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stock_pile
-- ----------------------------
