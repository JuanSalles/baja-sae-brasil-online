<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1698801960.
 * Generated on 2023-11-01 01:26:00 by ubuntu
 */
class PropelMigration_1698801960
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

ALTER TABLE `equipe`

  ADD `cidade` VARCHAR(100) NOT NULL AFTER `escola_curto`;

ALTER TABLE `fila`

  CHANGE `tempo_espera` `tempo_espera` INTEGER(11);

ALTER TABLE `prova`

  CHANGE `modificado` `modificado` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE `senha`

  CHANGE `senha` `senha` INTEGER(11) NOT NULL AUTO_INCREMENT;

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

ALTER TABLE `equipe`

  DROP `cidade`;

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