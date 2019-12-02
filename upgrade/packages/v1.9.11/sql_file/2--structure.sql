ALTER TABLE `dsc_cart` ADD COLUMN `is_checked`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '选中状态，0未选中，1选中';

ALTER TABLE  `dsc_order_return` ADD  `return_time` VARCHAR( 120 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `apply_time`;

ALTER TABLE `dsc_users_auth` ADD INDEX ( `identifier` ) ;

ALTER TABLE `dsc_pic_album` ADD `pic_image` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `pic_thumb`;

DROP TABLE IF EXISTS `dsc_open_api`;
CREATE TABLE `dsc_open_api` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL DEFAULT '',
  `app_key` varchar(225) NOT NULL DEFAULT '',
  `action_code` text NOT NULL,
  `is_open` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_key` (`app_key`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;