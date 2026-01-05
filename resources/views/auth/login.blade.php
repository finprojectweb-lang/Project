<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Carbon Compensation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(16, 185, 129, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(52, 211, 153, 0.1) 0%, transparent 50%);
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .floating-leaves {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .leaf {
            position: absolute;
            font-size: 24px;
            color: rgba(16, 185, 129, 0.3);
            animation: fall 15s linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .leaf:nth-child(1) { left: 10%; animation-delay: 0s; }
        .leaf:nth-child(2) { left: 30%; animation-delay: 3s; }
        .leaf:nth-child(3) { left: 50%; animation-delay: 6s; }
        .leaf:nth-child(4) { left: 70%; animation-delay: 9s; }
        .leaf:nth-child(5) { left: 90%; animation-delay: 12s; }

        .auth-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .row {
            margin: 0;
        }

        .left-side {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 60px 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .left-side::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
        }

        .logo-section {
            position: relative;
            z-index: 1;
        }

        .logo-icon {
            font-size: 80px;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .logo-section h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .logo-section p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .features {
            margin-top: 40px;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            opacity: 0.95;
        }

        .feature-item i {
            font-size: 24px;
            margin-right: 15px;
            background: rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 10px;
        }

        .right-side {
            padding: 60px 40px;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 40px;
            background: #f3f4f6;
            padding: 5px;
            border-radius: 10px;
        }

        .tab-btn {
            flex: 1;
            padding: 12px;
            border: none;
            background: transparent;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            color: #6b7280;
        }

        .tab-btn.active {
            background: white;
            color: #10b981;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-content {
            display: none;
        }

        .form-content.active {
            display: block;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h3 {
            color: #1f2937;
            margin-bottom: 10px;
            font-size: 28px;
            font-weight: 700;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #9ca3af;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            padding: 0 15px;
            font-size: 14px;
        }

        .social-login {
            display: flex;
            gap: 10px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 20px;
        }

        .social-btn:hover {
            border-color: #10b981;
            transform: translateY(-2px);
        }

        .social-btn.google { color: #db4437; }
        .social-btn.facebook { color: #4267B2; }
        .social-btn.twitter { color: #1DA1F2; }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            font-size: 14px;
        }

        .remember-forgot a {
            color: #10b981;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .form-control.is-invalid {
    border-color: #dc2626;
}

.form-control.is-invalid:focus {
    border-color: #dc2626;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

.alert {
    animation: slideDown 0.4s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

        @media (max-width: 768px) {
            .left-side {
                display: none;
            }
            
            .right-side {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="floating-leaves">
        <div class="leaf">🍃</div>
        <div class="leaf">🌿</div>
        <div class="leaf">🍃</div>
        <div class="leaf">🌿</div>
        <div class="leaf">🍃</div>
    </div>

    <div class="auth-container">
        <div class="row g-0">
            <div class="col-lg-5 left-side">
                <div class="logo-section">
                    <div class="logo-icon">🌍</div>
                    <h2>Carbon Offset</h2>
                    <p>Bersama kita wujudkan masa depan yang lebih hijau dan berkelanjutan untuk generasi mendatang</p>
                </div>
                <div class="features">
                    <div class="feature-item">
                        <i class="fas fa-leaf"></i>
                        <span>Kompensasi karbon terverifikasi</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Tracking emisi real-time</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-globe-asia"></i>
                        <span>Dampak positif global</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 right-side">
                <div class="form-container">
                    <div class="form-tabs">
                        <button class="tab-btn active" onclick="switchTab('login')">Masuk</button>
                        <button class="tab-btn" onclick="switchTab('register')">Daftar</button>
                    </div>

                    <!-- Login Form -->
                    <!-- Login Form -->
<div id="login-form" class="form-content active">
    <h3>Selamat Datang Kembali!</h3>
    <p class="subtitle">Masuk ke akun Anda untuk melanjutkan</p>

    <!-- Notifikasi Success (untuk logout atau pesan sukses lainnya) -->
    @if (session('success'))
        <div class="alert alert-success" style="padding: 12px 15px; background: #d1fae5; border: 1px solid #10b981; border-radius: 10px; margin-bottom: 20px; color: #065f46; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-check-circle" style="font-size: 20px;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Notifikasi Error -->
    @if ($errors->any())
        <div class="alert alert-danger" style="padding: 12px 15px; background: #fee2e2; border: 1px solid #dc2626; border-radius: 10px; margin-bottom: 20px; color: #991b1b;">
            @foreach ($errors->all() as $error)
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                    <i class="fas fa-exclamation-circle" style="font-size: 18px;"></i>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Email</label>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="nama@email.com" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Masukkan password" required>
            </div>
        </div>

        <div class="remember-forgot">
            <label>
                <input type="checkbox" name="remember"> Ingat saya
            </label>
            <a href="#">Lupa password?</a>
        </div>

        <button type="submit" class="btn-primary">Masuk</button>
    </form>

    <div class="divider">
        <span>Atau masuk dengan</span>
    </div>

    <div class="social-login">
        <button class="social-btn google"><i class="fab fa-google"></i></button>
        <button class="social-btn facebook"><i class="fab fa-facebook"></i></button>
        <button class="social-btn twitter"><i class="fab fa-twitter"></i></button>
    </div>
</div>

<!-- Register Form -->
<div id="register-form" class="form-content">
    <h3>Buat Akun Baru</h3>
    <p class="subtitle">Bergabunglah dalam misi kami untuk masa depan hijau</p>

    <!-- Notifikasi Error -->
    @if ($errors->any())
        <div class="alert alert-danger" style="padding: 12px 15px; background: #fee2e2; border: 1px solid #dc2626; border-radius: 10px; margin-bottom: 20px; color: #991b1b;">
            @foreach ($errors->all() as $error)
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                    <i class="fas fa-exclamation-circle" style="font-size: 18px;"></i>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       placeholder="Nama lengkap Anda" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="nama@email.com" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Min. 8 karakter" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password_confirmation" class="form-control" 
                       placeholder="Ulangi password" required>
            </div>
        </div>

        <div class="remember-forgot">
            <label style="font-size: 13px;">
                <input type="checkbox" name="terms" value="1" required> 
                Saya setuju dengan <a href="#">syarat & ketentuan</a>
            </label>
        </div>

        <button type="submit" class="btn-primary">Daftar Sekarang</button>
    </form>

    <div class="divider">
        <span>Atau daftar dengan</span>
    </div>

    <div class="social-login">
        <button class="social-btn google"><i class="fab fa-google"></i></button>
        <button class="social-btn facebook"><i class="fab fa-facebook"></i></button>
        <button class="social-btn twitter"><i class="fab fa-twitter"></i></button>
    </div>
</div>

                    <!-- Register Form -->
                    <div id="register-form" class="form-content">
                        <h3>Buat Akun Baru</h3>
                        <p class="subtitle">Bergabunglah dalam misi kami untuk masa depan hijau</p>

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="name" class="form-control" placeholder="Nama lengkap Anda" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="password" class="form-control" placeholder="Min. 8 karakter" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                                </div>
                            </div>

                            <div class="remember-forgot">
                                <label style="font-size: 13px;">
                                    <input type="checkbox" name="terms" required> Saya setuju dengan <a href="#">syarat & ketentuan</a>
                                </label>
                            </div>

                            <button type="submit" class="btn-primary">Daftar Sekarang</button>
                        </form>

                        <div class="divider">
                            <span>Atau daftar dengan</span>
                        </div>

                        <div class="social-login">
                            <button class="social-btn google"><i class="fab fa-google"></i></button>
                            <button class="social-btn facebook"><i class="fab fa-facebook"></i></button>
                            <button class="social-btn twitter"><i class="fab fa-twitter"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Update tab buttons
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Update form content
            const forms = document.querySelectorAll('.form-content');
            forms.forEach(form => form.classList.remove('active'));
            
            if (tab === 'login') {
                document.getElementById('login-form').classList.add('active');
            } else {
                document.getElementById('register-form').classList.add('active');
            }
        }
    </script>
</body>
</html>