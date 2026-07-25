@extends('layouts.admin')
@section('title', 'Edit Posko')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Posko</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('poskos.update', $item->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Nama Posko</label>
                <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
            </div>
            <div class="form-group">
                <label>Alamat Posko</label>
                <input type="text" name="alamat" class="form-control" value="{{ $item->alamat }}" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('poskos.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection