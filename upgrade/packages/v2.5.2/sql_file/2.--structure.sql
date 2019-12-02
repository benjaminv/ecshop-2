ALTER TABLE `dsc_goods` ADD `goods_video` VARCHAR( 255 ) NOT NULL AFTER `original_img` ;

ALTER TABLE  `dsc_goods_type_cat` ADD  `suppliers_id`  INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '供应商ID' AFTER  `user_id`;

ALTER TABLE  `dsc_goods_type` ADD  `suppliers_id`  INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '供应商ID' AFTER  `user_id`;

ALTER TABLE  `dsc_gallery_album` ADD  `suppliers_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '供应商ID' AFTER  `add_time`;