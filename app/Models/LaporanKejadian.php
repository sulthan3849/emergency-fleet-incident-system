<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKejadian extends Model
{
    use HasFactory;

    protected $fillable = ['posko_id', 'tanggal', 'lokasi', 'tingkat_bahaya'];

    public function posko()
    {
        return $this->belongsTo(Posko::class);
    }
}
