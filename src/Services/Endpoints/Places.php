<?php

namespace EliPett\GoogleMapsClient\Services\Endpoints;

use EliPett\GoogleMapsClient\Processors\ResponseProcessor;
use GuzzleHttp\Client;

class Places
{
    private $client;
    private $key;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://maps.googleapis.com/maps/api/place/'
        ]);

        $this->key = config('googlemapsclient.keys.places',
            env('GOOGLE_MAPS_API_KEY')
        );
    }

    public function autocomplete(array $parameters): array
    {
        $uri = "autocomplete/json?key={$this->key}";

        foreach ($parameters as $key => $value) {
            $uri .= "&{$key}={$value}";
        }

        $response = $this->client->get($uri);

        return ResponseProcessor::all($response);
    }

    public function details(string $id): array
    {
        $response = $this->client->get("details/json?key={$this->key}&placeid={$id}");

        return ResponseProcessor::all($response);
    }
}
