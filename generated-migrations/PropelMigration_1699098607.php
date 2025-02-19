<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1699098607.
 * Generated on 2023-11-04 11:50:07 by root
 */
class PropelMigration_1699098607
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'resultados' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `fila`

  CHANGE `tempo_espera` `tempo_espera` INTEGER(11);

ALTER TABLE `prova`

  CHANGE `modificado` `modificado` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE `senha`

  CHANGE `senha` `senha` INTEGER(11) NOT NULL AUTO_INCREMENT;

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

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'resultados' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `tournament`;

ALTER TABLE `fila`

  CHANGE `tempo_espera` `tempo_espera` INTEGER;

ALTER TABLE `prova`

  CHANGE `modificado` `modificado` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `senha`

  CHANGE `senha` `senha` INTEGER NOT NULL AUTO_INCREMENT;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}