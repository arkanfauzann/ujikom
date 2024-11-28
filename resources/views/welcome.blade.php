<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMKN 4 Bogor</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --navy: #0A2647;
            --light-navy: #144272;
            --lighter-navy: #205295;
            --lightest-navy: #2C74B3;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            line-height: 1.6;
            background: #fff;
        }

        /* Navbar Styles */
        .navbar {
            background: var(--navy);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(10, 38, 71, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 600;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        /* Hero Section - dimodifikasi */
        .hero-section {
            background: linear-gradient(135deg, var(--navy), var(--light-navy));
            color: white;
            min-height: 100vh; /* Mengubah tinggi menjadi minimal 100vh */
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 200px 0 160px; /* Menambah padding atas dan bawah */
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30%; /* Mengurangi tinggi gradient */
            background: linear-gradient(to top, rgba(255,255,255,1), rgba(255,255,255,0));
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 4rem; /* Memperbesar ukuran font judul */
            font-weight: 700;
            margin-bottom: 2rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.5rem; /* Memperbesar ukuran font subtitle */
            margin-bottom: 3rem;
            opacity: 0.9;
        }

        .hero-button {
            padding: 1rem 3rem;
            font-size: 1.1rem;
            border: 2px solid white;
            transition: all 0.3s ease;
        }

        .hero-button:hover {
            background: white;
            color: var(--navy);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .hero-subtitle {
                font-size: 1.25rem;
            }
        }

        .section {
            padding: 100px 0;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--navy);
        }

        .program-card {
            background: #fff;
            border: 1px solid #eee;
            padding: 2rem;
            height: 100%;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .program-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--navy);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.4s ease;
            z-index: 0;
        }

        .program-card:hover::before {
            transform: scaleX(1);
            transform-origin: left;
        }

        .program-card:hover {
            transform: translateY(-10px);
        }

        .program-card:hover * {
            color: white;
            position: relative;
            z-index: 1;
        }

        .program-icon {
            width: 70px;
            height: 70px;
            background: var(--navy);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: all 0.4s ease;
        }

        .program-card:hover .program-icon {
            background: white;
        }

        .program-card:hover .program-icon i {
            color: var(--navy);
        }

        .program-icon i {
            color: white;
            font-size: 28px;
        }

        .news-card {
            border: 1px solid #eee;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .news-card:hover {
            border-color: var(--navy);
            transform: translateX(10px);
        }

        .gallery-item {
            aspect-ratio: 1/1;
            overflow: hidden;
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 38, 71, 0.2);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover::after {
            opacity: 1;
        }

        .btn-navy {
            background: var(--navy);
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 0;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-navy::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--light-navy);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
            z-index: -1;
        }

        .btn-navy:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Footer style */
        footer {
            background: var(--navy);
            color: white;
            padding: 50px 0 20px;
        }
    </style>
</head>

