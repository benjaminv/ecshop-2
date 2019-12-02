ALTER TABLE `dsc_seller_apply_info` CHANGE `entry_criteria` `entry_criteria` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;

ALTER TABLE `dsc_connect_user`
CHANGE COLUMN `token_secret` `refresh_token`  char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' AFTER `open_id`,
CHANGE COLUMN `token` `access_token`  char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'token' AFTER `refresh_token`;