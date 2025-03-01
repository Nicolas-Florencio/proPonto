-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema eventos
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `eventos` ;

-- -----------------------------------------------------
-- Schema eventos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `eventos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `eventos` ;

-- -----------------------------------------------------
-- Table `eventos`.`evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eventos`.`evento` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  `descricao` VARCHAR(150) NULL DEFAULT NULL,
  `endereco` VARCHAR(200) NOT NULL,
  `link_endereco` VARCHAR(50) NULL DEFAULT NULL,
  `dataHora_inicio` DATETIME NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `preco` DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `eventos`.`tiposevento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eventos`.`tiposevento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

/*inserts dos tipos de eventos*/
insert into tiposEvento (tipo) VALUES
/*social, cultural, esportivo, corporativo, religioso, entretenimento*/
("social"),
("cultural"),
("esportivo"),
("corporativo"),
("religioso"),
("entretenimento");