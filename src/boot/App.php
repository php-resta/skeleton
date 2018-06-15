<?php

namespace Boot;

use Store\Traits\Annotations;
use Resta\ApplicationProvider;
use Resta\Contracts\BootContracts;

class App extends ApplicationProvider implements BootContracts {

    use Annotations;

    /**
     * @method boot
     */
    public function boot(){

        //do somethings
    }

}