-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema infoclinic
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema infoclinic
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `infoclinic` DEFAULT CHARACTER SET latin1 ;
USE `infoclinic` ;

-- -----------------------------------------------------
-- Table `infoclinic`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`usuarios` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `telefone` VARCHAR(13) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `celular` VARCHAR(14) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `rg` VARCHAR(20) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `cep` VARCHAR(9) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `logradouro` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `numero` VARCHAR(10) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `bairro` VARCHAR(80) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `complemento` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `cidade` VARCHAR(40) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `estado` VARCHAR(2) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `email` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `password` VARCHAR(60) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `remember_token` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `usuarios_email_unique` (`email` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 8;


-- -----------------------------------------------------
-- Table `infoclinic`.`administradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`administradores` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `permissao_especial` TINYINT(1) NOT NULL DEFAULT '0',
  `bloqueado` TINYINT(1) NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `usuario_id` INT(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `administradores_usuario_id_foreign` (`usuario_id` ASC),
  CONSTRAINT `administradores_usuario_id_foreign`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `infoclinic`.`usuarios` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2;


-- -----------------------------------------------------
-- Table `infoclinic`.`clinicas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`clinicas` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cnpj` VARCHAR(18) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `razao_social` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `data_inauguracao` DATE NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `descricao` VARCHAR(255) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `horario_inicio_func` TIME NULL DEFAULT NULL,
  `horario_fim_func` TIME NULL DEFAULT NULL,
  `domingo` TINYINT(1) NULL DEFAULT NULL,
  `segunda` TINYINT(1) NULL DEFAULT NULL,
  `terca` TINYINT(1) NULL DEFAULT NULL,
  `quarta` TINYINT(1) NULL DEFAULT NULL,
  `quinta` TINYINT(1) NULL DEFAULT NULL,
  `sexta` TINYINT(1) NULL DEFAULT NULL,
  `sabado` TINYINT(1) NULL DEFAULT NULL,
  `administrador_id` INT(10) UNSIGNED NOT NULL,
  `bloqueado` TINYINT(1) NOT NULL DEFAULT '0',
  `cep_clinica` VARCHAR(9) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `logradouro_clinica` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `numero_clinica` VARCHAR(10) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `bairro_clinica` VARCHAR(80) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `complemento_clinica` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `cidade_clinica` VARCHAR(40) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `estado_clinica` VARCHAR(2) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `usuario_id` INT(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `clinicas_cnpj_unique` (`cnpj` ASC),
  UNIQUE INDEX `clinicas_razao_social_unique` (`razao_social` ASC),
  INDEX `clinicas_administrador_id_foreign` (`administrador_id` ASC),
  INDEX `clinicas_usuario_id_foreign` (`usuario_id` ASC),
  CONSTRAINT `clinicas_administrador_id_foreign`
    FOREIGN KEY (`administrador_id`)
    REFERENCES `infoclinic`.`administradores` (`id`),
  CONSTRAINT `clinicas_usuario_id_foreign`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `infoclinic`.`usuarios` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3;


-- -----------------------------------------------------
-- Table `infoclinic`.`paises`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`paises` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `sigla` VARCHAR(4) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2;


-- -----------------------------------------------------
-- Table `infoclinic`.`estados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`estados` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `uf` VARCHAR(2) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `pais_id` INT(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `estados_pais_id_foreign` (`pais_id` ASC),
  CONSTRAINT `estados_pais_id_foreign`
    FOREIGN KEY (`pais_id`)
    REFERENCES `infoclinic`.`paises` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 28;


-- -----------------------------------------------------
-- Table `infoclinic`.`medicos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`medicos` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bloqueado` TINYINT(1) NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `usuario_id` INT(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `medicos_usuario_id_foreign` (`usuario_id` ASC),
  CONSTRAINT `medicos_usuario_id_foreign`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `infoclinic`.`usuarios` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4;


-- -----------------------------------------------------
-- Table `infoclinic`.`registros_regional`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`registros_regional` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `medico_id` INT(10) UNSIGNED NOT NULL,
  `numero` VARCHAR(30) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `estado_id` INT(10) UNSIGNED NOT NULL,
  `bloqueado` TINYINT(1) NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `tipo_registro` VARCHAR(10) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `registros_regional_estado_id_foreign` (`estado_id` ASC),
  INDEX `registros_regional_medico_id_foreign` (`medico_id` ASC),
  CONSTRAINT `registros_regional_estado_id_foreign`
    FOREIGN KEY (`estado_id`)
    REFERENCES `infoclinic`.`estados` (`id`),
  CONSTRAINT `registros_regional_medico_id_foreign`
    FOREIGN KEY (`medico_id`)
    REFERENCES `infoclinic`.`medicos` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3;


-- -----------------------------------------------------
-- Table `infoclinic`.`vinculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`vinculos` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `registro_id` INT(10) UNSIGNED NOT NULL,
  `clinica_id` INT(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `vinculos_registro_id_foreign` (`registro_id` ASC),
  INDEX `vinculos_clinica_id_foreign` (`clinica_id` ASC),
  CONSTRAINT `vinculos_clinica_id_foreign`
    FOREIGN KEY (`clinica_id`)
    REFERENCES `infoclinic`.`clinicas` (`id`),
  CONSTRAINT `vinculos_registro_id_foreign`
    FOREIGN KEY (`registro_id`)
    REFERENCES `infoclinic`.`registros_regional` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3;


-- -----------------------------------------------------
-- Table `infoclinic`.`agendamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`agendamentos` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vinculo_id` INT(10) UNSIGNED NOT NULL,
  `data_agendamento` DATETIME NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `agendamentos_vinculo_id_data_agendamento_unique` (`vinculo_id` ASC, `data_agendamento` ASC),
  CONSTRAINT `agendamentos_vinculo_id_foreign`
    FOREIGN KEY (`vinculo_id`)
    REFERENCES `infoclinic`.`vinculos` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 21;


-- -----------------------------------------------------
-- Table `infoclinic`.`atendentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`atendentes` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `carteira` VARCHAR(14) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `cnpj` VARCHAR(18) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `clinica_id` INT(10) UNSIGNED NOT NULL,
  `bloqueado` TINYINT(1) NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `usuario_id` INT(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `atendentes_clinica_id_foreign` (`clinica_id` ASC),
  INDEX `atendentes_usuario_id_foreign` (`usuario_id` ASC),
  CONSTRAINT `atendentes_clinica_id_foreign`
    FOREIGN KEY (`clinica_id`)
    REFERENCES `infoclinic`.`clinicas` (`id`),
  CONSTRAINT `atendentes_usuario_id_foreign`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `infoclinic`.`usuarios` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4;


-- -----------------------------------------------------
-- Table `infoclinic`.`especialidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`especialidades` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `descricao` TEXT COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 50;


-- -----------------------------------------------------
-- Table `infoclinic`.`pacientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`pacientes` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cpf` VARCHAR(14) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `tipo_sanguineo` VARCHAR(2) COLLATE 'utf8mb4_unicode_ci' NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `fator_rh` TINYINT(1) NULL,
  `sexo` VARCHAR(1) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `estado_civil` VARCHAR(15) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `peso` DOUBLE NULL DEFAULT NULL,
  `altura` DOUBLE NULL DEFAULT NULL,
  `usuario_id` INT(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `pacientes_cpf_unique` (`cpf` ASC),
  INDEX `pacientes_usuario_id_foreign` (`usuario_id` ASC),
  CONSTRAINT `pacientes_usuario_id_foreign`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `infoclinic`.`usuarios` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8;


-- -----------------------------------------------------
-- Table `infoclinic`.`consultas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`consultas` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queixa_principal` VARCHAR(1000) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `principais_sintomas` VARCHAR(1000) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `exame_fisico` VARCHAR(1000) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `hipotese_diagnostica` VARCHAR(1000) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `orientacao` VARCHAR(1000) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `status` INT(11) NOT NULL,
  `justificativa` VARCHAR(255) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `retorno_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `agendamento_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `paciente_id` INT(10) UNSIGNED NOT NULL,
  `especialidade_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `consultas_agendamento_id_foreign` (`agendamento_id` ASC),
  INDEX `consultas_retorno_id_foreign` (`retorno_id` ASC),
  INDEX `consultas_paciente_id_foreign` (`paciente_id` ASC),
  INDEX `consultas_especialidade_id_foreign` (`especialidade_id` ASC),
  CONSTRAINT `consultas_agendamento_id_foreign`
    FOREIGN KEY (`agendamento_id`)
    REFERENCES `infoclinic`.`agendamentos` (`id`),
  CONSTRAINT `consultas_especialidade_id_foreign`
    FOREIGN KEY (`especialidade_id`)
    REFERENCES `infoclinic`.`especialidades` (`id`),
  CONSTRAINT `consultas_paciente_id_foreign`
    FOREIGN KEY (`paciente_id`)
    REFERENCES `infoclinic`.`pacientes` (`id`),
  CONSTRAINT `consultas_retorno_id_foreign`
    FOREIGN KEY (`retorno_id`)
    REFERENCES `infoclinic`.`consultas` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 19;


-- -----------------------------------------------------
-- Table `infoclinic`.`dias_atendimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`dias_atendimento` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vinculo_id` INT(10) UNSIGNED NOT NULL,
  `dia_semana` INT(11) NOT NULL,
  `horario_inicio` TIME NOT NULL,
  `horario_fim` TIME NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `dias_atendimento_vinculo_id_foreign` (`vinculo_id` ASC),
  CONSTRAINT `dias_atendimento_vinculo_id_foreign`
    FOREIGN KEY (`vinculo_id`)
    REFERENCES `infoclinic`.`vinculos` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11;


-- -----------------------------------------------------
-- Table `infoclinic`.`exames`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`exames` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `nome_arquivo` VARCHAR(255) COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4;


-- -----------------------------------------------------
-- Table `infoclinic`.`linhas_prontuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`linhas_prontuario` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `paciente_id` INT(10) UNSIGNED NOT NULL,
  `exame_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `consulta_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `bloqueado` TINYINT(1) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `linhas_prontuario_paciente_id_foreign` (`paciente_id` ASC),
  INDEX `linhas_prontuario_exame_id_foreign` (`exame_id` ASC),
  INDEX `linhas_prontuario_consulta_id_foreign` (`consulta_id` ASC),
  CONSTRAINT `linhas_prontuario_consulta_id_foreign`
    FOREIGN KEY (`consulta_id`)
    REFERENCES `infoclinic`.`consultas` (`id`),
  CONSTRAINT `linhas_prontuario_exame_id_foreign`
    FOREIGN KEY (`exame_id`)
    REFERENCES `infoclinic`.`exames` (`id`),
  CONSTRAINT `linhas_prontuario_paciente_id_foreign`
    FOREIGN KEY (`paciente_id`)
    REFERENCES `infoclinic`.`pacientes` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 21;


-- -----------------------------------------------------
-- Table `infoclinic`.`prescricoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`prescricoes` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_remedio` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `quantidade` DOUBLE NOT NULL,
  `unidade_medida` VARCHAR(100) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `consulta_id` INT(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `periodo` VARCHAR(255) COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `prescricoes_consulta_id_foreign` (`consulta_id` ASC),
  CONSTRAINT `prescricoes_consulta_id_foreign`
    FOREIGN KEY (`consulta_id`)
    REFERENCES `infoclinic`.`consultas` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11;


-- -----------------------------------------------------
-- Table `infoclinic`.`registros_regional_especialidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`registros_regional_especialidades` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `registros_regional_id` INT(10) UNSIGNED NOT NULL,
  `especialidade_id` INT(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `registros_regional_especialidade_unique` (`registros_regional_id` ASC, `especialidade_id` ASC),
  INDEX `registros_regional_especialidades_especialidade_id_foreign` (`especialidade_id` ASC),
  CONSTRAINT `registros_regional_especialidades_especialidade_id_foreign`
    FOREIGN KEY (`especialidade_id`)
    REFERENCES `infoclinic`.`especialidades` (`id`),
  CONSTRAINT `registros_regional_especialidades_registros_regional_id_foreign`
    FOREIGN KEY (`registros_regional_id`)
    REFERENCES `infoclinic`.`registros_regional` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4;


-- -----------------------------------------------------
-- Table `infoclinic`.`vinculos_registro_especialidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `infoclinic`.`vinculos_registro_especialidades` (
  `vinculo_id` INT(10) UNSIGNED NOT NULL,
  `registro_especialidade_id` INT(10) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`vinculo_id`, `registro_especialidade_id`),
  INDEX `registro_regional_especialidade_foreign` (`registro_especialidade_id` ASC),
  CONSTRAINT `registro_regional_especialidade_foreign`
    FOREIGN KEY (`registro_especialidade_id`)
    REFERENCES `infoclinic`.`registros_regional_especialidades` (`id`),
  CONSTRAINT `vinculos_registro_especialidades_vinculo_id_foreign`
    FOREIGN KEY (`vinculo_id`)
    REFERENCES `infoclinic`.`vinculos` (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
