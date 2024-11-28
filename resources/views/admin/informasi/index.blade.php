@extends('layouts.admin')

@section('title', 'Kelola Informasi')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Informasi</h1>
        <a href="{{ route('admin.informasi.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 me-2"></i>Tambah Informasi
        </a>
    </div>

    <!-- Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.informasi.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari informasi..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Informasi Cards -->
    <div class="row">
        @forelse($informasi as $info)
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="card-title mb-1">{{ $info->judul }}</h5>
                            <div class="text-muted small">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $info->created_at->format('d M Y') }}
                            </div>
                        </div>
                        <span class="badge bg-{{ $info->status == 'published' ? 'success' : 'warning' }}">
                            {{ $info->status }}
                        </span>
                    </div>
                    
                    @if($info->galery && $info->galery->fotos->isNotEmpty())
                    <div class="mb-3">
                        <img src="{{ Storage::url($info->galery->fotos->first()->file) }}" 
                             class="img-fluid rounded" alt="{{ $info->judul }}">
                    </div>
                    @endif
                    
                    <p class="card-text text-muted">{{ Str::limit(strip_tags($info->isi), 150) }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted">
                            <i class="fas fa-clock me-1"></i>
                            {{ $info->created_at->diffForHumans() }}
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('admin.informasi.edit', $info->id) }}" 
                               class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.informasi.destroy', $info->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus informasi ini?')">
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
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <img src="{{ asset('images/no-data.svg') }}" alt="No Data" style="max-width: 200px">
                <p class="mt-3 text-muted">Belum ada informasi</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $informasi->links() }}
    </div>
</div>

@push('styles')
<style>
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.btn-group {
    gap: 0.25rem;
}

.card img {
    max-height: 200px;
    object-fit: cover;
    width: 100%;
}
</style>
@endpush
@endsection 