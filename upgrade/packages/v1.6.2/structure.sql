ALTER TABLE `dsc_admin_action` 
	CHANGE `action_id` `action_id` SMALLINT( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
	CHANGE `parent_id` `parent_id` SMALLINT( 5 ) UNSIGNED NOT NULL DEFAULT '0';

ALTER TABLE `dsc_users_paypwd` ENGINE = MYISAM;

ALTER TABLE `dsc_seller_grade` 
	ADD `white_bar` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `pay_integral`;