<?php

namespace Boot;

use Store\Traits\Annotations;
use Resta\Contracts\BootContracts;
use Resta\Foundation\ApplicationProvider;

class App extends ApplicationProvider implements BootContracts
{
    use Annotations;

    /**
     * @return void
     */
    public function boot()
    {
        $acceptLanguage = request()->headers->get('accept-language');

        $language = $acceptLanguage ?? 'en';

        $this->app->register('locale',$language);
    }

}