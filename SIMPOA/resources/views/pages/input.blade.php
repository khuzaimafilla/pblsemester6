@extends('layouts.app')

@section('content')

<section style="min-height:100vh; padding:60px 0 60px;">

    <div style="max-width:900px; margin:0 auto; padding:0 80px;">

        <!-- HEADER -->
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:30px;">
            <img src="{{ asset('assets/logo-simpoa.png') }}" style="height:50px;">
            <div>
                <h1 style="margin:0; color:#5BABD0;">SIMPOA</h1>
                <p style="margin:0; color:#5BABD0;">Sistem Potabilitas Air</p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div style="
            background:rgba(255,255,255,0.5);
            backdrop-filter:blur(12px);
            border-radius:25px;
            padding:35px;
        ">

            <form action="{{ route('analyze') }}" method="POST">
                @csrf

                @php
                $fields = [
                    ['ph','Derajat Keasaman (pH)','Skala 0-14','7.05'],
                    ['hardness','Kesadahan','mg/L','185.20'],
                    ['solids','TDS','ppm','15000'],
                    ['chloramines','Kloramin','ppm','7.12'],
                    ['sulfate','Sulfat','mg/L','330'],
                    ['conductivity','Conductivity','µS/cm','450'],
                    ['organic_carbon','TOC','ppm','15.3'],
                    ['trihalomethanes','Trihalometana','µg/L','65'],
                    ['turbidity','Turbidity','NTU','3.8'],
                ];
                @endphp

                @foreach($fields as $f)
                <div style="margin-bottom:20px;">
                    <div style="display:flex; justify-content:space-between; color:#5BABD0;">
                        <span>{{ $f[1] }}</span>
                        <span>{{ $f[2] }}</span>
                    </div>

                    <input type="number" step="any" name="{{ $f[0] }}"
                        placeholder="Contoh: {{ $f[3] }}" required
                        style="
                            width:100%;
                            padding:15px;
                            border:2px solid #BFE3F5;
                            border-radius:15px;
                        ">
                </div>
                @endforeach

                <button type="submit" style="
                    margin-left:auto;
                    display:block;
                    background:#5BABD0;
                    color:white;
                    padding:14px 40px;
                    border:none;
                    border-radius:15px;
                    cursor:pointer;
                ">
                    Analisa
                </button>

            </form>

        </div>

    </div>

</section>

@endsection