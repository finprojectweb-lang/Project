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

        /* Responsive */
        @media (max-width: 991px) {
            .user-dropdown {
                width: 100%;
                margin-top: 15px;
            }

            .user-avatar {
                width: 100%;
                height: 50px;
                border-radius: 10px;
                justify-content: flex-start;
                padding: 0 15px;
                gap: 10px;
            }

            .dropdown-menu {
                width: 100%;
                position: static !important;
                transform: none !important;
                margin-top: 10px;
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
                    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                    <li class="nav-item dropdown"><a class="nav-link" href="/solutions">Solutions</a>
                    <ul class="dropdown-menu">
                        <li><a href="/mangrove">Mangrove Shield</a></li>
                        <li><a href="/garbage">Garbage Recycle</a></li>
                        <li><a href="/turbin">Water Turbine</a></li>
                        <li><a href="/coralreefs">Coral Guardian</a></li>
                    </ul></li>
                    <li class="nav-item"><a class="nav-link" href="/projects">Our Project</a></li>
                    <li class="nav-item dropdown"><a class="nav-link" href="/news">Discover Us</a>
                    <ul class="dropdown-menu">
                        <li><a href="/aboutus">About Us</a></li>
                        <li><a href="/discover-us/ourvalues">Our Value</a></li>
                        <li><a href="/discover-us/partners">Partners</a></li>
                        <li><a href="/contactus">Contact</a></li>
                    </ul></li>
                </ul>

                <!-- BUTTON MOBILE -->
                <div class="mobile-buttons d-flex flex-column gap-2 mt-3 d-lg-none">
                    @auth
                        <!-- User Dropdown Mobile -->
                        <div class="user-dropdown dropdown">
                            <div class="user-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                <span style="margin-left: auto;">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down" style="margin-left: auto; font-size: 12px;"></i>
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
                                <!-- LINK RIWAYAT TRANSAKSI (MOBILE) -->
                                <li>
                                    <a class="dropdown-item highlight" href="{{ route('transactions.index') }}">
                                        <i class="bi bi-clock-history"></i>
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
                        <a href="/login" class="btn-navbar btn-signup">Sign up</a>
                        <a href="/contactus" class="btn-navbar btn-contact">Contact</a>
                    @endauth
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
                            <!-- LINK RIWAYAT TRANSAKSI (DESKTOP) -->
                            <li>
                                <a class="dropdown-item highlight" href="{{ route('transactions.index') }}">
                                    <i class="bi bi-clock-history"></i>
                                    <span>Riwayat Transaksi</span>
                                    <!-- Opsional: Badge notifikasi jika ada transaksi pending -->
                                    {{-- <span class="notification-badge">2</span> --}}
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
                </button>
            </div>
        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>