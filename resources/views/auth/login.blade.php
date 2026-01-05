<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NulliCarbon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
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
            max-height: 90vh;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            display: flex;
        }

        .row {
            margin: 0;
            width: 100%;
            display: flex;
            height: 100%;
        }

        .left-side {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 40px 30px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
            flex: 0 0 40%;
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
            font-size: 60px;
            margin-bottom: 15px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .logo-section h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .logo-section p {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.5;
        }

        .features {
            margin-top: 30px;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            opacity: 0.95;
            font-size: 14px;
        }

        .feature-item i {
            font-size: 20px;
            margin-right: 12px;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 8px;
        }

        .right-side {
            padding: 0;
            flex: 1;
            display: flex;
            align-items: flex-start;
            overflow-y: auto;
            max-height: 90vh;
        }

        .right-side::-webkit-scrollbar {
            width: 6px;
        }

        .right-side::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .right-side::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 40px 35px;
        }

        .form-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            background: #e5e7eb;
            padding: 6px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
        }

        .tab-btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            background: transparent;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            color: #6b7280;
            font-size: 15px;
        }

        .tab-btn:hover {
            color: #10b981;
            background: rgba(16, 185, 129, 0.1);
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            transform: scale(1.02);
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
            margin-bottom: 8px;
            font-size: 24px;
            font-weight: 700;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            color: #374151;
            font-weight: 500;
            font-size: 14px;
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
            font-size: 14px;
            z-index: 1;
        }

        .form-control {
            width: 100%;
            padding: 11px 15px 11px 42px;
            border: 2px solid #e5e7eb;
            border-radius: 25px 0 25px 0 !important;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 25px 0 25px 0 !important;
            color: white;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
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
            font-size: 13px;
        }

        .social-login {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .social-btn {
            flex: 1;
            padding: 11px;
            border: 2px solid #e5e7eb;
            border-radius: 25px 0 25px 0 !important;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 18px;

            /* TAMBAHAN PENTING */
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
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
            margin: 12px 0;
            font-size: 13px;
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
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #dc2626;
            color: #991b1b;
        }

        .alert i {
            font-size: 16px;
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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
            animation: fadeIn 0.3s;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            margin: 20px;
            padding: 0;
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h4 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .close {
            color: white;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .modal-body {
            padding: 25px;
            overflow-y: auto;
            max-height: calc(80vh - 80px);
        }

        .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 10px;
        }

        .terms-section {
            margin-bottom: 25px;
        }

        .terms-section h5 {
            color: #10b981;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .terms-section h5 i {
            font-size: 18px;
        }

        .terms-section p, .terms-section ul {
            color: #4b5563;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .terms-section ul {
            padding-left: 25px;
        }

        .terms-section li {
            margin-bottom: 8px;
        }

        @media (max-width: 768px) {
            .auth-container {
                max-height: 95vh;
            }

            .left-side {
                display: none;
            }
            
            .right-side {
                padding: 0;
            }

            .form-container {
                padding: 30px 20px;
            }

            h3 {
                font-size: 22px;
            }

            .modal-content {
                width: 95%;
                margin: 10px;
            }

            .modal-body {
                padding: 20px;
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
                    <div id="login-form" class="form-content active">
                        <h3>Selamat Datang Kembali!</h3>
                        <p class="subtitle">Masuk ke akun Anda untuk melanjutkan</p>

                        <!-- Notifikasi Success -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        <!-- Notifikasi Error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span>{{ $error }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
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
                            <a href="{{ url('/auth/google') }}" class="social-btn google">
                                <i class="fab fa-google"></i>
                            </a>


                            <a href="#" class="social-btn facebook">
                                <i class="fab fa-facebook"></i>
                            </a>

                            <a href="#" class="social-btn twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Register Form -->
                    <div id="register-form" class="form-content">
                        <h3>Buat Akun Baru</h3>
                        <p class="subtitle">Bergabunglah dalam misi kami untuk masa depan hijau</p>

                        <!-- Notifikasi Error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                                        <i class="fas fa-exclamation-circle"></i>
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
                                <label style="font-size: 12px;">
                                    <input type="checkbox" name="terms" value="1" required> 
                                    Saya setuju dengan <a href="#" onclick="openTermsModal(event)">syarat & ketentuan</a>
                                </label>
                            </div>

                            <button type="submit" class="btn-primary">Daftar Sekarang</button>
                        </form>

                        <div class="divider">
                            <span>Atau daftar dengan</span>
                        </div>

                        <div class="social-login">
                            <a href="{{ url('/auth/google') }}" class="social-btn google">
                                <i class="fab fa-google"></i>
                            </a>


                            <a href="#" class="social-btn facebook">
                                <i class="fab fa-facebook"></i>
                            </a>

                            <a href="#" class="social-btn twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Syarat & Ketentuan -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fas fa-file-contract"></i> Syarat & Ketentuan</h4>
                <button class="close" onclick="closeTermsModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="terms-section">
                    <h5><i class="fas fa-info-circle"></i> Ketentuan Umum</h5>
                    <p>Dengan mendaftar dan menggunakan layanan NulliCarbon, Anda menyetujui untuk terikat dengan syarat dan ketentuan berikut:</p>
                    <ul>
                        <li>Anda harus berusia minimal 18 tahun atau memiliki izin dari orang tua/wali untuk menggunakan layanan ini</li>
                        <li>Informasi yang Anda berikan harus akurat, lengkap, dan terkini</li>
                        <li>Anda bertanggung jawab untuk menjaga kerahasiaan akun dan password Anda</li>
                        <li>Anda tidak boleh menggunakan layanan untuk tujuan ilegal atau tidak sah</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h5><i class="fas fa-shield-alt"></i> Privasi & Keamanan Data</h5>
                    <p>Kami berkomitmen untuk melindungi privasi dan keamanan data Anda:</p>
                    <ul>
                        <li>Data pribadi Anda akan dienkripsi dan disimpan dengan aman</li>
                        <li>Kami tidak akan membagikan informasi Anda kepada pihak ketiga tanpa persetujuan Anda</li>
                        <li>Anda memiliki hak untuk mengakses, mengubah, atau menghapus data pribadi Anda</li>
                        <li>Kami menggunakan cookies untuk meningkatkan pengalaman pengguna</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h5><i class="fas fa-leaf"></i> Layanan Carbon Offset</h5>
                    <p>Mengenai layanan kompensasi karbon kami:</p>
                    <ul>
                        <li>Semua proyek carbon offset telah diverifikasi oleh lembaga internasional</li>
                        <li>Laporan dampak lingkungan akan diberikan secara berkala</li>
                        <li>Pembayaran bersifat final dan tidak dapat dikembalikan kecuali dalam kondisi tertentu</li>
                        <li>Kami berhak untuk mengubah harga layanan dengan pemberitahuan terlebih dahulu</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h5><i class="fas fa-user-shield"></i> Hak dan Kewajiban Pengguna</h5>
                    <p>Sebagai pengguna layanan NulliCarbon:</p>
                    <ul>
                        <li>Anda berhak mendapatkan informasi transparan tentang penggunaan dana Anda</li>
                        <li>Anda berhak untuk membatalkan langganan kapan saja</li>
                        <li>Anda wajib menggunakan platform dengan etika dan tidak menyalahgunakan sistem</li>
                        <li>Anda wajib melaporkan jika menemukan bug atau masalah keamanan</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h5><i class="fas fa-gavel"></i> Batasan Tanggung Jawab</h5>
                    <p>NulliCarbon tidak bertanggung jawab atas:</p>
                    <ul>
                        <li>Kerugian yang timbul akibat penggunaan layanan yang tidak sesuai ketentuan</li>
                        <li>Gangguan layanan akibat force majeure atau pemeliharaan sistem</li>
                        <li>Kerusakan perangkat atau kehilangan data yang disebabkan oleh pihak ketiga</li>
                        <li>Perubahan regulasi pemerintah yang mempengaruhi layanan</li>
                    </ul>
                </div>

                <div class="terms-section">
                    <h5><i class="fas fa-edit"></i> Perubahan Ketentuan</h5>
                    <p>Kami berhak untuk mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan dinotifikasikan melalui email atau notifikasi di platform. Dengan tetap menggunakan layanan setelah perubahan, Anda dianggap menyetujui ketentuan yang telah diperbarui.</p>
                </div>

                <div class="terms-section">
                    <h5><i class="fas fa-envelope"></i> Kontak</h5>
                    <p>Jika Anda memiliki pertanyaan tentang syarat dan ketentuan ini, silakan hubungi kami di:</p>
                    <ul>
                        <li>Email: support@nullicarbon.com</li>
                        <li>Telepon: +62 21 1234 5678</li>
                        <li>Alamat: Jakarta, Indonesia</li>
                    </ul>
                </div>

                <p style="font-size: 12px; color: #6b7280; margin-top: 20px; font-style: italic;">
                    Terakhir diperbarui: 5 Januari 2026
                </p>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Update tab buttons
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(btn => btn.classList.remove('active'));
            
            // Cari button yang sesuai dengan tab dan tambahkan active
            tabButtons.forEach(btn => {
                if ((tab === 'login' && btn.textContent.trim() === 'Masuk') ||
                    (tab === 'register' && btn.textContent.trim() === 'Daftar')) {
                    btn.classList.add('active');
                }
            });

            // Update form content
            const forms = document.querySelectorAll('.form-content');
            forms.forEach(form => form.classList.remove('active'));
            
            if (tab === 'login') {
                document.getElementById('login-form').classList.add('active');
            } else {
                document.getElementById('register-form').classList.add('active');
            }
        }

        function openTermsModal(event) {
            event.preventDefault();
            document.getElementById('termsModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeTermsModal() {
            document.getElementById('termsModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('termsModal');
            if (event.target == modal) {
                closeTermsModal();
            }
        }

        // Check if there are validation errors and switch to appropriate tab
        document.addEventListener('DOMContentLoaded', function() {
            // Check if register form has errors
            const registerForm = document.getElementById('register-form');
            if (registerForm && registerForm.querySelector('.alert-danger')) {
                // Check if the error is specifically for registration
                const nameField = registerForm.querySelector('input[name="name"]');
                if (nameField) {
                    switchTab('register');
                }
            }
        });
    </script>
</body>
</html>