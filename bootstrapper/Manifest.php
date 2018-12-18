<?php

namespace Bootstrapper;

use Resta\Foundation\Kernel;
use Resta\Contracts\BootContracts;

class Manifest extends Kernel implements BootContracts
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
    public function boot() : array
    {
        return $this->afterOriginGroups;
    }
}