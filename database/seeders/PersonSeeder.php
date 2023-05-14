<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persons;

class PersonSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Persons::factory()->count(50)->create();
    }
}
