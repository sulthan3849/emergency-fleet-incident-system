<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArmadaMobil;
use Illuminate\Support\Facades\Storage;

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
            'tipe' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('armada', 'public');
        }

        ArmadaMobil::create([
            'posko_id' => $request->posko_id,
            'plat_nomor' => $request->plat_nomor,
            'tipe' => $request->tipe,
            'gambar' => $gambarPath
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
            'tipe' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $item = ArmadaMobil::find($id);
        
        $gambarPath = $item->gambar;
        if ($request->hasFile('gambar')) {
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('armada', 'public');
        }

        $item->update([
            'posko_id' => $request->posko_id,
            'plat_nomor' => $request->plat_nomor,
            'tipe' => $request->tipe,
            'gambar' => $gambarPath
        ]);

        return redirect('/armada_mobils')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $item = ArmadaMobil::find($id);
        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();
        return redirect('/armada_mobils')->with('success', 'Data berhasil dihapus');
    }
}
