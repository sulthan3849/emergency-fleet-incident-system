@extends('layouts.admin')
@section('title', 'Tambah FireTruck')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah FireTruck</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('fire-trucks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>ID Posko</label>
                <input type="text" name="station_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Plat Nomor</label>
                <input type="text" name="license_plate" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tipe Armada</label>
                <input type="text" name="type" class="form-control" required>
            </div>
            
            <!-- disini hasil eksekusi dari klik tombol simpan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('fire-trucks.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection