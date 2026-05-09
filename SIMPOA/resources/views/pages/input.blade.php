@extends('layouts.app')

@section('content')

<section style="min-height:100vh; padding:60px 0 60px;">

    <div style="max-width:900px; margin:0 auto; padding:0 80px;">

        <!-- HEADER -->
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:30px;">

            <img src="{{ asset('assets/logo-simpoa.png') }}" style="height:50px;">

            <div>

                <h1 style="
                    margin:0;
                    color:#5BABD0;
                ">
                    SIMPOA
                </h1>

                <p style="
                    margin:0;
                    color:#5BABD0;
                ">
                    Sistem Potabilitas Air
                </p>

            </div>

        </div>

        <!-- FORM CARD -->
        <div style="
            background:rgba(255,255,255,0.5);
            backdrop-filter:blur(12px);
            border-radius:25px;
            padding:35px;
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
        ">

            <form action="{{ route('analyze') }}" method="POST">

                @csrf

                @php

                $fields = [

                    ['ph','Derajat Keasaman (pH)','Skala 0-14','7.05',0,14],

                    ['hardness','Kesadahan','mg/L','185.20',0,1000],

                    ['solids','TDS','ppm','15000',0,50000],

                    ['chloramines','Kloramin','ppm','7.12',0,20],

                    ['sulfate','Sulfat','mg/L','330',0,1000],

                    ['conductivity','Conductivity','µS/cm','450',0,2000],

                    ['organic_carbon','TOC','ppm','15.3',0,50],

                    ['trihalomethanes','Trihalometana','µg/L','65',0,300],

                    ['turbidity','Turbidity','NTU','3.8',0,100],

                ];

                @endphp

                @foreach($fields as $f)

                <div style="margin-bottom:22px;">

                    <!-- LABEL -->
                    <div style="
                        display:flex;
                        justify-content:space-between;
                        margin-bottom:8px;
                        color:#5BABD0;
                        font-weight:600;
                    ">

                        <span>{{ $f[1] }}</span>

                        <span>{{ $f[2] }}</span>

                    </div>

                    <!-- INPUT -->
                    <input
                        type="number"
                        step="any"

                        name="{{ $f[0] }}"

                        placeholder="Contoh: {{ $f[3] }}"

                        required

                        min="{{ $f[4] }}"
                        max="{{ $f[5] }}"

                        style="
                            width:100%;
                            padding:16px 18px;
                            border:2px solid #BFE3F5;
                            border-radius:18px;
                            outline:none;
                            font-family:Montserrat;
                            font-size:15px;
                            color:#5BABD0;
                            background:rgba(255,255,255,0.6);
                            transition:0.3s;
                            box-sizing:border-box;
                        "

                        onfocus="
                            this.style.borderColor='#5BABD0';
                            this.style.boxShadow='0 0 10px rgba(91,171,208,0.3)';
                        "

                        onblur="
                            this.style.borderColor='#BFE3F5';
                            this.style.boxShadow='none';
                        "

                        oninput="

                            const min = parseFloat(this.min);
                            const max = parseFloat(this.max);
                            const value = parseFloat(this.value);

                            if(value < min || value > max)
                            {
                                this.style.borderColor='#DC2626';
                                this.style.boxShadow='0 0 10px rgba(220,38,38,0.3)';
                            }
                            else
                            {
                                this.style.borderColor='#5BABD0';
                                this.style.boxShadow='0 0 10px rgba(91,171,208,0.3)';
                            }

                        "
                    >

                    <!-- ERROR -->
                    @error($f[0])

                    <div style="
                        color:#DC2626;
                        margin-top:8px;
                        font-size:14px;
                    ">
                        {{ $message }}
                    </div>

                    @enderror

                </div>

                @endforeach

                <!-- BUTTON -->
                <button
                    type="button"

                    onclick="validateForm()"

                    style="
                        margin-left:auto;
                        display:block;
                        background:#5BABD0;
                        color:white;
                        padding:14px 45px;
                        border:none;
                        border-radius:18px;
                        cursor:pointer;
                        font-family:Montserrat;
                        font-size:16px;
                        font-weight:600;
                        transition:0.3s;
                    "

                    onmouseover="
                        this.style.background='#3A929C';
                        this.style.transform='translateY(-2px)';
                    "

                    onmouseout="
                        this.style.background='#5BABD0';
                        this.style.transform='translateY(0px)';
                    "
                >
                    Analisa
                </button>

            </form>

        </div>

    </div>

</section>

<!-- ALERT INFORMASI -->
<div id="infoModal" style="
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.25);
    justify-content:center;
    align-items:center;
    z-index:9999;
