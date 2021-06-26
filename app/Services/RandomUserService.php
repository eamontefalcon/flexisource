<?php

namespace App\Services;

use App\Models\Customer;
use App\Services\HttpClients\RandomUserApiClient;
use Illuminate\Support\Facades\Log;

class RandomUserService implements RandomUserApiContract
{
    private int $userCount;

    public function __construct(int $userCount)
    {
        $this->userCount = $userCount;
    }

    public function request(): array
    {
        $users = app(RandomUserApiClient::class)->list(
            ['nat' => 'au', 'results' => $this->userCount]
        );

        //error encounter in api request
        if (!$users->isSuccessful()) {
            Log::error('encountered requesting data to random api');
            return [];
        }

        $users = $users->getOriginalContent()['results'];
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'first_name' => $user['name']['first'],
                'last_name' =>  $user['name']['last'],
                'email' => $user['email'],
                'country' => $user['location']['country'],
                'username' => $user['login']['username'],
                'password' => md5($user['login']['password']),
                'gender' => $user['gender'],
                'city' => $user['location']['city'],
                'phone' => $user['phone']
            ];
        }

        return $data;
    }

    public function save($data): bool
    {
        $result = Customer::upsert(
            $data,
            ['email'],
            [
                'first_name',
                'last_name',
                'country',
                'username',
                'gender',
                'city',
                'phone'
            ]
        );

        return (bool)$result;
    }

}
