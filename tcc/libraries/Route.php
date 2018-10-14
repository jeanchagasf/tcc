<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 19/09/18
 * Time: 11:13
 */

namespace libraries;


class Route
{
    const CONTROLLERS = 'applications/controllers';
    const MODELS = 'applications/models';
    const VIEWS = 'applications/views';
    const ASSETS = 'resources/assets';
    const ERRORS = 'applications/views/erros';

    public static function getPathController($controller) :string
    {

        return ROOT_PATH . DS . self::CONTROLLERS . DS . $controller . '.php';
    }

    public static function getNamespaceController($controller) :string
    {

        return str_replace(DS , '\\', self::CONTROLLERS) . '\\' .$controller;
    }
}