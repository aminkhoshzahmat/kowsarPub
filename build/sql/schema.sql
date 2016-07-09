
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `user_id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_name` VARCHAR(30) NOT NULL,
    `user_family` VARCHAR(40),
    PRIMARY KEY (`user_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- admins
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins`
(
    `admin_id` INTEGER NOT NULL AUTO_INCREMENT,
    `admin_name` VARCHAR(30) NOT NULL,
    `admin_family` VARCHAR(40),
    PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
