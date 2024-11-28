@extends('layouts.admin')

@section('title', 'Kelola Foto')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Foto</h1>
        <a href="{{ route('admin.foto.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 me-2"></i>Upload Foto
        </a>
    </div>

    <x-alert />

    <!-- Filter -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.foto.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <select name="galeri" class="form-select">
                        <option value="">Semua Galeri</option>
                        @foreach($galeris as $galeri)
                        <option value="{{ $galeri->id }}" {{ request('galeri') == $galeri->id ? 'selected' : '' }}>
                            {{ $galeri->post->judul }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari foto..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Foto Grid -->
    <div class="row g-4">
        @forelse($fotos as $foto)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card shadow h-100">
                <div class="card-img-top" style="aspect-ratio: 1/1;">
                    <img src="{{ Storage::url($foto->file) }}" 
                         alt="{{ $foto->judul }}"
                         class="w-100 h-100 object-fit-cover">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $foto->judul }}</h5>
                    <p class="card-text small text-muted">
                        Galeri: {{ $foto->galery->post->judul ?? '-' }}
                    </p>
                    <div class="btn-group w-100">
                        <a href="{{ route('admin.foto.edit', $foto->id) }}" 
                           class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.foto.destroy', $foto->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="{{ asset('images/no-data.svg') }}" alt="No Data" style="max-width: 200px">
            <p class="mt-3 text-muted">Belum ada foto</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-4">
        {{ $fotos->links() }}
    </div>
</div>

@push('styles')
<style>
.object-fit-cover {
    object-fit: cover;
}

.btn-group {
    gap: 0.25rem;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}
</style>
@endpush
@endsection 