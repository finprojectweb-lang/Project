<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NulliCarbon')</title>

    <!-- Tambahkan link CSS di sini -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/strategy.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=BalooPaaji:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  
        <style>
        body {
            margin: 0;
            padding: 0;
                background-color: #F0F8FF !important; /* Warna latar belakang */
            overflow-x: hidden; /* Hilangkan scroll samping */
            overflow-y: auto;
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
        // Variabel untuk menyimpan posisi scroll terakhir
        let lastScrollTop = 0;
        // Variabel pembatas (throttle) supaya browser tidak berat
        let isThrottled = false;

        function createLeaf() {
           console.log("leaf created");
            const leaf = document.createElement('div');
            leaf.classList.add('leaf');

            // Posisi acak kiri-kanan
            leaf.style.left = Math.random() * 100 + "vw";

            // Ukuran acak
            const size = Math.random() * 30 + 20; 
            leaf.style.width = size + "px";
            leaf.style.height = size + "px";

            // Kecepatan jatuh (2 sampai 5 detik)
            const duration = Math.random() * 3 + 2;
            leaf.style.animation = `fall ${duration}s linear`;

            document.body.appendChild(leaf);

            // Hapus elemen setelah animasi selesai
            setTimeout(() => {
                leaf.remove();
            }, duration * 1000);
        }

        // --- LOGIKA SCROLL ---
        window.addEventListener('scroll', function() {
            // Ambil posisi scroll saat ini
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Cek apakah user sedang scroll KE BAWAH
            if (scrollTop > lastScrollTop) {
                
                // Cek pembatas waktu (supaya daun tidak keluar ribuan sekaligus bikin lag)
                if (!isThrottled) {
                    createLeaf(); // Buat 1 daun
                    
                    // Mau daun lebih banyak saat scroll? Panggil createLeaf() 2 atau 3 kali di sini:
                    createLeaf(); 
                    
                    isThrottled = true;
                    
                    // Tunggu 50 milidetik sebelum boleh buat daun lagi
                    setTimeout(function() {
                        isThrottled = false;
                    }, 50);
                }
            }
            
            // Simpan posisi scroll terakhir
            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; 
        });
    </script>
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


</body>


</html>
