@extends('layouts.admin')

@section('title', 'Kelola Post')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Post</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 me-2"></i>Tambah Post
        </a>
    </div>

    <!-- Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="1" {{ request('kategori') == '1' ? 'selected' : '' }}>Informasi</option>
                        <option value="2" {{ request('kategori') == '2' ? 'selected' : '' }}>Agenda</option>
                        <option value="3" {{ request('kategori') == '3' ? 'selected' : '' }}>Galeri</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari judul..." 
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
    <x-alert />

    <!-- Posts Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Status</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-bold">{{ $post->judul }}</div>
                                <small class="text-muted">{{ Str::limit(strip_tags($post->isi), 50) }}</small>
                            </td>
                            <td>
                                @php
                                    $kategoriNama = [
                                        1 => 'Informasi',
                                        2 => 'Agenda',
                                        3 => 'Galeri'
                                    ][$post->kategori_id] ?? 'Tidak ada kategori';

                                    $kategoriClass = [
                                        1 => 'info',
                                        2 => 'warning',
                                        3 => 'success'
                                    ][$post->kategori_id] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $kategoriClass }}">
                                    {{ $kategoriNama }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $post->status == 'published' ? 'success' : 'warning' }}">
                                    {{ $post->status }}
                                </span>
                            </td>
                            <td>
                                @if($post->petugas)
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <div class="avatar-title rounded-circle bg-primary">
                                                {{ strtoupper(substr($post->petugas->username, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>{{ $post->petugas->username }}</div>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div>{{ $post->created_at->format('d M Y') }}</div>
                                <small class="text-muted">{{ $post->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus post ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <img src="{{ asset('images/no-data.svg') }}" alt="No Data" style="max-width: 200px">
                                <p class="mt-3">Belum ada post</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-end">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.avatar {
    width: 32px;
    height: 32px;
}

.avatar-title {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
}

.btn-group {
    gap: 0.25rem;
}
</style>
@endpush
@endsection 