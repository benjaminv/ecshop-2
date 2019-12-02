UPDATE `dsc_admin_action` SET `seller_show` = '0' WHERE `action_code` IN('merch_virualcard', 'gen_goods_script', 'tag_manage', 'cms_manage', 'users_manage', 'template_manage', 'admin_manage', 'admin_drop', 'logs_manage', 'agency_manage', 'suppliers_manage', 'role_manage', 'shop_config', 'payment', 'shiparea_manage', 'friendlink', 'db_backup', 'db_renew', 'flash_manage', 'navigator', 'cron', 'area_list', 'affiliate', 'affiliate_ck', 'sitemap', 'file_priv');

UPDATE `dsc_admin_action` SET `seller_show` = '0' WHERE `action_code` IN('file_check', 'reg_fields', 'shop_authorized', 'webcollect_manage', 'region_area', 'website', 'shipping_date_list', 'oss_configure', 'partnerlink', 'client_flow_stats', 'client_searchengine', 'client_report_guest', 'users_flow_stats', 'batch_add_order', 'card_manage', 'goods_pack', 'email', 'templates_manage', 'db_manage', 'sms_manage', 'merchants_setps', 'merchants_setps_drop', 'users_merchants', 'users_merchants_drop', 'merchants_percent', 'users_merchants_priv');

UPDATE `dsc_admin_action` SET `seller_show` = '0' WHERE `action_code` IN('create_seller_grade', 'seller_dimain', 'seller_grade', 'ectouch', 'cloud', 'zc_manage', 'wechat', 'drp');

INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` ) VALUES ( 1, 'gallery_album' ) ;

INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` ) VALUES ( 224, '10_visual_editing' ) ;