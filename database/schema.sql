DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sku` varchar(190) NOT NULL,
  `price` int NOT NULL,
  `type` ENUM("DVD","Book","Furniture") NOT NULL,
  `attributes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
