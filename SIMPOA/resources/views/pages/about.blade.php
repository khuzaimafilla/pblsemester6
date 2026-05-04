@extends('layouts.app')

@section('title', 'Tentang SIMPOA')

@push('styles')
<style>
    /* ===== TENTANG PAGE ===== */
    .tentang-section {
        min-height: 100vh;
        background: linear-gradient(180deg, #f0f9fd 0%, #e8f5fb 40%, #d8eef6 100%);
        padding-top: 100px;
        padding-bottom: 60px;
    }

    .tentang-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 48px;
    }

    /* ===== PAGE TITLE ===== */
    .page-title {
        font-size: clamp(32px, 4vw, 48px);
        font-weight: 800;
        color: #2A9FBF;
        letter-spacing: -1px;
        margin-bottom: 28px;
        opacity: 0;
        animation: slideUp 0.6s ease forwards 0.1s;
    }

    .page-title span {
        color: #1a6a84;
    }

    /* ===== INTRO PARAGRAPH ===== */
    .intro-block {
        font-size: 16px;
        line-height: 1.85;
        color: #4a6a78;
        text-align: justify;
        margin-bottom: 40px;
        opacity: 0;
        animation: slideUp 0.6s ease forwards 0.2s;
    }

    .intro-block strong {
        font-weight: 700;
        color: #2A9FBF;
    }

    /* ===== SECTION HEADING ===== */
    .content-section {
        margin-bottom: 36px;
        opacity: 0;
        animation: slideUp 0.6s ease forwards;
    }

    .content-section:nth-child(3) { animation-delay: 0.3s; }
    .content-section:nth-child(4) { animation-delay: 0.4s; }
    .content-section:nth-child(5) { animation-delay: 0.5s; }
    .content-section:nth-child(6) { animation-delay: 0.6s; }

    .section-heading {
        font-size: 22px;
        font-weight: 700;
        color: #1E6A84;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(58,175,207,0.2);
        letter-spacing: -0.2px;
    }

    .section-text {
        font-size: 15.5px;
        line-height: 1.85;
        color: #4a6a78;
        margin-bottom: 16px;
    }

    .section-text strong {
        font-weight: 700;
        color: #2A9FBF;
    }

    /* ===== METHOD LIST ===== */
    .method-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .method-item {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        background: white;
        border-radius: 14px;
        padding: 20px 24px;
        border: 1px solid rgba(74,175,207,0.15);
        border-left: 4px solid #3AAFCF;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(74,175,207,0.06);
    }

    .method-item:hover {
        transform: translateX(4px);
        box-shadow: 0 6px 20px rgba(74,175,207,0.12);
        border-left-color: #2A9FBF;
    }

    .method-bullet {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #3AAFCF;
        margin-top: 6px;
        flex-shrink: 0;
    }

    .method-content {
        flex: 1;
        font-size: 15px;
        line-height: 1.75;
        color: #4a6a78;
    }

    .method-content strong {
        font-weight: 700;
        color: #1E6A84;
        display: block;
        margin-bottom: 4px;
    }

    /* ===== TUJUAN CARD ===== */
    .tujuan-card {
        background: linear-gradient(135deg, rgba(58,175,207,0.08) 0%, rgba(110,207,232,0.05) 100%);
        border: 1px solid rgba(58,175,207,0.2);
        border-radius: 16px;
        padding: 28px 32px;
        font-size: 16px;
        line-height: 1.8;
        color: #4a6a78;
        text-align: justify;
        position: relative;
        overflow: hidden;
    }

    .tujuan-card::before {
        content: '"';
        position: absolute;
        top: -10px;
        left: 20px;
        font-size: 100px;
        color: rgba(58,175,207,0.1);
        font-family: Georgia, serif;
        line-height: 1;
        pointer-events: none;
    }

    /* ===== DISCLAIMER ===== */
    .disclaimer {
        background: rgba(255,255,255,0.6);
        border: 1px solid rgba(74,175,207,0.12);
        border-radius: 12px;
        padding: 24px 28px;
        margin-top: 40px;
        opacity: 0;
        animation: slideUp 0.6s ease forwards 0.65s;
    }

    .disclaimer p {
        font-size: 13.5px;
        font-style: italic;
        color: #7a9aaa;
        line-height: 1.8;
        text-align: justify;
        margin: 0;
    }

    .disclaimer-icon {
        font-size: 18px;
        margin-bottom: 8px;
        display: block;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .tentang-container { padding: 0 24px; }
        .method-item { padding: 16px 18px; }
        .tujuan-card { padding: 22px 20px; }
    }
</style>
@endpush

@section('content')

<section class="tentang-section">
    <div class="tentang-container">

        {{-- Page Title --}}
        <h1 class="page-title">
            Tentang <span>SIMPOA</span>
        </h1>

        {{-- Intro --}}
        <p class="intro-block">
            <strong>SIMPOA</strong> (Sistem Potabilitas Air) adalah platform cerdas berbasis Machine Learning untuk 
            membantu masyarakat dan instansi dalam menganalisis kualitas air secara cepat dan akurat. Sistem ini 
            mengombinasikan data hasil laboratorium dengan kecerdasan artifisial guna memberikan klasifikasi 
            kelayakan air konsumsi yang objektif dan terstandarisasi.
        </p>

        {{-- Bagaimana Sistem Bekerja --}}
        <div class="content-section">
            <h2 class="section-heading">Bagaimana Sistem Bekerja?</h2>
            <p class="section-text">
                <strong>SIMPOA</strong> mengintegrasikan tiga metode utama dalam proses analisisnya:
            </p>

            <ul class="method-list">
                <li class="method-item">
                    <div class="method-bullet"></div>
                    <div class="method-content">
                        <strong>Machine Learning Classification:</strong>
                        Sistem menggunakan algoritma AI (seperti Random Forest/XGBoost) untuk mengklasifikasikan 
                        data ke dalam kategori "Layak" atau "Tidak Layak". Model ini telah dilatih menggunakan 
                        ribuan dataset kualitas air global untuk memastikan akurasi prediksi.
                    </div>
                </li>
                <li class="method-item">
                    <div class="method-bullet"></div>
                    <div class="method-content">
                        <strong>Regulatory Matching:</strong>
                        Melakukan komparasi data secara real-time terhadap ambang batas baku mutu air minum 
                        berdasarkan standar internasional (WHO) dan regulasi nasional terbaru (Permenkes No. 2 
                        Tahun 2023).
                    </div>
                </li>
                <li class="method-item">
                    <div class="method-bullet"></div>
                    <div class="method-content">
                        <strong>Probabilistic Score:</strong>
                        Memberikan nilai tingkat keyakinan (confidence score) pada setiap hasil prediksi. Hal 
                        ini membantu pengguna memahami seberapa kuat basis keputusan AI dalam menentukan 
                        potabilitas sampel air yang diuji.
                    </div>
                </li>
            </ul>
        </div>

        {{-- Tujuan Kami --}}
        <div class="content-section">
            <h2 class="section-heading">Tujuan Kami</h2>
            <div class="tujuan-card">
                Menyediakan solusi digital yang transparan dan saintifik untuk mengidentifikasi risiko 
                kesehatan pada air konsumsi, sehingga setiap individu dapat memastikan akses air yang aman 
                demi kualitas hidup yang lebih baik.
            </div>
        </div>

        {{-- Disclaimer --}}
        <div class="disclaimer">
            <span class="disclaimer-icon">⚠️</span>
            <p>
                *Sistem SIMPOA menggunakan model prediksi digital yang dilatih pada data historis dan mungkin 
                tidak 100% sempurna dalam merepresentasikan kondisi kimia air yang sangat kompleks secara 
                dinamis. Hasil analisis yang ditampilkan berfungsi sebagai pendukung keputusan 
                (Decision Support) dan deteksi dini. Keputusan akhir serta tindakan lebih lanjut mengenai 
                konsumsi air tetap disarankan untuk dikoordinasikan dengan pihak laboratorium kesehatan resmi 
                atau instansi terkait.
            </p>
        </div>

    </div>
</section>

@endsection