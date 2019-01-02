<?php

namespace Store\Contracts;

interface HandleTraitContract
{
    /**
     * @return mixed|void
     */
    public function handle();
}