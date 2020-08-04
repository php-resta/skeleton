<?php

namespace Store\Autoservice\Logout;

use Resta\Foundation\ApplicationProvider;

class LogoutController extends ApplicationProvider
{
    /**
     * @return array
     */
    public function postIndexAction()
    {
        return [
            'authenticate' => [
                'logout'   => auth()->logout()
            ]
        ];
    }

}