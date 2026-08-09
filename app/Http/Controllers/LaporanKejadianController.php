<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKejadian;
use App\Models\ArmadaMobil;

use App\Models\Posko;

class LaporanKejadianController extends Controller
{
    public function index()
    {
        $items = LaporanKejadian::with(['posko', 'armadaMobils'])->get();
        return view('laporan_kejadians.index', compact('items'));
    }

    public function create()
    {
        $poskos = Posko::all();
        $armadas = ArmadaMobil::all();
        return view('laporan_kejadians.create', compact('poskos', 'armadas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posko_id' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'tingkat_bahaya' => 'required',
            'armada_ids' => 'nullable|array',
            'armada_ids.*' => 'exists:armada_mobils,id'
        ]);

        $item = LaporanKejadian::create([
            'posko_id' => $request->posko_id,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'tingkat_bahaya' => $request->tingkat_bahaya
        ]);

        if ($request->has('armada_ids')) {
            $item->armadaMobils()->attach($request->armada_ids);
        }

        return redirect('/laporan_kejadians')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = LaporanKejadian::with('armadaMobils')->find($id);
        $poskos = Posko::all();
        $armadas = ArmadaMobil::all();
        return view('laporan_kejadians.edit', compact('item', 'poskos', 'armadas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posko_id' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'tingkat_bahaya' => 'required',
            'armada_ids' => 'nullable|array',
            'armada_ids.*' => 'exists:armada_mobils,id'
        ]);

        $item = LaporanKejadian::find($id);
        $item->update([
            'posko_id' => $request->posko_id,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'tingkat_bahaya' => $request->tingkat_bahaya
        ]);
        
        if ($request->has('armada_ids')) {
            $item->armadaMobils()->sync($request->armada_ids);
        } else {
            $item->armadaMobils()->detach();
        }

        return redirect('/laporan_kejadians')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $item = LaporanKejadian::find($id);
        $item->delete();
        return redirect('/laporan_kejadians')->with('success', 'Data berhasil dihapus');
    }
}
