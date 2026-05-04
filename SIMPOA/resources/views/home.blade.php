<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPOA - Sistem Potabilitas Air</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #eaf7ff, #ffffff);
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 20px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .logo-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #5bb6e6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .title h1 {
            margin: 0;
            color: #4ea8de;
            font-size: 32px;
        }

        .title p {
            margin: 0;
            color: #6c757d;
        }

        .progress {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .step {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #4ea8de;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            margin-right: 10px;
        }

        .line {
            flex: 1;
            height: 4px;
            background: #4ea8de;
            border-radius: 10px;
        }

        .card {
            background: white;
            border-radius: 25px;
            padding: 35px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .field {
            margin-bottom: 22px;
        }

        .field-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #4ea8de;
            font-weight: 600;
            font-size: 15px;
        }

        input {
            width: 100%;
            padding: 16px;
            border: 1.8px solid #b7dff3;
            border-radius: 16px;
            outline: none;
            font-size: 14px;
            box-sizing: border-box;
        }

        input::placeholder {
            color: #b0b0b0;
            font-style: italic;
        }

        button {
            display: block;
            margin-left: auto;
            background: #4ea8de;
            color: white;
            border: none;
            padding: 14px 45px;
            border-radius: 16px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 25px;
        }

        .result {
            background: #e8f4ff;
            color: #2563eb;
            padding: 15px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="logo-section">
        <div class="logo-circle">SP</div>
        <div class="title">
            <h1>SIMPOA</h1>
            <p>Sistem Potabilitas Air</p>
        </div>
    </div>

    <div class="progress">
        <div class="step">1</div>
        <span style="margin-right:15px; color:#4ea8de;">Data Kualitas Air</span>
        <div class="line"></div>
        <span style="margin-left:15px; color:#7aa7bd;">Hasil</span>
    </div>

    <div class="card">

        @if(session('result'))
            <div class="result">
                Hasil Analisa: {{ session('result') }}
            </div>
        @endif

        <form action="/analyze" method="POST">
            @csrf

            <div class="field">
                <div class="field-header">
                    <span>Derajat Keasaman (pH)</span>
                    <span>Skala 0-14</span>
                </div>
                <input type="number" step="any" name="ph" placeholder="*Contoh: 7.05" required>
            </div>

            <div class="field">
                <div class="field-header">
                    <span>Tingkat Kesadahan (Hardness)</span>
                    <span>mg/L</span>
                </div>
                <input type="number" step="any" name="hardness" placeholder="*Contoh: 185.20" required>
            </div>

            <div class="field">
                <div class="field-header">
                    <span>Total Padatan Terlarut (TDS)</span>
                    <span>ppm</span>
                </div>
                <input type="number" step="any" name="solids" placeholder="*Contoh: 15000.50" required>
            </div>

            <div class="field">
                <div class="field-header">
                    <span>Kadar Kloramin</span>
                    <span>ppm</span>
                </div>
                <input type="number" step="any" name="chloramines" placeholder="*Contoh: 7.12" required>
            </div>

            <div class="field">
                <div class="field-header">
                    <span>Kadar Sulfat</span>
                    <span>mg/L</span>
                </div>
                <input type="number" step="any" name="sulfate" placeholder="*Contoh: 330.45" required>
            </div>

            <div class="field">
                <div class="field-header">
                    <span>Daya Hantar Listrik (Conductivity)</span>
                    <span>µS/cm</span>
                </div>
                <input type="number" step="any" name="conductivity" placeholder="*Contoh: 450.10" required>
            </div>

            <div class="field">
                <div class="field-header">
                    <span>Karbon Organik Total (TOC)</span>
                    <span>ppm</span>
                </div>
                <input type="number" step="any" name="organic_carbon" placeholder="*Contoh: 15.30" required>
            </div>

            <div class="field">
                <div class="field-header">
                    <span>Kadar Trihalometana</span>
                    <span>µg/L</span>
                </div>
                <input type="number" step="any" name="trihalomethanes" placeholder="*Contoh: 65.25" required>
            </div>

            <div class="field">
                <div class="field-header">
                    <span>Tingkat Kekeruhan (Turbidity)</span>
                    <span>NTU</span>
                </div>
                <input type="number" step="any" name="turbidity" placeholder="*Contoh: 3.85" required>
            </div>

            <button type="submit">Analisa</button>
        </form>
    </div>
</div>

</body>
</html>