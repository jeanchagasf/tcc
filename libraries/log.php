<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 29/05/18
 * Time: 13:14
 */

namespace libraries;


class log implements logger
{

    private $_ip;
    private $_username;         //$_SESSION['username']
    private $_date;             //date("Y-m-d H:i:s");
    private $method;            //$_SERVER['REQUEST_METHOD']
    private $request;           //$_SERVER['QUERY_STRING']
    private $log;
    private $protocol;          //$_SERVER['SERVER_PROTOCOL']

    private static $file_access_log;
    private static $file_error_log;


    private function handler()
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

    ##################################################

    public function access_log($response_code)
    {
        $this->handler();
        $this->log = str_replace(["\n","\r","\t"], '', $this->registry_access($response_code));
        self::$file_access_log = fopen(ROOT_PATH . "/logs/access.log", "a");
        fwrite(self::$file_access_log, "$this->log" . PHP_EOL);
        fclose(self::$file_access_log);
    }

    public function error_log($response_code, $exception)
    {
        $this->handler();
        $this->log = str_replace(["\n","\r","\t"], '', $this->registry_error($response_code, $exception));
        self::$file_error_log = fopen(ROOT_PATH . "/logs/error.log", "a");
        fwrite(self::$file_error_log, "$this->log" . PHP_EOL);
        fclose(self::$file_error_log);

    }

    /**
     *
     * @return 10.17.56.122 [10.7.8.243] - Unknown [2018-05-29 14:46:32] "GET route=teste/block HTTP/1.1" 403
     */

    private function registry_access($response_code)
    {


        return $this->_ip['externo'] . ' [' . $this->_ip['interno'] . '] - ' . $this->_username . ' [' . $this->_date . '] "' . $this->method . ' ' . $this->request . ' ' . $this->protocol . '" ' . $response_code;

    }

    /**
     *
     * @return Exception error: ON 2018-05-29 14:46:32 "GET route=teste/block HTTP/1.1" 403
     *
     */

    private function registry_error($response_code, $exception)
    {

        return '[' . $this->_date . ']  "' . $this->method . '  ' . $this->request . ' ' . $this->protocol . '" ' . $response_code . ' ' . $exception;
    }
}
