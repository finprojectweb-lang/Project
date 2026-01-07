<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Final Navbar</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        .user-dropdown .dropdown-toggle::after {
            display: none;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border: none;
            padding: 8px;
            min-width: 240px;
            margin-top: 8px;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item:hover {
            background: #f3f4f6;
            transform: translateX(3px);
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
        }

        .dropdown-divider {
            margin: 8px 0;
        }

        .user-info {
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 8px;
        }

        .user-info strong {
            display: block;
            font-size: 14px;
            color: #1f2937;
            margin-bottom: 2px;
        }

        .user-info small {
            color: #6b7280;
            font-size: 12px;
        }

        .logout-btn {
            color: #dc2626 !important;
        }

        .logout-btn:hover {
            background: #fee2e2 !important;
        }

        /* Highlight untuk menu Riwayat */
        .dropdown-item.highlight {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));
            border-left: 3px solid #10b981;
        }

        .dropdown-item.highlight:hover {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2));
        }

        .dropdown-item.highlight i {
            color: #10b981;
        }

        /* Badge notifikasi (opsional) */
        .notification-badge {
            background: #dc2626;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: auto;
        }

        /* Styling untuk dropdown menu di navbar */
        .navbar-nav .dropdown-menu {
            background: white;
            border: 1px solid #e5e7eb;
        }

        .navbar-nav .dropdown-menu li a {
            padding: 10px 20px;
            color: #374151;
            text-decoration: none;
            display: block;
            transition: all 0.3s;
        }

        .navbar-nav .dropdown-menu li a:hover {
            background: #f3f4f6;
            color: #10b981;
            padding-left: 25px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            /* Perbaikan untuk collapse navbar - compact dan di kanan atas */
            .navbar-collapse {
                position: absolute;
                top: 60px;
                right: 10px;
                left: auto;
                width: 250px;
                background: white;
                padding: 10px;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
                z-index: 1000;
            }

            /* Styling untuk nav items di mobile */
            .navbar-nav {
                margin: 0 !important;
                padding: 0;
            }

            .navbar-nav .nav-item {
                margin: 0;
            }

            .navbar-nav .nav-link {
                padding: 8px 12px;
                border-radius: 6px;
                transition: all 0.3s;
                color: #1f2937 !important;
                font-weight: 500;
                font-size: 13px;
            }

            .navbar-nav .nav-link:hover,
            .navbar-nav .nav-link.active {
                background: #f3f4f6;
                color: #10b981 !important;
            }

            /* Dropdown menu di mobile - hidden by default */
            .navbar-nav .dropdown {
                position: relative;
            }

            /* Hide dropdown by default - important! */
            .navbar-nav .dropdown-menu {
                display: none !important;
                position: static !important;
                transform: none !important;
                width: 100%;
                box-shadow: none;
                border: none;
                background: #f9fafb;
                margin: 2px 0 0 0;
                padding: 2px;
            }

            /* Show dropdown only when Bootstrap adds .show class */
            .navbar-nav .dropdown.show .dropdown-menu,
            .navbar-nav .dropdown .dropdown-menu.show {
                display: block !important;
            }

            .navbar-nav .dropdown-menu li {
                margin: 1px 0;
            }

            .navbar-nav .dropdown-menu li a {
                padding: 6px 12px;
                border-radius: 4px;
                font-size: 12px;
                color: #4b5563 !important;
            }

            .navbar-nav .dropdown-menu li a:hover {
                color: #10b981 !important;
                background: #e5e7eb;
            }

            /* Mobile User Section */
            .mobile-user-section {
                border-top: 1px solid #e5e7eb;
                padding-top: 6px;
                margin-top: 6px;
            }

            .mobile-user-section .nav-item {
                margin: 0;
            }

            .mobile-user-section .nav-link {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 8px 12px;
                font-size: 13px;
            }

            .mobile-user-section .nav-link i {
                width: 18px;
                text-align: center;
                color: #6b7280;
                font-size: 14px;
            }

            .mobile-user-section .nav-link:hover i {
                color: #10b981;
            }

            .mobile-user-section .nav-link.logout-link {
                color: #dc2626 !important;
            }

            .mobile-user-section .nav-link.logout-link:hover {
                background: #fee2e2;
            }

            .mobile-user-section .nav-link.logout-link i {
                color: #dc2626;
            }

            .mobile-user-section .nav-link.highlight {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1));
                border-left: 3px solid #10b981;
            }

            .mobile-user-section .nav-link.highlight i {
                color: #10b981;
            }

            /* Hide user dropdown in mobile since items are in hamburger */
            .user-dropdown {
                display: none !important;
            }

            /* Mobile buttons */
            .mobile-buttons {
                padding-top: 6px;
                border-top: 1px solid #e5e7eb;
                margin-top: 6px;
            }

            .mobile-buttons .btn-navbar {
                width: 100%;
                text-align: center;
                padding: 8px;
                border-radius: 6px;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s;
                font-size: 13px;
            }

            .btn-signup {
                background: #10b981;
                color: white !important;
            }

            .btn-signup:hover {
                background: #059669;
            }

            .btn-contact {
                background: transparent;
                border: 2px solid #10b981;
                color: #10b981 !important;
            }

            .btn-contact:hover {
                background: #10b981;
                color: white !important;
            }
        }

        /* Desktop */
        @media (min-width: 992px) {
            .navbar-nav .dropdown:hover .dropdown-menu {
                display: block;
            }

            .navbar-nav .dropdown-menu {
                margin-top: 0;
            }
        }
    </style>
