<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - NulliCarbon</title>
    <link rel="icon" href="{{ asset('images/daunjatuh.png') }}">
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

        .reset-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .reset-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .reset-header i {
            font-size: 60px;
            margin-bottom: 15px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .reset-header h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .reset-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .reset-body {
            padding: 40px 35px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
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

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            cursor: pointer;
            z-index: 1;
            font-size: 14px;
        }

        .toggle-password:hover {
            color: #10b981;
        }

        .form-control {
            width: 100%;
            padding: 12px 42px 12px 42px;
            border: 2px solid #e5e7eb;
            border-radius: 25px 0 25px 0;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-control.is-invalid {
            border-color: #dc2626;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 25px 0 25px 0;
            color: white;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        .alert {
            animation: slideDown 0.4s ease-out;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #dc2626;
            color: #991b1b;
        }

        .alert i {
            font-size: 18px;
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

        .password-requirements {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
            font-size: 13px;
        }

        .password-requirements h6 {
            color: #374151;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .requirement {
            color: #6b7280;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .requirement i {
            font-size: 12px;
            color: #9ca3af;
        }

        .requirement.met i {
            color: #10b981;
        }

        @media (max-width: 768px) {
            .reset-container {
                max-width: 100%;
            }

            .reset-header {
                padding: 30px 20px;
            }

            .reset-body {
                padding: 30px 20px;
            }

            .reset-header h2 {
                font-size: 24px;
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

    <div class="reset-container">
        <div class="reset-header">
            <i class="fas fa-key"></i>
            <h2>Reset Your Password</h2>
            <p>Enter your new password below</p>
        </div>

        <div class="reset-body">
            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

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

            <form action="{{ route('password.update') }}" method="POST" id="resetForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               placeholder="nama@email.com" value="{{ $email ?? old('email') }}" required readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Min. 8 karakter" required>
                        <i class="toggle-password fas fa-eye" onclick="togglePassword('password', this)"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="form-control" placeholder="Repeat password" required>
                        <i class="toggle-password fas fa-eye" onclick="togglePassword('password_confirmation', this)"></i>
                    </div>
                </div>

                <div class="password-requirements">
                    <h6><i class="fas fa-shield-alt"></i> Password Requirements:</h6>
                    <div class="requirement" id="req-length">
                        <i class="fas fa-circle"></i>
                        <span>At least 8 characters</span>
                    </div>
                    <div class="requirement" id="req-match">
                        <i class="fas fa-circle"></i>
                        <span>Passwords match</span>
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-check"></i> Reset Password
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, icon) {
            const field = document.getElementById(fieldId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Real-time password validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const reqLength = document.getElementById('req-length');
        const reqMatch = document.getElementById('req-match');

        password.addEventListener('input', validatePassword);
        confirmPassword.addEventListener('input', validatePassword);

        function validatePassword() {
            // Check length
            if (password.value.length >= 8) {
                reqLength.classList.add('met');
            } else {
                reqLength.classList.remove('met');
            }

            // Check match
            if (password.value && confirmPassword.value && password.value === confirmPassword.value) {
                reqMatch.classList.add('met');
            } else {
                reqMatch.classList.remove('met');
            }
        }
    </script>
</body>
</html>