
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- equipe
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `equipe`;

CREATE TABLE `equipe`
(
    `evento_id` CHAR(4) NOT NULL,
    `equipe_id` INTEGER NOT NULL,
    `escola` VARCHAR(100) NOT NULL,
    `escola_curto` VARCHAR(100) NOT NULL,
    `cidade` VARCHAR(100) NOT NULL,
    `equipe` VARCHAR(100) NOT NULL,
    `equipe_curto` VARCHAR(100) NOT NULL,
    `estado` CHAR(2),
    `presente` TINYINT(1) DEFAULT 1 NOT NULL,
    PRIMARY KEY (`evento_id`,`equipe_id`),
    INDEX `equipe_evento_id_idx` (`evento_id`),
    INDEX `i_referenced_senha_equipe_id_1` (`equipe_id`, `evento_id`),
    CONSTRAINT `equipe_evento_id`
        FOREIGN KEY (`evento_id`)
        REFERENCES `evento` (`evento_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- evento
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `evento`;

CREATE TABLE `evento`
(
    `evento_id` CHAR(4) NOT NULL,
    `titulo` VARCHAR(100),
    `nome` VARCHAR(120),
    `tipo` TINYINT,
    `ano` INTEGER(4),
    `menu` json,
    `ativo` TINYINT(1) DEFAULT 1 NOT NULL,
    `finalizado` TINYINT(1) DEFAULT 0 NOT NULL,
    `spoilers` TINYINT(1) DEFAULT 0 NOT NULL,
    `tem_certificado` TINYINT(1) DEFAULT 0 NOT NULL,
    `presidente` VARCHAR(45),
    `data` VARCHAR(100),
    `mandato_presidente` VARCHAR(9),
    `local` VARCHAR(120),
    `em_andamento` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`evento_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- input
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `input`;

CREATE TABLE `input`
(
    `evento_id` CHAR(4) NOT NULL,
    `prova_id` CHAR(3) NOT NULL,
    `equipe_id` INTEGER NOT NULL,
    `dados` json,
    `vars` json,
    `pontos` json,
    PRIMARY KEY (`evento_id`,`prova_id`,`equipe_id`),
    INDEX `input_evento_id_prova_id_idx` (`evento_id`, `prova_id`),
    INDEX `input_evento_id_equipe_id_idx` (`evento_id`, `equipe_id`),
    CONSTRAINT `input_evento_id_prova_id`
        FOREIGN KEY (`evento_id`,`prova_id`)
        REFERENCES `prova` (`evento_id`,`prova_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `input_evento_id_equipe_id`
        FOREIGN KEY (`evento_id`,`equipe_id`)
        REFERENCES `equipe` (`evento_id`,`equipe_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tournament
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tournament`;

CREATE TABLE `tournament`
(
    `evento_id` CHAR(16) NOT NULL,
    `prova_id` CHAR(3) NOT NULL,
    `match_id` INTEGER NOT NULL,
    `round` CHAR(3) NOT NULL,
    `equipe1_id` CHAR(6),
    `equipe2_id` CHAR(6),
    `winner` INTEGER,
    `dados` json,
    PRIMARY KEY (`evento_id`,`prova_id`,`match_id`),
    INDEX `fi_rnament_evento_id_equipe_idwin` (`evento_id`, `winner`),
    CONSTRAINT `tournament_evento_id_prova_id`
        FOREIGN KEY (`evento_id`,`prova_id`)
        REFERENCES `prova` (`evento_id`,`prova_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT `tournament_evento_id_equipe_idwin`
        FOREIGN KEY (`evento_id`,`winner`)
        REFERENCES `equipe` (`evento_id`,`equipe_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- log
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log`
(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `user` VARCHAR(45),
    `pagina` VARCHAR(8),
    `equipe` INTEGER,
    `dados` TEXT,
    `data` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- participantes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `participantes`;

CREATE TABLE `participantes`
(
    `idparticipantes` INTEGER NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(300),
    `funcao` VARCHAR(45),
    `cpf` BIGINT(11),
    `evento` CHAR(4) NOT NULL,
    PRIMARY KEY (`idparticipantes`,`evento`),
    INDEX `participantes_evento_id_idx` (`evento`),
    CONSTRAINT `participantes_evento_id`
        FOREIGN KEY (`evento`)
        REFERENCES `evento` (`evento_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- prova
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `prova`;

CREATE TABLE `prova`
(
    `evento_id` CHAR(4) NOT NULL,
    `prova_id` CHAR(3) NOT NULL,
    `nome` VARCHAR(45) NOT NULL,
    `status` TINYINT DEFAULT 0 NOT NULL,
    `tempo` INTEGER(14),
    `modificado` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `params` json,
    `totals` json,
    PRIMARY KEY (`evento_id`,`prova_id`),
    INDEX `prova_evento_id_idx` (`evento_id`),
    CONSTRAINT `prova_evento_id`
        FOREIGN KEY (`evento_id`)
        REFERENCES `evento` (`evento_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- resultado
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `resultado`;

CREATE TABLE `resultado`
(
    `resultado_id` CHAR(8) NOT NULL,
    `evento_id` CHAR(4) NOT NULL,
    `nome` VARCHAR(45) NOT NULL,
    `inputs` TEXT,
    `colunas` json,
    PRIMARY KEY (`resultado_id`),
    INDEX `resultado_evento_id_idx` (`evento_id`),
    CONSTRAINT `resultado_evento_id`
        FOREIGN KEY (`evento_id`)
        REFERENCES `evento` (`evento_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `user_id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(45),
    `permissions` TEXT,
    `last_login` TIMESTAMP NULL,
    PRIMARY KEY (`user_id`),
    UNIQUE INDEX `username_UNIQUE` (`username`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- fila
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fila`;

CREATE TABLE `fila`
(
    `evento_id` CHAR(16) NOT NULL,
    `fila_id` INTEGER(4) NOT NULL,
    `nome` VARCHAR(45) NOT NULL,
    `status` TINYINT(1) DEFAULT 0 NOT NULL,
    `permite_troca` TINYINT(1) DEFAULT 0 NOT NULL,
    `permite_multiplas` TINYINT(1) DEFAULT 0 NOT NULL,
    `permite_chamada_espera` TINYINT(1) DEFAULT 1 NOT NULL,
    `tempo_espera` INTEGER(11),
    `abertura_programada` TIMESTAMP NULL,
    `fechamento_programado` TIMESTAMP NULL,
    PRIMARY KEY (`evento_id`,`fila_id`),
    CONSTRAINT `fila_evento_id`
        FOREIGN KEY (`evento_id`)
        REFERENCES `evento` (`evento_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- senha
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `senha`;

CREATE TABLE `senha`
(
    `evento_id` CHAR(16) NOT NULL,
    `fila_id` INTEGER(4) NOT NULL,
    `senha` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `equipe_id` INTEGER NOT NULL,
    `status` INTEGER(1) DEFAULT 0 NOT NULL,
    `ts_requisicao` BIGINT,
    `ts_status` BIGINT,
    `detalhes` json,
    PRIMARY KEY (`senha`,`evento_id`,`fila_id`,`equipe_id`),
    INDEX `fi_ha_equipe_id` (`equipe_id`, `evento_id`)
) ENGINE=MYISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
