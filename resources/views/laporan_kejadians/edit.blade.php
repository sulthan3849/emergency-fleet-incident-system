@extends('layouts.admin')
@section('title', 'Edit LaporanKejadian')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit LaporanKejadian</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('laporan_kejadians.update', $item->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Pilih Posko</label>
                <select name="posko_id" class="form-control" required>
                    <option value="">-- Pilih Posko --</option>
                    @foreach($poskos as $posko)
                        <option value="{{ $posko->id }}" {{ $item->posko_id == $posko->id ? 'selected' : '' }}>
                            {{ $posko->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Kejadian</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $item->tanggal }}" required>
            </div>
            <div class="form-group">
                <label>Lokasi Kejadian</label>
                <input type="text" name="lokasi" class="form-control" value="{{ $item->lokasi }}" required>
            </div>
            <div class="form-group">
                <label>Tingkat Bahaya</label>
                <select name="tingkat_bahaya" class="form-control" required>
                    <option value="">-- Pilih Tingkat Bahaya --</option>
                    <option value="Rendah" {{ $item->tingkat_bahaya == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="Sedang" {{ $item->tingkat_bahaya == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="Tinggi" {{ $item->tingkat_bahaya == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('laporan_kejadians.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection