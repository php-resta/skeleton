<?php

namespace Store\Autoservice\Logout;

class LogoutController
{
    /**
     * @return array
     */
    public function getIndexAction()
    {
        return [
            'authenticate'=>[
                'logout'   => auth()->logout()
            ]
        ];
    }

    /**
     * @return array
     */
    public function postIndexAction()
    {
        return [
            'authenticate'=>[
                'logout'   => auth()->logout()
            ]
        ];
    }

}