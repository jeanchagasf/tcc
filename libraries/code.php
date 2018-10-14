<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 23/05/18
 * Time: 14:07
 */

namespace libraries;

use libraries\logger;

class code
{
    private $log;

    public function handler(logger $logger, $response_code, $exception = null)
    {
        $this->log = $logger;

        http_response_code($response_code);

        $this->log->access_log($response_code);

        if (!empty($exception)) {

            return $this->error($response_code, $exception);
        }
    }

    private function error($response_code, $exception)
    {
        $this->log->error_log($response_code, $exception);

        new view($response_code);
    }
}
