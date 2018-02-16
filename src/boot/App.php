<?php

namespace Boot;

use Resta\ApplicationProvider;
use Store\Traits\Annotations;

class App extends ApplicationProvider  {

    use Annotations;

    /**
     * @method boot
     */
    public function boot(){

        //do somethings
    }

}