<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>{{ __('messages.sign_in') }} | ITech Academy</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css">

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
                        url("{{ asset('images/suv.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .login-container {
            width: 100%;
            max-width: 360px;
            z-index: 10;
            text-align: center;
        }

        .brand-logo {
            display: block;
            margin: 0 auto 20px;
            width: 80px;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }

        .login-card {
            background: none;
            border: none;
            padding: 10px;
            text-align: left;
        }

        .form-label {
            color: #ffffff !important;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
            font-weight: 500;
        }

        .form-control {
            background-color: rgba(13, 17, 23, 0.7) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            color: #ffffff !important;
            height: 42px;
            font-size: 14px;
            border-radius: 6px;
        }

        .form-control:focus {
            background-color: rgba(13, 17, 23, 0.9) !important;
            border-color: #58a6ff !important;
            box-shadow: 0 0 0 3px rgba(31, 111, 235, 0.3) !important;
            outline: none;
        }

        .btn-login-style {
            background-color: #238636;
            color: #ffffff;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: 0.3s;
        }

        .btn-login-style:hover {
            background-color: #2ea043;
            transform: translateY(-1px);
        }

        .signup-callout {
            margin-top: 25px;
            text-align: center;
            font-size: 14px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
        }

        .signup-callout a, .forgot-password {
            color: #58a6ff;
            text-decoration: none;
            font-weight: 600;
        }

        h3 {
            text-shadow: 2px 2px 5px rgba(0,0,0,0.9);
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
    </a>
    
    <h3 class="fw-light">{{ __('messages.sign_in') }}</h3>

    <div class="login-card">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label class="form-label">{{ __('messages.email_address') }}</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    {{ __('messages.password') }}
                    <a class="forgot-password" href="#" style="float: right; font-size: 12px;">{{ __('messages.forgot_password') }}</a>
                </label>
                <div style="position: relative;">
                    <input type="password" id="login-password" name="password" class="form-control" required>
                    <i class="fas fa-eye" id="toggle-password" 
                       style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #58a6ff;"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-login-style">{{ __('messages.log_in') }}</button>
        </form>
    </div>

    <div class="signup-callout">
        {{ __('messages.new_to_academy') }} <a href="{{ route('register') }}">{{ __('messages.create_account') }} →</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // 1. Xatoliklarni ko'rsatish
    @if ($errors->any())
        Swal.fire({
            toast: true,
            position: 'top',
            icon: 'error',
            title: 'Xatolik!',
            text: "Login yoki parol noto'g'ri!", 
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            background: '#161b22',
            color: '#ffffff'
        });
    @endif

    // 2. Parolni ko'rsatish/yashirish
    document.getElementById('toggle-password').addEventListener('click', function () {
        const passwordInput = document.getElementById('login-password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            this.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
</script>

</body>
</html>