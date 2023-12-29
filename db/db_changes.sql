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

SELECT
    `appointment`.`id` AS `appointmentID`,
    `appointment`.`customerID` AS `customerID`,
    `appointment`.`employeeID` AS `employeeID`,
    `appointment`.`date` AS `date`,
    `appointment`.`start` AS `start`,
    `employee`.`name` AS `employeeName`,
    `employee`.`lastName` AS `employeeLastName`,
    `customer`.`name` AS `customerName`,
    `customer`.`lastName` AS `customerLastName`,
    json_arrayagg(
        JSON_OBJECT(
            'serviceID',
            `service`.`id`,
            'serviceTitle',
            `service`.`title`,
            'servicePrice',
            `service`.`price`,
            'serviceTime',
            `service`.`time`
        )
    ) AS `servicesJSON`,
    SUM(`service`.`price`) AS `totalPrice`,
    SUM(`service`.`time`) AS `totalTime`
FROM
    (
        (
            (
                (
                    `appointment`
                JOIN `employee` ON
                    (
                        (
                            `employee`.`id` = `appointment`.`employeeID`
                        )
                    )
                )
            JOIN `customer` ON
                (
                    (
                        `customer`.`id` = `appointment`.`customerID`
                    )
                )
            )
        JOIN json_table(
                `appointment`.`services`,
                '$[*]' COLUMNS(
                    `service_id` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci path '$'
                )
            ) `json_services`
        )
    JOIN `service` ON
        (
            (
                `service`.`id` = `json_services`.`service_id`
            )
        )
    )
GROUP BY
    `appointment`.`id`;