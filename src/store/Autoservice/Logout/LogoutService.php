<?php

namespace Store\Autoservice\Logout;

class LogoutService {

    /**
     * @return array
     */
    public function getIndexAction(){

        return [
            'authenticate'=>null
        ];
    }

    /**
     * @return array
     */
    public function postIndexAction(){

        return [
            'authenticate'=>auth()->logout()
        ];
    }

}