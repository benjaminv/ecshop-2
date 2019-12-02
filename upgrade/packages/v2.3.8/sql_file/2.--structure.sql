ALTER TABLE `dsc_baitiao_log` ADD `pay_num` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER `is_refund`, ADD INDEX `pay_num` (`pay_num`);

CREATE TABLE IF NOT EXISTS `dsc_baitiao_pay_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `baitiao_id` int(10) unsigned NOT NULL DEFAULT '0',
  `log_id` int(10) unsigned NOT NULL DEFAULT '0',
  `stages_num` smallint(3) unsigned NOT NULL DEFAULT '0',
  `stages_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `is_pay` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pay_id` int(10) unsigned NOT NULL DEFAULT '0',
  `pay_code` varchar(20) NOT NULL,
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pay_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `stages_num` (`stages_num`) USING BTREE,
  KEY `log_id` (`log_id`) USING BTREE,
  KEY `baitiao_id` (`baitiao_id`),
  KEY `is_pay` (`is_pay`),
  KEY `pai_id` (`pay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `dsc_goods_transport_tpl` ADD `admin_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `configure`, ADD INDEX `admin_id` (`admin_id`);