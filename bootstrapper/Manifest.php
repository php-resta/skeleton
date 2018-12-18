<?php

namespace Bootstrapper;

use Resta\Foundation\Kernel;

class Manifest extends Kernel
{
    /**
     * @var array $revision
     */
    protected $revision = [];

    /**
     * @var array
     */
    protected $afterOriginGroups = [];

    /**
     * @return array
     */
    public function afterOriginGroups() : array
    {
        return $this->afterOriginGroups;
    }
}