ALTER TABLE `dsc_seller_shopinfo` ADD `seller_templates` VARCHAR( 160 ) NOT NULL ;

ALTER TABLE `dsc_seller_shopinfo` ADD `templates_mode` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_admin_action` ADD `seller_show` TINYINT( 5 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `relevance`;

DROP TABLE IF EXISTS `dsc_templates_left`;
CREATE TABLE `dsc_templates_left` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) NOT NULL DEFAULT '0',
  `seller_templates` varchar(160) NOT NULL DEFAULT '',
  `bg_color` char(10) NOT NULL,
  `img_file` varchar(120) NOT NULL DEFAULT '',
  `if_show` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bgrepeat` varchar(50) NOT NULL DEFAULT '',
  `align` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_pic_album`;
CREATE TABLE `dsc_pic_album` (
  `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pic_name` varchar(100) NOT NULL DEFAULT '',
  `album_id` int(10) unsigned NOT NULL,
  `pic_file` varchar(255) NOT NULL DEFAULT '',
  `pic_thumb` varchar(255) NOT NULL DEFAULT '',
  `pic_size` int(10) unsigned NOT NULL,
  `pic_spec` varchar(100) NOT NULL DEFAULT '',
  `ru_id` int(10) unsigned NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='相册图片表' AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_gallery_album`;
CREATE TABLE `dsc_gallery_album` (
  `album_id` int(10) NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) unsigned NOT NULL DEFAULT '0',
  `album_mame` varchar(60) NOT NULL DEFAULT '',
  `album_cover` varchar(255) NOT NULL DEFAULT '',
  `album_desc` varchar(255) NOT NULL DEFAULT '',
  `sort_order` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`album_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;