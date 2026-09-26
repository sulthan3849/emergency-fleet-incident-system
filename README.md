# Emergency Fleet & Incident Management System (SIM-Posko) 🚒🚑

Sistem Informasi Manajemen Armada Kendaraan Tanggap Darurat dan Pelaporan Insiden Kejadian Bencana/Darurat (Damkar, PMI, BPBD) berbasis **Laravel 11**.

---

## ✨ Fitur Utama

- 🚨 **Pelaporan Insiden Kejadian**: Pencatatan lokasi, waktu kejadian, kategori bencana/kedaruratan, dan tingkat keparahan.
- 🚒 **Manajemen Armada Mobil**: Pendataan kendaraan operasional darurat (Ambulans, Mobil Pemadam, Truk Logistik, Rescue Car) lengkap dengan foto dan status ketersediaan.
- 📍 **Pusat Posko Siaga**: Manajemen posko wilayah darurat dan pembagian area kerja.
- 🤝 **Penugasan Armada ke Lokasi (Dispatch)**: Relasi penugasan armada mobil tanggap darurat secara langsung ke lokasi laporan kejadian.
- 📊 **Monitoring & Dashboard Terpadu**: Statistik kejadian aktif, armada siaga, dan rekapitulasi penanganan bencana.

---

## 📁 Struktur Direktori

```text
emergency-fleet-incident-system/
├── app/
│   ├── Http/Controllers/
│   │   ├── ArmadaMobilController.php      # Manajemen kendaraan tanggap darurat
│   │   ├── LaporanKejadianController.php  # Pengelolaan laporan insiden masuk
│   │   ├── PoskoController.php            # Manajemen posko wilayah siaga
│   │   ├── DashboardController.php        # Ringkasan data & statistik insiden
│   │   └── AuthController.php             # Keamanan & autentikasi operator
│   └── Models/                            # ArmadaMobil, LaporanKejadian, Posko, User
├── database/
│   └── migrations/                        # Tabel poskos, armada_mobils, laporan_kejadians
├── public/                                # Web document root
├── resources/
│   └── views/                             # Antarmuka responsif pengguna
├── routes/
│   └── web.php
└── README.md
```

---

## 🚀 Panduan Instalasi Lokal

```bash
# 1. Klon repositori
git clone https://github.com/sulthan3849/emergency-fleet-incident-system.git
cd emergency-fleet-incident-system

# 2. Instal dependensi
composer install
npm install && npm run build

# 3. Environment & Key
cp .env.example .env
php artisan key:generate

# 4. Migrasi & Jalankan
php artisan migrate
php artisan serve
```

---

## 📄 Lisensi
Distributed under the MIT License.
