<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posko;
use App\Models\ArmadaMobil;
use App\Models\LaporanKejadian;

class DashboardController extends Controller
{
    public function index()
    {
        $stationCount = Posko::count();
        $fireTruckCount = ArmadaMobil::count();
        $incidentCount = LaporanKejadian::count();

        return view('dashboard', compact('stationCount', 'fireTruckCount', 'incidentCount'));
    }
}
