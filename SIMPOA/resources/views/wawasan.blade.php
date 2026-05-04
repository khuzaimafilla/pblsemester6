<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wawasan Kandungan Air - SIMPOA</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue-primary: #58A8CD;
            --blue-dark: #315287;
            --blue-teal: #3A949C;
            --blue-pale: #d0eaf5;
            --bg-page: #ddeef7;
            --bg-card: #ffffff;
            --bg-header-card: #b8d9ed;
            --teal-badge: #3A949C;
            --green-status: #27AE60;
            --orange-status: #E67E22;
            --text-dark: #1f3a50;
            --text-mid: #315287;
            --text-light: #58A8CD;
            --border: #c2dff0;
            --shadow: 0 4px 20px rgba(88, 168, 205, 0.13);
            --shadow-hover: 0 8px 32px rgba(49, 82, 135, 0.18);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--bg-page);
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* ── PAGE WRAPPER ── */
        .page-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            padding: 52px 32px 60px;
        }

        /* ── HEADER ── */
        .page-header {
            margin-bottom: 44px;
        }
        .page-header h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.15rem;
            font-weight: 800;
            color: var(--blue-dark);
            letter-spacing: -0.5px;
            line-height: 1.15;
        }
        .page-header p {
            margin-top: 8px;
            font-size: 0.88rem;
            color: var(--text-mid);
            max-width: 420px;
            line-height: 1.55;
        }

        /* ── GRID ── */
        .cards-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 36px;
        }

        /* ── SINGLE CARD ── */
        .wawasan-card {
            background: var(--bg-card);
            border-radius: 18px;
            box-shadow: var(--shadow);
            overflow: hidden;
            display: flex;
            flex-direction: row;
            transition: box-shadow 0.25s, transform 0.25s;
        }
        .wawasan-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-3px);
        }

        /* LEFT PANEL */
        .card-left {
            flex: 0 0 55%;
            background: #F3F9FD;
            border-right: 1px solid var(--border);
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .card-left-header {
            background: var(--blue-primary);
            text-align: center;
            padding: 9px 12px 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .card-verdict {
            background: linear-gradient(135deg, #315287 0%, #3A949C 100%);
            margin: 14px 14px 0;
            border-radius: 10px;
            padding: 12px 14px;
            color: #fff;
            text-align: center;
        }
        .card-verdict .verdict-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.85;
            margin-bottom: 3px;
        }
        .card-verdict .verdict-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: -0.2px;
        }
        .card-verdict .verdict-badge {
            display: inline-block;
            margin-top: 7px;
            background: rgba(255,255,255,0.22);
            border: 1px solid rgba(255,255,255,0.35);
            border-radius: 20px;
            padding: 3px 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .card-desc {
            padding: 10px 14px 8px;
            font-size: 0.72rem;
            color: var(--text-mid);
            line-height: 1.55;
        }
        .card-desc strong { color: var(--blue-primary); font-weight: 600; }

        /* TABLE */
        .card-table-title {
            padding: 4px 14px 6px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--blue-dark);
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .card-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.65rem;
        }
        .card-table thead tr {
            background: var(--bg-header-card);
        }
        .card-table thead th {
            padding: 5px 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            color: var(--blue-dark);
            text-align: left;
            font-size: 0.62rem;
            letter-spacing: 0.2px;
        }
        .card-table tbody tr:nth-child(even) { background: #EAF4FC; }
        .card-table tbody td {
            padding: 5px 8px;
            color: var(--text-mid);
            border-top: 1px solid var(--border);
        }
        .card-table tbody td:first-child { font-weight: 600; color: var(--text-dark); }

        .status-normal {
            display: inline-flex; align-items: center; gap: 3px;
            color: var(--green-status); font-weight: 600; font-size: 0.62rem;
        }
        .status-normal::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--green-status); display: inline-block; }

        .status-tinggi {
            display: inline-flex; align-items: center; gap: 3px;
            color: var(--orange-status); font-weight: 600; font-size: 0.62rem;
        }
        .status-tinggi::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--orange-status); display: inline-block; }

        /* RIGHT PANEL */
        .card-right {
            flex: 1;
            padding: 16px 18px;
            display: flex;
            flex-direction: column;
        }

        .card-param-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--blue-primary);
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--blue-pale);
        }
        .card-param-title span {
            display: block;
            font-size: 0.65rem;
            color: var(--teal-badge);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 2px;
        }

        .card-param-desc {
            font-size: 0.80rem;
            color: var(--text-mid);
            line-height: 1.65;
            flex: 1;
        }

        /* ── CETAK PDF BUTTON ── */
        .btn-row {
            text-align: center;
            margin-top: 8px;
        }
        .btn-cetak {
            display: inline-block;
            background: linear-gradient(135deg, var(--blue-primary), var(--blue-dark));
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.92rem;
            font-weight: 700;
            padding: 13px 52px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            letter-spacing: 0.3px;
            box-shadow: 0 6px 20px rgba(43, 127, 193, 0.35);
            transition: all 0.22s;
            text-decoration: none;
        }
        .btn-cetak:hover {
            background: linear-gradient(135deg, var(--blue-light), var(--blue-primary));
            box-shadow: 0 10px 28px rgba(43, 127, 193, 0.45);
            transform: translateY(-2px);
        }
        .btn-cetak:active { transform: translateY(0); }

        /* ── FOOTER ── */
        .page-footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.75rem;
            color: var(--text-light);
            letter-spacing: 0.3px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .cards-grid { grid-template-columns: 1fr; }
            .page-header h1 { font-size: 1.6rem; }
            .wawasan-card { flex-direction: column; }
            .card-left { border-right: none; border-bottom: 1px solid var(--border); }
        }
    </style>
