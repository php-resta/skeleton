<?php

namespace Store\Services;

use Illuminate\Support\Collection;

class AppCollection
{
    /**
     * @param array $data
     * @return Collection
     */
    public function collect($data=array())
    {
        return collect($data);
    }

}