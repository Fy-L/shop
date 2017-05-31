-- MySQL dump 10.13  Distrib 5.6.27, for Linux (i686)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	5.6.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `shop_admin`
--

DROP TABLE IF EXISTS `shop_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员编号',
  `admin_name` varchar(30) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_admin`
--

LOCK TABLES `shop_admin` WRITE;
/*!40000 ALTER TABLE `shop_admin` DISABLE KEYS */;
INSERT INTO `shop_admin` VALUES (1,'admin','a66abb5684c45962d887564f08346e8d','admin@itcast.cn',0);
/*!40000 ALTER TABLE `shop_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_attribute`
--

DROP TABLE IF EXISTS `shop_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_attribute` (
  `attr_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品属性ID',
  `attr_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品属性名称',
  `type_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '商品属性所属类型ID',
  `attr_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性是否可选 0 为唯一，1为单选，2为多选',
  `attr_input_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性录入方式 0为手工录入，1为从列表中选择，2为文本域',
  `attr_value` text COMMENT '属性的值',
  `sort_order` tinyint(4) NOT NULL DEFAULT '50' COMMENT '属性排序依据',
  PRIMARY KEY (`attr_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_attribute`
--

LOCK TABLES `shop_attribute` WRITE;
/*!40000 ALTER TABLE `shop_attribute` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_brand`
--

DROP TABLE IF EXISTS `shop_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_brand` (
  `brand_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品品牌ID',
  `brand_name` varchar(30) NOT NULL DEFAULT '' COMMENT '商品品牌名称',
  `brand_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '商品品牌描述',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '商品品牌网址',
  `logo` varchar(255) DEFAULT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '50' COMMENT '商品品牌排序依据',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示，默认显示',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_brand`
--

LOCK TABLES `shop_brand` WRITE;
/*!40000 ALTER TABLE `shop_brand` DISABLE KEYS */;
INSERT INTO `shop_brand` VALUES (7,'耐克1','0222223333','www.nike.com','/uploads/20170601/6eb619c0f543dfe62c428ecd602d5858.jpg',10,1);
/*!40000 ALTER TABLE `shop_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_category`
--

DROP TABLE IF EXISTS `shop_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品类别ID',
  `cat_name` varchar(30) NOT NULL DEFAULT '' COMMENT '商品类别名称',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品类别父ID',
  `cat_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '商品类别描述',
  `sort_order` tinyint(4) NOT NULL DEFAULT '50' COMMENT '排序依据',
  `unit` varchar(15) NOT NULL DEFAULT '' COMMENT '单位',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示，默认显示',
  PRIMARY KEY (`cat_id`),
  KEY `pid` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_category`
--

LOCK TABLES `shop_category` WRITE;
/*!40000 ALTER TABLE `shop_category` DISABLE KEYS */;
INSERT INTO `shop_category` VALUES (1,'服装',0,'男女服装',10,'件',1),(3,'女装',1,'',30,'件',1),(5,'连衣裙',3,'',50,'件',1),(6,'电子产品',0,'电子产品',50,'件',1),(7,'手机',6,'手机',60,'台',1),(8,'电脑',6,'电脑',50,'台',1);
/*!40000 ALTER TABLE `shop_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_goods`
--

DROP TABLE IF EXISTS `shop_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `goods_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '商品货号',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_brief` varchar(255) NOT NULL DEFAULT '' COMMENT '商品简单描述',
  `goods_desc` text COMMENT '商品详情',
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品所属类别ID',
  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品所属品牌ID',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价格',
  `promote_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价格',
  `promote_start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销起始时间',
  `promote_end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销截止时间',
  `goods_img` varchar(50) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_thumb` varchar(50) NOT NULL DEFAULT '' COMMENT '商品缩略图',
  `goods_number` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品库存',
  `click_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型ID',
  `is_promote` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否促销，默认为0不促销',
  `is_best` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否精品,默认为0',
  `is_new` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否新品，默认为0',
  `is_hot` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否热卖,默认为0',
  `is_onsale` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架,默认为1',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`goods_id`),
  KEY `cat_id` (`cat_id`),
  KEY `brand_id` (`brand_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_goods`
--

LOCK TABLES `shop_goods` WRITE;
/*!40000 ALTER TABLE `shop_goods` DISABLE KEYS */;
INSERT INTO `shop_goods` VALUES (1,'ECS000032','衣服测试','','',4,7,3612.00,3010.00,0.00,1243785600,1417276800,'','',4,0,1,0,1,1,1,1,1496241892);
/*!40000 ALTER TABLE `shop_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_goods_attr`
--

DROP TABLE IF EXISTS `shop_goods_attr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_goods_attr` (
  `goods_attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号ID',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `attr_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '属性ID',
  `attr_value` varchar(255) NOT NULL DEFAULT '' COMMENT '属性值',
  `attr_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '属性价格',
  PRIMARY KEY (`goods_attr_id`),
  KEY `goods_id` (`goods_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_goods_attr`
--

LOCK TABLES `shop_goods_attr` WRITE;
/*!40000 ALTER TABLE `shop_goods_attr` DISABLE KEYS */;
INSERT INTO `shop_goods_attr` VALUES (1,1,1,'22\r\n',0.00),(2,1,2,'22222',0.00);
/*!40000 ALTER TABLE `shop_goods_attr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_goods_type`
--

DROP TABLE IF EXISTS `shop_goods_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_goods_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品类型ID',
  `type_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品类型名称',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_goods_type`
--

LOCK TABLES `shop_goods_type` WRITE;
/*!40000 ALTER TABLE `shop_goods_type` DISABLE KEYS */;
INSERT INTO `shop_goods_type` VALUES (1,'手机');
/*!40000 ALTER TABLE `shop_goods_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-01  4:08:14
