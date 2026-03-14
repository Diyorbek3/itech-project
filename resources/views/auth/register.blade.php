<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <title>Sign Up | ITech Academy</title>

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
        .register-container {
            width: 100%;
            max-width: 340px;
        }
        .brand-logo {
            display: block;
            margin: 0 auto 25px;
            width: 60px;
            border-radius: 50%;
        }
        .register-card {
            background-color: #161b22;
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 20px;
        }
        .form-label {
            font-size: 14px;    
            margin-bottom: 8px;
            display: block;
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
        .btn-github-style {
            background-color: #238636;
            color: white;
            width: 100%;
            border: 1px solid rgba(240, 246, 252, 0.1);
            border-radius: 6px;
            padding: 8px;
            font-weight: 600;
            margin-top: 15px;
        }
        .btn-github-style:hover {
            background-color: #2ea043;
        }
        .login-callout {
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 15px;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .login-callout a {
            color: #58a6ff;
            text-decoration: none;
        }
        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #58a6ff;
            z-index: 10;
        }
    </style>
</head>
<body>

<div class="register-container">
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
    </a>
    
    <h3 class="text-center fw-light mb-3" style="font-size: 24px;">{{ __('messages.create_account') }}</h3>

    <div class="register-card">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">{{ __('messages.full_name') }}</label>
                <input type="text" name="name" class="form-control" placeholder="{{ __('messages.name_placeholder') }}" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.email_address') }}</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.password') }}</label>
                <div class="position-relative" style="position: relative;">
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                    <i class="fas fa-eye toggle-password" data-target="password"></i>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <div class="position-relative" style="position: relative;">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                    <i class="fas fa-eye toggle-password" data-target="password_confirmation"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-github-style">
                {{ __('messages.create_account') }}
            </button>
        </form>
    </div>

    <div class="login-callout">
        {{ __('messages.already_have_account') }} 
        <a href="{{ route('login') }}">{{ __('messages.log_in') }} →</a>
    </div>
</div>

<script>
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>

</body>
</html>