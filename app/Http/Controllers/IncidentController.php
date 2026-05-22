<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;

class IncidentController extends Controller
{
    public function index()
    {
        $items = Incident::all();
        return view('incidents.index', compact('items'));
    }

    public function create()
    {
        return view('incidents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'station_id' => 'required',
            'date' => 'required',
            'location' => 'required',
            'severity' => 'required'
        ]);

        Incident::create([
            'station_id' => $request->station_id,
            'date' => $request->date,
            'location' => $request->location,
            'severity' => $request->severity
        ]);

        return redirect('/incidents')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = Incident::find($id);
        return view('incidents.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'station_id' => 'required',
            'date' => 'required',
            'location' => 'required',
            'severity' => 'required'
        ]);

        $item = Incident::find($id);
        $item->update([
            'station_id' => $request->station_id,
            'date' => $request->date,
            'location' => $request->location,
            'severity' => $request->severity
        ]);

        return redirect('/incidents')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $item = Incident::find($id);
        $item->delete();
        return redirect('/incidents')->with('success', 'Data berhasil dihapus');
    }
}
