DELETE FROM `dsc_admin_action` WHERE action_code = 'message_manage';

UPDATE `dsc_admin_action` SET `seller_show` = '1' WHERE `action_code` = 'admin_message';