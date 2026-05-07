@extends('layouts.app')

@section('content')

<section style="min-height:100vh; padding:60px 0; text-align:center;">

    <div style="max-width:1000px; margin:auto; padding:0 80px;">

        <h2 style="color:#5BABD0;">Hasil Analisis</h2>

        @php
            $result = session('result');
            $prob = session('probability');
            $data = session('data');
            $isLayak = $result === 'LAYAK';
        @endphp

        <!-- RESULT BOX -->
        <div style="
            background: {{ $isLayak ? 'linear-gradient(90deg,#3A929C,#5BABD0)' : 'linear-gradient(90deg,#DC2626,#B91C1C)' }};
            color:white;
            padding:30px;
            border-radius:25px;
            margin:30px 0;
        ">
            <h1>AIR {{ $isLayak ? 'LAYAK' : 'TIDAK LAYAK' }} KONSUMSI</h1>

            <div style="
                background:white;
                color:#5BABD0;
                padding:6px 20px;
                border-radius:20px;
                display:inline-block;
            ">
                Probabilitas {{ $prob }}%
            </div>
        </div>

        <!-- DESC -->
        <p style="color:#5BABD0; max-width:700px; margin:0 auto 40px;">
            *Berdasarkan analisis algoritma <b>Random Forest</b>, parameter air yang Anda masukkan 
            {{ $isLayak ? 'memenuhi standar baku mutu kesehatan dan aman digunakan dengan perebusan.' : 'tidak memenuhi standar dan tidak disarankan untuk dikonsumsi.' }}
        </p>

        <!-- TABLE TITLE -->
        <h3 style="color:#5BABD0; margin-bottom:15px;">
            Tabel Hasil (The Proof)
        </h3>

        <!-- TABLE -->
        <div style="
            background:rgba(255,255,255,0.5);
            backdrop-filter:blur(10px);
            border-radius:20px;
            padding:20px;
        ">

            <table style="
                width:100%;
                border-collapse:collapse;
                color:#5BABD0;
                font-size:14px;
            ">

                <tr style="background:#5BABD0; color:white;">
                    <th style="padding:10px;">No</th>
                    <th>Parameter</th>
                    <th>Input User</th>
                    <th>Batas Aman</th>
                    <th>Status</th>
                </tr>

                @php
                $rows = [
                    ['pH', $data['ph'], '6.5 - 8.5'],
                    ['Hardness', $data['hardness'], '< 500 mg/L'],
                    ['TDS', $data['solids'], '< 500 ppm'],
                    ['Chloramines', $data['chloramines'], '< 4 ppm'],
                    ['Sulfate', $data['sulfate'], '< 250 mg/L'],
                    ['Conductivity', $data['conductivity'], '< 400 µS/cm'],
                    ['Organic Carbon', $data['organic_carbon'], '< 2 mg/L'],
                    ['Trihalomethanes', $data['trihalomethanes'], '< 80 µg/L'],
                    ['Turbidity', $data['turbidity'], '< 5 NTU'],
                ];
                @endphp

                @foreach($rows as $i => $row)
                @php
                    $status = 'Normal';
                    $icon = '✔️';
                @endphp

                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;">{{ $i+1 }}</td>
                    <td>{{ $row[0] }}</td>
                    <td>{{ $row[1] }}</td>
                    <td>{{ $row[2] }}</td>
                    <td>{{ $icon }} {{ $status }}</td>
                </tr>
                @endforeach

            </table>

        </div>

        <!-- BUTTON -->
        <button onclick="window.print()" style="
            margin-top:30px;
            background:#5BABD0;
            color:white;
            padding:12px 40px;
            border:none;
            border-radius:15px;
            cursor:pointer;
        ">
            Cetak PDF
        </button>

    </div>

</section>

@endsection