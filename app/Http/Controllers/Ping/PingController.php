<?php

namespace App\Http\Controllers\Ping;

class PingController extends App
{
    /**
     * #define: get ping (health for system)
     *
     * @return array
     */
    public function index() : array
    {
        return [
            'endpoint' => 'Ping'
        ];
    }
}