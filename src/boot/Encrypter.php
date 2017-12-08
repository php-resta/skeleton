<?php

namespace Boot;

use Resta\Booting\Encrypter as EncrypterProvider;
use Resta\Encrypter\Encrypter as EncrypterProduction;
use Resta\Contracts\EncrypterContracts;

class Encrypter extends EncrypterProvider implements EncrypterContracts {

    /**
     * @method boot
     */
    public function boot(){

        parent::boot();
    }

    /**
     * @method keyGenerate
     * @return mixed
     */
    public function keyGenerate(){

        //The keyGenerate method is very important. If it is deleted, you can not generate a key on console.
        //The console uses this method. If you are going to generate your own encrypter,
        //you must create a key according to the structure you are using here.
        return $this->makeBind(EncrypterProduction::class)->createNewRandomKey();
    }

}