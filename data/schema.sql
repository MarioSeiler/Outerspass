-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

CREATE TABLE  `user` (
  id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
  firstName VARCHAR(64)  NOT NULL,
  lastName  VARCHAR(64)  NOT NULL,
  email     VARCHAR(128) NOT NULL,
  password  VARCHAR(255)  NOT NULL,
  PRIMARY KEY  (id)
);
-- -----------------------------------------------------
-- Table `mydb`.`Genre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Genre` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `genre` VARCHAR(64) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Videospiel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Videospiel` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titel` VARCHAR(64) NOT NULL,
  `publisher` VARCHAR(64) NOT NULL,
  `trailer` VARCHAR(128) NOT NULL,
  `price` DOUBLE NOT NULL,
  `genre_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Videospiel_Genre1_idx` (`genre_id` ASC) ,
  CONSTRAINT `fk_Videospiel_Genre1`
    FOREIGN KEY (`genre_id`)
    REFERENCES `Genre` (`id`)
    ON DELETE Cascade
    ON UPDATE NO ACTION)
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `mydb`.`Bestellung`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Bestellung` (
  `id` INT UNSigned NOT NULL AUTO_INCREMENT,
  `user_id` INT Unsigned NOT NULL,
  `videospiel_id` INT Unsigned NOT NULL,
  `istGekauft` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Bestellung_Benutzer_idx` (`user_id` ASC),
  INDEX `fk_Bestellung_Videospiel1_idx` (`videospiel_id` ASC),
  CONSTRAINT `fk_Bestellung_Benutzer`
    FOREIGN KEY (`user_id`)
    REFERENCES user (`id`)
    ON DELETE Cascade
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Bestellung_Videospiel1`
    FOREIGN KEY (`videospiel_id`)
    REFERENCES `Videospiel` (`id`)
    ON DELETE Cascade
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

create user xTabstopp@localhost identified by "Sommer2018$";

grant insert, UPDATE ,DELETE, SELECT on user to xTabstopp@localhost;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
