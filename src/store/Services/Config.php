<?php

namespace Store\Services;

use Resta\Contracts\AccessorContracts;

class Config implements AccessorContracts
{
    /**
     * @return mixed
     */
    public function get()
    {
        dd('asa');
        return 'get';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function set($data = array())
    {
        return 'set';
    }
}