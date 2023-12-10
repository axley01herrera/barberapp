ALTER TABLE `profile` CHANGE `company_name` `companyName` VARCHAR(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL; 
ALTER TABLE `profile` CHANGE `company_type` `companyType` VARCHAR(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT NULL; 

DROP TABLE IF EXISTS `company_social_network`;
CREATE TABLE IF NOT EXISTS `company_social_network` (
  `id` int NOT NULL,
  `type` varchar(90) COLLATE utf8mb4_spanish_ci NOT NULL,
  `url` varchar(999) COLLATE utf8mb4_spanish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
);

ALTER TABLE `profile`
  DROP `facebook`,
  DROP `instagram`;

ALTER TABLE `service` ADD ` ` INT NOT NULL DEFAULT '1' AFTER `status`; 