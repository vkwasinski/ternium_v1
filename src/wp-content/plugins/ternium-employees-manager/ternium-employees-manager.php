<?php defined( 'ABSPATH' ) or die( 'No cookie for you!' );
/*
Plugin Name:  Ternium Employees Manager
Plugin URI:   https://dev.wplabs
Description:  Employees Importation from Spreadsheet
Version:      1.0.0
Author:       Vinícius Kwasinski <vkwasinski@gmail.com>
Author URI:   https://dev.etc.br
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
Domain Path:  /languages
*/

/*
Ternium Employees Manager is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Ternium Employees Manager is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Ternium Employees Manager. If not, see https://dev.wplabs.
*/


/**
 *  Installs plugin
 */
function tem_install()
{
    global $wpdb;

    $prefix = $wpdb->prefix;
    $database = (object) [
        'employees'     => $prefix.'employees',
        'dependents'    => $prefix.'dependents',
    ];

    $charset = $wpdb->get_charset_collate();

    $queries = [
        "CREATE TABLE IF NOT EXISTS `{$database->employees}`
        (
            `id` INT(10) NOT NULL AUTO_INCREMENT,
            `matricula` VARCHAR(255) NOT NULL,
            `nome` VARCHAR(255) NOT NULL,
            `escala` VARCHAR(255) NOT NULL,
            `data_festa` VARCHAR(255) NOT NULL,
            `cpf` VARCHAR(255) NULL,
            `cargo_nome` VARCHAR(255) NOT NULL,
            `estado_civil` VARCHAR(255) NULL,
            `endereco` VARCHAR(255) NOT NULL,
            `cep` VARCHAR(255) NOT NULL,
            `8_id` VARCHAR(255) NULL,
            `confirmado` BIT NOT NULL DEFAULT false,
            `obs` LONGTEXT NULL DEFAULT NULL,
            `email` VARCHAR(255) NULL DEFAULT NULL,
            `telefone` VARCHAR(255) NULL DEFAULT NULL,
            `senha` VARCHAR(255) NULL DEFAULT NULL,
            `onibus` BIT NOT NULL DEFAULT false,
            PRIMARY KEY (`id`),
            INDEX `MAT_INDEX` (`matricula` ASC),
            INDEX `CPF_INDEX` (`cpf` ASC)
        ) ENGINE = InnoDB",

        "CREATE TABLE IF NOT EXISTS `{$database->dependents}`
        (
            `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `employees_id` INT(10) NOT NULL,
            `nome` VARCHAR(255) NULL,
            `parentesco` VARCHAR(255) NOT NULL,
            `data_nascimento` VARCHAR(255) NOT NULL,
            `confirmado` BIT NOT NULL DEFAULT false,
            PRIMARY KEY (`id`),
            INDEX `fk_dependents_employees_idx` (`employees_id` ASC),
            CONSTRAINT `fk_dependents_employees`
                FOREIGN KEY (`employees_id`)
                REFERENCES `ternium_v1`.`employees` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
        ) ENGINE = InnoDB",
    ];

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    foreach($queries as $query)  dbDelta($query);
}

// run install
tem_install();

// options page
require_once( plugin_dir_path(__FILE__) . '/options.php');
