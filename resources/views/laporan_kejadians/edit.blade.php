@extends('layouts.admin')
@section('title', 'Edit LaporanKejadian')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit LaporanKejadian</h1>
</div>

<style>
.armada-card {
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    border: 2px solid transparent;
}
.armada-card:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
.armada-card.selected {
    border-color: #4e73df;
    background-color: #f8f9fc;
}
.armada-checkbox {
    display: none; 
}
</style>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('laporan_kejadians.update', $item->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Pilih Posko</label>
                <select name="posko_id" id="posko_id" class="form-control" required>
                    <option value="">-- Pilih Posko --</option>
                    @foreach($poskos as $posko)
                        <option value="{{ $posko->id }}" {{ $item->posko_id == $posko->id ? 'selected' : '' }}>
                            {{ $posko->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Armada yang Diutus</label>
                <div id="armada_container" class="row">
                    <!-- Options populated by JS -->
                </div>
                <small class="form-text text-muted">Klik pada kartu armada untuk memilih atau membatalkan pilihan.</small>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const allArmadas = @json($armadas);
        const selectedArmadaIds = @json($item->armadaMobils->pluck('id'));
        const poskoSelect = document.getElementById('posko_id');
        const armadaContainer = document.getElementById('armada_container');
        const storageUrl = "{{ asset('storage') }}";

        function updateArmadaOptions() {
            const poskoId = poskoSelect.value;
            armadaContainer.innerHTML = '';
            
            if (!poskoId) {
                armadaContainer.innerHTML = '<div class="col-12"><div class="alert alert-info">Silakan pilih posko terlebih dahulu.</div></div>';
                return;
            }

            const filtered = allArmadas.filter(a => a.posko_id == poskoId);
            
            if (filtered.length === 0) {
                armadaContainer.innerHTML = '<div class="col-12"><div class="alert alert-warning">Tidak ada armada di posko ini.</div></div>';
                return;
            }

            filtered.forEach(a => {
                const isSelected = selectedArmadaIds.includes(a.id);
                const imgUrl = a.gambar ? `${storageUrl}/${a.gambar}` : 'https://via.placeholder.com/150?text=No+Image';
                
                const col = document.createElement('div');
                col.className = 'col-md-4 mb-3';
                col.innerHTML = `
                    <div class="card armada-card h-100 ${isSelected ? 'selected' : ''}" onclick="toggleArmada(this)">
                        <img src="${imgUrl}" class="card-img-top" alt="${a.tipe}" style="height: 120px; object-fit: cover;">
                        <div class="card-body p-2 text-center">
                            <h6 class="card-title mb-1 font-weight-bold text-primary" style="font-size: 0.9rem;">${a.tipe}</h6>
                            <p class="card-text small mb-0">${a.plat_nomor}</p>
                            <input type="checkbox" name="armada_ids[]" value="${a.id}" class="armada-checkbox" ${isSelected ? 'checked' : ''}>
                        </div>
                        <div class="position-absolute check-icon-container" style="top: 10px; right: 10px; display: ${isSelected ? 'block' : 'none'};">
                            <i class="fas fa-check-circle text-primary" style="font-size: 1.5rem; background: white; border-radius: 50%;"></i>
                        </div>
                    </div>
                `;
                armadaContainer.appendChild(col);
            });
        }

        window.toggleArmada = function(card) {
            const checkbox = card.querySelector('.armada-checkbox');
            const iconContainer = card.querySelector('.check-icon-container');
            
            checkbox.checked = !checkbox.checked;
            
            if (checkbox.checked) {
                card.classList.add('selected');
                iconContainer.style.display = 'block';
            } else {
                card.classList.remove('selected');
                iconContainer.style.display = 'none';
            }
        }

        poskoSelect.addEventListener('change', updateArmadaOptions);
        
        // Initial run
        updateArmadaOptions();
    });
</script>
@endpush