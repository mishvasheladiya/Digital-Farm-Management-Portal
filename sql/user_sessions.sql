CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `session_id` VARCHAR(255) NOT NULL, -- This stores the PHP session_id()
  `device_name` VARCHAR(255) DEFAULT 'Unknown Device',
  `browser` VARCHAR(100) DEFAULT NULL,
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `last_active` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`) -- Added for faster lookups
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
