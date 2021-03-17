<?php

namespace App\Http;

use App\Factory\Factory;
use App\Client\ClientManager;
use Store\Traits\Annotations;
use App\Model\Entity\EntityMap;
use App\Model\Builder\BuilderMap;
use Resta\Contracts\ContainerContracts;
use Resta\Contracts\ApplicationContracts;

/**
 * Trait ServiceAnnotationsManager
 * @property EntityMap entity
 * @property BuilderMap builder
 * @property Factory factory
 * @property ClientManager client
 * @property ApplicationContracts|ContainerContracts app
 */
trait ServiceAnnotationsManager
{
    use Annotations;
}
