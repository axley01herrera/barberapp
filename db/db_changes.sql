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
CREATE VIEW `view_appointment` AS SELECT
    `barber_dev`.`appointment`.`id` AS `appointmentID`,
    `barber_dev`.`appointment`.`customerID` AS `customerID`,
    `barber_dev`.`appointment`.`employeeID` AS `employeeID`,
    `barber_dev`.`appointment`.`date` AS `date`,
    `barber_dev`.`appointment`.`start` AS `start`,
    `barber_dev`.`appointment`.`end` AS `end`,
    `barber_dev`.`employee`.`name` AS `employeeName`,
    `barber_dev`.`employee`.`lastName` AS `employeeLastName`,
    `barber_dev`.`customer`.`name` AS `customerName`,
    `barber_dev`.`customer`.`lastName` AS `customerLastName`,
    json_arrayagg(
        JSON_OBJECT(
            'serviceID',
            `barber_dev`.`service`.`id`,
            'serviceTitle',
            `barber_dev`.`service`.`title`,
            'servicePrice',
            `barber_dev`.`service`.`price`,
            'serviceTime',
            `barber_dev`.`service`.`time`
        )
    ) AS `servicesJSON`,
    UNIX_TIMESTAMP(
        CONCAT(
            `barber_dev`.`appointment`.`date`,
            ' ',
            `barber_dev`.`appointment`.`start`
        )
    ) AS `appointmentTimestamp`,
    SUM(`barber_dev`.`service`.`price`) AS `totalPrice`,
    SUM(`barber_dev`.`service`.`time`) AS `totalTime`
FROM
    (
        (
            (
                (
                    `barber_dev`.`appointment`
                JOIN `barber_dev`.`employee` ON
                    (
                        (
                            `barber_dev`.`employee`.`id` = `barber_dev`.`appointment`.`employeeID`
                        )
                    )
                )
            JOIN `barber_dev`.`customer` ON
                (
                    (
                        `barber_dev`.`customer`.`id` = `barber_dev`.`appointment`.`customerID`
                    )
                )
            )
        JOIN json_table(
                `barber_dev`.`appointment`.`services`,
                '$[*]' COLUMNS(
                    `service_id` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci path '$'
                )
            ) `json_services`
        )
    JOIN `barber_dev`.`service` ON
        (
            (
                `barber_dev`.`service`.`id` = `json_services`.`service_id`
            )
        )
    )
GROUP BY
    `barber_dev`.`appointment`.`id`
ORDER BY
    `appointmentTimestamp`
DESC;
