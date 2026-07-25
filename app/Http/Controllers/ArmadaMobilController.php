<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArmadaMobil;

use App\Models\Posko;

class ArmadaMobilController extends Controller
{
    public function index()
    {
        $items = ArmadaMobil::with('posko')->get();
        return view('armada_mobils.index', compact('items'));
    }

    public function create()
    {
        $poskos = Posko::all();
        return view('armada_mobils.create', compact('poskos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'posko_id' => 'required',
            'plat_nomor' => 'required',
            'tipe' => 'required'
        ]);

        ArmadaMobil::create([
            'posko_id' => $request->posko_id,
            'plat_nomor' => $request->plat_nomor,
            'tipe' => $request->tipe
        ]);

        return redirect('/armada_mobils')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = ArmadaMobil::find($id);
        $poskos = Posko::all();
        return view('armada_mobils.edit', compact('item', 'poskos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posko_id' => 'required',
            'plat_nomor' => 'required',
            'tipe' => 'required'
        ]);

        $item = ArmadaMobil::find($id);
        $item->update([
            'posko_id' => $request->posko_id,
            'plat_nomor' => $request->plat_nomor,
            'tipe' => $request->tipe
        ]);

        return redirect('/armada_mobils')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $item = ArmadaMobil::find($id);
        $item->delete();
        return redirect('/armada_mobils')->with('success', 'Data berhasil dihapus');
    }
}
