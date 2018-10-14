<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 19/09/18
 * Time: 11:16
 */

namespace libraries;
use libraries\Route as Route;


class System
{
    public $url;
    public $_action;
    public $_explode;
    public $_controller;



    private function setUrl($get) :void
    {

        if (isset($get['route'])) {

            $aux = $get['route'];

        } else {

            $aux = 'index/index_action';
        }

        $this->url = $aux;
    }

    private function setExplode($url) :void
    {

        $this->_explode = explode('/', $url);
    }

    private function setController($explode)
    {
        $this->_controller = strtoupper(substr($explode[0], 0, 1)) . substr($explode[0], 1);
    }

    private function setAction($explode) :void
    {

        if (!isset($explode[1]) || empty($explode[1]) || $explode[1] == 'index') {

            $aux = 'index_action';

        } else {

            $aux = $explode[1];
        }

        $this->_action = $aux;
    }

    private function setParams($explode) :void
    {
        unset($explode[0], $explode[1]);

        if (empty(end($this->_explode))) {
            array_pop($this->_explode);
        }

        if (!empty($explode)) {

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
            $keys = [];
            $values = [];
        }


        if (count($keys) == count($values) && !empty($keys) && !empty($values)) {
            $this->_params = array_combine($keys, $values);
        } else {
            $this->_params = [];
        }
    }

    private function initializing() :void
    {
        $this->setUrl($_GET);
        $this->setExplode($this->url);
        $this->setController($this->_explode);
        $this->setAction($this->_explode);
        $this->setParams($this->_explode);

    }


    public function run(Logger $log) :void
    {
        $this->initializing();

        $namespace = str_replace(DS , '\\', Route::CONTROLLERS) . '\\' .$this->_controller;
        $method = $this->_action;

        try {

            if (!class_exists($namespace)) {

                throw new \LogicException ('Class ' . $namespace . ' does not exist', $log::NOT_FOUND);
            }

            $app = new $namespace;
            if (!method_exists($app, $method)) {

                throw new \BadMethodCallException ('Method ' . $this->_action . ' does not exist', $log::NOT_FOUND);
            }
            $log->access($log::OK);
            echo str_replace(["\n","\r","\t"], '', $app->$method());

        } catch (\BadMethodCallException $exception) {


        } catch (\LogicException $exception) {

            http_response_code($exception->getCode());
            echo $exception->getMessage();
        } catch (\Exception $exception) {

        }
    }
}
