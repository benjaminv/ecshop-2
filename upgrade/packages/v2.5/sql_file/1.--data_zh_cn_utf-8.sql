INSERT INTO  `dsc_shop_config` (  `parent_id` ,  `code` ,  `type` ,  `value` ,  `shop_group` ) VALUES ( 942,  'cashier_Settlement',  'hidden', 1,  '' );

DELETE FROM dsc_payment WHERE  pay_code ='alipay_bank';

DELETE FROM dsc_payment WHERE  pay_code ='chinabank';

