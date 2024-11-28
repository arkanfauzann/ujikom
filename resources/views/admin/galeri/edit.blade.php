@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Galeri</h1>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <!-- Form Edit -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Post Galeri</label>
                            <select name="post_id" class="form-select @error('post_id') is-invalid @enderror">
                                <option value="">Pilih Post</option>
                                @foreach($posts as $post)
                                <option value="{{ $post->id }}" {{ old('post_id', $galeri->post_id) == $post->id ? 'selected' : '' }}>
                                    {{ $post->judul }}
                                </option>
                                @endforeach
                            </select>
                            @error('post_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Posisi</label>
                            <input type="number" name="position" 
                                   class="form-control @error('position') is-invalid @enderror" 
                                   value="{{ old('position', $galeri->position) }}">
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', $galeri->status) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status', $galeri->status) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Galeri
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Foto Preview -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Foto dalam Galeri</h6>
                    <a href="{{ route('admin.foto.create', ['galery_id' => $galeri->id]) }}" 
                       class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i>Tambah Foto
                    </a>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        @foreach($galeri->fotos as $foto)
                        <div class="col-6">
                            <div class="position-relative">
                                <img src="{{ Storage::url($foto->file) }}" 
                                     class="img-fluid rounded" 
                                     alt="{{ $foto->judul }}">
                                <div class="position-absolute top-0 end-0 m-2">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.foto.edit', $foto->id) }}" 
                                           class="btn btn-sm btn-warning">
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
                            <small class="d-block text-center mt-1">{{ $foto->judul }}</small>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.position-relative img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}
</style>
@endpush
@endsection 