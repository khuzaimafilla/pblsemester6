<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIMPOA-Sistem Potabilitas Air</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;

            background: url('{{ asset("assets/bg-simpoa.png") }}') no-repeat center;
            background-size: cover;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    @include('components.navbar')

    <!-- CONTENT -->
    <main style="position:relative;z-index:2; padding-top:100px;">
        @yield('content')
    </main>

    <!-- FOOTER -->
    @include('components.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

</body>
</html>