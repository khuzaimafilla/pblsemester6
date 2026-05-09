    <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>SIMPOA PDF</title>

    <style>

        body{
            font-family: sans-serif;
            color:#333;
        }

        .header{
            text-align:center;
            margin-bottom:30px;
        }

        .title{
            color:#5BABD0;
            font-size:28px;
            margin-bottom:5px;
        }

        .subtitle{
            color:#666;
            font-size:14px;
        }

        .result-box{
            background:#5BABD0;
            color:white;
            padding:20px;
            border-radius:12px;
            text-align:center;
            margin-bottom:30px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table th{
            background:#5BABD0;
            color:white;
            padding:10px;
            border:1px solid #ddd;
        }

        table td{
            padding:10px;
            border:1px solid #ddd;
        }

    </style>

</head>

<body>

    <div class="header">

        <div class="title">
            SIMPOA
        </div>

        <div class="subtitle">
            Sistem Potabilitas Air
        </div>

    </div>

    <div class="result-box">

        <h2>
            HASIL ANALISIS AIR
        </h2>

        <h1>
            {{ $result }}
        </h1>

        <p>
            Probabilitas: {{ $probability }}%
        </p>

    </div>

    <table>

        <tr>
            <th>Parameter</th>
            <th>Nilai</th>
        </tr>

        @foreach($data as $key => $value)

        <tr>

            <td>
                {{ $key }}
            </td>

            <td>
                {{ $value }}
            </td>

        </tr>

        @endforeach

    </table>

    <p style="margin-top:30px; font-size:12px; color:#666;">

        Standar mengacu pada WHO Drinking Water Guidelines
        dan Permenkes No. 2 Tahun 2023.

    </p>

</body>

</html>