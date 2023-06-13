<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Automobile>
 */
class AutomobileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        $car = $faker->vehicleArray;
        return [
            'brand' => $car['brand'],
            'model' => $car['model'],
            'color' => fake()->colorName(),
            'stateNumberRF' => $faker->unique()->vehicleRegistration('[A-Z]{1}-[0-9]{3}-[A-Z]{2}'),
            'inTheParking' => 1,
            'user_id' => User::getRandomUserId()->id,
        ];
    }
}
