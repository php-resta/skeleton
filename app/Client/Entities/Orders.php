<?php

namespace App\Munch\Api\V1\Client\Entities;

trait Orders
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
            
    protected $table_code;
     
    /**
     * table_code for request input
     * 
     * @rule(integer)
     * @return integer
     */
    protected function table_code()
    {
        return $this->table_code;
    }
            

}