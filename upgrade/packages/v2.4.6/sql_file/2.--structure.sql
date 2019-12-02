CREATE TABLE IF NOT EXISTS `dsc_order_delayed` (
  `delayed_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned NOT NULL,
  `apply_day` tinyint(2) unsigned NOT NULL,
  `apply_time` int(10) unsigned NOT NULL,
  `review_status` tinyint(1) unsigned NOT NULL,
  `review_time` int(10) unsigned NOT NULL,
  `review_admin` int(10) unsigned NOT NULL,
  PRIMARY KEY (`delayed_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `dsc_order_delayed` ADD INDEX  `order_id` (  `order_id` );

ALTER TABLE `dsc_goods` ADD INDEX `from_seller` (`from_seller`);

CREATE TABLE IF NOT EXISTS `dsc_seo` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `keywords` varchar(255) NOT NULL COMMENT '关键词',
  `description` text NOT NULL COMMENT '描述',
  `type` varchar(20) NOT NULL COMMENT '类型',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='SEO信息存放表' AUTO_INCREMENT=14 ;

ALTER TABLE `dsc_category` ADD `cate_title` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '关键词' AFTER `touch_icon`;

ALTER TABLE `dsc_category` ADD `cate_keywords` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '关键词' AFTER `cate_title`;

ALTER TABLE `dsc_category` ADD `cate_description` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '描述' AFTER `cate_keywords`;

ALTER TABLE  `dsc_cart` ADD  `is_invalid` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '购物车商品是否无效';

ALTER TABLE  `dsc_users` CHANGE  `pay_points`  `pay_points` INT( 10 ) NOT NULL DEFAULT  '0';