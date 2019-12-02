UPDATE `dsc_admin_action` SET `seller_show` = '1' WHERE `action_id` = 47;

INSERT INTO `dsc_admin_action` ( `parent_id` , `action_code` , `seller_show` )
VALUES ( 4, 'privilege_seller', 1 ) 