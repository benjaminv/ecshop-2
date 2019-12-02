ALTER TABLE  `dsc_seller_commission_bill` ADD  `repair_order` TINYINT( 3 ) NOT NULL DEFAULT  '0';

ALTER TABLE  `dsc_seller_commission_bill` ADD  `drp_money` DECIMAL( 10, 2 ) NOT NULL DEFAULT  '0.00';

ALTER TABLE  `dsc_seller_bill_order` ADD  `repair` TINYINT( 3 ) NOT NULL DEFAULT  '0' COMMENT  '补单' ,
ADD INDEX (  `repair` );