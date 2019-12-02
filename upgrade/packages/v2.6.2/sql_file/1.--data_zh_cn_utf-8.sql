UPDATE `dsc_shop_config` SET `type` = 'file',`value` = "../images/wap_logo.png" WHERE `code` = 'wap_logo';

DELETE FROM `dsc_admin_action` WHERE `action_code` = 'goods_psi';