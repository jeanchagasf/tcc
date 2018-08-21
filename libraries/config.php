<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 21/08/18
 * Time: 11:34
 */

### GENERAL ###

define('_EMAIL', 'jeanchagasf_@hotmail.com');

### HOST ###

/** O host HTTP da aplicação */
define('_DOMAIN', 'http://' . $_SERVER['HTTP_HOST']);


### PATH ###

/** O path dos controladores da aplicação */
define('CONTROLLERS', 'applications/controllers');

/** O use dos controladores da aplicação */
define('USE_CONTROLLERS', 'applications\controllers');

/** O path dos modelos da aplicação */
define('MODELS', 'applications/models');

/** O path das visualizações da aplicação */
define('VIEWS', 'applications/views');

/** O path dos espólios da aplicação */
define('ASSETS', 'resources/assets');

/** O path dos espólios da aplicação */
define('ERRORS', 'applications/views/erros');

### DATABASE ###

/** O nome do host do MySQL */
define('DB_HOST', 'mysql.jeanchagas.kinghost.net');

/** O nome do banco de dados MySQL */
define('DB_NAME', 'jeanchagas');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'jeanchagas');

/** Senha do banco de dados MySQL */
define('DB_PASS', '*****');

/** O nome do banco de dados MySQL */
define('DB_CHARSET', 'SET NAMES utf8');
