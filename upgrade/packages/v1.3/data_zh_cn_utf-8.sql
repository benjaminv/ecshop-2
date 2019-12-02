INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` )
VALUES ( 4, 'seller_manage' ) ;

INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` )
VALUES ( 4, 'seller_allot' ) ;

INSERT INTO `dsc_admin_action` (`action_id`, `parent_id`, `action_code`, `relevance`) VALUES (NULL, '4', 'seller_drop', '');

INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` )
VALUES ( 136, 'seller_dimain' ) ;

INSERT INTO `dsc_admin_action` ( `action_code` )
VALUES (
'seller_store_setup'
) ;

INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` )
VALUES (
'224', 'seller_store_informa'
) ;

INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` )
VALUES ( 224, 'seller_store_other' ) ;

INSERT INTO `dsc_shop_config` (`id`, `parent_id`, `code`, `type`, `store_range`, `store_dir`, `value`, `sort_order`) VALUES (NULL, '942', 'ad_reminder', 'select', '1,0', '', '1', '1');

INSERT INTO dsc_shop_config(`parent_id`,`code`,`type`,`store_range`,`store_dir`,`value`,`sort_order`) VALUES(8,'sms_seller_signin','select','0,1','','0',1);
INSERT INTO dsc_mail_templates(`template_code`,`is_html`,`template_subject`,`template_content`,`last_modify`,`last_send`,`type`) VALUES('seller_signin',1,'商家登录信息','<p>{$seller_name}您好！<br />
<br />
{$shop_name} 商家在{$site_name}平台，后台登录信息已修改:<br />
<br />
{if $seller_name}名称：{$seller_name}，{/if}{if $seller_psw}密码：{$seller_psw}{/if}<br />
此信息无需回复！<br />
<br />
<br />
{$send_date}</p>','1407196355','0','template');

UPDATE `dsc_shop_config` SET `code` = 'dsc_version' WHERE `id` =606;