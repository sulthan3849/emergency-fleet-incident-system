<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\FireTruck;
use App\Models\Incident;

class DashboardController extends Controller
{
    public function index()
    {
        $stationCount = Station::count();
        $fireTruckCount = FireTruck::count();
        $incidentCount = Incident::count();

        return view('dashboard', compact('stationCount', 'fireTruckCount', 'incidentCount'));
    }
}
