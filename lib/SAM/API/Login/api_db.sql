SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `api_db`

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(256) DEFAULT NULL,
  `lastname` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `created`, `modified`) VALUES
(4, 'thiru', 'paran', 'thirupparan@samuelgnanam.com', '$2y$10$WzkFdf5XG5J3o/yVLU2Tp.3QEgCfZSsm7eicVmlIrquzAlVZKScxW', NULL, NULL),
(6, 'thirupparan', 'shanmuganathan', 'thirupparan1994@gmail.com', '$2y$10$hTASwcKftQk/TIAUUY.k0uysX4CNtR54ruOcNnuL5bMplfHizpaUW', NULL, NULL),
(7, 'thirupparan', 'shanmuganathan', 'thirupparan1994@gmail.com', '$2y$10$7gU0VKQf6BU2DSIpzgUUcuiENIPjWTX9Yw4gpNhyfcSIBtQAsd0Ay', NULL, NULL),
(8, 'thirupparan', 'shanmuganathan', 'thirupparan1994@gmail.com', '$2y$10$XsGXwI8TaFO.4j2FW65LqOk1nmUGsNe/L6dbUn6OTeIgWauEfD0NW', NULL, NULL);
COMMIT;
