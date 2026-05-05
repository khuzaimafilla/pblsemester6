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
        $analyses = [
            [
                'prediction'=>'AIR LAYAK KONSUMSI',
                'probability'=>'96.5%',
                'ph'=>7.2,
                'hardness'=>180,
                'solids'=>440,
                'param_name'=>'Keasaman (pH)',
                'param_desc'=>'Derajat keasaman air dengan rentang aman 6.5–8.5. pH tidak stabil memicu korosi pipa jika terlalu asam atau rasa pahit sabun jika terlalu basa.'
            ],
        ];
        @endphp

        <!-- GRID -->
        <div style="
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:28px;
        ">

            @for ($i=0; $i<6; $i++)
            @foreach($analyses as $item)

            <div style="
                display:flex;
                background:rgba(255,255,255,0.4);
                backdrop-filter: blur(10px);
                border-radius:18px;
                overflow:hidden;
                box-shadow:0 8px 25px rgba(0,0,0,0.05);
            ">

                <!-- LEFT -->
                <div style="
                    width:50%;
                    padding:16px;
                    background:rgba(255,255,255,0.6);
                ">

                    <div style="
                        background:#5BABD0;
                        color:white;
                        text-align:center;
                        padding:6px;
                        font-size:12px;
                        border-radius:6px;
                        margin-bottom:10px;
                    ">
                        Hasil Analisis
                    </div>

                    <div style="
                        background:#3A929C;
                        color:white;
                        padding:12px;
                        border-radius:10px;
                        text-align:center;
                        font-weight:600;
                        margin-bottom:10px;
                    ">
                        {{ $item['prediction'] }}
                        <div style="font-size:12px; opacity:0.8;">
                            Probabilitas {{ $item['probability'] }}
                        </div>
                    </div>

                    <table style="width:100%; font-size:12px; color:#5BABD0;">
                        <tr><td>pH</td><td>{{ $item['ph'] }}</td></tr>
                        <tr><td>Hardness</td><td>{{ $item['hardness'] }}</td></tr>
                        <tr><td>TDS</td><td>{{ $item['solids'] }}</td></tr>
                    </table>

                </div>

                <!-- RIGHT -->
                <div style="padding:20px; flex:1;">

                    <div style="
                        font-weight:700;
                        color:#3A929C;
                        margin-bottom:10px;
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
            @endfor

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