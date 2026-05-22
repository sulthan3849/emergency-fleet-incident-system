<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireTruck extends Model
{
    /** @use HasFactory<\Database\Factories\FireTruckFactory> */
    use HasFactory;

    protected $fillable = ['station_id', 'license_plate', 'type'];
}
