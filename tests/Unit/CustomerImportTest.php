<?php

namespace Unit;

use App\Models\Customer;
use App\Services\RandomUserService;
use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CustomerImportTest extends TestCase
{
    private array $users;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = [
           [
            'first_name' => 'Charlie',
            'last_name' => 'Tucker',
            'email' => 'email',
            'country' => 'Australia',
            'username' => 'goldengoose806',
            'password' => '781fed75e4ec669a64204f49e38db912',
            'gender' => 'male',
            'city' => 'Queanbeyan',
            'phone' => '00-8572-0686'
           ], [
            'first_name' => 'Charlie',
            'last_name' => 'Tucker',
            'email' => 'email',
            'country' => 'Australia',
            'username' => 'goldengoose806',
            'password' => '781fed75e4ec669a64204f49e38db912',
            'gender' => 'male',
            'city' => 'Queanbeyan',
            'phone' => '00-8572-0686'
            ],
        ];

    }

    public function testCustomerImportSaving()
    {
        $mock = Mockery::mock(RandomUserService::class, function (MockInterface $mock) {
            $mock->shouldReceive('request')
                ->andReturn($this->users);
        });

        $randomUserService = new RandomUserService(2);
        //request data
        $randomUsers = $mock->request();
        //save data from Random User Service
        $randomUserService->save($randomUsers);
    }


}
