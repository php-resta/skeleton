<?php

namespace App\Munch\Api\V1\Model\Builder\Assistant;

trait Builder
{
    /**
     * get fillable fields for model
     *
     * @return array
     */
    public function getFillable()
    {
        return static::$model::getFillableValues();
    }
}

