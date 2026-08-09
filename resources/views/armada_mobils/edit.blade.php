@extends('layouts.admin')
@section('title', 'Edit ArmadaMobil')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit ArmadaMobil</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('armada_mobils.update', $item->id) }}" method="POST" enctype="multipart/form-data">
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
                <label>Plat Nomor</label>
                <input type="text" name="plat_nomor" class="form-control" value="{{ $item->plat_nomor }}" required>
            </div>
            <div class="form-group">
                <label>Tipe Armada</label>
                <select name="tipe" class="form-control" required>
                    <option value="">-- Pilih Tipe Armada --</option>
                    <option value="Mobil Pemadam Utama" {{ $item->tipe == 'Mobil Pemadam Utama' ? 'selected' : '' }}>Mobil Pemadam Utama</option>
                    <option value="Truk Tangki Air" {{ $item->tipe == 'Truk Tangki Air' ? 'selected' : '' }}>Truk Tangki Air</option>
                    <option value="Mobil Tangga" {{ $item->tipe == 'Mobil Tangga' ? 'selected' : '' }}>Mobil Tangga</option>
                    <option value="Mobil Komando" {{ $item->tipe == 'Mobil Komando' ? 'selected' : '' }}>Mobil Komando</option>
                    <option value="Ambulans" {{ $item->tipe == 'Ambulans' ? 'selected' : '' }}>Ambulans</option>
                </select>
            </div>
            <div class="form-group">
                <label>Gambar Mobil</label>
                @if($item->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Mobil" class="img-thumbnail" width="200">
                    </div>
                @endif
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('armada_mobils.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection