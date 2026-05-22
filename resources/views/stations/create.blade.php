@extends('layouts.admin')
@section('title', 'Tambah Station')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Station</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('stations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Posko</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat Posko</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            
            <!-- disini hasil eksekusi dari klik tombol simpan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('stations.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection