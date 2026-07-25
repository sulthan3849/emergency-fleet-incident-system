@extends('layouts.admin')
@section('title', 'Tambah Posko')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Posko</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('poskos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Posko</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat Posko</label>
                <input type="text" name="alamat" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('poskos.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection