DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int NOT NULL,
  `name_en` varchar(150) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `name_es` varchar(150) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `type` int NOT NULL DEFAULT '0' COMMENT '0 = ALL\r\n1 = Employees\r\n2 = Customers',
  `status` int NOT NULL DEFAULT '0' COMMENT '0 = Inactive\r\n1 = Active',
  `request` int NOT NULL COMMENT '0 = null\r\n1 = send',
  `response` int NOT NULL COMMENT '0 = null\r\n1 = send'
);

INSERT INTO `modules` (`id`, `name_en`, `name_es`, `type`, `status`, `request`, `response`) VALUES
(0, 'I9 Form', 'Formulario I9', 1, 0, 0, 0);

DROP VIEW IF EXISTS `view_appointment`;
CREATE VIEW `view_appointment`  AS SELECT `appointment`.`id` AS `appointmentID`, `appointment`.`customerID` AS `customerID`, `appointment`.`employeeID` AS `employeeID`, `appointment`.`date` AS `date`, `appointment`.`start` AS `start`, `appointment`.`end` AS `end`, `employee`.`name` AS `employeeName`, `employee`.`lastName` AS `employeeLastName`, `customer`.`name` AS `customerName`, `customer`.`lastName` AS `customerLastName`, json_arrayagg(json_object('serviceID',`service`.`id`,'serviceTitle',`service`.`title`,'servicePrice',`service`.`price`,'serviceTime',`service`.`time`)) AS `servicesJSON`, sum(`service`.`price`) AS `totalPrice`, sum(`service`.`time`) AS `totalTime` FROM ((((`appointment` join `employee` on((`employee`.`id` = `appointment`.`employeeID`))) join `customer` on((`customer`.`id` = `appointment`.`customerID`))) join json_table(`appointment`.`services`, '$[*]' columns (`service_id` varchar(10) character set utf8mb4 collate utf8mb4_unicode_ci path '$')) `json_services`) join `service` on((`service`.`id` = `json_services`.`service_id`))) GROUP BY `appointment`.`id``id`  ;
