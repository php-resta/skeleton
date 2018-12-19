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
     * @var array $originGroupsExtend
     */
    protected $originGroupsExtend = [];

    /**
     * @var array $consoleGroupsExtend
     */
    protected $consoleGroupsExtend = [];

    /**
     * @var array $middlewareGroupsExtend
     */
    protected $middlewareGroupsExtend = [];

    /**
     * @var array $reflectionGroupsExtend
     */
    protected $reflectionGroupsExtend = [];

    /**
     * extends kernel origin groups
     *
     * @return array
     */
    public function originGroupsExtend() : array
    {
        return $this->originGroupsExtend;
    }

    /**
     * extends kernel console groups
     *
     * @return array
     */
    public function consoleGroupsExtend() : array
    {
        return $this->consoleGroups;
    }

    /**
     * extends kernel middleware groups
     *
     * @return array
     */
    public function middlewareGroupsExtend() : array
    {
        return $this->middlewareGroupsExtend;
    }

    /**
     * extends kernel reflection groups
     *
     * @return array
     */
    public function reflectionGroupsExtend() : array
    {
        return $this->reflectionGroupsExtend;
    }
}