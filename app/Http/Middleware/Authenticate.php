<?php

namespace App\Http\Middleware;

use Resta\Contracts\HandleContracts;

class Authenticate implements HandleContracts
{
    /**
     * @return void
     */
    public function handle()
    {
        dd(111222);
    }
}
