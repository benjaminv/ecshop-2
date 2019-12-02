--
-- 此处 parent_id(942) 是 SELECT id FROM `dsc_shop_config` WHERE `code` = 'extend_basic'; 查询出来的值
--
INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `store_range` , `value` , `sort_order` ) VALUES ( 942, 'bonus_adv', 'select', '0,1', 1, 1 );

--
-- 此处 parent_id(1004) 是 SELECT id FROM `dsc_shop_config` WHERE `code` = 'goods_picture'; 查询出来的值
--
UPDATE `dsc_shop_config` SET  `parent_id` =  '1004', `shop_group` = 'goods' WHERE `code` IN ('two_code_links', 'two_code_mouse');
