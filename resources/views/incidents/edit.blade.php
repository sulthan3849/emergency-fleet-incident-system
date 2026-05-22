@extends('layouts.admin')
@section('title', 'Edit Incident')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Incident</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('incidents.update', $item->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>ID Posko</label>
                <input type="text" name="station_id" class="form-control" value="{{ $item->station_id }}" required>
            </div>
            <div class="form-group">
                <label>Tanggal Kejadian</label>
                <input type="text" name="date" class="form-control" value="{{ $item->date }}" required>
            </div>
            <div class="form-group">
                <label>Lokasi Kejadian</label>
                <input type="text" name="location" class="form-control" value="{{ $item->location }}" required>
            </div>
            <div class="form-group">
                <label>Tingkat Bahaya</label>
                <input type="text" name="severity" class="form-control" value="{{ $item->severity }}" required>
            </div>
            
            <!-- disini hasil eksekusi dari klik tombol simpan -->
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('incidents.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection