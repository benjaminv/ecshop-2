INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `relevance`) VALUES ('6', 'order_os_remove', '');

INSERT INTO `dsc_shop_config` (`parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES ('942', 'server_model', 'hidden', '0,1', '', '0', '1');

INSERT INTO `dsc_admin_action` (`parent_id`,`action_code`, `relevance`) VALUES ('0',  'zc_manage',  '');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `relevance`) VALUES ('233',  'zc_project_manage',  ''), 
('233',  'zc_category_manage',  ''), 
('233',  'zc_initiator_manage',  ''), 
('233',  'zc_topic_manage',  '');

INSERT INTO `dsc_shop_config` (`parent_id` , `code` , `type` , `value` , `sort_order` ) VALUES ('942', 'grade_apply_time', 'text', '3', 2);

INSERT INTO `dsc_shop_config` (`parent_id` , `code` , `type` , `store_range` , `value` , `sort_order` ) VALUES ('942', 'apply_options', 'options', '1,2', '1', 3);

INSERT INTO `dsc_mail_templates` (`template_code` , `is_html` , `template_subject` , `template_content` , `type` ) VALUES ('merchants_allpy_grade', 1, '商家店铺升级', '亲爱的{$grade.shop_name}。你好！</br></br>关于您的您的{$grade.grade_name}申请我们已经认真查看核对，感谢对我们的信任。经过我们的认真考虑我们{$grade.confirm}您的请求。</br>{$grade.merchants_message}</br>{$send_date}', 'template');

INSERT INTO `dsc_admin_action`(`parent_id`, `action_code`) VALUES ('136','seller_grade');

INSERT INTO `dsc_admin_action`(`parent_id`, `action_code`) VALUES ('136','seller_apply');

UPDATE  `dsc_shop_config` SET TYPE =  'hidden' WHERE code =  'anonymous_buy';

INSERT INTO `dsc_admin_action` (`parent_id` ,`action_code` ,`relevance`) VALUES ('7',  'coupons_manage',  '');

INSERT INTO `dsc_shop_config` (`parent_id`, `code`,`type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES ('942',  'category_load_type',  'select',  '0,1',  '',  '0',  '1');

INSERT INTO `dsc_admin_action` (`parent_id`, `action_code`, `relevance`) VALUES ('3', 'users_real_manage', '');

INSERT INTO `dsc_ad_position` (`position_id`, `user_id`, `position_name`, `ad_width`, `ad_height`, `position_model`, `position_desc`, `position_style`, `is_public`, `theme`) VALUES
(NULL, 0, '优惠券首页轮播图广告', 1200, 300, 'coupons_index[num_id]', 'num_id-数量序号', '{foreach from=$ads item=ad}\r\n{$ad}\r\n{/foreach}', 0, 'ecmoban_dsc');

INSERT INTO `dsc_ad_position` (`position_id`, `user_id`, `position_name`, `ad_width`, `ad_height`, `position_model`, `position_desc`, `position_style`, `is_public`, `theme`) VALUES
(NULL, 0, '众筹首页轮播图', 1200, 380, 'zc_index_banner[num_id]', 'num_id-数量序号', '<table cellpadding="0" cellspacing="0">\n{foreach from=$ads item=ad}\n<tr><td>{$ad}</td></tr>\n{/foreach}\n</table>', 0, 'ecmoban_dsc');

INSERT INTO `dsc_zc_category` (`cat_id`, `cat_name`, `cat_desc`, `parent_id`, `sort_order`, `is_show`) VALUES
(5, '未来科技', '', 0, 1, 1),
(6, '数码宝贝', '', 5, 50, 1),
(7, '居家神器', '', 5, 50, 1),
(8, '健康出行', '', 0, 2, 1),
(9, '环球名物', '', 8, 50, 1),
(10, '旅行达人', '', 8, 50, 1),
(13, '生活美学', '', 0, 4, 1),
(12, '美食生活', '', 0, 3, 1),
(14, '原创设计', '', 13, 1, 1),
(15, '良品家居', '', 13, 2, 1),
(16, '地标美食', '', 12, 1, 1),
(17, '茶言酒语', '', 12, 50, 1);

INSERT INTO `dsc_zc_goods` (`id`, `pid`, `limit`, `backer_num`, `price`, `shipping_fee`, `content`, `img`, `return_time`, `backer_list`) VALUES
(1, 4, 3, 1, '3000', '0', '一套设备', 'data/zc_product_images/1469556603531857837.jpg', 30, '188'),
(2, 4, 100, 0, '7000', '0', '两套设备', 'data/zc_product_images/1469559521962750229.jpg', 30, NULL),
(3, 5, -1, 0, '1', '0', '每满150位支持者抽取1位幸运用户，不满足时也抽取1位。幸运用户将会获得记忆棉靠垫1个。幸运用户将由京东官方抽取，抽奖规则及中奖者名单将在话题区公布。', 'data/zc_product_images/1469561890900373306.jpg', 30, NULL),
(4, 5, 300, 0, '259', '0', '感谢您的支持，将会获得记忆棉多功能腰背靠垫和配套的记忆棉美臀坐垫各1个。', 'data/zc_product_images/1469561945839544961.jpg', 30, NULL),
(5, 6, -1, 0, '1', '0', '恭喜您以渠道专享价获得：携茶道天作+携茶道玄鸟各20套+市场价58元的茶道礼包20份。享受分享的喜悦，感谢有你，生活更加多彩。', 'data/zc_product_images/1469562170500027679.jpg', 30, NULL),
(6, 6, 50, 0, '998', '0', '恭喜您以众筹首发价获得：携茶道天作一套（茶盘为鸡翅木，含收藏证书），世界那么大，带着它去远方，尝一尝另一般生活的滋味。天作高山，大王荒之。彼作矣，文王康之。彼徂矣，岐有夷之行。子孙保之。名曰天作。', 'data/zc_product_images/1469562217924344186.jpg', 30, NULL),
(7, 7, -1, 0, '50', '0', '可获得陈富息古法手作的横山豆腐乳乾隆贡180g×2瓶； 乾隆贡分享装90g×1瓶', 'data/zc_product_images/1469562479289457048.jpg', 10, NULL),
(8, 7, 100, 0, '100', '0', '可获得陈富息古法手作的横山豆腐乳乾隆贡180g×4瓶； 手剁辣椒酱分享装180g ×2瓶', 'data/zc_product_images/1469562499927290649.jpg', 10, NULL),
(9, 8, -1, 0, '1', '0', '每满99位支持者抽取1位幸运用户，不满足时也抽取1位。幸运用户将会获得凤冈锌硒茶1套（1罐红茶+1罐茗珠）。幸运用户将由京东官方抽取，抽奖规则及中奖者名单将在话题区公布。', 'data/zc_product_images/1469562874103382555.jpg', 30, NULL),
(10, 8, 2000, 0, '99', '0', '凤冈锌硒茶1套（1罐红茶+1罐茗珠）', 'data/zc_product_images/1469562897477245574.jpg', 30, NULL),
(11, 9, -1, 0, '1', '0', '每满700位支持者抽取1位幸运用户，不满足时也抽取1位。幸运用户将会获得菲星智能后视镜记录仪P8一套。幸运用户将由京东官方抽取，抽奖规则及中奖者名单将在话题区公布。', 'data/zc_product_images/1469568038615880070.jpg', 30, NULL),
(12, 9, 500, 0, '699', '0', '谢谢您的支持！您将以超值众筹的价格，获得菲星智能后视镜行车记录导航仪1套。（配后摄像头。请自行配TF卡，）', 'data/zc_product_images/1469568025120342666.jpg', 30, NULL),
(13, 10, -1, 0, '1', '0', '每满89位支持者抽取1位幸运用户，不满足时也抽取1位。幸运用户将会获得onread智能排插升级版（WIFI分控）1支。幸运用户将由京东官方抽取，抽奖规则及中奖者名单将在话题区公布。', 'data/zc_product_images/1469568253632088242.jpg', 30, NULL),
(14, 10, 2000, 0, '39', '0', '支持39元限2000人 非常感谢您的支持！您可以用低于成本的价格获得onread排插标准版（2USB 4位插孔）1支 （注明：此款不支持WIFI控制） 限额2000人', 'data/zc_product_images/1469568280177629133.jpg', 30, NULL),
(15, 11, -1, 0, '1', '0', '每满128位支持者抽取1位幸运用户，不满足时也抽取1位。幸运用户将会获得马来西亚猫山王速冻肉200克一盒。幸运用户将由京东官方抽取，抽奖规则及中奖者名单将在话题区公布。', 'data/zc_product_images/1469568673476363449.jpg', 30, NULL),
(16, 11, 500, 0, '198', '0', '感谢您的支持，在众筹结束后 您将获得预估市场价258元的马来西亚猫山王速冻肉400克一盒（顺丰空运，冷藏包装） 偏远地区港澳台勿拍（黑龙江、吉林、甘肃、内蒙古、宁夏、青海、辽宁、新疆、西藏地区）感谢您的支持。', 'data/zc_product_images/1469568703663762791.jpg', 30, NULL);

INSERT INTO `dsc_zc_initiator` (`id`, `name`, `company`, `img`, `intro`, `describe`, `rank`) VALUES
(2, '无印良品', '无印良品', 'data/initiator_image/1469505347118618837.png', '无印良品是一个日本杂货品牌', '无印良品是一个日本杂货品牌，在日文中意为无品牌标志的好产品。产品类别以日常用品为主。产品注重纯朴、简洁、环保、以人为本等理念，在包装与产品设计上皆无品牌标志。产品类别从铅笔、笔记本、食品到厨房的基本用具都有。最近也开始进入房屋建筑、花店、咖啡店等产业类别。', 1),
(3, '模板堂', '上海商创网络科技有限公司', 'data/initiator_image/1469561234331729031.jpg', 'ecshop模板制作选购第一站，国内专业的ecshop模板开发商，提供完善的ecshop二次开发与模板定制服务以及ecshop插件与ecshop教程。', '上海商创网络科技有限公司（ECSHOP模板堂）是ecshop行业首家股交中心挂牌企业。伴随着ECSHOP一起成长，可以为广大ECSHOP模板使用者提供更为全面的服务。ECSHOP模板堂创始于1999年，是一家连续十余年为中国互联网用户提供服务的运营商，是国内领先的网站建设机构。', 1);

INSERT INTO `dsc_entry_criteria` (`id`, `parent_id`, `criteria_name`, `charge`, `standard_name`, `type`, `is_mandatory`, `option_value`) VALUES
(1, 0, '实名认证', '0.00', '', '', 0, ''),
(2, 1, '姓名', '0.00', '', 'text', 1, ''),
(3, 1, '身份证正面', '0.00', '', 'file', 1, ''),
(4, 1, '身份证反面', '0.00', '', 'file', 1, ''),
(5, 1, '营业执照', '0.00', '', 'file', 1, ''),
(6, 1, '手机号码', '0.00', '', 'text', 1, ''),
(7, 1, '电子邮箱', '0.00', '', 'text', 1, ''),
(8, 1, '身份证号码', '0.00', '', 'text', 1, ''),
(9, 0, '缴纳保证金', '0.00', '', '', 0, ''),
(10, 9, '保证金', '500.00', '', 'charge', 0, ''),
(11, 0, '缴纳加盟费', '0.00', '', '', 0, ''),
(12, 11, '加盟费', '5000.00', '', 'charge', 0, '');

INSERT INTO `dsc_seller_grade` (`id`, `grade_name`, `goods_sun`, `seller_temp`, `favorable_rate`, `give_integral`, `rank_integral`, `pay_integral`, `grade_introduce`, `entry_criteria`, `grade_img`, `is_open`, `is_default`) VALUES
(14, '加盟商家', 400, 20, '75', 80, 80, 80, '44444', 'a:3:{i:1;s:1:"1";i:9;s:1:"9";i:11;s:2:"11";}', 'data/seller_grade/1469558898291609114.png', 1, 0),
(13, '金牌商家', 300, 9, '80', 60, 60, 60, '33333', 'a:2:{i:1;s:1:"1";i:11;s:2:"11";}', 'data/seller_grade/1469558891239621018.png', 1, 0),
(12, '优质商家', 200, 7, '85', 40, 40, 40, '222222', 'a:2:{i:1;s:1:"1";i:9;s:1:"9";}', 'data/seller_grade/1469558678666686249.png', 1, 0),
(10, '普通商家', 100, 5, '90', 20, 20, 20, '1111', 'a:1:{i:1;s:1:"1";}', 'data/seller_grade/1469558669252444227.png', 1, 1);

INSERT INTO `dsc_merchants_privilege` (`action_list`, `grade_id`) VALUES
('goods_manage,remove_back,cat_manage,cat_drop,attr_manage,comment_priv,goods_type,goods_auto,virualcard,goods_export,goods_batch,merchants_brand,discuss_circle,feedback_priv,seller_manage,seller_allot,seller_drop,ship_manage,shiparea_manage,warehouse_manage,order_os_edit,order_ps_edit,order_ss_edit,order_edit,order_view,order_view_finished,repay_manage,booking,sale_order_stats,delivery_view,topic_manage,snatch_manage,ad_manage,gift_manage,bonus_manage,auction,group_by,favourable,whole_sale,package_manage,exchange_goods,presale,gift_gard_manage,take_manage,merchants_commission,seller_store_informa,seller_store_other', 0),
('goods_manage,remove_back,cat_manage,cat_drop,attr_manage,comment_priv,goods_type,goods_auto,virualcard,goods_export,goods_batch,merchants_brand,discuss_circle,feedback_priv,seller_manage,seller_allot,seller_drop,ship_manage,shiparea_manage,warehouse_manage,order_os_edit,order_ps_edit,order_ss_edit,order_edit,order_view,order_view_finished,repay_manage,booking,sale_order_stats,delivery_view,merchants_commission,seller_store_informa,seller_store_other', 10),
('goods_manage,remove_back,cat_manage,cat_drop,attr_manage,comment_priv,goods_type,goods_auto,virualcard,goods_export,goods_batch,merchants_brand,discuss_circle,feedback_priv,seller_manage,seller_allot,seller_drop,ship_manage,shiparea_manage,warehouse_manage,order_os_edit,order_ps_edit,order_ss_edit,order_edit,order_view,order_view_finished,repay_manage,booking,sale_order_stats,delivery_view,bonus_manage,favourable,merchants_commission,seller_store_informa,seller_store_other', 12),
('goods_manage,remove_back,cat_manage,cat_drop,attr_manage,comment_priv,goods_type,goods_auto,virualcard,goods_export,goods_batch,merchants_brand,discuss_circle,feedback_priv,seller_manage,seller_allot,seller_drop,ship_manage,shiparea_manage,warehouse_manage,order_os_edit,order_ps_edit,order_ss_edit,order_edit,order_view,order_view_finished,repay_manage,booking,sale_order_stats,delivery_view,bonus_manage,favourable,exchange_goods,presale,gift_gard_manage,take_manage,merchants_commission,seller_store_informa,seller_store_other', 13),
('goods_manage,remove_back,cat_manage,cat_drop,attr_manage,comment_priv,goods_type,goods_auto,virualcard,goods_export,goods_batch,merchants_brand,discuss_circle,feedback_priv,seller_manage,seller_allot,seller_drop,ship_manage,shiparea_manage,warehouse_manage,order_os_edit,order_ps_edit,order_ss_edit,order_edit,order_view,order_view_finished,repay_manage,booking,sale_order_stats,delivery_view,bonus_manage,favourable,exchange_goods,presale,gift_gard_manage,take_manage,merchants_commission,seller_store_informa,seller_store_other,zc_project_manage,zc_category_manage,zc_initiator_manage', 14);

INSERT INTO `dsc_mail_templates` (`template_id`, `template_code`, `is_html`, `template_subject`, `template_content`, `last_modify`, `last_send`, `type`) VALUES (NULL, 'user_register', '1', '会员注册模板', '<table width="700" border="0" align="center" cellspacing="0" style="width:700px;">
<tbody>
<tr>
<td>
<div style="width:700px;margin:0 auto;border-bottom:1px solid #ccc;margin-bottom:30px;">
<table border="0" cellpadding="0" cellspacing="0" width="700" height="39" style="font:12px Tahoma, Arial, 宋体;">
<tbody>
<tr>
<td width="210">
</td>
</tr>
</tbody>
</table>
</div>
<div style="width:680px;padding:0 10px;margin:0 auto;">
<div style="line-height:1.5;font-size:14px;margin-bottom:25px;color:#4d4d4d;">
<strong style="display:block;margin-bottom:15px;">
亲爱的会员：
<span style="color:#f60;font-size: 16px;">{$user_name}</span>您好！
</strong>
<strong style="display:block;margin-bottom:15px;">
您正在修改邮箱，请在验证码输入框中输入：
<span style="color:#f60;font-size: 24px"><span style="border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(204, 204, 204); z-index: 1; position: static;" t="7" onclick="return false;" data="{$register_code}" isout="1">{$register_code}</span></span>，以完成操作。
</strong>
</div>
<div style="margin-bottom:30px;">
<small style="display:block;margin-bottom:20px;font-size:12px;">
<p style="color:#747474;">
注意：此操作可能会修改您的密码、登录邮箱或绑定手机。如非本人操作，请及时登录并修改密码以保证帐户安全
<br>（工作人员不会向你索取此验证码，请勿泄漏！)
</p>
</small>
</div>
</div>
<div style="width:700px;margin:0 auto;">
<div style="padding:10px 10px 0;border-top:1px solid #ccc;color:#747474;margin-bottom:20px;line-height:1.3em;font-size:12px;">
<p>此为系统邮件，请勿回复<br>
请保管好您的邮箱，避免账号被他人盗用
</p>
<p>大商创版权所有<span style="border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(204, 204, 204); z-index: 1; position: static;" t="7" onclick="return false;" data="1999-2014">2005-2016</span></p>
</div>
</div>
</td>
</tr>
</tbody>
</table>', '0', '0', 'template');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'user_login_register', 'select', '0,1', '', '0', '1');

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'user_phone', 'select', '0,1', '', '0', '1');