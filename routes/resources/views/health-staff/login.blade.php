<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Health Staff</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .login-icon i {
            color: white;
            font-size: 40px;
        }

        .login-header h1 {
            color: #1e293b;
            font-weight: 800;
            font-size: 28px;
            letter-spacing: 2px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .login-header p {
            color: #64748b;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            height: 52px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 0 18px;
            font-size: 15px;
            transition: all 0.3s;
            outline: none;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
        }

        .remember-me label {
            color: #64748b;
            font-size: 14px;
            cursor: pointer;
            margin: 0;
        }

        .btn-login {
            width: 100%;
            height: 55px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }

        .divider:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #94a3b8;
            position: relative;
            font-size: 14px;
            font-weight: 600;
        }

        .register-link {
            text-align: center;
            padding: 25px 20px;
            background: #f8fafc;
            border-radius: 12px;
        }

        .register-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-login.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-login.loading:after {
            content: "";
            width: 16px;
            height: 16px;
            margin-left: 10px;
            border: 3px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            display: inline-block;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 40px 30px;
            }
            
            .login-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h1>LOGIN</h1>
                <p>Welcome back! Please login to your account</p>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('health-staff.login') }}" method="POST" id="loginForm">
                @csrf

                <!-- Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" 
                           class="form-control" 
                           id="username" 
                           name="username" 
                           value="{{ old('username') }}" 
                           placeholder="Enter your username"
                           required 
                           autofocus>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" 
                           class="form-control" 
                           id="password" 
                           name="password" 
                           placeholder="Enter your password"
                           required>
                </div>

                <!-- Remember Me -->
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-login" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <!-- Divider -->
            <div class="divider">
                <span>OR</span>
            </div>

            <!-- Register Link -->
            <div class="register-link">
                <p style="margin: 0; color: #64748b;">
                    Don't have an account? 
                    <a href="{{ route('health-staff.register.form') }}">
                        <i class="fas fa-user-plus"></i> Register now
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Auto-dismiss success messages after 5 seconds
            setTimeout(function() {
                $('.alert-success').fadeOut('slow');
            }, 5000);

            // Add loading state on submit
            $('#loginForm').on('submit', function() {
                const loginBtn = $('#loginBtn');
                loginBtn.addClass('loading');
                loginBtn.html('<i class="fas fa-spinner"></i> Logging in...');
            });
        });
    </script>
</body>
</html>
