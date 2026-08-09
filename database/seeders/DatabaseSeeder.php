<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Posko::create([
            'id' => 1,
            'nama' => 'Posko Pusat',
            'alamat' => 'Jl. Merdeka No. 1'
        ]);

        \App\Models\Posko::create([
            'id' => 2,
            'nama' => 'Posko Timur',
            'alamat' => 'Jl. Sudirman No. 99'
        ]);

        \App\Models\ArmadaMobil::create([
            'id' => 1,
            'posko_id' => 1,
            'tipe' => 'Mobil Pemadam Utama',
            'plat_nomor' => '23523',
            'gambar' => 'armada/fire_engine.jpg'
        ]);

        \App\Models\ArmadaMobil::create([
            'id' => 2,
            'posko_id' => 1,
            'tipe' => 'Truk Tangki Air',
            'plat_nomor' => '3241',
            'gambar' => 'armada/water_tender.jpg'
        ]);

        \App\Models\ArmadaMobil::create([
            'id' => 4,
            'posko_id' => 1,
            'tipe' => 'Mobil Tangga',
            'plat_nomor' => '2324',
            'gambar' => 'armada/turntable_ladder.jpg'
        ]);

        \App\Models\ArmadaMobil::create([
            'id' => 5,
            'posko_id' => 2,
            'tipe' => 'Mobil Komando',
            'plat_nomor' => '43543',
            'gambar' => 'armada/fire_chief_car.jpg'
        ]);

        \App\Models\ArmadaMobil::create([
            'id' => 6,
            'posko_id' => 2,
            'tipe' => 'Ambulans',
            'plat_nomor' => '5476',
            'gambar' => 'armada/ambulance.jpg'
        ]);

        \App\Models\ArmadaMobil::create([
            'id' => 7,
            'posko_id' => 2,
            'tipe' => 'Mobil Pemadam Utama',
            'plat_nomor' => '0907',
            'gambar' => 'armada/TEqp954j5UYVfz4ybrDCab0SBbJWULBMjQhSPoLp.jpg'
        ]);

        $k1 = \App\Models\LaporanKejadian::create([
            'id' => 1,
            'posko_id' => 2,
            'tanggal' => '2026-08-20',
            'lokasi' => 'sabang',
            'tingkat_bahaya' => 'Rendah'
        ]);
        $k1->armadaMobils()->attach([5,6]);

        $k2 = \App\Models\LaporanKejadian::create([
            'id' => 2,
            'posko_id' => 2,
            'tanggal' => '2026-08-20',
            'lokasi' => 'sigli',
            'tingkat_bahaya' => 'Tinggi'
        ]);
        $k2->armadaMobils()->attach([5,6]);

        $k3 = \App\Models\LaporanKejadian::create([
            'id' => 3,
            'posko_id' => 1,
            'tanggal' => '2026-08-21',
            'lokasi' => 'kamboja',
            'tingkat_bahaya' => 'Tinggi'
        ]);
        $k3->armadaMobils()->attach([4]);

    }
}
