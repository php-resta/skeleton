<?php

namespace Store\Traits;

use Resta\Support\Utils;

trait RepositoryTrait
{
    /**
     * @method adapter
     * @return mixed
     */
    public function adapter()
    {
        if(method_exists($this,'setAdapter')){
            $this->setAdapter();
        }

        return app()->resolve($this->getRepositorySourceAdapter(),app()->get('bindings'));
    }

    /**
     * @return string
     */
    protected function getRepositorySourcePath()
    {
        return app()->namespace()->repository().'\\'.$this->getRepositoryName().'\Source\\'.$this->adapter;
    }

    /**
     * @return string
     */
    protected function getRepositorySourceAdapter()
    {
        return $this->getRepositorySourcePath().'\\'.$this->getRepositoryName().''.$this->adapter;
    }

    /**
     * @return mixed
     */
    protected function getRepositoryName()
    {
        return str_replace('Adapter','',Utils::getJustClassName(__CLASS__));
    }

}