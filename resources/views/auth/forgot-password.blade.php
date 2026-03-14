<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>Forgot Password | ITech Academy</title>

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
        .forgot-container {
            width: 100%;
            max-width: 340px;
        }
        .brand-logo {
            display: block;
            margin: 0 auto 25px;
            width: 60px;
            border-radius: 50%;
        }
        .forgot-card {
            background-color: #161b22;
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 20px;
        }
        .info-text {
            font-size: 14px;
            color: #8b949e;
            margin-bottom: 15px;
            line-height: 1.5;
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
        .btn-reset-style {
            background-color: #238636;
            color: white;
            width: 100%;
            border: 1px solid rgba(240, 246, 252, 0.1);
            border-radius: 6px;
            padding: 8px;
            font-weight: 600;
            margin-top: 15px;
        }
        .btn-reset-style:hover {
            background-color: #2ea043;
        }
        .back-to-login {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .back-to-login a {
            color: #58a6ff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="forgot-container">
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
    </a>
    
    <div class="forgot-card">
        <div class="info-text">
            {{ __('messages.forgot_password_intro') }}
        </div>

        @if (session('status'))
            <div class="alert alert-success py-2 text-center" style="font-size: 13px; background-color: #23863620; border-color: #238636; color: #2ea043;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">{{ __('messages.email_address') }}</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-reset-style">
                {{ __('messages.send_reset_link') }}
            </button>
        </form>
    </div>

    <div class="back-to-login">
        <a href="{{ route('login') }}">← {{ __('messages.back_to_signin') }}</a>
    </div>
</div>

</body>
</html>