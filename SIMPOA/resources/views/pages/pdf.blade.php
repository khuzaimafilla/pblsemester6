<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

body{

font-family:DejaVu Sans,sans-serif;
margin:0;
padding:20px;
color:#1E293B;

}

.container{

border:2px solid #D6E4F0;
padding:25px;

}

.header{

width:100%;
margin-bottom:20px;

}

.logo{

width:95px;
float:left;

margin-left:15px;
margin-top:5px;
margin-right:15px;

}

.header-text{

margin-left:10px;

}

.title{

font-size:24px;
font-weight:bold;
color:#3A929C;

}

.subtitle{

font-size:11px;
color:#64748B;

}

.cert-number{

font-size:11px;
margin-top:5px;

}

.clear{

clear:both;

}

.status-box{

margin-top:20px;
padding:15px;
border-radius:10px;
text-align:center;
background:
{{ $hybridLayak
?'#E0F7FA'
:'#FEE2E2'
}};

}

.status{

font-size:28px;
font-weight:bold;

color:
{{ $hybridLayak
?'#3A929C'
:'#DC2626'
}};

}

.summary{

margin-top:20px;

}

.summary td{

width:25%;
padding:10px;
text-align:center;
border:1px solid #E2E8F0;

}

.parameter-title{

margin-top:25px;
font-size:16px;
font-weight:bold;

}

table{

width:100%;
border-collapse:collapse;

}

th{

background:#5BABD0;
color:white;
padding:10px;
font-size:12px;

}

td{

padding:8px;
border:1px solid #E2E8F0;
font-size:11px;

}

.footer{

margin-top:25px;
font-size:10px;
text-align:center;
color:#64748B;

}

.signature{

margin-top:35px;
float:right;
width:180px;
text-align:center;

}

.line{

margin-top:50px;
border-top:1px solid black;

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<img
src="{{ public_path('images/logo-simpoa.png') }}"
class="logo"
>

<div class="header-text">

<div class="title">

SERTIFIKAT ANALISIS AIR

</div>

<div class="subtitle">

SMART INTELLIGENT MONITORING POTABILITY OF WATER

</div>

<div class="cert-number">

No:
{{ date('dmY') }}/SIMPOA/{{ rand(100,999) }}

</div>

</div>

</div>

<div class="clear"></div>

<div class="status-box">

<div class="status">

{{ $hybridLayak
?
'LAYAK KONSUMSI'
:
'TIDAK LAYAK KONSUMSI'
}}

</div>

</div>

<table class="summary">

<tr>

<td>

<b>AI</b><br>

{{ $probability }}%

</td>

<td>

<b>Confidence</b><br>

{{ $confidence }}

</td>

<td>

<b>SAW</b><br>

{{ number_format(
$finalSaw,
1
) }}/100

</td>

<td>

<b>Kategori</b><br>

{{ $sawCategory }}

</td>

</tr>

</table>

<div class="parameter-title">

HASIL PARAMETER AIR

</div>

<table>

<tr>

<th>Parameter</th>
<th>Nilai</th>
<th>Standar</th>

</tr>

@foreach($rows as $row)

<tr>

<td>{{ $row[0] }}</td>

<td>{{ $row[1] }}</td>

<td>

{{ $standards[$row[0]]['label'] ?? '-' }}

</td>

</tr>

@endforeach

</table>

<div class="signature">

<img
src="{{ public_path('images/ttd-simpoa.png') }}"
style="

width:300px;
margin-bottom:-100px;

">

<div class="line"></div>

</div>

<div class="clear"></div>

<div class="footer">

Sertifikat ini dihasilkan otomatis oleh sistem SIMPOA

</div>

</div>

</body>
</html>