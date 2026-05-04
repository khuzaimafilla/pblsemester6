

@extends('layouts.app')

@section('title', 'Landing Page')

@push('styles')
<style>
    /* ===== LANDING PAGE STYLES ===== */
    .hero-section {
        min-height: 100vh;
        background: linear-gradient(135deg, #daeef6 0%, #c5e8f3 20%, #d8f0f8 50%, #cde9f5 75%, #bde0ef 100%);
        display: flex;
        align-items: center;
        padding-top: 80px;
        position: relative;
        overflow: hidden;
    }

    /* Subtle animated background blobs */
    .hero-section::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(74,175,207,0.15) 0%, transparent 70%);
        animation: floatBlob 8s ease-in-out infinite;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -80px;
        right: 200px;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(100,195,220,0.12) 0%, transparent 70%);
        animation: floatBlob 10s ease-in-out infinite reverse;
    }

    @keyframes floatBlob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33%       { transform: translate(-20px, 20px) scale(1.05); }
        66%       { transform: translate(20px, -10px) scale(0.95); }
    }

    .hero-container {
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
        padding: 0 48px;
        position: relative;
        z-index: 1;
    }

    .hero-content {
        max-width: 680px;
    }

    /* Hero badge */
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(74,175,207,0.15);
        border: 1px solid rgba(74,175,207,0.3);
        border-radius: 100px;
        padding: 6px 16px;
        margin-bottom: 28px;
        opacity: 0;
        animation: fadeSlideUp 0.6s ease forwards 0.2s;
    }

    .hero-badge-dot {
        width: 8px;
        height: 8px;
        background: #3AAFCF;
        border-radius: 50%;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.6; transform: scale(1.2); }
    }

    .hero-badge span {
        font-size: 13px;
        font-weight: 600;
        color: #2A8FAF;
        letter-spacing: 0.3px;
    }

    /* Hero heading */
    .hero-heading {
        font-size: clamp(36px, 5vw, 58px);
        font-weight: 800;
        line-height: 1.12;
        color: #1E7A9B;
        margin-bottom: 22px;
        letter-spacing: -1px;
        opacity: 0;
        animation: fadeSlideUp 0.7s ease forwards 0.35s;
    }

    .hero-heading .highlight {
        color: #2A9ABF;
        position: relative;
    }

    /* Hero subtext */
    .hero-subtext {
        font-size: 17px;
        font-weight: 400;
        color: #5a7e8a;
        line-height: 1.7;
        margin-bottom: 40px;
        max-width: 560px;
        opacity: 0;
        animation: fadeSlideUp 0.7s ease forwards 0.5s;
    }

    .hero-subtext strong {
        font-weight: 700;
        color: #2A8FAF;
    }

    /* Hero CTA buttons */
    .hero-actions {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        opacity: 0;
        animation: fadeSlideUp 0.7s ease forwards 0.65s;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #3AAFCF;
        color: white;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 15px;
        font-weight: 700;
        padding: 15px 32px;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 4px 20px rgba(58,175,207,0.35);
        letter-spacing: 0.2px;
    }

    .btn-primary:hover {
        background: #2A9FBF;
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 30px rgba(58,175,207,0.45);
        color: white;
        text-decoration: none;
    }

    .btn-primary:active {
        transform: translateY(-1px) scale(1.01);
    }

    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: #3AAFCF;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 15px;
        font-weight: 700;
        padding: 14px 30px;
        border-radius: 50px;
        border: 2px solid rgba(58,175,207,0.6);
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        backdrop-filter: blur(8px);
        background: rgba(255,255,255,0.5);
        letter-spacing: 0.2px;
    }

    .btn-outline:hover {
        background: rgba(58,175,207,0.1);
        border-color: #3AAFCF;
        transform: translateY(-3px) scale(1.03);
        color: #1E7A9B;
        text-decoration: none;
        box-shadow: 0 6px 20px rgba(58,175,207,0.2);
    }

    /* Floating water drop decoration */
    .hero-decoration {
        position: absolute;
        right: 8%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        animation: fadeIn 1s ease forwards 1s;
    }

    .water-drop-large {
        width: 280px;
        height: 280px;
        filter: drop-shadow(0 20px 40px rgba(58,175,207,0.25));
        animation: floatDrop 6s ease-in-out infinite;
    }

    @keyframes floatDrop {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50%       { transform: translateY(-20px) rotate(2deg); }
    }

    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* ===== STATS SECTION (bonus) ===== */
    .stats-section {
        background: white;
        padding: 60px 48px;
        border-top: 1px solid rgba(58,175,207,0.1);
    }

    .stats-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        text-align: center;
    }

    .stat-item {
        padding: 24px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(74,175,207,0.05) 0%, rgba(74,175,207,0.02) 100%);
        border: 1px solid rgba(74,175,207,0.12);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(74,175,207,0.12);
    }

    .stat-number {
        font-size: 40px;
        font-weight: 800;
        color: #2A9FBF;
        line-height: 1;
        margin-bottom: 8px;
        letter-spacing: -1px;
    }

    .stat-label {
        font-size: 14px;
        font-weight: 500;
        color: #7a9eaa;
        line-height: 1.4;
    }

    /* ===== FEATURES SECTION ===== */
    .features-section {
        background: linear-gradient(180deg, #f5fbfd 0%, #edf7fa 100%);
        padding: 80px 48px;
    }

    .features-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-header {
        text-align: center;
        margin-bottom: 56px;
    }

    .section-tag {
        display: inline-block;
        background: rgba(58,175,207,0.12);
        color: #2A8FAF;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: 100px;
        margin-bottom: 16px;
    }

    .section-title {
        font-size: 34px;
        font-weight: 800;
        color: #1E6A84;
        letter-spacing: -0.5px;
        margin-bottom: 12px;
    }

    .section-desc {
        font-size: 16px;
        color: #6a8e9a;
        max-width: 480px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 32px 28px;
        border: 1px solid rgba(74,175,207,0.12);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #3AAFCF, #6ECFE8);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(74,175,207,0.15);
        border-color: rgba(74,175,207,0.25);
    }

    .feature-card:hover::before {
        opacity: 1;
    }

    .feature-icon {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, rgba(58,175,207,0.15) 0%, rgba(110,207,232,0.1) 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 24px;
    }

    .feature-title {
        font-size: 17px;
        font-weight: 700;
        color: #1E6A84;
        margin-bottom: 10px;
    }

    .feature-desc {
        font-size: 14px;
        color: #6a8e9a;
        line-height: 1.7;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-container { padding: 0 24px; }
        .hero-decoration { display: none; }
        .stats-section { padding: 40px 24px; }
        .stats-container { grid-template-columns: 1fr; gap: 20px; }
        .features-section { padding: 60px 24px; }
        .features-grid { grid-template-columns: 1fr; }
        .hero-actions { flex-direction: column; }
        .btn-primary, .btn-outline { width: 100%; justify-content: center; }
    }
</style>
@endpush

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="hero-section">

    {{-- Floating water drop SVG decoration --}}
    <div class="hero-decoration">
        <svg class="water-drop-large" viewBox="0 0 280 320" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Outer glow ring -->
            <ellipse cx="140" cy="300" rx="80" ry="12" fill="rgba(58,175,207,0.12)"/>
            <!-- Main drop -->
            <path d="M140 20 C140 20 60 110 60 185 C60 230 96 265 140 265 C184 265 220 230 220 185 C220 110 140 20 140 20Z" 
                  fill="url(#heroDropGrad)" opacity="0.85"/>
            <!-- Inner highlight -->
            <path d="M118 80 C110 100 96 130 96 165 C96 175 98 185 102 193" 
                  stroke="rgba(255,255,255,0.5)" stroke-width="6" stroke-linecap="round"/>
            <!-- Small bubble -->
            <circle cx="165" cy="160" r="12" fill="rgba(255,255,255,0.25)"/>
            <circle cx="155" cy="140" r="6" fill="rgba(255,255,255,0.2)"/>
            <defs>
                <linearGradient id="heroDropGrad" x1="140" y1="20" x2="140" y2="265" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stop-color="#8DE0F5"/>
                    <stop offset="50%" stop-color="#3AAFCF"/>
                    <stop offset="100%" stop-color="#1A8AAF"/>
                </linearGradient>
            </defs>
        </svg>
    </div>

    <div class="hero-container">
        <div class="hero-content">

            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                <span>Sistem Potabilitas Air — Random Forest AI</span>
            </div>

            <h1 class="hero-heading">
                Cek Kelayakan Air Mineral Anda Sebelum Konsumsi Dengan <span class="highlight">SIMPOA</span>
            </h1>

            <p class="hero-subtext">
                Integrasi Algoritma <strong>Random Forest</strong> Untuk Menentukan 
                Kelayakan Air Berdasarkan Kandungannya
            </p>

            <div class="hero-actions">
                <a href="{{ route('prosedur') }}" class="btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                    </svg>
                    Coba Sekarang
                </a>
                <a href="#wawasan" class="btn-outline">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    Wawasan Kandungan Air
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ===== STATS SECTION ===== --}}
<section class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <div class="stat-number">99.2%</div>
            <div class="stat-label">Akurasi Model<br>Random Forest</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">22+</div>
            <div class="stat-label">Parameter Kimia<br>yang Dianalisis</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">< 3s</div>
            <div class="stat-label">Waktu Analisis<br>Real-time</div>
        </div>
    </div>
