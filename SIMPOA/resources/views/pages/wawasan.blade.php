@extends('layouts.app')

@section('content')

<section style="
    min-height:80vh;
    padding:60px 0 60px;
">

    <div style="
        max-width:1200px;
        margin:0 auto;
        padding: 0 80px;
    ">

        <!-- HEADER -->
        <div style="margin-bottom:50px;">
            <h1 style="
                font-size:42px;
                font-weight:700;
                color:#5BABD0;
                margin-bottom:10px;
            ">
                Wawasan Kandungan Air
            </h1>

            <p style="
                color:#5BABD0;
                font-size:16px;
                max-width:500px;
            ">
                Memahami Parameter Kualitas Air Berdasarkan Standar WHO & Permenkes No. 2 Tahun 2023
            </p>
        </div>

        @php
        // Data untuk 9 kotak
        $analyses = [
            [
                'prediction'=>'AIR LAYAK KONSUMSI',
                'probability'=>'96.5%',
                'ph'=>7.2,
                'hardness'=>180,
                'solids'=>440,
                'param_name'=>'Derajat Keasaman (pH)',
                'param_desc'=>'Derajat keasaman air dengan rentang aman 6.5–8.5. pH tidak stabil memicu korosi pipa jika terlalu asam atau rasa pahit sabun jika terlalu basa.'
            ],
            [
                'prediction'=>'AIR LAYAK KONSUMSI',
                'probability'=>'92.3%',
                'ph'=>7.0,
                'hardness'=>175,
                'solids'=>430,
                'param_name'=>'Kesadahan (Hardness)',
                'param_desc'=>'Mengukur kadar mineral kalsium dan magnesium dalam air. Air dengan kesadahan tinggi dapat menyebabkan penumpukan kerak pada pipa dan peralatan dapur, serta membuat sabun sulit berbusa.'
            ],
            [
                'prediction'=>'AIR LAYAK KONSUMSI',
                'probability'=>'94.7%',
                'ph'=>7.4,
                'hardness'=>185,
                'solids'=>450,
                'param_name'=>'TDS (Total Dissolved Solids)',
                'param_desc'=>'Indikator jumlah total mineral, garam, dan logam yang terlarut. TDS yang terlalu tinggi dapat memengaruhi rasa air menjadi payau atau pahit dan menandakan adanya polutan terlarut.'
            ],
            [
                'prediction'=>'AIR LAYAK KONSUMSI',
                'probability'=>'89.2%',
                'ph'=>6.9,
                'hardness'=>190,
                'solids'=>460,
                'param_name'=>'Kloramin (Chloramines)',
                'param_desc'=>'Senyawa disinfektan hasil reaksi klorin dan amonia. Berfungsi membunuh bakteri selama distribusi air di pipa. Kadar yang berlebihan dapat menyebabkan aroma menyengat dan iritasi kulit ringan.'
            ],
            [
                'prediction'=>'AIR LAYAK KONSUMSI',
                'probability'=>'95.1%',
                'ph'=>7.3,
                'hardness'=>178,
                'solids'=>435,
                'param_name'=>'Sulfat (Sulfate)',
                'param_desc'=>'Senyawa alami yang berasal dari mineral tanah. Dalam kadar tinggi, sulfat dapat memberikan efek pencahar (diare) dan memberikan rasa "medis" atau pahit pada air minum.'
            ],
            [
                'prediction'=>'AIR LAYAK KONSUMSI',
                'probability'=>'91.8%',
                'ph'=>7.1,
                'hardness'=>182,
                'solids'=>445,
                'param_name'=>'Daya Hantar Listrik (Conductivity)',
                'param_desc'=>'Mengukur kemampuan air menghantarkan listrik berdasarkan jumlah ion terlarut. Semakin tinggi nilainya, semakin banyak kandungan mineral atau polutan logam dalam air tersebut.'
            ],
            [
                'prediction'=>'AIR LAYAK KONSUMSI',
                'probability'=>'93.4%',
                'ph'=>7.2,
                'hardness'=>177,
                'solids'=>438,
                'param_name'=>'Karbon Organik Total (TOC)',
                'param_desc'=>'Mengukur jumlah karbon dalam senyawa organik. TOC merupakan indikator kebersihan air dari zat organik (seperti sisa tanaman atau limbah) yang bisa menjadi sumber makanan bagi bakteri.'
            ],
            [
                'prediction'=>'AIR LAYAK KONSUMSI',
                'probability'=>'97.2%',
                'ph'=>7.5,
                'hardness'=>172,
                'solids'=>425,
                'param_name'=>'Trihalometana (THMs)',
                'param_desc'=>'Produk sampingan yang terbentuk saat klorin bereaksi dengan zat organik. Senyawa ini harus dipantau ketat karena bersifat karsinogenik (pemicu kanker) jika dikonsumsi jangka panjang.'
            ],
            [
                'prediction'=>'AIR LAYAK KONSUMSI',
                'probability'=>'90.5%',
                'ph'=>6.8,
                'hardness'=>195,
                'solids'=>470,
                'param_name'=>'Kekeruhan (Turbidity)',
                'param_desc'=>'Menunjukkan tingkat kejernihan air. Air yang keruh dapat melindungi bakteri dari proses disinfeksi sinar UV atau klorin, sehingga air harus tetap jernih untuk menjamin keamanan biologis.'
            ],
        ];
        @endphp

        <!-- GRID - 3 kolom per baris (9 kotak total) -->
        <div style="
            display:grid;
            grid-template-columns:1fr 1fr 1fr;
            gap:28px;
        ">

            @foreach($analyses as $item)

            <div style="
                display:flex;
                flex-direction:column;
                background:rgba(255,255,255,0.4);
                backdrop-filter: blur(10px);
                border-radius:18px;
                overflow:hidden;
                box-shadow:0 8px 25px rgba(0,0,0,0.05);
            ">

                <!-- TOP - GAMBAR Hasil Analisis (dari image.png) -->
                <div style="
                    width:100%;
                    background:rgba(255,255,255,0.6);
                ">
                    <img src="{{ asset('storage/image.png') }}" 
                         alt="Hasil Analisis" 
                         style="width:100%; height:auto; display:block;">
                </div>

                <!-- BOTTOM - Penjelasan Parameter -->
                <div style="padding:20px;">

                    <div style="
                        font-weight:700;
                        color:#3A929C;
                        margin-bottom:10px;
                        font-size:18px;
                    ">
                        {{ $item['param_name'] }}
                    </div>

                    <div style="
                        font-size:14px;
                        color:#5BABD0;
                        line-height:1.6;
                    ">
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