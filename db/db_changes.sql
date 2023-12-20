DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customerID` int NOT NULL,
  `employeeID` int NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `services` json NOT NULL,
  PRIMARY KEY (`id`)
);

ALTER TABLE `employee` ADD `address1` VARCHAR(250) NULL AFTER `deleted`; 
ALTER TABLE `employee` ADD `address2` VARCHAR(250) NULL AFTER `address1`; 
ALTER TABLE `employee` ADD `city` VARCHAR(250) NULL AFTER `address2`; 
ALTER TABLE `employee` ADD `state` VARCHAR(250) NULL AFTER `city`; 
ALTER TABLE `employee` ADD `zip` INT NULL AFTER `state`; 
ALTER TABLE `employee` ADD `country` VARCHAR(250) NULL AFTER `zip`; 

ALTER TABLE `customer` ADD `address1` VARCHAR(250) NULL AFTER `deleted`; 
ALTER TABLE `customer` ADD `address2` VARCHAR(250) NULL AFTER `address1`; 
ALTER TABLE `customer` ADD `city` VARCHAR(250) NULL AFTER `address2`; 
ALTER TABLE `customer` ADD `state` VARCHAR(250) NULL AFTER `city`; 
ALTER TABLE `customer` ADD `zip` INT NULL AFTER `state`; 
ALTER TABLE `customer` ADD `country` VARCHAR(250) NULL AFTER `zip`; 

ALTER TABLE `company_profile` ADD `about` LONGTEXT NULL AFTER `country`; 

DROP TABLE IF EXISTS `company_img`;
CREATE TABLE IF NOT EXISTS `company_img` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` longblob NOT NULL,
  PRIMARY KEY (`id`)
);