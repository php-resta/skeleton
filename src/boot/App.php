<?php

namespace Boot;

use Store\Traits\Annotations;
use Resta\ApplicationProvider;
use Resta\Contracts\BootContracts;
use Store\Packages\Database\Eloquent\Connection as Eloquent;

class App extends ApplicationProvider implements BootContracts
{
    use Annotations;

    /**
     * @return void
     */
    public function boot()
    {
        //eloquent connection
        new Eloquent();
    }

}