<?php

namespace Store\Autoservice\Login;

use Resta\Foundation\ApplicationProvider;

class LoginController extends ApplicationProvider
{
    /**
     * @return array
     */
    public function postIndexAction()
    {
        return [
            'authenticate' => auth()->login()
        ];
    }

}