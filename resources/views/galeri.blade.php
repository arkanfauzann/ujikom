@extends('layouts.main')

@section('title', 'Galeri')

@section('content')
<!-- Header -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold text-white mb-4" data-aos="fade-up">ACTIVITY GALLERY</h1>
                <p class="lead text-white mb-0" data-aos="fade-up" data-aos-delay="100">Dokumentasi Kegiatan SMKN 4 Bogor</p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Counter -->
<section class="counter-section py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="counter-item">
                    <div class="counter-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <h2 class="counter mb-2">{{ $galeris->sum(function($galeri) { return $galeri->fotos->count(); }) }}</h2>
                    <p class="text-muted">Total Foto</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="counter-item">
                    <div class="counter-icon bg-success">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h2 class="counter mb-2">{{ $galeris->count() }}</h2>
                    <p class="text-muted">Album Galeri</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="counter-item">
                    <div class="counter-icon bg-info">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <h2 class="counter mb-2">{{ $galeris->first()?->created_at->format('Y') ?? date('Y') }}</h2>
                    <p class="text-muted">Tahun Dokumentasi</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="counter-item">
                    <div class="counter-icon bg-warning">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h2 class="counter mb-2">100+</h2>
                    <p class="text-muted">Kegiatan Terdokumentasi</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery -->
<section class="gallery-section py-5 bg-light">
    <div class="container">
        @foreach($galeris as $galeri)
        <div class="gallery-container mb-5" data-aos="fade-up">
            <div class="gallery-header mb-4">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="gallery-icon">
                            <i class="fas fa-images"></i>
                        </div>
                    </div>
                    <div class="col">
                        <h3 class="gallery-title mb-0">{{ $galeri->post->judul }}</h3>
                        <p class="text-muted mb-0">
                            <i class="fas fa-calendar-alt me-2"></i>
                            {{ $galeri->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-primary rounded-pill">
                            {{ $galeri->fotos->count() }} Foto
                        </span>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                @foreach($galeri->fotos as $foto)
                <div class="col-lg-3 col-md-6" data-aos="zoom-in">
                    <div class="program-card">
                        <div class="program-image">
                            <img src="{{ Storage::url($foto->file) }}" alt="{{ $foto->judul }}">
                            <div class="program-overlay">
                                <a href="{{ Storage::url($foto->file) }}" 
                                   data-lightbox="gallery-{{ $galeri->id }}" 
                                   data-title="{{ $foto->judul }}"
                                   class="view-btn">
                                    <i class="fas fa-search-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="program-content">
                            <h4>{{ $foto->judul }}</h4>
                            <p class="mb-0">
                                <i class="fas fa-clock me-2 text-primary"></i>
                                {{ $foto->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<style>
.page-header {
    background: linear-gradient(135deg, rgba(0,0,0,0.8), rgba(0,0,0,0.5)), url('{{ asset("images/header-bg.jpg") }}');
    background-size: cover;
    background-position: center;
    padding: 150px 0 100px;
}

.counter-section {
    background: white;
}

.counter-item {
    padding: 30px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.counter-item:hover {
    transform: translateY(-10px);
}

.counter-icon {
    width: 70px;
    height: 70px;
    line-height: 70px;
    font-size: 1.8rem;
    background: #4e73df;
    color: white;
    border-radius: 20px;
    margin: 0 auto 20px;
    transition: all 0.3s ease;
}

.counter-item:hover .counter-icon {
    transform: rotateY(180deg);
}

.counter {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    font-family: 'Poppins', sans-serif;
}

.gallery-header {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.gallery-icon {
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    background: #4e73df;
    color: white;
    border-radius: 15px;
    font-size: 1.2rem;
}

.gallery-title {
    color: #2c3e50;
    font-weight: 600;
}

.program-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.program-card:hover {
    transform: translateY(-10px);
}

.program-image {
    position: relative;
    aspect-ratio: 1/1;
    overflow: hidden;
}

.program-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.program-card:hover .program-image img {
    transform: scale(1.1);
}

.program-overlay {
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

.program-card:hover .program-overlay {
    opacity: 1;
}

.view-btn {
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    background: rgba(255,255,255,0.2);
    color: white;
    border-radius: 15px;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.view-btn:hover {
    background: rgba(255,255,255,0.3);
    color: white;
    transform: scale(1.1) rotate(90deg);
}

.program-content {
    padding: 20px;
}

.program-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #2c3e50;
}

.program-content p {
    color: #6c757d;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .counter {
        font-size: 2rem;
    }
    
    .program-content {
        padding: 15px;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
<script>
$(document).ready(function() {
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });

    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'showImageNumberLabel': false
    });
});
</script>
@endpush
@endsection 