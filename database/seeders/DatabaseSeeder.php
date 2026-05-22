<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $stations = \App\Models\Station::factory(5)->create();
        foreach ($stations as $station) {
            \App\Models\FireTruck::factory(3)->create(['station_id' => $station->id]);
            \App\Models\Incident::factory(4)->create(['station_id' => $station->id]);
        }
    }
}
