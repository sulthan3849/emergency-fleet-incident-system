<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKejadian;

use App\Models\Posko;

class LaporanKejadianController extends Controller
{
    public function index()
    {
        $items = LaporanKejadian::with('posko')->get();
        return view('laporan_kejadians.index', compact('items'));
    }

    public function create()
    {
        $poskos = Posko::all();
        return view('laporan_kejadians.create', compact('poskos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posko_id' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'tingkat_bahaya' => 'required'
        ]);

        LaporanKejadian::create([
            'posko_id' => $request->posko_id,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'tingkat_bahaya' => $request->tingkat_bahaya
        ]);

        return redirect('/laporan_kejadians')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = LaporanKejadian::find($id);
        $poskos = Posko::all();
        return view('laporan_kejadians.edit', compact('item', 'poskos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posko_id' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
            'tingkat_bahaya' => 'required'
        ]);

        $item = LaporanKejadian::find($id);
        $item->update([
            'posko_id' => $request->posko_id,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'tingkat_bahaya' => $request->tingkat_bahaya
        ]);

        return redirect('/laporan_kejadians')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $item = LaporanKejadian::find($id);
        $item->delete();
        return redirect('/laporan_kejadians')->with('success', 'Data berhasil dihapus');
    }
}
