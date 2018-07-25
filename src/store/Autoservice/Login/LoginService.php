<?php

namespace Store\Autoservice\Login;

class LoginService {

    /**
     * @return array
     */
    public function getIndexAction(){

        return [
            'authenticate'=>auth()->login()
        ];
    }

    /**
     * @return array
     */
    public function postIndexAction(){

        return [
            'authenticate'=>auth()->login()
        ];
    }

}