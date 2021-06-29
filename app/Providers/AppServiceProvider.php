<?php

namespace App\Providers;

use App\Services\HttpClients\RandomUserApiClient;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $headers = [
            'X-Requested-With' => 'XMLHttpRequest',
            'Content-Type' => 'application/json',
        ];

        $this->app->singleton(RandomUserApiClient::class, function () use ($headers) {
            $client = new Client([
                'base_uri' => config('domains.random_user.uri'),
                'headers' => $headers,
            ]);

            return new RandomUserApiClient($client);
        });

    }
}
