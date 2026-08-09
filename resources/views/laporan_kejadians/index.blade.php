@extends('layouts.admin')
@section('title', 'Data LaporanKejadian')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data LaporanKejadian</h1>
    <a href="{{ route('laporan_kejadians.create') }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
</div>
@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Posko</th>
                        <th>Armada yang Diutus</th>
                        <th>Tanggal Kejadian</th>
                        <th>Lokasi Kejadian</th>
                        <th>Tingkat Bahaya</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->posko->nama ?? 'Tidak Ada' }}</td>
                        <td>
                            @forelse($item->armadaMobils as $armada)
                                <div class="mb-1 d-flex align-items-center">
                                    @if($armada->gambar)
                                        <img src="{{ asset('storage/' . $armada->gambar) }}" alt="{{ $armada->tipe }}" class="img-thumbnail mr-2" style="width: 50px; height: 50px; object-fit: cover;">
                                    @endif
                                    <span class="badge badge-info">{{ $armada->tipe }}</span>
                                </div>
                            @empty
                                <span class="text-muted small">Tidak ada armada</span>
                            @endforelse
                        </td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->tingkat_bahaya }}</td>
                        <td>
                            <a href="{{ route('laporan_kejadians.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('laporan_kejadians.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection