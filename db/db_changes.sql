#### 
  ## Table config
###

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int NOT NULL AUTO_INCREMENT,
  `access_key` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '$2y$10$nSh5/VR7O3a0IkaZD8MVwO0o8xoia0JS9FVTfH.RVj8TZrLWBR0uC',
  `lang` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'es',
  `theme` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'light',
  `currency` varchar(1) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '€',
  PRIMARY KEY (`id`)
);

ALTER TABLE `config` ADD `timezone` VARCHAR(500) NOT NULL DEFAULT 'Atlantic/Canary' AFTER `currency`; 

INSERT INTO `config` (`id`, `access_key`, `lang`, `theme`, `currency`) VALUES
(1, '$2y$10$6joTL.Ifjy.UNj4pCgviqe8w0xBtE.yYs7yIxVMtk0BpUuaKSKGTO', 'es', 'light', '€');

#### 
  ## End Table config
###

#### 
  ## Table customer
###

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `lastName` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `phone` int DEFAULT NULL,
  `password` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `term` int NOT NULL DEFAULT '1',
  `token` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `emailVerified` int NOT NULL DEFAULT '0',
  `emailSubscription` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
)

ALTER TABLE `customer` ADD `deleted` INT NOT NULL DEFAULT '0' AFTER `emailSubscription`; 
ALTER TABLE `customer` ADD `lastSession` DATE NULL AFTER `emailSubscription`; 
ALTER TABLE `customer` ADD `gender` VARCHAR(1) NULL AFTER `lastName`; 
ALTER TABLE `customer` ADD `avatar` longblob NULL AFTER `id`; 
ALTER TABLE `customer` CHANGE `phone` `phone` VARCHAR(20) NULL DEFAULT NULL; 
ALTER TABLE `customer` ADD `emailNotification` INT NOT NULL DEFAULT '1' AFTER `emailSubscription`; 
ALTER TABLE `customer` ADD `dob` DATE NULL AFTER `gender`; 

#### 
  ## End Table customer
###

#### 
  ## Table employee
###

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  `lastName` varchar(90) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

ALTER TABLE `employee` ADD `token` VARCHAR(999) NULL AFTER `status`; 
ALTER TABLE `employee` ADD `emailVerified` INT NOT NULL DEFAULT '0' AFTER `token`; 
ALTER TABLE `employee` ADD `deleted` INT NOT NULL DEFAULT '0' AFTER `emailVerified`; 
ALTER TABLE `employee` CHANGE `email` `email` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL; 

#### 
  ## End Table employee
###

#### 
  ## Table profile
###

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `avatar` longblob,
  `company_name` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `company_type` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `phone1` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `phone2` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address1` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `address2` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `city` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `state` varchar(150) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `zip` int DEFAULT NULL,
  `country` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);

ALTER TABLE `profile` ADD `facebook` VARCHAR(500) NULL AFTER `country`; 
ALTER TABLE `profile` ADD `instagram` VARCHAR(500) NULL AFTER `facebook`; 

INSERT INTO `profile` (`id`, `avatar`, `company_name`, `company_type`, `email`, `phone1`, `phone2`, `address1`, `address2`, `city`, `state`, `zip`, `country`) VALUES
(1, '', 'Demo', 'Barbería', 'axley01herrera@gmail.com', '(+34) 62 72 77 258', '', 'Calle Nepal', '# 16', 'Playa Blanca', 'Las Palmas', 35580, 'España');

#### 
  ## End Table profile
###

#### 
  ## Table service
###

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `price` float NOT NULL,
  `description` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
)

INSERT INTO `service` (`id`, `title`, `price`, `description`) VALUES
(1, 'Básico', 10, 'Corte de caballero clásico.'),
(2, 'Difuminado', 12, 'Corte de caballero con difuminado del cabello.'),
(3, 'Barba', 5, 'Perfilado de barba al gusto.'),
(4, 'Cejas', 2, 'Perfilado de cejas.');

#### 
  ## End Table service
###

#### 
  ## Table address
###

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customerID` int DEFAULT NULL,
  `employeeID` int DEFAULT NULL,
  `line1` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL,
  `line2` varchar(500) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `zip` int NOT NULL,
  `country` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
)

#### 
  ## End Table address
###

