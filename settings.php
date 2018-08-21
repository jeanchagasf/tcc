<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 21/08/18
 * Time: 11:22
 */

/**
 * Determante de tempo padrão do sistema
 */

date_default_timezone_set('America/Sao_Paulo');

if (!defined('ROOT_PATH')){

    define('ROOT_PATH', dirname(__FILE__));
    define('DS', DIRECTORY_SEPARATOR);
    require_once (ROOT_PATH . DS .'libraries/config.php');
}

require_once(ROOT_PATH . DS. "components/vendor/autoload.php");

