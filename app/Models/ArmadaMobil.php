<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArmadaMobil extends Model
{
    use HasFactory;

    protected $fillable = ['posko_id', 'plat_nomor', 'tipe', 'gambar'];

    public function posko()
    {
        return $this->belongsTo(Posko::class);
    }

    public function laporanKejadians()
    {
        return $this->belongsToMany(LaporanKejadian::class, 'armada_mobil_laporan_kejadian');
    }
}
