<?php

$controllers = [
    'Station' => [
        'table' => 'stations',
        'var' => 'station',
        'fields' => ['name', 'address'],
        'labels' => ['Nama Posko', 'Alamat Posko']
    ],
    'FireTruck' => [
        'table' => 'fire-trucks',
        'var' => 'fireTruck',
        'fields' => ['station_id', 'license_plate', 'type'],
        'labels' => ['ID Posko', 'Plat Nomor', 'Tipe Armada']
    ],
    'Incident' => [
        'table' => 'incidents',
        'var' => 'incident',
        'fields' => ['station_id', 'date', 'location', 'severity'],
        'labels' => ['ID Posko', 'Tanggal Kejadian', 'Lokasi Kejadian', 'Tingkat Bahaya']
    ]
];

foreach ($controllers as $model => $data) {
    $c = $model . 'Controller';
    $t = $data['table'];
    $v = $data['var'];

    $valRules = [];
    $createFields = [];
    $updateFields = [];
    foreach ($data['fields'] as $f) {
        $valRules[] = "'$f' => 'required'";
        $createFields[] = "'$f' => \$request->$f";
        $updateFields[] = "'$f' => \$request->$f";
    }
    $valStr = implode(",\n            ", $valRules);
    $createStr = implode(",\n            ", $createFields);
    $updateStr = implode(",\n            ", $updateFields);

    $code = "<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\\$model;

class $c extends Controller
{
    public function index()
    {
        \$items = $model::all();
        return view('$t.index', compact('items'));
    }

    public function create()
    {
        return view('$t.create');
    }

    public function store(Request \$request)
    {
        \$request->validate([
            $valStr
        ]);

        $model::create([
            $createStr
        ]);

        return redirect('/$t')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(\$id)
    {
        \$item = $model::find(\$id);
        return view('$t.edit', compact('item'));
    }

    public function update(Request \$request, \$id)
    {
        \$request->validate([
            $valStr
        ]);

        \$item = $model::find(\$id);
        \$item->update([
            $updateStr
        ]);

        return redirect('/$t')->with('success', 'Data berhasil diubah');
    }

    public function destroy(\$id)
    {
        \$item = $model::find(\$id);
        \$item->delete();
        return redirect('/$t')->with('success', 'Data berhasil dihapus');
    }
}
";
    file_put_contents(__DIR__ . "/app/Http/Controllers/$c.php", $code);

    @mkdir(__DIR__ . "/resources/views/$t", 0777, true);

    $thStr = '';
    $tdStr = '';
    $formCreateStr = '';
    $formEditStr = '';
    foreach ($data['fields'] as $i => $f) {
        $label = $data['labels'][$i];
        $thStr .= "<th>$label</th>\n                        ";
        $tdStr .= "<td>{{ \$item->$f }}</td>\n                        ";
        $formCreateStr .= "<div class=\"form-group\">
                <label>$label</label>
                <input type=\"text\" name=\"$f\" class=\"form-control\" required>
            </div>\n            ";
        $formEditStr .= "<div class=\"form-group\">
                <label>$label</label>
                <input type=\"text\" name=\"$f\" class=\"form-control\" value=\"{{ \$item->$f }}\" required>
            </div>\n            ";
    }

    $indexHtml = "@extends('layouts.admin')
@section('title', 'Data $model')
@section('content')
<div class=\"d-sm-flex align-items-center justify-content-between mb-4\">
    <h1 class=\"h3 mb-0 text-gray-800\">Data $model</h1>
    <a href=\"{{ route('$t.create') }}\" class=\"btn btn-sm btn-primary shadow-sm\"><i class=\"fas fa-plus fa-sm text-white-50\"></i> Tambah Data</a>
</div>
@if(session('success')) <div class=\"alert alert-success\">{{ session('success') }}</div> @endif
<div class=\"card shadow mb-4\">
    <div class=\"card-body\">
        <div class=\"table-responsive\">
            <table class=\"table table-bordered\" width=\"100%\" cellspacing=\"0\">
                <thead>
                    <tr>
                        <th>No</th>
                        $thStr<th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\$items as \$index => \$item)
                    <tr>
                        <td>{{ \$index + 1 }}</td>
                        $tdStr<td>
                            <a href=\"{{ route('$t.edit', \$item->id) }}\" class=\"btn btn-warning btn-sm\">Edit</a>
                            <form action=\"{{ route('$t.destroy', \$item->id) }}\" method=\"POST\" class=\"d-inline\">
                                @csrf @method('DELETE')
                                <button type=\"submit\" class=\"btn btn-danger btn-sm\" onclick=\"return confirm('Hapus data ini?')\">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection";
    file_put_contents(__DIR__ . "/resources/views/$t/index.blade.php", $indexHtml);

    $createHtml = "@extends('layouts.admin')
@section('title', 'Tambah $model')
@section('content')
<div class=\"d-sm-flex align-items-center justify-content-between mb-4\">
    <h1 class=\"h3 mb-0 text-gray-800\">Tambah $model</h1>
</div>
<div class=\"card shadow mb-4\">
    <div class=\"card-body\">
        <form action=\"{{ route('$t.store') }}\" method=\"POST\">
            @csrf
            $formCreateStr
            <!-- disini hasil eksekusi dari klik tombol simpan -->
            <button type=\"submit\" class=\"btn btn-primary\">Simpan</button>
            <a href=\"{{ route('$t.index') }}\" class=\"btn btn-secondary\">Batal</a>
        </form>
    </div>
</div>
@endsection";
    file_put_contents(__DIR__ . "/resources/views/$t/create.blade.php", $createHtml);

    $editHtml = "@extends('layouts.admin')
@section('title', 'Edit $model')
@section('content')
<div class=\"d-sm-flex align-items-center justify-content-between mb-4\">
    <h1 class=\"h3 mb-0 text-gray-800\">Edit $model</h1>
</div>
<div class=\"card shadow mb-4\">
    <div class=\"card-body\">
        <form action=\"{{ route('$t.update', \$item->id) }}\" method=\"POST\">
            @csrf @method('PUT')
            $formEditStr
            <!-- disini hasil eksekusi dari klik tombol simpan -->
            <button type=\"submit\" class=\"btn btn-primary\">Simpan Perubahan</button>
            <a href=\"{{ route('$t.index') }}\" class=\"btn btn-secondary\">Batal</a>
        </form>
    </div>
</div>
@endsection";
    file_put_contents(__DIR__ . "/resources/views/$t/edit.blade.php", $editHtml);
}
echo "done";
