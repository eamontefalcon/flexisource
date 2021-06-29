<?php

namespace App\Services\HttpClients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Log;

class AbstractClient
{
    /**
     * Http client.
     */
    protected Client $client;

    /**
     * Create the instance.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send request to the client.
     */
    public function request(string $method, string $uri, array $options = []): \Illuminate\Http\JsonResponse
    {
        $response = null;

        try {
            $response = $this->client->request($method, $uri, $options);
        } catch (RequestException $e) {
            Log::info($e->getMessage());
            $response = $e->hasResponse()
                ? $e->getResponse()
                : new Response(500, [], json_encode([
                    'message' => 'Something went wrong.',
                ]));
        }

        return response()->json(
            json_decode($response->getBody()->getContents(), true),
            $response->getStatusCode()
        );
    }

    /**
     * Return the client.
     */
    public function getClient(): Client
    {
        return $this->client;
    }

}