</head>
<body>

<div class="page-wrapper">

    {{-- ── HEADER ── --}}
    <div class="page-header">
        <h1>Wawasan Kandungan Air</h1>
        <p>Memahami Parameter Kualitas Air Berdasarkan Standar WHO &amp; Permenkes No. 2 Tahun 2023</p>
    </div>

    {{-- ── GRID CARDS ── --}}
    {{--
        Nanti ganti $analyses dengan data dari DB:
        $analyses = \App\Models\WaterAnalysis::latest()->take(4)->get();
        Sementara pakai data dummy di bawah ini.
    --}}

    @php
    $analyses = [
        [
            'prediction'  => 'AIR LAYAK KONSUMSI',
            'probability' => '96.5%',
            'ph'          => 7.20,
            'hardness'    => 180.0,
            'solids'      => 440.0,
            'ph_status'   => 'normal',
            'hard_status' => 'normal',
            'tds_status'  => 'tinggi',
            'param_name'  => 'Keasaman (pH)',
            'param_desc'  => 'Derajat keasaman air dengan rentang aman 6.5–8.5. pH tidak stabil memicu korosi pipa jika terlalu asam atau rasa pahit sabun jika terlalu basa.',
        ],
        [
            'prediction'  => 'AIR LAYAK KONSUMSI',
            'probability' => '96.5%',
            'ph'          => 7.20,
            'hardness'    => 180.0,
            'solids'      => 440.0,
            'ph_status'   => 'normal',
            'hard_status' => 'normal',
            'tds_status'  => 'tinggi',
            'param_name'  => 'Keasaman (pH)',
            'param_desc'  => 'Derajat keasaman air dengan rentang aman 6.5–8.5. pH tidak stabil memicu korosi pipa jika terlalu asam atau rasa pahit sabun jika terlalu basa.',
        ],
        [
            'prediction'  => 'AIR LAYAK KONSUMSI',
            'probability' => '96.5%',
            'ph'          => 7.20,
            'hardness'    => 180.0,
            'solids'      => 460.0,
            'ph_status'   => 'normal',
            'hard_status' => 'normal',
            'tds_status'  => 'tinggi',
            'param_name'  => 'Keasaman (pH)',
            'param_desc'  => 'Derajat keasaman air dengan rentang aman 6.5–8.5. pH tidak stabil memicu korosi pipa jika terlalu asam atau rasa pahit sabun jika terlalu basa.',
        ],
        [
            'prediction'  => 'AIR LAYAK KONSUMSI',
            'probability' => '96.9%',
            'ph'          => 7.20,
            'hardness'    => 180.0,
            'solids'      => 460.0,
            'ph_status'   => 'normal',
            'hard_status' => 'normal',
            'tds_status'  => 'tinggi',
            'param_name'  => 'Keasaman (pH)',
            'param_desc'  => 'Derajat keasaman air dengan rentang aman 6.5–8.5. pH tidak stabil memicu korosi pipa jika terlalu asam atau rasa pahit sabun jika terlalu basa.',
        ],
    ];
    @endphp

    <div class="cards-grid">
        @foreach($analyses as $item)
        <div class="wawasan-card">

            {{-- LEFT: Hasil Analisis --}}
            <div class="card-left">
                <div class="card-left-header">Hasil Analisis</div>

                <div class="card-verdict">
                    <div class="verdict-label">Prediksi Algoritma</div>
                    <div class="verdict-title">{{ $item['prediction'] }}</div>
                    <div class="verdict-badge">Probabilitas Kelayakan {{ $item['probability'] }}</div>
                </div>

                <div class="card-desc">
                    Dari analisis algoritma <strong>Random Forest</strong>, parameter air yang
                    dimasukkan memenuhi standar baku mutu kesehatan. Air ini aman dikonsumsi
                    setiap hari, namun tetap <strong>disarankan untuk merebus</strong> hingga 100°C.
                </div>

                <div class="card-table-title">Tabel Hasil (The Proof)</div>

                <table class="card-table">
                    <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Input User</th>
                            <th>Batas Aman (WHO / Permenkes)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>pH</td>
                            <td>{{ $item['ph'] }}</td>
                            <td>6.5 – 8.5</td>
                            <td>
                                @if($item['ph_status'] === 'normal')
                                    <span class="status-normal">Normal</span>
                                @else
                                    <span class="status-tinggi">Tinggi</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Hardness</td>
                            <td>{{ $item['hardness'] }}</td>
                            <td>Max 500 mg/L</td>
                            <td>
                                @if($item['hard_status'] === 'normal')
                                    <span class="status-normal">Normal</span>
                                @else
                                    <span class="status-tinggi">Tinggi</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Solids (TDS)</td>
                            <td>{{ $item['solids'] }}</td>
                            <td>Max 500 – 500 mg/L</td>
                            <td>
                                @if($item['tds_status'] === 'normal')
                                    <span class="status-normal">Normal</span>
                                @else
                                    <span class="status-tinggi">Tinggi</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- RIGHT: Penjelasan Parameter --}}
            <div class="card-right">
                <div class="card-param-title">
                    <span>Parameter</span>
                    {{ $item['param_name'] }}
                </div>
                <div class="card-param-desc">
                    {{ $item['param_desc'] }}
                </div>
            </div>

        </div>
        @endforeach
    </div>

    {{-- ── CETAK PDF BUTTON ── --}}
    <div class="btn-row">
        <button class="btn-cetak" onclick="window.print()">Cetak PDF</button>
    </div>

    {{-- ── FOOTER ── --}}
    <div class="page-footer">SIMPOA &mdash; Copyright 2025/2026</div>

</div>

</body>
</html>