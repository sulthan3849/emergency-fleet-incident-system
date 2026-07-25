<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat akun Admin utama
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Opsional: Buat beberapa data Posko dasar
        \App\Models\Posko::create([
            'nama' => 'Posko Pusat',
            'alamat' => 'Jl. Merdeka No. 1'
        ]);

        \App\Models\Posko::create([
            'nama' => 'Posko Timur',
            'alamat' => 'Jl. Sudirman No. 99'
        ]);
    }
}
