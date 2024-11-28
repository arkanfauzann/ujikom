@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Kelola Galeri</h1>
            <p class="mb-0 text-gray-600">Manajemen galeri foto kegiatan sekolah</p>
        </div>
        <a href="{{ route('admin.foto.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 me-2"></i>Upload Foto
        </a>
    </div>

    <x-alert />

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Galeri</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $galeris->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-images fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Foto</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $galeris->sum(function($galeri) { return $galeri->fotos->count(); }) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-camera fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="row g-4">
        @foreach($galeris as $galeri)
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow h-100">
                <!-- Card Header -->
                <div class="card-header bg-gradient-primary py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="m-0 font-weight-bold text-black">{{ $galeri->post->judul }}</h6>
                            <small class="text-black-50">
                                <i class="fas fa-clock me-1"></i>
                                {{ $galeri->created_at->format('d M Y') }}
                            </small>
                        </div>
                        <span class="badge bg-blac text-primary">{{ $galeri->fotos->count() }} Foto</span>
                    </div>
                </div>

                <!-- Gallery Preview -->
                <div class="card-body p-0">
                    <div class="gallery-grid">
                        @forelse($galeri->fotos->take(4) as $index => $foto)
                        <div class="gallery-item {{ $index > 1 ? 'mobile-hide' : '' }}">
                            <img src="{{ Storage::url($foto->file) }}" 
                                 alt="{{ $foto->judul }}"
                                 class="img-fluid">
                            <div class="gallery-overlay">
                                <a href="{{ Storage::url($foto->file) }}" 
                                   data-lightbox="gallery-{{ $galeri->id }}"
                                   data-title="{{ $foto->judul }}"
                                   class="view-btn">
                                    <i class="fas fa-search-plus"></i>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="empty-state">
                            <i class="fas fa-images fa-3x text-gray-300 mb-3"></i>
                            <p class="text-muted mb-0">Belum ada foto</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{ route('admin.foto.create', ['galery_id' => $galeri->id]) }}" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>Tambah Foto
                            </a>
                            <button type="button" 
                                    class="btn btn-danger btn-sm"
                                    onclick="confirmDelete('{{ $galeri->id }}', '{{ $galeri->post->judul }}')">
                                <i class="fas fa-trash me-1"></i>Hapus Galeri
                            </button>
                        </div>
                        <a href="#" class="text-primary">
                            <i class="fas fa-eye me-1"></i>Detail
                        </a>
                    </div>

                    <form id="delete-form-{{ $galeri->id }}"
                          action="{{ route('admin.galeri.destroy', $galeri->id) }}"
                          method="POST" 
                          class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<style>
.card {
    transition: all 0.3s ease;
    border: none;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
}

.card-header {
    border-bottom: none;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2px;
}

.gallery-item {
    position: relative;
    aspect-ratio: 1/1;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.view-btn {
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background: rgba(255,255,255,0.2);
    color: white;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.view-btn:hover {
    background: rgba(255,255,255,0.3);
    color: white;
    transform: scale(1.1);
}

.empty-state {
    grid-column: 1 / -1;
    padding: 3rem;
    text-align: center;
}

.btn-group {
    gap: 0.5rem;
}

.card-footer {
    border-top: 1px solid rgba(0,0,0,0.05);
    background: white;
}

@media (max-width: 576px) {
    .mobile-hide {
        display: none;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(1, 1fr);
    }
    
    .card-header h6 {
        font-size: 0.9rem;
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script>
function confirmDelete(galeriId, galeriTitle) {
    if (confirm(`Yakin ingin menghapus galeri "${galeriTitle}"?\nSemua foto akan ikut terhapus.`)) {
        document.getElementById('delete-form-' + galeriId).submit();
    }
}

lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true,
    'showImageNumberLabel': false
});
</script>
@endpush
@endsection 