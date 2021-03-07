<?php

namespace App\Munch\Api\V1\Client\Orders\Cancel_create;

use App\Munch\Api\V1\Client\Client;
use Resta\Contracts\ClientContract;
use App\Munch\Api\V1\Client\ClientProvider;
use App\Munch\Api\V1\Client\ClientGenerator;
use App\Munch\Api\V1\Client\Orders\CancelTrait;

class Cancel_create extends ClientProvider implements ClientContract
{
    //request and request generator
    use Client,Cancel_createGenerator,ClientGenerator,CancelTrait;

    /**
     * @var string
     */
    public $clientName = 'Cancel_create_client';

    /**
     * @var array
     */
    protected $capsule = [];

    /**
     * The values ​​expected by the server.
     * @var array
     */
    protected $expected = [];

    /**
     * remove the specified key from client real request
     *
     * @var array
     */
    protected $requestExcept = [];

    /**
     * groups for nested array values
     *
     * @var array
     */
    protected $groups = [];

    /**
     * mandatory http method.
     * @var array
     */
    protected $http = [];


}