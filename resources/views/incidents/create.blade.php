@extends('layouts.admin')
@section('title', 'Tambah Incident')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Incident</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('incidents.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>ID Posko</label>
                <input type="text" name="station_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal Kejadian</label>
                <input type="text" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Lokasi Kejadian</label>
                <input type="text" name="location" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tingkat Bahaya</label>
                <input type="text" name="severity" class="form-control" required>
            </div>
            
            <!-- disini hasil eksekusi dari klik tombol simpan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('incidents.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection