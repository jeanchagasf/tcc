<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 21/08/18
 * Time: 11:44
 */

namespace libraries;


use phpDocumentor\Reflection\Types\Self_;

class system
{
    private static $_url;
    private $_explode;

    public $_controller;
    public $_action;
    public $_params;


    public function __construct()
    {

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
        $this->_controller = "application\\controllers\\" . $this->_explode[0];
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

    public static function run()
    {


        $class = str_replace('\\', '/', strtolower(self::$_controller));

        $path = ROOT_PATH . DS . $class . '.php';


        try {


            if (!@include_once($path)) {

                throw new \Exception ($path . ' does not exist', 404);
            }

            if (!file_exists($path)) {

                throw new \Exception ($path . ' does not exist', 404);
            } else {

                $app = new self::$_controller;
            }

        } catch (\Exception $e) {

            new code($e->getCode(), $e->getMessage());
            exit();
        }


        try {

            if (!method_exists($app, self::$_action)) {


                throw new \Exception ('Method does not exist', 404);

            } else {


                $action = self::$_action;
                $app->$action();
                new code(200);
                exit();
            }

        } catch (\Exception $e) {

            new code($e->getCode(), $e->getMessage());
            exit();
        }
    }
}
