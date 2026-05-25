@extends('layouts.app')

@section('content')

<section style="
    min-height:100vh;
    display:flex;
    align-items:center;
    padding:60px 0;
">

    <div style="
        max-width:1200px;
        margin:0 auto;
        width:100%;
        padding:0 80px;
    ">

        <!-- HERO -->
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
                Konsumsi Dengan
                <span style="color:#3A929C;">
                    SIMPOA
                </span>
            </h1>

            <!-- SUBTEXT -->
            <p style="
                font-size:18px;
                color:#5BABD0;
                margin-bottom:40px;
                line-height:1.6;
            ">
                Integrasi Algoritma <b>Random Forest</b>
                untuk menentukan kelayakan air berdasarkan
                kandungannya
            </p>

            <!-- BUTTON -->
            <div style="
                display:flex;
                gap:20px;
                align-items:center;
                flex-wrap:wrap;
            ">

                <!-- PRIMARY -->
                <a href="/form" style="
                    background:#5BABD0;
                    color:#FFFFFF;
                    padding:14px 32px;
                    border-radius:15px;
                    text-decoration:none;
                    font-weight:600;
                    transition:.3s;
                "
                onmouseover="
                    this.style.background='#3A929C';
                    this.style.transform='translateY(-3px)';
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
                    transition:.3s;
                "
                onmouseover="
                    this.style.background='#5BABD0';
                    this.style.color='#FFFFFF';
                    this.style.transform='translateY(-3px)';
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


        <!-- SECTION INFO DROPDOWN -->
<div style="
    margin-top:90px;
    display:flex;
    flex-direction:column;
    gap:20px;
">

    <!-- DROPDOWN 1 -->
    <details style="
        background:#F7FCFE;
        border-radius:20px;
        overflow:hidden;
        border:1px solid rgba(91,171,208,.2);
        box-shadow:0 8px 25px rgba(0,0,0,.05);
    ">

        <summary style="
            padding:25px 30px;
            cursor:pointer;
            font-size:24px;
            font-weight:700;
            color:#3A929C;
            list-style:none;
        ">
            Air Layak Minum Seperti Apa?
        </summary>

        <div style="
            padding:30px;
            border-top:1px solid rgba(91,171,208,.15);
            display:flex;
            gap:30px;
            align-items:center;
            flex-wrap:wrap;
        ">

            <!-- IMAGE -->
            <img src="{{ asset('images/air-layak.jpg') }}"
            style="
            width:250px;
            height:275px;
            border-radius:20px;
            object-fit:cover;
            display:block;
        "

            <!-- CONTENT -->
            <div style="flex:1;">

                <p style="
                    color:#5BABD0;
                    line-height:1.8;
                    margin-bottom:15px;
                ">
                    Secara umum air layak konsumsi memiliki karakteristik:
                </p>

                <ul style="
                    color:#5BABD0;
                    line-height:2;
                    padding-left:20px;
                ">
                    <li>Jernih dan tidak keruh</li>
                    <li>Tidak berwarna</li>
                    <li>Tidak memiliki bau menyengat</li>
                    <li>Tidak memiliki rasa asing</li>
                    <li>Tidak mengandung zat berbahaya berlebih</li>
                </ul>

                <p style="
                    color:#5BABD0;
                    margin-top:15px;
                    line-height:1.7;
                ">
                    Meskipun terlihat bersih, kandungan tertentu
                    dalam air tidak selalu dapat dikenali melalui
                    pengamatan secara langsung.
                </p>

            </div>

        </div>

    </details>
            <!-- DROPDOWN 2 -->
            <details style="
                background:linear-gradient(
                135deg,
                #5BABD0,
                #3A929C
                );
                border-radius:20px;
                overflow:hidden;
                color:white;
                box-shadow:0 8px 25px rgba(0,0,0,.08);
            ">

                <summary style="
                    padding:25px 30px;
                    cursor:pointer;
                    font-size:24px;
                    font-weight:700;
                    list-style:none;
                ">
                    Mengapa Harus Mengecek Kualitas Air?
                </summary>

                <div style="
                    padding:30px;
                    border-top:1px solid rgba(255,255,255,.2);
                    display:flex;
                    gap:30px;
                    align-items:center;
                    flex-wrap:wrap;
                ">

                    <!-- IMAGE -->
                    <img src="{{ asset('images/why.jpg') }}"
                    style="
                        width:250px;
                        height:275px;
                        border-radius:20px;
                        object-fit:cover;
                        display:block;
                    ">

                    <!-- CONTENT -->
                    <div style="flex:1;">

                        <p style="
                            line-height:1.9;
                        ">
                            Air yang terlihat jernih belum tentu aman
                            untuk dikonsumsi. Kandungan seperti mineral
                            berlebih, zat terlarut, dan parameter kualitas
                            tertentu dapat memengaruhi kesehatan apabila
                            dikonsumsi dalam jangka panjang.
                        </p>

                        <div style="
                            margin-top:20px;
                            background:rgba(255,255,255,.15);
                            padding:18px;
                            border-radius:15px;
                        ">
                            <b>SIMPOA</b> menggunakan kombinasi
                            <b>Random Forest</b> dan
                            <b>Simple Additive Weighting (SAW)</b>
                            sehingga evaluasi kualitas air menjadi
                            lebih informatif.
                        </div>

                    </div>

                </div>

            </details>

        </div>

    </div>

</section>

@endsection