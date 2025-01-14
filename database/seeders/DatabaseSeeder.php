<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345678'),
        ]);

        Car::factory()->create([
            'brand' => 'Lamborghini',
            'model' => 'Aventador',
            'year' => '2025',
            'color' => 'Rojo',
            'plate_number' => 'DDD4444',
        ]);
    }
}
