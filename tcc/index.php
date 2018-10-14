<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 19/09/18
 * Time: 10:36
 */


if (!defined('ROOT_PATH')) {

    chdir(dirname(__FILE__));
    define('ROOT_PATH', dirname(__FILE__));
    define('DS', DIRECTORY_SEPARATOR);
}

require_once(ROOT_PATH . DS . 'components/vendor/autoload.php');

use libraries\System as App;
use libraries\Log as Log;

(new App)->run(new Log());

