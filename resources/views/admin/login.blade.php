@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="login-box">
        <div class="login-content">
            <!-- Logo -->
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo-sekolah.svg') }}" alt="Logo" class="login-logo">
                <h4 class="mt-3 mb-1">SMKN 4 Bogor</h4>
                <p class="text-muted">Admin Panel</p>
            </div>

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="form-group mb-4">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" 
                               class="form-control @error('username') is-invalid @enderror" 
                               name="username" 
                               placeholder="Username"
                               value="{{ old('username') }}"
                               autocomplete="off">
                    </div>
                    @error('username')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" 
                               placeholder="Password">
                    </div>
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-login w-100">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        --navy: #0A2647;
        --light-navy: #144272;
    }

    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--navy), var(--light-navy));
        padding: 20px;
    }

    .login-container {
        width: 100%;
        max-width: 400px;
    }

    .login-box {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .login-content {
        padding: 40px;
    }

    .login-logo {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }

    .form-group {
        position: relative;
    }

    .input-group {
        border: 1px solid #eee;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .input-group:focus-within {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(10, 38, 71, 0.1);
    }

    .input-group-text {
        background: transparent;
        border: none;
        color: #6c757d;
    }

    .form-control {
        border: none;
        padding: 12px 15px;
        background: transparent;
    }

    .form-control:focus {
        box-shadow: none;
        background: transparent;
    }

    .btn-login {
        background: var(--navy);
        color: white;
        padding: 12px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background: var(--light-navy);
        color: white;
        transform: translateY(-2px);
    }

    .alert {
        border: none;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .alert-danger {
        background: #ffe5e5;
        color: #d63031;
    }

    /* Animation */
    .login-box {
        animation: slideUp 0.5s ease forwards;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 576px) {
        .login-content {
            padding: 30px 20px;
        }
    }
</style>
@endpush
@endsection 