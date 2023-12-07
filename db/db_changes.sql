DROP TABLE IF EXISTS `employee_bussines_day`;
CREATE TABLE IF NOT EXISTS `employee_bussines_day` (
  `id` int NOT NULL,
  `employeeID` int NOT NULL,
  `monday` int NOT NULL DEFAULT '1',
  `tuesday` int NOT NULL DEFAULT '1',
  `wednesday` int NOT NULL DEFAULT '1',
  `thursday` int NOT NULL DEFAULT '1',
  `friday` int NOT NULL DEFAULT '1',
  `saturday` int NOT NULL DEFAULT '1',
  `sunday` int NOT NULL DEFAULT '1'
);

DROP TABLE IF EXISTS `employee_shift_day`;
CREATE TABLE IF NOT EXISTS `employee_shift_day` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employeeID` int NOT NULL,
  `day` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  PRIMARY KEY (`id`)
)