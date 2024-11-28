@extends('layouts.main')

@section('title', 'Profil')

@section('content')
<!-- Hero Header -->
<section class="hero-header" style="background: navy, no-repeat center center; background-size: cover;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 text-center">
                <h1 class="hero-title animate__animated animate__fadeInDown">Profil SMKN 4 Bogor</h1>
                <p class="hero-subtitle animate__animated animate__fadeIn" style="animation-delay: 0.5s">
                    Siap Kerja, Mandiri, dan Kreatif
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Sejarah -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/gedung-sekolah.jpg') }}" alt="SMKN 4 Bogor" class="img-fluid rounded">
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">Tentang SMKN 4 Bogor</h2>
                <p class="text-muted">
                    Merupakan sekolah kejuruan berbasis Teknologi Informasi dan Komunikasi. Sekolah ini didirikan dan dirintis pada tahun 2008 kemudian dibuka pada tahun 2009 yang saat ini terakreditasi A. Terletak di Jalan Raya Tajur Kp. Buntar, Muarasari, Bogor, sekolah ini berdiri di atas lahan seluas 12.724 m2 dengan berbagai fasilitas pendukung di dalamnya.
                </p>
                <p class="text-muted">
                    Terdapat 54 staff pengajar dan 22 orang staff tata usaha, dikepalai oleh Drs. Mulya Mulprihartono, M. Si, sekolah ini merupakan investasi pendidikan yang tepat untuk putra/putri anda.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi -->
<section class="section bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="content-card">
                    <h2>Visi</h2>
                    <p class="vision-text">
                        "Terwujudnya SMK Pusat Keunggulan melalui terciptanya pelajar pancasila yang berbasis teknologi, berwawasan lingkungan dan berkewirausahaan."
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="content-card">
                    <h2>Misi</h2>
                    <ul class="mission-list">
                        <li>Mewujudkan karakter pelajar pancasila beriman dan bertaqwa kepada Tuhan Yang Maha Esa dan berakhlak mulia, berkebhinekaan global, gotong royong, mandiri, kreatif dan bernalar kritis.</li>
                        <li>Mengembangkan pembelajaran dan pengelolaan sekolah berbasis Teknologi Informasi dan Komunikasi.</li>
                        <li>Mengembangkan sekolah yang berwawasan Adiwiyata Mandiri.</li>
                        <li>Mengembangkan usaha dalam berbagai bidang secara optimal sehingga memiliki kemandirian dan daya saing tinggi.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kepala Sekolah -->
<section class="section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="{{ asset('images/kepala-sekolah.jpg') }}" alt="Kepala Sekolah" class="img-fluid rounded">
            </div>
            <div class="col-lg-8">
                <h2 class="section-title">Kepala Sekolah</h2>
                <h4 class="mb-3">Drs. Mulya Murprihartono, M.Si.</h4>
                <p class="text-muted mb-4">Kepala Sekolah Ke-3, Juli 2020 - sekarang</p>
                <p>
                    Sejak satu tahun lalu SMKN 4 Kota Bogor dipimpin oleh seseorang yang membawa warna baru, tahun pertama sejak dilantik, tepatnya pada tanggal 10 Juli 2020, inovasi dan kebijakan-kebijakan baru pun mulai dirancang. Bukan tanpa kesulitan, penuh tantangan tapi beliau meyakinkan untuk selalu optimis pada harapan dengan bersinergi mewujudkan visi misi SMKN 4 Bogor ditengah kesulitan pandemi ini.
                </p>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .hero-header {
        background: linear-gradient(135deg, var(--navy), var(--light-navy));
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        color: white;
        padding-top: 76px; /* Menyesuaikan dengan tinggi navbar */
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        letter-spacing: -1px;
    }

    .hero-subtitle {
        font-size: 1.5rem;
        opacity: 0.9;
        font-weight: 300;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
        }
    }

    .vision-box {
        border-left: 5px solid #4e73df;
    }

    .mission-list {
        list-style: none;
        padding: 0;
    }

    .mission-list li {
        padding: 10px 0 10px 30px;
        position: relative;
    }

    .mission-list li:before {
        content: '\f00c';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 12px;
        color: #4e73df;
    }

    .facility-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .facility-card:hover {
        transform: translateY(-10px);
    }

    .facility-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, #4e73df, #224abe);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 32px;
    }

    .facility-card h4 {
        margin-bottom: 15px;
        color: #2c3e50;
    }

    .facility-card p {
        color: #6c757d;
        margin: 0;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    @media (max-width: 768px) {
        .facility-card {
            margin-bottom: 30px;
        }
    }
</style>
@endpush
@endsection 