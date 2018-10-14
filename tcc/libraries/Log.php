<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 19/09/18
 * Time: 16:01
 */

namespace libraries;
use libraries\Logger as Logger;

class Log implements Logger
{
    const OK = 200;
    const NOT_FOUND = 404;
    const FORBIDDEN = 403;
    const BAD_REQUEST = 400;
    const INTERNAL_SERVER_ERROR = 500;

    private $_ip;
    private $_username;         //$_SESSION['username']
    private $_date;             //date("Y-m-d H:i:s");
    private $method;            //$_SERVER['REQUEST_METHOD']
    private $request;           //$_SERVER['QUERY_STRING']
    private $log;
    private $protocol;          //$_SERVER['SERVER_PROTOCOL']

    private static $file_access_log;
    private static $file_error_log;


    private function initializing()
    {
        $this->setIP();
        $this->setUser();
        $this->setDate();
        $this->setMethod();
        $this->setProtocol();
        $this->setRequest();

    }


    private function setIP()
    {
        $this->_ip = array(
            'externo' => $_SERVER['SERVER_ADDR'],
            'interno' => $_SERVER['REMOTE_ADDR']
        );
    }


    private function setUser()
    {
        if (isset($_SESSION)) {

            $this->_username = $_SESSION['array']['email'];

        } else {

            $this->_username = 'Unknown';
        }

    }

    private function setDate()
    {
        $this->_date = date("Y-m-d H:i:s");
    }

    private function setMethod()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }


    private function setRequest()
    {
        if (empty($_SERVER['QUERY_STRING'])) {

            $this->request = 'route=index/index_action';

        } else {

            $this->request = $_SERVER['QUERY_STRING'];
        }
    }

    private function setProtocol()
    {

        $this->protocol = $_SERVER['SERVER_PROTOCOL'];
    }

    ############################

    public function code($response_code)
    {

    }

    public function access($response_code)
    {
        $this->initializing();
        $this->log = str_replace(["\n","\r","\t"], '', $this->registry_access($response_code));
        self::$file_access_log = fopen(ROOT_PATH . "/logs/access.log", "a");
        fwrite(self::$file_access_log, "$this->log" . PHP_EOL);
        fclose(self::$file_access_log);
    }

    public function error($response_code, $exception)
    {
        $this->initializing();
        $this->log = str_replace(["\n","\r","\t"], '', $this->registry_error($response_code, $exception));
        self::$file_error_log = fopen(ROOT_PATH . "/logs/error.log", "a");
        fwrite(self::$file_error_log, "$this->log" . PHP_EOL);
        fclose(self::$file_error_log);
    }

    public function warning($messege){

    }

    public function info($messege){

    }

    private function registry_access($response_code)
    {
        return $this->_ip['externo'] . ' [' . $this->_ip['interno'] . '] - ' . $this->_username . ' [' . $this->_date . '] "' . $this->method . ' ' . $this->request . ' ' . $this->protocol . '" ' . $response_code;
    }

    private function registry_error($response_code, $exception)
    {
        return '[' . $this->_date . ']  "' . $this->method . '  ' . $this->request . ' ' . $this->protocol . '" ' . $response_code . ' ' . $exception;
    }
}