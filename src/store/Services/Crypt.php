<?php

namespace Store\Services;

use Zend\Crypt\Password\Bcrypt;

class Crypt
{
    /**
     * crypt password
     *
     * @param $password
     * @return string
     */
    public function password($password)
    {
        return (new Bcrypt())->create($password);
    }

}