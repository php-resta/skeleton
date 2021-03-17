<?php

namespace App\Model\Builder\Assistant;

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

