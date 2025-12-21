<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Final Navbar</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="header-wrapper">
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid px-4 d-flex align-items-center">

            <!-- LOGO (KIRI) -->
            <a class="navbar-brand logo-wrap" href="#">
                <img src="{{ asset('images/nullicarbon.png') }}" alt="Logo">
            </a>

            <!-- MENU (TENGAH) -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto gap-lg-4 text-center">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Solutions</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Our Project</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Discover Us</a></li>
                </ul>

                <!-- BUTTON MOBILE -->
                <div class="mobile-buttons d-flex justify-content-center gap-2 mt-3 d-lg-none">
                    <a href="#" class="btn-navbar btn-signup">Sign up</a>
                    <a href="#" class="btn-navbar btn-contact">Contact</a>
                </div>
            </div>

            <div class="navbar-right ms-auto d-flex align-items-center gap-2">
                <div class="navbar-buttons">
                    <a href="#" class="btn-navbar btn-signup">Sign up</a>
                    <a href="#" class="btn-navbar btn-contact">Contact</a>
                </div>

                <button class="navbar-toggler animated-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>



        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
