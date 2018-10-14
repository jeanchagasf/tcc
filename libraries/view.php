<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 12/06/18
 * Time: 13:53
 */

namespace libraries;


class view
{

    public $page;

    public function __construct($page)
    {
        $this->page = $page;
        $this->html_header();
        $this->html_body();
    }

    public function html_header()
    {
        return require_once(ROOT_PATH . DS . VIEWS . DS . 'includes/html_header.phtml');
    }

    public function html_body()
    {

        return require_once(ROOT_PATH . DS . VIEWS . DS . 'includes/html_body.phtml');
    }

    public function header()
    {

        return require_once(ROOT_PATH . DS . VIEWS . DS . 'includes/header.phtml');
    }

    public function body()
    {

        if (file_exists(ROOT_PATH . DS . VIEWS . DS . $this->page . DS . $this->page . '.phtml')) {

            return require_once(ROOT_PATH . DS . VIEWS . DS . $this->page . DS . $this->page . '.phtml');

        } elseif (file_exists(ROOT_PATH . DS . ASSETS . DS . "erros" . DS . $this->page . ".phtml")) {

            return require_once(ROOT_PATH . DS . ASSETS . DS . "erros" . DS . $this->page . ".phtml");

        } else {

            throw new \Exception ('View does not exist', 404);
        }
    }

    public function title()
    {
        if($this->page = 'index'){

            return "✅ ".ucfirst('home');
        }

        return "✅ ".ucfirst($this->page);
    }

    public function breadcrumb()
    {

        return '<b>' . substr($this->title(), 0, 1) . '</b>' . substr($this->title(), 1);
    }
}
