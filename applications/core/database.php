<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 04/09/18
 * Time: 14:49
 */

namespace application\core;


interface Database
{

    public function _connect();

    public function create(Array $dados);

    public function read();

    public function update(Array $dados, Array $where);

    public function delete(Array $where);
}
