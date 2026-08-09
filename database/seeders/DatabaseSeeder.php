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
        $posko1 = \App\Models\Posko::create([
            'nama' => 'Posko Pusat',
            'alamat' => 'Jl. Merdeka No. 1'
        ]);

        $posko2 = \App\Models\Posko::create([
            'nama' => 'Posko Timur',
            'alamat' => 'Jl. Sudirman No. 99'
        ]);

        // Buat data Armada Mobil
        $armada1 = \App\Models\ArmadaMobil::create([
            'posko_id' => $posko1->id,
            'tipe' => 'Mobil Pemadam Utama',
            'plat_nomor' => 'B 1234 DAM',
            'gambar' => 'armada/fire_engine.jpg'
        ]);

        $armada2 = \App\Models\ArmadaMobil::create([
            'posko_id' => $posko1->id,
            'tipe' => 'Mobil Tangga',
            'plat_nomor' => 'B 5678 DAM',
            'gambar' => 'armada/turntable_ladder.jpg'
        ]);

        $armada3 = \App\Models\ArmadaMobil::create([
            'posko_id' => $posko2->id,
            'tipe' => 'Ambulans',
            'plat_nomor' => 'B 9101 AMB',
            'gambar' => 'armada/ambulance.jpg'
        ]);

        $armada4 = \App\Models\ArmadaMobil::create([
            'posko_id' => $posko2->id,
            'tipe' => 'Truk Tangki Air',
            'plat_nomor' => 'B 1121 AIR',
            'gambar' => 'armada/water_tender.jpg'
        ]);

        $armada5 = \App\Models\ArmadaMobil::create([
            'posko_id' => $posko1->id,
            'tipe' => 'Mobil Komando',
            'plat_nomor' => 'B 3141 KOM',
            'gambar' => 'armada/fire_chief_car.jpg'
        ]);

        // Buat data Laporan Kejadian
        $kejadian1 = \App\Models\LaporanKejadian::create([
            'posko_id' => $posko1->id,
            'tanggal' => '2026-08-10',
            'lokasi' => 'Pabrik Tekstil, Jl. Industri Barat',
            'tingkat_bahaya' => 'Tinggi'
        ]);
        $kejadian1->armadaMobils()->attach([$armada1->id, $armada2->id, $armada5->id]);

        $kejadian2 = \App\Models\LaporanKejadian::create([
            'posko_id' => $posko2->id,
            'tanggal' => '2026-08-12',
            'lokasi' => 'Perumahan Warga, Jl. Damai Raya',
            'tingkat_bahaya' => 'Sedang'
        ]);
        $kejadian2->armadaMobils()->attach([$armada3->id, $armada4->id]);
    }
}
