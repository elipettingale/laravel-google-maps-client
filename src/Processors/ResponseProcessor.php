<?php

namespace EliPett\GoogleMapsClient\Processors;

use Psr\Http\Message\ResponseInterface;

class ResponseProcessor
{
    public static function all(ResponseInterface $request): array
    {
        $response = json_decode($request->getBody(), true);

        if (self::hasError($response)) {
            self::throwError($response);
        }

        return $response;
    }

    public static function first(ResponseInterface $request): array
    {
        return self::all($request)[0];
    }

    private static function hasError(array $response): bool
    {
        return $response['status'] !== 'OK';
    }

    private static function throwError(array $error): void
    {
        throw new \InvalidArgumentException(trans('googlemapsclient::messages.error.api', [
            'status' => array_get($error, 'status'),
            'message' => array_get($error, 'error_message')
        ]));
    }
}
