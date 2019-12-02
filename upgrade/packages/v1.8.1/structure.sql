ALTER TABLE `dsc_warehouse_goods` ADD `region_sn` VARCHAR( 60 ) NOT NULL DEFAULT '' AFTER `region_id`;

ALTER TABLE `dsc_warehouse_area_goods` ADD `region_sn` VARCHAR( 60 ) NOT NULL DEFAULT '' AFTER `region_id`;