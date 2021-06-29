<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);

    	return [
    	    'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'country' => $this->faker->country,
            'username' => $this->faker->userName,
            'password' => md5($this->faker->password),
            'gender' => $gender,
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
    	];
    }
}
