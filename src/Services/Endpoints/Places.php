<?php

namespace EliPett\GoogleMapsClient\Services\Endpoints;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

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

        $request = $this->client->get($uri);

        return $this->all($request);
    }

    public function details(string $id): array
    {
        $request = $this->client->get("details/json?key={$this->key}&placeid={$id}");

        return $this->all($request);
    }

    protected function all(ResponseInterface $request): array
    {
        $response = json_decode($request->getBody(), true);

        if ($this->hasError($response)) {
            $this->throwError($response);
        }

        return $response;
    }

    private function hasError(array $response): bool
    {
        return $response['status'] !== 'OK';
    }

    private function throwError(array $error): void
    {
        throw new \InvalidArgumentException(trans('googlemapsclient::messages.error.api', [
            'status' => array_get($error, 'status'),
            'message' => array_get($error, 'error_message')
        ]));
    }
}
