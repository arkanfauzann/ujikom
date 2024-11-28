@extends('layouts.admin')

@section('title', 'Buat Galeri Baru')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Galeri Baru</h1>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.galeri.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Post Galeri</label>
                            <select name="post_id" class="form-select @error('post_id') is-invalid @enderror">
                                <option value="">Pilih Post</option>
                                @foreach($posts as $post)
                                <option value="{{ $post->id }}" {{ old('post_id') == $post->id ? 'selected' : '' }}>
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
                                   value="{{ old('position', 0) }}">
                            @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Galeri
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
                    <div class="alert alert-info mb-0">
                        <h6 class="alert-heading">Catatan</h6>
                        <hr>
                        <ul class="mb-0 ps-3">
                            <li>Pilih post dengan kategori galeri</li>
                            <li>Posisi menentukan urutan tampilan</li>
                            <li>Status menentukan apakah galeri ditampilkan</li>
                            <li>Setelah membuat galeri, Anda dapat mengunggah foto</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 