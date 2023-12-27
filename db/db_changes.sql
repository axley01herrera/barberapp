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