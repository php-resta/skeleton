<?php

namespace Store\Autoservice\Hook;

use Resta\ApplicationProvider;

/**
 * Class HookController
 * @package Store\Autoservice\Hook
 */
class HookController extends ApplicationProvider {

    /**
     * @return array
     */
    public function getIndexAction(){

        return [
            'hook'=>'do somethings'
        ];
    }

}