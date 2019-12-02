ALTER TABLE `dsc_users` ADD `nick_name` VARCHAR( 60 ) NOT NULL AFTER `user_name`;
ALTER TABLE `dsc_merchants_steps_process` ADD `is_show` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '1' AFTER `steps_sort`;