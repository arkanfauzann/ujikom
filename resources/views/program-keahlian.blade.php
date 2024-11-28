@extends('layouts.main')

@section('title', 'Program Keahlian')

@section('content')
<!-- Header -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold text-white mb-4" data-aos="fade-up">Program Keahlian</h1>
                <p class="lead text-white mb-0" data-aos="fade-up" data-aos-delay="100">SMKN 4 Bogor</p>
            </div>
        </div>
    </div>
</div>

<!-- Programs -->
<section class="py-5">
    <div class="container">
        <!-- PPLG -->
        <div class="program-card mb-5" data-aos="fade-up">
            <div class="row align-items-center g-4">
                <div class="col-lg-5">
                    <div class="program-image">
                        <img src="{{ asset('images/program/pplg.png') }}" alt="PPLG">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="program-content">
                        <h2 class="program-title">Pengembangan Perangkat Lunak dan Gim</h2>
                        <p class="lead mb-4">Program keahlian yang mempelajari dan mendalami cara-cara mengembangkan perangkat lunak.</p>
                        
                        <div class="features mb-4">
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Web Development</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Mobile Development</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Game Development</span>
                            </div>
                        </div>

                        <div class="career-paths">
                            <h5 class="mb-3">Prospek Karir:</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="career-item">
                                        <h6>Web Developer</h6>
                                        <p>Full-stack, Front-end, Back-end Developer</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="career-item">
                                        <h6>Mobile Developer</h6>
                                        <p>Android, iOS, Cross-platform Developer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TJKT -->
        <div class="program-card mb-5" data-aos="fade-up">
            <div class="row align-items-center g-4 flex-lg-row-reverse">
                <div class="col-lg-5">
                    <div class="program-image">
                        <img src="{{ asset('images/program/tjkt.png') }}" alt="TJKT">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="program-content">
                        <h2 class="program-title">Teknik Jaringan Komputer dan Telekomunikasi</h2>
                        <p class="lead mb-4">Program keahlian yang mempelajari tentang jaringan komputer dan sistem telekomunikasi.</p>
                        
                        <div class="features mb-4">
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Network Administration</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Server Management</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Network Security</span>
                            </div>
                        </div>

                        <div class="career-paths">
                            <h5 class="mb-3">Prospek Karir:</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="career-item">
                                        <h6>Network Engineer</h6>
                                        <p>Network Design & Implementation</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="career-item">
                                        <h6>System Administrator</h6>
                                        <p>Server & Infrastructure Management</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teknik Pengelasan -->
<div class="program-card mb-5" data-aos="fade-up">
    <div class="row align-items-center g-4 flex-lg-row-reverse">
        <div class="col-lg-5">
            <div class="program-image">
                <img src="{{ asset('images/program/tp.jpeg') }}" alt="Teknik Pengelasan">
            </div>
        </div>
        <div class="col-lg-7">
            <div class="program-content">
                <h2 class="program-title">Teknik Pengelasan</h2>
                <p class="lead mb-4">Program keahlian yang mempelajari teknologi pengelasan modern untuk industri manufaktur dan konstruksi.</p>
                
                <div class="features mb-4">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>SMAW (Shield Metal Arc Welding)</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>GMAW (Gas Metal Arc Welding)</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>GTAW (Gas Tungsten Arc Welding)</span>
                    </div>
                </div>

                <div class="career-paths">
                    <h5 class="mb-3">Prospek Karir:</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="career-item">
                                <h6>Welder</h6>
                                <p>Juru Las Profesional</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="career-item">
                                <h6>Fabricator</h6>
                                <p>Spesialis Fabrikasi & Konstruksi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Teknik Otomotif -->
        <div class="program-card" data-aos="fade-up">
            <div class="row align-items-center g-4">
                <div class="col-lg-5">
                    <div class="program-image">
                        <img src="{{ asset('images/program/to.png') }}" alt="Teknik Otomotif">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="program-content">
                        <h2 class="program-title">Teknik Otomotif</h2>
                        <p class="lead mb-4">Program keahlian yang mempelajari teknologi kendaraan dan sistem otomotif modern.</p>
                        
                        <div class="features mb-4">
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Engine Management System</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Electrical & Electronic System</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Chassis & Power Train</span>
                            </div>
                        </div>

                        <div class="career-paths">
                            <h5 class="mb-3">Prospek Karir:</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="career-item">
                                        <h6>Automotive Technician</h6>
                                        <p>Teknisi Bengkel & Workshop</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="career-item">
                                        <h6>Service Advisor</h6>
                                        <p>Konsultan Servis Kendaraan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
.page-header {
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset("images/header-bg.jpg") }}');
    background-size: cover;
    background-position: center;
    padding: 150px 0 100px;
}

.program-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.program-card:hover {
    transform: translateY(-5px);
}

.program-image {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.program-image img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.program-card:hover .program-image img {
    transform: scale(1.1);
}

.program-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 2rem;
}

.feature-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding-left: 1.5rem;
    position: relative;
}

.feature-item i {
    position: absolute;
    left: 0;
    color: #4e73df;
}

.career-item {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    height: 100%;
    transition: all 0.3s ease;
}

.career-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.career-item h6 {
    color: #2c3e50;
    margin-bottom: 5px;
    font-weight: 600;
}

.career-item p {
    color: #6c757d;
    margin-bottom: 0;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .program-card {
        padding: 20px;
    }
    
    .program-image img {
        height: 200px;
    }
    
    .program-title {
        font-size: 1.5rem;
    }
}
</style>
@endpush
@endsection 