<?php

namespace Store\Autoservice\Translate;

use Resta\Foundation\ApplicationProvider;

/**
 * Class TranslateController
 * @package Store\Autoservice\Translate
 */
class TranslateController extends ApplicationProvider
{
    /**
     * @return array
     */
    public function getIndexAction()
    {
        return [
            'data' => trans(get('trans'))
        ];
    }

}