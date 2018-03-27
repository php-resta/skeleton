<?php

namespace Store\Autoservice\Hook;

use Resta\ApplicationProvider;

/**
 * Class HookService
 * @package Store\Autoservice\Hook
 */
class HookService extends ApplicationProvider {

    /**
     * @return array
     */
    public function getIndexAction(){

        return [
            'hookservice'=>'do somethings'
        ];
    }

}