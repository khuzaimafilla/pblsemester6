@extends('layouts.app')

@section('content')

<style>
    /* --- TAMPILAN UNTUK DI WEB (GRID MODERN) --- */
    .grid-wawasan {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }
    .card-param {
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    .print-certificate-view {
        display: none; /* Sembunyikan format sertifikat saat berada di website */
    }

    /* --- TAMPILAN KHUSUS UNTUK CETAK PDF (Ctrl + P) --- */
    @media print {
        /* Pengaturan ukuran halaman kertas print browser */
        @page {
            size: A4 portrait;
            margin: 8mm 10mm 8mm 10mm; /* Memperketat margin kertas agar space naik */
        }

        /* Sembunyikan semua elemen default website termasuk footer bawaan layouts.app */
        nav, .navbar, header, #main-navbar, .navbar-container, .btn-print-section, .grid-wawasan-container, footer, .web-footer { 
            display: none !important; 
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0 !important;
            padding: 0 !important;
            color: #1E293B !important;
            background: rgb(1, 0, 0) !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        section {
            padding: 0 !important;
        }

        /* Tampilkan Kontainer Sertifikat Berbingkai */
        .print-certificate-view {
            display: block !important;
            border: 2px solid #D6E4F0 !important;
            padding: 15px 20px !important; /* Memperketat padding agar elemen naik */
            background: white !important;
            margin: 0 !important;
            border-radius: 4px;
        }

        /* Header / Kop Dokumen */
        .cert-header {
            width: 100%;
            margin-bottom: 10px;
        }
        .cert-logo {
            width: 70px;
            float: left;
            margin-right: 15px;
            margin-top: 2px;
        }
        .cert-header-text {
            float: left;
        }
        .cert-title {
            font-size: 18px !important;
            font-weight: bold;
            color: #3A929C !important;
            margin: 0 0 2px 0 !important;
        }
        .cert-subtitle {
            font-size: 9.5px !important;
            color: #64748B !important;
            margin: 0 0 3px 0 !important;
            letter-spacing: 0.3px;
        }
        .cert-number {
            font-size: 9.5px !important;
            color: #1E293B !important;
        }
        .clear-fix {
            clear: both;
        }

        /* Tabel Hasil Parameter */
        .cert-table-title {
            margin-top: 12px;
            font-size: 11.5px !important;
            font-weight: bold;
            color: #1E293B;
            border-bottom: 2px solid #3A929C;
            padding-bottom: 3px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .cert-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cert-table th {
            background: #5BABD0 !important;
            color: white !important;
            padding: 5px 8px !important;
            font-size: 10.5px !important;
            text-transform: uppercase;
        }
        .cert-table td {
            padding: 5px 8px !important; /* Diperketat agar muat dalam 1 halaman */
            border-bottom: 1px solid #E2E8F0 !important;
            font-size: 9.5px !important;
            line-height: 1.35;
            vertical-align: middle;
        }
        .cert-table tr {
            page-break-inside: avoid !important;
        }

        /* Badge Batas Aman */
        .badge-batas {
            background-color: #E8F4F8 !important;
            color: #2C7A87 !important;
            padding: 2px 5px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            font-size: 9px !important;
            border: 1px solid #D6E4F0;
            white-space: nowrap;
        }
        .param-name-bold {
            font-weight: bold;
            color: #1E293B;
        }

        /* Footer Dokumen Dalam Bingkai */
        .cert-footer {
            margin-top: 12px;
            font-size: 8.5px !important;
            text-align: center;
            color: #64748B !important;
            border-top: 1px dashed #CBD5E1;
            padding-top: 6px;
        }

        /* Paksa teks copyright buatan sendiri masuk ke bawah teks deskripsi sertifikat */
        .cert-copyright {
            display: block !important;
            text-align: center;
            font-size: 9px !important;
            color: #94A3B8;
            margin-top: 4px;
            font-weight: 500;
        }
    }

    /* Sembunyikan copyright print di versi web screen */
    .cert-copyright {
        display: none;
    }
</style>

<section style="min-height:80vh; padding:60px 0 60px;">

    <div class="grid-wawasan-container" style="max-width:1200px; margin:0 auto; padding: 0 80px;">
        
        <div class="grid-wawasan-header" style="margin-bottom:40px;">
            <h1 style="font-size:42px; font-weight:700; color:#5BABD0; margin-bottom:10px;">Wawasan Kandungan Air</h1>
            <p style="color:#5BABD0; font-size:16px; max-width:600px;">
                Memahami Parameter Kualitas Air Berdasarkan Standar WHO & Permenkes No. 2 Tahun 2023
            </p>
        </div>

        @php
        $analyses = [
            ['param_name'=>'Derajat Keasaman (pH)', 'param_desc'=>'Indikator tingkat asam atau basa dalam air. pH yang tidak stabil dapat memicu korosi pada instalasi pipa logam jika terlalu asam, atau meninggalkan rasa pahit seperti sabun serta kerak putih jika air terlalu basa.', 'header_image'=>'assets/ph.jpeg', 'batas_aman'=>'6.5 - 8.5', 'satuan'=>'pH'],
            ['param_name'=>'Kesadahan (Hardness)', 'param_desc'=>'Mengukur kadar mineral kalsium dan magnesium dalam air. Air dengan kesadahan tinggi dapat menyebabkan penumpukan kerak pada pipa dan peralatan dapur, serta membuat sabun sulit berbusa.', 'header_image'=>'assets/hardness.jpeg', 'batas_aman'=>'< 500', 'satuan'=>'mg/L'],
            ['param_name'=>'TDS (Total Dissolved Solids)', 'param_desc'=>'Indikator jumlah total mineral, garam, dan logam yang terlarut. TDS yang terlalu tinggi dapat memengaruhi rasa air menjadi payau atau pahit.', 'header_image'=>'assets/TDS.jpeg', 'batas_aman'=>'< 1000', 'satuan'=>'mg/L'],
            ['param_name'=>'Kloramin (Chloramines)', 'param_desc'=>'Senyawa disinfektan hasil reaksi klorin dan amonia. Berfungsi membunuh bakteri selama distribusi air di pipa.', 'header_image'=>'assets/kloramin.jpeg', 'batas_aman'=>'< 4', 'satuan'=>'mg/L'],
            ['param_name'=>'Sulfat (Sulfate)', 'param_desc'=>'Senyawa alami yang berasal dari mineral tanah. Dalam kadar tinggi, sulfat dapat memberikan efek pencahar (diare).', 'header_image'=>'assets/sulfat.jpg', 'batas_aman'=>'< 250', 'satuan'=>'mg/L'],
            ['param_name'=>'Daya Hantar Listrik (Conductivity)', 'param_desc'=>'Mengukur kemampuan air menghantarkan listrik berdasarkan jumlah ion terlarut.', 'header_image'=>'assets/conductivity.jpg', 'batas_aman'=>'< 1000', 'satuan'=>'µS/cm'],
            ['param_name'=>'Karbon Organik Total (TOC)', 'param_desc'=>'Mengukur jumlah karbon dalam senyawa organik yang bisa menjadi sumber makanan bagi bakteri.', 'header_image'=>'assets/toc.jpg', 'batas_aman'=>'< 10', 'satuan'=>'mg/L'],
            ['param_name'=>'Trihalometana (THMs)', 'param_desc'=>'Produk sampingan saat klorin bereaksi dengan zat organik. Bersifat karsinogenik jika dikonsumsi jangka panjang.', 'header_image'=>'assets/thms.jpg', 'batas_aman'=>'< 0.1', 'satuan'=>'mg/L'],
            ['param_name'=>'Kekeruhan (Turbidity)', 'param_desc'=>'Menunjukkan tingkat kejernihan air. Air keruh dapat melindungi bakteri dari proses disinfeksi.', 'header_image'=>'assets/turbidity.jpg', 'batas_aman'=>'< 5', 'satuan'=>'NTU']
        ];
        @endphp

        <div class="grid-wawasan">
            @foreach($analyses as $item)
            <div class="card-param">
                <img src="{{ asset($item['header_image']) }}" style="width:100%; height:140px; object-fit:cover; display:block;">
                <div style="padding:20px; flex-grow:1; display:flex; flex-direction:column;">
                    <div style="font-size:15px; font-weight:700; color:#2C7A87; margin-bottom:12px; text-align:center;">{{ $item['param_name'] }}</div>
                    <div style="background:#E8F4F8; border-radius:12px; padding:12px; margin-bottom:15px; text-align:center;">
                        <div style="font-size:10px; color:#5BABD0; letter-spacing:1px; font-weight:600;">BATAS AMAN</div>
                        <div style="font-size:26px; font-weight:700; color:#3A929C; margin:3px 0;">{{ $item['batas_aman'] }}</div>
                        <div style="font-size:11px; color:#5BABD0;">{{ $item['satuan'] }}</div>
                    </div>
                    <div style="font-size:12px; color:#5BABD0; line-height:1.6; text-align:justify;">{{ $item['param_desc'] }}</div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="btn-print-section" style="text-align:center; margin-top:50px;">
            <button onclick="window.print()" style="background:#5BABD0; color:white; padding:14px 40px; border:none; border-radius:15px; font-weight:600; cursor:pointer; transition: 0.2s;" onmouseover="this.style.background='#3A929C'" onmouseout="this.style.background='#5BABD0'">
                Cetak PDF Resmi
            </button>
        </div>
    </div>

    <!-- TAMPILAN PRINT SERTIFIKAT -->
    <div class="print-certificate-view">
        
        <div class="cert-header">
            <img src="{{ asset('images/logo-simpoa.png') }}" class="cert-logo" alt="Logo">
            <div class="cert-header-text">
                <div class="cert-title">SERTIFIKAT WAWASAN PARAMETER AIR</div>
                <div class="cert-subtitle">SMART INTELLIGENT MONITORING POTABILITY OF WATER</div>
                <div class="cert-number">No: {{ date('dmY') }}/SIMPOA/WWS/{{ rand(100,999) }}</div>
            </div>
        </div>

        <div class="clear-fix"></div>

        <div class="cert-table-title">STANDAR ACUAN MUTU PARAMETER AIR</div>

        <table class="cert-table">
            <thead>
                <tr>
                    <th style="width: 25%;">Parameter</th>
                    <th style="width: 18%;">Batas Aman</th>
                    <th style="width: 57%;">Keterangan & Dampak Parameter</th>
                </tr>
            </thead>
            <tbody>
                @foreach($analyses as $item)
                <tr>
                    <td>
                        <div class="param-name-bold">{{ $item['param_name'] }}</div>
                    </td>
                    <td>
                        <div class="badge-batas">
                            {{ $item['batas_aman'] }} {{ $item['satuan'] }}
                        </div>
                    </td>
                    <td style="text-align: justify;">
                        {{ $item['param_desc'] }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer Sertifikat Dalam Bingkai -->
        <div class="cert-footer">
            Dokumen panduan parameter ini dihasilkan otomatis oleh sistem SIMPOA untuk referensi batas aman kualitas air konsumsi.
            <!-- Menyisipkan teks copyright di dalam bingkai halaman pertama -->
            <div class="cert-copyright">
                SIMPOA - Copyright 2025/2026
            </div>
        </div>

    </div>

</section>

@endsection