<?php

namespace App\Client;

trait Client
{
    /**
     * auto validator keys
     *
     * @var array
     */
    public $autoObjectValidate = [
        'Store\Services\Validator' => ['date','email','creditCard','params'=>[]]
    ];

    /**
     * request rules
     *
     * @var array
     */
    protected $rules = [
        'capital'          => '[A-Z]',
        'min6Char'         => '.{6,}',
        'max6Char'         => '^.{0,6}$',
        'integer'          => '^[0-9]+$',
        'string'           => '^[a-zA-Z]+$',
        'alphaNumeric'     => '^[a-zA-Z]+[a-zA-Z0-9._\-\s]+$',
        'days'             => '^monday$|^sunday$|^tuesday$|^wednesday$|^thursday$|^friday$|^saturday$',
        'clock'            => '^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$',
        'float'            => '^[0-9]+(\\.[0-9]+)?$',
        'dontStartSpace'   => '^(?=[^ ]).+(?<=\S)$',
    ];

    /**
     * @var array
     */
    protected $auto_capsule = ['page'];

    /**
     * @var $page
     */
    protected $page;

    /**
     * @regex(^\d+$)
     * @exception(name:page params:page=page)
     * @return mixed
     */
    protected function page()
    {
        return $this->page;
    }

    /**
     * @return void
     */
    protected function rule()
    {
        //
    }
}