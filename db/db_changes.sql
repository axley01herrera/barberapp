DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int NOT NULL,
  `name` int NOT NULL,
  `type` int NOT NULL DEFAULT '0' COMMENT '0 = ALL\r\n1 = Employees\r\n2 = Customers',
  `status` int NOT NULL DEFAULT '0' COMMENT '0 = Inactive\r\n1 = Active',
  `request` int NOT NULL COMMENT '0 = null\r\n1 = send',
  `response` int NOT NULL COMMENT '0 = null\r\n1 = send'
)