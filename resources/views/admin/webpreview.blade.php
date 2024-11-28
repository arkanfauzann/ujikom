@extends('layouts.admin')

@section('title', 'Web Preview')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Web Preview</h1>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary active" id="desktopView">
                <i class="fas fa-desktop me-2"></i>Desktop
            </button>
            <button type="button" class="btn btn-primary" id="mobileView">
                <i class="fas fa-mobile-alt me-2"></i>Mobile
            </button>
        </div>
    </div>

    <!-- Preview Container -->
    <div class="card shadow">
        <div class="card-body p-0">
            <div class="preview-container desktop" id="previewFrame">
                <div class="preview-header">
                    <div class="preview-actions">
                        <span class="preview-action red"></span>
                        <span class="preview-action yellow"></span>
                        <span class="preview-action green"></span>
                    </div>
                    <div class="preview-url">
                        <i class="fas fa-lock me-2"></i>{{ config('app.url') }}
                    </div>
                    <div class="preview-refresh">
                        <button class="btn btn-sm btn-light" onclick="refreshPreview()">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="preview-content">
                    <iframe src="{{ url('/') }}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.preview-container {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.preview-container.desktop {
    width: 100%;
    height: calc(100vh - 250px);
}

.preview-container.mobile {
    width: 375px;
    height: 812px;
    margin: 20px auto;
    box-shadow: 0 0 50px rgba(0,0,0,0.1);
}

.preview-header {
    background: #f1f3f4;
    padding: 10px 15px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #ddd;
}

.preview-actions {
    display: flex;
    gap: 6px;
    margin-right: 15px;
}

.preview-action {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.preview-action.red { background: #ff5f57; }
.preview-action.yellow { background: #ffbd2e; }
.preview-action.green { background: #28c940; }

.preview-url {
    flex-grow: 1;
    background: #fff;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 13px;
    color: #666;
}

.preview-refresh {
    margin-left: 15px;
}

.preview-content {
    height: calc(100% - 45px);
}

.preview-content iframe {
    width: 100%;
    height: 100%;
}

/* Device Frames */
.preview-container.mobile::before {
    content: '';
    position: absolute;
    top: -20px;
    left: -20px;
    right: -20px;
    bottom: -20px;
    border: 20px solid #333;
    border-radius: 40px;
    pointer-events: none;
}

.preview-container.mobile::after {
    content: '';
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 150px;
    height: 20px;
    background: #1a1a1a;
    border-radius: 0 0 20px 20px;
}

/* Button Styles */
.btn-group .btn {
    position: relative;
    transition: all 0.3s ease;
}

.btn-group .btn:hover {
    transform: translateY(-2px);
}

.btn-group .btn.active {
    background-color: #2e59d9;
    border-color: #2653d4;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('previewFrame');
    const desktopBtn = document.getElementById('desktopView');
    const mobileBtn = document.getElementById('mobileView');

    desktopBtn.addEventListener('click', function() {
        container.className = 'preview-container desktop';
        desktopBtn.classList.add('active');
        mobileBtn.classList.remove('active');
    });

    mobileBtn.addEventListener('click', function() {
        container.className = 'preview-container mobile';
        mobileBtn.classList.add('active');
        desktopBtn.classList.remove('active');
    });
});

function refreshPreview() {
    const iframe = document.querySelector('.preview-content iframe');
    iframe.src = iframe.src;
}
</script>
@endpush
@endsection 