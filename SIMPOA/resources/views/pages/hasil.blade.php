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

        $confidence = 'Sangat Yakin';

    } elseif ($probability >= 75) {

        $confidence = 'Yakin';

    } elseif ($probability >= 60) {

        $confidence = 'Cukup';

    } else {

        $confidence = 'Rendah';

    }

@endphp

<section style="min-height:100vh; padding:60px 0; text-align:center;">

    <div style="max-width:1000px; margin:auto; padding:0 80px;">

        <!-- TITLE -->
        <h2 style="
            color:#5BABD0;
            margin-bottom:20px;
        ">
            Hasil Analisis
        </h2>

        <!-- RESULT BOX -->
        <div style="
            background: {{ $isLayak
                ? 'linear-gradient(90deg,#3A929C,#5BABD0)'
                : 'linear-gradient(90deg,#DC2626,#B91C1C)'
            }};
            color:white;
            padding:30px;
            border-radius:25px;
            margin:30px 0;
        ">

            <h1>
                AIR {{ $isLayak ? 'LAYAK' : 'TIDAK LAYAK' }} KONSUMSI
            </h1>

            <!-- PROBABILITY -->
            <div style="
                background:white;
                color:#5BABD0;
                padding:10px 22px;
                border-radius:20px;
                display:inline-block;
                margin-top:10px;
                font-weight:600;
                line-height:1.6;
            ">

                Probabilitas {{ $probability }}%

                <br>

                <span style="
                    font-size:13px;
                    font-weight:500;
                    opacity:0.8;
                ">
                    Confidence: {{ $confidence }}
                </span>

            </div>

        </div>

        <!-- DESCRIPTION -->
        <p style="
            color:#5BABD0;
            max-width:700px;
            margin:0 auto 40px;
            line-height:1.7;
        ">
            *Berdasarkan analisis algoritma
            <b>Random Forest</b>,
            parameter air yang Anda masukkan

            {{ $isLayak
                ? 'memenuhi standar baku mutu kesehatan dan aman digunakan dengan perebusan.'
                : 'tidak memenuhi standar dan tidak disarankan untuk dikonsumsi.'
            }}
        </p>

        <!-- TABLE TITLE -->
        <h3 style="
            color:#5BABD0;
            margin-bottom:15px;
        ">
            Tabel Hasil (The Proof)
        </h3>

        <!-- TABLE CARD -->
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

                <!-- HEADER -->
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

                @php

                $warnings = [];

                $dominantParameters = [];

                $rows = [
                    ['pH', $data['ph'] ?? '-'],
                    ['Hardness', $data['hardness'] ?? '-'],
                    ['TDS', $data['solids'] ?? '-'],
                    ['Chloramines', $data['chloramines'] ?? '-'],
                    ['Sulfate', $data['sulfate'] ?? '-'],
                    ['Conductivity', $data['conductivity'] ?? '-'],
                    ['Trihalomethanes', $data['trihalomethanes'] ?? '-'],
                    ['Turbidity', $data['turbidity'] ?? '-'],
                ];

                @endphp

                <!-- LOOP -->
                @foreach($rows as $i => $row)

                @php

                    $parameter = $row[0];
                    $value = (float)$row[1];

                    $rule = $standards[$parameter] ?? null;

                    $status = 'Normal';
                    $icon = '✔️';

                    // =========================
                    // RULE CHECKING
                    // =========================
                    if ($rule) {

                        // =========================
                        // MIN MAX
                        // =========================
                        if (
                            isset($rule['min']) &&
                            isset($rule['max'])
                        ) {

                            // =========================
                            // TERLALU RENDAH
                            // =========================
                            if ($value < $rule['min']) {

                                $status = $rule['low_status'] ?? 'Terlalu Rendah';

                                $icon = '⚠️';

                                $severity = abs($rule['min'] - $value);

                                $dominantParameters[] = [
                                    'parameter' => $parameter,
                                    'severity' => $severity
                                ];

                                $warnings[] = [
                                    'parameter' => $parameter,
                                    'danger' => $rule['low_danger'] ?? '',
                                    'suggestion' => $rule['low_suggestion'] ?? '',
                                ];

                            }

                            // =========================
                            // TERLALU TINGGI
                            // =========================
                            elseif ($value > $rule['max']) {

                                $status = $rule['high_status'] ?? 'Terlalu Tinggi';

                                $icon = '⚠️';

                                $severity = abs($value - $rule['max']);

                                $dominantParameters[] = [
                                    'parameter' => $parameter,
                                    'severity' => $severity
                                ];

                                $warnings[] = [
                                    'parameter' => $parameter,
                                    'danger' => $rule['high_danger'] ?? '',
                                    'suggestion' => $rule['high_suggestion'] ?? '',
                                ];

                            }

                        }

                        // =========================
                        // MAX ONLY
                        // =========================
                        elseif (isset($rule['max'])) {

                            if ($value > $rule['max']) {

                                $status = $rule['high_status'] ?? 'Terlalu Tinggi';

                                $icon = '⚠️';

                                $severity = abs($value - $rule['max']);

                                $dominantParameters[] = [
                                    'parameter' => $parameter,
                                    'severity' => $severity
                                ];

                                $warnings[] = [
                                    'parameter' => $parameter,
                                    'danger' => $rule['high_danger'] ?? '',
                                    'suggestion' => $rule['high_suggestion'] ?? '',
                                ];

                            }

                        }

                    }

                @endphp

                <!-- ROW -->
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

        <!-- SORT DOMINANT -->
        @php

        usort($dominantParameters, function($a, $b) {
            return $b['severity'] <=> $a['severity'];
        });

        $topDominants = array_slice($dominantParameters, 0, 3);

        @endphp

        <!-- DOMINANT PARAMETER -->
        @if(count($topDominants) > 0)

        <div style="
            margin-top:30px;
            background:rgba(255,255,255,0.5);
            backdrop-filter:blur(10px);
            border-radius:20px;
            padding:25px;
            text-align:left;
        ">

            <h3 style="
                color:#5BABD0;
                margin-bottom:20px;
            ">
                Parameter Paling Berpengaruh
            </h3>

            @foreach($topDominants as $dominant)

            <div style="
                margin-bottom:12px;
                color:#5BABD0;
                font-size:16px;
                font-weight:600;
            ">
                ⚠️ {{ $dominant['parameter'] }}
            </div>

            @endforeach

        </div>

        @endif

        <!-- WARNING ANALYSIS -->
        @if(count($warnings) > 0)

        <div style="
            margin-top:30px;
            text-align:left;
            background:rgba(255,255,255,0.5);
            backdrop-filter:blur(10px);
            border-radius:20px;
            padding:25px;
        ">

            <h3 style="
                color:#DC2626;
                margin-bottom:20px;
            ">
                Analisis & Rekomendasi
            </h3>

            @foreach($warnings as $warning)

            <div style="
                margin-bottom:20px;
                color:#5BABD0;
                line-height:1.7;
            ">

                <b>
                    ⚠️ {{ $warning['parameter'] }}
                </b>

                <p>
                    {{ $warning['danger'] }}
                </p>

                <p>
                    <b>Saran:</b>
                    {{ $warning['suggestion'] }}
                </p>

            </div>

            @endforeach

        </div>

        @endif

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
        <form action="{{ route('export.pdf') }}" method="POST">

            @csrf

            <input type="hidden" name="result" value="{{ $result }}">

            <input type="hidden" name="probability" value="{{ $probability }}">

            <input type="hidden" name="data"
                value='@json($data)'>

            <button type="submit" style="
                margin-top:30px;
                background:#5BABD0;
                color:white;
                padding:12px 40px;
                border:none;
                border-radius:15px;
                cursor:pointer;
                font-weight:600;
            ">
                Download PDF
            </button>

        </form>

    </div>

</section>

<!-- CHART JS -->
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
            'Trihalomethanes',
            'Turbidity'
        ],

        datasets: [{

            label: 'Nilai Parameter',

            data: [

                {{ $data['ph'] ?? 0 }},
                {{ $data['hardness'] ?? 0 }},
                {{ $data['solids'] ?? 0 }},
                {{ $data['chloramines'] ?? 0 }},
                {{ $data['sulfate'] ?? 0 }},
                {{ $data['conductivity'] ?? 0 }},
                {{ $data['trihalomethanes'] ?? 0 }},
                {{ $data['turbidity'] ?? 0 }}

            ],

            backgroundColor: [
                '#5BABD0',
                '#5BABD0',
                '#5BABD0',
                '#5BABD0',
                '#5BABD0',
                '#5BABD0',
                '#5BABD0',
                '#5BABD0'
            ],

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