<body>
    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="hero-section" style="background: navy,no-repeat center center; background-size: cover;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1 class="hero-title animate__animated animate__fadeInDown">SMKN 4 Bogor</h1>
                        <p class="hero-subtitle animate__animated animate__fadeIn" style="animation-delay: 0.5s">
                            Siap Kerja, Mandiri, dan Kreatif
                        </p>
                        <a href="{{ url('/program-keahlian') }}" 
                           class="btn hero-button btn-outline-light animate__animated animate__fadeInUp"
                           style="animation-delay: 1s">
                            Lihat Program Keahlian
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sambutan -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <img src="{{ asset('images/kepala-sekolah.jpg') }}" class="img-fluid" alt="Kepala Sekolah">
                </div>
                <div class="col-lg-7">
                    <div class="section-subtitle">Sambutan Kepala Sekolah</div>
                    <h2 class="mb-4">Selamat Datang di SMKN 4 Bogor</h2>
                    <p class="mb-4">SMKN 4 Bogor berkomitmen untuk menghasilkan lulusan yang kompeten, berkarakter, dan siap bersaing di dunia kerja maupun wirausaha.</p>
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Drs. Mulya Murprihartono, M.Si.</h5>
                            <small class="text-muted">Kepala SMKN 4 Bogor</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Keahlian -->
    <section class="section bg-light-custom">
        <div class="container">
            <h2 class="section-title">Program Keahlian</h2>
            <div class="row">
                <!-- PPLG -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="program-card">
                        <div class="program-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h4 class="program-title">Pengembangan Perangkat Lunak dan Gim</h4>
                        <p class="mb-4">Mempelajari pemrograman, pengembangan aplikasi dan game</p>
                        <a href="{{ url('/program-keahlian') }}" class="btn btn-outline-navy btn-sm">Selengkapnya</a>
                    </div>
                </div>

                <!-- TJKT -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="program-card">
                        <div class="program-icon">
                            <i class="fas fa-network-wired"></i>
                        </div>
                        <h4 class="program-title">Teknik Jaringan Komputer dan Telekomunikasi</h4>
                        <p class="mb-4">Fokus pada jaringan komputer dan sistem telekomunikasi</p>
                        <a href="{{ url('/program-keahlian') }}" class="btn btn-outline-navy btn-sm">Selengkapnya</a>
                    </div>
                </div>

                <!-- Teknik Pengelasan -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="program-card">
                        <div class="program-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h4 class="program-title">Teknik Pengelasan</h4>
                        <p class="mb-4">Program keahlian yang fokus pada teknologi pengelasan modern</p>
                        <a href="{{ url('/program-keahlian') }}" class="btn btn-outline-navy btn-sm">Selengkapnya</a>
                    </div>
                </div>

                <!-- Teknik Otomotif -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="program-card">
                        <div class="program-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h4 class="program-title">Teknik Otomotif</h4>
                        <p class="mb-4">Mempelajari teknologi kendaraan dan sistem otomotif modern</p>
                        <a href="{{ url('/program-keahlian') }}" class="btn btn-outline-navy btn-sm">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Agenda & Informasi -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- Agenda -->
                <div class="col-lg-6 mb-4">
                    <h3 class="mb-4">Agenda Sekolah</h3>
                    @php
                    $agendas = App\Models\Post::where('kategori_id', 2)
                        ->where('status', 'published')
                        ->with(['galery.fotos' => function($query) {
                            $query->latest()->take(1);
                        }])
                        ->latest()
                        ->take(3)
                        ->get();
                    @endphp

                    @forelse($agendas as $agenda)
                    <div class="news-card">
                        <h5 class="mb-3">{{ $agenda->judul }}</h5>
                        <p class="text-muted mb-2">{{ Str::limit(strip_tags($agenda->isi), 100) }}</p>
                        <small class="text-navy">{{ $agenda->created_at->format('d M Y') }}</small>
                    </div>
                    @empty
                    <div class="news-card">
                        <p class="text-muted mb-0">Belum ada agenda yang ditampilkan</p>
                    </div>
                    @endforelse
                </div>

                <!-- Informasi -->
                <div class="col-lg-6 mb-4">
                    <h3 class="mb-4">Informasi Terkini</h3>
                    @php
                    $informasi = App\Models\Post::where('kategori_id', 1)
                        ->where('status', 'published')
                        ->with(['galery.fotos' => function($query) {
                            $query->latest()->take(1);
                        }])
                        ->latest()
                        ->take(3)
                        ->get();
                    @endphp

                    @forelse($informasi as $info)
                    <div class="news-card">
                        <h5 class="mb-3">{{ $info->judul }}</h5>
                        <p class="text-muted mb-2">{{ Str::limit(strip_tags($info->isi), 100) }}</p>
                        <small class="text-navy">{{ $info->created_at->format('d M Y') }}</small>
                    </div>
                    @empty
                    <div class="news-card">
                        <p class="text-muted mb-0">Belum ada informasi yang ditampilkan</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri -->
    <section class="section bg-light-custom">
        <div class="container">
            <h2 class="section-title">Galeri Kegiatan</h2>
            <div class="row g-4">
                @php
                $latestPhotos = [];
                $posts = App\Models\Post::where('kategori_id', 3)
                    ->where('status', 'published')
                    ->with(['galery.fotos' => function($query) {
                        $query->latest();
                    }])
                    ->latest()
                    ->take(2)
                    ->get();

                foreach($posts as $post) {
                    if($post->galery && $post->galery->fotos) {
                        foreach($post->galery->fotos->take(3) as $foto) {
                            $latestPhotos[] = [
                                'judul' => $foto->judul,
                                'file' => $foto->file,
                                'galeri' => $post->judul
                            ];
                        }
                    }
                }
                @endphp

                @forelse($latestPhotos as $foto)
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="{{ Storage::url($foto['file']) }}" alt="{{ $foto['judul'] }}">
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada foto yang ditampilkan</p>
                </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('galeri') }}" class="btn btn-navy">Lihat Semua Foto</a>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Scroll animation
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.section-title, .program-card, .news-card, .gallery-item').forEach((el) => {
            el.classList.add('animate-on-scroll');
            observer.observe(el);
        });

        // Add entrance animations to hero content
        document.addEventListener('DOMContentLoaded', function() {
            const heroTitle = document.querySelector('.hero-section h1');
            const heroText = document.querySelector('.hero-section p');
            const heroButton = document.querySelector('.hero-section .btn');

            heroTitle.classList.add('animate__animated', 'animate__fadeInDown');
            heroText.classList.add('animate__animated', 'animate__fadeIn');
            heroText.style.animationDelay = '0.5s';
            heroButton.classList.add('animate__animated', 'animate__fadeInUp');
            heroButton.style.animationDelay = '1s';
        });
    </script>
</body>
</html>