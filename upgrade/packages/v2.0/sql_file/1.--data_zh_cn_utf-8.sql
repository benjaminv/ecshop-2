INSERT INTO `dsc_shop_config` (`id` ,`parent_id` ,`code` ,`type`,`store_range` ,`store_dir` ,`value` ,`sort_order`) VALUES (NULL ,  '942',  'login_limited_num',  'hidden',  '',  '',  '3',  '30');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'nav_cat_model', 'select', '0,1', '', '0', '1');

UPDATE `dsc_seller_shopinfo` SET `templates_mode` = 1 WHERE 1;

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'index_article_cat', 'text', '', '', '', '1');

DELETE FROM dsc_admin_action WHERE action_code = 'transfer_manage';

INSERT INTO `dsc_shop_config` ( `parent_id` , `code` , `type` , `store_range` , `value` , `sort_order` )
VALUES ( 8, 'user_account_code', 'select', '1,0', 1, 17 ) ;

INSERT INTO `dsc_mail_templates` ( `template_code` , `is_html` , `template_subject` , `template_content` , `type` )
VALUES (
'user_account_code', 1, '会员提现充值模板', '尊敬的{$smsParams.user_name},您于{$smsParams.add_time}发出的{$smsParams.fmt_amount}元{$smsParams.process_type}申请于{$smsParams.op_time}{$smsParams.examine}审核，账户余额为：{$smsParams.user_money}。祝您购物愉快。', 'template'
);

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '登录页广告', '1920', '530', 'login_banner[num_id]', '', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', 'regist_banner', '400', '324', '注册页面左侧banner图', '注册页面左侧banner图', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '达人专区广告', '99', '72', 'expert_field_ad[num_id]', 'num_id-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '首页楼层轮播图', '232', '570', 'cat_goods_banner[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '首页楼层左侧广告图', '232', '280', 'cat_goods_ad_left[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '首页楼层右侧广告图', '232', '280', 'cat_goods_ad_right[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '左侧分类导航广告', '199', '97', 'cat_tree_[cat_id]_[num_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '首页推荐分类广告位', '232', '330', 'recommend_category[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '促销广告位', '1920', '500', 'activity_top_ad[name][act_id]', 'name-广告位显示页面名称,act_id-活动id（可为空）', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '店铺街广告', '1920', '200', 'store_street_ad[num_id]', '', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（家电模板）轮播图', '970', '295', 'top_style_elec_banner[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '全部商品分类页右边广告', '200', '130', 'category_all_right[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页全部分类右侧广告', '210', '410', 'cate_layer_elec_row_[cat_id]', 'num_id-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页轮播右侧广告', '245', '340', 'top_style_right_banner[num_id]_[cat_id]', 'cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（食品模板）轮播图', '774', '400', 'top_style_food_banner[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（家电模板）品牌右侧广告', '400', '150', 'top_style_elec_brand[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（家电模板）品牌左侧广告', '350', '300', 'top_style_elec_brand_left_[cat_id]', 'cat_id-分类id', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（家电模板）楼层左侧广告', '280', '460', 'top_style_elec_left[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（家电模板）楼层横幅广告', '1200', '100', 'top_style_elec_row_[cat_id]', 'num_id-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（食品模板）精品推荐', '240', '350', 'top_style_food_hot[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（食品模板）楼层横幅广告', '1200', '120', 'top_style_food_row_[cat_id]', 'cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（食品模板）楼层左侧广告', '580', '440', 'top_style_food_left[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（女装、内衣、中老年）轮播图', '1903', '327', 'cat_top_ad[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类（女装、内衣、中老年）楼层广告', '400', '660', 'cat_top_floor_ad[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类（女装、内衣、中老年）楼层右侧广告', '399', '170', 'cat_top_floor_ad_right[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '品牌首页轮播图', '1920', '300', 'brand_index_ad[num_id]', 'num_id-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\n{foreach from=$ads item=ad}\n<tr><td>{$ad}</td></tr>\n{/foreach}\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '首页推荐店铺广告位', '386', '187', 'recommend_merchants[num_id]_[cat_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '入驻首页头部广告', '1920', '385', 'merchants_index_top[num_id]', '[num_id]-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '入驻首页推荐类目', '98', '85', 'merchants_index_category_ad[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '入驻首页成功案例', '282', '200', 'merchants_index_case_ad[num_id]', '[num_id]-广告位编号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '首页楼层广告', '1200', '80', 'floor_banner[cat_id]', 'cat_id-分类ID', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '首页顶部广告', '1200', '80', 'top_banner', '直接填写广告名称', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '首页品牌街轮播图', '484', '178', 'index_brand_banner[num_id]', 'num_id-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（默认）轮播图', '1920', '390', 'category_top_banner[num_id]_[cat_id]', 'num_id-数量序号，cat_id-分类ID', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（默认）今日推荐头部广告', '400', '120', 'category_top_default_best_head[num_id]', 'num_id-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（默认）新品到货头部广告', '400', '120', 'category_top_default_new_head[num_id]', 'num_id-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（默认）今日推荐左侧广告', '480', '280', 'category_top_default_best_left[num_id]', 'num_id-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '顶级分类页（默认）新品到货左侧广告', '480', '280', 'category_top_default_new_left[num_id]', 'num_id-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '预售首页招牌推荐中间轮播广告', '600', '300', 'presale_banner_small[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '预售首页招牌推荐左右侧广告', '300', '300', 'presale_banner_small_right[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '预售首页大轮播图', '1022', '380', 'presale_banner[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '预售新品广告位', '1200', '380', 'presale_banner_new[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '预售分类广告位', '1022', '380', 'presale_banner_category[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '预售抢先订广告位', '1022', '380', 'presale_banner_advance[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '优惠券首页轮播图广告', '900', '300', 'coupons_index[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '众筹首页轮播图', '1200', '380', 'zc_index_banner[num_id]', 'num_id-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\n{foreach from=$ads item=ad}\n<tr><td>{$ad}</td></tr>\n{/foreach}\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '批发头部广告', '1200', '300', 'wholesale_ad[num_id]', '[num_id]-数量序号', '<table cellpadding=\"0\" cellspacing=\"0\">\r\n{foreach from=$ads item=ad}\r\n<tr><td>{$ad}</td></tr>\r\n{/foreach}\r\n</table>', '0', 'ecmoban_dsc2017');

INSERT INTO `dsc_ad_position` VALUES (NULL, '0', '秒杀列表页顶部广告位', '1920', '190', 'seckill_top_ad[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', '0', 'ecmoban_dsc2017');
