<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 23/05/18
 * Time: 14:07
 */

namespace library;


class code{

    public function setLog($response_code, $exception = null){

        http_response_code($response_code);

        log::access_log($response_code);

        if(!empty($exception)){

            return $this->error($response_code, $exception);
        }
    }


    private function error($response_code, $exception){


        log::error_log($response_code, $exception);

        new view($response_code);
    }
}
