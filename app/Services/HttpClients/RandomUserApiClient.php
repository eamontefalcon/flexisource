<?php

namespace App\Services\HttpClients;

use Illuminate\Http\JsonResponse;

class RandomUserApiClient extends AbstractClient
{
    /**
     * Get random user
     */
    public function list(array $query = []): JsonResponse
    {
        return $this->request('GET', '/api', [
            'query' => $query,
        ]);
    }
}
