@extends('layouts.admin')

@section('title', 'Kelola Profile')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Daftar Profile</h4>
        <a href="{{ route('admin.profile.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Profile
        </a>
    </div>

    <x-alert />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profiles as $profile)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $profile->judul }}</td>
                            <td>{{ $profile->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.profile.edit', $profile->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.profile.destroy', $profile->id) }}" method="POST" 
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $profiles->links() }}
        </div>
    </div>
</div>
@endsection 