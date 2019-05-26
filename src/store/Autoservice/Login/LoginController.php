<?php

namespace Store\Autoservice\Login;

class LoginController
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