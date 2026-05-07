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

            <div style="
                background:white;
                color:#5BABD0;
                padding:6px 20px;
                border-radius:20px;
                display:inline-block;
                margin-top:10px;
                font-weight:600;
            ">
                Probabilitas {{ $probability }}%
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

                        // MIN MAX
                        if (
                            isset($rule['min']) &&
                            isset($rule['max'])
                        ) {

                            if (
                                $value < $rule['min'] ||
                                $value > $rule['max']
                            ) {

                                $status = 'Tidak Normal';
                                $icon = '⚠️';

                                $warnings[] = [
                                    'parameter' => $parameter,
                                    'danger' => $rule['danger'] ?? '',
                                    'suggestion' => $rule['suggestion'] ?? '',
                                ];
                            }

                        }

                        // MAX ONLY
                        elseif (isset($rule['max'])) {

                            if ($value > $rule['max']) {

                                $status = 'Tinggi';
                                $icon = '⚠️';

                                $warnings[] = [
                                    'parameter' => $parameter,
                                    'danger' => $rule['danger'] ?? '',
                                    'suggestion' => $rule['suggestion'] ?? '',
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

        <!-- BUTTON -->
        <button onclick="window.print()" style="
            margin-top:30px;
            background:#5BABD0;
            color:white;
            padding:12px 40px;
            border:none;
            border-radius:15px;
            cursor:pointer;
            font-weight:600;
        ">
            Cetak PDF
        </button>

    </div>

</section>

@endsection