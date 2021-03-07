<?php

namespace App\Kernel;

use Resta\Foundation\Kernel;

class Manifest extends Kernel
{
    /**
     * Changes any kernel group objects.
     *
     * @var array $revision
     */
    protected $revision = [];

    /**
     * this property adds class to the kernel loaders on the user side.
     *
     * @var array $run
     */
    protected $run = [];
}