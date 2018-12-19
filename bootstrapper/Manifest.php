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
    protected $originGroupsExtend = [];

    /**
     * @var array
     */
    protected $consoleGroupsExtend = [];

    /**
     * @var array
     */
    protected $middlewareGroupsExtend = [];

    /**
     * @var array
     */
    protected $reflectionGroupsExtend = [];

    /**
     * @return array
     */
    public function originGroupsExtend() : array
    {
        return $this->originGroupsExtend;
    }

    /**
     * @return array
     */
    public function consoleGroupsExtend() : array
    {
        return $this->consoleGroups;
    }

    /**
     * @return array
     */
    public function middlewareGroupsExtend() : array
    {
        return $this->middlewareGroupsExtend;
    }

    /**
     * @return array
     */
    public function reflectionGroupsExtend() : array
    {
        return $this->reflectionGroupsExtend;
    }
}