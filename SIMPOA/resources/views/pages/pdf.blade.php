<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Sertifikat SIMPOA</title>

    <style>

        body {

            font-family: DejaVu Sans, sans-serif;

            margin: 0;

            padding: 35px;

            color: #1E293B;

            background: white;

        }

        .page {

            border: 6px solid #D6E4F0;

            padding: 45px;

            min-height: 92vh;

            position: relative;

        }

        .watermark {

            position: absolute;

            top: 180px;

            left: 400px;

            width: 600px;

            opacity: 0.3;

        }

        .header {

            text-align: center;

        }

        .logo {

            width: 90px;

            margin-bottom: 10px;

        }

        .small-title {

            font-size: 13px;

            color: #64748B;

            letter-spacing: 1px;

        }

        .main-title {

            font-size: 30px;

            font-weight: bold;

            margin-top: 10px;

            color: #3A929C;

        }

        .certificate-number {

            margin-top: 10px;

            font-size: 13px;

            color: #64748B;

        }

        .line {

            width: 120px;

            height: 3px;

            background: #5BABD0;

            margin: 18px auto;

            border-radius: 10px;

        }

        .content {

            margin-top: 35px;

            text-align: center;

            line-height: 1.9;

        }

        .status {

            margin-top: 25px;

            font-size: 34px;

            font-weight: bold;

            color:
                {{ $hybridLayak
                    ? '#3A929C'
                    : '#DC2626'
                }};

        }

        .description {

            margin-top: 20px;

            font-size: 14px;

            color: #475569;

            line-height: 1.9;

        }

        .info-box {

            margin-top: 40px;

            background: #F8FAFC;

            border-radius: 18px;

            padding: 25px;

        }

        table {

            width: 100%;

            border-collapse: collapse;

        }

        td {

            padding: 10px 0;

            border-bottom: 1px solid #E2E8F0;

            font-size: 13px;

        }

        .label {

            width: 40%;

            color: #64748B;

        }

        .value {

            font-weight: bold;

            color: #1E293B;

        }

        .footer {

            margin-top: 60px;

            width: 100%;

        }

        .signature {

            width: 250px;

            text-align: center;

            float: right;

        }

        .signature-line {

            margin-top: 70px;

            border-top: 1px solid #94A3B8;

            padding-top: 10px;

            font-size: 13px;

        }

        .official {

            margin-top: 35px;

            font-size: 12px;

            color: #64748B;

            text-align: center;

            line-height: 1.8;

        }

    </style>

</head>

<body>

<div class="page">

    <!-- WATERMARK -->
    <img
        src="{{ public_path('images/logo-simpoa.png') }}"
        class="watermark"
    >

    <!-- HEADER -->
    <div class="header">

        <img
            src="{{ public_path('images/logo-simpoa.png') }}"
            class="logo"
        >

        <div class="small-title">
            SMART INTELLIGENT MONITORING
        </div>

        <div class="main-title">
            SERTIFIKAT ANALISIS AIR
        </div>

        <div class="certificate-number">

            No.
            {{ date('dmY') }}/SIMPOA/{{ rand(100,999) }}

        </div>

        <div class="line"></div>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <p>
            Berdasarkan hasil analisis kualitas air menggunakan
            kombinasi metode <b>Random Forest</b>,
            <b>Simple Additive Weighting (SAW)</b>,
            dan validasi parameter standar kualitas air,
            sistem menyatakan bahwa:
        </p>

        <div class="status">

            {{ $hybridLayak
                ? 'LAYAK KONSUMSI'
                : 'TIDAK LAYAK KONSUMSI'
            }}

        </div>

        <div class="description">

            @if($hybridLayak)

                Air memenuhi sebagian besar parameter
                standar kualitas air konsumsi berdasarkan
                hasil analisis sistem SIMPOA.

            @else

                Air tidak memenuhi standar kualitas air
                konsumsi karena terdapat parameter
                yang berada di luar batas keamanan.

            @endif

        </div>

    </div>

    <!-- INFO -->
    <div class="info-box">

        <table>

            <tr>
                <td class="label">
                    Tanggal Analisis
                </td>

                <td class="value">
                    {{ now()->format('d F Y') }}
                </td>
            </tr>

            <tr>
                <td class="label">
                    Probabilitas AI
                </td>

                <td class="value">
                    {{ $probability }}%
                </td>
            </tr>

            <tr>
                <td class="label">
                    Confidence Level
                </td>

                <td class="value">
                    {{ $confidence }}
                </td>
            </tr>

            <tr>
                <td class="label">
                    SAW Quality Score
                </td>

                <td class="value">
                    {{ number_format($finalSaw,1) }}/100
                </td>
            </tr>

            <tr>
                <td class="label">
                    Kategori Kualitas
                </td>

                <td class="value">
                    {{ $sawCategory }}
                </td>
            </tr>

        </table>

    </div>

    <!-- FOOTER -->
    <div class="footer">

        <div class="signature">

            <div class="signature-line">

                SIMPOA Validation System

            </div>

        </div>

    </div>

    <!-- OFFICIAL -->
    <div class="official">

        Sertifikat ini dihasilkan secara otomatis oleh sistem
        Smart Intelligent Monitoring Potability of Water (SIMPOA)
        berdasarkan parameter analisis kualitas air.

    </div>

</div>

</body>

</html>