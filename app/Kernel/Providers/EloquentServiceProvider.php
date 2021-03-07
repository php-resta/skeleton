<?php

namespace App\Kernel\Providers;

use Illuminate\Pagination\Paginator;
use Resta\Provider\ServiceProviderManager;
use Illuminate\Database\ConnectionInterface;
use Store\Packages\Database\Eloquent\Connection as Eloquent;

class EloquentServiceProvider extends ServiceProviderManager
{
    /**
     * Eloquent boot
     *
     * @return void
     */
    private function eloquentBoot()
    {
        // the Eloquent ORM included with Laravel provides a beautiful,
        // simple ActiveRecord implementation for working with your database.
        // each database table has a corresponding "Model" which is used to interact with that table.
        // models allow you to query for data in your tables, as well as insert new records into the table.
        $eloquent = new Eloquent();

        //We save the eloquent object in the container.
        $this->app->register('connection',$eloquent);

        $this->app->bind(ConnectionInterface::class,function() use($eloquent){
            return $eloquent->getConnection();
        });
    }

    /**
     * Eloquent pagination boot
     *
     * @return void
     */
    private function eloquentPagination()
    {
        // this installation must be done
        // in order to make pagination for the eloquent data.
        // source: https://github.com/illuminate/pagination/blob/master/PaginationServiceProvider.php
        Paginator::currentPageResolver(function(){

            $page = get('page',1);

            if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int) $page >= 1) {
                return (int) $page;
            }

            return 1;
        });
    }

    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        //eloquent loader
        $this->eloquentBoot();

        //eloquent pagination resolver
        $this->eloquentPagination();
    }
}