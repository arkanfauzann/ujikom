@extends('layouts.admin')

@section('title', 'Edit Foto')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Foto</h1>
        <a href="{{ route('admin.galeri.edit', $foto->galery_id) }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 me-2"></i>Kembali ke Galeri
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Judul Foto</label>
                            <input type="text" name="judul" 
                                   class="form-control @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul', $foto->judul) }}">
                            @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ganti Foto</label>
                            <input type="file" name="file" 
                                   class="form-control @error('file') is-invalid @enderror" 
                                   accept="image/*" onchange="previewImage(this)">
                            @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Preview</label>
                            <div class="current-image mb-2">
                                <img src="{{ Storage::url($foto->file) }}" 
                                     class="img-thumbnail" alt="Current Image">
                            </div>
                            <div id="preview-container" class="d-none">
                                <label class="form-label text-muted">Preview Foto Baru:</label>
                                <img id="preview" class="img-thumbnail">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Foto
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
                        <label class="text-muted">Galeri</label>
                        <p class="mb-0">{{ $foto->galery->post->judul }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted">Diupload pada</label>
                        <p class="mb-0">{{ $foto->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted">Terakhir diupdate</label>
                        <p class="mb-0">{{ $foto->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.current-image img,
#preview {
    max-height: 300px;
    width: 100%;
    object-fit: contain;
}
</style>
@endpush

@push('scripts')
<script>
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