<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 21/08/18
 * Time: 14:34
 */

namespace applications\controllers;


use library\controller;

class index extends controller
{
    public function index_action()
    {
        $this->page('index');
    }
}