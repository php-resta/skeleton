<?php

namespace App\Factory;
                                   
use App\Factory\App\AppManager;
use App\Factory\App\Interfaces\AppInterface;

/**
 * Class Factory
 * @package App\Factory
 * @property AppInterface app
 */
class Factory extends FactoryManager
{
    /**
     * @return AppInterface
     */
    public static function app() : AppInterface
    {
        return new AppManager();
    }
    

}