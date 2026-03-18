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
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
                        url("{{ asset('images/suv.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px 0;
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
            margin-bottom: 15px;
        }

        .form-control:focus {
            background-color: rgba(13, 17, 23, 0.9) !important;
            border-color: #58a6ff !important;
            box-shadow: 0 0 0 3px rgba(31, 111, 235, 0.3) !important;
            outline: none;
        }

        .btn-register-style {
            background-color: #238636;
            color: #ffffff;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: 0.3s;
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
                <input type="text" name="name" class="form-control" placeholder="Ismingizni kiriting" value="{{ old('name') }}" required autofocus>
            </div>

            <div>
                <label class="form-label">{{ __('messages.email_address') }}</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label class="form-label">{{ __('messages.password') }}</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required autocomplete="new-password">
            </div>

            <div>
                <label class="form-label">{{ __('messages.confirm_password') }}</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
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