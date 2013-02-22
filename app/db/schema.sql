SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `regi` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `regi` ;

-- -----------------------------------------------------
-- Table `regi`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `regi`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `display_name` VARCHAR(45) NOT NULL ,
  `real_name` VARCHAR(45) NULL ,
  `location` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `date_of_birth` DATE NULL ,
  `bio` TEXT NULL ,
  `photo` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
