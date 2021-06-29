<?php

namespace Feature;

use App\Models\Customer;
use Database\Factories\CustomerFactory;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class CustomerTest extends TestCase
{
   // use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        CustomerFactory::factoryForModel('Customer')->create();
    }


    public function testCustomerList()
    {
        $this->get('/customers');
        $this->seeStatusCode(200);
    }

    public function testshowCustomer()
    {
        $id = Customer::first()->id;
        $this->get('/customers/'. $id);
        $this->seeStatusCode(200);
    }

}
