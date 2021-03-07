<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Response Configuration
    |--------------------------------------------------------------------------
    |
    | The application response determines the default output type that will be used
    | by the result service endpoint. You are free to set this value
    | to any of the response which will be supported by the application.
    |
    */
    'response' => 'json',

    /*
    |--------------------------------------------------------------------------
    | Application Response Meta
    |--------------------------------------------------------------------------
    |
    | These are the keys to be automatically included in the documentation parameters
    | to be created for the application.With these keys, we prevent you from writing
    | the same keys over and over to the file that will create your documentation.
    |
    */
    'meta' => [
        'meta'=>[
            'success'       => app()->get('responseSuccess'),
            'status'        => app()->get('responseStatus'),
            'illuminator'   => app()->get('illuminator')
        ]
    ],

    /*
     |--------------------------------------------------------------------------
     | Application Response Resource
     |--------------------------------------------------------------------------
     |
     | These are the keys to be automatically included in the documentation parameters
     | to be created for the application.with response these keys, we prevent you from writing
     | the same keys over and over to the file that will create your documentation.
     |
     */
    'data' => 'resource',

    /*
   |--------------------------------------------------------------------------
   | Application Response OutPutter
   |--------------------------------------------------------------------------
   |
   | you can specify and manage the response output according to your project group.
   | This value in the config is defined by the kernel and
   | is a config switch which should never be disabled.
   |
   */
    'outputter' => [
        'formatter'  => 'Store\Services\Response'
    ],


];