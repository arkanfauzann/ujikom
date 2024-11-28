@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="mb-5">
        <h2 class="text-navy">Dashboard</h2>
        <p class="text-muted">Selamat datang kembali, {{ session('petugas_username') }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ App\Models\Post::count() }}</h3>
                    <p>Total Post</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ App\Models\Post::where('status', 'published')->count() }}</h3>
                    <p>Published</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ App\Models\Post::where('status', 'draft')->count() }}</h3>
                    <p>Draft</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-images"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ App\Models\Foto::count() }}</h3>
                    <p>Total Foto</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Content -->
    <div class="row g-4">
        <!-- Recent Posts -->
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="text-navy mb-0">Post Terbaru</h4>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-navy">
                        <i class="fas fa-plus me-2"></i>Tambah Post
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Post::latest()->take(5)->get() as $post)
                            <tr>
                                <td>{{ $post->judul }}</td>
                                <td>
                                    @php
                                        $kategoriNama = [
                                            1 => 'Informasi',
                                            2 => 'Agenda',
                                            3 => 'Galeri'
                                        ][$post->kategori_id] ?? 'Tidak ada kategori';
                                    @endphp
                                    <span class="status-badge">{{ $kategoriNama }}</span>
                                </td>
                                <td>
                                    <span class="status-badge {{ $post->status == 'published' ? 'published' : 'draft' }}">
                                        {{ $post->status }}
                                    </span>
                                </td>
                                <td>{{ $post->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Photos -->
        <div class="col-lg-4">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="text-navy mb-0">Foto Terbaru</h4>
                    <a href="{{ route('admin.foto.create') }}" class="btn btn-navy">
                        <i class="fas fa-upload me-2"></i>Upload
                    </a>
                </div>
                <div class="photo-grid">
                    @foreach(App\Models\Foto::latest()->take(6)->get() as $foto)
                    <div class="photo-item">
                        <img src="{{ Storage::url($foto->file) }}" 
                             alt="{{ $foto->judul }}"
                             data-lightbox="recent-photos">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .text-navy {
        color: var(--navy);
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        background: var(--navy);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .stat-info h3 {
        font-size: 1.5rem;
        margin: 0;
        color: var(--navy);
    }

    .stat-info p {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .content-card {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        height: 100%;
    }

    .btn-navy {
        background: var(--navy);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-navy:hover {
        background: var(--light-navy);
        color: white;
    }

    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        background: #e9ecef;
        color: #495057;
    }

    .status-badge.published {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.draft {
        background: #fff3cd;
        color: #856404;
    }

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .photo-item {
        aspect-ratio: 1;
        overflow: hidden;
        border-radius: 5px;
    }

    .photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .photo-item:hover img {
        transform: scale(1.1);
    }

    .table {
        font-size: 0.9rem;
    }

    .table th {
        font-weight: 600;
        color: var(--navy);
        border-bottom-width: 1px;
    }

    .table td {
        vertical-align: middle;
    }
</style>
@endpush
@endsection 