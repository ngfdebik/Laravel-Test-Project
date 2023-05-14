<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persons>
 */

class PersonsFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'gender' => fake()->title($gender = 'male'|'female'),
            'telephone' => fake()->unique()->tollFreePhoneNumber(),
            'address' => fake()->streetAddress(),
        ];
    }
}
