ALTER TABLE `idot`.`admin` 
ADD COLUMN `email` VARCHAR(300) NULL AFTER `last_login`;


CREATE TABLE IF NOT EXISTS `professor` (
  `id_professor` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `login` VARCHAR(45) NULL,
  `senha` VARCHAR(255) NULL,
  `texto` text COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_professor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE `idot`.`alunos` (
  `alunos_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `matricula` VARCHAR(45) NULL,
  `login` VARCHAR(45) NULL,
  `senha` VARCHAR(255) NULL,
  `data_cadastro` VARCHAR(45) NULL,
  `endereco` VARCHAR(255) NULL,
  `turma` VARCHAR(45) NULL,
  `historico_endereco` TEXT NULL,
  PRIMARY KEY (`alunos_id`));
