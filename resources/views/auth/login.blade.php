<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>{{ __('messages.sign_in') }} | ITech Academy</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #0d1117;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 340px;
        }
        .brand-logo {
            display: block;
            margin: 0 auto 25px;
            width: 60px;
            border-radius: 50%;
        }
        .login-card {
            background-color: #161b22;
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 20px;
        }
        .form-label {
            font-size: 14px;
            display: block;
            margin-bottom: 8px;
        }
        .form-control {
            background-color: #0d1117 !important;
            border: 1px solid #30363d !important;
            color: #ffffff !important;
            padding: 5px 12px;
            font-size: 14px;
            border-radius: 6px;
        }
        .form-control:focus {
            border-color: #58a6ff !important;
            box-shadow: 0 0 0 3px rgba(31, 111, 235, 0.3) !important;
            outline: none;
        }
        .btn-login-style {
            background-color: #238636;
            color: white;
            width: 100%;
            border: 1px solid rgba(240, 246, 252, 0.1);
            border-radius: 6px;
            padding: 8px;
            font-weight: 600;
            margin-top: 15px;
        }
        .btn-login-style:hover {
            background-color: #2ea043;
        }
        .signup-callout {
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 15px;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .signup-callout a {
            color: #58a6ff;
            text-decoration: none;
        }
        .forgot-password {
            float: right;
            font-size: 12px;
            color: #58a6ff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-container">
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
    </a>
    
    <h3 class="text-center fw-light mb-3" style="font-size: 24px;">{{ __('messages.sign_in') }}</h3>

    <div class="login-card">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">{{ __('messages.email_address') }}</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    {{ __('messages.password') }}
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">{{ __('messages.forgot_password') }}</a>
                    @endif
                </label>
                <div style="position: relative;">
                    <input type="password" id="login-password" name="password" class="form-control" required>
                    <i class="fas fa-eye" id="toggle-login-password" 
                       style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #58a6ff;"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-login-style">{{ __('messages.log_in') }}</button>
        </form>
    </div>

    <div class="signup-callout">
        {{ __('messages.new_to_academy') }} <a href="{{ route('register') }}">{{ __('messages.create_account') }} →</a>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#toggle-login-password');
    const password = document.querySelector('#login-password');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>