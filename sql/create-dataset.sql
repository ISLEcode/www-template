-- CREATE DATABASE blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- CREATE USER 'rest_api_user'@'localhost' identified by 'rest_api_password';
USE gp_patinfo;
GRANT ALL on gp_patinfo.* to 'SAMmobile'@'localhost';
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(255),
  `author_picture` varchar(255),
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
