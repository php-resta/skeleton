<?php

namespace Store\Autoservice\Translate;

use Resta\ApplicationProvider;

/**
 * Class TranslateService
 * @package Store\Autoservice\Translate
 */
class TranslateService extends ApplicationProvider {

    /**
     * @return array
     */
    public function getIndexAction(){

        return [
            'data'=>trans(get('trans'))
        ];
    }

}