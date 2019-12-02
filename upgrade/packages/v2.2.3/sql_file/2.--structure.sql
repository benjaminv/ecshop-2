DROP TABLE IF EXISTS `dsc_alitongxin_configure`;
CREATE TABLE IF NOT EXISTS `dsc_alitongxin_configure` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `temp_id` varchar(255) NOT NULL COMMENT '模板ID',
  `temp_content` varchar(255) NOT NULL COMMENT '模板内容',
  `add_time` int(15) NOT NULL COMMENT '添加时间',
  `set_sign` varchar(255) NOT NULL COMMENT '签名',
  `send_time` varchar(255) NOT NULL COMMENT '短信发送时机',
  `signature` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `dsc_touch_page_view`;
CREATE TABLE `dsc_touch_page_view` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ru_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID' ,
  `type` varchar(60) NOT NULL DEFAULT '1' COMMENT '店铺或专题' ,
  `page_id` int(160) unsigned NOT NULL DEFAULT '0'  COMMENT '店铺ID或专题ID' ,
  `title` varchar(255)  DEFAULT NULL COMMENT '标题' ,
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字' ,
  `description` varchar(255) DEFAULT NULL COMMENT '描述' ,
  `data` longtext COMMENT '内容'  ,
  `pic` longtext COMMENT '图片'  ,
  `thumb_pic` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图'  ,
  `create_at` int(11) unsigned DEFAULT '0' COMMENT '创建时间',
  `update_at` int(11) unsigned DEFAULT '0' COMMENT '更新时间',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '数据 0 自定义数据 1 默认数据',
  `review_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '审核状态1 3 ',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示 0 1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;