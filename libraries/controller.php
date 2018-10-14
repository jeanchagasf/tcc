<?php


namespace libraries;


class controller extends system
{


    protected function page($view)
    {


        if (!file_exists(ROOT_PATH . DS . VIEWS . DS . $view . DS . $view . '.phtml')) {

            throw new \Exception ('View does not exist', 404);

        } else {

            new view($view);
        }
    }
}
