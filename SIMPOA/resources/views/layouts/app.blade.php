<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPOA - @yield('title', 'Sistem Potabilitas Air')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/simpoa.css') }}">
    @stack('styles')
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            {{-- Logo --}}
            <a href="{{ route('beranda') }}" class="navbar-brand">
                <div class="logo-icon">
                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="22" cy="22" r="21" stroke="#4AAFCF" stroke-width="1.5" fill="rgba(74,175,207,0.08)"/>
                        <path d="M22 8 C22 8 12 18 12 25 C12 30.5 16.5 35 22 35 C27.5 35 32 30.5 32 25 C32 18 22 8 22 8Z" 
                              fill="url(#dropGrad)" opacity="0.9"/>
                        <text x="22" y="29" text-anchor="middle" font-family="Plus Jakarta Sans" font-weight="800" 
                              font-size="10" fill="white" letter-spacing="0.5">SP</text>
                        <defs>
                            <linearGradient id="dropGrad" x1="22" y1="8" x2="22" y2="35" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#6ECFE8"/>
                                <stop offset="100%" stop-color="#2A8FAF"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <span class="brand-name">SIMPOA</span>
            </a>

            {{-- Nav Links --}}
            <ul class="navbar-nav" id="navbarNav">
                <li class="nav-item">
                    <a href="{{ route('beranda') }}" 
                       class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('prosedur') }}" 
                       class="nav-link {{ request()->routeIs('prosedur') ? 'active' : '' }}">
                        Prosedur
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tentang') }}" 
                       class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">
                        Tentang
                    </a>
                </li>
            </ul>

            {{-- Hamburger (Mobile) --}}
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="footer">
        <div class="footer-container">
            <p class="footer-text">
                <em>SIMPOA - Copyright 2025/2026</em>
            </p>
        </div>
    </footer>

    <script>
        // ---- Navbar scroll effect ----
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // ---- Hamburger mobile toggle ----
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navbarNav');
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            navMenu.classList.toggle('open');
        });

        // ---- Close menu on link click (mobile) ----
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('open');
                navMenu.classList.remove('open');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>