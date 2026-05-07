@extends('layouts.app')

@section('content')

<section style="
    min-height: 80vh;
    display:flex;
    align-items:center;
">

    <div style="
        max-width:1200px;
        margin:0 auto;
        width:100%;
        padding: 0 80px;
    ">

        <div style="max-width:650px;">

            <!-- TITLE -->
            <h1 style="
                font-size:56px;
                font-weight:800;
                color:#5BABD0;
                line-height:1;
                margin-bottom:24px;
            ">
                Cek Kelayakan Air <br>
                Mineral Anda Sebelum <br>
                Konsumsi Dengan <span style="color:#3A929C;">SIMPOA</span>
            </h1>

            <!-- SUBTEXT -->
            <p style="
                font-size:18px;
                color:#5BABD0;
                margin-bottom:40px;
                line-height:1.6;
            ">
                Integrasi Algoritma <b>Random Forest</b> Untuk Menentukan 
                Kelayakan Air Berdasarkan Kandungannya
            </p>

            <!-- BUTTON -->
            <div style="display:flex; gap:20px; align-items:center;">

                <!-- PRIMARY -->
                <a href="/form" style="
                    background:#5BABD0;
                    color:#FFFFFF;
                    padding:14px 32px;
                    border-radius:15px;
                    text-decoration:none;
                    font-weight:600;
                    display:inline-block;
                    transition:0.25s;
                "
                onmouseover="
                    this.style.background='#3A929C';
                    this.style.transform='translateY(-2px)';
                "
                onmouseout="
                    this.style.background='#5BABD0';
                    this.style.transform='translateY(0)';
                ">
                    Coba Sekarang
                </a>

                <!-- OUTLINE -->
                <a href="/wawasan" style="
                    border:2px solid #5BABD0;
                    color:#5BABD0;
                    padding:12px 30px;
                    border-radius:15px;
                    text-decoration:none;
                    font-weight:600;
                    display:inline-block;
                    transition:0.25s;
                "
                onmouseover="
                    this.style.background='#5BABD0';
                    this.style.color='#FFFFFF';
                    this.style.transform='translateY(-2px)';
                "
                onmouseout="
                    this.style.background='transparent';
                    this.style.color='#5BABD0';
                    this.style.transform='translateY(0)';
                ">
                    Wawasan Kandungan Air
                </a>

            </div>

        </div>

    </div>

</section>

@endsection