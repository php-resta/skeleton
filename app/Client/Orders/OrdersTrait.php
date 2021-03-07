<?php

namespace App\Munch\Api\V1\Client\Orders;

use App\Munch\Api\V1\ServiceAnnotationsManager; 
use App\Munch\Api\V1\Client\Entities\Orders;

/**
 * Class OrdersTrait
 * @package App\Munch\Api\V1\Client\Orders
 */
trait OrdersTrait
{
    //get app annotations controller
    use ServiceAnnotationsManager,Orders;

    /**
     * when we use the method for capsule,
     * the capsuleMethod method is executed and the results must be array.
     *
     * @return array
     */
    public function capsuleMethod() : array
    {
        return $this->builder->order()->getFillable();
    }
}