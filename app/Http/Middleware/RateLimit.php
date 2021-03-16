<?php

namespace App\Http\Middleware;

use Resta\Contracts\HandleContracts;
use Resta\Middleware\MiddlewareRateLimit;

class RateLimit extends MiddlewareRateLimit implements HandleContracts
{
    /**
     * @var array $rateLimits
     */
    protected $rateLimits = [
        'name' =>[
            'period' => 60,
            'limit' => 60,
            'ips' => []
        ]
    ];

    /**
     * @return void
     */
    public function handle() : void
    {
        parent::handle();
    }
}
