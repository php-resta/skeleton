<?php

namespace App\Http;

use App\Client\ClientManager;
use Store\Traits\Annotations;
use Resta\Contracts\ContainerContracts;
use Resta\Contracts\ApplicationContracts;

/**
 * Trait ServiceAnnotationsManager
 * @property \App\Munch\Api\V1\Model\Entity\EntityMap entity
 * @property \App\Munch\Api\V1\Model\Builder\BuilderMap builder
 * @property \App\Factory\Factory factory
 * @property ClientManager client
 * @property ApplicationContracts|ContainerContracts app
 */
trait ServiceAnnotationsManager
{
    use Annotations;
}
