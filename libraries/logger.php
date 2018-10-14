<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 15/06/18
 * Time: 14:45
 */

namespace libraries;


interface logger
{
    public function access_log($response_code);

    public function error_log($response_code, $exception);

}