# 创建供应商
DROP TABLE `shop_supplier`;
CREATE TABLE `shop_supplier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `connecter` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '0',
  `create_time` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# SESSION表
DROP TABLE `shop_session`;
CREATE TABLE `shop_session` (
  `session_id` varchar(255) NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` blob,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# 品牌表
CREATE TABLE `shop_brand` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '0',
  `create_time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8

# 文章分类表
CREATE TABLE `shop_article_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8

# 文章表
CREATE TABLE `shop_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `content` text,
  `create_time` int(11) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8


# goods_category(商品分类)
CREATE TABLE shop_goods_category (
  id TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR (50) NOT NULL DEFAULT '' COMMENT '名称',
  parent_id TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '父分类',
  lft SMALLINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '左边界',
  rght SMALLINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '右边界',
  `level` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '级别',
  intro TEXT COMMENT '简介@textarea',
  `status` TINYINT NOT NULL DEFAULT 1 COMMENT '状态@radio|1=是&0=否',
  INDEX (parent_id),
  INDEX (lft, rght)
) ENGINE = MYISAM COMMENT '商品分类';

INSERT INTO shop_goods_category VALUES(1,'平板电视',9,3,4,3,'',1);
INSERT INTO shop_goods_category VALUES(2,'空调',9,5,6,3,'',1);
INSERT INTO shop_goods_category VALUES(3,'冰箱',9,7,8,3,'',1);
INSERT INTO shop_goods_category VALUES(4,'取暖器',8,11,14,3,'',1);
INSERT INTO shop_goods_category VALUES(5,'净化器',8,15,16,3,'',1);
INSERT INTO shop_goods_category VALUES(6,'加湿器',8,17,18,3,'',1);
INSERT INTO shop_goods_category VALUES(7,'小太阳',4,12,13,4,'',1);
INSERT INTO shop_goods_category VALUES(8,'生活电器',10,10,19,2,'',1);
INSERT INTO shop_goods_category VALUES(9,'大家电',10,2,9,2,'',1);
INSERT INTO shop_goods_category VALUES(10,'家用电器',0,1,20,1,'',1);

#商品基本信息表
CREATE TABLE shop_goods (
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR (50) NOT NULL DEFAULT '' COMMENT '名称',
  `sn` CHAR (15) NOT NULL DEFAULT '' COMMENT '货号',  # SN20150825000000000id
  `image` VARCHAR (150) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_category_id` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品分类',
  `brand_id` SMALLINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '品牌',
  `supplier_id` SMALLINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '供货商',
  `market_price` DECIMAL (10, 2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '市场价格',
  `shop_price` DECIMAL (10, 2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '本店价格',
  `stock` INT NOT NULL DEFAULT 0 COMMENT '库存',
  `goods_status` INT NOT NULL DEFAULT 0 COMMENT '商品状态',  #精品 新品 热销  使用二进制表示
  `is_on_sale` TINYINT NOT NULL DEFAULT 1 COMMENT '是否上架',  #1表示上架  0:不上架
  `status` TINYINT NOT NULL DEFAULT 1 COMMENT '状态@radio|1=是&0=否',
  `sort` TINYINT NOT NULL DEFAULT 20 COMMENT '排序',
  `inputtime` INT NOT NULL DEFAULT 0 COMMENT '录入时间',
  INDEX (`goods_category_id`),
  INDEX (`brand_id`),
  INDEX (`supplier_id`)
) ENGINE = INNODB COMMENT '商品'