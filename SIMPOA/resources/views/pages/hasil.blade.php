@extends('layouts.app')

@section('content')

@php

    // =========================
    // LOAD STANDAR
    // =========================
    $standards = config('water_standards');

    // =========================
    // DATA DEFAULT
    // =========================
    $data = $data ?? [];

    $result = $result ?? 'TIDAK';

    $probability = $probability ?? 0;

    $isLayak = $result === 'LAYAK';

    // =========================
    // CONFIDENCE LEVEL
    // =========================
    if ($probability >= 90) {
        $confidence='Sangat Tinggi';
    }
    elseif ($probability >= 75) {
        $confidence='Tinggi';
    }
    elseif ($probability >= 55) {
        $confidence='Sedang';
    }
    elseif ($probability >= 45) {
        $confidence='Cukup';
    }
    else {
        $confidence='Rendah';
    }
@endphp

<section style="min-height:100vh; padding:60px 0; text-align:center;">

    <div style="max-width:1000px; margin:auto; padding:0 80px;">

        @php

        $warnings = [];

        $dominantParameters = [];

        // =========================
        // SAW SCORE
        // =========================
        $sawScore = 0;

        $totalWeight = 0;

        $rows = [

            ['pH', $data['ph'] ?? '-'],
            ['Hardness', $data['hardness'] ?? '-'],
            ['TDS', $data['solids'] ?? '-'],
            ['Chloramines', $data['chloramines'] ?? '-'],
            ['Sulfate', $data['sulfate'] ?? '-'],
            ['Conductivity', $data['conductivity'] ?? '-'],
            ['OrganicCarbon', $data['organic_carbon'] ?? '-'],
            ['Trihalomethanes', $data['trihalomethanes'] ?? '-'],
            ['Turbidity', $data['turbidity'] ?? '-'],

        ];

        @endphp

        {{-- ========================= --}}
        {{-- LOOP PARAMETER --}}
        {{-- ========================= --}}

        @foreach($rows as $row)

        @php

            $parameter = $row[0];
            $value = (float)$row[1];

            $rule = $standards[$parameter] ?? null;

            if ($rule) {

                $weight = $rule['weight'] ?? 0;

                $totalWeight += $weight;

                        // =========================
                        // SCORING SAW BERTINGKAT
                        // =========================

                        $parameterScore = 1;

                        if(isset($rule['score_rules'])){

                            $parameterScore = 0;

                            foreach($rule['score_rules'] as $scoreRule){

                                $min = (float)$scoreRule['min'];
                                $max = (float)$scoreRule['max'];

                                if(
                                    $value >= $min &&
                                    $value <= $max
                                ){

                                    $parameterScore =
                                    (float)$scoreRule['score'];

                                    break;

                                }

                            }

                        }

                        // =========================
                        // WARNING TETAP JALAN
                        // =========================

                        if (
                            isset($rule['min']) &&
                            $value < $rule['min']
                        ) {

                            $severity = abs(
                                $rule['min'] - $value
                            );

                            $dominantParameters[] = [

                                'parameter'=>$parameter,
                                'severity'=>$severity

                            ];

                            $warnings[]=[

                                'parameter'=>$parameter,
                                'danger'=>$rule['low_danger'] ?? '',
                                'suggestion'=>$rule['low_suggestion'] ?? ''

                            ];

                        }

                        elseif(

                            isset($rule['max']) &&
                            $value > $rule['max']

                        ){

                            $severity = abs(
                                $value - $rule['max']
                            );

                            $dominantParameters[]=[

                                'parameter'=>$parameter,
                                'severity'=>$severity

                            ];

                            $warnings[]=[

                                'parameter'=>$parameter,
                                'danger'=>$rule['high_danger'] ?? '',
                                'suggestion'=>$rule['high_suggestion'] ?? ''

                            ];

                        }


                        // =========================
                        // HITUNG SAW
                        // =========================

                        $sawScore +=
                        (
                            $parameterScore
                            *
                            $weight
                        );

            }

        @endphp

        @endforeach

        @php

        // =========================
        // FINAL SAW
        // =========================

        $finalSaw = 0;

        if ($totalWeight > 0) {

            $finalSaw = ($sawScore / $totalWeight) * 100;

        }

        // =========================
        // KATEGORI SAW
        // =========================

        if ($finalSaw >= 80) {

            $sawCategory = 'Kualitas Sangat Baik';

        } elseif ($finalSaw >= 60) {

            $sawCategory = 'Kualitas Baik';

        } elseif ($finalSaw >= 40) {

            $sawCategory = 'Kualitas Sedang';

        } else {

            $sawCategory = 'Kualitas Buruk';

        }

        // =========================
        // CRITICAL RULE
        // =========================

        $criticalFailed = false;

        foreach ($rows as $row) {

            $parameter = $row[0];
            $value = (float)$row[1];

            $rule = $standards[$parameter] ?? null;

            if ($rule) {

                if (
                    isset($rule['critical_min']) &&
                    $value < $rule['critical_min']
                ) {

                    $criticalFailed = true;

                }

                if (
                    isset($rule['critical_max']) &&
                    $value > $rule['critical_max']
                ) {

                    $criticalFailed = true;

                }

            }

        }

        // =========================
        // HYBRID DECISION
        // =========================

        $hybridLayak = false;

        if (

            !$criticalFailed &&

            (
                $finalSaw >= 70 ||
                ($isLayak && $finalSaw >= 60)
            )

        ) {

            $hybridLayak = true;

        }

        @endphp

        <!-- HERO RESULT -->
        <div style="
            background: {{ $hybridLayak
                ? 'linear-gradient(90deg,#3A929C,#5BABD0)'
                : 'linear-gradient(90deg,#DC2626,#B91C1C)'
            }};
            color:white;
            padding:40px;
            border-radius:28px;
            margin:30px 0;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
        ">

            <div style="
                font-size:18px;
                opacity:0.9;
                margin-bottom:10px;
            ">
                Final Hybrid Decision
            </div>

            <h1 style="
                font-size:42px;
                margin-bottom:15px;
            ">
                {{ $hybridLayak
                    ? 'LAYAK KONSUMSI'
                    : 'TIDAK LAYAK KONSUMSI'
                }}
            </h1>

            <p style="
                max-width:700px;
                margin:0 auto;
                line-height:1.8;
                opacity:0.95;
                font-size:15px;
            ">

                @if($hybridLayak)

                    Air memenuhi sebagian besar parameter standar
                    kualitas air konsumsi berdasarkan analisis
                    Random Forest dan metode SAW.

                @else

                    Air tidak direkomendasikan untuk dikonsumsi
                    karena terdapat parameter yang berada di luar
                    standar keamanan kualitas air.

                @endif

            </p>

            <!-- MINI INFO -->
            <div style="
                display:flex;
                justify-content:center;
                gap:15px;
                flex-wrap:wrap;
                margin-top:25px;
            ">

                <!-- RF -->
                <div style="
                    background:white;
                    color:#5BABD0;
                    padding:12px 22px;
                    border-radius:18px;
                    min-width:180px;
                ">
                    <div style="font-size:13px; opacity:0.7;">
                        Random Forest
                    </div>

                    <div style="font-size:20px; font-weight:700;">
                        {{ $probability }}%
                    </div>

                    <div style="font-size:13px;">
                        Confidence: {{ $confidence }}
                    </div>
                </div>

                <!-- SAW -->
                <div style="
                    background:white;
                    color:#5BABD0;
                    padding:12px 22px;
                    border-radius:18px;
                    min-width:180px;
                ">
                    <div style="font-size:13px; opacity:0.7;">
                        SAW Quality Score
                    </div>

                    <div style="font-size:20px; font-weight:700;">
                        {{ number_format($finalSaw,1) }}/100
                    </div>

                    <div style="font-size:13px;">
                        {{ $sawCategory }}
                    </div>
                </div>

            </div>

        </div>

        <!-- PARAMETER BERMASALAH -->
        @if(count($warnings) > 0)

        <div style="
            background:rgba(255,255,255,0.5);
            backdrop-filter:blur(10px);
            border-radius:22px;
            padding:25px;
            margin-bottom:30px;
            text-align:left;
        ">

            <h3 style="
                color:#DC2626;
                margin-bottom:18px;
            ">
                Parameter yang Perlu Diperhatikan
            </h3>

            @foreach($warnings as $warning)

            <div style="
                padding:15px 18px;
                border-radius:16px;
                background:rgba(255,255,255,0.5);
                margin-bottom:15px;
            ">

                <div style="
                    font-weight:700;
                    color:#DC2626;
                    margin-bottom:8px;
                ">
                    ⚠️ {{ $warning['parameter'] }}
                </div>

                <div style="
                    color:#5BABD0;
                    line-height:1.7;
                    font-size:14px;
                ">
                    {{ $warning['danger'] }}
                </div>

                <div style="
                    margin-top:10px;
                    font-size:14px;
                    color:#5BABD0;
                ">
                    <b>Saran:</b>
                    {{ $warning['suggestion'] }}
                </div>

            </div>

            @endforeach

        </div>

        @endif

        <!-- DETAIL ANALISIS -->
        <div style="
            background:rgba(255,255,255,0.5);
            backdrop-filter:blur(10px);
            border-radius:22px;
            padding:25px;
            margin-bottom:30px;
        ">

            <h3 style="
                color:#5BABD0;
                margin-bottom:20px;
            ">
                Detail Analisis Parameter
            </h3>

            <table style="
                width:100%;
                border-collapse:collapse;
                color:#5BABD0;
                font-size:14px;
            ">

                <tr style="
                    background:#5BABD0;
                    color:white;
                ">
                    <th style="padding:12px;">No</th>
                    <th>Parameter</th>
                    <th>Input User</th>
                    <th>Batas Aman</th>
                    <th>Status</th>
                </tr>

                @foreach($rows as $i => $row)

                @php

                    $parameter = $row[0];
                    $value = (float)$row[1];

                    $rule = $standards[$parameter] ?? null;

                    $status = 'Normal';
                    $icon = '✔️';

                    if ($rule) {

                        if (
                            isset($rule['min']) &&
                            $value < $rule['min']
                        ) {

                            $status = $rule['low_status'] ?? 'Rendah';
                            $icon = '⚠️';

                        }

                        elseif (
                            isset($rule['max']) &&
                            $value > $rule['max']
                        ) {

                            $status = $rule['high_status'] ?? 'Tinggi';
                            $icon = '⚠️';

                        }

                    }

                @endphp

                <tr style="
                    border-bottom:1px solid #ddd;
                ">

                    <td style="padding:12px;">
                        {{ $i + 1 }}
                    </td>

                    <td>
                        {{ $parameter }}
                    </td>

                    <td>
                        {{ $row[1] }}
                    </td>

                    <td>
                        {{ $rule['label'] ?? '-' }}
                    </td>

                    <td style="
                        font-weight:600;
                    ">
                        {{ $icon }} {{ $status }}
                    </td>

                </tr>

                @endforeach

            </table>

        </div>

        <!-- VISUALIZATION -->
        <div style="
            margin-top:30px;
            background:rgba(255,255,255,0.5);
            backdrop-filter:blur(10px);
            border-radius:20px;
            padding:25px;
        ">

            <h3 style="
                color:#5BABD0;
                margin-bottom:25px;
            ">
                Visualisasi Parameter Air
            </h3>

            <canvas id="waterChart"></canvas>

        </div>

        <!-- SOURCE -->
        <p style="
            margin-top:25px;
            color:#7BAFCB;
            font-size:13px;
            line-height:1.6;
        ">
            Standar parameter mengacu pada WHO Drinking Water Guidelines
            dan Permenkes No. 2 Tahun 2023.
        </p>

        <!-- BUTTON -->
        <form
            action="{{ route('export.pdf') }}"
            method="POST"
            target="_blank"
        >
        

            @csrf

            <input type="hidden" name="result" value="{{ $result }}">

            <input type="hidden" name="probability" value="{{ $probability }}">

            <input type="hidden" name="data"
                value='@json($data)'>

            <!-- BUTTON KEMBALI -->

            <a
                href="{{ route('form') }}"
                style="
                    display:inline-block;
                    margin-top:30px;
                    margin-right:15px;
                    background:white;
                    color:#5BABD0;
                    padding:14px 42px;
                    border:2px solid #5BABD0;
                    border-radius:18px;
                    text-decoration:none;
                    font-weight:700;
                    font-size:14px;
                    box-shadow:0 10px 20px rgba(0,0,0,0.08);
                "
            >

                ← Kembali ke Input

            </a>

            <button type="submit" style="
                margin-top:30px;
                background: {{ $hybridLayak
                    ? 'linear-gradient(90deg,#3A929C,#5BABD0)'
                    : 'linear-gradient(90deg,#DC2626,#B91C1C)'
                }};
                color:white;
                padding:14px 42px;
                border:none;
                border-radius:18px;
                cursor:pointer;
                font-weight:700;
                font-size:14px;
                box-shadow:0 10px 20px rgba(0,0,0,0.08);
            ">
                Download PDF
            </button>

        </form>

    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('waterChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
        'pH',
        'Hardness',
        'TDS',
        'Chloramines',
        'Sulfate',
        'Conductivity',
        'TOC',
        'Trihalomethanes',
        'Turbidity'
        ],

        datasets: [{

            label: 'Nilai Parameter',

            data:[

            {{ $data['ph'] ?? 0 }},
            {{ $data['hardness'] ?? 0 }},
            {{ $data['solids'] ?? 0 }},
            {{ $data['chloramines'] ?? 0 }},
            {{ $data['sulfate'] ?? 0 }},
            {{ $data['conductivity'] ?? 0 }},
            {{ $data['organic_carbon'] ?? 0 }},
            {{ $data['trihalomethanes'] ?? 0 }},
            {{ $data['turbidity'] ?? 0 }}

            ],

            backgroundColor: '#5BABD0',

            borderRadius: 10

        }]
    },

    options: {

        responsive: true,

        plugins: {

            legend: {
                display: false
            }

        },

        scales: {

            y: {
                beginAtZero: true
            }

        }

    }

});

</script>

@endsection