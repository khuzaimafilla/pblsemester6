@extends('layouts.app')

@section('content')

<section style="
    min-height:80vh;
    padding:60px 0 60px;
">

    <div style="
        max-width:1200px;
        margin:0 auto;
        padding: 0 100px;
    ">

        <div style="
            width:100%;
            max-width:900px;
        ">

            <!-- TITLE -->
            <h1 style="
                font-size:48px;
                font-weight:700;
                color:#5BABD0;
                margin-bottom:25px;
            ">
                Tentang <span style="color:#3A929C;">SIMPOA</span>
            </h1>

            <!-- INTRO -->
            <p style="
                font-size:17px;
                color:#5BABD0;
                line-height:1.8;
                margin-bottom:50px;
                text-align:justify;
            ">
                <b>SIMPOA</b> (Sistem Potabilitas Air) adalah platform cerdas berbasis Machine Learning untuk 
                membantu masyarakat dan instansi dalam menganalisis kualitas air secara cepat dan akurat. Sistem ini 
                mengombinasikan data hasil laboratorium dengan kecerdasan artifisial guna memberikan klasifikasi 
                kelayakan air konsumsi yang objektif dan terstandarisasi.
            </p>

            <!-- SECTION -->
            <h2 style="
                font-size:24px;
                font-weight:600;
                color:#3A929C;
                margin-bottom:20px;
            ">
                Bagaimana Sistem Bekerja?
            </h2>

            <p style="
                color:#5BABD0;
                margin-bottom:25px;
            ">
                <b>SIMPOA</b> mengintegrasikan tiga metode utama dalam proses analisisnya:
            </p>

            <!-- METHOD CARDS -->
            <div style="
                display:flex;
                flex-direction:column;
                gap:18px;
                margin-bottom:50px;
            ">

                <!-- CARD 1 -->
                <div style="
                    background: rgba(255,255,255,0.3);
                    backdrop-filter: blur(10px);
                    padding:20px;
                    border-radius:12px;
                    border-left:4px solid #5BABD0;
                ">
                    <b style="color:#3A929C;">Machine Learning Classification</b><br>
                    <span style="color:#5BABD0;">
                        Menggunakan algoritma Random Forest/XGBoost untuk mengklasifikasikan air menjadi "Layak" atau "Tidak Layak".
                    </span>
                </div>

                <!-- CARD 2 -->
                <div style="
                    background: rgba(255,255,255,0.3);
                    backdrop-filter: blur(10px);
                    padding:20px;
                    border-radius:12px;
                    border-left:4px solid #5BABD0;
                ">
                    <b style="color:#3A929C;">Regulatory Matching</b><br>
                    <span style="color:#5BABD0;">
                        Membandingkan data dengan standar WHO dan regulasi Permenkes terbaru.
                    </span>
                </div>

                <!-- CARD 3 -->
                <div style="
                    background: rgba(255,255,255,0.3);
                    backdrop-filter: blur(10px);
                    padding:20px;
                    border-radius:12px;
                    border-left:4px solid #5BABD0;
                ">
                    <b style="color:#3A929C;">Probabilistic Score</b><br>
                    <span style="color:#5BABD0;">
                        Memberikan nilai confidence score untuk menunjukkan tingkat keyakinan hasil analisis.
                    </span>
                </div>

            </div>

            <!-- TUJUAN -->
            <h2 style="
                font-size:24px;
                font-weight:600;
                color:#3A929C;
                margin-bottom:20px;
            ">
                Tujuan Kami
            </h2>

            <div style="
                background: rgba(255,255,255,0.3);
                backdrop-filter: blur(10px);
                padding:24px;
                border-radius:12px;
                margin-bottom:40px;
            ">
                <p style="
                    color:#5BABD0;
                    line-height:1.8;
                    text-align:justify;
                    margin:0;
                ">
                    Menyediakan solusi digital yang transparan dan saintifik untuk mengidentifikasi risiko 
                    kesehatan pada air konsumsi, sehingga setiap individu dapat memastikan akses air yang aman 
                    demi kualitas hidup yang lebih baik.
                </p>
            </div>

            <!-- DISCLAIMER -->
            <p style="
                font-size:13px;
                color:#5BABD0;
                opacity:0.7;
                font-style:italic;
                text-align:justify;
            ">
                *Sistem SIMPOA menggunakan model prediksi digital yang dilatih pada data historis dan mungkin 
                tidak 100% sempurna dalam merepresentasikan kondisi kimia air. Hasil ini bersifat pendukung keputusan.
            </p>

        </div>

    </div>

</section>

@endsection