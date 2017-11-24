<?php

namespace Resta\Console;

use Resta\StaticPathModel;
use Resta\Utils;

trait ConsoleListAccessor {

    /**
     * @return mixed
     */
    public function kernel(){

        return $this->project.'/'.StaticPathModel::$kernel;
    }

    /**
     * @return mixed
     */
    public function repository(){

        return $this->project.'/'.StaticPathModel::$repository;
    }

    /**
     * @return mixed
     */
    public function storage(){

        return $this->project.'/'.StaticPathModel::$storage;
    }

    /**
     * @return mixed
     */
    public function version(){

        return $this->project.'/'.Utils::getAppVersion($this->argument['project']);
    }


    /**
     * @return mixed
     */
    public function controller(){

        return $this->version().'/'.StaticPathModel::$controller;
    }


    /**
     * @return mixed
     */
    public function model(){

        return $this->version().'/'.StaticPathModel::$model;
    }


    /**
     * @return mixed
     */
    public function builder(){

        return $this->version().'/'.StaticPathModel::$builder;
    }


    /**
     * @return mixed
     */
    public function migration(){

        return $this->version().'/'.StaticPathModel::$migration;
    }


    /**
     * @return mixed
     */
    public function config(){

        return $this->version().'/'.StaticPathModel::$config;
    }


    /**
     * @return mixed
     */
    public function job(){

        return $this->version().'/'.StaticPathModel::$job;
    }


    /**
     * @return mixed
     */
    public function webservice(){

        return $this->version().'/'.StaticPathModel::$webservice;
    }


    /**
     * @return mixed
     */
    public function log(){

        return $this->storage().'/'.StaticPathModel::$log;
    }

    /**
     * @return mixed
     */
    public function language(){

        return $this->storage().'/'.StaticPathModel::$language;
    }


    /**
     * @return mixed
     */
    public function resource(){

        return $this->storage().'/'.StaticPathModel::$resource;
    }


    /**
     * @return mixed
     */
    public function session(){

        return $this->storage().'/'.StaticPathModel::$session;
    }


    /**
     * @return mixed
     */
    public function middleware(){

        return $this->kernel().'/'.StaticPathModel::$middleware;
    }


    /**
     * @return mixed
     */
    public function node(){

        return $this->kernel().'/'.StaticPathModel::$node;
    }


    /**
     * @return mixed
     */
    public function once(){

        return $this->kernel().'/'.StaticPathModel::$once;
    }


    /**
     * @return mixed
     */
    public function stub(){

        return $this->kernel().'/'.StaticPathModel::$stub;
    }



}