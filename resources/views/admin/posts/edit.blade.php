@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Post</h1>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <!-- Form Edit -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Post</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul" 
                                   class="form-control @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul', $post->judul) }}">
                            @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori['id'] }}" 
                                    {{ old('kategori_id', $post->kategori_id) == $kategori['id'] ? 'selected' : '' }}>
                                    {{ $kategori['nama'] }}
                                </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi Post</label>
                            <textarea name="isi" id="editor" 
                                      class="form-control @error('isi') is-invalid @enderror" 
                                      rows="10">{{ old('isi', $post->isi) }}</textarea>
                            @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input type="radio" name="status" value="published" 
                                           class="form-check-input @error('status') is-invalid @enderror"
                                           {{ old('status', $post->status) == 'published' ? 'checked' : '' }}>
                                    <label class="form-check-label">Published</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="status" value="draft" 
                                           class="form-check-input @error('status') is-invalid @enderror"
                                           {{ old('status', $post->status) == 'draft' ? 'checked' : '' }}>
                                    <label class="form-check-label">Draft</label>
                                </div>
                            </div>
                            @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Panel -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Post</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted">Dibuat pada</label>
                        <p class="mb-0">{{ $post->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted">Terakhir diupdate</label>
                        <p class="mb-0">{{ $post->updated_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted">Penulis</label>
                        <p class="mb-0">{{ $post->petugas->username ?? '-' }}</p>
                    </div>
                    @if($post->kategori_id == 3 && $post->galery)
                    <div class="alert alert-info mb-0">
                        <h6 class="alert-heading">Galeri Foto</h6>
                        <p class="mb-0">Post ini memiliki {{ $post->galery->fotos->count() }} foto</p>
                        <hr>
                        <a href="{{ route('admin.foto.create', ['galery_id' => $post->galery->id]) }}" 
                           class="btn btn-sm btn-primary">
                            Kelola Foto
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$(document).ready(function() {
    $('#editor').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});
</script>
@endpush
@endsection 