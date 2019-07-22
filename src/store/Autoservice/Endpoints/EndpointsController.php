<?php

namespace Store\Autoservice\Endpoints;

use Resta\Router\Route;
use Resta\Foundation\ApplicationProvider;

class EndpointsController extends ApplicationProvider
{
    /**
     * @return array
     */
    public function getIndexAction()
    {
        return Route::getRouteMappings();
    }

}