<?php

namespace EliPett\GoogleMapsClient\Services;

use EliPett\GoogleMapsClient\Endpoints\Places;
use EliPett\GoogleMapsClient\Endpoints\Geocoding;

/**
 * Class GoogleMapsClient
 * @package EliPett\GoogleMapsClient\Services
 *
 * @property Places places
 * @property Geocoding geocoding
 */
class GoogleMapsClient
{
    public function __get($name)
    {
        $class = 'EliPett\\GoogleMapsClient\\Endpoints\\' . ucfirst($name);

        if (class_exists($class)) {
            return new $class;
        }

        throw new \InvalidArgumentException(trans('googlemapsclient::messages.error.endpoint'));
    }
}
