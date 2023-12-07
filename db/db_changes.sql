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