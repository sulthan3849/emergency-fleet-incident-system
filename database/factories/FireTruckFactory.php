<?php

namespace Database\Factories;

use App\Models\FireTruck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FireTruck>
 */
class FireTruckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'station_id' => \App\Models\Station::factory(),
            'license_plate' => strtoupper(fake()->bothify('B #### ??')),
            'type' => fake()->randomElement(['Pompa', 'Tangga', 'Penyelamat', 'Tangki Air']),
        ];
    }
}
