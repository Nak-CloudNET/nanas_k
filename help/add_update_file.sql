/* 05/04/2018 By Kaoly */

ALTER TABLE `erp_pos_register`
ADD COLUMN `cash_in`  text NULL AFTER `closed_by`,
ADD COLUMN `cash_out`  text NULL AFTER `cash_in`;

/* 25/04/2018 By Kaoly */

ALTER TABLE `erp_return_items`
ADD COLUMN `expiry`  date NULL AFTER `wpiece`,
ADD COLUMN `expiry_id`  int(11) NULL AFTER `expiry`;

/* 28-05-2018 By Chanthy */
ALTER TABLE `erp_companies`
  ADD COLUMN `plate_number` varchar(55) NULL,
  ADD COLUMN `plate_number_2` varchar(55) NULL AFTER `plate_number`,
  ADD COLUMN `plate_number_3` varchar(55) NULL AFTER `plate_number_2`,
  ADD COLUMN `plate_number_4` varchar(55) NULL AFTER `plate_number_3`,
  ADD COLUMN `plate_number_5` varchar(55) NULL AFTER `plate_number_4`;

/* 29-05-2018 By Chanthy */
ALTER TABLE `iclouderp_v3_5_nanas_k`.`erp_sales` 
ADD COLUMN `plate_number` varchar(55) NULL AFTER `start_date`;

/* 29-05-2018 By Nak    */
ALTER TABLE `erp_suspended_items`
  ADD COLUMN `quantity_balance`  decimal(15,4) NULL AFTER `unit_price`;
  
/* 30-05-2018 By Chanthy */
  ALTER TABLE `iclouderp_v3_5_nanas_k`.`erp_suspended_bills` 
ADD COLUMN `plate_number` varchar(55) NULL AFTER `suspend_name`;

ALTER TABLE `erp_gift_card_logs`
ADD COLUMN `updated_at`  datetime NULL AFTER `created_by`;


/* 31-05-2018 Kaoly create new table */
DROP TABLE IF EXISTS `erp_packages`;
CREATE TABLE `erp_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `combo_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `quantity` decimal(15,4) DEFAULT NULL,
  `use_quantity` decimal(15,4) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;