</section>

{{-- ===== FEATURES / WAWASAN SECTION ===== --}}
<section class="features-section" id="wawasan">
    <div class="features-container">
        <div class="section-header">
            <div class="section-tag">Fitur Utama</div>
            <h2 class="section-title">Teknologi di Balik SIMPOA</h2>
            <p class="section-desc">
                Tiga pendekatan ilmiah yang menjamin hasil analisis kelayakan air yang akurat dan terpercaya.
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🤖</div>
                <div class="feature-title">Machine Learning Classification</div>
                <p class="feature-desc">
                    Menggunakan algoritma Random Forest/XGBoost untuk mengklasifikasikan air ke dalam kategori "Layak" atau "Tidak Layak" dengan akurasi tinggi.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📋</div>
                <div class="feature-title">Regulatory Matching</div>
                <p class="feature-desc">
                    Membandingkan data secara real-time terhadap standar internasional WHO dan regulasi nasional Permenkes No. 2 Tahun 2023.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <div class="feature-title">Probabilistic Score</div>
                <p class="feature-desc">
                    Memberikan nilai confidence score pada setiap prediksi sehingga pengguna dapat memahami tingkat keyakinan hasil analisis.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection



@push('scripts')

<script>
    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.stat-item, .feature-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });
</script>
@endpush

