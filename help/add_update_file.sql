/* 05/04/2018 By Kaoly */

ALTER TABLE `erp_pos_register`
ADD COLUMN `cash_in`  text NULL AFTER `closed_by`,
ADD COLUMN `cash_out`  text NULL AFTER `cash_in`;

/* 25/04/2018 By Kaoly */

ALTER TABLE `erp_return_items`
ADD COLUMN `expiry`  date NULL AFTER `wpiece`,
ADD COLUMN `expiry_id`  int(11) NULL AFTER `expiry`;

/* channa */

CREATE TABLE `erp_gift_card_logs` (
`id`  int(11) NOT NULL ,
`gift_card_id`  int(11) NULL ,
`date`  datetime NULL ,
`transaction_type`  varchar(255) NULL ,
`amount`  double NULL ,
`sale_id`  int NULL ,
`created_by`  int NULL ,
PRIMARY KEY (`id`)
)
;

/* 28-05-2018 By Chanthy */
ALTER TABLE `iclouderp_v3_5_nanas_k`.`erp_companies`
ADD COLUMN `plate_number` varchar(55) NULL AFTER `public_charge_id`;
ADD COLUMN `plate_number_2` varchar(55) NULL AFTER `plate_number`;
ADD COLUMN `plate_number_3` varchar(55) NULL AFTER `plate_number_2`;
ADD COLUMN `plate_number_4` varchar(55) NULL AFTER `plate_number_3`;
ADD COLUMN `plate_number_5` varchar(55) NULL AFTER `plate_number_4`;
