<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NulliCarbon')</title>
    <link rel="icon" href="{{ asset('images/daunjatuh.png') }}">

    <!-- Tambahkan link CSS di sini -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
                background-color: #F0F8FF !important; /* Warna latar belakang */
            overflow-x: hidden; /* Hilangkan scroll samping */
            overflow-y: auto;
            font-family: 'Arima', sans-serif !important;
        }
        body::-webkit-scrollbar {
            display: none;
        }

        /* Ini konten pura-pura supaya website bisa di-scroll panjang */
        .content-placeholder {
            height: 3000px; /* Tinggi website */
            display: flex;
            justify-content: center;
            padding-top: 50px;
            font-family: sans-serif;
            color: #166534;
        }

        .leaf {
            position: absolute;
            /* Kita set fixed supaya daun tetap terlihat jatuh di layar walau kita scroll */
            position: fixed; 
            top: -60px; 
            background-image: url("{{ asset('images/daunjatuh.png') }}");
 /* ⚠️ GANTI NAMA FILE GAMBARMU DI SINI */
            background-size: contain;
            background-repeat: no-repeat;
            pointer-events: none; 
            z-index: 9999999; 
        }

        @keyframes fall {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            20% {
                opacity: 1;
            }
            100% {
                transform: translateY(110vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer') 

   
    <script>
    function runReveal() {
    document.querySelectorAll(".reveal").forEach(el => {
        const top = el.getBoundingClientRect().top;
        if (top < window.innerHeight - 80) el.classList.add("show");
    });
    }
    document.addEventListener("DOMContentLoaded", runReveal);
    document.addEventListener("scroll", runReveal);
    </script>

    @include('components.ai-assistant')
</body>


</html>
