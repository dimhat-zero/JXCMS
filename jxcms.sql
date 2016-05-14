/*
Navicat MySQL Data Transfer

Source Server         : php
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : jxcms

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2016-05-14 15:18:29
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('1', '老板', null, null, 'admin', '123456', null, '0');

-- ----------------------------
-- Table structure for enter_stock
-- ----------------------------
DROP TABLE IF EXISTS `enter_stock`;
CREATE TABLE `enter_stock` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) NOT NULL,
  `enter_date` datetime NOT NULL,
  `stock_house_id` bigint(20) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总价格（成本）',
  PRIMARY KEY (`id`),
  KEY `stock_house_id` (`stock_house_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `enter_stock_ibfk_1` FOREIGN KEY (`stock_house_id`) REFERENCES `stock_house` (`id`),
  CONSTRAINT `enter_stock_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of enter_stock
-- ----------------------------

-- ----------------------------
-- Table structure for enter_stock_detail
-- ----------------------------
DROP TABLE IF EXISTS `enter_stock_detail`;
CREATE TABLE `enter_stock_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `enter_stock_id` bigint(20) NOT NULL COMMENT '入库单号',
  `product_id` bigint(20) NOT NULL COMMENT '产品id',
  `quantity` double(10,2) NOT NULL COMMENT '数量',
  `unit_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  PRIMARY KEY (`id`),
  KEY `enter_stock_id` (`enter_stock_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `enter_stock_detail_ibfk_1` FOREIGN KEY (`enter_stock_id`) REFERENCES `enter_stock` (`id`),
  CONSTRAINT `enter_stock_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of enter_stock_detail
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `spec` varchar(20) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
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
-- Table structure for sale_detail
-- ----------------------------
DROP TABLE IF EXISTS `sale_detail`;
CREATE TABLE `sale_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sale_id` bigint(20) NOT NULL COMMENT '销售单号',
  `product_id` bigint(20) NOT NULL COMMENT '产品id',
  `quantity` double(10,2) NOT NULL COMMENT '数量',
  `unit_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  PRIMARY KEY (`id`),
  KEY `sale_id` (`sale_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `sale_detail_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`),
  CONSTRAINT `sale_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sale_detail
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
