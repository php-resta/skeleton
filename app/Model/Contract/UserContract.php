<?php

namespace App\Munch\Api\V1\Model\Contract;

use Resta\Contracts\ClientContract;

interface UserContract
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @param ClientContract $client
     * @return mixed
     */
    public function create(ClientContract $client);

    /**
     * @param ClientContract $client
     * @param bool $createIfNotExist
     * @return mixed
     */
    public function update(ClientContract $client,$createIfNotExist=false);
}