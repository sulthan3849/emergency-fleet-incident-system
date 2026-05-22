<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

class StationController extends Controller
{
    public function index()
    {
        $items = Station::all();
        return view('stations.index', compact('items'));
    }

    public function create()
    {
        return view('stations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        Station::create([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return redirect('/stations')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = Station::find($id);
        return view('stations.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        $item = Station::find($id);
        $item->update([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return redirect('/stations')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $item = Station::find($id);
        $item->delete();
        return redirect('/stations')->with('success', 'Data berhasil dihapus');
    }
}
