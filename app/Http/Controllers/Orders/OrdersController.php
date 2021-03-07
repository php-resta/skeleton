<?php

namespace App\Http\Controllers\Orders;

class OrdersController extends App
{
    /**
     * #define: get orders on system
     *
     * @return array
     */
    public function index() : array
    {
        return [
            'endpoint' => 'Orders'
        ];
    }
}