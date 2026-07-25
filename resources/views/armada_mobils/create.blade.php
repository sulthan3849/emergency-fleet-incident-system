@extends('layouts.admin')
@section('title', 'Tambah ArmadaMobil')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah ArmadaMobil</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('armada_mobils.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Pilih Posko</label>
                <select name="posko_id" class="form-control" required>
                    <option value="">-- Pilih Posko --</option>
                    @foreach($poskos as $posko)
                        <option value="{{ $posko->id }}">{{ $posko->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Plat Nomor</label>
                <input type="text" name="plat_nomor" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tipe Armada</label>
                <select name="tipe" class="form-control" required>
                    <option value="">-- Pilih Tipe Armada --</option>
                    <option value="Mobil Pemadam Utama">Mobil Pemadam Utama</option>
                    <option value="Truk Tangki Air">Truk Tangki Air</option>
                    <option value="Mobil Tangga">Mobil Tangga</option>
                    <option value="Mobil Komando">Mobil Komando</option>
                    <option value="Ambulans">Ambulans</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('armada_mobils.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection