@extends('layouts.admin')

@section('title', 'Edit Informasi')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Informasi</h1>
        <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Judul Informasi</label>
                            <input type="text" name="judul" 
                                   class="form-control @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul', $informasi->judul) }}">
                            @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="gambar" 
                                   class="form-control @error('gambar') is-invalid @enderror" 
                                   accept="image/*" onchange="previewImage(this)">
                            @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <div class="mt-2">
                                <div class="current-image">
                                    @if($informasi->galery && $informasi->galery->fotos->isNotEmpty())
                                        <img src="{{ Storage::url($informasi->galery->fotos->first()->file) }}" 
                                             class="img-thumbnail" alt="Current Image">
                                    @endif
                                </div>
                                <div id="preview-container" class="mt-2 d-none">
                                    <label class="form-label">Preview Gambar Baru:</label>
                                    <img id="preview" class="img-thumbnail">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi Informasi</label>
                            <textarea name="isi" id="editor" 
                                      class="form-control @error('isi') is-invalid @enderror">{{ old('isi', $informasi->isi) }}</textarea>
                            @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="draft" {{ old('status', $informasi->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $informasi->status) == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Informasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted">Dibuat pada</label>
                        <p class="mb-0">{{ $informasi->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted">Terakhir diupdate</label>
                        <p class="mb-0">{{ $informasi->updated_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted">Penulis</label>
                        <p class="mb-0">{{ $informasi->petugas->username ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style>
.current-image img,
#preview {
    max-height: 200px;
    width: 100%;
    object-fit: contain;
}
</style>
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

function previewImage(input) {
    const container = document.getElementById('preview-container');
    const preview = document.getElementById('preview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.classList.remove('d-none');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection 