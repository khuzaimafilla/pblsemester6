@extends('layouts.app')

@section('content')

<style>
    body{
        background: linear-gradient(180deg, #f8fcff 0%, #dff2fb 100%);
    }

    .prosedur-wrapper{
        max-width: 1200px;
        margin: 0 auto;
        padding:60px  60px;
    }

    .prosedur-hero{
        margin-bottom: 30px;
    }

    .prosedur-hero h1{
        font-size: 2.4rem;
        font-weight: 800;
        color: #58A8CD;
        line-height: 1.1;
        margin-bottom: 10px;
    }

    .prosedur-hero h1 span{
        color: #3A949C;
    }

    .prosedur-hero p{
        color: #5BABD0;
        font-size: 0.95rem;
        max-width: 470px;
        line-height: 1.5;
    }

    .step-card{
        background: #fff;
        border-radius: 15px;
        padding: 26px;
        margin-bottom: 30px;
        box-shadow: 0 2px 16px rgba(88, 168, 205, 0.08);
        position: relative;
    }

    .step-number{
        font-size: 0.95rem;
        font-weight: 700;
        color: #4a6c8f;
        margin-bottom: 10px;
    }

    .divider-line{
        position: absolute;
        top: 34px;
        left: 48px;
        right: 26px;
        height: 1px;
        background: #d8eaf4;
    }

    .step-grid{
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 24px;
        align-items: center;
        margin-top: 8px;
    }

    .step-grid img{
        width: 100%;
        border-radius: 15px;
        display: block;
    }

    .step-title{
        font-size: 1.05rem;
        font-weight: 700;
        color: #5BABD0;
        margin-bottom: 12px;
    }

    .step-desc{
        font-size: 0.88rem;
        color: #5BABD0;
        line-height: 1.85;
        text-align: justify;
    }

    @media(max-width:900px){
        .step-grid{
            grid-template-columns:1fr;
        }

        .prosedur-wrapper{
            padding-top: 85px;
        }
    }
</style>

<div class="prosedur-wrapper">

    <section class="prosedur-hero">
        <h1>Prosedur Penggunaan<br><span>SIMPOA</span></h1>
        <p>Ikuti panduan singkat ini agar AI kami bisa memberi tahu kelayakan air Anda yang paling akurat untuk dikonsumsi.</p>
    </section>

    {{-- STEP 1 --}}
    <div class="step-card">
        <div class="step-number">1</div>
        <div class="divider-line"></div>

        <div class="step-grid">
            <div>
                <img src="{{ asset('assets/input-variabel excel.png') }}" alt="Step 1">
            </div>

            <div>
                <div class="step-title">1. Input Parameter (Manual atau Unggah Excel)</div>
                <p class="step-desc">
                    Langkah pertama dimulai dengan memasukkan data hasil pengujian sampel air. Pilih metode input 
                    yang paling nyaman untuk Anda: isi langsung pada form digital atau gunakan fitur Upload Datasheet Excel 
                    agar semua data terisi secara instan dalam sekali klik. Data yang dimasukkan mencakup 
                    9 parameter utama (pH, Kesadahan, TDS, Kloramin, Sulfat, Conductivity, TOC, Trihalometana, dan Turbidity) 
                    sesuai hasil uji laboratorium atau sensor. Ketelitian data pada tahap ini sangat menentukan akurasi prediksi akhir sistem.
                </p>
            </div>
        </div>
    </div>

    {{-- STEP 2 --}}
    <div class="step-card">
        <div class="step-number">2</div>
        <div class="divider-line"></div>

        <div class="step-grid">
            <div>
                <img src="{{ asset('assets/proses analisis.png') }}" alt="Step 2">
            </div>

            <div>
                <div class="step-title">2. Proses Analisis Cerdas (AI Analysis)</div>
                <p class="step-desc">
                    Setelah data terisi lengkap, cukup klik tombol "Mulai Analisis". Di balik layar,
                    sistem akan mengolah data Anda secara real-time menggunakan algoritma Machine Learning.
                    Proses ini melibatkan komparasi data secara mendalam terhadap standar baku mutu global
                    dari WHO serta regulasi nasional Permenkes No. 2 Tahun 2023 untuk mendeteksi adanya
                    indikasi kontaminasi atau ketidaklayakan.
                </p>
            </div>
        </div>
    </div>

    {{-- STEP 3 --}}
    <div class="step-card">
        <div class="step-number">3</div>
        <div class="divider-line"></div>

        <div class="step-grid">
            <div>
                <img src="{{ asset('assets/hasil analisa.png') }}" alt="Step 3">
            </div>

            <div>
                <div class="step-title">3. Peninjauan Hasil & Dokumentasi</div>
                <p class="step-desc">
                    Halaman terakhir akan menyajikan Dashboard Hasil yang informatif. Anda dapat melihat
                    status kelayakan air secara visual melalui indikator warna dan persentase keyakinan
                    sistem. Untuk keperluan administrasi atau tindak lanjut laboratorium, sistem menyediakan
                    fitur Download Laporan PDF yang merangkum seluruh detail analisis secara rapi
                    dan profesional.
                </p>
            </div>
        </div>
    </div>

</div>

@endsection