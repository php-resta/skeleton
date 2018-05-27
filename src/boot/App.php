<?php

namespace Boot;

use Store\Traits\Annotations;
use Resta\ApplicationProvider;

class App extends ApplicationProvider  {

    use Annotations;

    /**
     * @method boot
     */
    public function boot(){

        //do somethings
    }

}