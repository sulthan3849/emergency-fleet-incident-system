<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FireTruck;

class FireTruckController extends Controller
{
    public function index()
    {
        $items = FireTruck::all();
        return view('fire-trucks.index', compact('items'));
    }

    public function create()
    {
        return view('fire-trucks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'station_id' => 'required',
            'license_plate' => 'required',
            'type' => 'required'
        ]);

        FireTruck::create([
            'station_id' => $request->station_id,
            'license_plate' => $request->license_plate,
            'type' => $request->type
        ]);

        return redirect('/fire-trucks')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = FireTruck::find($id);
        return view('fire-trucks.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'station_id' => 'required',
            'license_plate' => 'required',
            'type' => 'required'
        ]);

        $item = FireTruck::find($id);
        $item->update([
            'station_id' => $request->station_id,
            'license_plate' => $request->license_plate,
            'type' => $request->type
        ]);

        return redirect('/fire-trucks')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $item = FireTruck::find($id);
        $item->delete();
        return redirect('/fire-trucks')->with('success', 'Data berhasil dihapus');
    }
}
