<?php

if (!function_exists('dd')) {
    function dd()
    {
        $args = func_get_args();
        call_user_func_array('dump', $args);
        die();
    }
}

if (!function_exists('environment')) {
    function environment()
    {
        return \Resta\Environment\EnvironmentConfiguration::environment(
            func_get_args(),app()->singleton()->var
        );
    }
}

if (!function_exists('app')) {

    /**
     * @return \Resta\ApplicationProvider
     */
    function app()
    {
        return \application::getAppInstance();
    }
}

if (!function_exists('request')) {

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    function request()
    {
        return app()->request();
    }
}


if (!function_exists('post')) {

    /**
     * @param null $param
     * @return mixed
     */
    function post($param=null)
    {
        return app()->post($param);
    }
}



if (!function_exists('get')) {

    /**
     * @param null $param
     * @return mixed
     */
    function get($param=null)
    {
        return app()->get($param);
    }
}