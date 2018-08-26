<?php

namespace EliPett\GoogleMapsClient\Services\Endpoints;

use EliPett\GoogleMapsClient\Processors\ResponseProcessor;
use GuzzleHttp\Client;

class Geocoding
{
    private $client;
    private $key;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://maps.googleapis.com/maps/api/geocode/'
        ]);

        $this->key = config('googlemapsclient.keys.geocoding',
            env('GOOGLE_MAPS_API_KEY')
        );
    }

    public function get(string $address): array
    {
        $request = $this->client->get("json?key={$this->key}&address={$address}");

        return ResponseProcessor::all($request);
    }
}