">

    <div style="
        width:500px;
        background:white;
        border-radius:25px;
        overflow:hidden;
        font-family:Montserrat;
        box-shadow:0 15px 40px rgba(0,0,0,0.15);
    ">

        <!-- HEADER -->
        <div style="
            background:#5BABD0;
            color:white;
            padding:20px 25px;
            font-size:24px;
            font-weight:600;
        ">
            ⓘ Informasi
        </div>

        <!-- BODY -->
        <div style="
            padding:45px 35px;
            text-align:center;
            color:#5BABD0;
            font-size:22px;
            line-height:1.5;
        ">
            Mohon lengkapi parameter input Anda untuk melanjutkan
        </div>

        <!-- BUTTON -->
        <div style="
            text-align:center;
            padding-bottom:35px;
        ">

            <button
                onclick="closeInfoModal()"

                style="
                    background:#5BABD0;
                    color:white;
                    border:none;
                    padding:14px 60px;
                    border-radius:20px;
                    font-size:20px;
                    cursor:pointer;
                    font-weight:600;
                    transition:0.3s;
                "

                onmouseover="this.style.background='#3A929C'"
                onmouseout="this.style.background='#5BABD0'"
            >
                Oke
            </button>

        </div>

    </div>

</div>

<!-- ALERT KONFIRMASI -->
<div id="confirmModal" style="
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.25);
    justify-content:center;
    align-items:center;
    z-index:9999;
">

    <div style="
        width:500px;
        background:white;
        border-radius:25px;
        overflow:hidden;
        font-family:Montserrat;
        box-shadow:0 15px 40px rgba(0,0,0,0.15);
    ">

        <!-- HEADER -->
        <div style="
            background:#5BABD0;
            color:white;
            padding:20px 25px;
            font-size:24px;
            font-weight:600;
        ">
            ⓘ Konfirmasi
        </div>

        <!-- BODY -->
        <div style="
            padding:40px 35px;
            text-align:center;
            color:#5BABD0;
            font-size:20px;
            line-height:1.6;
        ">
            Pastikan semua data yang Anda masukkan benar,
            apakah Anda yakin ingin melanjutkan?
        </div>

        <!-- BUTTON -->
        <div style="
            display:flex;
            justify-content:center;
            gap:20px;
            padding-bottom:35px;
        ">

            <button
                onclick="closeConfirmModal()"

                style="
                    background:#8B8B8B;
                    color:white;
                    border:none;
                    padding:14px 45px;
                    border-radius:20px;
                    font-size:18px;
                    cursor:pointer;
                    font-weight:600;
                "
            >
                Tidak
            </button>

            <button
                onclick="submitForm()"

                style="
                    background:#5BABD0;
                    color:white;
                    border:none;
                    padding:14px 55px;
                    border-radius:20px;
                    font-size:18px;
                    cursor:pointer;
                    font-weight:600;
                "
            >
                Ya
            </button>

        </div>

    </div>

</div>

<!-- LOADING OVERLAY -->
<div id="loadingOverlay" style="
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(255,255,255,0.85);
    backdrop-filter:blur(6px);
    z-index:99999;
    justify-content:center;
    align-items:center;
    flex-direction:column;
">

    <!-- SPINNER -->
    <div style="
        width:70px;
        height:70px;
        border:8px solid #D9EEF8;
        border-top:8px solid #5BABD0;
        border-radius:50%;
        animation:spin 1s linear infinite;
    ">
    </div>

    <!-- TEXT -->
    <div style="
        margin-top:25px;
        color:#5BABD0;
        font-size:24px;
        font-weight:600;
    ">
        Menganalisis Kualitas Air...
    </div>

    <div style="
        margin-top:10px;
        color:#7BAFCB;
        font-size:15px;
    ">
        Mohon tunggu sebentar
    </div>

</div>

<style>

@keyframes spin {

    0% {
        transform:rotate(0deg);
    }

    100% {
        transform:rotate(360deg);
    }

}

</style>

<script>

function validateForm()
{
    const inputs = document.querySelectorAll('input');

    let valid = true;

    inputs.forEach(input => {

        if(input.value.trim() === '')
        {
            valid = false;
        }

        const min = parseFloat(input.min);
        const max = parseFloat(input.max);
        const value = parseFloat(input.value);

        if(value < min || value > max)
        {
            valid = false;
        }

    });

    if(!valid)
    {
        document.getElementById('infoModal').style.display = 'flex';
        return;
    }

    document.getElementById('confirmModal').style.display = 'flex';
}

function closeInfoModal()
{
    document.getElementById('infoModal').style.display = 'none';
}

function closeConfirmModal()
{
    document.getElementById('confirmModal').style.display = 'none';
}

function submitForm()
{
    // TUTUP MODAL
    document.getElementById('confirmModal').style.display = 'none';

    // TAMPILKAN LOADING
    document.getElementById('loadingOverlay').style.display = 'flex';

    // DISABLE BUTTON
    const buttons = document.querySelectorAll('button');

    buttons.forEach(btn => {
        btn.disabled = true;
    });

    // SUBMIT FORM
    document.querySelector('form').submit();
}

</script>

@endsection