<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 21/08/18
 * Time: 14:34
 */

namespace applications\controllers;


use libraries\controller;

class index extends controller
{
    public function index_action()
    {
	    return $this->page('index');
    }
}
