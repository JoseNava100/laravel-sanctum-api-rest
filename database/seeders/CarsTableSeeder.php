<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::factory()->create([
            'brand' => 'Lamborghini',
            'model' => 'Aventador',
            'year' => '2025',
            'color' => 'Rojo',
            'plate_number' => 'DDD4444',
        ]);
    }
}
