-- MySQL Script generated by MySQL Workbench
-- Sun Aug 27 21:11:50 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gym_argente
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `gym_argente` ;

-- -----------------------------------------------------
-- Schema gym_argente
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gym_argente` DEFAULT CHARACTER SET utf8 ;
USE `gym_argente` ;

-- -----------------------------------------------------
-- Table `gym_argente`.`personnes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gym_argente`.`personnes` ;

CREATE TABLE IF NOT EXISTS `gym_argente`.`personnes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `prenom` VARCHAR(48) NOT NULL,
  `nom` VARCHAR(48) NOT NULL,
  `adresse` VARCHAR(256) NULL,
  `telephone` BIGINT UNSIGNED NOT NULL,
  `courriel` VARCHAR(96) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gym_argente`.`gestionnaires`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gym_argente`.`gestionnaires` ;

CREATE TABLE IF NOT EXISTS `gym_argente`.`gestionnaires` (
  `personne` INT UNSIGNED NOT NULL,
  `mot_passe` CHAR(97) NOT NULL,
  PRIMARY KEY (`personne`),
  UNIQUE INDEX `personne_UNIQUE` (`personne` ASC) VISIBLE,
  CONSTRAINT `personne_gestionnaire`
    FOREIGN KEY (`personne`)
    REFERENCES `gym_argente`.`personnes` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gym_argente`.`specialites`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gym_argente`.`specialites` ;

CREATE TABLE IF NOT EXISTS `gym_argente`.`specialites` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gym_argente`.`specialistes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gym_argente`.`specialistes` ;

CREATE TABLE IF NOT EXISTS `gym_argente`.`specialistes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `personne` INT UNSIGNED NOT NULL,
  `specialite` INT UNSIGNED NOT NULL,
  `mot_passe` CHAR(97) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `personne_idx` (`personne` ASC) VISIBLE,
  INDEX `specialite_idx` (`specialite` ASC) VISIBLE,
  CONSTRAINT `personne_specialiste`
    FOREIGN KEY (`personne`)
    REFERENCES `gym_argente`.`personnes` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `specialite`
    FOREIGN KEY (`specialite`)
    REFERENCES `gym_argente`.`specialites` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gym_argente`.`plans`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gym_argente`.`plans` ;

CREATE TABLE IF NOT EXISTS `gym_argente`.`plans` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(48) NOT NULL,
  `duree` TINYINT NOT NULL,
  `prix` DECIMAL NOT NULL,
  `acces_appareils` TINYINT NOT NULL DEFAULT 0,
  `acces_cours_groupe` TINYINT NOT NULL DEFAULT 0,
  `prix_cours_groupe` DECIMAL NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gym_argente`.`clients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gym_argente`.`clients` ;

CREATE TABLE IF NOT EXISTS `gym_argente`.`clients` (
  `personne` INT UNSIGNED NOT NULL,
  `adhesion` DATE NOT NULL,
  `renouvellement` DATE NOT NULL,
  `fin_abonnement` DATE NOT NULL,
  `fin_acces_appareils` DATE NOT NULL,
  `heures_specialistes` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `heures_specialistes_utilise` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `cours_groupe_semaine` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `plan` INT UNSIGNED NULL,
  PRIMARY KEY (`personne`),
  UNIQUE INDEX `personne_UNIQUE` (`personne` ASC) VISIBLE,
  INDEX `plan_idx` (`plan` ASC) VISIBLE,
  CONSTRAINT `personne_client`
    FOREIGN KEY (`personne`)
    REFERENCES `gym_argente`.`personnes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `plan`
    FOREIGN KEY (`plan`)
    REFERENCES `gym_argente`.`plans` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gym_argente`.`rendez_vous`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gym_argente`.`rendez_vous` ;

CREATE TABLE IF NOT EXISTS `gym_argente`.`rendez_vous` (
  `date_heure` DATETIME NOT NULL,
  `client` INT UNSIGNED NOT NULL,
  `specialiste` INT UNSIGNED NOT NULL,
  INDEX `client_idx` (`client` ASC) VISIBLE,
  INDEX `specialiste_idx` (`specialiste` ASC) VISIBLE,
  CONSTRAINT `client`
    FOREIGN KEY (`client`)
    REFERENCES `gym_argente`.`clients` (`personne`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `specialiste`
    FOREIGN KEY (`specialiste`)
    REFERENCES `gym_argente`.`specialistes` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gym_argente`.`types_notifications`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gym_argente`.`types_notifications` ;

CREATE TABLE IF NOT EXISTS `gym_argente`.`types_notifications` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gym_argente`.`notifications`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gym_argente`.`notifications` ;

CREATE TABLE IF NOT EXISTS `gym_argente`.`notifications` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_heure` DATETIME NOT NULL,
  `type` INT UNSIGNED NOT NULL,
  `client` INT UNSIGNED NOT NULL,
  `vu` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `type_idx` (`type` ASC) VISIBLE,
  INDEX `client_idx` (`client` ASC) VISIBLE,
  CONSTRAINT `type`
    FOREIGN KEY (`type`)
    REFERENCES `gym_argente`.`types_notifications` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `client_notification`
    FOREIGN KEY (`client`)
    REFERENCES `gym_argente`.`clients` (`personne`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
