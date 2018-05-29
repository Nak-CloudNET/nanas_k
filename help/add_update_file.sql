/* 05/04/2018 By Kaoly */

ALTER TABLE `erp_pos_register`
ADD COLUMN `cash_in`  text NULL AFTER `closed_by`,
ADD COLUMN `cash_out`  text NULL AFTER `cash_in`;

/* 25/04/2018 By Kaoly */

ALTER TABLE `erp_return_items`
ADD COLUMN `expiry`  date NULL AFTER `wpiece`,
ADD COLUMN `expiry_id`  int(11) NULL AFTER `expiry`;

/* channa */

CREATE TABLE `NewTable` (
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
