@extends('layouts.app')

@section('content')

<section style="min-height:80vh; padding:60px 0 60px;">

    <div style="max-width:1200px; margin:0 auto; padding: 0 80px;">

        <!-- HEADER -->
        <div style="margin-bottom:50px;">
            <h1 style="font-size:42px; font-weight:700; color:#5BABD0; margin-bottom:10px;">
                Wawasan Kandungan Air
            </h1>
            <p style="color:#5BABD0; font-size:16px; max-width:500px;">
                Memahami Parameter Kualitas Air Berdasarkan Standar WHO & Permenkes No. 2 Tahun 2023
            </p>
        </div>

        @php
        $analyses = [
            [
                'param_name'=>'Derajat Keasaman (pH)',
                'param_desc'=>'Indikator tingkat asam atau basa dalam air. pH yang tidak stabil dapat memicu korosi pada instalasi pipa logam jika terlalu asam, atau meninggalkan rasa pahit seperti sabun serta kerak putih jika air terlalu basa.',
                'header_image'=>'assets/ph.jpeg',  // Ganti dengan file gambar header Anda
                'batas_aman'=>'6.5 - 8.5',
                'satuan'=>'pH',
                'keterangan'=>'Dalam rentang aman'
            ],
            [
                'param_name'=>'Kesadahan (Hardness)',
                'param_desc'=>'Mengukur kadar mineral kalsium dan magnesium dalam air. Air dengan kesadahan tinggi dapat menyebabkan penumpukan kerak pada pipa dan peralatan dapur, serta membuat sabun sulit berbusa.',
                'header_image'=>'assets/hardness.jpeg',  // Ganti dengan file gambar header Anda
                'batas_aman'=>'< 500',
                'satuan'=>'mg/L',
                'keterangan'=>'Kesadahan sedang'
            ],
            [
                'param_name'=>'TDS (Total Dissolved Solids)',
                'param_desc'=>'Indikator jumlah total mineral, garam, dan logam yang terlarut. TDS yang terlalu tinggi dapat memengaruhi rasa air menjadi payau atau pahit.',
                'header_image'=>'assets/TDS.jpeg',  // Ganti dengan file gambar header Anda
                'batas_aman'=>'< 1000',
                'satuan'=>'mg/L',
                'keterangan'=>'Dalam batas normal'
            ],
            [
                'param_name'=>'Kloramin (Chloramines)',
                'param_desc'=>'Senyawa disinfektan hasil reaksi klorin dan amonia. Berfungsi membunuh bakteri selama distribusi air di pipa.',
                'header_image'=>'assets/kloramin.jpeg',  // Ganti dengan file gambar header Anda
                'batas_aman'=>'< 4',
                'satuan'=>'mg/L',
                'keterangan'=>'Kadar aman'
            ],
            [
                'param_name'=>'Sulfat (Sulfate)',
                'param_desc'=>'Senyawa alami yang berasal dari mineral tanah. Dalam kadar tinggi, sulfat dapat memberikan efek pencahar (diare).',
                'header_image'=>'assets/sulfat.jpg',  // Ganti dengan file gambar header Anda
                'batas_aman'=>'< 250',
                'satuan'=>'mg/L',
                'keterangan'=>'Kadar normal'
            ],
            [
                'param_name'=>'Daya Hantar Listrik (Conductivity)',
                'param_desc'=>'Mengukur kemampuan air menghantarkan listrik berdasarkan jumlah ion terlarut.',
                'header_image'=>'assets/conductivity.jpg',  // Ganti dengan file gambar header Anda
                'batas_aman'=>'< 1000',
                'satuan'=>'µS/cm',
                'keterangan'=>'Konduktivitas normal'
            ],
            [
                'param_name'=>'Karbon Organik Total (TOC)',
                'param_desc'=>'Mengukur jumlah karbon dalam senyawa organik yang bisa menjadi sumber makanan bagi bakteri.',
                'header_image'=>'assets/toc.jpg',  // Ganti dengan file gambar header Anda
                'batas_aman'=>'< 10',
                'satuan'=>'mg/L',
                'keterangan'=>'Bersih'
            ],
            [
                'param_name'=>'Trihalometana (THMs)',
                'param_desc'=>'Produk sampingan saat klorin bereaksi dengan zat organik. Bersifat karsinogenik jika dikonsumsi jangka panjang.',
                'header_image'=>'assets/thms.jpg',  // Ganti dengan file gambar header Anda
                'batas_aman'=>'< 0.1',
                'satuan'=>'mg/L',
                'keterangan'=>'Dibawah ambang batas'
            ],
            [
                'param_name'=>'Kekeruhan (Turbidity)',
                'param_desc'=>'Menunjukkan tingkat kejernihan air. Air keruh dapat melindungi bakteri dari proses disinfeksi.',
                'header_image'=>'assets/turbidity.jpg',  // Ganti dengan file gambar header Anda
                'batas_aman'=>'< 5',
                'satuan'=>'NTU',
                'keterangan'=>'Jernih'
            ],
        ];
        @endphp

        <!-- GRID 3 kolom -->
        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:28px;">

            @foreach($analyses as $item)
            <div style="
                display:flex;
                flex-direction:column;
                background:white;
                border-radius:18px;
                overflow:hidden;
                box-shadow:0 8px 25px rgba(0,0,0,0.08);
                transition: transform 0.2s ease;
            "
            onmouseover="this.style.transform='translateY(-5px)';"
            onmouseout="this.style.transform='translateY(0)';">

                <!-- HEADER SEBAGAI GAMBAR -->
                <img src="{{ asset($item['header_image']) }}" 
                     alt="Header {{ $item['param_name'] }}" 
                     style="width:100%; height:auto; display:block;">

                <!-- Body (Batas Aman + Deskripsi) -->
                <div style="padding:20px;">

                    <!-- Batas Aman -->
                    <div style="
                        background:#E8F4F8;
                        border-radius:12px;
                        padding:15px;
                        margin-bottom:15px;
                        text-align:center;
                    ">
                        <div style="font-size:11px; color:#5BABD0; letter-spacing:1px;">BATAS AMAN</div>
                        <div style="font-size:32px; font-weight:700; color:#3A929C; margin:5px 0;">
                            {{ $item['batas_aman'] }}
                        </div>
                        <div style="font-size:12px; color:#5BABD0;">
                            {{ $item['satuan'] }}
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div style="font-size:13px; color:#5BABD0; line-height:1.5;">
                        {{ $item['param_desc'] }}
                    </div>
                </div>

            </div>
            @endforeach

        </div>

        <!-- BUTTON -->
        <div style="text-align:center; margin-top:50px;">
            <button onclick="window.print()" style="
                background:#5BABD0;
                color:white;
                padding:14px 40px;
                border:none;
                border-radius:15px;
                font-weight:600;
                cursor:pointer;
                transition:0.2s;
            "
            onmouseover="this.style.background='#3A929C'"
            onmouseout="this.style.background='#5BABD0'">
                Cetak PDF
            </button>
        </div>

    </div>

</section>

@endsection