</head>
<body>

<div class="header-wrapper">
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid px-4 d-flex align-items-center">

            <!-- LOGO (KIRI) -->
            <a class="navbar-brand logo-wrap" href="/">
                <img src="{{ asset('images/nullicarbon.png') }}" alt="Logo">
            </a>

            <!-- MENU (TENGAH) -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto gap-lg-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/solutions" data-bs-toggle="dropdown" aria-expanded="false">
                            Solutions
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/mangrove">Mangrove Shield</a></li>
                            <li><a href="/garbage">Garbage Recycle</a></li>
                            <li><a href="/turbin">Water Turbine</a></li>
                            <li><a href="/coralreefs">Coral Guardian</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/projects">Our Project</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/news" data-bs-toggle="dropdown" aria-expanded="false">
                            Discover Us
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/aboutus">About Us</a></li>
                            <li><a href="/discover-us/ourvalues">Our Value</a></li>
                            <li><a href="/discover-us/partners">Partners</a></li>
                            <li><a href="/contactus">Contact</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- USER MENU IN HAMBURGER (MOBILE ONLY) -->
                @auth
                <div class="mobile-user-section d-lg-none">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link highlight" href="{{ route('transactions.index') }}">
                                <i class="bi bi-clock-history"></i>
                                <span>Riwayat Transaksi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="nav-link logout-link w-100 text-start border-0 bg-transparent" style="cursor: pointer;">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth

                <!-- BUTTON MOBILE -->
                <div class="mobile-buttons d-flex flex-column gap-2 d-lg-none">
                    @guest
                        <a href="/login" class="btn-navbar btn-signup">Sign up</a>
                        <a href="/contactus" class="btn-navbar btn-contact">Contact</a>
                    @endguest
                </div>
            </div>

            <div class="navbar-right ms-auto d-flex align-items-center gap-3">
                @auth
                    <!-- User Dropdown Desktop -->
                    <div class="user-dropdown dropdown d-none d-lg-block">
                        <div class="user-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="user-info">
                                <strong>{{ Auth::user()->name }}</strong>
                                <small>{{ Auth::user()->email }}</small>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item highlight" href="{{ route('transactions.index') }}">
                                    <i class="bi bi-clock"></i>
                                    <span>Riwayat Transaksi</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog"></i>
                                    <span>Settings</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-btn">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Button jika belum login -->
                    <div class="navbar-buttons d-none d-lg-flex">
                        <a href="/login" class="btn-navbar btn-signup">Sign up</a>
                        <a href="#" class="btn-navbar btn-contact">Contact</a>
                    </div>
                @endauth

                <button class="navbar-toggler animated-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
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