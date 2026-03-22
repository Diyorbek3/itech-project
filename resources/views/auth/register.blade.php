<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <title>{{ __('messages.create_account') }} | ITech Academy</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {

    /* Rasmni asset orqali chaqiramiz va ustiga xira qora qatlam beramiz */
    background: linear-gradient(rgba(13, 17, 23, 0.7), rgba(13, 17, 23, 0.7)), 
                url('{{ asset('images/AP2.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; /* Rasm qotib turishi uchun */
    
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
            max-width: 360px;
            z-index: 10;
            text-align: center;
        }

        .brand-logo {
            display: block;
            margin: 0 auto 15px;
            width: 75px;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }

        .register-card {
            background: none; /* Qora fon olib tashlandi */
            border: none;
            padding: 10px;
            text-align: left;
        }

        .form-label {
            color: #ffffff !important;
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
            font-weight: 500;
        }

        .form-control {
            background-color: rgba(13, 17, 23, 0.7) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            color: #ffffff !important;
            height: 40px;
            font-size: 14px;
            border-radius: 6px;

            transition: 0.2s;
        }

        .form-control:focus {
            background-color: rgba(13, 17, 23, 0.9) !important;
            border-color: #58a6ff !important;
            box-shadow: 0 0 0 3px rgba(31, 111, 235, 0.3) !important;
            outline: none;
        }
        .btn-register-style {
        .is-invalid {
            border-color: #f85149 !important;
        }
        .error-message {
            color: #f85149;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }
        .btn-github-style {
            background-color: #238636;
            color: #ffffff;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-weight: 600;

            margin-top: 15px;
            cursor: pointer;
        }

        .btn-register-style:hover {
            background-color: #2ea043;
            transform: translateY(-1px);
        }

        .login-callout {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
        }

        .login-callout a {
            color: #58a6ff;
            text-decoration: none;
            font-weight: 600;
        }

        h3 {
            text-shadow: 2px 2px 5px rgba(0,0,0,0.9);
            margin-bottom: 15px;
            font-size: 24px;
            font-weight: 300;
        }
    </style>
</head>
<body>

<div class="register-container">
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
    </a>
    
    <h3>{{ __('messages.create_account') }}</h3>

    <div class="register-card">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label class="form-label">{{ __('messages.full_name') }}</label>

                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       placeholder="{{ __('messages.name_placeholder') }}" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="form-label">{{ __('messages.email_address') }}</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="form-label">{{ __('messages.password') }}</label>

                <div class="position-relative" style="position: relative;">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="••••••••" required>
                    <i class="fas fa-eye toggle-password" data-target="password"></i>
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.confirm_password') }}</label>
                <div class="position-relative" style="position: relative;">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                           placeholder="••••••••" required>
                    <i class="fas fa-eye toggle-password" data-target="password_confirmation"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-register-style">
                {{ __('messages.sign_up') }}
            </button>
        </form>
    </div>

    <div class="login-callout">
        {{ __('messages.already_have_account') }} <a href="{{ route('login') }}">← {{ __('messages.log_in') }}</a>
    </div>
</div>

</body>
</html>