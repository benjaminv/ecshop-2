
INSERT INTO  `dsc_shop_config` (  `parent_id` ,  `code` ,  `type` ,  `store_range` ,  `value` ,  `sort_order` ,  `shop_group` ) 
VALUES ( 942,  'open_order_delay',  'select',  '0,1', 1, 15,  'order_delay' );

INSERT INTO  `dsc_shop_config` (  `parent_id` ,  `code` ,  `type` ,  `value` ,  `sort_order` ,  `shop_group` ) 
VALUES ( 942,  'order_delay_num',  'text', 3, 15,  'order_delay' );

INSERT INTO  `dsc_shop_config` (  `parent_id` ,  `code` ,  `type` ,  `value` ,  `sort_order` ,  `shop_group` ) 
VALUES ( 942,  'order_delay_day',  'text', 3, 15,  'order_delay' );

INSERT INTO  `dsc_shop_config` (  `parent_id` ,  `code` ,  `type` ,  `value` ,  `sort_order` ,  `shop_group` ) 
VALUES ( 942,  'pay_effective_time',  'text', 0, 15,'');

INSERT INTO `dsc_seo` (`id`, `title`, `keywords`, `description`, `type`) VALUES
(1, '首页', '首页', '首页', 'index'),
(2, '团购', '团购', '团购', 'group'),
(3, '团购详情', '团购详情', '团购详情', 'group_content'),
(5, '积分商城', '积分商城', '积分商城', 'change'),
(6, '积分中心商品内容', '积分中心商品内容', '积分中心商品内容', 'change_content'),
(7, '文章分类列表', '文章分类列表', '文章分类列表', 'article'),
(8, '文章内容', '文章内容', '文章内容', 'article_content'),
(9, '店铺街', '店铺街', '店铺街', 'shop'),
(10, ' 商品', ' 商品', ' 商品', 'goods'),
(12, '品牌', '品牌', '品牌', 'brand_list'),
(13, '品牌商品列表', '品牌商品列表', '品牌商品列表', 'brand');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '5', 'seo', '', '0');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '2', 'visualnews', '', '0');

INSERT INTO `dsc_shop_config` (`id` ,`parent_id` ,`code` ,`type` ,`store_range` ,`store_dir` ,`value` ,`sort_order` ,`shop_group`) VALUES (NULL ,  '1018',  'order_print_logo',  'file',  '',  'admin/images/print/',  'admin/images/print/order_print_logo.png',  '1',  '');

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`, `seller_show`) VALUES (NULL, '6', 'order_delayed', '', '1');