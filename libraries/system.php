<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 21/08/18
 * Time: 11:44
 */

namespace libraries;

use libraries\log as Log;
use libraries\code as Code;

class system
{
    private static $_url;
    private $_explode;

    public $_controller;
    public $_action;
    public $_params;

    public $log;
    public $code;

    public function __construct()
    {
        $this->log = new Log;
        $this->code = new Code;


        $this->setUrl();
        $this->setExplode();
        $this->setController();
        $this->setAction();
        $this->setParams();

    }


    private function setUrl()
    {
        if (isset($_GET['route'])) {

            $aux = $_GET['route'];

        } else {

            $aux = 'index/index_action';
        }

        self::$_url = $aux;
    }

    private function setExplode()
    {

        $this->_explode = explode('/', self::$_url);
    }

    private function setController()
    {
        $this->_controller = "applications\\controllers\\" . $this->_explode[0];
    }

    private function setAction()
    {

        if (!isset($this->_explode[1]) || empty($this->_explode[1]) || $this->_explode[1] == 'index') {

            $aux = 'index_action';

        } else {


            $aux = $this->_explode[1];
        }

        $this->_action = $aux;
    }

    private function setParams()
    {
        unset($this->_explode[0], $this->_explode[1]);

        if (empty(end($this->_explode))) {
            array_pop($this->_explode);
        }

        if (!empty($this->_explode)) {

            $i = 0;

            foreach ($this->_explode as $aux) {

                if ($i % 2 == 0) {
                    $keys[] = $aux;
                } else {
                    $values[] = $aux;
                }

                $i++;
            }


        } else {
            $keys = array();
            $values = array();
        }


        if (count($keys) == count($values) && !empty($keys) && !empty($values)) {

            $this->_params = array_combine($keys, $values);
        } else {

            $this->_params = array();
        }
    }


    public function getURL()
    {

        return self::$_url;
    }

    public function getParams($name)
    {

        return $this->_params[$name];
    }

    public function run()
    {


        $class = str_replace('\\', '/', strtolower($this->_controller));

        $path = ROOT_PATH . DS . $class . '.php';


        try {

            if (!file_exists($path)) {

                throw new \Exception ('Class ' . $path . ' does not exist', 404);

            } else {

                $app = new $this->_controller;

            }

            if (!method_exists($app, $this->_action)) {


                throw new \Exception ('Method ' . $this->_action . ' does not exist', 404);

            } else {


                $action = $this->_action;

                $app->$action();

                $this->code->handler($this->log, 200);
            }

        } catch (\Exception $e) {

            $this->code->handler($this->log, $e->getCode(), $e->getMessage());

        }
    }
}
