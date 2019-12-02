ALTER TABLE  `dsc_region` ADD INDEX  `region_name` (  `region_name` );

ALTER TABLE  `dsc_region_warehouse` ADD INDEX  `region_name` (  `region_name` );

ALTER TABLE  `dsc_region_warehouse` ADD INDEX  `region_code` (  `region_code` );

ALTER TABLE  `dsc_solve_dealconcurrent` ADD  `flow_type` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT  '0' COMMENT  '商品类型（flow_type：秒杀、普通商品）' AFTER  `orec_id` ,
ADD INDEX (  `flow_type` );