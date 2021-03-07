<?php

namespace App\Munch\Api\V1\Client\Orders;

use App\Munch\Api\V1\ServiceAnnotationsManager; 
use App\Munch\Api\V1\Client\Entities\Order_cancels;

/**
 * Class CancelTrait
 * @package App\Munch\Api\V1\Client\Orders
 */
trait CancelTrait
{
    //get app annotations controller
    use ServiceAnnotationsManager,Order_cancels;

    /**
     * when we use the method for capsule,
     * the capsuleMethod method is executed and the results must be array.
     *
     * @return array
     */
    public function capsuleMethod() : array
    {
        return $this->builder->order_cancel()->getFillable();
    }
}