<?php
/**
 * Created by PhpStorm.
 * User: Jean Chagas
 * Date: 21/08/18
 * Time: 10:50 *
 * About: self::Framework
 *
 **/

/**
 * Determante de tempo padrão do sistema
 */

date_default_timezone_set('America/Sao_Paulo');

/**
 *   Reportar todos erros do PHP
 **/

error_reporting(E_ALL);

if (!defined('ROOT_PATH')) {

    chdir(dirname(__FILE__));
    define('ROOT_PATH', dirname(__FILE__));
    define('DS', DIRECTORY_SEPARATOR);
    require_once(ROOT_PATH . DS . 'libraries/config.php');
}

require_once(ROOT_PATH . DS .'settings.php');