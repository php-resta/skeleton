<?php

namespace Store\Services;

use Resta\Support\Http;
use Resta\Contracts\ApplicationContracts;
use Resta\Foundation\ApplicationProvider;

class ExceptionExtender extends ApplicationProvider
{
    /**
     * @var array
     */
    protected $result;

    /**
     * @var array
     */
    protected $extender = ['request','route','client'];

    /**
     * ExceptionExtender constructor.
     * @param ApplicationContracts $app
     * @param array $result
     */
    public function __construct(ApplicationContracts $app,$result=array())
    {
        parent::__construct($app);

        $this->result = $result;

        foreach($this->extender as $item){
            if(method_exists($this,$item)){
                $this->{$item}();
            }
        }
    }

    public function client()
    {
        $http = new Http();

        $this->result['errorDetails']['client']['GET']  = $http->httpMethodData();
        $this->result['errorDetails']['client']['POST'] = $http->httpMethodData('post');
        $this->result['errorDetails']['client']['PUT']  = $http->httpMethodData('put');
        $this->result['errorDetails']['client']['DELETE']  = $http->httpMethodData('delete');
    }

    /**
     * get result for exception
     *
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * get request expected items
     *
     * @return void
     */
    public function request()
    {
        // we will look at the requestExpected container value to show
        // the expected values ​​for the request object in the exception output.
        if($this->app->has('requestExpected')){
            if($requestExpected = $this->app->get('requestExpected')){
                $this->result['errorDetails']['request']['expected'] = $requestExpected;
            }
        }
    }

    /**
     * get route data for exception extender
     *
     * @return void
     */
    public function route()
    {
        if($this->app->has('routeResolvedData')){
            $this->result['errorDetails']['route'] = $this->app->get('routeResolvedData');
        }
    }
}