<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posko;

class PoskoController extends Controller
{
    public function index()
    {
        $items = Posko::all();
        return view('poskos.index', compact('items'));
    }

    public function create()
    {
        return view('poskos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required'
        ]);

        Posko::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat
        ]);

        return redirect('/poskos')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = Posko::find($id);
        return view('poskos.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required'
        ]);

        $item = Posko::find($id);
        $item->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat
        ]);

        return redirect('/poskos')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $item = Posko::find($id);
        $item->delete();
        return redirect('/poskos')->with('success', 'Data berhasil dihapus');
    }
}
