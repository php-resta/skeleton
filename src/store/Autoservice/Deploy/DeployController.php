<?php

namespace Store\Autoservice\Deploy;

use Resta\Foundation\ApplicationProvider;

class DeployController extends ApplicationProvider
{
    /**
     * @return mixed
     */
    public function getIndexAction()
    {
        return '1';
    }

}