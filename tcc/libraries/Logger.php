<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 15/06/18
 * Time: 14:45
 */

namespace libraries;


interface Logger
{
    const NOT_FOUND = 404;
    const FORBIDDEN = 403;
    const BAD_REQUEST = 400;
    const INTERNAL_SERVER_ERROR = 500;
    const OK = 200;

    public function access($response_code);

    public function error($response_code, $exception);

    public function warning($messege);

    public function info($messege);
}