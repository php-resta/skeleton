<?php

namespace Store\Services;

use Symfony\Component\HttpFoundation\Request;
use Store\Traits\RequestService as RequestComponentTraits;

class RequestService extends Request {

    /**
     * request component trait
     */
    use RequestComponentTraits;
}