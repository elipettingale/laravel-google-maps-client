<?php

namespace EliPett\GoogleMapsClient\Services;

use EliPett\GoogleMapsClient\Services\Endpoints\Places;

/**
 * Class GoogleMapsClient
 * @package EliPett\GoogleMapsClient\Services
 *
 * @property Places places
 */
class GoogleMapsClient
{
    public function __get($name)
    {
        $class = 'EliPett\\GoogleMapsClient\\Services\\Endpoints\\' . ucfirst($name);

        if (class_exists($class)) {
            return new $class;
        }

        throw new \InvalidArgumentException(trans('googlemapsclient::messages.error.endpoint'));
    }
}
