<?php

namespace App\Munch\Api\V1\Client\Entities;

trait Order_cancels
{
    protected $is_deleted;
     
    /**
     * is_deleted for request input
     * 
     * @rule(integer)
     * @return integer
     */
    protected function is_deleted()
    {
        return $this->is_deleted;
    }
            
    protected $status;
     
    /**
     * status for request input
     * 
     * @rule(integer)
     * @return integer
     */
    protected function status()
    {
        return $this->status;
    }
            
    protected $cancel_note;
     
    /**
     * cancel_note for request input
     * 
     * @rule(dontStartSpace)
     * @return string
     */
    protected function cancel_note()
    {
        return $this->cancel_note;
    }
            
    protected $order_code;
     
    /**
     * order_code for request input
     * 
     * @rule(integer)
     * @return integer
     */
    protected function order_code()
    {
        return $this->order_code;
    }
            
    protected $restaurant_code;
     
    /**
     * restaurant_code for request input
     * 
     * @rule(integer)
     * @return integer
     */
    protected function restaurant_code()
    {
        return $this->restaurant_code;
    }
            

}