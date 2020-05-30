<?php

namespace Store\Autoservice\Hook;

use Resta\Foundation\ApplicationProvider;

/**
 * Class HookController
 * @package Store\Autoservice\Hook
 */
class HookController extends ApplicationProvider
{
    /**
     * @return array
     */
    public function getIndexAction()
    {
        return [
            'hook' => [
                'time' => date('Y-m-d H:i:s')
            ]
        ];
    }

}