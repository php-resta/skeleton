<?php

namespace Boot;

use Store\Traits\Annotations;
use Resta\ApplicationProvider;
use Resta\Contracts\BootContracts;

class App extends ApplicationProvider implements BootContracts
{
    use Annotations;

    /**
     * @return void
     */
    public function boot()
    {
        //boot somethings
    }

}