<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - SMKN 4 Bogor</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        
        <style>
            :root {
                --navy: #0A2647;
                --light-navy: #144272;
            }
            
            body {
                font-family: 'Inter', sans-serif;
                color: #333;
                line-height: 1.6;
                background: #fff;
            }
            
            .page-header {
                background: linear-gradient(135deg, var(--navy), var(--light-navy));
                padding: 120px 0 80px;
                margin-bottom: 0;
                color: white;
            }
            
            .section {
                padding: 80px 0;
            }
            
            .bg-navy {
                background: var(--navy);
            }
            
            .text-navy {
                color: var(--navy);
            }
            
            .btn-navy {
                background: var(--navy);
                color: white;
                padding: 0.8rem 2rem;
                border: none;
                transition: all 0.3s ease;
            }
            
            .btn-navy:hover {
                background: var(--light-navy);
                color: white;
                transform: translateY(-2px);
            }
        </style>
        
        @stack('styles')
    </head>
    <body class="{{ Request::is('/') ? 'home-page' : 'other-page' }}">
        @include('partials.navbar')
        
        <main>
            @yield('content')
        </main>
        
        @include('partials.footer')
        
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
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
        </script>
        
        @stack('scripts')
    </body>
</html> 